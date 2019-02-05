<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 16.12.2018
 * Time: 14:04
 */

namespace app\utils;


class Storage
{

    private $storage = [];

    public function __get($key)
    {
        if(isset($this->storage[$key])){
            return $this->storage[$key];
        }//if

        return null;
    }//__get

    public function __set($key, $value)
    {
        if(isset($this->storage[$key])){
            $this->storage[$key] = $value;
            return 1;
        }//if

        return 0;
    }//__set

    public function SetStorage($arr){
        $this->storage = $arr;
    }//SetStorage

    public function GetStorage(){
        return $this->storage;
    }//GetStorage

}//Storage