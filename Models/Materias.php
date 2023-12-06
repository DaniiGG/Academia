<?php
namespace Models;
use Lib\BaseDatos;
use PDOException;
use PDO;


class Materias{
    private string|null $id;
    private string $nombre_materia;
    private string $id_profesor;
    private BaseDatos $db;

	public function __construct(string|null $id=null, string $nombre_materia='', string $id_profesor='') {

		$this->id = $id;
		$this->nombre_materia = $nombre_materia;
		$this->id_profesor = $id_profesor;
		$this->db = new BaseDatos();
	}

	public function getId() : string|null {
		return $this->id;
	}

	public function setId(string|null $value) {
		$this->id = $value;
	}

	public function getNombre_materia() : string {
		return $this->nombre_materia;
	}

	public function setNombre_materia(string $value) {
		$this->nombre_materia = $value;
	}

	public function getId_profesor() : string {
		return $this->id_profesor;
	}

	public function setId_profesor(string $value) {
		$this->id_profesor = $value;
	}



    public function save(): bool {
		$id = NULL;
        $nombre_materia = $this->getNombre_Materia();
        $id_profesor = $this->getId_Profesor();
        try {
			
            $ins = $this->db->prepare("INSERT INTO materias (id, nombre_materia, id_profesor) VALUES (:id, :nombre_materia, :id_profesor)");
			$ins->bindValue( ':id', $id);
            $ins->bindValue(':nombre_materia', $nombre_materia, PDO::PARAM_STR);
            $ins->bindValue(':id_profesor', $id_profesor, PDO::PARAM_STR);
            $ins->execute();
			
            $result = true;
			
        } catch (PDOException $err) {
            $result = false;
        }
		 return $result;
    }


	public function obtenerMaterias(){

		$materia=$this->db->prepare("SELECT * FROM materias ORDER BY id DESC");
		$materia->execute();
		
		$materias = $materia->fetchAll(PDO::FETCH_OBJ);
		$materia->closeCursor();
		$materia=null;
			return $materias;
	
	}

	public function buscarPorId(string $id): ?object {
		try {
			$query = $this->db->prepare("SELECT * FROM materias WHERE id = :id");
			$query->bindValue(':id', $id, PDO::PARAM_STR);
			$query->execute();
			
			$materia = $query->fetch(PDO::FETCH_OBJ);
			
			return $materia ? $materia : null;
		} catch (PDOException $err) {
			return null;
		}
	}
	
	public function obtenerMateriasPorProfesor(string $idProfesor): ?array {
		try {
			$query = $this->db->prepare("SELECT * FROM materias WHERE id_profesor = :id_profesor");
			$query->bindValue(':id_profesor', $idProfesor, PDO::PARAM_STR);
			$query->execute();
	
			$materias = $query->fetchAll(PDO::FETCH_OBJ); // Usar fetchAll para obtener todas las materias asignadas al profesor
	
			return $materias ? $materias : null;
		} catch (PDOException $err) {
			return null;
		}
	}

}