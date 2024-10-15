<!doctype html>
<lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <style>
      body {
        background-image: url("./assets/images/fundo.png");
        background-repeat: no-repeat;
        background-size: cover;
      }
    </style>
  </head>


  <div class="d-flex align-items-center" style="height: 100vh">
    <div class="container">
      <div class="row justify-content-center">
        <div class="card fundo border border-dark border-2" style="width: 38rem;">
          <img src="./assets/images/gerdau-logo.png" class="card-img-top d-block m-auto logo mt-3" alt="logo">
          <div class="card-body">
            <div class="col">
              <form>
                <div>
                  <h1 class="text-center fw-bold">Login</h1>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label fw-bold">Email</label>
                  <input type="email" placeholder="Digite o seu email" class="form-control border border-dark border-1" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">Nunca compartilhe o seu e-mail com ninguém.</div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label fw-bold ">Senha</label>
                  <input type="password" placeholder="Digite a sua senha" class="form-control border border-dark border-1" id="exampleInputPassword1">
                  <div class="text-end p-3">
                    <a href="#" class="text-decoration-none text-dark">Esqueceu a senha?</a>
                  </div>
                  <div class="d-grid gap-2">
                    <a href="./view/painel_adm_view.php" class="btn corBotao text-white fw-bold">Login</a>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>

  </html>