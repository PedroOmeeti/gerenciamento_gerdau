<?php

require_once('../../model/actions/classes/cardapio_model.php');

$cardapio = new Cardapio();

$data_agendamento = date('d/m/Y');
$listaPedidos = $cardapio->ListarPedidoPorDia($data_agendamento);
print_r($listaPedidos);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php require_once('../components/Navbar.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Cozinha</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h1 class="text-center">Agendamentos</h1>
            </div>
        </div>
        <div class="row border border-2 border-dark p-3 rounded">
            <div class="col">
                <h4>Pedidos de hoje:</h4>

            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php
                foreach ($listaPedidos['dados'] as $pedido) {
                    echo '<div class="card mt-3">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $pedido['prato'] . '</h5>';
                    echo '<p class="card-text">Quantidade: ' . $pedido['quantidade_pedidos'] . '</p>';
                  
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>


    </div>


    <?php require_once('../components/Rodape.php'); ?>

</body>

</html>

