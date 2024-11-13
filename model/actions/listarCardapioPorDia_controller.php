<?php

require_once('classes/cardapio_model.php');

$cardapio = new Cardapio();

$data_cardapio = $_GET['data_cardapio'];
$id_prato = $_GET['id_prato'];
$data_cardapio = str_replace('-', '/', date('d-m-Y', strtotime($data_cardapio)));

print_r($data_cardapio);
print_r($id_prato);

$dados = $cardapio->listarPratoPorDia($data_cardapio, $id_prato);

// header('Location: ../../view/cardapio/editarCardapio_view.php?data_cardapio=' . $data_cardapio);
exit;

