<?php

require_once('../../model/actions/classes/usuario_model.php');
$usuario = new Usuario();

$lista_funcionarios = $usuario->listarUsuario();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="funcionario.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
</head>

<body>
    <!-- Navbar -->
    <?php require_once('../components/Navbar.php'); ?>
    <div class="container mb-5">
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

            <div class="table_component mt-4" role="region" tabindex="0">
                <table>
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
                        <?php foreach ($lista_funcionarios['dados'] as $funcionario): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($funcionario['id_usuario']); ?></td>
                                <td><?php echo htmlspecialchars($funcionario['nome_usuario']); ?></td>
                                <td><?php echo htmlspecialchars($funcionario['email_usuario']); ?></td>
                                <td><?php echo htmlspecialchars($funcionario['chapa_usuario']); ?></td>
                                <td><a role="button" type="button" class="btn btn-outline-primary" href="<?php echo $caminho_pagina; ?>/usuario/editarFuncionario_view.php?id_usuario=<?php echo htmlspecialchars($funcionario['id_usuario']); ?>">Editar</a></td>
                                <td>
                                    <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('<?php echo htmlspecialchars($funcionario['id_usuario']); ?>')">Deletar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require_once('../components/Rodape.php'); ?>

    <script>
    function confirmDelete(idUsuario) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-primary mx-2", 
                cancelButton: "btn btn-danger mx-2"   
            },
            buttonsStyling: false 
        });

        swalWithBootstrapButtons.fire({
            title: "Tem certeza?",
            text: "Você não poderá reverter essa ação!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sim, deletar!",
            cancelButtonText: "Não, cancelar!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirecionar para o controlador de exclusão
                window.location.href = "<?php echo $caminho_pagina; ?>../../model/actions/deletarUsuario_controller.php?id_usuario=" + idUsuario;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelado",
                    text: "O funcionário não foi excluído :)",
                    icon: "error"
                });
            }
        });
    }
</script>

</body>

</html>
