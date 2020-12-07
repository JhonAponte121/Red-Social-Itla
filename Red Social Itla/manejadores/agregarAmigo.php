<?php

session_start();
include('../models/amigo.php');
include('../models/usuario.php');

date_default_timezone_set('America/Santo_Domingo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $friend = new amigo;
    $user = new usuario;

    $datoUsuario = $user->getUsuario(trim($_POST['usuario_amigo']));
    
    if($datoUsuario->id != null)
    {
        if($datoUsuario->id == $_SESSION['logueado'])
        {
            $_SESSION['usuarioNoExiste'] = '¡No puedes agregarte a ti mismo!';
            header('location:/Social Network/amigos.php');
        }
        else
        {
            $friend->id_usuario = trim($_SESSION['logueado']);
            $friend->id_amigo = $datoUsuario->id;

            if ($friend->agregar($friend))
            {
                header('location:/Social Network/amigos.php');
            }
        }
    	
    }
    else
    {
    	$_SESSION['usuarioNoExiste'] = 'El usuario ingresado no existe.';
    	header('location:/Social Network/amigos.php');
    }  
}