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
            echo "true";
        }
    }
    if(count($_SESSION["datasDisponiveis"]) == $inclusoesQtd) {
        header("Location:../view/incluirServico.php");
    }
}
