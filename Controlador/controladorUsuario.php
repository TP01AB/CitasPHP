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
if (isset($_REQUEST['preferenciasBD'])) {
    $usuario = $_SESSION['usuarioActual'];
    $deportes = $_REQUEST['deportes'];
    $artes = $_REQUEST['artes'];
    $politica = $_REQUEST['politica'];
    $tipoR = $_REQUEST['tipoR'];
    $hijos = $_REQUEST['hijos'];
    $busca = $_REQUEST['busco'];
    $preferencias = new Preferencias($tipoR, $deportes, $artes, $politica, $hijos, $busca, 0);
    if (isset($_SESSION['Preferencias'])) {
        gestionDatos::updatePreferencias($preferencias, $usuario->get_idUser());
    } else {
        gestionDatos::insertPreferencias($preferencias, $usuario->get_idUser());
    }
    $usuario->set_preferencias($preferencias);
    $_SESSION['usuarioActual'] = $usuario;
    $_SESSION['Preferencias'] = $preferencias;
    $mensaje = "Preferencias modificadas";
    $_SESSION['mensaje'] = $mensaje;
    header('Location: ../Vistas/preferencias.php');

}
if (isset($_REQUEST['close'])) {
    $usuario = $_SESSION['usuarioActual'];
    unset($_SESSION['usuarioActual']);
    unset($_SESSION['Preferencias']);
    unset($_SESSION['rolActual']);
    gestionDatos::setOffline($usuario->get_email());
    $mensaje = 'Sesion cerrada .';
    $_SESSION['mensaje'] = $mensaje;
    header('Location: ../index.php');
}