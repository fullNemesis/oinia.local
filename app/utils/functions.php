<?php

/**
 * Renderiza una vista
 * @param string $name Nombre de la vista
 * @param array $data Datos para pasar a la vista
 * @return string
 */
function view($name, $data = [])
{
    // Extraer los datos para que estén disponibles en la vista
    if (is_array($data)) {
        extract($data);
    }

    // Incluir el header
    require __DIR__ . '/../views/header.part.php';

    // Incluir la navegación
    require __DIR__ . '/../views/navegacion.part.php';

    // Incluir la vista principal
    require __DIR__ . "/../views/{$name}.view.php";

    // Incluir el footer
    require __DIR__ . '/../views/footer.part.php';
} 