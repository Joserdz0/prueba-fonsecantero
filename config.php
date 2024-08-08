<?php
    $folderPath = dirname($_SERVER['SCRIPT_NAME']);
    $urlPath = $_SERVER['REQUEST_URI'];
    if (true) {
        
        $url = substr($urlPath,strlen($folderPath));
    }else{
        $url = $urlPath;
    }
    $arrayUrl = explode("?", $url);
    //Esta es la ruta con parametros
    define('URL',$url);
    //Aqui separamos ruta de parametros
    define('ARRAYURL',$arrayUrl);
    //Obtenemos la url de la pagina
    function baseurl ($path = '')
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $domainName = $_SERVER['HTTP_HOST'];

        $projectFolder = dirname($_SERVER['SCRIPT_NAME']);
        if ($projectFolder != explode("/", $_SERVER['REQUEST_URI'])[1]) {
        }
        $baseUrl = $protocol . $domainName . $projectFolder;

        if ($path) {
            $baseUrl .= '/' . ltrim($path, '/');
        }

        return $baseUrl;
    };
