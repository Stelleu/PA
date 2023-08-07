<?php

namespace App\Core;

use JetBrains\PhpStorm\NoReturn;

class Error
{
    #[NoReturn] public  function errorRedirection($codeError): void
    {
        http_response_code($codeError);
        $view = new View("Error/".$codeError, "error");
        $view->assign("title", " Error ".$codeError);
        exit();

    }

}