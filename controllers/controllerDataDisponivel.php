<?php
require_once("../model/DataDisponivel.inc.php");
require_once("../dao/DataDisponivelDAO.inc.php");


$opcao = $_REQUEST["opcao"];

/*
    $opcao == "incluirServico"
    $opcao == "alterarServico"
    $opcao == "excluirServico"
    $opcao == "buscarServicoPorId"
    $opcao == "buscarServicoPorPagina"
*/

if($opcao == "incluirDatasDisponiveis") {
    session_start();
    $idServico = $_REQUEST["idServico"];
    $inclusoesQtd = 0;
    $dtDisDAO = new DataDisponivelDAO();

    foreach($_SESSION["datasDisponiveis"] as $datas) {
        $dtDis = new DataDisponivel();
        $dtDis->setData($datas);
        $dtDis->setidServico($idServico);
        $dtDis->setDisponivel(true);
        if($dtDisDAO->inserirDataDisponivel($dtDis)) {
            $inclusoesQtd ++;
        }
    }
    if(count($_SESSION["datasDisponiveis"]) == $inclusoesQtd) {
        header("Location:../view/incluirServico.php");
    }
}

if($opcao == "alterarDatasDisponiveis"){
    session_start();
    $idServico = $_REQUEST["idServico"];
    $inclusoesQtd = 0;
    $dtDisDAO = new DataDisponivelDAO();
    $dtServico = $dtDisDAO->getDataByServicoId($idServico);
    $idDatasDisponiveis = [];
    for ($i = 1; $i <= 7; $i++) {
        $fieldName = 'data-' . $i . "-id";
        if (isset($_POST[$fieldName]) && !empty($_POST[$fieldName])) {
            $idDatasDisponiveis[] = (int) $_POST[$fieldName];
        }
    }
    foreach($_SESSION["datasDisponiveis"] as $k => $datas) {
        $dtDis = new DataDisponivel();
        if($dtServico[$k]->getIdDisponibilidade() == $idDatasDisponiveis[$k]) {
            $dtDis = $dtServico[$k];
            $dtDis->setData($datas);
            if($dtDisDAO->atualizarDataDisponivel($dtDis)) {
                $inclusoesQtd ++;
            }
        }else if(isset($datas)){
            $dtDis->setData($datas);
            $dtDis->setidServico($idServico);
            $dtDis->setDisponivel(true);
            if($dtDisDAO->inserirDataDisponivel($dtDis)) {
                $atualizacoesQtd ++;
            }
        }
    }
    $_SESSION['sucesso'] = "Registrado com sucesso.";
    header("Location:controllerServico.php?opcao=buscarPorIdParaAlterar&idServico=$idServico");
}
