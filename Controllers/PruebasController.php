<?php
namespace Controllers;
Use Lib\Pages;
use Models\Pruebas;
use Models\Materias;
use Models\Alumnos;

use Utils\Utils;

class PruebasController {
    private Pages $pages;




    function __construct(){

        $this->pages= new Pages();
        

    }
    
    public function registroPrueba(): void {
        if ($_SESSION['identity'] && $_SESSION['identity']->rol === 'profesor') {
            $id_profesor = $_SESSION['identity']->id; // Obtener el ID del profesor desde la sesión
    
            $materia = new Materias();
            $materias = $materia->obtenerMateriasPorProfesor($id_profesor); // Obtener las materias asignadas al profesor
    
            // Pasar las materias asignadas al profesor a la vista del formulario
            $this->pages->render('pruebas/Pruebas', ['materias' => $materias]);
        } else {
            // Manejar el caso en el que no se encuentra un profesor en la sesión o no tiene el rol adecuado
            $_SESSION['prueba_added'] = "failed";
            header('Location:'.BASE_URL.'pruebas/registroPrueba/');
        }
    }
    
    public function agregarPrueba(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar si el usuario tiene permiso de administrador para registrar usuarios
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Obtener datos del formulario
                $id_materia = $_POST['id_materia'];
                $trimestre = $_POST['trimestre'];
                $nombre_alumno = $_POST['nombre_alumno'];
                $apellidos_alumno = $_POST['apellidos_alumno'];
                $horario = $_POST['horario'];
                $nota = $_POST['nota'];
        
                // Buscar el ID del alumno basado en el nombre y apellidos
                $alumno = new Alumnos();
                $id_alumno = $alumno->obtenerIdPorNombreYApellidos($nombre_alumno, $apellidos_alumno);
        
                if ($id_alumno) {
                    $pruebaModel = new Pruebas();
                    $pruebaExistente = $pruebaModel->verificarNotaExistente($id_alumno, $id_materia, $trimestre);
                    
                    if ($pruebaExistente) {
                        $_SESSION['prueba_added'] = "duplicate";
                    } else {
                        $prueba = new Pruebas(null, $id_materia, $trimestre, $id_alumno, $horario, $nota);
                        $save = $prueba->save();
        
                        if ($save) {
                            $_SESSION['prueba_added'] = "complete";
                        } else {
                            $_SESSION['prueba_added'] = "failed";
                        }
                    }
                } else {
                    $_SESSION['prueba_added'] = "failed";
                }
            }
        
            header('Location:'.BASE_URL.'pruebas/registroPrueba/');
        }
    }

}

?>