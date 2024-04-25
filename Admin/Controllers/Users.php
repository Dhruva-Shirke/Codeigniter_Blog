<?php

namespace Admin\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Exceptions\PageNotFoundException;


class Users extends BaseController
{
    private UserModel $model;

    public function __construct()
    {
        $this->model = new UserModel;
    }

    public function index()
    {
        // $users = $this->model->findAll(); // without pagination
        // $users = $this->model->paginate(2); // with pagination 2 pg
        helper('admin'); //loading helper
        $users = $this->model->orderBy('created_at')->paginate(4); // Ordering Records

        return view('Admin\Views\Users\index', ['users' => $users, 'pager' => $this->model->pager]); // for links to each page
    }

    public function show($id)
    {
        $user = $this->getUserOr404($id);

        return view('Admin\Views\Users\show', ['user' => $user]);
    }

    public function groups($id)
    {
        $user = $this->getUserOr404($id);
        if ($this->request->is('post')) {
            $groups = $this->request->getPost('groups') ?? [];
            $user->syncGroups(...$groups);
            return redirect()->to("admin/users/$id")->with('message', 'Group Successfully Updated');
        }

        return view("Admin\Views\Users\groups", ['user' => $user]);
    }

    public function permissions($id)
    {
        $user = $this->getUserOr404($id);
        if ($this->request->is('post')) {
            $permissions = $this->request->getPost('permissions') ?? [];
            $user->syncPermissions(...$permissions);
            return redirect()->to("admin/users/$id")->with('message', 'Permissions Successfully Updated');
        }

        return view("Admin\Views\Users\permissions", ['user' => $user]);
    }

    public function toggleBan($id)
    {
        $user = $this->getUserOr404($id);

        if ($user->isBanned()) {
            $user->unBan();
        } else {
            $user->ban();
        }
        return redirect()->back()->with('message', 'Status Updated');
    }

    private function getUserOr404($id): User
    {
        $user = $this->model->find($id);

        if ($user === null) {
            throw new PageNotFoundException("The user with id $id was not found");
        }

        return $user;
    }
}
