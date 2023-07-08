<?php
require_once("Conexao.inc.php");
require_once("../model/Servico.inc.php");
require_once("../model/DataDisponivel.inc.php");
require_once("DataDisponivelDAO.inc.php");
class ServicoDAO
{
    private $conexao;
    private $porPagina;
    public function __construct()
    {
        $con = new Conexao();
        $this->conexao = $con->getConexao();
        $this->porPagina = 10;
    }

    public function inserirServico($servico)
    {
        try{
            $sql = "INSERT INTO servicos (nome, valor, descricao, id_tipo)
                    VALUES (:nome, :valor, :descricao, :idTipo)";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':nome', $servico->getNome());
            $stmt->bindValue(':valor', $servico->getValor());
            $stmt->bindValue(':descricao', $servico->getDescricao());
            $stmt->bindValue(':idTipo', $servico->getTipo());

            $stmt->execute();
            $idGerado = $this->conexao->lastInsertId();

            return $idGerado;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return null;
        }
    }

    public function excluirServico($idServico)
    {
        $sql = "DELETE FROM servicos WHERE id_servico = :idServico";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':idServico', $idServico);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function atualizarServico($servico)
    {
        $sql = "UPDATE servicos SET nome = :nome, valor = :valor, descricao = :descricao, id_tipo = :idTipo
                WHERE id_servico = :idServico";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':nome', $servico->getNome());
        $stmt->bindValue(':valor', $servico->getValor());
        $stmt->bindValue(':descricao', $servico->getDescricao());
        $stmt->bindValue(':idTipo', $servico->getTipo());
        $stmt->bindValue(':idServico', $servico->getIdServico());

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function buscarPorId($idServico)
    {
        $sql = "SELECT s.id_servico, s.nome, s.valor, s.descricao, ts.nome tipo
                                        FROM servicos s 
                                        INNER JOIN tipo ts
                                        ON s.id_tipo = ts.id_tipo WHERE s.id_servico = :idServico";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':idServico', $idServico);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $dataDAO = new DataDisponivelDAO();
        if ($resultado) {
            return $this->criarServico($resultado, $dataDAO);
        } else {
            return null;
        }
    }

    public function buscarTodos($pagina)
    {
        $in = ($pagina - 1) * $this->porPagina;

        $stmt = $this->conexao->prepare("SELECT s.id_servico, s.nome, s.valor, s.descricao, ts.nome tipo
                                        FROM servicos s 
                                        INNER JOIN tipo ts
                                        ON s.id_tipo = ts.id_tipo
                                        LIMIT :in, :porPagina");
        $stmt->bindValue(':in', $in, PDO::PARAM_INT);
        $stmt->bindValue(':porPagina', $this->porPagina, PDO::PARAM_INT);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $servicos = [];
        $dataDAO = new DataDisponivelDAO();
        foreach ($resultados as $resultado) {
            $servicos[] = $this->criarServico($resultado, $dataDAO);
        }

        return $servicos;
    }

    private function criarServico($dados, $dataDAO)
    {
        $id = $dados['id_servico'];
        $servico = new Servico();
        $servico->setIdServico($id);
        $servico->setNome($dados['nome']);
        $servico->setValor($dados['valor']);
        $servico->setDescricao($dados['descricao']);
        $servico->setTipo($dados['tipo']);
        if($dataDAO != null){
            $datasRetorno = $dataDAO->getDataByServicoId($id);
            if(count($datasRetorno) > 0) {
                $servico->adicionarDataDisponivel($datasRetorno);
            }
        }
        return $servico;
    }

    public function getPagina()
    {
        $total_result = $this->conexao->query("SELECT count(*) as total FROM servicos")->fetch(PDO::FETCH_OBJ);
        $num_paginas = ceil($total_result->total / $this->porPagina);
        return $num_paginas;
    }
}
