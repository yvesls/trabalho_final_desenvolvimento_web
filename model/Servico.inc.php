<?php

class Servico
{
    private $id_servico;
    private $nome;
    private $valor;
    private $descricao;
    private $id_tipo;

    public function __construct()
    {
    }

    public function setServico($nome, $valor, $descricao, $id_tipo)
    {
        $this->nome = $nome;
        $this->valor = $valor;
        $this->descricao = $descricao;
        $this->id_tipo = $id_tipo;
    }

    public function getIdServico()
    {
        return $this->id_servico;
    }

    public function setIdServico($id_servico)
    {
        $this->id_servico = $id_servico;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getIdTipo()
    {
        return $this->id_tipo;
    }

    public function setIdTipo($id_tipo)
    {
        $this->id_tipo = $id_tipo;
    }
}
