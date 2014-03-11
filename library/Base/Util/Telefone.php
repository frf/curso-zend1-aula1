<?php


class Base_Util_Telefone {
    
    /**
     * Junta array
     * 
     * @param type $array 
     */
    public static function validaCelular($dsCelular) {  
        
       # $oApplicationIni = new Zend_Config_Ini(CONFIG_PATH . '/application.ini','production');
       
        $dsCelular = trim($dsCelular);
        
        $dsCelular = str_replace(" ", "", $dsCelular);
        $dsCelular = str_replace(".", "", $dsCelular);
        $dsCelular = str_replace("-", "", $dsCelular);
        $dsCelular = str_replace("(", "", $dsCelular);
        $dsCelular = str_replace(")", "", $dsCelular);
        
        $countDigitos = strlen($dsCelular);
        
        if($countDigitos > 11){
            
           $dsCelular = substr($dsCelular, 0,11);
           
           $primeiroDigito = (int) substr($dsCelular, 0,1);
                      
           if($primeiroDigito == 0){
               $dsCelular = substr($dsCelular, 1,11);
               
               return $dsCelular;
           }
           
           return false;
           
        }else if($countDigitos == 8){
            
            return false;
            //return $oApplicationIni->telefone->ddd->padrao. $dsCelular;
            
        }else if($countDigitos == 11){
            
            return $dsCelular;
            
        }else{
            return false;
        }
        
    }
    
}

