<?php

namespace App\Controllers\Article;

use App\Controllers\BaseController;
use App\Entities\ArticleEntity;
use App\Models\ArticleModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use finfo;
use RuntimeException;

class Image extends BaseController
{

    private ArticleModel $model;

    public function __construct()
    {
        $this->model = new ArticleModel();
    }

    public function new($id)
    {
        $article = $this->getArticleOr404($id);
        return view('Article/Image/new', ['article' => $article]);
    }

    public function create($id)
    {
        $article = $this->getArticleOr404($id);
        $file = $this->request->getFile('image');
        if (!$file->isValid()) {
            $error_code = $file->getError();
            if ($error_code === UPLOAD_ERR_NO_FILE) {
                return redirect()->back()->with('errors', ['No file uploaded']);
            }
            throw new RuntimeException($file->getErrorString() . " " . $error_code);
        }
        if ($file->getSizeByUnit('mb') > 2) {
            return redirect()->back()->with('errors', ['file size too large']);
        }
        // dd($file->getRealPath());
        if (!in_array($file->getMimeType(), ['image/png', 'image/jpg', 'image/jpeg'])) {
            return redirect()->back()->with('errors', ['unsupported file type']);
        }
        // we can specify path as 1st param and file name as 2nd param
        $path = $file->store('article_images'); //stored in writable/uploads with random name 

        $path = WRITEPATH . "uploads/" . $path;
        // dd($path);
        // E:\CI course\ciapp\writable\uploads/article_images/1713879460_ba893e322a197735539a.jpeg
        service('image')->withFile($path)->fit(200, 200, "center")->save($path);

        $article->image = $file->getName();
        $this->model->protect(false)->save($article);

        return redirect()->to("articles/$id")->with('message', 'image succesfully uploaded');
    }

    public function get($id)
    {
        $article = $this->getArticleOr404($id);
        if ($article->image) {
            $path = WRITEPATH . "uploads/article_images/" . $article->image;

            $finfo = new finfo(FILEINFO_MIME);
            $type = $finfo->file($path); // returns type of file

            // without setting type and length header we will just get a binary op from readfile like opening image in notepad
            header("Content-Type: $type");
            header("Content-Length: " . filesize($path));

            readfile($path);
            exit;
        }
    }

    public function delete($id) // lastmethod
    {
        $article = $this->getArticleOr404($id);

        $path = WRITEPATH . "uploads/article_images/" . $article->image;

        if ($article->image) {
            unlink($path);
        }

        $article->image = null;
        $this->model->protect(false)->save($article);

        return redirect()->to("articles/$id")->with('message', "image deleted");
    }

    private function getArticleOr404($id): ArticleEntity
    {
        $article = $this->model->find($id);
        if ($article === null) {
            throw new PageNotFoundException("The article with $id is not found");
        }
        return $article;
    }
}
