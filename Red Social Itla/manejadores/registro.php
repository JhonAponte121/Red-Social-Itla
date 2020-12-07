<?php

session_start();
include('../models/usuario.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $user = new usuario();
    $user->nombre = trim($_POST['nombre']);
    $user->apellido = trim($_POST['apellido']);
    $user->telefono = trim($_POST['telefono']);
    $user->correo = trim($_POST['correo']);
    $user->nombre_usuario = trim($_POST['usuario']);
    $user->contraseña = password_hash(trim($_POST['contraseña']), PASSWORD_DEFAULT);

    if ($user->verificarDisponibilidad($user->nombre_usuario)) 
    {
        if ($user->registrar($user))
        {
            $_SESSION['loginComplete'] = '¡Ya estás registrado! Ahora puedes ingresar a ITLA Social Network.';
            header('location:/Social Network/index.php');
        }
    }
    else 
    {
        $_SESSION['usuarioError'] = 'El nombre de usuario no está disponible, intenta con otro.';
        $_SESSION['nombre'] = $_POST['nombre'];
        $_SESSION['apellido'] = $_POST['apellido'];
        $_SESSION['telefono'] = $_POST['telefono'];
        $_SESSION['correo'] = $_POST['correo'];
        $_SESSION['username'] = $_POST['usuario'];

        header('location:/Social Network/registro.php');
    }
}