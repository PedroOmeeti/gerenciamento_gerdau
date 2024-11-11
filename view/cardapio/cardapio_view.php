<?php
session_start();
$lista_periodo = isset($_SESSION['lista_periodo']) ? $_SESSION['lista_periodo'] : null;
unset($_SESSION['lista_periodo']);
error_log("Conteúdo de lista_periodo: " . print_r($lista_periodo, true));
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="cardapio.css">
</head>

<body class="">
    <?php require_once('../components/Navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Cardápio</h1>
            </div>
        </div>


        <div class="row">
            <h1 class="text-center mt-4">Gerenciamento do Cardápio Semanal</h1>

            <div class="row">
                <div class="menu border border-2 rounded-4 p-3 bg-body-dark">
                    <div class="row d-flex align-items-center">
                        <div class="col-4">
                            <h5>Exibir Cardápio</h5>
                        </div>
                        <div class="col-4">
                            <form method="POST" action="../../model/actions/cardapio_controller.php">
                                <div class="row p-2 d-flex text-center">
                                    <div class="col">Data inicial: <input type="date" id="data_inicial" name="data_inicial" value="<?= date('Y-m-d') ?>"></div>
                                    <div class="col">Data final: <input type="date" id="data_final" name="data_final" value="<?= date('Y-m-d', strtotime('+7 days')) ?>"></div>
                                </div>
                                <div class="row  text-center">
                                    <div class="col">
                                        <button class="btn btn-primary" type="submit">Exibir Cardápio</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="col-4 text-end d-flex align-items-center justify-content-center">
                            <button class="btn btn-primary" data-toggle="modal" onclick="window.location.href='adicionarRefeicao_view.php'">Adicionar Refeição</button>

                        </div>
                    </div>
                </div>
                <script>
                    function exibirCardapio() {
                        var data_inicial = document.getElementById("data_inicial").value;
                        var data_final = document.getElementById("data_final").value;
                        window.location.href = "cardapio_view.php?data_inicial=" + data_inicial + "&data_final=" + data_final;
                    }
                </script>



                <div class="row mt-5 d-flex justify-content-center">
                    <?php if (isset($lista_periodo['dados']) && count($lista_periodo['dados']) > 0): ?>
                        <?php $cont = 1; ?>
                        <?php foreach ($lista_periodo['dados'] as $prato): ?>
                            <?php if ($cont == 1): ?>
                                <?php $ultima_data = $prato['data_cardapio']; ?>
                                <h1><?php echo htmlspecialchars($prato['data_cardapio']); ?></h1>
                            <?php endif; ?>
                            <?php $cont++; ?>
                            <?php if ($ultima_data == $prato['data_cardapio']): ?>
                                <div class="row col-12 p-2">
                                    <div class="card border border-1 rounded-4 bg-body-tertiary ">
                                        <div class="card-body d-flex flex-row p-0">
                                            <div class="col-3 border-end border-2 p-3">
                                                <h5 class="card-title"><?php echo htmlspecialchars($prato['nome_prato']); ?></h5>
                                                <p><?php echo htmlspecialchars($prato['data_cardapio']); ?></p>
                                            </div>
                                            <div class="col-7 text-center p-3">
                                                <p class="fs-5"><b><?php echo htmlspecialchars($prato['descricao_prato']); ?></b></p>
                                                <p class="card-text f2-4"><?php echo htmlspecialchars($prato['ingredientes']); ?></p>
                                            </div>
                                            <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                                <button class="btn btn-secondary btn-sm" data-toggle="modal">Editar Refeição</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <h1><?php echo htmlspecialchars($prato['data_cardapio']); ?></h1>
                                <?php $ultima_data = $prato['data_cardapio']; ?>
                                <div class="row col-12 p-2">
                                    <div class="card border border-1 rounded-4 bg-body-tertiary ">
                                        <div class="card-body d-flex flex-row p-0">
                                            <div class="col-3 border-end border-2 p-3">
                                                <h5 class="card-title"><?php echo htmlspecialchars($prato['nome_prato']); ?></h5>
                                                <p><?php echo htmlspecialchars($prato['data_cardapio']); ?></p>
                                            </div>
                                            <div class="col-7 text-center p-3">
                                                <p class="fs-5"><b><?php echo htmlspecialchars($prato['descricao_prato']); ?></b></p>
                                                <p class="card-text f2-4"><?php echo htmlspecialchars($prato['ingredientes']); ?></p>
                                            </div>
                                            <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                                <button class="btn btn-secondary btn-sm" data-toggle="modal">Editar Refeição</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="row col-12 p-2">
                            <div class="alert alert-danger" role="alert">
                                Selecione a data inicial e final
                            </div>
                        </div>
                    <?php endif; ?>


                </div>
            </div>
        </div>
    </div>
    <?php
    require_once('../components/Rodape.php');
    ?>
</body>

</html>