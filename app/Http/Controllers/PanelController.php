<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;


class PanelController extends BaseController{


     public function index(){
     	 return $this->render('panel.twig');
     }


}