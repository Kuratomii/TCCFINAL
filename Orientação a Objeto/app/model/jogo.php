<?php

class Jogo{
    
    private $id;
    private $titulo;
    private $genero;
    private $lancamento;
    private $descricao;
    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getGenero() {
        return $this->genero;
    }

    function getLancamento() {
        return $this->lancamento;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setLancamento($lancamento) {
        $this->lancamento = $lancamento;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }


    
}