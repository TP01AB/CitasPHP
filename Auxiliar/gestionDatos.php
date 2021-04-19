<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gestionDatos
 *
 * @author isra9
 */
include_once '../Auxiliar/constantes.php';
include_once '../Modelo/Usuario.php';
class gestionDatos
{

    static private $conexion;

    static function conexion()
    {
        //self::$conexion = mysqli_connect('localhost', 'maria', 'Chubaca2020', 'desafio2');
        self::$conexion = mysqli_connect('localhost', constantes::$usuarioBD, constantes::$passBD, constantes::$bd);
        //self::$conexion = mysqli_connect('localhost', 'Maria', 'Chubaca2020', 'desafio2');
        print "Conexión realizada de forma procedimental: " . mysqli_get_server_info(self::$conexion) . "<br/>";
        if (mysqli_connect_errno(self::$conexion)) {
            print "Fallo al conectar a MySQL: " . mysqli_connect_error();
            die();
        }
    }

    static function cerrarBD()
    {
        mysqli_close(self::$conexion);
    }

    //======================================================================
    // VERIFICACION
    //======================================================================
    //===========================EMAIL EXIST=============================
    static function isExistEmail($email)
    {
        self::conexion();
        $stmt = self::$conexion->prepare("SELECT * FROM " . constantes::$users . " WHERE email= ?");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $resultado = $stmt->get_result();
            if ($fila = $resultado->fetch_assoc()) {
                $existe = true;
            } else {
                echo "No existe ningun usuario con el e-mail proporcionado " . self::$conexion->error . '<br/>';
                $existe = false;
            }
            mysqli_close(self::$conexion);
            return $existe;
        }
    }
    //===========================EMAIL EXIST=============================
    static function isExistDni($dni)
    {
        self::conexion();
        $stmt = self::$conexion->prepare("SELECT * FROM " . constantes::$users . " WHERE dni= ? ");
        $stmt->bind_param("s", $dni);
        if ($stmt->execute()) {
            $resultado = $stmt->get_result();
            if ($fila = $resultado->fetch_assoc()) {
                $existe = true;
            } else {
                echo "No existe ningun usuario con el dni proporcionado " . self::$conexion->error . '<br/>';
                $existe = false;
            }
            mysqli_close(self::$conexion);
            return $existe;
        }
    }
    //===========================FIRST TIME =============================
    static function isFirstTime($idUser)
    {

        self::conexion();
        $stmt = self::$conexion->prepare("SELECT * FROM " . constantes::$preferencias . " WHERE email= ?");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $resultado = $stmt->get_result();
            if ($fila = $resultado->fetch_assoc()) {
                $existe = true;
            } else {
                echo "Error al encontrar usuario: " . self::$conexion->error . '<br/>';
                $existe = false;
            }
            mysqli_close(self::$conexion);
            return $existe;
        }
    }

    //======================================================================
    // GET
    //======================================================================
    //===========================USER===================================
    static function getUser($email, $password)
    {
        self::conexion();
        $stmt = self::$conexion->prepare("SELECT * FROM " . constantes::$users . "," . constantes::$roles . " WHERE " . constantes::$users . ".email= ? AND " . constantes::$users . ".password= ? AND " . constantes::$roles . ".Id_user=" . constantes::$users . ".id_User ");
        $stmt->bind_param("ss", $email, password_hash($password, PASSWORD_DEFAULT));
        if ($stmt->execute()) {
            $resultado = $stmt->get_result();
            if ($row = $resultado->fetch_assoc()) {
                $idUser = $row['idUsuario'];
                $email = $row['email'];
                $nick = $row['nick'];
                $age = $row['age'];
                $dni = $row['dni'];
                $phone = $row['phone'];
                $isActive = $row['active'];
                $isOnline = $row['online'];
                $rol = $row['id_rol'];
                $user = new Usuario($idUser, $email, $dni, $rol, $nick, $age, $phone, $isActive, $isOnline);
            }
            mysqli_close(self::$conexion);
            return $user;
        }
    }
    //==========================GET ALL ONLINE==========================
    static function getAllOnline()
    {
        self::conexion();
        $online = 0;
        $consulta = "SELECT * FROM" . constantes::$users . "WHERE active=1";
        if ($resultado = self::$conexion->query($consulta)) {
            if ($fila = $resultado->fetch_assoc()) {
                while ($row = $resultado->fetch_assoc()) {
                    $online++;
                }
            }
        }
        return $online;
    }
    //==========================GET FRIENDS ONLINE==========================
    static function getFriendsOnline($email)
    {

        self::conexion();
        $online = 0;
        $consulta = "SELECT * FROM" . constantes::$users . "," . constantes::$amistad . " WHERE " . constantes::$users . ".active=1 ";
        if ($resultado = self::$conexion->query($consulta)) {
            if ($fila = $resultado->fetch_assoc()) {
                while ($row = $resultado->fetch_assoc()) {
                    $online++;
                }
            }
        }
        return $online;
    }
    //**********************************************************************
    // ATRIBUTOS USER
    //==========================ROL=====================================
    static function getRol($idUser)
    {
        self::conexion();
        $stmt = self::$conexion->prepare("SELECT * FROM " . constantes::$roles . " WHERE idUsuario= ? ");
        $stmt->bind_param("i", $idUser);
        if ($stmt->execute()) {
            $resultado = $stmt->get_result();
            //var_dump($resultado);
            if ($row = $resultado->fetch_assoc()) {
                //var_dump($fila);
                $rol = $row['idRol'];
            }
        }
        return $rol;
    }

    //======================================================================
    // UPDATE
    //======================================================================

    //==============================STATUS ONLINE=======================
    static function setOnline($email)
    {
        self::conexion();
        $consulta = "UPDATE " . constantes::$users . " SET active=1 WHERE email ='" . $email . "'";
        if (self::$conexion->query($consulta)) {
            $correcto = true;
        } else {
            $correcto = false;
            echo "Error al actualizar estado online del usuario: " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
        return $correcto;
    }

    //======================================================================
    // DELETE
    //======================================================================
    //======================================================================
    // INSERT
    //======================================================================
    static function insertUser($user,$password){
        self::conexion();
        $consulta = "INSERT INTO ".constantes::$users." VALUES (default ,'" . $user->get_dni() . "','" . $user->get_email() . "','" . password_hash($password, PASSWORD_DEFAULT)."','" . $user->get_nick()."','" . $user->get_age()."','" . $user->get_phone()."',default,default)";
        if (self::$conexion->query($consulta)) {

            $correcto = true;
        } else {
            $correcto = false;
            echo "Error al insertar el nuevo  usuario : " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
        return $correcto;
        
    }
}
