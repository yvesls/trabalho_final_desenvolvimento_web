<?php
require_once './includes/cabecalho.inc.php';
?>
<div class="container mx-auto">
    <h1 class="text-center">Cadastrar Cliente</h1>
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
                            Cliente cadastrado com sucesso!
                        </div>
                        <script>
                            setTimeout(function() {
                                window.location.href = '../controllers/controllerCliente.php?opcao=3';
                            }, 2000);
                        </script>
                <?php
                    }
                }
                ?>
                <form class="form-group mt-3 col mx-auto" id="formCliente" action="../controllers/controllerCliente.php" method="post">

                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="nome">Nome:</label><br />
                            <input required class="form-control" type="text" id="nome" name="nome" /><br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="endereco">Endereço:</label><br />
                            <input required class="form-control" type="text" id="endereco" name="endereco" /><br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="telefone">Telefone:</label><br />
                            <input class="form-control" type="number" id="telefone" name="telefone" /><br />
                        </div>

                        <div class="col">
                            <label class="form-label" for="cpf">CPF:</label><br />
                            <input class="form-control" type="number" id="cpf" name="cpf" /><br />
                        </div>

                        <div class="col">
                            <label class="form-label" for="dataNascimento">Data Nascimento:</label><br />
                            <input class="form-control" type="text" id="dataNascimento" name="dataNascimento" /><br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="email">Email:</label><br />
                            <input class="form-control" type="email" id="email" name="email" /><br />
                        </div>

                        <div class="col">
                            <label class="form-label" for="senha">Senha:</label><br />
                            <input class="form-control" type="password" id="senha" name="senha" /><br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="opcao" value="4">
                            <input class="btn btn-primary col-12" type="submit" value="Criar conta" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php
require_once './includes/rodape.inc.php';
?>