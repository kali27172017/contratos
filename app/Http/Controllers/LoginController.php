<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\BaseController;
use App\Infraestructure\LoginRepository;


class LoginController extends BaseController{

     public function  index(){
		 return $this->render('login_admin.twig');
     }


     public function showMessageLogin(){
    	$data  = $_POST;
    	$loginRepository = new LoginRepository();
    	return $loginRepository->ValidateResponse($data);
    }




}