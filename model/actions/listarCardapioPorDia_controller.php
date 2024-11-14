<?php

session_start();
if(!isset($_SESSION['token'])) {
    header("location: index.php");
    exit();
}


require_once('classes/cardapio_model.php');

$cardapio = new Cardapio();

$data_cardapio = $_GET['data_cardapio'];
$id_prato = $_GET['id_prato'];
$data_cardapio = str_replace('-', '/', date('d-m-Y', strtotime($data_cardapio)));


$dados = $cardapio->listarPratoPorDia($data_cardapio, $id_prato);

print_r($id_prato);
print_r('<br>');
print_r($data_cardapio);
print_r($dados);

header('Location: ../../view/cardapio/editarCardapio_view.php?dados=' . urlencode(json_encode($dados)));
exit;
