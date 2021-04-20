<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../Modelo/Usuario.php';
include_once '../Modelo/Preferencias.php';
include_once '../Auxiliar/gestionDatos.php';
session_start();
$_SESSION['allOnline'] = gestionDatos::getAllOnline();
if (isset($_REQUEST['close'])) {
    unset($_SESSION['usuarioActual']);
    unset($_SESSION['Preferencias']);
    unset($_SESSION['rolActual']);
    $mensaje = 'Sesion cerrada .';
    $_SESSION['mensaje'] = $mensaje;
    header('Location: ../index.php');
}