<?php
  session_start();
  
  if(!isset($_SESSION['token'])) {
    header("location: index.php");
    exit();
  }


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Informações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <?php require_once('../components/Navbar.php'); ?>
  <div class="d-flex align-items-center" style="height: 61vh">
    <div class="container">
      <div class="row justify-content-center">
        <div class="card border border-dark border-2" style="width: 60rem;">
          <div class="card-body d-flex">
            <div class="col-4 bg-body-tertiary border border-2 border-dark">
              <img src="../../assets/images/person.png" style="width: 100%;" alt="">  
            </div>
            <div class="col-8">
              <form action="../../model/actions/editarEmailUsuario.php" method="POST" class="d-flex flex-column justify-content-start align-items-center">
                <div class="form-group col-md-9">
                    <p class="fs-5 mt-2"><strong>Nome:</strong> <?php echo $_SESSION['nome_usuario']; ?></p>
                </div>
                <div class="form-group col-md-9">
                    <p class="fs-5"><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
                </div>
                <div class="form-group col-md-9">
                    <p class="fs-5"><strong>Chapa:</strong> <?php echo $_SESSION['chapa']; ?></p>
                </div>
                <div class="form-group col-md-9">
                    <label class="fs-5" for="permissao"><strong>Permissão:</strong></label>
                    <select class="form-select" disabled id="permissao" name="permissao" required>
                        <option value="1">Administrador</option>
                        <option value="0">Funcionário</option>
                    </select>
                </div>
                <div class="d-grid gap-2 col-md-9">
                  <a href="./mudarSenhaUsuario.php" class="btn btn-primary mt-4">Mudar senha</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    require_once('../components/Rodape.php');
  ?>
</body>

</html>