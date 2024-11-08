<?php

namespace dwes\app\controllers;
use dwes\app\repository\ImagenesRepository;
use  dwes\core\App;
use dwes\app\repository\AsociadosRepository;
use dwes\core\Response;
use dwes\app\entity\Asociado;
use  dwes\app\entity\Imagen;

class PagesController
{
    /**
     * @throws QueryException
     */
    public function index()
    {
        /* $asociadosLogos[] = new Asociado('About','log1.jpg','Sobre nosotros');
        $asociadosLogos[] = new Asociado('Contacto','log2.jpg','Fondo contacto');
        $asociadosLogos[] = new Asociado('Contacto1','log3.jpg','Fondo contacto 2');
    
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
        $imagenesHome[] = new Imagen ('12.jpg','descripción imagen 12',1,456,610,130); */

        $imagenesHome = App::getRepository(ImagenesRepository::class)->findAll();
        $asociadosLogos = App::getRepository(AsociadosRepository::class)->findAll(); 
        Response::renderView(
            'index',
            'layout',
            compact ( 'imagenesHome','asociadosLogos')
            );
    }
    public function about()
    {
    
        $imagenesClientes[]= new Imagen('client1.jpg','MISS BELLA');
        $imagenesClientes[]= new Imagen('client2.jpg','Don Peno'); 
        $imagenesClientes[]= new Imagen('client3.jpg','Sweety');   
        $imagenesClientes[]= new Imagen('client4.jpg','Lady');
        Response::renderView(
            'about',
            'layout',
            compact ( 'imagenesClientes')
            );
        
    }
    public function blog()
    {   
        Response::renderView(
            'blog',
            'layout'
            );
        
    }
    public function post()
    {
        Response::renderView(
            'single_post',
            'layout'
            );
    }
}
