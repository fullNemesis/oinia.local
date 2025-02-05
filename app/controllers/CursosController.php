<?php
namespace oinia\app\controllers;

use oinia\core\App;
use oinia\core\Response;
use oinia\app\entity\Curso;
use oinia\app\entity\Inscripcion;
use oinia\core\helpers\FlashMessage;
use oinia\app\repository\CursoRepository;
use oinia\app\repository\IdiomaRepository;
use oinia\app\repository\InscripcionRepository;
use oinia\app\exceptions\ValidationException;
use oinia\app\exceptions\NotFoundException;

class CursosController {
    public function index() {
        // Verificar si el usuario está logueado
        if (is_null(App::get('appUser'))) {
            Response::redirect('login');
            return;
        }

        $cursoRepository = App::getRepository(CursoRepository::class);
        $idiomaRepository = App::getRepository(IdiomaRepository::class);
        
        try {
            $cursos = $cursoRepository->findActivos();
            $idiomas = $idiomaRepository->findActivos();
            $appUser = App::get('appUser');

            Response::renderView('cursos/index', 'layout', [
                'cursos' => $cursos,
                'idiomas' => $idiomas,
                'appUser' => $appUser
            ]);
        } catch (\Exception $e) {
            error_log("Error al cargar cursos: " . $e->getMessage());
            FlashMessage::set('error', 'Error al cargar los cursos disponibles');
            Response::redirect('/');
        }
    }

    public function nuevoCurso() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->validarDatosCurso($_POST);
                
                $curso = new Curso();
                $curso->setNombre($_POST['nombre']);
                $curso->setIdiomaId($_POST['idioma_id']);
                $curso->setDescripcion($_POST['descripcion']);
                $curso->setNivel($_POST['nivel']);
                $curso->setFechaInicio(new \DateTime($_POST['fecha_inicio']));
                $curso->setFechaFin(new \DateTime($_POST['fecha_fin']));
                $curso->setPlazas($_POST['plazas']);
                $curso->setPrecio($_POST['precio']);
                $curso->setActivo(true);
                
                App::getRepository(CursoRepository::class)->save($curso);
                
