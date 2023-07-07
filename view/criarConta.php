<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Domésticos 007</title>
  <link rel="shortcut icon" type="image/png" href="./assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">

      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-8 p-5 col-xxl-6">
            <?php
            if (isset($_REQUEST['erro']) && $_REQUEST['erro'] == 1) {
            ?>
              <div class="alert alert-danger" role="alert">
                E-mail ou senha incorretos!
              </div>
            <?php
            }
            ?>
            <div class="card mb-0">
              <div class="card-body" style="margin-top: -20px !important;">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="./assets/images/logos/dark-logo.svg" width="180" alt="">
                </a>
                <p class="text-center" style="margin-top: -20px !important;">Seu site de serviços domésticos.</p>
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
                      Conta criada com sucesso!
                    </div>
                    <script>
                      setTimeout(function() {
                        window.location.href = '../view/login.php';
                      }, 2000);
                    </script>
                <?php
                  }
                }
                ?>
                <h3 class="text-center">Criar Conta</h3>
                <form class="form-group col mx-auto" id="formCliente" action="../controllers/controllerCliente.php" method="post">

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
                      <input type="hidden" name="opcao" value="0">
                      <input class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" type="submit" value="Criar conta" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>