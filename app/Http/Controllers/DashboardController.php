<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\BaseController;
use App\Infraestructure\GradoRepository;
use App\Infraestructure\EscuelaRepository;
use App\Infraestructure\DashboardRepository;



class DashboardController extends BaseController{

	public function index(){
		 if(isset($_SESSION)  && !empty($_SESSION)){
			$usuario  = $_SESSION['administrador'];
			$fecha  = date("Y-m-d");
			$grados  =  new GradoRepository();
			$escuelas = new EscuelaRepository();
  
			return $this->render('dashboard.twig',['usuario' => $usuario,'fecha' => $fecha,
			  'grados' => $grados->listGrados(),
			  'escuelas' => $escuelas->listEscuelas() 	
			]);
		 }else{
			header("Location:http://localhost:8080/contratos/public/ ");
			exit;
		 }
		
		
	}



	public function registerTeacher(){
        $teacher  = new DashboardRepository();
        return $bandera = $teacher->insertTeacher($_POST);
	}



	public function exit(){
		return $this->render('login_admin.twig');
	}
}
