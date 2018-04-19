<?php
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
        // In diesem Fall möchten wir dem Benutzer die View mit dem Namen
        //   "default_index" rendern. Wie das genau funktioniert, ist in der
        //   View Klasse beschrieben.
        @session_start();
        if(isset($_SESSION['uid'])) {
            $view = new View('user_edit');
            $view->title =  $_SESSION['benutzername'];
            $view->heading = $_SESSION['benutzername'];
            $view->display();
        }else {
            header("Location: /");
        }

    }
    public function logout() {
        session_start();
        session_destroy();
        header("Location: /login");
    }
}