<?php
require_once '../model/Cliente.inc.php';
require_once './includes/cabecalho.inc.php';
?>
<h1 class="text-center">Listar Clientes</h1>
<?php
if (isset($_SESSION['clientes'])) {
    $clientes = $_SESSION['clientes'];
?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($clientes as $cliente) {
            ?>
                <tr>
                    <th scope="row"><?= $cliente->getId() ?></th>
                    <td><?= $cliente->getNome() ?></td>
                    <td><?= $cliente->getEmail() ?></td>
                    <td>
                        <a href="editarCliente.php?id=<?= $cliente->getId() ?>" class="btn btn-primary"><i class="ti ti-edit"></i></a>
                        <a href="../controllers/controllerCliente.php?opcao=6&id=<?= $cliente->getId() ?>" class="btn btn-danger"><i class="ti ti-trash"></i></a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}

require_once './includes/rodape.inc.php';
?>