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
        $this->view->headScript()->appendFile('/js/init_add.js');
       $this->_helper->layout->setLayout('layout1');
  
        
        
    }
    
    


}

