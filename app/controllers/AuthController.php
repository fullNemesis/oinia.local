<?php

namespace oinia\app\controllers;

use  oinia\core\App;
use oinia\core\Response;
use oinia\core\Security;
use oinia\app\entity\Usuario;
use oinia\core\helpers\FlashMessage;
use oinia\app\repository\UsuarioRepository;
use oinia\app\exceptions\ValidationException;

class AuthController
{
    public function login()
    {
        $errores = FlashMessage::get('login-error', []);
        $username = FlashMessage::get('username');
        Response::renderView('login', 'layout', compact('errores', 'username'));
    }

    public function checkLogin()
    {
        try {
            if (!isset($_POST['username']) || empty($_POST['username'])) {
                throw new ValidationException('Debes introducir el usuario y el password');
            }
            
            FlashMessage::set('username', $_POST['username']);
            
            if (!isset($_POST['password']) || empty($_POST['password'])) {
                throw new ValidationException('Debes introducir el usuario y el password');
            }

            // Log para depuración
            App::get('logger')->add("Intento de login - Usuario: " . $_POST['username']);
            
            $usuario = App::getRepository(UsuarioRepository::class)->findOneBy([
                'username' => $_POST['username']
            ]);

            if (is_null($usuario)) {
                App::get('logger')->add("Usuario no encontrado: " . $_POST['username']);
                throw new ValidationException('El usuario y el password introducidos no existen');
            }

            // Log para depuración
            App::get('logger')->add("Password proporcionado: " . $_POST['password']);
            App::get('logger')->add("Password almacenado: " . $usuario->getPassword());
            
            if (Security::checkPassword($_POST['password'], $usuario->getPassword())) {
                // Guardamos el usuario completo en la sesión
                $_SESSION['loguedUser'] = $usuario->getId();
                $_SESSION['userRole'] = $usuario->getRole();
                FlashMessage::unset('username');
                App::get('logger')->add("Login exitoso para usuario: " . $usuario->getUsername());
                Response::redirect('');
            }

            App::get('logger')->add("Contraseña incorrecta para usuario: " . $usuario->getUsername());
            throw new ValidationException('El usuario y el password introducidos no existen');

        } catch (ValidationException $validationException) {
            FlashMessage::set('login-error', [$validationException->getMessage()]);
            Response::redirect('login');
        }
    }

    public function logout()
    {
        if (isset($_SESSION['loguedUser'])) {
            $_SESSION['loguedUser'] = null;
            unset($_SESSION['loguedUser']);
            unset($_SESSION['userRole']);
        }
        Response::redirect('login');
    }

    public function registro()
    {
        $errores = FlashMessage::get('registro-error', []);
        $mensaje = FlashMessage::get('mensaje');
        $username = FlashMessage::get('username');
        Response::renderView('registro', 'layout', compact('errores', 'username'));
    }

    public function checkRegistro()
    {
        try {
            if (!isset($_POST['username']) || empty($_POST['username']))
                throw new ValidationException('El nombre de usuario no puede estar vacío');
            FlashMessage::set('username', $_POST['username']);
            if (!isset($_POST['password']) || empty($_POST['password']))
                throw new ValidationException('El password de usuario no puede estar vacío');
            if (!isset($_POST['re-password']) || empty($_POST['re-password']) || $_POST['password'] !== $_POST['re-password'])
                throw new ValidationException('Los dos password deben ser iguales');
            $usuario = new Usuario();
            $usuario->setUsername($_POST['username']);
            $usuario->setRole('ROLE_USER');
            $password = Security::encrypt($_POST['password']);
            $usuario->setPassword($password);
            App::getRepository(UsuarioRepository::class)->save($usuario);
            FlashMessage::unset('username');
            $mensaje = "Se ha creado el usuario: " . $usuario->getUsername();
            App::get('logger')->add($mensaje);
            FlashMessage::set('mensaje', $mensaje);
            Response::redirect('login');
        } catch (ValidationException $validationException) {
            FlashMessage::set('registro-error', [$validationException->getMessage()]);
            Response::redirect('registro');
        }
    }
}
