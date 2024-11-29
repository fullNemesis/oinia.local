<?php

namespace oinia\app\controllers;
/* use oinia\app\repository\ImagenesRepository; */
use  oinia\core\App;
/* use oinia\app\repository\AsociadosRepository; */
use oinia\core\Response;
/* use oinia\app\entity\Asociado;
use  oinia\app\entity\Imagen;
 */
class PagesController
{
    /**
     * @throws QueryException
     */
    public function index()
    {
        

     /*  $imagenesHome = App::getRepository(ImagenesRepository::class)->findAll();
        $asociadosLogos = App::getRepository(AsociadosRepository::class)->findAll();  */
        Response::renderView(
            'index',
            'layout'
            /* compact ( 'imagenesHome','asociadosLogos') */
            );
           
    }

    public function languges()
    {
        Response::renderView('languges', 'layout');
    }

    public function services()
    {
        Response::renderView('services', 'layout');
    }

    public function events()
    {
        Response::renderView('events', 'layout');
    }

}
