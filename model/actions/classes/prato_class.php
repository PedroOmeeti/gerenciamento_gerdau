<?php

require_once("Banco_model.php");

class Prato{
    public $id;
    public $nome_prato;
    public $descricao_prato;
    public $data_prato;
    public $preco;
    

    // public function CadastrarComFoto(){
    //     $sql = "INSERT INTO produtos (nome, descricao, foto, preco, estoque, id_categoria, id_resp) VALUES (?,?,?,?,?,?,?)";
    //     $conexao = Banco::conectar();
    //     $comando = $conexao->prepare($sql);
    //     $comando->execute([$this->Nome_prato, $this->descricao_prato, $this->data_prato, $this->preco]);
    //     $linhas = $comando->rowCount();
    //     Banco::desconectar();
    //     return $linhas;
    // }
  
    public function Listar(){   
        $sql = "SELECT * FROM pratos";
        $conexao = Banco::conectar();
        $comando = $conexao->prepare($sql);
        $comando->execute();
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $resultado;
    }

    public function ListarPorID(){
        $sql = "SELECT * FROM pratos WHERE id = ?";
        $conexao = Banco::conectar();
        $comando = $conexao->prepare($sql);
        $comando->execute([$this->id]);
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();

        return $resultado;
    }
    // public function Apagar(){
    //     $sql = "DELETE FROM produtos WHERE id = ?";
    //     $conexao = Banco::conectar();
    //     // Converter o comando sql (string) em um objeto:
    //     $comando = $conexao->prepare($sql);
    //     // Executa o comando:
    //     $comando->execute([$this->id]);
    //     $linhas = $comando->rowCount();
    //     Banco::desconectar();
    //     // Retornar a qtd de linhas removidas:
    //     return $linhas;
    // }

    public function Editar(){
        $sql = "UPDATE pratos SET nome_prato=?, descricao_prato=? WHERE id=?";
        $conexao = Banco::conectar();
        // Converter o comando sql (string) em um objeto:
        $comando = $conexao->prepare($sql);
        // Executa o comando:
        $comando->execute([$this->nome_prato, $this->descricao_prato, $this->id]);
        $linhas = $comando->rowCount();
        Banco::desconectar();
        // Retornar a qtd de linhas removidas:
        return $linhas;
    }

    // public function ListarFoto(){
    //     $sql = "SELECT foto FROM produtoo WHERE id = ?";
    //     $conexao = Banco::conectar();
    //     $comando = $conexao->prepare($sql);
    //     $comando->execute([$this->id]);
    //     $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
    //     Banco::desconectar();

    //     return $resultado;
    // }
}


?>