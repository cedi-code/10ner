<?php

require_once '../repository/BenutzerRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class BenutzerController
{
    public function index()
    {
        $view = new View('user_create');
        $view->title = 'Benutzer erstellen';
        $view->heading = 'Benutzer erstellen';
        $view->errors = [];
        $view->display();
    }

    public function doCreate()
    {

<<<<<<< HEAD
        $errors = [];
=======
>>>>>>> e4e4c3ac3f34f50a68d448dda7667febdfc8adce
        if ($_POST['sendUser']) {

            $benutzername = $_POST['benutzername'];
            $email = $_POST['email'];
<<<<<<< HEAD
            $passwort = $_POST['passwort'];
=======
            $password  = $_POST['passwort'];
>>>>>>> e4e4c3ac3f34f50a68d448dda7667febdfc8adce
            $userRepository = new BenutzerRepository();
            $regexEmail = "^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$";

            if(
                empty($benutzername) || 
                empty($email) || 
                empty($passwort)
            ){
                $errors['required_missing'] = 'Bitte fülle alle Formularfelder aus.';
            } else if ($userRepository->checkEmail($email) > 0) {
                $errors['email_exists'] = 'Diese Email existiert bereits.';
            }
            else if (!preg_match($regexEmail, $email)) {
                $errors['email_regex'] = 'Ungültige Email-Adresse';
            }
            else if (strlen($benutzername) < 3) {
                $errors['name_lenght'] = 'Name brauch mindestens 3 Zeichen';
            }
            else if (strlen($passwort) < 3) {
                $errors['pw_lenght'] = 'Passwort brauch mindestens 3 Zeichen';
            }
             else {
                $userRepository->create($benutzername, $email, $passwort);
            }
<<<<<<< HEAD
=======
            $userRepository->create($benutzername, $email, $password);

>>>>>>> e4e4c3ac3f34f50a68d448dda7667febdfc8adce
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        if (empty($errors)) {
            header('Location: /login');
            exit;
        }

        $view = new View('user_create');
        $view->title = 'Benutzer erstellen';
        $view->heading = 'Benutzer erstellen';
        $view->errors = $errors;
        $view->display();

    }

    public function delete()
    {
        $userRepository = new BenutzerRepository();
        $userRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /benutzer');
    }
}
