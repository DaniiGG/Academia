<?php
namespace Controllers;
Use Lib\Pages;
use Models\Alumnos;
use Models\Usuario;
use Utils\Utils;

class AlumnosController {
    private Pages $pages;




    function __construct(){

        $this->pages= new Pages();
        

    }
    
        
        public function agregarAlumno(): void {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['nombre'], $_POST['apellidos'], $_POST['id_padre'])) {
                    $nombre = $_POST['nombre'];
                    $apellidos = $_POST['apellidos'];
                    $id_padre = $_POST['id_padre'];
                    // Crear una instancia de alumno con los datos recibidos
                    $alumno = new Alumnos(null, $nombre, $apellidos, $id_padre);
    
                    // Guardar la nueva alumno en la base de datos
                    $save = $alumno->save();

                    
    
                    if ($save) {
                        $_SESSION['alumno_added'] = "complete";
                        
                    } else {
                        $_SESSION['alumno_added'] = "failed";
                    }
                } else {
                    $_SESSION['alumno_added'] = "failed";
                }
            }
    
            // Redirigir
           header("Location:".BASE_URL."alumnos/obtenerPosiblePadre/");
        }




        public function obtenerPosiblePadre() {
            $usuarios = new Usuario();
            
            $padres = $usuarios->getUsuariosPorRol('padre');
    
            if ($usuarios) {
                $this->pages->render('alumnos/alumnos', ['padres' => $padres]);
    
            } else {
                echo "No se encontraron usuarios con el rol padre.";
            }
        }
    }

?>