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
            'layout',
            [
                'appUser' => App::get('appUser')
            ]
            /* compact ( 'imagenesHome','asociadosLogos') */
            );
           
    }

    public function languages()
    {
        Response::renderView('languages', 'layout', [
            'appUser' => App::get('appUser')
        ]);
    }

    public function services()
    {
        Response::renderView('services', 'layout', [
            'appUser' => App::get('appUser')
        ]);
    }

    public function events()
    {
        Response::renderView('events', 'layout', [
            'appUser' => App::get('appUser')
        ]);
    }

}
