<?php
require_once("../dao/Conexao.inc.php");
require_once("../dao/ClienteDAO.inc.php");
require_once("../model/Cliente.inc.php");

$opcao = (int)$_REQUEST["opcao"];

if ($opcao == 1) { // LOGIN
    $email = $_REQUEST["email"];
    $senha = $_REQUEST["senha"];

    $clienteDAO = new ClienteDAO();

    $cliente = $clienteDAO->autenticar($email, $senha);

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
} else if ($opcao == 4) { //CRIAR CLIENTE
    $nome = $_REQUEST["nome"];
    $endereco = $_REQUEST["endereco"];
    $telefone = $_REQUEST["telefone"];
    $cpf = $_REQUEST["cpf"];
    $dataNascimento = $_REQUEST["dataNascimento"];
    $email = $_REQUEST["email"];
    $senha = $_REQUEST["senha"];

    $clienteDAO = new ClienteDAO();

    $cliente = new Cliente();

    $cliente->setCliente($nome, $endereco, $telefone, $cpf, $dataNascimento, $email, $senha);

    $clienteDAO->inserirCliente($cliente);

    if ($cliente != null) {
        header("Location:../view/cadastrarCliente.php?sucesso=1");
        //header("refresh:3; url=../view/login.php");
    } else {
        header("Location: ../view/cadastrarCliente.php?erro=1");
    }
} else if ($opcao == 5) { //EDITAR CLIENTE
    $nome = $_REQUEST["nome"];
    $endereco = $_REQUEST["endereco"];
    $telefone = $_REQUEST["telefone"];
    $cpf = $_REQUEST["cpf"];
    $dataNascimento = $_REQUEST["dataNascimento"];
    $email = $_REQUEST["email"];
    $senha = $_REQUEST["senha"];

    $clienteDAO = new ClienteDAO();

    $cliente = new Cliente();

    $cliente->setCliente($nome, $endereco, $telefone, $cpf, $dataNascimento, $email, $senha);

    $clienteDAO->inserirCliente($cliente);

    if ($cliente != null) {
        header("Location:../view/cadastrarCliente.php?sucesso=1");
        //header("refresh:3; url=../view/login.php");
    } else {
        header("Location: ../view/cadastrarCliente.php?erro=1");
    }
}
