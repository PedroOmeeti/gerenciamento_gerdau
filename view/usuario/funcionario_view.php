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
    <title>Funcionário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="funcionario.css">
</head>

<body>
    <!-- navibar -->
    <?php require_once('../components/Navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Funcionários</h1>
            </div>
        </div>

        <div class="row">
            <h1 class="text-center mt-4">Lista de Funcionários</h1>

            <div class="row d-flex align-items-center">
                <div class="menu border border-2 rounded-4 p-3 bg-body-dark">
                    <!-- Cabeçalhos -->
                    <div class="row d-flex align-items-center">
                        <div class="col">
                            <h5 class="card-title">ID</h5>
                        </div>
                        <div class="col">
                            <h5 class="card-title">Nome</h5>
                        </div>
                        <div class="col">
                            <h5 class="card-title">E-mail</h5>
                        </div>
                        <div class="col">
                            <h5 class="card-title">Chapa</h5>
                        </div>
                        <div class="col">
                            <h5 class="card-title ">Editar</h5>
                        </div>
                        <div class="col">
                            <h5 class="card-title">Deletar</h5>
                        </div>
                        <hr>
                        <!-- elemento demonstrativo -->
                        <div class="row d-flex align-items-center">
                            <div class="col">
                                <p class="card-text">1</p>
                            </div>
                            <div class="col">
                                <p class="card-text">Joaquim</p>
                            </div>
                            <div class="col">
                                <p class="card-text">joaquim@joaquim</p>
                            </div>
                            <div class="col">
                                <p class="card-text">123456</p>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-outline-primary">Editar</button>
                            </div>

                            <div class="col">
                                <button type="button" class="btn btn-outline-danger">Deletar</button>
                            </div>
                            <hr>
                        </div>

                        <!-- Lista de funcionários -->
                        <!-- <?php if ($lista_periodo): ?>
                        <?php foreach ($lista_periodo as $periodo): ?>
                            <div class="row d-flex align-items-center">
                                <div class="col">
                                    <p class="card-text"><?php echo htmlspecialchars($periodo['id_funcionario']); ?></p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><?php echo htmlspecialchars($periodo['nome']); ?></p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><?php echo htmlspecialchars($periodo['email']); ?></p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><?php echo htmlspecialchars($periodo['chapa']); ?></p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><a href="editarFuncionario_view.php?id_funcionario=<?php echo htmlspecialchars($periodo['id_funcionario']); ?>" class="btn btn-outline-primary">Editar</a></p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><a href="deletarFuncionario_view.php?id_funcionario=<?php echo htmlspecialchars($periodo['id_funcionario']); ?>" class="btn btn-outline-danger">Deletar</a></p>
                                </div>
                                <hr>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <p class="text-center">Nenhum funcionário encontrado.</p>
                        </div>
                    <?php endif; ?> -->
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php require_once('../components/Rodape.php'); ?>
</body>

</html>