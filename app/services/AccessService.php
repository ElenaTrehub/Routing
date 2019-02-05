<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 24.12.2018
 * Time: 15:50
 */

namespace app\services;




use app\utils\MySQL;

class AccessService
{

    public function AddAccess($title){

        $stm = MySQL::$db->prepare("INSERT INTO accesslevels VALUES(DEFAULT , :accessTitle)");
        $stm->bindParam(':accessTitle', $title, \PDO::PARAM_STR );
        $stm->execute();

        return MySQL::$db->LastInsertID();

    }//AddAccess

    public function GetAccesses(){

        $stm= MySQL::$db->prepare("SELECT * FROM accesslevels");
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_OBJ);

    }//GetAccesses

    public function DeleteAccessById($id){

        $stm = MySQL::$db->prepare("DELETE FROM accesslevels WHERE accessID = :id");

        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $result = $stm->execute();

        return $result;

    }//DeleteAccessById

    public function GetAccessByID($id){

        $stm = MySQL::$db->prepare("SELECT * FROM accesslevels WHERE accessID = :id ");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        return  $stm->fetch(\PDO::FETCH_OBJ);

    }//GetAccessByID

    public function UpdateAccess($id, $title){
        $stm = MySQL::$db->prepare("UPDATE accesslevels SET accessTitle = :title WHERE accessID = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->bindParam(':title', $title, \PDO::PARAM_STR);
        $result= $stm->execute();

        return  $result;
    }//UpdateAccess

}//AccessService