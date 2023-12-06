<?php
namespace Models;
use Lib\BaseDatos;
use PDOException;
use PDO;


class Usuario{
    private string|null $id;
    private string $nombre;
    private string $apellidos;
    private string $nombre_usuario; 
    private string $pass;
    private string $rol;
    private BaseDatos $db;
    // Errores
    // protected static $errores
    public function  __construct(string $id=null, string $nombre='', string $apellidos='', string $nombre_usuario='', string $pass='', string $rol='')
    {
    $this->db = new BaseDatos();
    $this->id= $id;
    $this->nombre=$nombre;
    $this->apellidos=$apellidos;
    $this->nombre_usuario=$nombre_usuario;
    $this->pass=$pass;
    $this->rol=$rol;
    }

    public function getId(): string|null {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getApellidos(): string {
        return $this->apellidos;
    }

    public function getNombreUsuario(): string {
        return $this->nombre_usuario;
    }

    public function getPass(): string {
        return $this->pass;
    }

    public function getRol(): string {
        return $this->rol;
    }

    // Setters
    public function setId(string|null $id): void {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setApellidos(string $apellidos): void {
        $this->apellidos = $apellidos;
    }

    public function setNombreUsuario(string $nombre_usuario): void {
        $this->nombre_usuario = $nombre_usuario;
    }

    public function setPass(string $pass): void {
        $this->pass = $pass;
    }

    public function setRol(string $rol): void {
        $this->rol = $rol;
    }

    public static function fromArray(array $data): Usuario
    {
    return new Usuario(
    $data['id'] ?? '',
    $data['nombre'] ?? '',
    $data['apellidos'] ?? '',
    $data['nombre_usuario'] ?? '',
    $data['pass'] ?? '',
    $data['rol'] ?? '',

    );
    }

public function desconecta() : void{
    $this->db==null;
}

    
public function save() { 
    //if(isset($contacto['Contacto']['id']
    if($this->getId()){
    return $this->update();
    } else {
    return $this->create();
    }
    }

    
public function create(): bool{
    $id = NULL;
    $nombre=$this->getNombre();
    $apellidos = $this->getApellidos();
    $nombre_usuario = $this->getNombreUsuario(); 
    $pass= $this->getPass();
    $rol = $this->getRol();
    try{
        
        
        $ins = $this->db->prepare("INSERT INTO usuarios (id, nombre, apellidos, nombre_usuario, rol, pass) values(:id, :nombre, :apellidos, :nombre_usuario, :rol, :pass)");
        $ins->bindValue( ':id', $id);
        
        $ins->bindValue(  ':nombre', $nombre,  PDO::PARAM_STR);
        $ins->bindValue( ':apellidos', $apellidos,  PDO:: PARAM_STR);
        $ins->bindValue( ':nombre_usuario', $nombre_usuario,  PDO::PARAM_STR);
       
        $ins->bindValue( ':pass', $pass,  PDO::PARAM_STR); 
        $ins->bindValue( ':rol', $rol,  PDO::PARAM_STR);
        
        $ins->execute();
        $result = true;

           
            
            
    }catch(PDOException){
        $result=false;
    }
    return $result;
}




public function buscaUsuario($nombre_usuario):bool|object{
    // Comprobar si existe el usuario
    $cons = $this->db->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :nombre_usuario"); 
    $cons->bindValue(':nombre_usuario', $nombre_usuario,  PDO::PARAM_STR);
    try{
    $cons->execute();
    if($cons && $cons->rowCount()== 1){ // si la cantidad de filas devueltas es
    $result = $cons->fetch( PDO::FETCH_OBJ); // aqui estará el objeto qi
    }
    }
    catch (PDOException $err) {
    $result = false;
    }
    return $result;
}

public function login(): bool|object{
    $result=false;
    $nombre_usuario=$this->nombre_usuario;
    $pass=$this->pass;

    $usuario=$this->buscaUsuario($nombre_usuario);

    if($usuario !== false){
        $verify =password_verify($pass,$usuario->pass);
        if($verify){
            $result=$usuario;
            $this->nombre=$usuario->nombre;
            $this->apellidos=$usuario->apellidos;
            $this->rol=$usuario->rol;
            $this->id=$usuario->id;

        }
        
    }
    return $result;
    
}


public function getUsuariosPorRol(string $rol): bool|array {
    $result = false;

    try {
        $cons = $this->db->prepare("SELECT id, nombre, apellidos FROM usuarios WHERE rol = :rol ORDER BY apellidos;");
        $cons->bindValue(':rol', $rol, PDO::PARAM_STR);
        $cons->execute();

        if ($cons && $cons->rowCount() > 0) {
            $result = $cons->fetchAll(PDO::FETCH_OBJ);
        }
    } catch (PDOException $err) {
    }

    return $result;
}

}