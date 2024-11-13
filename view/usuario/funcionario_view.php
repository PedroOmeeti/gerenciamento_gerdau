<?php
session_start();
$lista_periodo = isset($_SESSION['lista_periodo']) ? $_SESSION['lista_periodo'] : null;
unset($_SESSION['lista_periodo']);
error_log("Conteúdo de lista_periodo: " . print_r($lista_periodo, true));

// Certifique-se de que $lista_funcionarios seja inicializada
$lista_funcionarios = isset($_SESSION['lista_funcionarios']) ? $_SESSION['lista_funcionarios'] : [];
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
    <!-- Navbar -->
    <?php require_once('../components/Navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Funcionários</h1>
            </div>
        </div>

        <div class="row">
            <h1 class="text-center mt-4">Lista de Funcionários</h1>

            <style>
                .table_component {
                    overflow: auto;
                    width: 100%;
                }

                .table_component table {
                    border: 1px double #dededf;
                    width: 100%;
                    table-layout: auto;
                    border-collapse: collapse;
                    text-align: left;
                }

                .table_component th,
                .table_component td {
                    border: 1px double #dededf;
                    padding: 9px;
                }

                .table_component th {
                    background-color: #eceff1;
                    color: #000;
                }

                .table_component td {
                    background-color: #fff;
                    color: #000;
                }
            </style>

            <div class="table_component" role="region" tabindex="0">
                <table>
                    <caption>Funcionários</caption>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Chapa</th>
                            <th>Editar</th>
                            <th>Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista_funcionarios as $funcionario): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($funcionario['id_funcionario']); ?></td>
                                <td><?php echo htmlspecialchars($funcionario['nome']); ?></td>
                                <td><?php echo htmlspecialchars($funcionario['email']); ?></td>
                                <td><?php echo htmlspecialchars($funcionario['chapa']); ?></td>
                                <td><a class="btn btn-primary" href="<?php echo $caminho_pagina; ?>/usuario/editarFuncionario_view.php?id_funcionario=<?php echo htmlspecialchars($funcionario['id_funcionario']); ?>">Editar</a></td>
                                <td><a class="btn btn-danger" href="<?php echo $caminho_pagina; ?>/usuario/deletarFuncionario_view.php?id_funcionario=<?php echo htmlspecialchars($funcionario['id_funcionario']); ?>">Deletar</a></td>

                          
                      
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require_once('../components/Rodape.php'); ?>
</body>

</html>