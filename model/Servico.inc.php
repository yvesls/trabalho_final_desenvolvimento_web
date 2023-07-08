<?php

class Servico
{
    private $id_servico;
    private $nome;
    private $valor;
    private $descricao;
    private $tipo;
    private $datasDisponiveis;

    public function __construct()
    {
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

    public function getDatasDisponiveis()
    {
        return $this->datasDisponiveis;
    }

    public function adicionarDataDisponivel($datasDisponiveis)
    {
        $this->datasDisponiveis = $datasDisponiveis;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
}
