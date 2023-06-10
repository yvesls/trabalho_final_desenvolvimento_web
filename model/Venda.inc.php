<?php
class Venda
{
    private $cod_venda;
    private $cod_cliente;
    private $cod_produto;
    private $valor_total;
    private $quantidade_itens;

    public function __construct()
    {
    }

    public function setVenda($cod_cliente, $cod_produto, $valor_total, $quantidade_itens)
    {
        $this->cod_cliente = $cod_cliente;
        $this->cod_produto = $cod_produto;
        $this->valor_total = $valor_total;
        $this->quantidade_itens = $quantidade_itens;
    }

    public function getCodVenda()
    {
        return $this->cod_venda;
    }

    public function setCodVenda($cod_venda)
    {
        $this->cod_venda = $cod_venda;
    }

    public function getCodCliente()
    {
        return $this->cod_cliente;
    }

    public function setCodCliente($cod_cliente)
    {
        $this->cod_cliente = $cod_cliente;
    }

    public function getCodProduto()
    {
        return $this->cod_produto;
    }

    public function setCodProduto($cod_produto)
    {
        $this->cod_produto = $cod_produto;
    }

    public function getValorTotal()
    {
        return $this->valor_total;
    }

    public function setValorTotal($valor_total)
    {
        $this->valor_total = $valor_total;
    }

    public function getQuantidadeItens()
    {
        return $this->quantidade_itens;
    }

    public function setQuantidadeItens($quantidade_itens)
    {
        $this->quantidade_itens = $quantidade_itens;
    }
}
