<?php

class Base_Util_FileLog {
    
    private $_debug = true;
    
    /**
     * Abre arquivo para gravar log
     */
    public function __construct($debug_mode=false,$prefixo="") {
     
        
        if (! empty($prefixo))
            $this->arquivoLog = LOG_PATH . "/" . $prefixo . "_" . date('Ymd') . ".log";
        else
            $this->arquivoLog = LOG_PATH . "/" . date('Ymd') . ".log";
        
        
        $this->_debug = (boolean) $debug_mode;
        
    }
 
    /** Escreve no arquivo de log **/
    public static function write($msg) {
        $arquivoLog = LOG_PATH . "/" . date('Ymd') . ".log";
        
        $texto = "[" . date("Y-m-d H:i:s") . "] $msg \n";
        
        $bCriado = @file_put_contents($arquivoLog, $texto, FILE_APPEND);
                
        if (! $bCriado)
            throw new Exception("Não foi possível gravar FileLog => {$arquivoLog}");
        
    }
    
}