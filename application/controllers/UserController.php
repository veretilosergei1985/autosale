<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function registerAction()
    {
        $this->_helper->layout->setLayout('layout1');
        $this->view->headScript()->appendFile('/js/init_register.js');
        $this->view->headLink()->appendStylesheet('/css/init_register.css');
        
        $form = new Application_Form_Register();
        $this->view->form = $form;
        
    }
      
    

}

