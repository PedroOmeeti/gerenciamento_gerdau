<?php
session_start();
if (!isset($_SESSION['token'])) {
  header("location: ../../view/index.php");
  exit();
}

require_once('../classes/cardapio_model.php');
$cardapio = new Cardapio();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome_ingrediente = trim($_POST['nome_ingrediente']);

  if (!empty($nome_ingrediente)) {
    $resultado = $cardapio->AdicionarIngredientes($nome_ingrediente);

    if ($resultado['status'] === 'sucesso') {
      $_SESSION['mensagem'] = "Ingrediente adicionado com sucesso!";
    } else {
      $_SESSION['mensagem'] = "Erro ao adicionar o ingrediente.";
    }
  } else {
    $_SESSION['mensagem'] = "O nome do ingrediente não pode estar vazio.";
  }
}

header("location: ../../view/cardapio.php");
exit();
?>
