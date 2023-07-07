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

        $nome = $cliente->getNome();
        $endereco = $cliente->getEndereco();
        $telefone = $cliente->getTelefone();
        $cpf = $cliente->getCpf();
        $dataNascimento = $cliente->getDataNascimento();
        $email = $cliente->getEmail();
        $senha = $cliente->getSenha();

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':dataNascimento', $dataNascimento);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

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

    public function atualizarCliente(Cliente $cliente, $id)
    {
        $sql = "UPDATE clientes SET Nome = :nome, Endereco = :endereco, Telefone = :telefone, CPF = :cpf,
                DtNascimento = :dataNascimento, Email = :email, Senha = :senha WHERE idCliente = :id";

        $nome = $cliente->getNome();
        $endereco = $cliente->getEndereco();
        $telefone = $cliente->getTelefone();
        $cpf = $cliente->getCpf();
        $dataNascimento = $cliente->getDataNascimento();
        $email = $cliente->getEmail();
        $senha = $cliente->getSenha();
        // $id = $cliente->getId();

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':dataNascimento', $dataNascimento);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM clientes WHERE idCliente = :id";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
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
        $cliente->setId($dados['idCliente']);
        $cliente->setNome($dados['Nome']);
        $cliente->setEndereco($dados['Endereco']);
        $cliente->setTelefone($dados['Telefone']);
        $cliente->setCpf($dados['CPF']);
        $cliente->setDataNascimento($dados['DtNascimento']);
        $cliente->setEmail($dados['Email']);

        return $cliente;
    }

    function autenticar($email, $senha)
    {
        $con = new Conexao();
        $conexao = $con->getConexao();

        $sql = $conexao->prepare("SELECT * FROM clientes WHERE Email = :email AND Senha = :pass");

        $email = strtolower($email);

        $sql->bindValue(':email', $email);
        $sql->bindValue(':pass', $senha);
        $sql->execute();

        $count = $sql->rowCount();

        if ($count == 1) {
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $cliente = $this->criarCliente($row);
            return $cliente;
        }

        return null;
    }
}
