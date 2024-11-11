<?php

require_once('classes/cardapio_model.php');

$cardapio = new Cardapio();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturando os dados do formulário
    $id_prato = $_POST['id_prato'];
    $id_ingredientes = $_POST['id_ingrediente'];
    $data_cardapio = date('d-m-Y', strtotime($_POST['data_cardapio']));


    // Listar os dados passados
    echo "Dados passados:<br>";
    echo "ID do prato: $id_prato<br>";
    echo "ID do ingrediente: $id_ingredientes<br>";
    echo "Data do cardápio: $data_cardapio<br>";

    // Chamar o método Cadastrar
    $cardapio->AdicionarItem($id_prato, $id_ingredientes, $data_cardapio);
}

// header('Location: ../../view/painel_adm_view.php');
// exit();



