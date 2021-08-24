♣<?php

//Iniciar la sesion y la conexion con ddbb
require_once 'includes/conexion.php';

if(isset($_POST))
{
    //Borramos sesion antigua
    if(isset($_SESSION['error_login']))
    {
       unset($_SESSION['error_login']);
    }

    //Recolectamos nuevos datos
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //Consulta a la ddbb para ver si tengo ese usuario registrado
    $sql = "SELECT * FROM usuarios WHERE email = '$email';";
    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) == 1)
    {
        $usuario = mysqli_fetch_assoc($login); //a usuario lo convertimos en array asociativo con la funcion fetch_assoc() con la info de la query

        $verify = password_verify($password, $usuario['password']); //verificamos la contraseña y me retorna un booleano
        if($verify)
        {
            //utilizar una session para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;

        }else
            {
                $_SESSION['error_login'] = "Login incorrecto";
            }
    }else
        {
            //Mensaje de error
            $_SESSION['error_login'] = "Login incorrecto";
        }

}//if $_POST

header('Location: index.php'); //redirigir a index.php