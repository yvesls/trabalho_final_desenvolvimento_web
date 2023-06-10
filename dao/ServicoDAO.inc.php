<?php
require_once("Conexao.inc.php");
require_once("../model/Servico.inc.php");
class ServicoDAO
{
    private $conexao;

    public function __construct()
    {
        $con = new Conexao();
        $this->conexao = $con->getConexao();
    }

    public function inserirServico(Servico $servico)
    {
        $sql = "INSERT INTO servicos (nome, valor, descricao, id_tipo)
                VALUES (:nome, :valor, :descricao, :idTipo)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nome', $servico->getNome());
        $stmt->bindParam(':valor', $servico->getValor());
        $stmt->bindParam(':descricao', $servico->getDescricao());
        $stmt->bindParam(':idTipo', $servico->getIdTipo());

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function excluirServico($idServico)
    {
        $sql = "DELETE FROM servicos WHERE id_servico = :idServico";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':idServico', $idServico);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function atualizarServico(Servico $servico)
    {
        $sql = "UPDATE servicos SET nome = :nome, valor = :valor, descricao = :descricao, id_tipo = :idTipo
                WHERE id_servico = :idServico";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nome', $servico->getNome());
        $stmt->bindParam(':valor', $servico->getValor());
        $stmt->bindParam(':descricao', $servico->getDescricao());
        $stmt->bindParam(':idTipo', $servico->getIdTipo());
        $stmt->bindParam(':idServico', $servico->getIdServico());

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function buscarPorId($idServico)
    {
        $sql = "SELECT * FROM servicos WHERE id_servico = :idServico";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':idServico', $idServico);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return $this->criarServico($resultado);
        } else {
            return null;
        }
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM servicos";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $servicos = [];

        foreach ($resultados as $resultado) {
            $servicos[] = $this->criarServico($resultado);
        }

        return $servicos;
    }

    private function criarServico($dados)
    {
        $servico = new Servico();
        $servico->setIdServico($dados['id_servico']);
        $servico->setNome($dados['nome']);
        $servico->setValor($dados['valor']);
        $servico->setDescricao($dados['descricao']);
        $servico->setIdTipo($dados['id_tipo']);

        return $servico;
    }
}
