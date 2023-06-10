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

    public function inserirTipoServico(TipoServico $tipoServico)
    {
        $sql = "INSERT INTO tipo (nome, valor)
                VALUES (:nome, :valor)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nome', $tipoServico->getNome());
        $stmt->bindParam(':valor', $tipoServico->getValor());

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
        $stmt->bindParam(':idTipo', $idTipo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function atualizarTipoServico(TipoServico $tipoServico)
    {
        $sql = "UPDATE tipo SET nome = :nome, valor = :valor
                WHERE id_tipo = :idTipo";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nome', $tipoServico->getNome());
        $stmt->bindParam(':valor', $tipoServico->getValor());
        $stmt->bindParam(':idTipo', $tipoServico->getIdTipo());

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
        $stmt->bindParam(':idTipo', $idTipo);
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
        $tipoServico->setIdTipo($dados['id_tipo']);
        $tipoServico->setNome($dados['nome']);
        $tipoServico->setValor($dados['valor']);

        return $tipoServico;
    }
}
