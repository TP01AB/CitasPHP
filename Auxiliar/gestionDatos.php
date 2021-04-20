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
include_once '../Modelo/Preferencias.php';
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
    //===========================IS ACTIVE=============================
    static function isActive($email)
    {
        self::conexion();
        $stmt = self::$conexion->prepare("SELECT * FROM " . constantes::$users . " WHERE email= ? AND active=1");
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
    //===========================DNI EXIST=============================
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
        $stmt = self::$conexion->prepare("SELECT * FROM " . constantes::$preferencias . " WHERE id = ?");
        $stmt->bind_param("s", $idUser);
        if ($stmt->execute()) {
            $resultado = $stmt->get_result();
            if ($fila = $resultado->fetch_assoc()) {
                $existe = true;
            } else {
                echo "No se encuentran preferencias del  usuario:  '<br/>'";
                $existe = false;
            }

            mysqli_close(self::$conexion);
            return $existe;
        }
    }

    //======================================================================
    // GET
    //======================================================================
    //===========================USER LOGIN===================================
    static function getUserLogin($email, $password)
    {
        self::conexion();
        $stmt = self::$conexion->prepare("SELECT * FROM " . constantes::$users . "," . constantes::$roles . " WHERE " . constantes::$users . ".email= ?  AND " . constantes::$roles . ".id_user = " . constantes::$users . ".id_user ");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $resultado = $stmt->get_result();
            if ($row = $resultado->fetch_assoc()) {

                if (password_verify($password, $row['password'])) {
                    $idUser = $row['id_user'];
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
            }
            if (!gestionDatos::isFirstTime($idUser)) {
                $user = gestionDatos::getPreferencias($user);
            }
            return $user;
        }
    }
    //===========================GET USER===================================
    static function getUser($idUser)
    {
        self::conexion();
        $stmt = self::$conexion->prepare("SELECT * FROM " . constantes::$users . "," . constantes::$roles . " WHERE " . constantes::$users . ".id_user= ?  AND " . constantes::$roles . ".id_user = " . constantes::$users . ".id_user ");
        $stmt->bind_param("i", $idUser);
        if ($stmt->execute()) {
            $resultado = $stmt->get_result();
            if ($row = $resultado->fetch_assoc()) {

                $idUser = $row['id_user'];
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
            if (!gestionDatos::isFirstTime($idUser)) {
                $user = gestionDatos::getPreferencias($user);
            }
            mysqli_close(self::$conexion);
            return $user;
        }
    }

    //===========================ALL USER===================================
    static function getUsers()
    {
        self::conexion();
        $users = array();
        $consulta = "SELECT * FROM " . constantes::$users . "," . constantes::$roles . " WHERE " . constantes::$roles . ".id_user = " . constantes::$users . ".id_user ";
        if ($resultado = self::$conexion->query($consulta)) {
            while ($row = $resultado->fetch_assoc()) {
                $idUser = $row['id_user'];
                $email = $row['email'];
                $nick = $row['nick'];
                $age = $row['age'];
                $dni = $row['dni'];
                $phone = $row['phone'];
                $isActive = $row['active'];
                $isOnline = $row['online'];
                $rol = $row['id_rol'];
                $user = new Usuario($idUser, $email, $dni, $rol, $nick, $age, $phone, $isActive, $isOnline);
                $users[] = $user;
            }
        }
        mysqli_close(self::$conexion);
        return $users;
    }
    //===========================GET FRIENDS ===================================
    static function getAmigos($idUser)
    {
        self::conexion();
        $users = array();
        $consulta = "SELECT * FROM " . constantes::$users . "," . constantes::$amigos . " WHERE " . constantes::$users . ".id_user=" . $idUser . " AND " . constantes::$amigos . ".respuestaR =1 AND (" . constantes::$amigos . ".idUserE =" . $idUser . " OR " . constantes::$amigos . ".idUserR =" . $idUser . " ) ";
        if ($resultado = self::$conexion->query($consulta)) {
            while ($row = $resultado->fetch_assoc()) {
                $idUser = $row['id_user'];
                $user = gestionDatos::getUser($idUser);
                $users[] = $user;
            }
        }
        mysqli_close(self::$conexion);
        return $users;
    }
    //===========================GET FRIENDS ===================================
    static function getPendientes($idUser)
    {
        self::conexion();
        $users = array();
        $consulta = "SELECT * FROM " . constantes::$users . "," . constantes::$amigos . " WHERE " . constantes::$users . ".id_user=" . $idUser . " AND " . constantes::$amigos . ".respuestaR =0 AND (" . constantes::$amigos . ".idUserE =" . $idUser . " OR " . constantes::$amigos . ".idUserR =" . $idUser . " ) ";
        if ($resultado = self::$conexion->query($consulta)) {
            while ($row = $resultado->fetch_assoc()) {
                $idUser = $row['id_user'];
                $user = gestionDatos::getUser($idUser);
                $users[] = $user;
            }
        }
        mysqli_close(self::$conexion);
        return $users;
    }
    //===========================USER PREFERENCES===================================
    static function getPreferencias($user)
    {
        self::conexion();
        $id = $user->get_idUser();
        $stmt = self::$conexion->prepare("SELECT * FROM " . constantes::$preferencias . " WHERE id = ?  ");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $resultado = $stmt->get_result();
            if ($row = $resultado->fetch_assoc()) {

                $tipo = $row['tipoRelacion'];
                $sport = $row['Deporte'];
                $art = $row['Arte'];
                $pol = $row['Politica'];
                $child = $row['hijos'];
                $search = $row['busca'];
                $photo = $row['foto'];
                $pref = new Preferencias($tipo, $sport, $art, $pol, $child, $search, $photo);
                $user->set_preferencias($pref);
            }
            mysqli_close(self::$conexion);
            return $user;
        }
    }
    //==========================GET MAX ID==========================
    static function getMaxId($email)
    {
        self::conexion();
        $stmt = self::$conexion->prepare("SELECT * FROM " . constantes::$users . " WHERE email= ? ORDER BY id_user DESC");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $resultado = $stmt->get_result();
            if ($row = $resultado->fetch_assoc()) {
                $id = $row['id_user'];
            }
        }
        mysqli_close(self::$conexion);
        return $id;
    }
    //==========================GET ALL ONLINE==========================
    static function getAllOnline()
    {
        self::conexion();
        $online = 0;
        $consulta = "SELECT * FROM " . constantes::$users . " WHERE online=1";
        if ($resultado = self::$conexion->query($consulta)) {
            while ($fila = $resultado->fetch_assoc()) {
                $online++;
            }
        }
        mysqli_close(self::$conexion);
        return $online;
    }
    //==========================GET FRIENDS ONLINE==========================
    static function getFriendsOnline($email)
    {

        self::conexion();
        $online = 0;
        $consulta = "SELECT * FROM" . constantes::$users . "," . constantes::$amistad . " WHERE " . constantes::$users . ".active=1 ";
        if ($resultado = self::$conexion->query($consulta)) {
            while ($row = $resultado->fetch_assoc()) {
                $online++;
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
        $consulta = "UPDATE " . constantes::$users . " SET online=1 WHERE email ='" . $email . "'";
        if (self::$conexion->query($consulta)) {
            $correcto = true;
        } else {
            $correcto = false;
            echo "Error al actualizar estado online del usuario: " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
        return $correcto;
    }
    //==============================STATUS OFFLINE=======================
    static function setOffline($email)
    {
        self::conexion();
        $consulta = "UPDATE " . constantes::$users . " SET online=0 WHERE email ='" . $email . "'";
        if (self::$conexion->query($consulta)) {
            $correcto = true;
        } else {
            $correcto = false;
            echo "Error al actualizar estado online del usuario: " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
        return $correcto;
    }
    //==============================PREFERENCIAS=======================
    static function updatePreferencias($preferencias, $id)
    {
        self::conexion();
        $consulta = "UPDATE " . constantes::$preferencias . " SET tipoRelacion=" . $preferencias->get_tipoRelacion() . ",Deporte=" . $preferencias->get_deporte() . ",Arte=" . $preferencias->get_arte() . ",Politica=" . $preferencias->get_politica() . ",hijos=" . $preferencias->get_hijos() . ",busca=" . $preferencias->get_busca() . ", foto=" . $preferencias->get_foto() . " WHERE id =" . $id . "";
        if (self::$conexion->query($consulta)) {
            $correcto = true;
        } else {
            $correcto = false;
            echo "Error al actualizar estado online del usuario: " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
        return $correcto;
    }
    //==============================NEW PASSWORD=======================
    static function setPassword($email, $password)
    {
        self::conexion();
        $consulta = "UPDATE " . constantes::$users . " SET password='" . password_hash($password, PASSWORD_DEFAULT)  . "' WHERE email ='" . $email . "'";
        if (self::$conexion->query($consulta)) {
            $correcto = true;
        } else {
            $correcto = false;
            echo "Error al actualizar la contraseña del usuario: " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
        return $correcto;
    }

    //==============================UPDATE USER=======================
    static function updateUsuario($usuario)
    {
        self::conexion();
        $consulta = "UPDATE " . constantes::$users . " SET nick='" . $usuario->get_nick() . "', phone = '" . $usuario->get_phone() . "' WHERE email ='" . $usuario->get_email() . "'";
        if (self::$conexion->query($consulta)) {
            $correcto = true;
        } else {
            $correcto = false;
            echo "Error al actualizar: " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
        return $correcto;
    }
    //==============================ACTIVATE USER=======================
    static function updateActivo($email)
    {
        self::conexion();
        $consulta = "UPDATE " . constantes::$users . " SET active=1  WHERE email ='" . $email . "'";
        if (self::$conexion->query($consulta)) {
            $correcto = true;
        } else {
            $correcto = false;
            echo "Error al actualizar: " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
        return $correcto;
    }
    //==============================INACTIVE USER=======================
    static function updateDesactivo($email)
    {
        self::conexion();
        $consulta = "UPDATE " . constantes::$users . " SET active=0  WHERE email ='" . $email . "'";
        if (self::$conexion->query($consulta)) {
            $correcto = true;
        } else {
            $correcto = false;
            echo "Error al actualizar: " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
        return $correcto;
    }
    //==============================UPDATE ROL ADMIN=======================
    static function updateRolAdmin($id)
    {
        self::conexion();
        $consulta = "UPDATE " . constantes::$roles . " SET id_rol= 1  WHERE id_user =" . $id . "";
        if (self::$conexion->query($consulta)) {
            $correcto = true;
        } else {
            $correcto = false;
            echo "Error al actualizar: " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
        return $correcto;
    }
    //==============================UPDATE ROL USUARIO=======================
    static function updateRolUser($id)
    {
        self::conexion();
        $consulta = "UPDATE " . constantes::$roles . " SET id_rol= 2  WHERE id_user =" . $id . "";
        if (self::$conexion->query($consulta)) {
            $correcto = true;
        } else {
            $correcto = false;
            echo "Error al actualizar: " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
        return $correcto;
    }
    //======================================================================
    // DELETE
    //======================================================================

    //==============================DELETE USER=======================
    static function deleteUsuario($email)
    {
        self::conexion();
        $consulta = "DELETE FROM " . constantes::$users . " WHERE email ='" . $email . "'";
        if (self::$conexion->query($consulta)) {
            $correcto = true;
        } else {
            $correcto = false;
            echo "Error al borrar usuario: " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
        return $correcto;
    }
    //======================================================================
    // INSERT
    //======================================================================
    //==============================NEW USER=======================
    static function insertUser($user, $password)
    {
        self::conexion();
        $consulta = "INSERT INTO " . constantes::$users . " VALUES (default ,'" . $user->get_dni() . "','" . $user->get_email() . "','" . password_hash($password, PASSWORD_DEFAULT) . "','" . $user->get_nick() . "','" . $user->get_age() . "','" . $user->get_phone() . "',default,default)";
        if (self::$conexion->query($consulta)) {

            $correcto = true;
        } else {
            $correcto = false;
            echo "Error al insertar el nuevo  usuario : " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
        return $correcto;
    }
    //==============================NEW ROL=======================
    static function insertRol($id)
    {
        self::conexion();
        $consulta = "INSERT INTO " . constantes::$roles . " VALUES (2 ,'" . $id . "')";
        if (self::$conexion->query($consulta)) {
        } else {
            echo "Error al insertar el nuevo  usuario : " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
    }
    //==============================NEW ROL ADMIN=======================
    static function insertRolAdmin($id)
    {
        self::conexion();
        $consulta = "INSERT INTO " . constantes::$roles . " VALUES (1 ,'" . $id . "')";
        if (self::$conexion->query($consulta)) {
        } else {
            echo "Error al insertar el nuevo  usuario : " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
    }
    //==============================NEW PREF=======================
    static function insertPreferencias($preferencias, $id)
    {
        self::conexion();
        $consulta = "INSERT INTO " . constantes::$preferencias . " VALUES (" . $id . " ," . $preferencias->get_tipoRelacion() . "," . $preferencias->get_deporte() . "," . $preferencias->get_arte() . "," . $preferencias->get_politica() . "," . $preferencias->get_hijos() . "," . $preferencias->get_busca() . "," . $preferencias->get_foto() . ")";
        if (self::$conexion->query($consulta)) {
        } else {
            echo "Error al insertar preferencias del   usuario : " . self::$conexion->error . '<br/>';
        }
        mysqli_close(self::$conexion);
    }
}
