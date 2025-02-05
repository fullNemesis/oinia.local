<?php
namespace oinia\core;

class Response {
    public static function renderView(string $name, string $layout = 'layout', array $data = []) {
        // Limpiar cualquier salida previa
        if (ob_get_level()) {
            ob_end_clean();
        }
        
        // Iniciar nuevo buffer
        ob_start();
        
        // Extraer los datos para que estén disponibles en la vista
        extract($data);
        
        // Asegurarnos de que $app esté disponible y tenga la URI actual
        global $app;
        if (!isset($app)) {
            $app = [];
        }
        if (!isset($app['uri'])) {
            $app['uri'] = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        }
        
        // Capturar el contenido de la vista
        require "app/views/$name.view.php";
        $mainContent = ob_get_clean();
        
        // Iniciar nuevo buffer para el layout
        ob_start();
        require "app/views/$layout.view.php";
        $output = ob_get_clean();
        
        // Enviar la salida
        echo $output;
    }

    public static function renderPartial(string $name, array $data = []) {
        extract($data);
        require "app/views/$name.view.php";
    }

    /**
     * Redirige a una URL específica
     * @param string $url URL a la que redirigir
     */
    public static function redirect(string $url) {
        if (ob_get_level()) {
            ob_end_clean();
        }
        if (!headers_sent()) {
            if (!str_starts_with($url, '/')) {
                $url = '/' . $url;
            }
            header('Location: ' . $url);
            exit;
        }
    }
} 