<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initConstante() {
        define(TITULO_SISTEMA, "Aula 1");
        define(VERSAO, "1.0");
    }
    protected function _initViews() {

        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');
        $view->headTitle()->setSeparator(' - ')->headTitle(TITULO_SISTEMA)->setSeparator(' - ')->headTitle(VERSAO);

    }
    
    protected function _initConnection()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);

        try{
                $db = Zend_Db::factory($config->resources->db);

                // Registra o banco de dados
                $registry = Zend_Registry::getInstance();
                $registry->set('db', $db);

                Zend_Db_Table::setDefaultAdapter($db);
        }catch(Zend_Db_Exception $e){
                echo "Não foi possível realizar a conexão com o banco de dados.";
                exit;
        }
    }
    
}

