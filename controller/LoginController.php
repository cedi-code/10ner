<?php

require_once '../lib/Repository.php';
require_once '../repository/BenutzerRepository.php';

class LoginController extends Repository
{
    private $errors = [];
    public function index() {
        $errors = [];
        $repo = new BenutzerRepository();

        if(isset($_POST['send'])) {
            if(!empty($_POST['email']) || !empty($_POST['passwort'])) {
                if($repo->checkEmail($_POST['email']) == 1) {
                    $rows = $repo->checkPW($_POST['passwort'],$_POST['email']);
                    if($rows !== false) {
                        $_SESSION['uid'] = $rows->ID_Ben;
                        $_SESSION['benutzername'] =  $rows->benutzername;
                        $_SESSION['email'] = $rows->email;
                        
                        header("Location: /profil/index");
                    }else {
                        $errors['pw_fail'] = "Falsches Passwort";
                    }
                }else {
                    $errors['email_fail'] = "Ungültige Email";
                }
            }else {
                $errors['fill_fail'] = "Bitte alle Felder ausfüllen!";
            }
        }else {
            // header("Location: /login");
            
        }
            $view = new View('user_login');
            $view->title = 'Login';
            $view->heading = 'Login';
            $view->errors = $errors;
            $view->display();
    }
}
