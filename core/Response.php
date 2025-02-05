<?php

namespace oinia\core;

class Response
{
    public static function redirect(string $url)
    {
        header('Location: /' . $url);
        exit();
    }

    public static function renderView(string $name, string $layout = '', array $data = [])
    {
        // Asegurarnos de que $appUser esté disponible en todas las vistas
        if (!isset($data['appUser'])) {
            $data['appUser'] = App::get('appUser');
        }
        
        extract($data);
        
        ob_start();
        require __DIR__ . "/../app/views/$name.view.php";
        $content = ob_get_clean();
        
        if ($layout) {
            require __DIR__ . "/../app/views/layouts/$layout.view.php";
        } else {
            echo $content;
        }
    }
}
