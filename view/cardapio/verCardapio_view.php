<?php
session_start();
if (!isset($_SESSION['token'])) {
  header("location: index.php");
  exit();
}

// Listar pratos e ingredientes
require_once('../../model/actions/classes/cardapio_model.php');
$cardapio = new Cardapio();

$pratos = $cardapio->ListarPrato();
$ingredientes = $cardapio->ListarIngredientes();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cardápio</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</head>

<body style="background-color: #f8f9fa;">
  <?php require_once('../components/Navbar.php'); ?>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-header text-white" style="background-color: #B49C5E;">
            <h4 class="mb-0">Adicionar Refeição</h4>
          </div>
          <div class="card-body">
            <form action="../../model/actions/adicionarCardapio_controller.php" method="POST">
              <!-- Seção de pratos -->
              <div class="form-group">
                <label for="id_prato">Prato:</label>
                <?php if (!empty($pratos['dados'])) { ?>
                  <select class="form-select" id="id_prato" name="id_prato" required>
                    <?php foreach ($pratos['dados'] as $prato) { ?>
                      <option value="<?= $prato['id_prato'] ?>"><?= $prato['nome_prato'] ?></option>
                    <?php } ?>
                  </select>
                <?php } else { ?>
                  <p class="text-danger">Nenhum prato disponível. <a href="adicionarPrato_view.php">Adicionar prato</a></p>
                <?php } ?>
              </div>

              <!-- Seção de ingredientes -->
              <div class="form-group mt-3">
                <label for="id_ingrediente">Ingredientes:</label>
                <?php if (!empty($ingredientes['dados'])) { ?>
                  <div class="row">
                    <div class="col">
                      <?php foreach (array_slice($ingredientes['dados'], 0, ceil(count($ingredientes['dados']) / 2)) as $ingrediente) { ?>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="<?= $ingrediente['id_ingrediente'] ?>" id="id_ingrediente_<?= $ingrediente['id_ingrediente'] ?>" name="id_ingrediente[]">
                          <label class="form-check-label" for="id_ingrediente_<?= $ingrediente['id_ingrediente'] ?>">
                            <?= $ingrediente['nome_ingrediente'] ?>
                          </label>
                        </div>
                      <?php } ?>
                    </div>
                    <div class="col">
                      <?php foreach (array_slice($ingredientes['dados'], ceil(count($ingredientes['dados']) / 2)) as $ingrediente) { ?>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="<?= $ingrediente['id_ingrediente'] ?>" id="id_ingrediente_<?= $ingrediente['id_ingrediente'] ?>" name="id_ingrediente[]">
                          <label class="form-check-label" for="id_ingrediente_<?= $ingrediente['id_ingrediente'] ?>">
                            <?= $ingrediente['nome_ingrediente'] ?>
                          </label>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                <?php } else { ?>
                  <p class="text-danger">Nenhum ingrediente disponível. <a href="adicionarIngredientes_view.php">Adicionar ingredientes</a></p>
                <?php } ?>
              </div>

              <!-- Link para adicionar ingredientes -->
              <a href="adicionarIngredientes_view.php" class="btn btn-secondary mt-3">
                Adicionar ingredientes
              </a>

              <!-- Campo de data -->
              <div class="form-group mt-3">
                <label for="data_cardapio">Data:</label>
                <input type="date" value="<?= date('Y-m-d') ?>" class="form-control" id="data_cardapio" name="data_cardapio">
              </div>

              <!-- Botão de submit -->
              <button type="submit" class="btn mt-4 text-white" style="background-color: #B49C5E;">Adicionar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
