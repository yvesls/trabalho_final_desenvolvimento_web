<?php
require_once("Conexao.inc.php");
require_once("../model/TipoServico.inc.php");
class TipoServicoDAO
{
    private $conexao;

    public function __construct()
    {
        $con = new Conexao();
        $this->conexao = $con->getConexao();
    }

    public function inserirTipoServico($tipoServico)
    {
        $sql = "INSERT INTO tipo (nome)
                VALUES (:nome)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':nome', $tipoServico->getNome());

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function excluirTipoServico($idTipo)
    {
        $sql = "DELETE FROM tipo WHERE id_tipo = :idTipo";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':idTipo', $idTipo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function atualizarTipoServico($tipoServico)
    {
        $sql = "UPDATE tipo SET nome = :nome
                WHERE id_tipo = :idTipo";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':nome', $tipoServico->getNome());
        $stmt->bindValue(':idTipo', $tipoServico->getIdTipo());

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function buscarPorId($idTipo)
    {
        $sql = "SELECT * FROM tipo WHERE id_tipo = :idTipo";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':idTipo', $idTipo);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return $this->criarTipoServico($resultado);
        } else {
            return null;
        }
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM tipo";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $tiposServico = [];

        foreach ($resultados as $resultado) {
            $tiposServico[] = $this->criarTipoServico($resultado);
        }

        return $tiposServico;
    }

    private function criarTipoServico($dados)
    {
        $tipoServico = new TipoServico();
        echo $dados['id_tipo'];
        echo $dados['nome'];
        $tipoServico->setIdTipo($dados['id_tipo']);
        $tipoServico->setNome($dados['nome']);
        return $tipoServico;
    }
}
