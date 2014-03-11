<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }
    public function loginAction()
    {
     
    }
    public function indexAction()
    {
        // action body
        try{
            
            $this->view->arrayTeste = array(1,2,3,4,5);

            $db = Zend_Db_Table::getDefaultAdapter();
            
            print "<pre>";
            
            //Default Adpter SQL
            $campos = array('*');
            $select = $db->select();
            $select->from(array('u' => 'usuario'), $campos);
            #$select->where("id in (1,2) ");            
            $select->order("1 desc");
            $select->limit(2);            
            
            $rows = $db->fetchAll($select);
            $this->view->usuario = $rows;
             
        
        }  catch (Exception $e){
            echo $e->getMessage();
        }
    }
    public function formAction()
    {
        // action body
                
        $telefone = $this->_request->getParam('telefone');
        
        $this->view->telefone = $telefone;
        
        $this->view->labelNome = "Telefone";
        
    }
    public function editarAction()
    {
        // action body
                
        $id = $this->_request->getParam('id'); 
        
    }
    public function excluirAction()
    {
        // action body
                
        $id = $this->_request->getParam('id'); 
        
    }

}

