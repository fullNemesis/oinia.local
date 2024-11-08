<?php

    $router->get ('', 'PagesController@index');
    $router->get ('about', 'PagesController@about');
    $router->get ('asociados','AsociadosController@asociados');
    $router->get ('blog', 'PagesController@blog');
    $router->get ('contact','ContactoController@contact');
    $router->get ('galeria', 'GaleriaController@galeria');
    $router->get('post', 'PagesController@post');
    $router->post('galeria/nueva', 'GaleriaController@galeriaNueva');
    $router->get ('galeria/:id', 'GaleriaController@show');
    $router->post('asociados/nuevo', 'AsociadosController@asociadosNuevo');
    $router->post('single_post', 'AsociadosController@post');
    $router->post('contact/enviar','ContactoController@contactEnviar');


