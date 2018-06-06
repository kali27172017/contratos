<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\BaseController;


class DashboardController extends BaseController{

	public function index(){	
		  $usuario  = $_SESSION["admin"];
		  return $this->render('dashboard.twig',['usuario' => $usuario]);
	}

	public function exit(){
		return $this->render('login_admin.twig');
	}
}
