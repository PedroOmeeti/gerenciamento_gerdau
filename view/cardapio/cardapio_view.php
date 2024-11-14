<?php
session_start();
$lista_periodo = isset($_SESSION['lista_periodo']) ? $_SESSION['lista_periodo'] : null;unset($_SESSION['lista_periodo']);
error_log("Conteúdo de lista_periodo: " . print_r($lista_periodo, true));

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
</head>

<body>
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
                                        <button class="btn btn-primary" type="submit" id="exibir-cardapio">Exibir Cardápio</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-4 text-end d-flex align-items-center justify-content-center">
                            <button class="btn btn-primary" data-toggle="modal" onclick="window.location.href='adicionarRefeicao_view.php'">Adicionar Refeição</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                            <div class="card border border-1 rounded-4 bg-body-tertiary " style="cursor: pointer;" onclick="window.location.href='verCardapio_view.php?data_cardapio=<?php echo $prato['data_cardapio']; ?>&id_prato=<?php echo $prato['id_prato']; ?>'" onmouseover="this.style.background='#333'" onmouseout="this.style.background='#fff'">
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
                                        <button class="btn btn-outline-danger btn-sm " data-toggle="modal" onclick="window.location.href='verCardapio_view.php?data_cardapio=<?php echo $prato['data_cardapio']; ?>&id_prato=<?php echo $prato['id_prato']; ?>'">Deletar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <h1><?php echo htmlspecialchars($prato['data_cardapio']); ?></h1>
                        <?php $ultima_data = $prato['data_cardapio']; ?>
                        <div class="row col-12 p-2">
                            <div class="card border border-1 rounded-4 bg-body-tertiary " style="cursor: pointer;" onclick="window.location.href='verCardapio_view.php?data_cardapio=<?php echo $prato['data_cardapio']; ?>&id_prato=<?php echo $prato['id_prato']; ?>'" onmouseover="this.style.background='#333'" onmouseout="this.style.background='#fff'">
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
                                        <button class="btn btn-outline-danger btn-sm" data-toggle="modal" onclick="window.location.href='verCardapio_view.php?data_cardapio=<?php echo $prato['data_cardapio']; ?>&id_prato=<?php echo $prato['id_prato']; ?>'">Deletar</button>
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




    <?php require_once('../components/Rodape.php'); ?>



    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cont = 0;
            function executarFormulario() {                
                const form = document.getElementById('form-cardapio');
                    form.submit();
                    alert($cont);
                }
            executarFormulario();
        });
            
    </script> -->
</body>

</html>