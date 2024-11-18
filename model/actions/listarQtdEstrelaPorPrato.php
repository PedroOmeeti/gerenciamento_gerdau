<?php 

require_once('classes/cardapio_model.php');
$cardapio = new Cardapio();
print_r($cardapio->listarQtdEstrelaPorPrato($_GET['id_prato']));



?>