<?php

session_start();
if(!isset($_SESSION['token'])) {
    header("location: index.php");
    exit();
}

require_once('classes/cardapio_model.php');

$cardapio = new Cardapio();

if (isset($_GET['id_cardapio']) && !empty($_GET['id_cardapio'])) {
    $id_cardapio = $_GET['id_cardapio'];

    $cardapio->ExcluirCardapioId($id_prato, $data_cardapio);
} else {
    die('Erro: Nenhum ID de cardápio foi fornecido.');
}

header('Location: ../../view/cardapio/cardapio_view.php?');
exit();

