<?php
session_start();
if (!isset($_SESSION['token'])) {
    header("location: index.php");
    exit();
}

$idsUsuarios = isset($_GET['ids_usuarios']) ? $_GET['ids_usuarios'] : '';
$prato = isset($_GET['prato']) ? $_GET['prato'] : '';
$quantidadePedidos = isset($_GET['quantidade_pedidos']) ? $_GET['quantidade_pedidos'] : '';
$dataAgendamento = isset($_GET['data_agendamento']) ? $_GET['data_agendamento'] : '';

require_once('../../model/actions/classes/usuario_model.php');
$usuario = new Usuario();
$listaFuncionarios = $usuario->listarUsuario();

// Função para buscar os nomes dos usuários pelo ID
function obterNomesUsuarios($idsUsuarios, $listaFuncionarios)
{
    $idsArray = explode(',', $idsUsuarios); // Separar os IDs
    $usuarios = [];

    foreach ($idsArray as $id) {
        foreach ($listaFuncionarios['dados'] as $funcionario) {
            if ((int)$funcionario['id_usuario'] === (int)$id) {
                $usuarios[] = $funcionario; // Adiciona o funcionário correspondente
                break;
            }
        }
    }

    return $usuarios;
}

$usuariosFiltrados = obterNomesUsuarios($idsUsuarios, $listaFuncionarios);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Prato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php require_once('../components/Navbar.php'); ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1 class="text-center mb-4">Detalhes do Prato <?php echo htmlspecialchars($prato); ?></h1>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-md-10">
                <div class="card border-dark shadow-lg mb-4">
                    <div class="card-header text-white" style="background-color: #B49C5E; font-weight: bold;">
                        <h5 class="card-title">Lista de pedidos do prato <?php echo htmlspecialchars($prato); ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text fs-5"><strong>Quantidade de Pedidos:</strong> <?php echo htmlspecialchars($quantidadePedidos); ?></p>
                        <p class="card-text fs-5"><strong>Data de Agendamento:</strong> <?php echo htmlspecialchars($dataAgendamento); ?></p>
                    </div>
                    <div class="p-4">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Chapa</th>
                                </tr>
                            </thead>
                            <tbody class="p-3">
                                <?php
                                if (!empty($usuariosFiltrados)) {
                                    foreach ($usuariosFiltrados as $usuario) {
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($usuario['id_usuario']) . '</td>';
                                        echo '<td>' . htmlspecialchars($usuario['nome_usuario']) . '</td>';
                                        echo '<td>' . htmlspecialchars($usuario['email_usuario']) . '</td>';
                                        echo '<td>' . htmlspecialchars($usuario['chapa_usuario']) . '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr>';
                                    echo '<td colspan="4" class="text-center">Nenhum funcionário encontrado para este prato.</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

               

            </div>
        </div>
    </div>

    <?php require_once('../components/Rodape.php'); ?>
</body>

</html>