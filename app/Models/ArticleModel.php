<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'article';
    protected $allowedFields = ['title', 'content']; // only these fields allowed to inserted in db
    protected $returnType = \App\Entities\ArticleEntity::class;
    protected $validationRules = [
        'title' => 'required|max_length[128]',
        'content' => 'required'
    ];

    protected $validationMessages = [
        'title' => ['required' => 'Please enter the {field} of the article', 'max_length' => 'Please enter less than {param} characters']
    ];

    protected $useTimestamps = true;

    protected $beforeInsert = ["setUsersID"];

    protected function setUsersID(array $data)
    {
        $data['data']['users_id'] = auth()->user()->id;
        return $data;
    }
}
