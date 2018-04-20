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
require_once '../repository/BewertungRepository.php';

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


        if(isset($_SESSION['uid'])) {

            $view = new View('rateView');
            $view->title = 'Rate';
            $view->heading = 'Rate';

            $uid = $usrrepo->getRandomId();
            $bid = $bildrepo->getProfilBildId($uid->ID_Ben);

            $isBewertet = $raterepo->checkBewerterBild($_SESSION['uid'],$bid);
            if($isBewertet > 0){
                $view->gleich = true;
            }else {
                $view->gleich = false;
                $view->bildId = $bid;
                $view->bewerterId = $uid->ID_Ben;
                $view->bildPfad = $bildrepo->getProfilBild($uid->ID_Ben);
            }

            $view->display();

        }else {
            header("Location: /login");
        }

    }
    public function ratePB() {
        if(isset($_POST['submitRate']) && isset($_SESSION['uid'])) {
            $raterepo = new BewertungRepository();

            $rate = $_POST['bewertung'];
            $bewerter = $_POST['buid'];
            $bid = $_POST['bid'];

            $raterepo->addBewertung($bid,$bewerter,$rate);

        }
        header("Location: /rate/index");
    }

}