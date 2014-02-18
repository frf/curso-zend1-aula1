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
            
            $tipo_filtro             = $this->_request->getParam('tipo_filtro'); 
            $this->view->tipo_filtro = $tipo_filtro;
            
            $busca                   = $this->_request->getParam('busca'); 
            
            $ordem                   = $this->_request->getParam('ordem','nome'); 
            $ordem_tipo              = $this->_request->getParam('ordem_tipo','asc'); 
          
            
            $db = Zend_Db_Table::getDefaultAdapter();
             //Default Adpter SQL
            $campos = array('*');
            $select = $db->select();
            $select->from(array('u' => 'usuario'), $campos);
            
           
            
            /*
             * Filtro
             */
            if($tipo_filtro == "nome"){
                $select->where("nome like '%$busca%'");
            }
            if($tipo_filtro == "login"){
                $select->where("login like '%$busca%'");
            }
            
            /*
             * Ordem
             */  
            if($ordem == "nome"){
                if($ordem_tipo == "asc"){
                    $select->order("nome asc");                    
                }
                if($ordem_tipo == "desc"){
                    $select->order("nome desc");
                }
            }
            if($ordem == "login"){
                if($ordem_tipo == "asc"){
                    $select->order("login asc");
                }
                if($ordem_tipo == "desc"){
                    $select->order("login desc");
                }
            }
            
            if($ordem_tipo == "asc"){
                $this->view->ordem_tipo = "desc";
            }
            if($ordem_tipo == "desc"){
                $this->view->ordem_tipo = "asc";
            }
            
            
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
                    
                    if(!is_numeric($id)){
                        echo 'ERRO NAO E NUMERO  ';
                        exit;
                    }
                    
                    //Default Adpter SQL
                    $campos = array('*');
                    $select = $db->select();
                    $select->from(array('u' => 'usuario'), $campos);
                    $select->where("id = $id "); 
                    
                    if(!$db->fetchRow($select)){
                        echo "ERRO NAO EXISTE ESTE REGISTRO";
                        
                        exit;
                    }
                    
                    //UPDATE
                    $db->update("usuario",$data,"id = $id");
                    
                }else{
                    //INSERT
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
        try{
            
                $this->view->titulo_pagina = "EDITAR";

                $id = $this->_request->getParam('id'); 

                if($id == ""){
                    throw new Exception("ID VAZIO","999999999");
                }

                if($id != ""){
                        //Pegar dados do usuario

                        $db = Zend_Db_Table::getDefaultAdapter();

                        //Default Adpter SQL
                        $campos = array('*');
                        $select = $db->select();
                        $select->from(array('u' => 'usuario'), $campos);
                        $select->where("id = $id ");  

                        $rows = $db->fetchRow($select);

                        if(!$rows){
                            echo "ERRO NENHUM REGISTRO ENCONTRADO";                    
                            exit;   
                        }

                        $this->view->id     = $id;
                        $this->view->nome   = $rows['nome'];
                        $this->view->login  = $rows['login'];
                        $this->view->senha  = $rows['senha'];
                }

                $this->render('cadastrar');
        
         }  catch (Exception $e){
            
            $this->view->exception = $e;
            
            $this->renderScript('/error/erroaula.phtml');
        }
    }
    public function excluirAction()
    {
        // action body
                
        $id = $this->_request->getParam('id'); 
        
    }

}

