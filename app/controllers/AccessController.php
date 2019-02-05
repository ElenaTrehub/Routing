<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 24.12.2018
 * Time: 15:48
 */

namespace app\controllers;

use app\core\BaseController;
use app\services\AccessService;

class AccessController extends BaseController{

    public function GetAccessesListAction(){

        $template = $this->twig->load('Access/access-list.twig');

        $accessService = new AccessService();
        $result = $accessService->GetAccesses();

        echo $template->render(array(
            'accesses'=>$result,
        ));

    }//GetAccessesListAction

    public function AddAccessAction(){

        $title = $this->request->GetPostValue('name');
        $accessService= new AccessService();

        $result = $accessService->AddAccess($title);


        $this->json( 200, array(
                'accessId'=>$result,
                'code'=>200,
            )

        );

    }//AddAccess

    public function DeleteAccessAction(){

        $accessId = $this->request->GetPostValue('accessId');

        $accessService= new AccessService();

        $result = $accessService->DeleteAccessById($accessId);

        if($result){
            $this->json(200, array(
                'code'=>200,
                'res'=>$result,
            ));
        }//if
        else{
            $this->json(400, array(
                'code'=>400,
                'res'=>$result,
            ));
        }

    }//DeleteAccessAction

    public function UpdatePageAction($id){

        $template = $this->twig->load('Access/updateAccess.twig');
        $accessService = new AccessService();

        $accessLevel = $accessService->GetAccessByID($id);

        echo $template->render(array(
            'access'=> $accessLevel,
            'id'=>$id,
        ));
    }//UpdatePageAction

    public function UpdateAccessAction(){

        $id = $this->request->GetPostValue('id');
        $title = $this->request->GetPostValue('name');

        $accessService= new AccessService();

        $result = $accessService->UpdateAccess($id, $title);

        if($result===true){
            $this->json( 200, array(
                'status' => 200,
                'accessId'=>$result,
            ) );
        }//if

        else{
            $this->json( 400, array(
            'status' => 400,
            'accessId' => 0,
            ) );
            }



    }//UpdateAccessAction

}//AccessController