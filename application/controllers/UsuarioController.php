<?php

class UsuarioController extends Zend_Controller_Action
{

    public function init()
    {
        
    }
    public function listarAction()
    {
         // action body
        try{
            $db = Zend_Db_Table::getDefaultAdapter();
            
            print "<pre>";
            
            //Default Adpter SQL
            $campos = array('*');
            $select = $db->select();
            $select->from(array('u' => 'usuario'), $campos);
            $select->order("1 desc");
            
            $rows = $db->fetchAll($select);
            $this->view->usuario = $rows;
            
        }  catch (Exception $e){
            echo $e->getMessage();
        }
    }    
    public function cadastrarAction()
    {
        try{
            
            $this->view->titulo_pagina = "CADASTRAR";
            
            
            /*
            +-------+-------------+------+-----+---------+----------------+
            | Field | Type        | Null | Key | Default | Extra          |
            +-------+-------------+------+-----+---------+----------------+
            | id    | int(4)      | NO   | PRI | NULL    | auto_increment |
            | nome  | varchar(50) | NO   |     | NULL    |                |
            | login | varchar(20) | NO   | UNI | NULL    |                |
            | senha | varchar(30) | NO   |     | NULL    |                |
            +-------+-------------+------+-----+---------+----------------+
            */
            if ($this->getRequest()->isPost()) {
                
                $id     = $this->_request->getParam('id'); 
                $nome   = $this->_request->getParam('nome'); 
                $login  = $this->_request->getParam('login'); 
                $senha  = $this->_request->getParam('senha'); 
                
                //Inicia o banco de dados
                $db = Zend_Db_Table::getDefaultAdapter();
                
                //Criar array de dados
                
                $data['nome']   = $nome;
                $data['login']  = $login;
                $data['senha']  = $senha;
                
                if($id != ""){
                    
                }else{
                    $db->insert("usuario",$data);
                }
                
                $this->_helper->redirector('listar');
            }
            
        }  catch (Exception $e){
            echo $e->getMessage();
        }
        
    }
    public function editarAction()
    {
        $this->view->titulo_pagina = "EDITAR";
        
        $id = $this->_request->getParam('id'); 
        
        if($id != ""){
                //Pegar dados do usuario
                
                $db = Zend_Db_Table::getDefaultAdapter();
            
                //Default Adpter SQL
                $campos = array('*');
                $select = $db->select();
                $select->from(array('u' => 'usuario'), $campos);
                $select->where("id = $id ");  

                $rows = $db->fetchRow($select);
                
                $this->view->id     = $id;
                $this->view->nome   = $rows['nome'];
                $this->view->login  = $rows['login'];
                $this->view->senha  = $rows['senha'];
        }
        
        $this->render('cadastrar');
        
    }
    public function excluirAction()
    {
        // action body
                
        $id = $this->_request->getParam('id'); 
        
    }

}

