<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 16.12.2018
 * Time: 14:04
 */

namespace app\utils;


class Request
{
    public function GetGetValue($key){
        if(isset($_GET[$key])){
            return $_GET[$key];
        }//if
        return null;
    }//GetGetValue

    public function GetPostValue($key){
        if(isset($_POST[$key])){
            return $_POST[$key];
        }//if
        return null;
    }//GetPostValue



}//Request