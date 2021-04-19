<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../Modelo/Usuario.php';
include_once '../Auxiliar/gestionDatos.php';
session_start();

if (isset($_SESSION['usuarioActual'])) {
    $usuario = $_SESSION['usuarioActual'];
}
//-----------------VISTAS
if (isset($_REQUEST['vistaLogin'])) {
    header('Location: ../Vistas/login.php');
}
if (isset($_REQUEST['vistaRegistro'])) {
    header('Location: ../Vistas/register.php');
}

//------------------Funciones
if (isset($_REQUEST['iniciarBD'])) {
    //RECOGIDA DE DATOS.
    $email = $_REQUEST['emailLogin'];
    $password = $_REQUEST['passwordLogin'];

    //CONSULTA A BD.
    $usuario = gestionDatos::getUser($email, $password);
    if (isset($usuario)) {

        gestionDatos::setOnline($email);
        $usuario->set_isOnline(true);
        $allOnline = gestionDatos::getAllOnline();
        $friendOnline = gestionDatos::getFriendsOnline($usuario->get_idUser());
        $firstTime = gestionDatos::isFirstTime($usuario->get_idUser());
        if ($firstTime) {
            header('Location: ../Vistas/preferencias.php');
        } else {
            $usuario = gestionDatos::getPreferencias($usuario);
            $_SESSION['usuarioActual'] = $usuario;
            header('Location: ../Vistas/inicio.php');
        }
    } else {

        header('Location: ../Vistas/login.php');
    }
}
