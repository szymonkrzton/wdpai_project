<?php

class AppController {

    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isPost(): bool {
        return $this->request === 'POST';
    }

    protected function isGet(): bool {
        return $this->request === 'GET';
    }

    protected function render(string $filename = null, array $variables = []) {

        session_start();
        if((isset($_SESSION['logged']) && $_SESSION['id_permission'] == 1 && $filename == 'addMovie') || (($filename == 'login' || $filename == 'register' || isset($_SESSION['logged'])) && $filename != 'addMovie')){
            $filepath = 'public/views/'.$filename.'.php';
            $output = "Page not found.";

            if(file_exists($filepath)) {

                extract($variables);

                ob_start();
                include $filepath;
                $output = ob_get_clean();
            }
            print $output;
        } else {
            echo "You have no permission to visit this page.";
        }
    }
}