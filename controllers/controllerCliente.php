<?php
require_once("../dao/Conexao.inc.php");
require_once("../dao/ClienteDAO.inc.php");
require_once("../model/Cliente.inc.php");

$opcao = (int)$_REQUEST["opcao"];

if($opcao == 1){ // LOGIN
    $email = $_REQUEST["email"];
    $senha = $_REQUEST["senha"];

    $clienteDAO = new ClienteDAO();

    $cliente = $clienteDAO->autenticar($email, $senha);

    if($cliente != null){
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
}
?>