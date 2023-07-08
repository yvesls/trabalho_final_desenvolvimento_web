<?php
require_once '../model/TipoServico.inc.php';
require_once '../model/DataDisponivel.inc.php';
require_once '../utils/utils.inc.php';
require_once '../model/Servico.inc.php';
require_once 'includes/cabecalho.inc.php';
if (isset($_SESSION["erro"])) { 
    $erro = $_SESSION["erro"];
    unset($_SESSION["erro"]);
    exibirMensagem($erro, "bg-danger", 2);
} else if (isset($_SESSION["sucesso"])) {
    $sucesso = $_SESSION["sucesso"];
    unset($_SESSION["sucesso"]);
    exibirMensagem($sucesso, "bg-success", 2);
}
$servico = $_SESSION["servico"];
$tipoServicos = $_SESSION["tipoServico"];
$tipoAtual;
$tipoNomeAtual;
foreach($tipoServicos as $k => $ts) {
    if($ts->getNome() == $servico->getTipo()) {
        $tipoAtual = $ts->getIdTipo();
        $tipoNomeAtual = $ts->getNome();
        unset($tipoServicos[$k]);
        break;
    }
}
?>
<h2 class="text-center">Formulário de Serviços - Alteração</h2>
<div class="container">
    <form action="../controllers/controllerServico.php" method="POST">
        <div class="form-group pb-3">
            <label for="nome">Nome *</label>
            <input type="text" class="form-control" name="nome" required value="<?=$servico->getNome()?>">
        </div>
        <div class="form-group pb-3">
            <label for="descricao">Descrição *</label>
            <textarea class="form-control" name="descricao" required><?=$servico->getDescricao()?></textarea>
        </div>
        <div class="form-group pb-3">
            <label for="valor">Valor *</label>
            <input type="text" class="form-control" name="valor" required value="<?=$servico->getValor()?>">
        </div>
        <div class="form-group pb-3">
            <label for="tipo-servico-nome">Tipo de Serviço *</label>
            <select class="form-control" name="tipo-servico-nome" required>
                <option  value="<?=$tipoAtual?>"><?=$tipoNomeAtual?></option>
                <?php 
                    foreach($tipoServicos as $ts) {
                        ?>
                            <option value="<?= $ts->getIdTipo() ?>"><?= $ts->getNome() ?></option>
                        <?php 
                    }
                ?>
            </select>
        </div>
        <?php
        $datas = $servico->getDatasDisponiveis();
        for ($i = 1; $i <= 7; $i++) {
            $label = "Data " . $i;
            $name = "data-" . $i;
            $nameIdData = "data-" . $i . "-id";
            $valueIdData = "";
            $data = "";
            if(isset($datas[$i])){
                $data = $datas[$i]->getData();
                $valueIdData = $datas[$i]->getIdDisponibilidade();
            }
            ?>
            <div class="form-group pb-3">
                <label for="<?= $name; ?>"><?= $label; ?></label>
                <input type="date" class="form-control" name="<?= $name; ?>" value="<?=$data?>">
                <input type="hidden" name="idServico" value="<?=$servico->getIdServico()?>">
                <input type="hidden" name="<?=$nameIdData?>" value="<?=$valueIdData?>">
            </div>
            <?php
        }
        ?>
        <input type="hidden" name="opcao" value="alterarServico">
        <input type="hidden" name="idServico" value="<?=$servico->getIdServico()?>">
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
<?php
require_once './includes/rodape.inc.php';
?>