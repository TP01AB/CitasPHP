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
if (isset($_REQUEST['registroBD'])) {
    //RECOGIDA DE DATOS.
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $nombre = $_REQUEST['nombre'];
    $edad = $_REQUEST['edad'];
    $dni = $_REQUEST['dni'];
    $telefono = $_REQUEST['telefono'];
    $user=new Usuario(0,$email,$dni,0,$nombre,$edad,$telefono,0,0);
    if (gestionDatos::isExistDni($dni)) {
        $mensaje = "El dni introduccido ya esta en uso en la plataforma.";
        $_SESSION['mensaje'] = $mensaje;
        $user->set_dni("");
        $_SESSION['userDatos'] = $user;
        header('Location: ../Vistas/register.php');
    }
    if (gestionDatos::isExistEmail($email)) {
        $mensaje = "El e-mail introduccido ya esta en uso en la plataforma.";
        $_SESSION['mensaje'] = $mensaje;
        $user->set_email("");
        $_SESSION['userDatos'] = $user;
        header('Location: ../Vistas/register.php');
    }
    if(gestionDatos::insertUser($user,$password)){
        $mensaje = "Usuario creado correctamente, actualmente su cuenta esta desactivada hasta ser revisada por un administrador";
        $_SESSION['mensaje'] = $mensaje;
        header('Location: ../index.php');
    }else{
        $mensaje = "fallo al insertar el usuario en la BD";
        $_SESSION['mensaje'] = $mensaje;
        $_SESSION['userDatos'] = $user;
        header('Location: ../Vistas/register.php');
    }

}
