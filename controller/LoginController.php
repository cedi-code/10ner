<?php

require_once '../lib/Repository.php';
require_once '../repository/BenutzerRepository.php';

class LoginController extends Repository
{
    private $errors = [];
    public function index() {
        $errors = [];
        $repo = new BenutzerRepository();

        // überprüft ob der submit button send betätigt wurde
        if(isset($_POST['send'])) {
            if(!empty($_POST['email']) || !empty($_POST['passwort'])) {

                // überprüft ob die Email existiert
                if($repo->checkEmail($_POST['email']) == 1) {

                    // überprüft ob das eingegebene Passwort mit dem Email übereinstimmt.
                    $rows = $repo->checkPW($_POST['passwort'],$_POST['email']);
                    if($rows !== false) {

                        // die Userid wird in der Session eingespeichert.
                        $_SESSION['uid'] = $rows->ID_Ben;
                        $_SESSION['benutzername'] =  $rows->benutzername;
                        $_SESSION['email'] = $rows->email;

                        // weiterleitung zur Account seite
                        header("Location: /profil/index");
                    }else {
                        $errors['pw_fail'] = "Wrong Password";
                    }
                }else {
                    $errors['email_fail'] = "Wrong Email";
                }
            }else {
                $errors['fill_fail'] = "Please fill in the void!";
            }
        }else {
            // header("Location: /login");
            
        }
            // View wird angezeigt, errors werden übergeben sind aber von default aus NULL.
            $view = new View('user_login');
            $view->title = 'Login';
            $view->heading = 'Login';
            $view->errors = $errors;
            $view->display();
    }
}
