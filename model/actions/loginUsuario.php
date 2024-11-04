<?php
require_once('./classes/login_model.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;

    if (is_null($email) || is_null($senha)) {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Parâmetros ausentes.']);
        exit;
    }
    $usuario = new Usuario();

    $resultado = $usuario->Logar($email, $senha);

    if ($resultado) {   
        session_start();
        $_SESSION['email'] = $email;
        header('Location: ../../view/painel_adm_view.php');
    } else {
        echo "Erro no login";
    }
}

?>