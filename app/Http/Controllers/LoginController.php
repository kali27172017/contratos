<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Views\View;

class LoginController extends Controller{

    
     public function  index(){
     	  $view  = new View('login_admin');
     	  return $view->render();
     }


    public function prueba(){
    	return 'HOLA POST';
    }

}