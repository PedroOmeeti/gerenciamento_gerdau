<?php

require_once('classes/cardapio_model.php');

session_start();

$cardapio = new Cardapio();

if (isset($_POST['data_inicial']) && isset($_POST['data_final'])) {
    $data_inicial = $_POST['data_inicial'];
    $data_final = $_POST['data_final'];

    // Log das datas recebidas
    error_log("Data inicial: " . $data_inicial);
    error_log("Data final: " . $data_final);

    // Convertendo para o formato d/m/Y
    $data_inicial_obj = DateTime::createFromFormat('Y-m-d', $data_inicial);
    $data_final_obj = DateTime::createFromFormat('Y-m-d', $data_final);

    if (!$data_inicial_obj || !$data_final_obj) {
        error_log("Erro na conversão das datas.");
        echo json_encode(['erro' => 'Datas inválidas.']);
        exit();
    }

    // Formato d/m/Y para a API
    $data_inicial = $data_inicial_obj->format('d/m/Y');
    $data_final = $data_final_obj->format('d/m/Y');

    // Log das datas convertidas
    error_log("Data inicial convertida: " . $data_inicial);
    error_log("Data final convertida: " . $data_final);

    // Chama o método para listar o cardápio
    $lista_periodo = $cardapio->ListarPeriodo($data_inicial, $data_final);

    // Log da resposta da API
    error_log("Resposta da API: " . print_r($lista_periodo, true));

    // Verifica se a lista foi retornada corretamente
    if (isset($lista_periodo['erro'])) {
        error_log("Erro ao listar cardápio: " . $lista_periodo['erro']);
        echo json_encode(['erro' => 'Erro ao buscar cardápio.']);
        exit();
    }

    $_SESSION['lista_periodo'] = $lista_periodo;

    header("Location: ../../view/cardapio/cardapio_view.php");
    exit();
} else {
    echo json_encode(['erro' => 'Parâmetros data_inicial e data_final são necessários.']);
}
