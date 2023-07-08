<?php
require_once("../model/Servico.inc.php");
require_once("../dao/ServicoDAO.inc.php");

$opcao = $_REQUEST["opcao"];

/*
    $opcao == "incluirServico"
    $opcao == "alterarServico"
    $opcao == "excluirServico"
    $opcao == "buscarServicoPorId"
    $opcao == "buscarServicoPorPagina"
    $opcao == "buscarServicoPorPaginaVenda"
*/

if ($opcao == "incluirServico") {
    $s = new Servico();
    $s->setNome($_POST['nome']);
    $s->setDescricao($_POST['descricao']);
    $s->setValor($_POST['valor']);
    $s->setTipo($_POST['tipo-servico-nome']);
    $sDAO = new ServicoDAO();
    $idGerado = $sDAO->inserirServico($s);

    session_start();
    if(isset($idGerado)) {
        $_SESSION['sucesso'] = "Registrado com sucesso.";
        $datasDisponiveis = [];
        for ($i = 1; $i <= 7; $i++) {
            $fieldName = 'data-' . $i;
            if (isset($_POST[$fieldName]) && !empty($_POST[$fieldName])) {
                $datasDisponiveis[] = $_POST[$fieldName];
            }
        }
        $_SESSION["datasDisponiveis"] = $datasDisponiveis;
        header("Location:controllerDataDisponivel.php?opcao=incluirDatasDisponiveis&idServico=$idGerado");
    }else {
        $_SESSION['erro'] = "Ocorreu um erro inesperado. Contacte o administrador do sistema.";
        header("Location:../view/incluirServico.php");
    }
}

if ($opcao == "buscarServicoPorPagina" || $opcao == "buscarServicoPorPaginaPeloMenu") {
    $pagina = (int) $_REQUEST["pagina"];
    $sDAO = new ServicoDAO();
    $lista = $sDAO->buscarTodos($pagina);
    $numPaginas = $sDAO->getPagina();
    session_start();
    $_SESSION["servicos"] = $lista;
    header("Location:../view/exibirServicos.php?paginas=$numPaginas");
}

if ($opcao == "excluirServico") {
    $pagina = (int) $_REQUEST["pagina"];
    $id = $_REQUEST['idServico'];
    $ServicoDAO = new ServicoDAO();
    header("Location:../../view/editarServicos.php");
}

if ($opcao == "buscarPorIdParaAlterar") {
    $id = $_REQUEST['idServico'];
    $sDAO = new ServicoDAO();
    $s = $sDAO->buscarPorId($id);
    session_start();
    $_SESSION["servico"] = $s;
    header('Location:controllerTipoServico.php?opcao=buscarTipoServicoParaAlterarServico');
}

if ($opcao == "alterarServico") {
    $s = new Servico();
    $id = $_POST["idServico"];
    $s->setIdServico($id);
    $s->setNome($_POST['nome']);
    $s->setDescricao($_POST['descricao']);
    $s->setValor($_POST['valor']);
    $s->setTipo($_POST['tipo-servico-nome']);
    $sDAO = new ServicoDAO();
    session_start();
    if($sDAO->atualizarServico($s)) {
        $datasDisponiveis = [];
        for ($i = 1; $i <= 7; $i++) {
            $fieldName = 'data-' . $i;
            if (isset($_POST[$fieldName]) && !empty($_POST[$fieldName])) {
                $datasDisponiveis[] = $_POST[$fieldName];
            }
        }
        $_SESSION["datasDisponiveis"] = $datasDisponiveis;
        header("Location:controllerDataDisponivel.php?opcao=alterarDatasDisponiveis&idServico=$id");
    }else {
        $_SESSION['erro'] = "Ocorreu um erro inesperado. Contacte o administrador do sistema.";
        header("Location:controllerServico.php?opcao=buscarPorIdParaAlterar&idServico=$id");
    }
}

