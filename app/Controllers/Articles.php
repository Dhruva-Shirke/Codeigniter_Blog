<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Entities\ArticleEntity;
use CodeIgniter\Exceptions\PageNotFoundException;

class Articles extends BaseController
{
    private ArticleModel $model;

    public function __construct()
    {
        $this->model = new ArticleModel();
    }
    public function index()
    {
        // $db = db_connect();  // to test db connection
        // $db->listTables();

        // $article = new ArticleMOdel();  // as we have made common Article Model in constructor
        // $data = $this->model->findAll();
        // $data = $this->model->select('article.*,users.first_name')->join('users', 'users.id=article.users_id')->findAll();
        $data = $this->model->select('article.*,users.first_name')->join('users', 'users.id=article.users_id')->orderBy('created_at')->paginate(3);

        return view('Articles/index.php', ['articles' => $data, 'pager' => $this->model->pager]);
        // return view('Articles/index.php', ['articles' => $data]);

        // $data = [['title'=>'PhoneGuru','content'=>'How to root phone'],['title'=>'Stock News','content'=>'Infosys Q4 results']]; // earlier method
        // return view('Articles/index.php',['title'=>'Articles']);
    }

    public function show($id)
    {
        // $model = new ArticleModel();
        $article = $this->getArticleOr404($id);
        // dd($article); // dump and die view data quickly and die
        return view('Articles/showArticle', ['article' => $article]);
    }

    public function new()
    {
        // login check for single method
        // if (!auth()->loggedIn()) {
        //     return redirect()->to('login')->with('message', 'Please login first');
        // }

        return view("Articles/new", ['article' => new ArticleEntity()]);
    }

    public function create()
    {
        // $model = new ArticleModel();
        $data = $this->request->getPost();
        $article = new ArticleEntity($data);
        $id = $this->model->insert($article);
        if ($id === false) {
            return redirect()->back()->with('errors', $this->model->errors())->withInput();
        }
        return redirect()->to("articles/$id")->with('message', 'Article Successfully Published');
        // dd($id);
        // dd($model->insertID);
        // $this->request->getPost(); // returns an assoc array
    }

    public function edit($id)
    {
        // $model = new ArticleModel();
        $article = $this->getArticleOr404($id);
        if (!($article->isOwner()) && !(auth()->user()->can('articles.edit'))) {
            return redirect()->to('articles')->with("message", "you are not authorized to edit other's article");
        }
        return view('Articles/edit', ['article' => $article]);
    }

    public function update($id)
    {
        // $model = new ArticleModel();
        // $article = $this->model->find($id); // without 404
        $article = $this->getArticleOr404($id);
        $article->fill($this->request->getPost());
        $article->__unset('_method');

        // earlier method without Article Entity 
        // note the below allows same data to be updated even if it isnt changed
        // $datarecieved = $this->request->getPost();
        // $result = $model->update($id, $datarecieved); //gives true if update successfull, false if unsuccessfull
        // if ($result == true) {

        if (!$article->hasChanged()) {
            return redirect()->back()->with('message', 'nothing to update');
        }

        if ($this->model->save($article)) {  // save doesnt allows same data to be updated ie if earlier title is hello we cant set it to hello will give error
            return redirect()->to("articles/$id")->with('message', 'Article Updated Successfully');
        }
        return redirect()->back()->with('errors', $this->model->errors())->withInput();
    }

    public function confirmDelete($id)
    {
        $article = $this->getArticleOr404($id);
        if (!($article->isOwner()) && !(auth()->user()->can('articles.delete'))) {
            return redirect()->to('articles')->with("message", "you are not authorized to delete other's article");
        }
        return view("Articles/delete", ['article' => $article]);
    }

    public function delete($id)
    {
        // $article = $this->getArticleOr404($id); // earlier combined non restful

        // if ($this->request->is("delete")) {  // is()used to check type of request  // earlier combined non restful
        $this->model->delete($id);
        return redirect()->to('articles')->with('message', 'Article Deleted');
        // }  // earlier combined non restful

        // return view('Articles/delete', ['article' => $article]);
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
