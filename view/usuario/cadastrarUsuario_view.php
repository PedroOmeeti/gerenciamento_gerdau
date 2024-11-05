<?php

    

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
    <?php require_once('../components/Navbar.php'); ?>
    <div class="container">
    <form action="../../model/actions/cadastrarUsuario.php" method="POST">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>
    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" class="form-control" id="senha" name="senha" required>
    </div>
    <div class="form-group">
        <label for="permissao">Permissão:</label>
        <select class="form-control" id="permissao" name="permissao" required>
            <option value="1">Administrador</option>
            <option value="2">Funcionário</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
</form>

    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>

</html>
