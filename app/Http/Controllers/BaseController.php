<?php
namespace App\Http\Controllers;
use Illuminate\Http\Response;

class BaseController
{

    public $templateEngine;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem('../views');
        $this->templateEngine = new \Twig_Environment($loader,[
            'debug' => true,
            'cache' => false
        ]);
    }

  
    public function render($template, array $params = [])
    {
         return $this->templateEngine->render($template,$params);

    }
}