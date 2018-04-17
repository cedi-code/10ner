<?php

require_once '../lib/Repository';

class LoginController extends Repository
{
    public function readByEmail($email)
    {

    }

    public function create()
    {
        $view = new View('user_login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }
}
