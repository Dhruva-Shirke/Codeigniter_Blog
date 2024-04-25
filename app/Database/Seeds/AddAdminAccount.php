<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use App\Models\UserModel;

class AddAdminAccount extends Seeder
{
    public function run()
    {
        $user = new User([
            'email' => 'admin@example.com',
            'password' => 'admin@1234',
            'first_name' => 'DhruvaRaje'
        ]);

        $model = new UserModel();

        $model->save($user);

        $id = $model->getInsertID();

        $user = $model->findById($id);

        $user->activate();

        $user->addGroup('user', 'admin');
    }
}
