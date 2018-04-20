<?php

require_once '../repository/BenutzerRepository.php';
require_once '../repository/BildRepository.php';
/**
 * Siehe Dokumentation im DefaultController.
 */
class BenutzerController
{
    // zeigt die Seite user_create an
    public function index()
    {
        $view = new View('user_create');
        $view->title = 'create User';
        $view->heading = 'create User';
        $view->errors = [];
        $view->display();
    }

    // hollt die Daten vom Form ein und überprüft diese nach Fehler
    public function doCreate()
    {
        $errors = [];
        // überprüft ob der submitbutton sendUser betätigt wurde
        if ($_POST['sendUser']) {

            $benutzername = $_POST['benutzername'];
            $email = $_POST['email'];
            $passwort = $_POST['passwort'];

            $userRepository = new BenutzerRepository();
            $imageRepository = new BildRepository();

            // fehlermeldungen werden überprüft
            if(
                empty($benutzername) || 
                empty($email) || 
                empty($passwort)
            ){
                $errors['required_missing'] = 'Pleae Fill in the obligatory fields.';
            } else if ($userRepository->checkEmail($email) > 0) {
                $errors['email_exists'] = 'This E-mail already exists.';
            }
            else if (strlen($benutzername) < 3) {
                $errors['name_lenght'] = 'Your Nickname needs at least 3 characters';
            }
            else if (strlen($passwort) < 3) {
                $errors['pw_lenght'] = 'Your Password needs at least 3 characters';
            }
            else {
                //Speichert und ändert den Pfad des Profilbildes in der Tabelle Bilder
                $file = $imageRepository->uploadImage($_FILES['profilbild'], $email);

                // Die Userdaten werden in der Datenbank gespeichert
                $uid = $userRepository->create($benutzername, $email, $passwort);

                // Erstellt einen Pfad im rootdirectory für das Bild wo es dann hochgeladen wird.
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


}