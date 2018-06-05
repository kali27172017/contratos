<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Views\View;


class DashboardController extends Controller{

	public function index(){
		  $view = new View('dashboard.twig');
           return $view->render();
	}

	public function exit(){
		  $view  = new View('login_admin.twig');
     	  return $view->render();
	}
}
