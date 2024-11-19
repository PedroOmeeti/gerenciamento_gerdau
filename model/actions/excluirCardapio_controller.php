<?php

session_start();
if (!isset($_SESSION['token'])) {
    header("location: index.php");
    exit();
}

require_once('classes/cardapio_model.php');

$cardapio = new Cardapio();

if (isset($_GET['id_prato']) && !empty($_GET['id_prato']) && isset($_GET['data_cardapio']) && !empty($_GET['data_cardapio'])) {
    $id_prato = $_GET['id_prato'];
    $data_cardapio = $_GET['data_cardapio'];
    $data_cardapio = str_replace('-', '/', date('d-m-Y', strtotime($data_cardapio)));
    $cardapio->ExcluirCardapioId($id_prato, $data_cardapio);
} else {
    die('Erro: Nenhum ID de prato ou data de cardápio foi fornecido.');
}

print_r($id_prato);
print_r('<br>');
print_r($data_cardapio);

header('Location: ../../view/cardapio/cardapio_view.php?');
exit();
