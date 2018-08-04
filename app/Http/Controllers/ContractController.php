<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Infraestructure\ContractRepository;
use Spipu\Html2Pdf\Html2Pdf;




class ContractController extends BaseController{
      
     public $template = ''; 


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
             $contract = new ContractRepository();
             $infoContract = $contract->getInfoBenefit($id);

             $template  = $this->getTemplate($contract->getTypeBenefit($id));

             $nombre = ucfirst($infoContract[0]["nombre"]); 
             $apellido  = ucfirst($infoContract[0]["apellido"]);
             $dni  = $infoContract[0]["dni"];
             $nacimiento =  date("Y")  - date("Y", strtotime($infoContract[0]["fecha_nacimiento"]));  
             $domicilio = ucfirst($infoContract[0]["domicilio"]);
             $fechaInicio = $infoContract[0]["finicio_academico"]; 
             $fechaFin = $infoContract[0]["ffin_academico"];
             $facultad = $infoContract[0]["nom_facultad"];
             $escuela = $infoContract[0]["nom_escuela"];
             $ciclo = $infoContract[0]["ciclo_academico"];
             $fecha  = date("Y-m-d");

             $content = $this->render($template,['nombre' => $nombre,
                 'dni' => $dni , 'nacimiento' => $nacimiento,'domicilio' => $domicilio,
                 'apellido' => $apellido, 'finicio' => $fechaInicio,
                 'ffin' => $fechaFin,'facultad' => $facultad, 'escuela' => $escuela,
                 'ciclo' => $ciclo, 'fecha' => $fecha
             ]);

             $this->pdfGenerate($content);
     }





     public function getTemplate($type){
             if($type["tipo_prestacion"] == "Completo"){
                $this->template = 'contract_completo.twig';
             }else{
                $this->template = 'contract_parcial.twig';
             }
             return $this->template;
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