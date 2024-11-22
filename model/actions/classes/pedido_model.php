<?php 
  class Pedido
  {
      private $token;
      private function verificarSessao(){
          if (session_status() == PHP_SESSION_NONE) {
              session_start();
          }
          if (isset($_SESSION['token'])) {
  
              $this->token = $_SESSION['token'];
          } else {
              die('Token não disponível.');
          }
      }

      public function ListarTotalPedidosPratoPorData($id_prato, $data_inicial, $data_final) 
      {
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/listarTotalPedidosPratoPorData.php";



        $dados = http_build_query(array(
            "id_prato" => $id_prato,
            "data_inicial" => $data_inicial,
            "data_final" => $data_final,
        ));

       $this ->verificarSessao();

        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $dados,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization:' . $this->token 
            ),
        ));
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            error_log('Curl error: ' . curl_error($curl));
        } else {
            error_log('Resposta da API: ' . $response);
        }
        curl_close($curl);
 
        // Decodificando a resposta
        $resultado = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('Erro no JSON: ' . json_last_error_msg());
        } else {
            error_log('Resposta decodificada: ' . print_r($resultado, true));
        }
 
        if (isset($resultado['token']['token'])) {
            $_SESSION['token'] = $resultado['token']['token'];
        }
 
        return $resultado;
    
      }

      public function listarQtdEstrelaPorPrato($id_prato, $data_inicial, $data_final) {
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/listarQtdEstrelaPorPrato.php";
 
        $dados = http_build_query(array(
            "id_prato" => $id_prato,
            "data_inicial" => $data_inicial,
            "data_final" => $data_final
        ));
 
        $this ->verificarSessao();
 
        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $dados,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization:' . $this->token
            )
        ));
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            error_log('Curl error: ' . curl_error($curl));
        } else {
            error_log('Resposta da API: ' . $response);
        }
        curl_close($curl);
 
        // Decodificando a resposta
        $resultado = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('Erro no JSON: ' . json_last_error_msg());
        } else {
            error_log('Resposta decodificada: ' . print_r($resultado, true));
        }
 
        if (isset($resultado['token']['token'])) {
            $_SESSION['token'] = $resultado['token']['token'];
        }
 
        return $resultado;
    }

  }





?>