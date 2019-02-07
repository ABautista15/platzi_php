<?php 
    namespace App\Controllers;

    use Zend\Diactoros\Response\HtmlResponse;
    class BaseController {
        protected $templateEngine;

        public function __construct(){
            $loader = new \Twig_Loader_Filesystem('../views');
            $this->templateEngine = new \Twig_Environment($loader, [
                'debug' => true,
                'cache' => false,
            ]);
        }

        public function renderHTML($file, $data = []){
            return new HtmlResponse($this->templateEngine->render($file, $data));
        }
    }