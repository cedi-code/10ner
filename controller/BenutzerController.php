<?php

require_once '../repository/BenutzerRepository.php';
require_once '../repository/BildRepository.php';
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
        $errors = [];
        if ($_POST['sendUser']) {

            $benutzername = $_POST['benutzername'];
            $email = $_POST['email'];
            $passwort = $_POST['passwort'];

            $userRepository = new BenutzerRepository();
            $imageRepository = new BildRepository();

            if(
                empty($benutzername) || 
                empty($email) || 
                empty($passwort)
            ){
                $errors['required_missing'] = 'Bitte fülle alle Formularfelder aus.';
            } else if ($userRepository->checkEmail($email) > 0) {
                $errors['email_exists'] = 'Diese Email existiert bereits.';
            }
            else if (strlen($benutzername) < 3) {
                $errors['name_lenght'] = 'Name brauch mindestens 3 Zeichen';
            }
            else if (strlen($passwort) < 3) {
                $errors['pw_lenght'] = 'Passwort brauch mindestens 3 Zeichen';
            }
            else {
                //Bild im Ordner /images/ abspeichern
                $file = $imageRepository->uploadImage($_FILES['profilbild'], $email);
                //Benutzer in der Datenbank erfassen (in der tabelle benutzer)
                $uid = $userRepository->create($benutzername, $email, $passwort);
                //Bild in der Datenbank erfassen (in der tabelle bild)
                $imageRepository->create($file, true, $uid, null);
            }
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