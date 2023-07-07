<?php
require_once("../dao/Conexao.inc.php");
require_once("../dao/ClienteDAO.inc.php");
require_once("../model/Cliente.inc.php");

$opcao = (int)$_REQUEST["opcao"];

if ($opcao == 1) { // LOGIN

    $nome = $_REQUEST["nome"];
    $telefone = $_REQUEST["telefone"];
    $cpf = $_REQUEST["cpf"];
    $dataNascimento = $_REQUEST["dataNascimento"];
    $email = $_REQUEST["email"];
    $senha = $_REQUEST["senha"];

    /*Formatando o endereco*/
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $endereco = $logradouro . ', ' . $numero . ', ' . $complemento . '- ' . $bairro . ', ' . $cidade . '- ' . $cep;

    $clienteDAO = new ClienteDAO();

    $cliente = new Cliente();

    $cliente->setCliente($nome, $endereco, $telefone, $cpf, $dataNascimento, $email, $senha);

    $clienteDAO->inserirCliente($cliente);

    if ($cliente != null) {
        session_start();
        $_SESSION["clienteLogado"] = $cliente;
        header("Location: ../view/index.php");
    } else {
        header("Location: ../view/login.php?erro=1");
    }
} elseif ($opcao == 2) { // LOGOUT
    session_start();
    unset($_SESSION["clienteLogado"]);
    header("Location: ../view/login.php");
} elseif ($opcao == 3) { // OBTER
    $clienteDAO = new ClienteDAO();

    $clientes = $clienteDAO->buscarTodos();

    session_start();

    $_SESSION["clientes"] = $clientes;

    header("Location: ../view/listarClientes.php");
}
