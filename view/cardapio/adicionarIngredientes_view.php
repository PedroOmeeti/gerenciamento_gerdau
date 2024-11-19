<?php
session_start();
if (!isset($_SESSION['token'])) {
    header("location: ../../index.php");
    exit();
}
//listar pratos
require_once('../../model/actions/classes/cardapio_model.php');
$cardapio = new Cardapio();
$ingredientes = $cardapio->ListarIngredientes();
?>
<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Ingrediente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require_once('../components/Navbar.php'); ?>

    <div class="container">
        <div class="row mt-4">
            <h1 class="text-center">Ingredientes Cadastrados</h1>

        </div>
        <h1>Adicionar Ingrediente</h1>
        <form action="../../model/actions/adicionarIngredientes_controller.php" method="POST">
            <div class="form-group">
                <div class="row mt-4">
                    <div class="col-8">
                        <label for="nome_ingrediente">Nome do Ingrediente:</label>
                        <input type="text" class="form-control" id="nome_ingrediente" name="nome_ingrediente" required>

                    </div>
                </div>

                <div class="col-4">
                    <input type="submit" class="btn btn-primary mt-2" value="Adicionar" style="width: 100px;">
                </div>

            </div>

        </form>

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

        <div class="table_component mt-5 mb-5" role="region" tabindex="0">
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nome do Ingrediente</th>
                        <th style="width: 100px;">Editar</th>
                        <th style="width: 100px;">Deletar</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ingredientes['dados'] as $ingrediente): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ingrediente['id_ingrediente']); ?></td>
                            <td><?php echo htmlspecialchars($ingrediente['nome_ingrediente']); ?></td>
                            <td><a role="button" type="button" class="btn btn-outline-primary btn-sm" href="<?php echo $caminho_pagina; ?>/usuario/editarFuncionario_view.php?id_usuario=<?php echo htmlspecialchars($funcionario['id_usuario']); ?>">Editar</a></td>
                                <td>
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete('<?php echo htmlspecialchars($funcionario['id_usuario']); ?>')">Deletar</button>
                                </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


    </div>

    <?php require_once('../components/Rodape.php'); ?>

</body>

</html>

