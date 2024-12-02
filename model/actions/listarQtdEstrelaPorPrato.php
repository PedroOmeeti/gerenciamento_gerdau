<?php 

// Inicia a sessão
session_start();
if(!isset($_SESSION['token'])) {
    header("location: index.php");
    exit();
}
require_once('classes/pedido_model.php');


$pedido = new Pedido();

// Verifica se as datas foram enviadas via POST ou GET
$data_inicial = isset($_POST['data_inicial_formatada']) ? $_POST['data_inicial_formatada'] : (isset($_GET['data_inicial_formatada']) ? $_GET['data_inicial_formatada'] : null);
$data_final = isset($_POST['data_final_formatada']) ? $_POST['data_final_formatada'] : (isset($_GET['data_final_formatada']) ? $_GET['data_final_formatada'] : null);


// Verifica se as datas foram fornecidas
if ($data_inicial && $data_final) {
    // Converte as datas de Y-m-d para o formato d/m/Y
    $data_inicial_obj = DateTime::createFromFormat('Y-m-d', $data_inicial);
    $data_final_obj = DateTime::createFromFormat('Y-m-d', $data_final);

    $data_inicial_formatada = $data_inicial_obj->format('d/m/Y');
    $data_final_formatada = $data_final_obj->format('d/m/Y');

    // $lista_periodo = $pedido->ListarQtdEstrelaPorPrato($id_prato, $nota_pedido, $data_inicial_formatada, $data_final_formatada); 

    if (isset($lista_periodo['erro'])) {
        error_log("Erro ao listar cardápio: " . $lista_periodo['erro']);
        echo json_encode(['erro' => 'Erro ao buscar cardápio.']);
        exit();
    }

      
    // $_SESSION['lista_periodo'] = $lista_periodo;
    
    header("Location: ../../view/painel_adm_view.php?data_inicial=".urlencode($data_inicial)."&data_final=".urlencode($data_final));
    exit();
} else {

    echo json_encode(['erro' => 'Parâmetros data_inicial e data_final são necessários.']);
}





?>