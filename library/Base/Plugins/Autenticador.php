<?php

class Base_Plugins_Autenticador extends Zend_Controller_Plugin_Abstract {

    public function routeShutdown(Zend_Controller_Request_Abstract $request) {

        $oRedirector = new Zend_Controller_Action_Helper_Redirector();
        $oAuth = Zend_Auth::getInstance();
        
        if (! $oAuth->hasIdentity()) {
            $oRedirector->gotoUrl('/default/index/login');
        } else {
            $oRedirector->gotoUrl('/default/index/acesso-negado');
        }
    }

}

?>
