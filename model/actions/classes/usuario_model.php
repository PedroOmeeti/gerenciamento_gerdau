<?php
// require_once('Banco.class.php');

class Usuario{
    public function Logar($email, $senha){
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/loginPorEmail.php";
        $dados = http_build_query(array(
            "email_usuario" => $email,
            "senha_usuario" => $senha,
        ));
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
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $resultado = json_decode($response, true);
        if (isset($resultado['token'])) {
            
            setcookie('nome_user', $resultado['nome_usuario'], time() + (86400 * 30), "/");
            session_start();
            $_SESSION['nome_usuario'] = $resultado['nome_usuario'];
            $_SESSION['email'] = $resultado['email_usuario'];
            $_SESSION['id'] = $resultado['id'];
            $_SESSION['chapa'] = $resultado['chapa_usuario'];
            $_SESSION['token'] = $resultado['token'];
            

            return true;
        } else {
            echo $response;
            return false;
        }
    }


    public function Cadastrar($email, $senha, $nome, $chapa, $permissao){
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/cadastrarUsuario.php";

        $dados = http_build_query(array(
            "email_usuario" => $email,
            "senha_usuario" => $senha,
            "nome_usuario" => $nome,
            "chapa_usuario" => $chapa,
            "permissao_usuario" => $permissao,
        ));
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
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
        curl_close($ch);
    }

    public function EditarEmailUsuario($email, $id){
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/alterarEmailUsuario.php";

        $dados = http_build_query(array(
            "email_usuario" => $email,
            "id_usuario" => $id
        ));
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        $resultado = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Erro no cURL: ' . curl_error($ch);
        } else {
            $response_data = json_decode($resultado);
            if (isset($response_data->sucesso) && $response_data->sucesso == true) {
                echo "Alteração realizada com sucesso!";
            } else {
                if (isset($response_data->mensagem)) {
                    echo "Erro na alteração do email: " . $response_data->mensagem;
                } else {
                    echo "Erro na alteração do email: resposta inesperada.";
                }
            }
        }
        curl_close($ch);
    }

    public function ListarUsuario()
    {
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/listarUsuarios.php";

        session_start();
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
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
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '',
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

    public function deletarUsuario($id) {
        $url = "http://10.141.46.20/gerdau-api/api-gerdau/endpoints/deletarUsuario.php";

        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_POSTFIELDS => 'id_usuario=' . $id,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            error_log('Curl error: ' . curl_error($curl));
        } else {
            error_log('Resposta da API: ' . $response);
        }
        curl_close($curl);
    

            
    $usuario = new Usuario();

    if (isset($_GET['id_usuario'])) {
        $id = $_GET['id_usuario'];
        $usuario->deletarUsuario($id);
        header("Location: funcionario_view.php");
        exit();
    } else {
        echo "ID do usuário não especificado.";
    }  
}

}

?>
