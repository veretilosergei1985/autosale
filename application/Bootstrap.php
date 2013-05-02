<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initViewHelpers(){ 
        $this->bootstrap("layout");
        $layout = $this->getResource('layout');

        $view = $layout->getView();
        $view->headMeta()->appendHttpEquiv('Content-Type','text/html;charset=utf-8');
        $view->headTitle('Автопродажа');
        $view->headTitle()->setSeparator(' :: ');
        
        
        
    }
    
    

}

