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


//------------------ELIMINAR USUARIO
if (isset($_REQUEST['crearAdmin'])) {
    header('Location: ../Vistas/crearAdmin.php');
}
if (isset($_REQUEST['registroBD'])) {
    //RECOGIDA DE DATOS.
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $nombre = $_REQUEST['nombre'];
    $edad = $_REQUEST['edad'];
    $dni = $_REQUEST['dni'];
    $telefono = $_REQUEST['telefono'];
    //GUARDAMOS DATOS
    $user = new Usuario(0, $email, $dni, 0, $nombre, $edad, $telefono, 0, 0);
    //COMPROBACIONES PREVIAS 

    if (gestionDatos::isExistDni($dni)) {
        $mensaje = "El dni introduccido ya esta en uso en la plataforma.";
        $_SESSION['mensaje'] = $mensaje;
        $user->set_dni("");
        $_SESSION['userDatos'] = $user;
        header('Location: ../Vistas/crearAdmin.php');
    } else
    if (gestionDatos::isExistEmail($email)) {
        $mensaje = "El e-mail introduccido ya esta en uso en la plataforma.";
        $_SESSION['mensaje'] = $mensaje;
        $user->set_email("");
        $_SESSION['userDatos'] = $user;
        header('Location: ../Vistas/crearAdmin.php');
    } else
        //INSERTAMOS EL USUARIO
        if (gestionDatos::insertUser($user, $password)) {
            $id = gestionDatos::getMaxId($email);
            gestionDatos::insertRolAdmin($id);
            $mensaje = "Usuario creado correctamente.";
            $_SESSION['mensaje'] = $mensaje;
            $usuarios = gestionDatos::getUsers();
            $_SESSION['usuarios'] = serialize($usuarios);
            header('Location: ../Vistas/inicioAdmin.php');
        } else {
            $mensaje = "fallo al insertar el usuario en la BD";
            $_SESSION['mensaje'] = $mensaje;
            $_SESSION['userDatos'] = $user;
            header('Location: ../Vistas/crearAdmin.php');
        }
}
//------------------ELIMINAR USUARIO
if (isset($_REQUEST['borrarUsuario'])) {
    $usuarios = unserialize($_SESSION['usuarios']);
    if (count($usuarios) > 0) {
        foreach ($usuarios as $i => $usuario) {
            if (isset($_REQUEST[$i])) {
                $pulsado = true;
                if (!gestionDatos::deleteUsuario($usuario->get_email())) {
                    $mensaje = 'No se ha podido borrar el usuario con mail: ' . $usuario->get_email();
                    $_SESSION['mensaje'] = $mensaje;
                }
            }
        }
    }
    if (!$pulsado) {
        header('Location: ../Vistas/inicioAdmin.php');
    } else {
        $usuarios = gestionDatos::getUsers();
        $_SESSION['usuarios'] = serialize($usuarios);
        header('Location: ../Vistas/inicioAdmin.php');
    }
}
//------------------EDITAR USUARIO
if (isset($_REQUEST['editarUsuario'])) {
    $usuarios = unserialize($_SESSION['usuarios']);
    if (count($usuarios) > 0) {
        $cont = 0;
        foreach ($usuarios as $i => $usuario) {
            if (isset($_REQUEST[$i])) {
                $pulsado = true;
                $cont++;
                $pos = $i;
            }
        }
    }
    if (!$pulsado || $cont >= 2) {
        header('Location: ../Vistas/inicioAdmin.php');
    } else {
        $usu = $usuarios[$pos];

        $nombres = $_REQUEST['nombre'];
        $tfnos = $_REQUEST['tfno'];
        $emails = $_REQUEST['email'];

        $usu->set_nick($nombres[$pos]);
        $usu->set_phone($tfnos[$pos]);
        $passwords = $_REQUEST['password'];
        $password = $passwords[$pos];
        $email = $emails[$pos];
        if ($password != null) {
            gestionDatos::setPassword($email, $password);
        }
        if (!gestionDatos::updateUsuario($usu)) {
            $mensaje = 'No se ha podido actualizar el usuario';
            $_SESSION['mensaje'] = $mensaje;
        } else {
            $usuarios = gestionDatos::getUsers();
            $_SESSION['usuarios'] = serialize($usuarios);
        }
        header('Location: ../Vistas/inicioAdmin.php');
    }
}
//--------------------ACTIVAR USUARIO
if (isset($_REQUEST['activarUsuario'])) {
    $usuarios = unserialize($_SESSION['usuarios']);
    if (count($usuarios) > 0) {
        foreach ($usuarios as $i => $usuario) {
            if (isset($_REQUEST[$i])) {
                $pulsado = true;
                if (!gestionDatos::updateActivo($usuario->get_email())) {
                    $mensaje = 'No se ha podido activar el usuario con mail: ' . $usuario->get_email();
                    $_SESSION['mensaje'] = $mensaje;
                }
            }
        }
    }
    if (!$pulsado) {
        header('Location: ../Vistas/inicioAdmin.php');
    } else {
        $usuarios = gestionDatos::getUsers();
        $_SESSION['usuarios'] = serialize($usuarios);
        header('Location: ../Vistas/inicioAdmin.php');
    }
}
//--------------------DESACTIVAR USUARIO
if (isset($_REQUEST['desactivarUsuario'])) {
    $usuarios = unserialize($_SESSION['usuarios']);
    if (count($usuarios) > 0) {
        foreach ($usuarios as $i => $usuario) {
            if (isset($_REQUEST[$i])) {
                $pulsado = true;
                if (!gestionDatos::updateDesactivo($usuario->get_email())) {
                    $mensaje = 'No se ha podido activar el usuario con mail: ' . $usuario->get_email();
                    $_SESSION['mensaje'] = $mensaje;
                }
            }
        }
    }
    if (!$pulsado) {
        header('Location: ../Vistas/inicioAdmin.php');
    } else {
        $usuarios = gestionDatos::getUsers();
        $_SESSION['usuarios'] = serialize($usuarios);
        header('Location: ../Vistas/inicioAdmin.php');
    }
}

