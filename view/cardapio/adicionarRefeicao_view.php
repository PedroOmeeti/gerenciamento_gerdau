<?php
session_start();
if(!isset($_SESSION['token'])) {
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
      <select class="form-select" id="id_ingrediente" name="id_ingrediente" required>
        <?php foreach ($ingredientes['dados'] as $ingrediente) { ?>
          <option value="<?= $ingrediente['id_ingrediente'] ?>"><?= $ingrediente['nome_ingrediente'] ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group mt-3">
      <label for="data">Data</label>
      <input type="date" value="" class="form-control" id="data_cardapio" name="data_cardapio">
    </div>

    <button type="submit" class="btn btn-primary mt-4">Adicionar</button>
    </form>
  </div>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>

</html>
