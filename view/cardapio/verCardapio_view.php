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

$pratos = $cardapio->ListarPrato();
$ingredientes = $cardapio->ListarIngredientes();
$prato = $cardapio->ListarPratoPorDia($data_cardapio, $id_prato)['dados'][0];


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
    <style>
        .card {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php require_once('../components/Navbar.php'); ?>
    <div class="container">
        <?php
        $dia_da_semana = array('Domingo', 'Segunda-feira', 'Ter a-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'S bado');
        $data = new DateTime($prato['data_cardapio']);
        ?>
        <h1 class="card-title"><?= $dia_da_semana[$data->format('w')] . ', ' . $data->format('d/m/Y') ?></h1>
        <div class="card mb-3">
            <div class="row g-0 p-3">
                <div class="col-md-8">
                    <div class="card-body">
                        <?php
                        $dia_da_semana = array('Domingo', 'Segunda-feira', 'Ter a-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'S bado');
                        $data = new DateTime($prato['data_cardapio']);
                        ?>
                        <h5 class="card-title"><?= $dia_da_semana[$data->format('w')] . ', ' . $data->format('d/m/Y') ?></h5>
                        <p class="card-text"><?= htmlspecialchars($prato['descricao_prato']) ?></p>
                        <p class="card-text">Ingredientes: <?= htmlspecialchars($prato['ingredientes']) ?></p>
                        <p class="card-text">Data: <?= htmlspecialchars($prato['data_cardapio']) ?></p>
                        <a href="cardapio_view.php" class="btn btn-primary">Voltar</a>
                        <button class="btn btn-danger" id="delete-btn">Excluir</button>
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
                    // Redirecionar para a URL de exclusão
                    window.location.href = "../../model/actions/excluirCardapio_controller.php?data_cardapio=<?php echo $prato['data_cardapio']; ?>&id_prato=<?php echo $prato['id_prato']; ?>";
                }
            });
        });
    </script>
</body>

<link href="https://cdn