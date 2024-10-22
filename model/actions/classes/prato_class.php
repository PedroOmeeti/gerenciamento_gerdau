<?php

require_once("Banco.class.php");

class Prato{
    public $id;
    public $Nome_prato;
    public $descricao_prato;
    public $data_prato;
    public $preco;
    

    public function CadastrarComFoto(){
        $sql = "INSERT INTO produtos (nome, descricao, foto, preco, estoque, id_categoria, id_resp) VALUES (?,?,?,?,?,?,?)";
        $conexao = Banco::conectar();
        $comando = $conexao->prepare($sql);
        $comando->execute([$this->nome, $this->descricao, $this->foto, $this->preco, $this->estoque, $this->id_categoria, $this->id_resp]);
        $linhas = $comando->rowCount();
        Banco::desconectar();
        return $linhas;
    }
  
    public function CadastrarSemFoto(){
        $sql = "INSERT INTO produtos (nome, descricao, preco, estoque, id_categoria, id_resp) 
        VALUES (?,?,?,?,?,?)";
        $conexao = Banco::conectar();
        $comando = $conexao->prepare($sql);
        $comando->execute([$this->nome, $this->descricao, $this->preco, $this->estoque, $this->id_categoria, $this->id_resp]);
        $linhas = $comando->rowCount(); 
        Banco::desconectar();
        return $linhas;
    }
    public function Listar(){   
        $sql = "SELECT * FROM produtoo";
        $conexao = Banco::conectar();
        $comando = $conexao->prepare($sql);
        $comando->execute();
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $resultado;
    }
    public function ListarPorID(){
        $sql = "SELECT * FROM produtoo WHERE id = ?";
        $conexao = Banco::conectar();
        $comando = $conexao->prepare($sql);
        $comando->execute([$this->id]);
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();

        return $resultado;
    }
    public function Apagar(){
        $sql = "DELETE FROM produtos WHERE id = ?";
        $conexao = Banco::conectar();
        // Converter o comando sql (string) em um objeto:
        $comando = $conexao->prepare($sql);
        // Executa o comando:
        $comando->execute([$this->id]);
        $linhas = $comando->rowCount();
        Banco::desconectar();
        // Retornar a qtd de linhas removidas:
        return $linhas;
    }

    public function Editar(){
        $sql = "UPDATE produtos SET nome=?, descricao=?, id_categoria=?, estoque=?, preco=? WHERE id=?";
        $conexao = Banco::conectar();
        // Converter o comando sql (string) em um objeto:
        $comando = $conexao->prepare($sql);
        // Executa o comando:
        $comando->execute([$this->nome, $this->descricao, $this->id_categoria, $this->estoque, $this->preco, $this->id]);
        $linhas = $comando->rowCount();
        Banco::desconectar();
        // Retornar a qtd de linhas removidas:
        return $linhas;
    }

    public function ListarFoto(){
        $sql = "SELECT foto FROM produtoo WHERE id = ?";
        $conexao = Banco::conectar();
        $comando = $conexao->prepare($sql);
        $comando->execute([$this->id]);
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();

        return $resultado;
    }
}


?>