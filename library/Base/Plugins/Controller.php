<?php

class Base_Plugins_Controller extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {

        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $viewRenderer->initView();
        $view = $viewRenderer->view;
        $front = Zend_Controller_Front::getInstance();

        /* Initialize action controller here */
        $action = $request->getActionName();
        $controller = $request->getControllerName();
        $module = $request->getModuleName();

        $view->baseUrl = "/" . $module . "/" . $controller;
        $view->controller = $controller;
        $view->module = $module;
        $view->action = $action;

        //Definições de PATHs
        define('PATH_MODULO', PATH_BASE_MODULO . "/$module");
        define('PATH_FORMS', PATH_MODULO . "/forms");
        define('PATH_CONTROLLERS', PATH_MODULO . "/controllers");
        define('PATH_VIEWS', PATH_MODULO . "/views");
        define('BASE_URL', "/" . $module . "/" . $controller);
        
        define("NO_MODULO",$module);
        define("NO_CONTROLLER",$controller);
        define("NO_ACTION",$action);

    }
        

}
