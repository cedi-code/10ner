<?php

require_once '../repository/BenutzerRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class BenutzerController
{
    public function index()
    {
        $userRepository = new BenutzerRepository();

        $view = new View('user_index');
        $view->title = 'Benutzer';
        $view->heading = 'Benutzer';
        $view->benutzer = $userRepository->readAll();
        $view->display();
    }

    public function create()
    {
        $view = new View('user_create');
        $view->title = 'Benutzer erstellen';
        $view->heading = 'Benutzer erstellen';
        $view->display();
    }

    public function doCreate()
    {
        if ($_POST['send']) {
            $benutzername = $_POST['benutzername'];
            $email = $_POST['email'];
            // $password  = $_POST['password'];
            $passwort = 'no_password';

            $userRepository = new BenutzerRepository();
            $userRepository->create($benutzername, $email, $passwort);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /benutzer');
    }

    public function delete()
    {
        $userRepository = new BenutzerRepository();
        $userRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /benutzer');
    }
}
