<?php

class DataDisponivel
{
    private $id_servico;
    private $id_disponibilidade;
    private $data;
    private $disponivel;

    public function __construct()
    {
    }

    public function setDataDisponivel($id_servico, $data, $disponivel)
    {
        $this->id_servico = $id_servico;
        $this->data = $data;
        $this->disponivel = $disponivel;
    }

    public function getIdServico()
    {
        return $this->id_servico;
    }

    public function setIdServico($id_servico)
    {
        $this->id_servico = $id_servico;
    }

    public function getIdDisponibilidade()
    {
        return $this->id_disponibilidade;
    }

    public function setIdDisponibilidade($id_disponibilidade)
    {
        $this->id_disponibilidade = $id_disponibilidade;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getDisponivel()
    {
        return $this->disponivel;
    }

    public function setDisponivel($disponivel)
    {
        $this->disponivel = $disponivel;
    }
}
