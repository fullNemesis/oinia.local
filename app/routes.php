<?php

    $router->get('', 'PagesController@index');
    $router->get('languages', 'PagesController@languages');
    $router->get('services', 'PagesController@services');
    $router->get('events', 'PagesController@events');
    $router->get('contact', 'ContactoController@contact');
    $router->post('contact','ContactoController@contactEnviar');
    $router->get('registro', 'AuthController@registro');
    $router->post('check-registro', 'AuthController@checkRegistro');
    $router->get('login', 'AuthController@login');
    $router->post('check-login', 'AuthController@checkLogin');
    $router->get('logout', 'AuthController@logout');
    
    // Rutas de cursos ordenadas de más específica a más general
    $router->get('cursos', 'CursosController@index', 'ROLE_USER');
    $router->get('cursos/crear', 'CursosController@nuevoCurso', 'ROLE_ADMIN');
    $router->post('cursos/crear', 'CursosController@nuevoCurso', 'ROLE_ADMIN');
    $router->get('cursos/inscribirse/:id', 'CursosController@inscribirse', 'ROLE_USER');
    $router->get('cursos/ver/:id', 'CursosController@verCurso', 'ROLE_USER');
    $router->get('mis-cursos', 'CursosController@misCursos', 'ROLE_USER');
    
   /* $router->get ('about', 'PagesController@about');
    $router->get ('asociados','AsociadosController@asociados','ROLE_USER');
    $router->post('asociados/nuevo', 'AsociadosController@asociadosNuevo','ROLE_ADMIN');
    $router->get ('blog', 'PagesController@blog');
    $router->get ('contact','ContactoController@contact');
    $router->get ('galeria', 'GaleriaController@galeria','ROLE_USER');
    $router->get('post', 'PagesController@post');
    $router->post('galeria/nueva', 'GaleriaController@galeriaNueva','ROLE_ADMIN');
    $router->get ('galeria/:id', 'GaleriaController@show','ROLE_USER');
    $router->post('single_post', 'AsociadosController@post');
    $router->post('contact/enviar','ContactoController@contactEnviar');
 */
