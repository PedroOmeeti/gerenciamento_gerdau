<?php
   session_start();
   if(!isset($_SESSION['token'])) {
       header("location: index.php");
       exit();
   }
   $raiz = 'http://' . $_SERVER['SERVER_NAME'] . '/gerenciamento_gerdau/';
   $caminho_pagina = $raiz . '/model';

   if (isset($_GET['cadastro'])) {
    if ($_GET['cadastro'] == 1) {
        echo '<div class="alert alert-success text-center" role="alert">Usuário cadastrado com sucesso!</div>';
    } elseif ($_GET['cadastro'] == 0) {
        echo '<div class="alert alert-danger text-center" role="alert">Erro ao cadastrar usuário. Por favor, tente novamente.</div>';
    }
}

   if (isset($_POST['chapa'])) {
       $chapa = $_POST['chapa'];
       if (strlen($chapa) < 8) {
           echo "<script>alert('A chapa precisa ter no minimo 8 caracteres');</script>";
           exit;
       }
   }

   


?>

<!DOCTYPE html>
<html lang="pt-br";

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require_once('../components/Navbar.php'); ?>
    <div class="d-flex align-items-center" style="height: 61vh">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card border border-dark border-2" style="width: 60rem;">
                    <div class="card-body d-flex">
                        <div class="col">
                            <form action="../../model/actions/cadastrarUsuario.php" method="POST" class="">
                                <div class="text-center form-group">
                                    <p class="fs-4"><strong>Cadastrar Usuário</strong></p>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="fs-5 mt-2" for="nome"><strong>Nome:</strong></label>
                                            <input type="text" placeholder="Digite um nome" class="form-control" id="nome" name="nome" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="fs-5 mt-2" for="chapa"><strong>Chapa:</strong></label>
                                            <input type="text" placeholder="Digite uma chapa (até 8 caracteres)" maxlength="8" class="form-control" id="chapa"
                                                name="chapa" onkeyup="verificarChapa()" required>
                                            <div id="verificacaoChapa" class="text-end text-form text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="fs-5 mt-2" for="senha"><strong>Senha:</strong></label>
                                            <input type="password" placeholder="Digite uma senha" onkeyup="verificarSenha()" class="form-control" id="senha" name="senha" required>
                                        </div>    
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="fs-5 mt-2" for="senha"><strong>Confirme a Senha:</strong></label>
                                            <input type="password" placeholder="Confirme a senha" onkeyup="verificarSenha()" class="form-control" id="csenha" name="senha" required>
                                            <div id="verificao" class="text-end text-form text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="fs-5 mt-2" for="email"><strong>Email:</strong></label>
                                            <input type="email" placeholder="Digite um email (não é obrigatório)" class="form-control" id="email" name="email">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                        <label class="fs-5 mt-2" for="permissao"><strong>Permissão:</strong></label>
                                            <select class="form-select" id="permissao" name="permissao" required>
                                                <option value="0">Funcionário</option>
                                                <option value="1">Administrador</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" id="botao" disabled class="btn btn-primary mt-3 d-flex justify-content-start ">Cadastrar</button>
                            </form>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        function verificarChapa() {
            var chapa = document.getElementById("chapa").value;
            var verificacaoChapa = document.getElementById("verificacaoChapa");
            var botao = document.getElementById("botao");

            // Verifica se a chapa tem exatamente 8 caracteres
            if (chapa.length !== 8) {
                verificacaoChapa.innerHTML = "A chapa deve ter exatamente 8 caracteres.";
                botao.disabled = true; // Desabilita o botão
            } else {
                verificacaoChapa.innerHTML = ""; // Limpa a mensagem de erro
                verificarSenha(); // Verifica também as senhas
            }
        }
      
      function verificarSenha() {
        var senha = document.getElementById("senha").value;
        var csenha = document.getElementById("csenha").value;
        var botao = document.getElementById("botao");
        var verificacao = document.getElementById("verificao");

        // Verifica se algum dos campos está vazio ou se as senhas não coincidem
        if (senha === "" || csenha === "") {
            verificacao.innerHTML = ""; // Limpa a mensagem de erro
            botao.disabled = true; // Desabilita o botão
        } else if (senha !== csenha) {
            verificacao.innerHTML = "As senhas não coincidem."; // Mostra a mensagem de erro
            botao.disabled = true; // Desabilita o botão
        } else {
            verificacao.innerHTML = ""; // Limpa a mensagem de erro
            botao.disabled = false; // Habilita o botão
        }

        // Garante que o botão seja desabilitado quando as senhas não coincidirem mesmo após a primeira ativação
        botao.disabled = (senha !== csenha || senha === "" || csenha === "");
      }


    </script>
    <?php
    require_once('../components/Rodape.php');
    ?></body>

</html>

