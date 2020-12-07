<?php

session_start();

if (isset($_SESSION['logueado'])) 
{
    header('location:/Social Network/home.php');
} 
else 
{
    header('location:/Social Network/login.php');
}