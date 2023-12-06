<?php
namespace Controllers;
Use Lib\Pages;
use Models\Usuario;
Use Utils\Utils;
class UsuarioController{
    private Pages $pages;




    function __construct(){

        $this->pages= new Pages();
        

    }
    public function registro(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar si el usuario tiene permiso de administrador para registrar usuarios
            if ($_SESSION['identity'] && $_SESSION['identity']->rol === 'admin') {
                // Validar y procesar el registro
                if ($_POST['data']) {
                    $registrado = $_POST['data'];
    
                    // Encriptar contraseña
                    $registrado['pass'] = password_hash($registrado['pass'], PASSWORD_BCRYPT, ['cost'=>4]);
                    $usuario = Usuario::fromArray($registrado);
                    $save = $usuario->save();
    
                    if ($save) {
                        $_SESSION['register'] = "complete";
                    } else {
                        $_SESSION['register'] = "failed";
                    }
                } else {
                    $_SESSION['register'] = "failed";
                }
                $usuario->desconecta();
            } else {
                $_SESSION['register'] = "failed"; // O un mensaje indicando que no tiene permiso para registrar
            }
        }
        $this->pages->render('usuario/registro');
    }



    public function login(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['data'])) {
                $auth = $_POST['data']; //SANEAR Y VALIDAR
    
                // Buscar el usuario en la base de datos por su correo electrónico
                $usuario = Usuario::fromArray($auth);

                $identity = $usuario->login();

                //Crear sesión
    
                if ($identity && is_object($identity)) {
                    // Iniciar sesión y guardar los datos del usuario en la variable de sesión
                   
                    $_SESSION['identity'] = $identity;
    
                    // if($identity->rol == 'admin'){
                    //     $_SESSION['admin'] = true;
                    // }
                    $this->pages->render('usuario/login');
                }else{
                    
                    $_SESSION['error_login']='Identificación fallida!!';
                }
                    // Redirigir a la página de inicio o a la página de usuario autenticado
                    
                
            }
        }
    }


public function identifica(){
    $this->pages->render('usuario/login');
}


public function logout(){

    Utils::deleteSession('identity');
header("Location:".BASE_URL);

}



}
        



    