<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Infraestructure\PanelRepository;


class PanelController extends BaseController{


    //Creo una unica instancia
    public function objPanel(){
        return new PanelRepository();   
    }


     public function index(){
            $facultades = $this->objPanel()->listFacultades();
            return $this->render('panel.twig',[
              'facultades' => $facultades
          ]);
     }




     public function actionCrud($id){
        $arreglo  = explode('-',$id);
        $id = $arreglo[0];
        $action  = $arreglo[1];

        if($action == "delete"){
            $bandera = $this->objPanel()->deleteFaculty($id);
            var_dump($bandera);
        }

       

     }





}