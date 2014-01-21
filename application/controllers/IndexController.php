<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }
    public function dbAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
        $db = Zend_Db_Table::getDefaultAdapter();
        
        print "<pre>";
        
        $select = $db->select();
        $select->from('usuario');
        
        $rows = $db->fetchAll($select);
        
        var_dump($rows);
        
    }


}

