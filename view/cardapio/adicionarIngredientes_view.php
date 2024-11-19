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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <?php require_once('../components/Navbar.php'); ?>

    <div class="container">
        <div class="row mt-4">
            <h1 class="text-center">Ingredientes Cadastrados</h1>
        </div>
        <h1 class="mt-4">Adicionar Ingrediente</h1>
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
                            <td>
                                <!-- <a role="button" type="button" class="btn btn-outline-primary btn-sm"
                                    href="../cardapio/modificarIngrediente.php?id_ingrediente=<?php echo htmlspecialchars($ingrediente['id_ingrediente']); ?>">
                                    Editar
                                </a> -->
                                <!-- Button trigger modal -->
                                <button type="button"
                                    class="btn btn-outline-primary btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editarIngredienteModal"
                                    data-id="<?php echo htmlspecialchars($ingrediente['id_ingrediente']); ?>"
                                    data-nome="<?php echo htmlspecialchars($ingrediente['nome_ingrediente']); ?>">
                                    Editar
                                </button>


                                <div class="modal fade" id="editarIngredienteModal" tabindex="-1" aria-labelledby="editarIngredienteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="../../model/actions/editarIngrediente_controller.php" method="POST">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editarIngredienteModalLabel">Editar Ingrediente</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" id="editId" name="id_ingrediente">
                                                    <div class="mb-3">
                                                        <label for="editNome" class="form-label">Nome do Ingrediente:</label>
                                                        <input type="text" class="form-control" id="editNome" name="nome_ingrediente" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-danger btn-sm"
                                    onclick="confirmDelete('<?php echo htmlspecialchars($ingrediente['id_ingrediente']); ?>')">
                                    Deletar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Você não poderá reverter essa ação!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sim, deletar!',
                    cancelButtonText: 'Não, cancelar!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `../../model/actions/deletarIngrediente_controller.php?id_ingrediente=${id}`;
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            'Cancelado',
                            'O ingrediente não foi deletado :)',
                            'error'
                        );
                    }
                });
            }
        </script>
    </div>
    <script>
        const editarIngredienteModal = document.getElementById('editarIngredienteModal');
        editarIngredienteModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget; // Botão que acionou o modal
            const id = button.getAttribute('data-id');
            const nome = button.getAttribute('data-nome');

            // Preencher os campos do modal
            const editIdInput = editarIngredienteModal.querySelector('#editId');
            const editNomeInput = editarIngredienteModal.querySelector('#editNome');

            editIdInput.value = id;
            editNomeInput.value = nome;
        });
    </script>
    <?php require_once('../components/Rodape.php'); ?>
</body>

</html>