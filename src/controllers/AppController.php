<?php

class AppController
{

    private $requestType;

    public function __constructor()
    {
        $this->requestType = $_SERVER['REQUEST_METHOD'];
    }

    public function isPOST() : bool
    {
        return $this->requestType === 'POST';
    }

    public function isGET() : bool
    {
        return $this->requestType === 'GET';
    }

    protected function render(string $template = null, array $variables = [])
    {
        $template_path = 'public/views/'.$template.'.php';
        $output = 'File not found!';
        
        if(file_exists($template_path))
        {
            extract($variables);

            ob_start();
            include $template_path;
            $output = ob_get_clean();
        }

        print $output;

    }

}