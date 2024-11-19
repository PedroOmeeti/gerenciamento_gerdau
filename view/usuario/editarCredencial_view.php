<?php

require_once('../../model/actions/classes/usuario_model.php');
$usuario = new Usuario();

$id_usuario = $_GET['id_usuario'] ?? null; 

// Verifica se o ID do usuário foi fornecido
if (!$id_usuario) {
    echo "<p>ID do funcionário não informado.</p>";
    exit;
}

// Obtém os dados do funcionário
$dados_funcionario = $usuario->ObterFuncionarioPorId($id_usuario);
if (!$dados_funcionario) {
    echo "<p>Funcionário não encontrado.</p>";
    exit;
}

$email = $dados_funcionario['dados'][0]['email_usuario'];

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_email = $_POST['email'] ?? null; 

    // Verifica se o novo email foi fornecido
    if ($novo_email) {
        // Chama a função para editar o email
       $usuario->EditarEmailUsuario($novo_email, $id_usuario);
        header('Location: funcionario_view.php'); 
        exit;
    } else {
        echo "Email é obrigatório!";
    }
}

?>



<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Credenciais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="funcionario.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .card {
            border-radius: 15px;
        }

        .card-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            background-color: #007bff;
        }

        .card-header h5 {
            margin-bottom: 0;
        }

        .card-body {
            padding: 30px;
        }

        .form-label {
            font-weight: bold;
            color: #495057;
        }

        .form-control {
            border-radius: 10px;
            border-color: #ced4da;
            box-shadow: none;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: bold;
            border-radius: 50px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .text-muted {
            font-size: 0.875rem;
        }

        .container {
            margin-top: 50px;
        }

       
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php require_once('../components/Navbar.php'); ?>

    <div class="container mb-5">
        <div class="row">
            <div class="col">
                <h1 class="text-center texte-black mb-4">Editar Credenciais do Funcionário</h1>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 col-md-8 mx-auto">
                <div class="card shadow-lg">
                    <div class="card-header text-white">
                        <h5 class="mb-0">Formulário de Edição</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    value="<?php echo htmlspecialchars($dados_funcionario['dados'][0]['nome_usuario'] ?? ''); ?>"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Digite sua nova senha" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Digite a senha novamente</label>
                                <input type="password" class="form-control" id="doubpassword" name="doubpassword"
                                    placeholder="Digite sua nova senha" required>
                            </div>


                            <button type="submit" class="btn btn-primary w-100">Salvar Alterações</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <?php require_once('../components/Rodape.php'); ?>
</body>

</html>
