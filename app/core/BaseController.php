<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 12.01.2019
 * Time: 15:00
 */

namespace app\core;

use app\utils\Request;
use app\utils\Storage;

use Twig_Loader_Filesystem;
use Twig_Environment;



abstract class BaseController
{
    protected $request;
    protected $storage;

    protected $loader;
    protected $twig;

    public function __construct()
    {
        $this->storage = new Storage();
        $this->request = new Request();

        $this->loader = new Twig_Loader_Filesystem('../app/templates');
        $this->twig = new Twig_Environment($this->loader);
    }//__construct

    protected function GetStorage(){
        return $this->storage;
    }//GetStorage

    protected function SetStorage($storage){
        $this->storage = $storage;
    }//SetStorage

    protected function json( $code , $data ){

        http_response_code($code);
        header('Content-type: application/json');
        echo json_encode($data); //  res.send();
        exit();

    }//json

}//BaseController
