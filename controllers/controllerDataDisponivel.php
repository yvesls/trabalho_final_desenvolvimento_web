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

