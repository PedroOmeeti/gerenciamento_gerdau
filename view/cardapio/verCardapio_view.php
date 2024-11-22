<?php
$raiz = 'http://' . $_SERVER['SERVER_NAME'] . '/gerenciamento_gerdau/';
$caminho_pagina = $raiz . 'model/actions/';

if (isset($_GET['id_prato']) && !empty($_GET['id_prato']) && isset($_GET['data_cardapio']) && !empty($_GET['data_cardapio'])) {
    $id_prato = $_GET['id_prato'];
    $data_cardapio = $_GET['data_cardapio'];
    $data_cardapio = str_replace('-', '/', date('d-m-Y', strtotime($data_cardapio)));
} else {
    die('Erro: Nenhum ID de prato ou data de cardápio foi fornecido.');
}

require_once('../../model/actions/classes/cardapio_model.php');
$cardapio = new Cardapio();

$prato = $cardapio->ListarPratoPorDia($data_cardapio, $id_prato)['dados'][0];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Cardápio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="cardapio.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php require_once('../components/Navbar.php'); ?>

    <div class="container">
        <div class="row mt-4">
            <div class="col text-center">
                <h1 class="display-4">Detalhes do Prato</h1>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card border-dark shadow-lg">
                    <div class="card-header text-center" style="background-color: #B49C5E; color: white;">
                        <h5 class="card-title"><?= htmlspecialchars($prato['descricao_prato']) ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><strong>Ingredientes:</strong> <?= htmlspecialchars($prato['ingredientes']) ?></p>
                        <p class="card-text"><strong>Data do cardápio:</strong> <?= htmlspecialchars($prato['data_cardapio']) ?></p>
                        <div class="d-flex justify-content-around mt-4">
                            <a href="cardapio_view.php" class="btn btn-secondary">Voltar</a>
                            <button class="btn btn-danger" id="delete-btn">Excluir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('delete-btn').addEventListener('click', function () {
            Swal.fire({
                title: "Tem certeza?",
                text: "Essa ação não poderá ser revertida!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, excluir!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../model/actions/excluirCardapio_controller.php?data_cardapio=<?= htmlspecialchars($prato['data_cardapio']); ?>&id_prato=<?= htmlspecialchars($prato['id_prato']); ?>";
                }
            });
        });
    </script>
</body>

</html>
