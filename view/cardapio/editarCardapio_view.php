<?php
$raiz = 'http://' . $_SERVER['SERVER_NAME'] . '/gerenciamento_gerdau/';
$caminho_pagina = $raiz . 'model/actions/';


require_once('../../model/actions/classes/cardapio_model.php');
$cardapio = new Cardapio();

$pratos = $cardapio->ListarPrato();
$ingredientes = $cardapio->ListarIngredientes();

if (isset($_GET['dados']) && !empty($_GET['dados'])) {
    // Decodifique o JSON
    $dados = json_decode($_GET['dados'], true);  // true para retornar um array associativo

    // Verifique se a decodificação foi bem-sucedida e se $dados é um array
    if (is_array($dados) && isset($dados['dados'][0])) {
        $prato = $dados['dados'][0];  // Acessando o primeiro prato no array
    } else {
        die('Erro: dados do prato inválidos.');
    }
} else {
    die('Erro: Nenhum dado foi fornecido.');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require_once('../components/Navbar.php'); ?>
    <div class="container">
        <h1>Editar</h1>
        <form action="<?= $caminho_pagina ?>editarCardapio_controller.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($prato['id_prato']) ?>" />

            <div class="form-group">
                <label for="nome">Prato:</label>
                <select class="form-select" id="nome" name="nome">
                    <?php foreach ($pratos['dados'] as $p) { ?>
                        <option value="<?= $p['nome_prato'] ?>" <?= $p['nome_prato'] == $prato['nome_prato'] ? 'selected' : '' ?>><?= $p['nome_prato'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="descricao">Descrição:</label>
                <input type="text" value="<?= htmlspecialchars($prato['descricao_prato']) ?>" class="form-control" id="descricao" name="descricao">
            </div>

            <div class="form-group mt-3">
                <label for="ingredientes">Ingredientes:</label>
                <select class="form-select" id="ingredientes" name="ingredientes[]">
                    <?php foreach ($ingredientes['dados'] as $ingrediente) { ?>
                        <option value="<?= $ingrediente['nome_ingrediente'] ?>" <?= in_array($ingrediente['nome_ingrediente'], explode(',', $prato['ingredientes'])) ? 'selected' : '' ?>><?= $ingrediente['nome_ingrediente'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="data">Data:</label>
                <input type="date" value="<?= htmlspecialchars($prato['data_cardapio']) ?>" class="form-control" id="data" name="data">
            </div>


            <button type="submit" class="btn btn-primary mt-4">Editar</button>
        </form>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>

</html>