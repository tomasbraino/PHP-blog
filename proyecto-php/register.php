<?php

//vengo desde lateral y se ejecuta este script con el control if

if(isset($_POST)){

    require_once "includes/conexion.php";

    if(!isset($_SESSION))
    {
        session_start();
    }

    //validacion de los datos que vienen del formulario de lateral.php
    // operador ternario para no hacer muchos if
    $nombre     = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellido   = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
    $email      = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password   = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

    //Array de errores
    $errores = array();


    //Validar los datos antes de guardarlos en la base de datos

    //Validar campo nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
        $nombre_validado = true;
    }else{
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es valido";
    }

    //Validar campo apellido
    if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/",$apellido)){
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

    if(!empty($password)){
        $password_validada = true;
    }else{
        $password_validada = false;
        $errores['password'] = "La contraseña esta vacia";
    }

    $guardar_usuario = false;
    if(count($errores) == 0){

        $guardar_usuario = true;

        //cifrar contraseña
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
        //al cifrar contraseña con la funcion 'password_hash' la ciframos 4 veces
        var_dump($password);
        var_dump($password_segura);

        //INSERTAR USUARIO EN LA DDBB
        $query = "INSERT INTO usuarios VALUES(null, '$nombre','$apellido','$email', '$password_segura', CURDATE());";
        $guardar = mysqli_query($db, $query);

        var_dump(mysqli_error($db));

        if($guardar){
            $_SESSION['completado'] = "El registro se ha completado con exito";
        }else{
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
        }


    }else{
        $_SESSION['errores'] = $errores;
    }

    //var_dump($errores);//Muestro el contenido del array de errores

}//end if

header('Location: index.php');


