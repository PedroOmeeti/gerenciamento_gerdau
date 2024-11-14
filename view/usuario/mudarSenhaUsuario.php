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
                <form action="../../model/actions/#" method="POST" class="d-flex flex-column justify-content-start align-items-center">

                  <div class="text-center form-group col-md-9">
                    <p class="fs-4"><strong>Mudar Senha</strong></p>
                  </div>
                  <div class="form-group col-md-9">
                    <label class="fs-5" for="senha"><strong>Nova Senha:</strong></label>
                    <input type="password" placeholder="Digite uma nova senha" onkeyup="verificarSenha()" class="form-control" id="senha" name="senha" required>
                  </div>
                  <div class="form-group col-md-9">
                    <label class="fs-5 mt-4" for="csenha"><strong>Confirme sua nova Senha:</strong></label>
                    <input type="password" placeholder="Digite uma nova senha" onkeyup="verificarSenha()" class="form-control mb-1" id="csenha" name="csenha" required>
                    <div id="verificao" class="text-end text-form text-danger"></div>
                  </div>
                  <div class="d-grid gap-2 col-md-9">
                    <button type="submit" id="botao" disabled class="btn btn-primary mt-2">Mudar Senha</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      
      function verificarSenha() {
         var senha = document.getElementById("senha").value;
         var csenha = document.getElementById("csenha").value;
         
         if (senha == "" || csenha == "") {
           document.getElementById("botao").disabled = true;
           if (senha != csenha || csenha != senha) {
              document.getElementById("verificao").innerHTML = "As senhas não coincidem.";
            }
            
         } else {
            document.getElementById("verificao").innerHTML = "";
            document.getElementById("botao").disabled = false;
         }
      }
    </script>
    <?php
    require_once('../components/Rodape.php');
    ?>
  </body>

</html>