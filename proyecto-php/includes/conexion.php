<?php
//Conexion

$server = 'localhost';
$username = 'root';
$password = '1234';
$db = 'blog';

$db = mysqli_connect($server, $username, $password, $db, 3308);
mysqli_query($db,"SET NAMES 'utf-8'");

//INICIAR LA SESION
if(!isset($_SESSION))
{
    session_start();
}