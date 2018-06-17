<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Infraestructure\ContractRepository;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;



class ContractController extends BaseController{


     public function index(){
     	   return $this->render('contract.twig');
     }



     public function searchTeacher(){
     	$dni = $_POST["dni"];
     	$teacherFound = new ContractRepository();
     	$teacher = $teacherFound->searchTeacherFound($dni);
        return $teacher;
     }



     public function saveContractTeacher(){
        $data = $_POST;
        $contract  = new ContractRepository();
        return $contract->saveContract($data);
     }


     public function loadContracGenerate(){
        
       	   $content = $this->render('contract_completo.php');
           $html2pdf = new Html2Pdf('P', 'A4', 'es','true','utf-8');
           $html2pdf->pdf->SetDisplayMode('fullpage');
           $html2pdf->writeHTML($content);
           $html2pdf->output('ejemplo.pdf');
     }

}