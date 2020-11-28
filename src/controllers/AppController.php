<?php

class AppController {

    protected function render(string $template = null)
    {
        $template_path = 'public/views/'.$template.'.html';
        $output = 'File not found!';
        
        if(file_exists($template_path))
        {
            ob_start();
            include $template_path;
            $output = ob_get_clean();
        }

        print $output;

    }

}