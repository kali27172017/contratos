<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;


class HistoryController extends BaseController{


     public function index(){
     	 return $this->render('history.twig');
     }


}