<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author isra9
 */
class Usuario
{

    //-----------------------ATRIBUTOS
    private $idUser;
    private $email;
    private $dni;
    private $rol;
    private $nick;
    private $sex;
    private $age;
    private $phone;
    private $isActive;
    private $isOnline;
    private $puntuacion;
    private $preferencias;

    //-----------------------CONSTRUCTOR
    function __construct($idUser, $email, $dni, $rol, $nick, $sex, $age, $phone, $isActive, $isOnline)
    {
        $this->idUser = $idUser;
        $this->email = $email;
        $this->dni = $dni;
        $this->nick = $nick;
        $this->sex = $sex;
        $this->age = $age;
        $this->phone = $phone;
        $this->rol = $rol;
        $this->isActive = $isActive;
        $this->isOnline = $isOnline;
        $this->puntuacion = 300;
    }

    //-----------------------GET
    public function get_idUser()
    {
        return $this->idUser;
    }

    public function get_email()
    {
        return $this->email;
    }
    public function get_puntuacion()
    {
        return $this->puntuacion;
    }
    public function get_dni()
    {
        return $this->dni;
    }

    public function get_rol()
    {
        return $this->rol;
    }

    public function get_nick()
    {
        return $this->nick;
    }
    public function get_sex()
    {
        return $this->sex;
    }
    public function get_age()
    {
        return $this->age;
    }

    public function get_phone()
    {
        return $this->phone;
    }

    public function get_isActive()
    {
        return $this->isActive;
    }

    public function get_isOnline()
    {
        return $this->isOnline;
    }

    public function get_preferencias()
    {
        return $this->preferencias;
    }

    //-----------------------SET
    public function set_idUser($idUser): void
    {
        $this->idUser = $idUser;
    }

    public function set_email($email): void
    {
        $this->email = $email;
    }
    public function set_dni($dni): void
    {
        $this->dni = $dni;
    }
    public function set_puntuacion($puntuacion): void
    {
        $this->puntuacion = $puntuacion;
    }
    public function set_rol($rol): void
    {
        $this->rol = $rol;
    }

    public function set_nick($nick): void
    {
        $this->nick = $nick;
    }
    public function set_sex($sex): void
    {
        $this->sex = $sex;
    }
    public function set_age($age): void
    {
        $this->age = $age;
    }

    public function set_phone($phone): void
    {
        $this->phone = $phone;
    }

    public function set_isActive($isActive): void
    {
        $this->isActive = $isActive;
    }

    public function set_isOnline($isOnline): void
    {
        $this->isOnline = $isOnline;
    }

    public function set_preferencias($preferencias): void
    {
        $this->preferencias = $preferencias;
    }
}
