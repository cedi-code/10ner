<?php

require_once '../lib/Repository.php';
require_once '../repository/BenutzerRepository.php';

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
        $repo = new BenutzerRepository();
        if(isset($_POST['send'])) {
            if($repo->checkEmail($_POST['email']) == 1) {
                $rows = $repo->checkPW($_POST['passwort'],$_POST['email']);
                if($rows !== false) {
                    @session_start();
                    $_SESSION['uid'] = $rows['ID_Ben'];
                    $_SESSION['benutzername'] =  $rows['benutzername'];
                }else {

                }
            }else {

            }

        }else {
            header("Location: /login");
        }
    }
}
