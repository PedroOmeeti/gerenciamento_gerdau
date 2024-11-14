<?php
$raiz = 'http://' . $_SERVER['SERVER_NAME'] . '/gerenciamento_gerdau/';
$caminho_pagina = $raiz . 'model/actions/';

if (isset($_GET['id_prato']) && !empty($_GET['id_prato']) && isset($_GET['data_cardapio']) && !empty($_GET['data_cardapio'])) {
    $id_prato = $_GET['id_prato'];
    $data_cardapio = $_GET['data_cardapio'];
    $data_cardapio = str_replace('-', '/', date('d-m-Y', strtotime($data_cardapio)));
    
} else {
    die('Erro: Nenhum ID de prato ou data de cardápio foi fornecido.');
}

require_once('../../model/actions/classes/cardapio_model.php');
$cardapio = new Cardapio();

$pratos = $cardapio->ListarPrato();
$ingredientes = $cardapio->ListarIngredientes();
$prato = $cardapio->ListarPratoPorDia($data_cardapio, $id_prato)['dados'][0];



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
        <h1>Refeição de <?= $prato['data_cardapio'] ?></h1>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h4>Prato: </h4>
                        <p><?= htmlspecialchars($prato['nome_prato']) ?></p>
                    </div>
                    <div class="col">
                        <h4>Descrição: </h4>
                        <p><?= htmlspecialchars($prato['descricao_prato']) ?></p>
                    </div>

                </div>

                <h5 class="card-title"><?= htmlspecialchars($prato['nome_prato']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($prato['descricao_prato']) ?></p>
                <p class="card-text">Ingredientes: <?= htmlspecialchars($prato['ingredientes']) ?></p>
                <p class="card-text">Data: <?= htmlspecialchars($prato['data_cardapio']) ?></p>
            </div>
            
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>

</html>
