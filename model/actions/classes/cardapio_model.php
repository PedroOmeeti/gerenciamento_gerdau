<?php
// require_once('Banco.class.php');

class Cardapio
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

    public function ListarPeriodo($data_inicial, $data_final)
    {
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/listarCardapioPeriodo.php";



        $dados = http_build_query(array(
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
        var_dump($response);
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


    public function AdicionarItem($id_prato, $id_ingrediente, $data_cardapio)
    {
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/adicionarItemCardapio.php";
        $dados = http_build_query(array(
            "id_prato" => $id_prato,
            "id_ingrediente" => $id_ingrediente,
            "data_cardapio" => $data_cardapio,
        ));
        $this ->verificarSessao();
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization:' . $this->token 
        ));
        $resultado = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Erro no cURL: ' . curl_error($ch);
        } else {
            $response_data = json_decode($resultado);
            if (isset($response_data->sucesso) && $response_data->sucesso == true) {
                echo "Cadastro realizado com sucesso!";
            } else {
                if (isset($response_data->mensagem)) {
                    echo "Erro no cadastro: " . $response_data->mensagem;
                } else {
                    echo "Erro no cadastro: resposta inesperada.";
                }
            }
        }
        if (isset($resultado['token']['token'])) {
            $_SESSION['token'] = $resultado['token']['token'];
        }
        curl_close($ch);
        return $response_data;
    }

    
    public function AdicionarIngredientes($nome_ingrediente)
    {
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/adicionarIngrediente.php";
    
        // Dados enviados no corpo da requisição
        $dados = http_build_query(array(
            "nome_ingrediente" => $nome_ingrediente,
        ));
    
        // Verificação da sessão
        $this->verificarSessao();
    
        // Inicializa o cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: ' . $this->token 
        ));
    
        // Executa a requisição
        $resultado = curl_exec($ch);
    
        if (curl_errno($ch)) {
            echo 'Erro no cURL: ' . curl_error($ch);
            curl_close($ch);
            return null;
        }
    
        // Fecha a conexão cURL
        curl_close($ch);
    
        // Decodifica a resposta JSON
        $response_data = json_decode($resultado, true);
    
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Erro ao decodificar a resposta da API: " . json_last_error_msg();
            return null;
        }
    
        // Processa a resposta da API
        if (isset($response_data['sucesso']) && $response_data['sucesso'] === true) {
            echo "Cadastro realizado com sucesso!";
        } else {
            if (isset($response_data['mensagem'])) {
                echo "Erro no cadastro: " . $response_data['mensagem'];
            } else {
                echo "Erro no cadastro: resposta inesperada.";
            }
        }
    
        // Atualiza o token, se estiver presente na resposta
        if (isset($response_data['token']['token'])) {
            $_SESSION['token'] = $response_data['token']['token'];
        }
    
        return $response_data;
    }
    
    

    public function ListarPrato()
    {
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/listarPratos.php";

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
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '',
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

    public function ListarIngredientes()
    {
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/listarIngredientes.php";

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
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '',
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

    public function ListarCardapioPorDia($data_cardapio)
    {
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/listarCardapioPorDia.php?data_cardapio=" . urlencode($data_cardapio);


        $dados = http_build_query(array(
            "data_cardapio" => $data_cardapio
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
            CURLOPT_POST => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
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
    public function ListarPratoPorDia($data_cardapio, $id_prato)
    {
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/listarPratoCardapioDia.php";


        $dados = http_build_query(array(
            "data_cardapio" => $data_cardapio,
            "id_prato" => $id_prato
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
            CURLOPT_POST => true,
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


    public function ExcluirCardapioId($id_prato, $data_cardapio)
    {
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/excluirPratoCardapioDia.php";


        $dados = http_build_query(array(
            "id_prato" => $id_prato,
            "data_cardapio" => $data_cardapio

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
            CURLOPT_POST => true,
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
}
