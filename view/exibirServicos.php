<?php
require_once './includes/cabecalho.inc.php';
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
                <th>Data Disponível</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php
            // Aqui você precisa obter os dados dos serviços do banco de dados
            // e percorrer os resultados para exibir na tabela
            // Substitua a parte comentada com o código correspondente para buscar os serviços no banco de dados

            // Exemplo estático de dados para teste
            $servicos = [
                [
                    'id' => 1,
                    'nome' => 'Serviço 1',
                    'tipo' => 'Tipo 1',
                    'preco' => 100.00,
                    'data' => '07/06/2023, 08/06/2023, 09/06/2023'
                ],
                [
                    'id' => 2,
                    'nome' => 'Serviço 2',
                    'tipo' => 'Tipo 2',
                    'preco' => 150.00,
                    'data' => '02/06/2023, 03/06/2023'
                ],
            ];

            foreach ($servicos as $servico) {
                ?>
                <tr>
                  <td><?= $servico['id'] ?></td>
                  <td><?= $servico['nome'] ?></td>
                  <td><?= $servico['tipo'] ?></td>
                  <td><?= $servico['preco'] ?></td>
                  <td><?= $servico['data'] ?></td>
                  <td>
                    <a href="editar_servico.php?id=<?= $servico['id'] ?>" class="btn btn-primary">Editar</a>
                    <a href="excluir_servico.php?id=<?= $servico['id'] ?>" class="btn btn-danger ml-3">Excluir</a>
                  </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php
require_once './includes/rodape.inc.php';
?>