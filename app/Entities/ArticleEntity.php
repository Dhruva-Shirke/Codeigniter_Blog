<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ArticleEntity extends Entity
{
    public function isOwner()
    {
        return auth()->user()->id == $this->users_id;
    }
}
