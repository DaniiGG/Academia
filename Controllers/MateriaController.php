<?php
namespace Controllers;
Use Lib\Pages;
use Models\Materias;
use Models\Usuario;
use Utils\Utils;

class MateriaController {
    private Pages $pages;




    function __construct(){

        $this->pages= new Pages();
        

    }
    
        public function registroMaterias(): void {
            $this->pages->render('materias/registro_materias');
        }

        public function obtenerPosibleProfesor() {
            $usuarios = new Usuario();
            
            $profesores = $usuarios->getUsuariosPorRol('profesor');
    
            if ($usuarios) {
                $this->pages->render('materias/registro_materias', ['profesores' => $profesores]);
    
            } else {
                echo "No se encontraron usuarios con el rol profesor.";
            }
        }
    
        public function agregarMateria(): void {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['nombre_materia'], $_POST['id_profesor'])) {
                    $nombre_materia = $_POST['nombre_materia'];
                    $id_profesor = $_POST['id_profesor'];
    
                    // Crear una instancia de Materia con los datos recibidos
                    $materia = new Materias(null, $nombre_materia, $id_profesor);
    
                    // Guardar la nueva materia en la base de datos
                    $save = $materia->save();
    
                    if ($save) {
                        $_SESSION['materia_added'] = "complete";
                        
                    } else {
                        $_SESSION['materia_added'] = "failed";
                    }
                } else {
                    $_SESSION['materia_added'] = "failed";
                }
            }
    
            // Redirigir a alguna página después de agregar la materia
            $this->pages->render('materias/registro_materias');
        }
    }

?>