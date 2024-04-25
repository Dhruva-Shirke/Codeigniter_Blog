<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // return view('welcome_message'); demo view
        // return view('Home/index.php'); // our custom view

        // returning multiple view to reduce code repetition
        // return view('header',['title'=>'Home']) . view('Home/index.php'); // using old method ie include multiple views
        // $this->testEmail();
        if (session('magicLogin')) {
            return redirect()->to('/set-password')->with('message', 'please update your password');
        }

        return view('Home/index.php');
    }

    private function testEmail()
    {
        $email = \Config\Services::email();

        $email->setTo('recipient@example.com'); // set recipient
        $email->setSubject('Test Email'); // subject vishay
        $email->setMessage('Hello From <b>Articles Codeigniter</b>'); // message
        $result = $email->send();
        if ($result) {
            echo "email sent";
        } else {
            echo "email not sent";
        }
    }
}
