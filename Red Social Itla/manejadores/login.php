<?php

session_start();
include('../models/usuario.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $username = trim($_POST['usuario']);
    $pass = trim($_POST['contraseña']);

    $user = new usuario;
    $datosUsuario = $user->getUsuario($username);

    if (password_verify($pass, $datosUsuario->contraseña))
    {
        $_SESSION['logueado'] = $datosUsuario->id;
        $_SESSION['usuario'] = $datosUsuario->usuario;
        header('location:/Social Network/home.php');
    } 
    else 
    {
        $_SESSION['username'] = $_POST['usuario'];
        $_SESSION['errorLogin'] = 'El usuario o la contraseña son incorrectos.';
        header('location:/Social Network/login.php');
    }
}