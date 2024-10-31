<?php
if (isset($_GET['id'])) {
    require_once('../model/actions/classes/prato_class.php');
    $c = new Prato();
    $c->id = $_GET['id'];
    $resultado = $c->ListarPorID();
    if (count($resultado) == 1) {
      $resultado = $resultado[0];
      // print_r($resultado);
    } else {
      $erro = 1;
    }
  } else {
    $erro = 1;
  }
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
    <?php require_once('./components/Navbar.php'); ?>
    <div class="container">
    <h1>Edição</h1>
    <form action="actions/editar_produto.php" method="POST">
      <input type="hidden" name="id" value="<?= $resultado['id'] ?>" />


      <div class="form-group">
        <label for="nome">Prato:</label>
        <input type="text" value="<?= $resultado['nome_prato'] ?>" class="form-control" id="nome" name="nome">
      </div>

      <div class="form-group mt-3">
        <label for="descricao">Descrição:</label>
        <input type="text" value="<?= $resultado['descricao_prato'] ?>" class="form-control" id="descricao" name="descricao">
      </div>

      <button type="submit" class="btn btn-primary mt-4">Editar</button>
    </form>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>

</html>
