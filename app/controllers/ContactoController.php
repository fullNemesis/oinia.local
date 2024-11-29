<?php

namespace oinia\app\controllers;

use oinia\app\repository\ImagenesRepository;
use  oinia\core\App;
use oinia\app\repository\AsociadosRepository;
use oinia\core\Response;
use oinia\app\entity\Asociado;
use  oinia\app\entity\Imagen;
use oinia\app\exceptions\MailException;
use oinia\app\utils\MyMail;


class ContactoController
{
    /**
     * @throws QueryException
     */
    public function contact()
    {
        Response::renderView(
            'contact',
            'layout'
            );
    }
    /**
     * @throws QueryException
     */
    public function contactEnviar()
    {
        $mensaje = "";
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = trim(htmlspecialchars($_POST['Name'])) ?? "";
               /*  $apellidos = trim(htmlspecialchars($_POST['apellidos'])) ?? ""; */
                $email = trim(htmlspecialchars($_POST['Email'])) ?? "";
                $telefono = trim(htmlspecialchars($_POST['Phone'])) ?? "";
                $mensaje = trim(htmlspecialchars($_POST['Message'])) ?? "";
                if ($nombre != "" && $email != "" && $telefono != "" && $mensaje != "") {
                    $email = new MyMail();
                    $email->send($email, $nombre . ' ' . $telefono, 'Mensaje contacto web', $mensaje);
                    $mensaje = "Mensaje enviado correctamente.";
                } else {
                    $mensaje = "Faltan campos por rellenar.";
                }
            }
        } catch (MailException $mailException) {
            $mensaje = $mailException->getMessage();
        }
        
        Response::renderView('contact', 'layout', ['mensaje' => $mensaje]);
        // App::get('router')->redirect('contact');

    }
}
