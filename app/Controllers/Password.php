<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Password extends BaseController
{
    public function set()
    {
        return view('Password/set');
    }

    public function update()
    {
        $rules = [
            'password' => [
                'label' => 'Password',
                'rules' => 'required|strong_password'
            ],
            'password_confirm' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]'
            ]
        ];

        $result = $this->validate($rules);
        if (!$result) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }
        // echo "Valid Password"; // testing if validation is working

        $user = auth()->user(); // we get current user with this
        $user->password = $this->request->getPost('password'); // setting pw coming from the form

        $model = new UserModel(); // making a new usermodel to save the user
        $model->save($user); // saving user

        session()->removeTempdata('magicLogin');

        return redirect()->to('/')->with('message', 'password updated successfully');
    }
}
