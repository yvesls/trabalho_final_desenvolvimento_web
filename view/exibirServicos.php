<?php
require_once '../model/Servico.inc.php';
require_once '../model/DataDisponivel.inc.php';
require_once '../utils/utils.inc.php';
require_once './includes/cabecalho.inc.php';
$paginas = $_REQUEST["paginas"];
if (isset($_SESSION["erro"])) { 
    $erro = $_SESSION["erro"];
    unset($_SESSION["erro"]);
    exibirMensagem($erro, "bg-danger", 2);
} else if (isset($_SESSION["sucesso"])) {
    $sucesso = $_SESSION["sucesso"];
    unset($_SESSION["sucesso"]);
    exibirMensagem($sucesso, "bg-success", 2);
}
?>
<div class="container">
    <h2>Lista de Serviços Cadastrados</h2>
    <table class="table">
        <thead class="text-center">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Preço</th>
                <th>Datas Disponíveis</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php
            $servicos = $_SESSION['servicos'];
            $datas = "";
            foreach ($servicos as $servico) {
                foreach ($servico->getDatasDisponiveis() as $dt) {
                    if($servico->getIdServico() == $dt->getIdServico())
                        $datas .= $dt->getData().", ";
                }
            }
            foreach ($servicos as $servico) {
                $datas = "";
                foreach ($servico->getDatasDisponiveis() as $dt) {
                    if($servico->getIdServico() == $dt->getIdServico())
                        $datas .= formatarData(strtotime($dt->getData())).", ";
                }
                ?>
                <tr>
                  <td><?= $servico->getIdServico() ?></td>
                  <td><?= $servico->getNome() ?></td>
                  <td><?= $servico->getTipo() ?></td>
                  <td><?= $servico->getValor() ?></td>
                  <td><?= $datas ?></td>
                  <td>
                    <a href="editar_servico.php?id=<?= $servico->getIdServico() ?>" class="btn btn-primary">Editar</a>
                    <a href="../controllers//controllerServico.php?opcao=excluirServico&pagina=<?=$paginas?>&idServico=<?=$servico->getIdServico() ?>" class="btn btn-danger ml-3">Excluir</a>
                  </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
       
    </table>
</div>
    <div class="w-25 m-auto">
    <?php
        for ($i = 1; $i <= $paginas; $i++) {
        ?>
            <a class="p-2 text-center mr-1 w-25" href="../controllers/controllerServico.php?opcao=buscarServicoPorPagina&pagina=<?= $i ?>">
                <div class="bg-primary w-25 rounded text-white"> <?= $i ?></div>
            </a>
        <?php
        }
        ?>
    </div>
<?php
require_once './includes/rodape.inc.php';
?>