<?php
require_once($_SERVER['DOCUMENT_ROOT']."/src/Model/MySql.php");

class Auth{

    public function validaSessao(){
    
        session_start();
        if(!isset($_SESSION['token']) || is_null($_SESSION['token'])) {
            exit( json_encode( array('error' => true ,
                                     'mensage' => "sessão não iniciada") ));
        }else{
            $this->validaTempoToken($_SESSION['token'][1]);
            exit( json_encode( array('error' => false ,
                                     'mensage' => "sessão iniciada") ));
        }  
    }

    public function geraToken(){
       
        try{

            $dateNow = new DateTime('now');
            $dateNow->setTimezone(new DateTimeZone('UTC'));
            $dateNowFormat = $dateNow->format('Y-m-d H:i:s');
            $novoToken = bin2hex(openssl_random_pseudo_bytes((32 - (32 % 2)) / 2));
            $query = MySql::getInstance()->prepare("INSERT INTO token (token, data_criacao) VALUES (:token, :data_criacao)");
            $query->BindParam(':token',$novoToken);   
            $query->BindParam(':data_criacao',$dateNowFormat); 
            $query->execute();
            echo json_encode( array(
                                    'token' => $novoToken,
                                    'error' => false,
                                    'mensagem' => "token gerado com sucesso"
                                    ) );

        }catch(Exception $e){
            echo  json_encode( array('error' => "Erro ao gerar token") ) ;
        }

    }

    public function verificatoken(){

      try{
            $token =  $_POST["token"];
            $query = MySql::getInstance()->prepare("select * from token  where token = :token");
            $query->BindParam(':token',$token);   
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            if(!count($result) < 1){
                $this->validaTempoToken($result[0]["data_criacao"]);

                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['token'] = array($result[0]["token"], $result[0]["data_criacao"] );
                session_write_close();
                
                exit( json_encode( array(
                                        'Sucesso' => "200",
                                        'error' => false,
                                        'mensagem' => "token validado!"
                                        ))) ;
            }else{
                exit(  json_encode( array(
                                            'error' => true,
                                            'mensagem' => "401"
                                         ) ) );
            }

       }catch(Exception $e){
            exit(  json_encode( array(
                                        'error' => true,
                                        'mensagem' => '401') ) );
       }
            
    }

    public function validaTempoToken($tokenDate){

        try{
            $dateToken = new DateTime($tokenDate);
            $dateNow = new DateTime("NOW");
            $dateToken->setTimezone(new DateTimeZone('UTC'));
            $dateNow->setTimezone(new DateTimeZone('UTC'));
            $diferencao = $dateNow->getTimestamp() - $dateToken->getTimestamp();

            if($diferencao > 3600){
             
                session_start();
                session_destroy();
                exit( json_encode(  
                                    array('error' => true,
                                           'mensagem' => 'Token expirou')
                                 ) );

            }
            
        }catch(Exception $e){
            echo  json_encode( array('error' => true,
                                      'mensagem' => 'Erro validar expiração do token') ) ;
        }
    }

    public function token(){
        session_start();
        session_destroy(); 
    }
  
}

?>