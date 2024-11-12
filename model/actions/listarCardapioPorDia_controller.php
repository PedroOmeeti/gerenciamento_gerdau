<?php

require_once('classes/cardapio_model.php');

$cardapio = new Cardapio();

$data_cardapio = $_GET['data_cardapio'];
$data_cardapio = str_replace('-', '/', date('d-m-Y', strtotime($data_cardapio)));

$dados = $cardapio->listarCardapioPorDia($data_cardapio);

header('Location: ../../view/cardapio/editarCardapio_view.php?data_cardapio=' . $data_cardapio);
exit;

