<?php

namespace oinia\app\exceptions;

use Exception;
use oinia\core\Response;

class AppException extends Exception
{
    public function __construct(string $message = "", int $code = 500)
    {
        parent::__construct($message, $code);
    }
    private function getHttpHeaderMessage()
    {
        switch ($this->getCode()) {
            case 404:
                return '404 Página no encontrada';
            case 403:
                return '403 Prohibido el acceso';
            case 500:
                return '500 Error interno del servidor';
            default:
                return '500 Error interno del servidor';
        }
    }
    public function handleError()
    {
        try {
            // Limpiar cualquier salida previa
            if (ob_get_level()) {
                ob_end_clean();
            }
            
            // Iniciar nuevo buffer
            ob_start();
            
            $httpHeaderMessage = $this->getHttpHeaderMessage();
            header('HTTP/1.1 ' . $httpHeaderMessage, true, $this->getCode());
            
            $errorMessage = $this->getMessage();
            Response::renderView(
                'error',
                'layout',
                compact('httpHeaderMessage', 'errorMessage')
            );
        } catch (Exception $exception) {
            if (ob_get_level()) {
                ob_end_clean();
            }
            die('Se ha producido un error en nuestro manejador de excepciones');
        }
    }
}
