<?php

// Inicia a sessão
session_start();
if(!isset($_SESSION['token'])) {
    header("location: index.php");
    exit();
}
require_once('classes/cardapio_model.php');



$cardapio = new Cardapio();

// Verifica se as datas foram enviadas via POST ou GET
$data_inicial = isset($_POST['data_inicial']) ? $_POST['data_inicial'] : (isset($_GET['data_inicial']) ? $_GET['data_inicial'] : null);
$data_final = isset($_POST['data_final']) ? $_POST['data_final'] : (isset($_GET['data_final']) ? $_GET['data_final'] : null);

// Log das datas recebidas para depuração
error_log("Data inicial recebida: " . $data_inicial);
error_log("Data final recebida: " . $data_final);

// Verifica se as datas foram fornecidas
if ($data_inicial && $data_final) {
    // Converte as datas de Y-m-d para o formato d/m/Y
    $data_inicial_obj = DateTime::createFromFormat('Y-m-d', $data_inicial);
    $data_final_obj = DateTime::createFromFormat('Y-m-d', $data_final);

    // Verifica se a conversão foi bem-sucedida
    if (!$data_inicial_obj || !$data_final_obj) {
        error_log("Erro na conversão das datas.");
        echo json_encode(['erro' => 'Datas inválidas.']);
        exit();
    }

    // Converte as datas para o formato d/m/Y
    $data_inicial_formatada = $data_inicial_obj->format('d/m/Y');
    $data_final_formatada = $data_final_obj->format('d/m/Y');

    // Log das datas convertidas
    error_log("Data inicial convertida: " . $data_inicial_formatada);
    error_log("Data final convertida: " . $data_final_formatada);

    // Chama o método para listar o cardápio
    $lista_periodo = $cardapio->ListarPeriodo($data_inicial_formatada, $data_final_formatada);

    // Log da resposta da API
    error_log("Resposta da API: " . print_r($lista_periodo, true));

    // Verifica se a lista foi retornada corretamente
    if (isset($lista_periodo['erro'])) {
        error_log("Erro ao listar cardápio: " . $lista_periodo['erro']);
        echo json_encode(['erro' => 'Erro ao buscar cardápio.']);
        exit();
    }

    // Armazena a lista na sessão
    $_SESSION['lista_periodo'] = $lista_periodo;
    // Redireciona para a página de visualização do cardápio
    header("Location: ../../view/cardapio/cardapio_view.php");
    exit();
} else {
    // Se as datas não foram fornecidas, exibe erro
    echo json_encode(['erro' => 'Parâmetros data_inicial e data_final são necessários.']);
}
