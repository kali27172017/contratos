<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;


class ContractController extends BaseController{


     public function index(){
     	 return $this->render('contract.twig');
     }


}