<?php

if(isset($_POST['submit'])){

require_once "includes/conexion.php";


//Recogemos valores del formulario para actualizar datos de usuario
$nombre     = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
$apellido   = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
$email      = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;

//Array de errores
$errores = array();

//Validar los datos antes de guardarlos en la base de datos

//Validar campo nombre
if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre))
{
$nombre_validado = true;
}else{
$nombre_validado = false;
$errores['nombre'] = "El nombre no es valido";
    }

//Validar campo apellido
if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/",$apellido))
{
$apellido_validado = true;

}else{
$apellido_validado = false;
$errores['apellido'] = "Los apellidos no son validos";
    }


//Validar campo email
if(!empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL)){
$email_validado = true;
}else{
$email_validado = false;
$errores['email'] = "El email no es valido";
}


$guardar_usuario = false;
if(count($errores) == 0){
$usuario = $_SESSION['usuario'];
$guardar_usuario = true;

//Comprobar que el email ya exista
    $sql = "SELECT email FROM usuarios WHERE email = '$email';";
    $isset_email = mysqli_query($db,$sql);
    $isset_user = mysqli_fetch_assoc($isset_email);

    if($isset_user['id'] == $usuario['id'] || empty($isset_user)) {

//ACTUALIZAR USUARIO EN LA DDBB
        $usuario = $_SESSION['usuario'];
        $query = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellido', email = '$email' WHERE id =" . $_SESSION['usuario']['id'];
        $guardar = mysqli_query($db, $query);

        if ($guardar) {
            $_SESSION['usuario']['nombre'] = $nombre;
            $_SESSION['usuario']['apellido'] = $apellido;
            $_SESSION['usuario']['email'] = $email;

            $_SESSION['completado'] = "Tus datos se han actualizado con exito";
        } else {
            $_SESSION['errores']['general'] = "Fallo al actualizar tus datos";
        }
    }else{
        $_SESSION['errores']['general'] = "El usuario ya existe";
        }

}else{
$_SESSION['errores'] = $errores;
}

//var_dump($errores);//Muestro el contenido del array de errores

}//end if

header('Location: mis-datos.php');