<?php

require_once('classes/cardapio_model.php');

$cardapio = new Cardapio();

$id_prato = $_GET['id_prato'];
$data_cardapio = $_GET['data_cardapio'];
$data_cardapio = str_replace('-', '/', date('d-m-Y', strtotime($data_cardapio)));

$id_cardapio = $_GET['id_cardapio'];
print_r($id_cardapio);

$dados = $cardapio->listarPratoPorDia($data_cardapio, $id_prato);

print_r($dados['id_cardapio']);

header('Location: ../../view/cardapio/editarCardapio_view.php?dados=' . urlencode(json_encode($dados)));
exit;
