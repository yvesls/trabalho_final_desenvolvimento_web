<?php
class TipoServico
{
    private $id_tipo;
    private $nome;
    private $valor;

    public function __construct()
    {
    }

    public function setTipoServico($nome, $valor)
    {
        $this->nome = $nome;
        $this->valor = $valor;
    }


    public function getIdTipo()
    {
        return $this->id_tipo;
    }

    public function setIdTipo($id_tipo)
    {
        $this->id_tipo = $id_tipo;
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
}
