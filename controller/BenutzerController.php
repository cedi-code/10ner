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
        $view->display();
    }

    public function doCreate()
    {
        if ($_POST['sendUser']) {
            $benutzername = $_POST['benutzername'];
            $email = $_POST['email'];
            $password  = $_POST['password'];

            $userRepository = new BenutzerRepository();
            if ($userRepository->checkEmail($email) == 1) {
                echo "<script>alert('Email schon vergeben!');</script>";
            }
            else if($benutzername) {
                echo "<script>alert('');</script>";
            }
            $userRepository->create($benutzername, $email, $passwort);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /login');
    }

    public function delete()
    {
        $userRepository = new BenutzerRepository();
        $userRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /benutzer');
    }
}
