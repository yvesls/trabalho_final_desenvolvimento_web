<?php
require_once '../model/tipoServico.inc.php';
require_once '../utils/utils.inc.php';
require_once 'includes/cabecalho.inc.php';

?>
<h2 class="text-center">Formulário de Serviços</h2>
<div class="container">
    <form action="../controllers/controllerServico.php" method="POST">
        <div class="form-group pb-3">
            <label for="nome">Nome *</label>
            <input type="text" class="form-control" name="nome" required>
        </div>
        <div class="form-group pb-3">
            <label for="descricao">Descrição *</label>
            <textarea class="form-control" name="descricao" required></textarea>
        </div>
        <div class="form-group pb-3">
            <label for="valor">Valor *</label>
            <input type="text" class="form-control" name="valor" required>
        </div>
        <div class="form-group pb-3">
            <label for="tipo-servico-nome">Tipo de Serviço *</label>
            <?php
                if(!isset($_SESSION["tipoServico"])) {
                    echo "<br><b>Sem registros de tipo de serviço no banco de dados. É necessário inserir ao menos um primeiro.</b>";
                }
            ?>
            <select class="form-control" name="tipo-servico-nome" required>
                <option value="">Selecione</option>
                <?php 
                    if(isset($_SESSION["tipoServico"])) {
                        $tipoServicos = $_SESSION["tipoServico"];
                        foreach($tipoServicos as $ts) {
                            ?>
                                <option value="<?= $ts->getIdTipo() ?>"><?= $ts->getNome() ?></option>
                            <?php 
                        }
                    }
                ?>
            </select>
        </div>
        <?php
        for ($i = 1; $i <= 7; $i++) {
            $label = "Data " . $i;
            $name = "data-" . $i;
            ?>
            <div class="form-group pb-3">
                <label for="<?= $name; ?>"><?= $label; ?></label>
                <input type="date" class="form-control" name="<?= $name; ?>">
            </div>
            <?php
        }
        ?>
        <input type="hidden" name="opcao" value="incluirServico">
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