<?php
// require_once('Banco.class.php');

class Usuario{
    public $id;
    public $nome;
    public $email;
    public $senha;

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
            
            $token = $resultado['token'];
            
            setcookie('nome_usuario', $resultado['nome_usuario'], time() + 7200, "/");
            setcookie('email', $resultado['email_usuario'], time() + 7200, "/");
            setcookie('id', $resultado['id'], time() + 7200, "/");
            setcookie('chapa', $resultado['chapa_usuario'], time() + 7200, "/");
            setcookie('token', $token, time() + 7200, "/");
            

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
    
}

?>
