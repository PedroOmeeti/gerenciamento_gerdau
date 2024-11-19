<?php

session_start();
if(!isset($_SESSION['token'])) {
    header("location: ../../index.php");
    exit();
}

require_once('classes/cardapio_model.php');

$cardapio = new Cardapio();

if (isset($_GET['id_ingrediente']) && !empty($_GET['id_ingrediente'])) {
    $id_ingrediente = $_GET['id_ingrediente'];
    $cardapio->ExcluirIngrediente($id_ingrediente);
} else {
    die('Erro: Nenhum ID de ingrediente foi fornecido.');
}

header('Location: ../../view/cardapio/adicionarIngredientes_view.php?');
exit();


