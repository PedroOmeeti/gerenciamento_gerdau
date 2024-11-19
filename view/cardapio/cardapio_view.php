<?php
session_start();
if (!isset($_SESSION['token'])) {
    header("location: index.php");
    exit();
}

$lista_periodo = isset($_SESSION['lista_periodo']) ? $_SESSION['lista_periodo'] : null;
unset($_SESSION['lista_periodo']);
error_log("Conteúdo de lista_periodo: " . print_r($lista_periodo, true));

$raiz = 'http://' . $_SERVER['SERVER_NAME'] . '/gerenciamento_gerdau/';
$caminho_pagina = $raiz . '../../../model/actions';

// Se os dados forem enviados via POST, u sar esses valores; caso contrário, usar valores padrão
$data_inicial = isset($_POST['data_inicial']) ? $_POST['data_inicial'] : date('Y-m-d');
$data_final = isset($_POST['data_final']) ? $_POST['data_final'] : date('Y-m-d', strtotime('+7 days'));

if (!isset($lista_periodo['dados']) || count($lista_periodo['dados']) == 0) {
    header('Location: ../../model/actions/cardapio_controller.php?data_inicial=' . $data_inicial . '&data_final=' . $data_final);
    exit;
}


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

<body>
    <?php require_once('../components/Navbar.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Cardápio</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <h1 class="text-center mt-4">Gerenciamento do Cardápio Semanal</h1>

            <div class="row">
                <div class="menu border border-2 rounded-4 p-3 bg-body-dark">
                    <div class="row d-flex align-items-center">
                        <div class="col-4">
                            <h5>Exibir Cardápio</h5>
                        </div>
                        <div class="col-4">
                            <form id="form-cardapio" method="POST" action="../../model/actions/cardapio_controller.php">
                                <div class="row p-2 d-flex text-center">
                                    <div class="col">Data inicial:
                                        <input type="date" id="data_inicial" name="data_inicial" value="<?= $data_inicial ?>">
                                    </div>
                                    <div class="col">Data final:
                                        <input type="date" id="data_final" name="data_final" value="<?= $data_final ?>">
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col">
                                        <button class="btn" style="background-color: #B49C5E; color: white" type="submit" id="exibir-cardapio">Exibir Cardápio</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-4 text-end d-flex align-items-center justify-content-center">
                            <button class="btn" style="background-color: #B49C5E; color: white" data-toggle="modal" onclick="window.location.href='adicionarRefeicao_view.php'">Adicionar Refeição</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5 mb-5 d-flex justify-content-center">



            <?php

            setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR', 'Portuguese_Brazil.1252');

            $dias_da_semana = [
                'Sunday' => 'domingo',
                'Monday' => 'segunda-feira',
                'Tuesday' => 'terça-feira',
                'Wednesday' => 'quarta-feira',
                'Thursday' => 'quinta-feira',
                'Friday' => 'sexta-feira',
                'Saturday' => 'sábado'
            ];


            if (isset($lista_periodo['dados']) && is_array($lista_periodo['dados']) && count($lista_periodo['dados']) > 0): ?>
                <?php $cont = 1; ?>
                <?php $exibiu_prato = false; // Variável de controle ?>
                <?php foreach ($lista_periodo['dados'] as $prato): ?>
                    <?php if (is_array($prato)): ?>
                        <?php $exibiu_prato = true; // Indica que ao menos um prato foi exibido ?>
                        <?php if ($cont == 1): ?>
                            <?php
                            $ultima_data = $prato['data_cardapio'] ?? null;
                            $dia_semana = $dias_da_semana[date('l', strtotime($prato['data_cardapio'] ?? ''))] ?? 'Data inválida';
                            ?>
                            <h1><?php echo ucfirst($dia_semana) . ', ' . date('d/m/Y', strtotime($prato['data_cardapio'] ?? '')); ?></h1>
                        <?php endif; ?>
                        <?php $cont++; ?>
                        <?php if ($ultima_data == ($prato['data_cardapio'] ?? null)): ?>
                            <div class="row col-12 p-2">
                                <div class="card border border-1 rounded-4 bg-body-tertiary" style="cursor:pointer" onclick="window.location.href='verCardapio_view.php?data_cardapio=<?php echo $prato['data_cardapio']; ?>&id_prato=<?php echo $prato['id_prato']; ?>'">
                                    <div class="card-body d-flex flex-row p-0">
                                        <div class="col-3 border-end border-2 p-3">
                                            <h5 class="card-title"><?php echo htmlspecialchars($prato['nome_prato'] ?? 'Prato desconhecido'); ?></h5>
                                            <p><?php echo date('d/m/Y', strtotime($prato['data_cardapio'] ?? '')); ?></p>
                                        </div>
                                        <div class="col-7 text-center p-3">
                                            <p class="fs-5"><b><?php echo htmlspecialchars($prato['descricao_prato'] ?? 'Descrição indisponível'); ?></b></p>
                                            <p class="card-text f2-4"><?php echo htmlspecialchars($prato['ingredientes'] ?? ''); ?></p>
                                        </div>
                                        <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                            <button class="btn btn-outline-danger btn-sm delete-btn" onclick="event.stopPropagation(); deleteCardapio(<?php echo $prato['id_prato'] ?? 0; ?>);">Deletar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php
                            $ultima_data = $prato['data_cardapio'] ?? null;
                            $dia_semana = $dias_da_semana[date('l', strtotime($prato['data_cardapio'] ?? ''))] ?? 'Data inválida';
                            ?>
                            <h1><?php echo ucfirst($dia_semana) . ', ' . date('d/m/Y', strtotime($prato['data_cardapio'] ?? '')); ?></h1>
                            <div class="row col-12 p-2">
                                <div class="card border border-1 rounded-4 bg-body-tertiary" style="cursor:pointer" onclick="window.location.href='verCardapio_view.php?data_cardapio=<?php echo $prato['data_cardapio']; ?>&id_prato=<?php echo $prato['id_prato']; ?>'">
                                    <div class="card-body d-flex flex-row p-0">
                                        <div class="col-3 border-end border-2 p-3">
                                            <h5 class="card-title"><?php echo htmlspecialchars($prato['nome_prato'] ?? 'Prato desconhecido'); ?></h5>
                                            <p><?php echo date('d/m/Y', strtotime($prato['data_cardapio'] ?? '')); ?></p>
                                        </div>
                                        <div class="col-7 text-center p-3">
                                            <p class="fs-5"><b><?php echo htmlspecialchars($prato['descricao_prato'] ?? 'Descrição indisponível'); ?></b></p>
                                            <p class="card-text f2-4"><?php echo htmlspecialchars($prato['ingredientes'] ?? ''); ?></p>
                                        </div>
                                        <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                            <button class="btn btn-outline-danger btn-sm delete-btn" onclick="event.stopPropagation(); deleteCardapio(<?php echo $prato['id_prato'] ?? 0; ?>);">Deletar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if (!$exibiu_prato): // Exibe mensagem se nenhum prato foi exibido ?>
                    <div class="row justify-content-center mt-4">
                        <div class="card text-center border border-warning bg-light p-3" style="max-width: 400px;">
                            <div class="card-body">
                                <h5 class="card-title text-danger">Cardápio Indisponível</h5>
                                <p class="card-text">Nenhum prato foi encontrado para o período selecionado.</p>
                                <a href="adicionarRefeicao_view.php" class="btn btn-warning">Adicionar Refeição</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="row justify-content-center mt-4">
                    <div class="card text-center border border-warning bg-light p-3" style="max-width: 400px;">
                        <div class="card-body">
                            <h5 class="card-title text-dark">Cardápio Indisponível</h5>
                            <p class="card-text">Nenhum prato foi encontrado para o período selecionado.</p>
                            <a href="adicionarRefeicao_view.php" class="btn btn-warning">Adicionar Refeição</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
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