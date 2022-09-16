<?php
require_once("src/Model/Produto.php");
require_once("src/Controller/Auth.php");
class ProdutoCtrl{

    public function consulta(){
       $auth = new Auth();
       $auth->validaSessao();
       if(!isset($_GET["nome"]) ){
            exit( json_encode(
                    array("error" => true,
                    "mensagem"=> "parametro incorreto")
            ));
        }
        
        try{
            $produto = new Produto();
            $result = $produto->getProduto($_GET["nome"]);
            exit( json_encode(
                array(
                       "error"=> false,
                       "dados" => $result)
                ));

        }catch(Exception $e){
            exit( json_encode(
                array("Error"=>true,
                "mensagem"=> "Erro ao executar consulta")
            ));
        }



    }

}