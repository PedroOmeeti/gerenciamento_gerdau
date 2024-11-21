<?php

require_once('classes/usuario_model.php');

$usuario = new Usuario();

$id = $_GET['id_usuario'] ?? null;
if ($id === null) {
    die('ID do usuário não informado.');
}


$dados = $usuario->deletarUsuario($id);

if (isset($dados['id_usuario'])) {
    print_r($dados['id_usuario']);
} else {
    header('Location: ../../view/usuario/funcionario_view.php?dados=' . urlencode(json_encode($dados)));
    die('Erro ao deletar usuário.');
}

header('Location: ../../view/usuario/funcionario_view.php?dados=' . urlencode(json_encode($dados)));
exit;

