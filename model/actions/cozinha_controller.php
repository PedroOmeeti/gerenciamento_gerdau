<?php

require_once('classes/cardapio_model.php');

$cardapio = new Cardapio();

if (isset($_GET['data_agendamento']) && !empty($_GET['data_agendamento'])) {
    $data_agendamento = $_GET['data_agendamento'];
    $data_agendamento = date('d/m/Y', strtotime(str_replace('/', '-', $data_agendamento)));
} else {
    $data_agendamento = date('d-m-Y');
}

$data_agendamento = str_replace('-', '/', $data_agendamento);

$pedidoDia = $cardapio->ListarPedidosDia($data_agendamento);
print_r($data_agendamento);
print_r('<br>');
print_r($pedidoDia);
header("Location: ../../view/cardapio/cozinha_view.php?data_agendamento=" . urlencode($data_agendamento));;
exit;

