<?php
require_once './includes/cabecalho.inc.php';
?>
<div class="container mx-auto">
    <h1 class="text-center">Editar Cliente</h1>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row col-8">
            <div class="mx-auto">
                
                <form class="form-group mt-3 col mx-auto" id="formCliente" action="../controllers/controllerCliente.php" method="post">

                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="nome">Nome:</label><br />
                            <input required class="form-control" type="text" id="nome" name="nome" /><br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="logradouro">Logradouro:</label><br />
                            <input required class="form-control" type="text" id="logradouro" name="logradouro" /><br />
                        </div>
                        <div class="col-4">
                            <label class="form-label" for="numero">Número:</label><br />
                            <input required class="form-control" type="text" id="numero" name="numero" /><br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="complemento">Complemento:</label><br />
                            <input class="form-control" type="text" id="complemento" name="complemento" /><br />
                        </div>

                        <div class="col-4">
                            <label class="form-label" for="cep">CEP:</label><br />
                            <input class="form-control" type="number" id="cep" name="cep" /><br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="cidade">Cidade:</label><br />
                            <input required class="form-control" type="text" id="cidade" name="cidade" /><br />
                        </div>
                        <div class="col">
                            <label class="form-label" for="bairro">Bairro:</label><br />
                            <input required class="form-control" type="text" id="bairro" name="bairro" /><br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="telefone">Telefone:</label><br />
                            <input required class="form-control" type="number" id="telefone" name="telefone" /><br />
                        </div>

                        <div class="col">
                            <label class="form-label" for="cpf">CPF:</label><br />
                            <input required class="form-control" type="number" id="cpf" name="cpf" /><br />
                        </div>

                        <div class="col">
                            <label class="form-label" for="dataNascimento">Data Nascimento:</label><br />
                            <input required class="form-control" type="text" id="dataNascimento" name="dataNascimento" /><br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="email">Email:</label><br />
                            <input required class="form-control" type="email" id="email" name="email" /><br />
                        </div>

                        <div class="col">
                            <label class="form-label" for="senha">Senha:</label><br />
                            <input required class="form-control" type="password" id="senha" name="senha" /><br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="opcao" value="1">
                            <input class="btn btn-primary col-12" type="submit" value="Criar conta" />
                        </div>
                    </div>
            </div>
            </form>

        </div>
    </div>
</div>

<?php
require_once './includes/rodape.inc.php';
?>