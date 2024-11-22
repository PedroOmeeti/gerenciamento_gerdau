<?php

require_once('classes/pedido_model.php');

$pedido = new Pedido();

$data_inicial = '18/11/2024';
$data_final = '25/12/2024';

$listaLegal =  $pedido->listarQtdEstrelaPorPrato(4, $data_inicial, $data_final);
print_r($listaLegal);

?>


