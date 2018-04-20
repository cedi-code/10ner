<?php
/**
 * Created by PhpStorm.
 * User: bgirac
 * Date: 20.04.2018
 * Time: 11:15
 */

require_once '../lib/Repository.php';
class ExploreController
{
    // zeigt die ExplorerView an. Leider hatten wir zuwenig zeit dies zu vervolständigen.
    public function index() {
        $view = new View('exploreView');
        $view->title = '10ner';
        $view->heading = 'Explore';
        $view->display();
    }

}