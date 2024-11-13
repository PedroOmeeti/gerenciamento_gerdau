<?php
session_start();
if(!isset($_SESSION['token'])) {
    header("location: index.php");
    exit();
}
//listar pratos
require_once('../../model/actions/classes/cardapio_model.php');
$cardapio = new Cardapio();
$data_cardapio = isset($_GET['data_cardapio']) ? $_GET['data_cardapio'] : null;

print_r($data_cardapio);


$prato = $cardapio->listarCardapioPorDia($data_cardapio);
$prato = $prato['dados'][0];
print_r($prato);
print_r($data_cardapio);
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
        <h1>Editar</h1>
        <form action="../../model/actions/editar_prato.php" method="POST">
            <input type="hidden" name="id" value="<?= $prato['ids'] ?>" />


            <div class="form-group">
                <label for="nome">Prato:</label>
                <input type="text" value="<?= $prato['nome_prato'] ?>" class="form-control" id="nome" name="nome">
            </div>

            <div class="form-group mt-3">
                <label for="descricao">Descrição:</label>
                <input type="text" value="<?= $prato['descricao_prato'] ?>" class="form-control" id="descricao" name="descricao">
            </div>

            <div class="form-group mt-3">
                <label for="descricao">ingredientes:</label>
                <input type="text" value="<?= $prato['ingredientes'] ?>" class="form-control" id="descricao" name="descricao">
            </div>

            <button type="submit" class="btn btn-primary mt-4">Editar</button>
        </form>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>

</html>

