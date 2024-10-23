<?php
require_once('../model/actions/classes/prato_class.php');
$c = new Prato();
$resultado = $c->Listar(); // Supondo que isso retorne um array de todos os pratos

$dias = ["Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"];
// Exemplo: Mapear cada dia a um prato específico (você pode personalizar essa lógica)
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

<body>
    <?php require_once('./components/Navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Cardápio</h1>
            </div>
        </div>

        <div class="row">
            <h1 class="text-center mt-4">Gerenciamento do Cardápio Semanal</h1>
            <div class="row mt-4">
                <?php
                $dias = ["Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"];
                foreach ($dias as $index => $dia): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span><?php echo $dia; ?></span>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addRefeicaoModal" data-dia="<?php echo $dia; ?>">Adicionar Refeição</button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title">Almoço</h5>
                                    </div>
                                    <div class="col">
                                        <p>12:00</p>
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
                                    <div>
                                        <img src="../assets/images/comida.png" class="img-fluid">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title">Janta</h5>
                                    </div>
                                    <div class="col">
                                        <p>19:00</p>
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
                                    <div>
                                        <img src="../assets/images/comida.png" class="img-fluid">
                                    </div>
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
