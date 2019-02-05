<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 16.12.2018
 * Time: 14:02
 */

namespace app\core;


use app\utils\MySQL;
use app\utils\Request;
use app\utils\Storage;
use app\controllers\HomeController;


class Route extends BaseController
{
    private $abr;
    private $attrib;
    private $path;
    private $routes;
    public function __construct()
    {
        $this->storage = new Storage();
        //$this->request = new Request();
        $this->path = '';
        $this->abr = '';
        $this->attrib = null;
        $this->routes = include_once '../app/models/routing.php';
    }//__construct

    //public function SetRequest($request){
       // $this->request = $request;
    //}//SetRequest

    public function SetPath($path){

        $currentPathArray = explode('/', $path);
        $method = $_SERVER['REQUEST_METHOD'];
        if(!$currentPathArray[3]){
            $currentPathArray[3] = 'home';
        }
        $rout = $currentPathArray[3];

        if(isset($this->routes[$method][$rout])){
            $this->path = $path;
            if(!$currentPathArray[4]){
                $currentPathArray[4] = 'index';
            }
            $action = $currentPathArray[4];
            $this->abr = $this->routes[$method][$rout][$action];

            if(isset($currentPathArray[5])) {
                $this->attrib = $currentPathArray[5];
            }


        }//if

        //$currentPath = 'C:/xampp/htdocs/EPCH/'.'app'.'/'.'controllers'.'/'."{$currentPathArray[3]}Controller".'.'.'php';

        //echo $currentPath;
       // if(is_file($currentPath)){
            //$this->path = $path;
           // $this->filePath = $currentPath;
        //}//if
        else{
            echo new \Exception ('Invalid controller path: `' . $path . '`');
        }//else
        
    }//SetPath

    private function GetController(&$file, &$controller, &$action, &$args){


        $currentPathArray = explode('@',$this->abr);

        $file = 'C:/xampp/htdocs/EPCH/'.'app'.'/'.'controllers'.'/'."{$currentPathArray[0]}".'.'.'php';

        $controller = $currentPathArray[0];

        $action = $currentPathArray[1];

        $args = $this->attrib;

    }//GetController

    public function Start(){
       // $controller_name = "Authorise";
        //$action_name = "index";



        MySQL::$db = new \PDO(
            "mysql:dbname=uap;host=127.0.0.1;charset=utf8",
            "root",
            ""
        );

        $this->GetController($file, $controller, $action, $args);

        // Проверка существования файла, иначе 404
        if (is_readable($file) == false) {
            echo new \Exception ('404 Not Found:: `' .$file . '`');
        }//if

        // Подключаем файл
        include ("$file");

        // Создаём экземпляр контроллера
        $controllerString = "app\\controllers\\$controller";
        $controller = new $controllerString();

        $storage = new Storage();
        $storage->SetStorage($args);

        $controller->SetStorage($storage);


        // Если экшен не существует - 404
        if (is_callable(array($controller, $action)) == false) {
            echo new \Exception ('Action Not Found: `' .$action . '`');
        }

        if($this->attrib){
            // Выполняем экшен
            $controller->$action($this->attrib);

        }
        else{
            // Выполняем экшен
            $controller->$action();
        }



    }//Start


}//Route