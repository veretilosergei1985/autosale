<?php

class CatalogController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {

        $this->view->text = 'Вася';

        
    }
    
    public function addAction()
    {
        //$this->view->headLink()->appendStylesheet('/css/init_add.css'); 
        $this->view->headScript()->appendFile('/js/init_add.js');
        //$this->headLink()->appendStylesheet('/css/init_add.css', 'screen');
        

        
    }


}

