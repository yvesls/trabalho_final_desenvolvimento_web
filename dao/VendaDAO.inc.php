<?php
require_once("Conexao.inc.php");
require_once("../model/Venda.inc.php");
class VendaDAO
{
    private $conexao;

    public function __construct()
    {
        $con = new Conexao();
        $this->conexao = $con->getConexao();
    }

    public function inserirVenda($venda)
    {
        $sql = "INSERT INTO vendas (cod_cliente, cod_produto, valor_total, quantidade_itens)
                VALUES (:codCliente, :codProduto, :valorTotal, :quantidadeItens)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':codCliente', $venda->getCodCliente());
        $stmt->bindValue(':codProduto', $venda->getCodProduto());
        $stmt->bindValue(':valorTotal', $venda->getValorTotal());
        $stmt->bindValue(':quantidadeItens', $venda->getQuantidadeItens());

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function excluirVenda($codVenda)
    {
        $sql = "DELETE FROM vendas WHERE cod_venda = :codVenda";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':codVenda', $codVenda);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function atualizarVenda($venda)
    {
        $sql = "UPDATE vendas SET valor_total = :valorTotal, quantidade_itens = :quantidadeItens
                WHERE cod_venda = :codVenda";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':valorTotal', $venda->getValorTotal());
        $stmt->bindValue(':quantidadeItens', $venda->getQuantidadeItens());
        $stmt->bindValue(':codVenda', $venda->getCodVenda());

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function buscarPorId($codVenda)
    {
        $sql = "SELECT * FROM vendas WHERE cod_venda = :codVenda";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':codVenda', $codVenda);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return $this->criarVenda($resultado);
        } else {
            return null;
        }
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM vendas";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $vendas = [];

        foreach ($resultados as $resultado) {
            $vendas[] = $this->criarVenda($resultado);
        }

        return $vendas;
    }

    private function criarVenda($dados)
    {
        $venda = new Venda();
        $venda->setCodVenda($dados['cod_venda']);
        $venda->setCodCliente($dados['cod_cliente']);
        $venda->setCodProduto($dados['cod_produto']);
        $venda->setValorTotal($dados['valor_total']);
        $venda->setQuantidadeItens($dados['quantidade_itens']);

        return $venda;
    }
}
