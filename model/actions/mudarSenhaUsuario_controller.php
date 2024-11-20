<?php
  session_start();
  if(!isset($_SESSION['token'])) {
      header("location: index.php");
      exit();
  }
  
  require_once('classes/usuario_model.php');


  $usuario = new Usuario();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturando os dados do formulário
    session_start();
    $senha = $_POST['senha'];
    $id = $_SESSION['id'];

    // Chamar o método Cadastrar
    if($usuario->EditarSenhaUsuario($senha, $id)) {
      header("location: ../../sair.php");
    } else {
      header("location: ../../view/usuario/mudarSenhaUsuario.php");
      
    }
    
    
  }
?>