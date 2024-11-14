<?php
session_start();
if(!isset($_SESSION['token'])) {
    header("location: index.php");
    exit();
}
require_once('classes/usuario_model.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturando os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $nome = $_POST['nome'];
    $chapa = $_POST['chapa'];
    $permissao = $_POST['permissao'];

    // Criar uma nova instância da classe Usuario
    $usuario = new Usuario();

    // Chamar o método Cadastrar
    $usuario->Cadastrar($email, $senha, $nome, $chapa, $permissao);
    header("location: ../../view/usuario/cadastrarUsuario_view.php");
}
?>
