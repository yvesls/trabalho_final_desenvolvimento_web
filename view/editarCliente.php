<?php
require_once './includes/cabecalho.inc.php';
require_once("../dao/ClienteDAO.inc.php");
require_once("../model/Cliente.inc.php");

?>
<div class="container mx-auto">
    <h1 class="text-center">Editar Cliente</h1>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row col-8">
            <div class="mx-auto">
                <!-- Mensagens de erro e confirmação -->
                <?php
                if (isset($_REQUEST['erro']) && $_REQUEST['erro'] == 1) {
                ?>
                    <div class="alert alert-danger mb-3" role="alert">
                        Preencha todos os campos corretamente.
                    </div>
                    <?php
                }
                if (isset($_REQUEST['sucesso'])) {
                    if ($_REQUEST['sucesso'] == 1) {
                    ?>
                        <div class="alert alert-success mb-3" role="alert">
                            Cliente salvo com sucesso!
                        </div>
                        <script>
                            setTimeout(function() {
                                window.location.href = '../controllers/controllerCliente.php?opcao=3';
                            }, 2000);
                        </script>
                    <?php
                    }
                }
                //Exibe os dados do cliente salvo para ser editado
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $clienteId = $_GET['id'];
                    $clienteDAO = new ClienteDAO();
                    $cliente = $clienteDAO->buscarPorId($clienteId);

                    if ($cliente) {
                        $nome = $cliente->getNome();
                        $endereco = $cliente->getEndereco();
                        $telefone = $cliente->getTelefone();
                        $cpf = $cliente->getCpf();
                        $dataNascimento = $cliente->getDataNascimento();
                        $email = $cliente->getEmail();
                        $senha = $cliente->getSenha();
                    ?>
                        <form class="form-group mt-3 col mx-auto" id="formCliente" action="../controllers/controllerCliente.php" method="post">

                            <div class="row">
                                <div class="col">
                                    <label class="form-label" for="nome">Nome:</label><br />
                                    <input class="form-control" type="text" id="nome" name="nome" value="<?php echo $nome; ?>"><br />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label class="form-label" for="endereco">Endereço:</label><br />
                                    <input class="form-control" type="text" id="endereco" name="endereco" value="<?php echo $endereco; ?>" /><br />
                                </div>
                            </div>

                            <div class=" row">
                                <div class="col">
                                    <label class="form-label" for="telefone">Telefone:</label><br />
                                    <input class="form-control" type="number" id="telefone" name="telefone" value="<?php echo $telefone; ?>"><br />
                                </div>

                                <div class="col">
                                    <label class="form-label" for="cpf">CPF:</label><br />
                                    <input class="form-control" type="number" id="cpf" name="cpf" value="<?php echo $cpf; ?>"><br />
                                </div>

                                <div class="col">
                                    <label class="form-label" for="dataNascimento">Data Nascimento:</label><br />
                                    <input class="form-control" type="text" id="dataNascimento" name="dataNascimento" value="<?php echo $dataNascimento; ?>"><br />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label class="form-label" for="email">Email:</label><br />
                                    <input class="form-control" type="email" id="email" name="email" value="<?php echo $email; ?>" /><br />
                                </div>

                                <div class="col">
                                    <label class="form-label" for="senha">Senha:</label><br />
                                    <input class="form-control" type="password" id="senha" name="senha" value="<?php echo $senha; ?>" /><br />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="opcao" value="5">
                                    <input type="hidden" name="id" value="<?= $clienteId ?>">
                                    <input class="btn btn-primary col-12" type="submit" value="Salvar" />
                                </div>
                            </div>
                        </form>

            </div>
        </div>
    </div>
</div>

<?php
                    }
                }
                require_once './includes/rodape.inc.php';
?>