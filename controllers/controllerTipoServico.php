<?php
require_once("../model/TipoServico.inc.php");
require_once("../dao/TipoServicoDAO.inc.php");

$opcao = $_REQUEST["opcao"];

/*
    $opcao == "incluirTipoServico"
    $opcao == "alterarTipoServico"
    $opcao == "excluirTipoServico"
    $opcao == "buscarTipoServicoPorId"
    $opcao == "buscarTipoServicoPorIdServico"
*/

if($opcao == "incluirTipoServico") {
    $ts = new TipoServico();
    $ts->setNome($_POST['tipo-servico-nome']);
    $tsDAO = new TipoServicoDAO();

    session_start();
    if($tsDAO->inserirTipoServico($ts)) {
        $_SESSION['sucesso'] = "Registrado com sucesso.";
    }else {
        $_SESSION['erro'] = "Ocorreu um erro inesperado. Contacte o administrador do sistema.";
    }
    header("Location:../view/incluirTipoServico.php");
}

if($opcao == "buscarTipoServicoParaIncluirServico") {
    $tsDAO = new TipoServicoDAO();

    $ts = $tsDAO->buscarTodos();

    session_start();
    if(!empty($ts)) {
        $_SESSION["tipoServico"] = $ts;
    }
    header("Location:../view/incluirServico.php");
}