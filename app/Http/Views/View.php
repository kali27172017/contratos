<?php
namespace App\Http\Views;


use Illuminate\Http\Response;

class View
{
    private $template;

    private $params;

    public $templateEngine;

    public function __construct($template, array $params = [])
    {
        $loader = new \Twig_Loader_Filesystem('../views');
        $this->templateEngine = new \Twig_Environment($loader,[
            'debug' => true,
            'cache' => false
        ]);
        $this->template = $template;
        $this->params = $params;
    }

  
    public function render()
    {
         return $this->templateEngine->render($this->template,$this->params);

    }
}