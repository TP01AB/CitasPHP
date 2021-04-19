<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Preferencias
 *
 * @author isra9
 */
class Preferencias
{

    //ATRIBUTOS
    private $tipoRelacion;
    private $deporte;
    private $arte;
    private $politica;
    private $hijos;
    private $busca;
    private $foto;

    //CONSTRUCTOR
    public function __construct($tipoRelacion, $deporte, $arte, $politica, $hijos, $busca, $foto)
    {
        $this->tipoRelacion = $tipoRelacion;
        $this->deporte = $deporte;
        $this->arte = $arte;
        $this->politica = $politica;
        $this->hijos = $hijos;
        $this->busca = $busca;
        $this->foto = $foto;
    }

    //GET
    public function get_tipoRelacion()
    {
        return $this->tipoRelacion;
    }

    public function get_deporte()
    {
        return $this->deporte;
    }

    public function get_arte()
    {
        return $this->arte;
    }

    public function get_politica()
    {
        return $this->politica;
    }

    public function get_hijos()
    {
        return $this->hijos;
    }

    public function get_busca()
    {
        return $this->busca;
    }

    public function get_foto()
    {
        return $this->foto;
    }


    //SET
    public function set_tipoRelacion($tipoRelacion): void
    {
        $this->tipoRelacion = $tipoRelacion;
    }

    public function set_deporte($deporte): void
    {
        $this->deporte = $deporte;
    }

    public function set_arte($arte): void
    {
        $this->arte = $arte;
    }

    public function set_politica($politica): void
    {
        $this->politica = $politica;
    }

    public function set_hijos($hijos): void
    {
        $this->hijos = $hijos;
    }

    public function set_busca($busca): void
    {
        $this->busca = $busca;
    }

    public function set_foto($foto): void
    {
        $this->foto = $foto;
    }
}
