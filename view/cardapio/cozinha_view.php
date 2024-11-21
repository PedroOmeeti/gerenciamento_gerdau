<?php
session_start();
if (!isset($_SESSION['token'])) {
    header("location: index.php");
    exit();
}

require_once('../../model/actions/classes/cardapio_model.php');

$cardapio = new Cardapio();
$data_agendamento = isset($_GET['data_agendamento']) ? $_GET['data_agendamento'] : null;


$pedidoDia = $cardapio->ListarPedidosDia($data_agendamento);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="cardapio.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
</head>

<body class="">
    <?php require_once('../components/Navbar.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Pedidos</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <h1 class="text-center mt-4">Monitoramento dos pedidos</h1>

            <div class="row">
                <div class="menu border border-2 rounded-4 p-3 bg-body-dark">
                    <div class="row d-flex align-items-center">
                        <div class="col">
                            <form id="form-cardapio" method="GET" action="../../model/actions/cozinha_controller.php">
                                <div class="row p-2 d-flex text-center">
                                    <div class="row fs-5 d-flex justify-content-center">Selecione a data:</div>
                                    <div class="col fs-5 align-items-center ">
                                        <input type="date" id="data_agendamento" name="data_agendamento" value="<?= date('Y-m-d') ?>">
                                        <button class="btn btn-secondary" type="button" onclick="document.getElementById('data_agendamento').stepDown()">&lt;</button>
                                        <button class="btn btn-secondary" type="button" onclick="document.getElementById('data_agendamento').stepUp()">&gt;</button>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col">
                                        <button class="btn" style="background-color: #B49C5E; color: white" type="submit" id="exibir-cardapio">Exibir pedidos</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-center mt-4">
            <?php if ($data_agendamento == date('d/m/Y')): ?>
                <h4 class="mt-4">Pedidos de hoje</h4>
            <?php else: ?>
                <h4 class="mt-4">Pedidos de <?= date('d/m/Y', strtotime($data_agendamento)) ?></h4>
            <?php endif; ?>
        </div>

        <div class="row text-center">
            <p class="fs-3">
                Quantidades de pedidos:<b>
                    <?php
                    if (isset($pedidoDia['dados']) && is_array($pedidoDia['dados']) && count($pedidoDia['dados']) > 0) {
                        echo array_sum(array_column($pedidoDia['dados'], 'quantidade_pedidos'));
                    } else {
                        echo "0";
                    }
                    ?></b>
            </p>
        </div>

        <div class="row mt-5 d-flex justify-content-center">
            <?php
            if (isset($pedidoDia['dados']) && is_array($pedidoDia['dados']) && count($pedidoDia['dados']) > 0) {
                foreach ($pedidoDia['dados'] as $pedido) {
                    echo '<div class="col-md-3 col-sm-6 mb-4">';
                    echo '<div class="card border-dark shadow-lg h-100" style="cursor: pointer;" onclick="window.location.href = \'pedidosUsuarios_view.php?ids_usuarios=' . urlencode($pedido['ids_usuarios']) . '&prato=' . urlencode($pedido['prato']) . '&quantidade_pedidos=' . urlencode($pedido['quantidade_pedidos']) . '&data_agendamento=' . urlencode($data_agendamento) . '\'">';
                    echo '<div class="card-header text-center" style="background-color: #B49C5E; color: white; font-weight: bold;">';
                    echo '<h5 class="card-title">' . $pedido['prato'] . '</h5>';
                    echo '</div>';
                    echo '<div class="card-body">';
                    echo '<p class="card-text fs-5">Quantidade de pedidos: <strong>' . $pedido['quantidade_pedidos'] . '</strong></p>';
                    echo '<div class="d-flex justify-content-between">';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-12 text-center">';
                echo '<h5>Nenhum pedido encontrado.</h5>';
                echo '</div>';
            }
            ?>
        </div>

    </div>

    <?php require_once('../components/Rodape.php'); ?>

    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation(); // Evita que o clique no botão acione o redirecionamento do card
                const idPrato = button.getAttribute('onclick').match(/deleteCardapio\((\d+)\)/)[1];

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
        });
    </script>
</body>

</html>