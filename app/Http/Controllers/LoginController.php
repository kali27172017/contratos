<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Views\View;
use App\Infraestructure\LoginRepository;


class LoginController extends Controller{

    
     public function  index(){
     	  $view  = new View('login_admin.twig');
     	  return $view->render();
     }


     public function showMessageLogin(){
    	$data  = $_POST;
    	$loginRepository = new LoginRepository();
    	return $loginRepository->ValidateResponse($data);	
    }




}