<?php
require_once 'includes/cabecalho.inc.php';
require_once '../model/tipoServico.inc.php';
session_start();

if(isset($_SESSION["tipoServico"])) {
    $tipoServicos = $_SESSION["tipoServico"];
    foreach($tipoServicos as $ts) {
        echo "<div value=''>". $ts->getNome() ."</div>";
    }
}
?>
<div class="container">
    <h2>Formulário de Serviços</h2>
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
                        foreach($tipoServicos as $ts) {
                            echo "<option value=". $ts->getIdTipo() .">". $ts->getNome() ."</option>";
                        }
                    }
                ?>
            </select>
        </div>
        <div class="form-group pb-3">
            <label for="data-1">Data 1 *</label>
            <input type="date" class="form-control" name="data-1" required>
        </div>
        <div class="form-group pb-3">
            <label for="data-2">Data 2</label>
            <input type="date" class="form-control" name="data-2">
        </div>
        <div class="form-group pb-3">
            <label for="data-3">Data 3</label>
            <input type="date" class="form-control" name="data-3">
        </div>
        <div class="form-group pb-3">
            <label for="data-4">Data 4</label>
            <input type="date" class="form-control" name="data-4">
        </div>
        <div class="form-group pb-3">
            <label for="data-5">Data 5</label>
            <input type="date" class="form-control" name="data-5">
        </div>
        <div class="form-group pb-3">
            <label for="data-6">Data 6</label>
            <input type="date" class="form-control" name="data-6">
        </div>
        <div class="form-group pb-3">
            <label for="data-7">Data 7</label>
            <input type="date" class="form-control" name="data-7">
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
<?php
require_once './includes/rodape.inc.php';
?>