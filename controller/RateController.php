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
        $raterepo = new RateController();

        @session_start();
        if(isset($_SESSION['uid'])) {
            if(isset($_POST['bewertung'])) {


            }
            $view = new View('rateView');
            $view->title = 'Rate';
            $view->heading = 'Rate';

            // $uid = $usrrepo->getRandomId();
            // if($raterepo->checkBewerterBild($_SESSION['uid'],$bildId))
            // $view->bildPfad = $bildrepo->getProfilBild($uid);
            $view->display();
        }else {
            header("Location: /login");
        }

    }

}