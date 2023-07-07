<?php
require_once './includes/cabecalho.inc.php';
require_once '../utils/utils.inc.php';

?>
<div class="container">
    <h2>Formulário de Tipos de Serviços Ofertados</h2>
    <form action="../controllers/controllerTipoServico.php" method="POST">
        <div class="form-group pb-3">
            <label for="tipo-servico-nome">Nome do Tipo de Serviço *</label>
            <input type="text" class="form-control" name="tipo-servico-nome" required>
        </div>
        <input type="hidden" name="opcao" value="incluirTipoServico">
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>    
</div>
<?php
if (isset($_SESSION["erro"])) { 
    $erro = $_SESSION["erro"];
    unset($_SESSION["erro"]);
    exibirMensagem($erro, "bg-danger", 2);
} else if (isset($_SESSION["sucesso"])) {
    $sucesso = $_SESSION["sucesso"];
    unset($_SESSION["sucesso"]);
    exibirMensagem($sucesso, "bg-success", 2);
}
require_once './includes/rodape.inc.php';
?>