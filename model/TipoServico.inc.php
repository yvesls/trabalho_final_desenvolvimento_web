<?php
class TipoServico
{
    private $id_tipo;
    private $nome;

    public function __construct()
    {
    }

    public function setTipoServico($nome)
    {
        $this->nome = $nome;
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
}
