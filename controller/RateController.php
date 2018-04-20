<?php
/**
 * Created by PhpStorm.
 * User: bgirac
 * Date: 17.04.2018
 * Time: 14:37
 */
require_once '../lib/Repository.php';
require_once '../repository/BenutzerRepository.php';
require_once '../repository/BildRepository.php';

class RateController
{
    public function index()
    {
        // In diesem Fall möchten wir dem Benutzer die View mit dem Namen
        //   "default_index" rendern. Wie das genau funktioniert, ist in der
        //   View Klasse beschrieben.
        $bildrepo = new BildRepository();
        $usrrepo = new BenutzerRepository();
        $raterepo = new BewertungRepository();

        @session_start();
        if(isset($_SESSION['uid'])) {
            if(isset($_POST['bewertung'])) {


            }
            $view = new View('rateView');
            $view->title = 'Rate';
            $view->heading = 'Rate';

            $uid = $usrrepo->getRandomId();
            $result = $raterepo->checkBewerterBild($_SESSION['uid'],$bildrepo->getProfilBildId($uid));
            var_dump();
            // if($raterepo->checkBewerterBild($_SESSION['uid'],$bildrepo->getProfilBildId($uid)))
            $view->bildPfad = $bildrepo->getProfilBild($uid->ID_Ben);
            $view->display();
        }else {
            header("Location: /login");
        }

    }

}