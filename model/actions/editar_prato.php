<?php
// Verificar se a página está sendo carregada por POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    require_once('classes/prato_class.php');
    $c = new Prato();
    $c->nome_prato = strip_tags($_POST['nome']);
    $c->descricao_prato = strip_tags($_POST['descricao']);
    $c->id = strip_tags($_POST['id']);

    if($c->Editar() == 1){

        // Redirecionar de volta à painel.php:
        // unlink("../fotos/" . $resultado);
        header('Location: ../../view/cardapio_view.php?sucesso=modificarok');
    }else{
        header('Location: ../../view/cardapio_view.php?erro=modificarerro');
    }
}else{
    echo '<h3>Essa página deve ser carregada por POST.</h3>';
}

?>