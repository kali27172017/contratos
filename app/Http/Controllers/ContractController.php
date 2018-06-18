<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Infraestructure\ContractRepository;
use Spipu\Html2Pdf\Html2Pdf;




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



     public function loadContractGenerate($id){

            /*Obtener datos del docente para el Contrato*/

             $contract = new ContractRepository();
             $infoContract = $contract->getInfoBenefit($id);

            /*Datos enviados al Contrato*/
             $nombre = $infoContract[0]["nombre"];
             $apellido  = $infoContract[0]["apellido"];
             $dni  = $infoContract[0]["dni"];
             $domicilio = $infoContract[0]["domicilio"];
             $fechaInicio = $infoContract[0]["finicio_academico"]; 
             $fechaFin = $infoContract[0]["ffin_academico"];
             $facultad = $infoContract[0]["nom_facultad"];
             $escuela = $infoContract[0]["nom_escuela"];
             $ciclo = $infoContract[0]["ciclo_academico"];
             $fecha  = date("Y-m-d");

             $content = $this->render('contract_completo.twig',['nombre' => $nombre,
                 'dni' => $dni , 'domicilio' => $domicilio,
                 'apellido' => $apellido, 'finicio' => $fechaInicio,
                 'ffin' => $fechaFin,'facultad' => $facultad, 'escuela' => $escuela,
                 'ciclo' => $ciclo, 'fecha' => $fecha
             ]);

             $this->pdfGenerate($content);
     }




     public function pdfGenerate($content) {
         try
          {
             $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3);
             $html2pdf->pdf->SetDisplayMode('fullpage');
             $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
             return $html2pdf->Output('contrato.pdf');
          }
          catch(HTML2PDF_exception $e) {
             echo $e;
             exit;
         }
     }



}