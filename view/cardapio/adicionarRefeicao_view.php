<?php
session_start();
if (!isset($_SESSION['token'])) {
  header("location: index.php");
  exit();
}
//listar pratos
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


<body>
  <?php require_once('../components/Navbar.php'); ?>
  <div class="container">
    <h1>Adicionar refeição</h1>
    <form action="../../model/actions/adicionarCardapio_controller.php" method="POST">
      <div class="form-group">
        <label for="permissao">Prato:</label>
        <select class="form-select" id="id_prato" name="id_prato" required>
          <?php foreach ($pratos['dados'] as $prato) { ?>
            <option value="<?= $prato['id_prato'] ?>"><?= $prato['nome_prato'] ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group mt-3">
        <label for="permissao">ingredientes:</label>
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
      </div>

      <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Adicionar ingredientes
</button>
<!-- data aqui -->
      <div class="form-group mt-3">
        <label for="data">Data</label>
        <input type="date" value="" class="form-control" id="data_cardapio" name="data_cardapio">
      </div>

      <button type="submit" class="btn btn-primary mt-4">Adicionar</button>
      <!-- Button trigger modal -->

   
      <!-- Modal -->
<form action="../../model/actions/adicionarIngrediente_controller.php" method="POST">
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar Ingredientes</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" id="nome_ingrediente" name="nome_ingrediente" placeholder="Nome do ingrediente" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Salvar alterações</button>
        </div>
      </div>
    </div>
  </div>
</form>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>

</html>