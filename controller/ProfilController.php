<?php
require_once '../repository/BenutzerRepository.php';
require_once '../repository/BildRepository.php';
/**
 * Created by PhpStorm.
 * User: bgirac
 * Date: 19.04.2018
 * Time: 08:17
 */

class ProfilController
{
    public function index()
    {
        $userRepository = new BenutzerRepository();
        $imageRepository = new BildRepository();
        // In diesem Fall möchten wir dem Benutzer die View mit dem Namen
        //   "default_index" rendern. Wie das genau funktioniert, ist in der
        //   View Klasse beschrieben.

        if(isset($_SESSION['uid'])) {
            if(isset($_POST['upload'])) {
                $file = $imageRepository->uploadImage($_FILES['uploadImage'], $_SESSION['email']);
                $imageRepository->addImage($_SESSION['uid'], $file);
            }

            $view = new View('user_edit');
            $view->title =  $_SESSION['benutzername'];
            $view->heading = $_SESSION['benutzername'];
            $view->bilder = $imageRepository->getEveryImage($_SESSION['uid']);
            $view->display();
        }else {
            session_destroy();
            header("Location: /");
        }
    }
    public function logout() {
        @session_start();
        session_destroy();
        header("Location: /login");
    }

    public function doUpdate()
    {

        $errors = [];
        if ($_POST['updateUser']) {

            $benutzername = $_POST['benutzername'];
            $passwort = $_POST['passwort'];

            $userRepository = new BenutzerRepository();
            $imageRepository = new BildRepository();

            if (strlen($benutzername) < 3) {
                $errors['name_lenght'] = 'Name brauch mindestens 3 Zeichen';
            }
            else if (strlen($passwort) < 3) {
                $errors['pw_lenght'] = 'Passwort brauch mindestens 3 Zeichen';
            }
            else {
                //Bild im Ordner /images/ abspeichern
                $file = $imageRepository->uploadImage($_FILES['profilbild'], $_SESSION['email']);
                //Benutzer in der Datenbank updaten (in der tabelle benutzer)
                $uid = $userRepository->update($benutzername, $passwort, $file);
                //Bild in der Datenbank updaten (in der tabelle bild)
                $imageRepository->update($uid, $file);
            }
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        //if (empty($errors)) {
        //    header('Location: /profil');
        //    exit;
        //}

        $view = new View('user_name_pw_edit');
        $view->title = 'Benutzer bearbeiten';
        $view->heading = 'Benutzer bearbeiten';
        $view->errors = $errors;
        $view->display();

    }
}