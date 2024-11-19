<?php

require_once('./classes/cardapio_model.php');

$cardapio = new Cardapio();

$data_agendamento = $_GET['data_cardapio'];

//formatar data pa d/m/y
$data_agendamento = date('d/m/Y', strtotime($data_agendamento));

$listaPedidos = $cardapio->ListarPedidoPorDia($data_agendamento);

header('Location: ../../view/cardapio/cozinha_view.php?');

