<?php
require_once('./classes/login_model.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturando os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $permissao = $_POST['permissao'];

    // Criar uma nova instância da classe Usuario
    $usuario = new Usuario();

    // Chamar o método Cadastrar
    $usuario->Cadastrar($nome, $email, $senha, $permissao);
}
?>
