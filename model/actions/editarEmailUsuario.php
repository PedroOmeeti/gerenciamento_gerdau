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
    $id = $_POST['id'];

    // Criar uma nova instância da classe Usuario
    $usuario = new Usuario();

    // Chamar o método Cadastrar
    $usuario->EditarEmailUsuario($email, $id);
    
}
?>
