<?php
// require_once('Banco.class.php');

class Cardapio
{
    public function ListarPeriodo($data_inicial, $data_final)
    {
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/listarCardapioPeriodo.php";



        $dados = http_build_query(array(
            "data_inicial" => $data_inicial,
            "data_final" => $data_final,
        ));

        if (isset($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
        } else {
            die('Token não disponível.');
        }

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
                'Authorization:' . $token
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
        var_dump($response);
        $resultado = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('Erro no JSON: ' . json_last_error_msg());
        } else {
            error_log('Resposta decodificada: ' . print_r($resultado, true));
        }



        if (isset($resultado['token']['token'])) {
            setcookie('token', $resultado['token']['token'], time() + 7200, "/");
        }


        return $resultado;
    }
}
