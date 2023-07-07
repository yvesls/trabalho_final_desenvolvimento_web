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
    $ts = new Servico();
    $ts->setNome($_POST['nome']);
    $ts->setDescricao($_POST['descricao']);
    $ts->setValor($_POST['valor']);
    $ts->setIdTipo($_POST['tipo-servico-nome']);
    $tsDAO = new ServicoDAO();
    $idGerado = $tsDAO->inserirServico($ts);

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

if ($opcao == "exibirTodos" || $opcao == "exibirProdutosVenda") {    //Exibir todos os produtos

    $produtoDAO = new ProdutoDAO();
    $listaProdutos = $produtoDAO->getProdutos();
    //Coloca a lista de produtos na sessão
    session_start();
    $_SESSION["produtos"] = $listaProdutos;
    if ($opcao == "exibirTodos") {
        header("Location: ../views/exibirProdutos.php");
    } else {
        header("Location: ../views/exibirProdutosVenda.php");
    }
}

if ($opcao == "excluir") {
    $id = $_REQUEST['id'];
    $ProdutoDAO = new ProdutoDAO();
    deletarFoto($produtoDao->getProduto($id)->getReferencia());
    $ProdutoDAO->excluirProduto($id);
    header('Location: controllers/../controllerProduto.php?opcao=exibirTodos');
}
if ($opcao == "buscarPorId") {
    $id = $_REQUEST['id'];
    $produtoDAO = new ProdutoDAO();
    $produto = $produtoDAO->consultarProdutoPorId($id);
    session_start();
    $_SESSION["produto"] = $produto;
    header('Location: controllerFabricante.php?opcao=exibirTodosPorAlterar');
}

if ($opcao == "alterar") {
    $retorno_verificacao = validate("alterar");
    if ($retorno_verificacao == null) {
        $produto = new Produto();
        $produto->setProdutoId($_POST['produto_id']);
        $produto->setNome($_POST['nome']);
        $produto->setDescricao((string) $_POST['descricao']);
        $produto->setEstoque($_POST['estoque']);
        $produto->setFabricante($_POST['fabricante']);
        $produto->setPreco($_POST['preco']);
        $produto->setReferencia($_POST['referencia']);
        $produtoDAO = new ProdutoDAO();

        $produtoOld = $produtoDAO->consultarProdutoPorId($id);

        if(isset($_FILES["imagem"]) && $_FILES["imagem"] != NULL){
            deletarFoto($produtoOld->getReferencia());
            uploadFotos($referencia);
        } else {
            if($produtoOld->getReferencia() != $referencia){
                renomearFoto($produtoOld->getReferencia(), $referencia);
            }
        }

        $produtoDAO->atualizarProduto($produto);
        header('Location: controllers/../controllerProduto.php?opcao=exibirTodos');
    } else {
        session_start();
        $_SESSION['erro1'] = $retorno_verificacao;
        header("Location:../views/formAlterarProduto.php?erro=1");
    }
}

if ($opcao == "porPagina") {

    $pagina = (int) $_REQUEST["pagina"];
    $produtoDAO = new ProdutoDAO();
    $lista = $produtoDAO->getProdutosPaginacao($pagina);
    $numPaginas = $produtoDAO->getPagina();
    session_start();
    $_SESSION["produtos"] = $lista;
    header("Location: ../views/exibirProdutosPaginacao.php?paginas=$numPaginas");
}