                FlashMessage::set('mensaje', 'Curso creado correctamente');
                Response::redirect('cursos');
                return;
            } catch (ValidationException $e) {
                FlashMessage::set('errores', [$e->getMessage()]);
                $idiomas = App::getRepository(IdiomaRepository::class)->findActivos();
                $appUser = App::get('appUser');
                Response::renderView('cursos/crear', 'layout', [
                    'idiomas' => $idiomas,
                    'appUser' => $appUser
                ]);
            }
        } else {
            $idiomas = App::getRepository(IdiomaRepository::class)->findActivos();
            $appUser = App::get('appUser');
            Response::renderView('cursos/crear', 'layout', [
                'idiomas' => $idiomas,
                'appUser' => $appUser
            ]);
        }
    }

    private function validarDatosCurso($datos) {
        if (empty($datos['nombre'])) {
            throw new ValidationException('El nombre del curso es obligatorio');
        }
        if (empty($datos['idioma_id'])) {
            throw new ValidationException('Debes seleccionar un idioma');
        }
        if (empty($datos['descripcion'])) {
            throw new ValidationException('La descripción es obligatoria');
        }
        if (empty($datos['nivel'])) {
            throw new ValidationException('El nivel es obligatorio');
        }
        if (empty($datos['fecha_inicio'])) {
            throw new ValidationException('La fecha de inicio es obligatoria');
        }
        if (empty($datos['fecha_fin'])) {
            throw new ValidationException('La fecha de fin es obligatoria');
        }
        if (empty($datos['plazas']) || $datos['plazas'] < 1) {
            throw new ValidationException('El número de plazas debe ser mayor que 0');
        }
        if (empty($datos['precio']) || $datos['precio'] < 0) {
            throw new ValidationException('El precio no puede ser negativo');
        }
        
        $fechaInicio = new \DateTime($datos['fecha_inicio']);
        $fechaFin = new \DateTime($datos['fecha_fin']);
        
        if ($fechaFin <= $fechaInicio) {
            throw new ValidationException('La fecha de fin debe ser posterior a la fecha de inicio');
        }
    }

    public function inscribirse($id) {
        try {
            error_log("==================== INICIO INSCRIPCIÓN ====================");
            error_log("ID del curso: " . $id);
            
            // Verificar si el usuario está logueado
            $usuario = App::get('appUser');
            if (!$usuario) {
                error_log("Error: Usuario no logueado");
                Response::redirect('login');
                return;
            }
            error_log("Usuario logueado - ID: " . $usuario->getId() . ", Username: " . $usuario->getUsername());

            // Intentar obtener el curso
            try {
                error_log("Buscando curso con ID: " . $id);
                $curso = App::getRepository(CursoRepository::class)->find($id);
                if (!$curso) {
                    error_log("Error: Curso no encontrado");
                    throw new ValidationException('El curso no existe');
                }
                error_log("Curso encontrado - Nombre: " . $curso->getNombre() . ", Plazas: " . $curso->getPlazas());
            } catch (\Exception $e) {
                error_log("Error al buscar curso: " . $e->getMessage());
                error_log("Stack trace: " . $e->getTraceAsString());
                FlashMessage::set('error', 'El curso no existe');
                Response::redirect('cursos');
                return;
            }
            
            // Verificar si el usuario ya tiene una inscripción activa
            try {
                error_log("Verificando inscripciones activas del usuario");
                $inscripcionRepository = App::getRepository(InscripcionRepository::class);
                if ($inscripcionRepository->tieneInscripcionActiva($usuario->getId())) {
                    error_log("Error: Usuario ya tiene inscripción activa");
                    FlashMessage::set('error', 'Ya tienes una inscripción activa en otro curso');
                    Response::redirect('cursos');
                    return;
                }
                error_log("Usuario no tiene inscripciones activas");
            } catch (\Exception $e) {
                error_log("Error al verificar inscripciones activas: " . $e->getMessage());
                error_log("Stack trace: " . $e->getTraceAsString());
                throw $e;
            }
            
            // Verificar si hay plazas disponibles
            try {
                error_log("Verificando plazas disponibles");
                $inscripcionesActivas = $inscripcionRepository->getInscripcionesActivasCurso($curso->getId());
                $plazasOcupadas = count($inscripcionesActivas);
                $plazasTotal = $curso->getPlazas();
                error_log("Plazas ocupadas: " . $plazasOcupadas . " de " . $plazasTotal);
                
                if ($plazasOcupadas >= $plazasTotal) {
                    error_log("Error: No hay plazas disponibles");
                    FlashMessage::set('error', 'No hay plazas disponibles en este curso');
                    Response::redirect('cursos');
                    return;
                }
                error_log("Hay plazas disponibles");
            } catch (\Exception $e) {
                error_log("Error al verificar plazas disponibles: " . $e->getMessage());
                error_log("Stack trace: " . $e->getTraceAsString());
                throw $e;
            }
            
            // Crear nueva inscripción
            try {
                error_log("Creando nueva inscripción");
                $inscripcion = new Inscripcion();
                $inscripcion->setUsuarioId($usuario->getId());
                $inscripcion->setCursoId($curso->getId());
                $inscripcion->setEstado('activa');
                
                error_log("Datos de la inscripción: " . print_r($inscripcion->toArray(), true));
                
                $inscripcionRepository->save($inscripcion);
                error_log("Inscripción guardada correctamente");
                
                FlashMessage::set('mensaje', 'Te has inscrito correctamente en el curso');
                Response::redirect('mis-cursos');
                return;
            } catch (\Exception $e) {
                error_log("Error al guardar la inscripción: " . $e->getMessage());
                error_log("Stack trace: " . $e->getTraceAsString());
                throw $e;
            }
            
        } catch (\Exception $e) {
            error_log("ERROR GENERAL EN INSCRIPCIÓN: " . $e->getMessage());
            error_log("Stack trace completo: " . $e->getTraceAsString());
            FlashMessage::set('error', 'Ha ocurrido un error al procesar la inscripción');
            Response::redirect('cursos');
            return;
        } finally {
            error_log("==================== FIN INSCRIPCIÓN ====================");
        }
    }

    public function misCursos() {
        $usuario = App::get('appUser');
        $inscripciones = App::getRepository(InscripcionRepository::class)->findByUsuario($usuario->getId());
        Response::renderView('cursos/mis-cursos', 'layout', [
            'inscripciones' => $inscripciones,
            'appUser' => $usuario
        ]);
    }

    public function verCurso($id) {
        try {
            // Verificar si el usuario está logueado
            if (is_null(App::get('appUser'))) {
                Response::redirect('login');
                return;
            }

            // Debug
            error_log("Intentando obtener curso con ID: " . $id);

            // Intentar obtener el curso
            try {
                $curso = App::getRepository(CursoRepository::class)->find($id);
                error_log("Curso encontrado: " . print_r($curso, true));
            } catch (NotFoundException $e) {
                error_log("Error al buscar curso: " . $e->getMessage());
                FlashMessage::set('error', 'El curso solicitado no existe');
                Response::redirect('cursos');
                return;
            }

            // Intentar obtener el idioma
            try {
                $idioma = App::getRepository(IdiomaRepository::class)->find($curso->getIdiomaId());
                error_log("Idioma encontrado: " . print_r($idioma, true));
            } catch (NotFoundException $e) {
                error_log("Error al buscar idioma: " . $e->getMessage());
                FlashMessage::set('error', 'El idioma del curso no existe');
                Response::redirect('cursos');
                return;
            }
            
            // Obtener inscripciones activas
            try {
                $inscripcionesActivas = App::getRepository(InscripcionRepository::class)
                    ->getInscripcionesActivasCurso($curso->getId());
                $plazasDisponibles = $curso->getPlazas() - count($inscripcionesActivas);
                error_log("Plazas disponibles: " . $plazasDisponibles);
            } catch (\Exception $e) {
                error_log("Error al obtener inscripciones: " . $e->getMessage());
                $plazasDisponibles = $curso->getPlazas();
            }
            
            error_log("Renderizando vista con datos: " . print_r([
                'curso' => $curso,
                'idioma' => $idioma,
                'plazasDisponibles' => $plazasDisponibles
            ], true));

            Response::renderView('cursos/ver', 'layout', [
                'curso' => $curso,
                'idioma' => $idioma,
                'plazasDisponibles' => $plazasDisponibles,
                'appUser' => App::get('appUser')
            ]);
        } catch (\Exception $e) {
            error_log("Error general en verCurso: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            FlashMessage::set('error', 'Ha ocurrido un error al cargar el curso');
            Response::redirect('cursos');
            return;
        }
    }
} 