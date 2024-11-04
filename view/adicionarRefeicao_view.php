<?php


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
    <form action="../model/actions/editar_prato.php" method="POST">

      <div class="form-group">
        <label for="nome">Prato:</label>
        <input type="text" value="" class="form-control" id="nome" name="nome">
      </div>

      <div class="form-group mt-3">
        <label for="descricao">Descrição:</label>
        <input type="text" value="" class="form-control" id="descricao" name="descricao">
      </div>

      <div class="form-group mt-3">
        <label for="Imagem">Imagem</label>
        <input type="file" value=">" class="form-control" id="imagem" name="imagem">
      </div>

      <button type="submit" class="btn btn-primary mt-4">Adicionar</button>
    </form>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>

</html>
