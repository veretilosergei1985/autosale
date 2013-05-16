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
        
        $this->view->title = "Регистрация нового пользователя.";
        $this->view->headTitle($this->view->title, 'PREPEND');
        $form = new Application_Form_Register();

        if ($this->getRequest()->isPost()) {
                if ($form->isValid($this->getRequest()->getPost())) {
                        $user = new Application_Model_Users();
                        $user->fill($form->getValues());
                        $user->created = date('Y-m-d H:i:s');
                        $user->password = sha1($user->password);
                        $user->code = uniqid();				
                        $user->save();		
                        //$user->sendActivationEmail();		
                        $this->_helper->redirector('index');
                }
        }

        $this->view->form = $form;
        
        
    }
      
    

}

