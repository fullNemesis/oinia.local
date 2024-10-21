<?php
    require_once __DIR__.'/../../src/entity/asociado.class.php';
    
    $asociadosLogos[] = new Asociado('About','about_us.jpg','Sobre nosotros');
    $asociadosLogos[] = new Asociado('Contacto','contact_background.jpg','Fondo contacto');
    $asociadosLogos[] = new Asociado('Contacto1','contact_background1.jpg','Fondo contacto 2');

    require_once(__DIR__ . '/../../src/entity/imagen.class.php');

    $imagenesHome[] = new Imagen ('1.jpg','descripción imagen 1',1,456,610,130);
    $imagenesHome[] = new Imagen ('2.jpg','descripción imagen 2',1,456,610,130);
    $imagenesHome[] = new Imagen ('3.jpg','descripción imagen 3',1,456,610,130);
    $imagenesHome[] = new Imagen ('4.jpg','descripción imagen 4',1,456,610,130);
    $imagenesHome[] = new Imagen ('5.jpg','descripción imagen 5',1,456,610,130);
    $imagenesHome[] = new Imagen ('6.jpg','descripción imagen 6',1,456,610,130);
    $imagenesHome[] = new Imagen ('7.jpg','descripción imagen 7',1,456,610,130);
    $imagenesHome[] = new Imagen ('8.jpg','descripción imagen 8',1,456,610,130);
    $imagenesHome[] = new Imagen ('9.jpg','descripción imagen 9',1,456,610,130);
    $imagenesHome[] = new Imagen ('10.jpg','descripción imagen 10',1,456,610,130);
    $imagenesHome[] = new Imagen ('11.jpg','descripción imagen 11',1,456,610,130);
    $imagenesHome[] = new Imagen ('12.jpg','descripción imagen 12',1,456,610,130);

    require __DIR__ . '/../views/index.view.php';
