<?php
session_start();
if (!isset($_SESSION['token'])) {
    header("location: ../../index.php");
    exit();
}

// Inclua o modelo
require_once('./classes/cardapio_model.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_ingrediente = $_POST['id_ingrediente'];
    $nome_ingrediente = $_POST['nome_ingrediente'];

    $ingrediente = new Cardapio();

    if ($ingrediente->ModificarIngrediente($id_ingrediente, $nome_ingrediente)) {
        header("location: ../../view/cardapio/adicionarIngredientes_view.php?msg=sucesso_edicao");
    } else {
        header("location: ../../view/cardapio/adicionarIngredientes_view.php?msg=erro_edicao");
    }
}
?>
