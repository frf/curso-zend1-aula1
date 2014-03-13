<?php

class Base_Auth_AuthAdapter implements Zend_Auth_Adapter_Interface
{
    private $login;
    private $password;
   

    public function __construct( $login, $password )
    {
        $this->login 	= strtoupper($login);
        $this->password = $password;
        
        $this->oLog = new Base_Util_FileLog();
    }

    public function authenticate() {
        
        try{
            
            $db = Zend_Db_Table::getDefaultAdapter();

            $querysqlLogin = "select login,senha,nome from usuario 
                                        where login='".$this->login."' "
                                        . "AND senha='".$this->password."'";

            $result = $db->query($querysqlLogin);
            $aResultadoQuery = $result->fetch(); 

            if($aResultadoQuery){
                $code = Zend_Auth_Result::SUCCESS;
                $identity = $aResultadoQuery;
                $this->oLog->write('Usuário Logado com sucesso (' . $aResultadoQuery['nome'] . ")");
            }else{
                $code = Zend_Auth_Result::FAILURE;
                $identity = null;
                $this->oLog->write('Erro de autenticacao');
            }
            
            return new Zend_Auth_Result( $code, $identity );
            
        }  catch (Exception $e){
            echo "Erro autenticar: " . $e->getMessage();
        }
    }
}