//--------------------CAMBIAR ROL ADMINISTRADOR
if (isset($_REQUEST['cambiarRolAdmnistrador'])) {
    $usuarios = unserialize($_SESSION['usuarios']);
    if (count($usuarios) > 0) {
        foreach ($usuarios as $i => $usuario) {
            if (isset($_REQUEST[$i])) {
                $pulsado = true;
                if (!gestionDatos::updateRolAdmin($usuario->get_idUser())) {
                    $mensaje = 'No se ha podido cambiar el rol del usuario con mail: ' . $usuario->get_email();
                    $_SESSION['mensaje'] = $mensaje;
                }
            }
        }
    }
    if (!$pulsado) {
        header('Location: ../Vistas/inicioAdmin.php');
    } else {
        $usuarios = gestionDatos::getUsers();
        $_SESSION['usuarios'] = serialize($usuarios);
        header('Location: ../Vistas/inicioAdmin.php');
    }
}
//--------------------CAMBIAR ROL USER
if (isset($_REQUEST['cambiarRolUser'])) {
    $usuarios = unserialize($_SESSION['usuarios']);
    if (count($usuarios) > 0) {
        foreach ($usuarios as $i => $usuario) {
            if (isset($_REQUEST[$i])) {
                $pulsado = true;
                if (!gestionDatos::updateRolUser($usuario->get_idUser())) {
                    $mensaje = 'No se ha podido cambiar el rol del usuario con mail: ' . $usuario->get_email();
                    $_SESSION['mensaje'] = $mensaje;
                }
            }
        }
    }
    if (!$pulsado) {
        header('Location: ../Vistas/inicioAdmin.php');
    } else {
        $usuarios = gestionDatos::getUsers();
        $_SESSION['usuarios'] = serialize($usuarios);
        header('Location: ../Vistas/inicioAdmin.php');
    }
}

//----------------------------CERRAR SESION
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
