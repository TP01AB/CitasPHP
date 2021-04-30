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
if (isset($_SESSION['usuarioActual'])) {
    $usuario = $_SESSION['usuarioActual'];
}

if (isset($_REQUEST['eliminaramigo'])) {
    $idAmigo = $_REQUEST['id'];
    $usuario = $_SESSION['usuarioActual'];
    if (gestionDatos::insertAmigo($usuario->get_idUser(), $idAmigo, 2)) {

        $amigos = gestionDatos::getAmigos($usuario->get_idUser());
        $usuarios = gestionDatos::getUsers($usuario->get_idUser(), $amigos);
        //ALGORITMO
        $preferencias = $usuario->get_preferencias();

        foreach ($usuarios as $i =>  $us) {
            if ($us->get_preferencias() != null) {
                $us->set_puntuacion($preferencias->get_deporte(), $preferencias->get_arte(), $preferencias->get_politica(), $preferencias->get_tipoRelacion(), $preferencias->get_hijos(), $preferencias->get_busca());
            }

            $usuarios[$i] = $us;
        }
        foreach ($amigos as $i =>  $us) {
            if ($us->get_preferencias() != null) {
                $us->set_puntuacion($preferencias->get_deporte(), $preferencias->get_arte(), $preferencias->get_politica(), $preferencias->get_tipoRelacion(), $preferencias->get_hijos(), $preferencias->get_busca());
            }

            $amigos[$i] = $us;
        }

        ///FIN DE ALGORITMO
        $_SESSION['amigos'] = serialize($amigos);
        $_SESSION['todos'] = serialize($usuarios);
        $mensaje = "Amigo  eliminado";
        $_SESSION['mensaje'] = $mensaje;
    } else {
        $mensaje = "Fallo  al eliminar amigo";
        $_SESSION['mensaje'] = $mensaje;
    }
    header('Location: ../Vistas/inicio.php');
}
if (isset($_REQUEST['hacerAmigo'])) {
    $idAmigo = $_REQUEST['id'];
    $usuario = $_SESSION['usuarioActual'];
    if (gestionDatos::insertAmigo($usuario->get_idUser(), $idAmigo, 1)) {

        $amigos = gestionDatos::getAmigos($usuario->get_idUser());
        $usuarios = gestionDatos::getUsers($usuario->get_idUser(), $amigos);
        //ALGORITMO
        $preferencias = $usuario->get_preferencias();

        foreach ($usuarios as $i =>  $us) {
            if ($us->get_preferencias() != null) {
                $us->set_puntuacion($preferencias->get_deporte(), $preferencias->get_arte(), $preferencias->get_politica(), $preferencias->get_tipoRelacion(), $preferencias->get_hijos(), $preferencias->get_busca());
            }

            $usuarios[$i] = $us;
        }
        foreach ($amigos as $i =>  $us) {
            if ($us->get_preferencias() != null) {
                $us->set_puntuacion($preferencias->get_deporte(), $preferencias->get_arte(), $preferencias->get_politica(), $preferencias->get_tipoRelacion(), $preferencias->get_hijos(), $preferencias->get_busca());
            }

            $amigos[$i] = $us;
        }

        ///FIN DE ALGORITMO
        $_SESSION['amigos'] = serialize($amigos);
        $_SESSION['todos'] = serialize($usuarios);
        $mensaje = "Amigo  agregado";
        $_SESSION['mensaje'] = $mensaje;
    } else {
        $mensaje = "Fallo  al agregar amigo";
        $_SESSION['mensaje'] = $mensaje;
    }
    header('Location: ../Vistas/inicio.php');
}
if (isset($_REQUEST['preferenciasBD'])) {
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
    $amigos = gestionDatos::getAmigos($usuario->get_idUser());
    $usuarios = gestionDatos::getUsers($usuario->get_idUser(), $amigos);
    //ALGORITMO
    $preferencias = $usuario->get_preferencias();

    foreach ($usuarios as $i =>  $us) {
        if ($us->get_preferencias() != null) {
            $us->set_puntuacion($preferencias->get_deporte(), $preferencias->get_arte(), $preferencias->get_politica(), $preferencias->get_tipoRelacion(), $preferencias->get_hijos(), $preferencias->get_busca());
        }

        $usuarios[$i] = $us;
    }
    foreach ($amigos as $i =>  $us) {
        if ($us->get_preferencias() != null) {
            $us->set_puntuacion($preferencias->get_deporte(), $preferencias->get_arte(), $preferencias->get_politica(), $preferencias->get_tipoRelacion(), $preferencias->get_hijos(), $preferencias->get_busca());
        }

        $amigos[$i] = $us;
    }

    ///FIN DE ALGORITMO
    $_SESSION['amigos'] = serialize($amigos);
    $_SESSION['todos'] = serialize($usuarios);
    $_SESSION['usuarioActual'] = $usuario;
    $_SESSION['Preferencias'] = $preferencias;
    $mensaje = "Preferencias modificadas";
    $_SESSION['mensaje'] = $mensaje;
    header('Location: ../Vistas/preferencias.php');
}
if (isset($_REQUEST['hacerAmigo'])) {
    header('Location: ../Vistas/inicio.php');
}
if (isset($_REQUEST['enviarMensaje'])) {
    $email = $_REQUEST['email'];
    $_SESSION['emailAmigo'] = $email;
    header('Location: ../Vistas/mensaje.php');
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
