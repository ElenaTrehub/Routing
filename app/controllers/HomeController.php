<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 16.12.2018
 * Time: 16:42
 */

namespace app\controllers;


use app\core\BaseController;

class HomeController extends BaseController
{

    public function indexAction (){


        $template = $this->twig->load('Home/index.twig');
        echo $template->render();
    }//indexAction

}//HomeController