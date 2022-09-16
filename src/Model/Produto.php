<?php
require_once("MySql.php");

Class Produto {

    private $nome;
    private $preco;
    private $dataCriacao;
    private $ultimaAtualizacao;
    
    public function criaProduto($nome, $preco){

        $query = MySql::getInstance()->prepare("INSERT INTO Produto (nome, preco, dataCriacao) VALUES (:nome, :preco, UTC_TIMESTAMP())");
        $query->BindParam(':nome',$nome);       
        $query->BindParam(':preco',$preco);            
        $execution = $query->execute();
        return MySql::getInstance()->lastInsertId();

    }

    public function getProduto($nome){
        $mysql = new MySql();
        $query = $mysql->getInstance()->prepare("SELECT * from Produto WHERE nome = :nome");
        $query->BindParam(':nome',$nome);          
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
         
    }

    public function atualizaProduto($id,$nome,$preco){

        $query = MySql::getInstance()->prepare("UPDATE Produto SET nome = :nome, preco = :preco, ultimaAtualizacao = UTC_TIMESTAMP() WHERE idproduto = :id");
        $query->BindParam(':nome',$nome);   
        $query->BindParam(':preco',$preco); 
        $query->BindParam(':id',$id);       
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function setNome(){
        $this->$nome;
    }

    public function getNome(){
        return $this->$nome;
    }

    public function setDataCriacao($data){
        $this->$dataCriacao = $data;
    }   

    public function getDataCriacao(){
        return $this->$dataCriacao;
    }

}
?>