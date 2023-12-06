<?php
namespace Models;
use Lib\BaseDatos;
use PDOException;
use PDO;


class Pruebas{
    private string|null $id;
    private string $id_materia;
    private string $trimestre;
	private string $id_alumno;
	private string $horario;
	private string $nota;
    private BaseDatos $db;

	public function __construct(string|null $id=null, string $id_materia='', string $trimestre='', string $id_alumno='', string $horario='', string $nota='') {

		$this->id = $id;
		$this->id_materia = $id_materia;
		$this->trimestre = $trimestre;
		$this->id_alumno = $id_alumno;
		$this->horario = $horario;
		$this->nota = $nota;
		$this->db = new BaseDatos();
	}
    public function getId() : string|null {
		return $this->id;
	}

	public function setId(string|null $value) {
		$this->id = $value;
	}


	public function getId_materia() : string {
		return $this->id_materia;
	}

	public function setId_materia(string $value) {
		$this->id_materia = $value;
	}

	public function getTrimestre() : string{
		return $this->trimestre;
	}

	public function setTrimestre(string $value) {
		$this->trimestre = $value;
	}

	public function getId_alumno() : string {
		return $this->id_alumno;
	}

	public function setId_alumno(string $value) {
		$this->id_alumno = $value;
	}

	public function getHorario() : string {
		return $this->horario;
	}

	public function setHorario(string $value) {
		$this->horario = $value;
	}

	public function getNota() : string {
		return $this->nota;
	}

	public function setNota(string $value) {
		$this->nota = $value;
	}

	


    public function save(): bool {
		$id = NULL;
        $id_materia = $this->getId_materia();
        $trimestre = $this->getTrimestre();
		$id_alumno = $this->getId_alumno();
		$horario = $this->getHorario();
		$nota = $this->getNota();
        try {
			
            $ins = $this->db->prepare("INSERT INTO pruebas (id, id_materia, trimestre, id_alumno, nota, horario) VALUES (:id, :id_materia, :trimestre, :id_alumno, :nota, :horario)");
			$ins->bindValue( ':id', $id);
            $ins->bindValue(':id_materia', $id_materia, PDO::PARAM_STR);
            $ins->bindValue(':trimestre', $trimestre, PDO::PARAM_STR);
			$ins->bindValue(':id_alumno', $id_alumno, PDO::PARAM_STR);
			$ins->bindValue(':nota', $nota, PDO::PARAM_STR);
			$ins->bindValue(':horario', $horario, PDO::PARAM_STR);


            $ins->execute();
            $result = true;
			
        } catch (PDOException $err) {
            $result = false;
        }
		 return $result;
    }


	public function verificarNotaExistente($id_alumno, $id_materia, $trimestre) {
		try {
			$query = "SELECT COUNT(*) AS count FROM pruebas WHERE id_alumno = :id_alumno AND id_materia = :id_materia AND trimestre = :trimestre";
			$statement = $this->db->prepare($query);
			$statement->bindParam(':id_alumno', $id_alumno, PDO::PARAM_STR);
			$statement->bindParam(':id_materia', $id_materia, PDO::PARAM_STR);
			$statement->bindParam(':trimestre', $trimestre, PDO::PARAM_STR);
			$statement->execute();
	
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			if ($result && $result['count'] > 0) {
				return true; // Existe una nota para el alumno, asignatura y trimestre dados
			} else {
				return false; // No existe una nota para el alumno, asignatura y trimestre dados
			}
		} catch (PDOException $err) {
			// Manejar la excepción si ocurre algún error en la consulta
			return false;
		}
	}
}

	
