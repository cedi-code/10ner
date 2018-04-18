<?php

require_once '../lib/Repository.php';

class LoginController extends Repository
{

    public function readByEmail($email)
    {

    }
    public function index() {
        $view = new View('user_login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function login()
    {
        $view = new View('user_login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }
    public function checkLogin() {
        
    }
}
