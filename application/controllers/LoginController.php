<?php

class LoginController extends Zend_Controller_Action {

    public function init() {
        $this->oLog = new Base_Util_FileLog();
    }
    public function loginAction() {
    }
    public function sairAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $_SESSION = array();
        $this->_redirect('/');
    }
    public function autenticarAction() {
        
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->layout->disableLayout();

        if ($this->_request->isPost()) {

            $no_login = $this->_request->getParam('login');
            $ds_senha = $this->_request->getParam('senha');

            $auth = Zend_Auth::getInstance();
            
            $authAdapter = new Base_Auth_AuthAdapter($no_login, $ds_senha);

            $result = $auth->authenticate($authAdapter);

            if ($result->isValid()) {
                $this->_redirect('/default/usuario/listar');
            } else {
                Zend_Auth::getInstance()->clearIdentity();
                $this->_redirect('/default/login/login');
            }
        }
    }
}