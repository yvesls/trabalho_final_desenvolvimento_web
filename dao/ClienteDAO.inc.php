<?php
require_once("Conexao.inc.php");
require_once("../model/Cliente.inc.php");
class ClienteDAO
{
    private $conexao;

    public function __construct()
    {
        $con = new Conexao();
        $this->conexao = $con->getConexao();
    }

    public function inserirCliente(Cliente $cliente)
    {
        $sql = "INSERT INTO clientes (Nome, Endereco, Telefone, CPF, DtNascimento, Email, Senha)
                VALUES (:nome, :endereco, :telefone, :cpf, :dataNascimento, :email, :senha)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nome', $cliente->getNome());
        $stmt->bindParam(':endereco', $cliente->getEndereco());
        $stmt->bindParam(':telefone', $cliente->getTelefone());
        $stmt->bindParam(':cpf', $cliente->getCpf());
        $stmt->bindParam(':dataNascimento', $cliente->getDataNascimento());
        $stmt->bindParam(':email', $cliente->getEmail());
        $stmt->bindParam(':senha', $cliente->getSenha());

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function excluirCliente($codCliente)
    {
        $sql = "DELETE FROM clientes WHERE CodCli = :codCliente";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':codCliente', $codCliente);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function atualizarCliente(Cliente $cliente)
    {
        $sql = "UPDATE clientes SET Nome = :nome, Endereco = :endereco, Telefone = :telefone, CPF = :cpf,
                DtNascimento = :dataNascimento, Email = :email, Senha = :senha WHERE CodCli = :codCliente";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nome', $cliente->getNome());
        $stmt->bindParam(':endereco', $cliente->getEndereco());
        $stmt->bindParam(':telefone', $cliente->getTelefone());
        $stmt->bindParam(':cpf', $cliente->getCpf());
        $stmt->bindParam(':dataNascimento', $cliente->getDataNascimento());
        $stmt->bindParam(':email', $cliente->getEmail());
        $stmt->bindParam(':senha', $cliente->getSenha());
        $stmt->bindParam(':codCliente', $cliente->getCodCliente());

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function buscarPorId($codCliente)
    {
        $sql = "SELECT * FROM clientes WHERE CodCli = :codCliente";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':codCliente', $codCliente);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return $this->criarCliente($resultado);
        } else {
            return null;
        }
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM clientes";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $clientes = [];

        foreach ($resultados as $resultado) {
            $clientes[] = $this->criarCliente($resultado);
        }

        return $clientes;
    }

    private function criarCliente($dados)
    {
        $cliente = new Cliente();
        $cliente->setCodCliente($dados['CodCli']);
        $cliente->setNome($dados['Nome']);
        $cliente->setEndereco($dados['Endereco']);
        $cliente->setTelefone($dados['Telefone']);
        $cliente->setCpf($dados['CPF']);
        $cliente->setDataNascimento($dados['DtNascimento']);
        $cliente->setEmail($dados['Email']);

        return $cliente;
    }
}
