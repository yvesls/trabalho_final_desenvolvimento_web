<?php
require_once("Conexao.inc.php");
require_once("../model/DataDisponivel.inc.php");
class DataDisponivelDAO
{
    private $conexao;

    public function __construct()
    {
        $con = new Conexao();
        $this->conexao = $con->getConexao();
    }

    public function inserirDataDisponivel($dataDisponivel)
    {
        $sql = "INSERT INTO datasdisponiveis (id_servico, data, disponivel)
                VALUES (:idServico, :data, :disponivel)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':idServico', $dataDisponivel->getIdServico());
        $stmt->bindValue(':data', $dataDisponivel->getData());
        $stmt->bindValue(':disponivel', $dataDisponivel->getDisponivel());

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function excluirDataDisponivel($id)
    {
        $sql = "DELETE FROM datasdisponiveis WHERE id_disponibilidade = :id";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function atualizarDataDisponivel($dataDisponivel)
    {
        $sql = "UPDATE datasdisponiveis SET data = :data, disponivel = :disponivel WHERE id_disponibilidade = :id";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':data', $dataDisponivel->getData());
        $stmt->bindValue(':disponivel', $dataDisponivel->getDisponivel());
        $stmt->bindValue(':id', $dataDisponivel->getIdDisponibilidade());
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM datasdisponiveis WHERE id_disponibilidade = :id";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return $this->criarDataDisponivel($resultado);
        } else {
            return null;
        }
    }

    public function getDataByServicoId($id) {
        $sql = "SELECT * FROM datasdisponiveis dt WHERE dt.id_servico = :id";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $datasDisponiveis = [];

        foreach ($resultados as $resultado) {
            $datasDisponiveis[] = $this->criarDataDisponivel($resultado);
        }
        return $datasDisponiveis;
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM datasdisponiveis";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $datasDisponiveis = [];

        foreach ($resultados as $resultado) {
            $datasDisponiveis[] = $this->criarDataDisponivel($resultado);
        }

        return $datasDisponiveis;
    }

    private function criarDataDisponivel($dados)
    {
        $dataDisponivel = new DataDisponivel();
        $dataDisponivel->setIdServico($dados['id_servico']);
        $dataDisponivel->setIdDisponibilidade($dados['id_disponibilidade']);
        $dataDisponivel->setData($dados['data']);
        $dataDisponivel->setDisponivel($dados['disponivel']);

        return $dataDisponivel;
    }
}
