<?php
require_once('../../model/actions/classes/prato_class.php');
$c = new Prato();
$resultado = $c->Listar(); // Rotorna um array, mas quero lista individualmente

$dias = ["Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"];
//Mapear os pratos de acordo com o dia da semana
$dishesByDay = [];
if (!empty($resultado)) {
    foreach ($resultado as $index => $prato) {
        // Atribuir um prato a cada dia, ciclando pelos pratos se houver mais dias do que pratos
        $dayIndex = $index % count($dias);
        $dishesByDay[$dayIndex] = $prato;
    }
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
            <div>
                <button class="btn btn-primary" data-toggle="modal" onclick="window.location.href='adicionarRefeicao_view.php'">Adicionar Refeição</button>
            </div>

            <div class="row mt-5">
                <h1>Segunda-feira</h1>
                <div class="row col-12 p-2">
                    <div class="card border-1 bg-body-tertiary ">
                        <div class="card-body d-flex flex-row p-0">
                            <div class="col-3 border-end border-2 p-3">
                                <h5 class="card-title">Dia a Dia</h5>
                            </div>
                            <div class="col-7 text-center p-3">
                                <p class="fs-5"><b>Almoço</b></p>
                                <p class="card-text f2-4">Descrição da refeição</p>
                            </div>
                            <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" onclick="window.location.href='editarCardapio_view.php'">Editar Refeição</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row col-12 p-2">
                    <div class="card border-1 bg-body-tertiary ">
                        <div class="card-body d-flex flex-row p-0">
                            <div class="col-3 border-end border-2 p-3">
                                <h5 class="card-title">Speciale</h5>
                            </div>
                            <div class="col-7 text-center p-3">
                                <p class="fs-5"><b>Almoço</b></p>
                                <p class="card-text f2-4">Descrição da refeição</p>
                            </div>
                            <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" onclick="window.location.href='editarCardapio_view.php'">Editar Refeição</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-12 p-2">
                    <div class="card border-1 bg-body-tertiary ">
                        <div class="card-body d-flex flex-row p-0">
                            <div class="col-3 border-end border-2 p-3">
                                <h5 class="card-title">Clássico</h5>
                            </div>
                            <div class="col-7 text-center p-3">
                                <p class="fs-5"><b>Almoço</b></p>
                                <p class="card-text f2-4">Descrição da refeição</p>
                            </div>
                            <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" onclick="window.location.href='editarCardapio_view.php'">Editar Refeição</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-12 p-2">
                    <div class="card border-1 bg-body-tertiary ">
                        <div class="card-body d-flex flex-row p-0">
                            <div class="col-3 border-end border-2 p-3">
                                <h5 class="card-title">Natural</h5>
                            </div>
                            <div class="col-7 text-center p-3">
                                <p class="fs-5"><b>Almoço</b></p>
                                <p class="card-text f2-4">Descrição da refeição</p>
                            </div>
                            <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" onclick="window.location.href='editarCardapio_view.php'">Editar Refeição</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <?php
                $dias = ["Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"];
                foreach ($dias as $index => $dia): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card bg-body-tertiary">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span class="fs-5 fw-bold""><?php echo $dia; ?></span>
                                <button class=" btn btn-secondary btn-sm" data-toggle="modal" onclick="window.location.href='editarCardapio_view.php?id=<?php echo htmlspecialchars($dishesByDay[$index]['id']); ?>'" data-dia="<?php echo $dia; ?>">Editar Refeição</button>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title "><strong>Almoço, jantar e ceia</strong></h5>
                                    </div>
                                    <!-- <div class="col">
                                        <p>12:00</p>
                                    </div> -->
                                </div>

                                <div class="d-flex align-items-start">
                                    <div class="">
                                        <ul>
                                            <?php if (isset($dishesByDay[$index])): ?>
                                                <li>
                                                    <strong><?php echo htmlspecialchars($dishesByDay[$index]['nome_prato']); ?></strong><br>
                                                    <span><?php echo htmlspecialchars($dishesByDay[$index]['descricao_prato']); ?></span>
                                                </li>
                                            <?php else: ?>
                                                <li>Nenhum prato disponível.</li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div>
                                        <!-- <img src="../assets/images/comida.png" class="img-fluid"> -->
                                    </div>
                                </div>
                                <div class="card-footer border text-center">
                                    <img src="../../assets/images/comida.png" class="border border-dark border-3 img-fluid" width="150" alt="...">
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title "><strong>Speciale</strong></h5>
                                    </div>

                                </div>

                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <ul>
                                            <?php if (isset($dishesByDay[$index])): ?>
                                                <li>
                                                    <strong><?php echo htmlspecialchars($dishesByDay[$index]['nome_prato']); ?></strong><br>
                                                    <span><?php echo htmlspecialchars($dishesByDay[$index]['descricao_prato']); ?></span>
                                                </li>
                                            <?php else: ?>
                                                <li>Nenhum prato disponível.</li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>

                                </div>
                                <div class="card-footer border text-center">
                                    <img src="../../assets/images/comida.png" class="border border-dark border-3 img-fluid" width="150" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>

</html>