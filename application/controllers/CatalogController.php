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
  
       $form = new Application_Form_AddCar();
       
       if ($this->getRequest()->isPost()) {
                if ($form->isValid($this->getRequest()->getPost())) {
                        $data = $form->getValues();
                        /*
                        $user = new Application_Model_Users();
                        
                        $user->setEmail($data['email']);
                        $user->setPassword($data['password']);
                        $user->setUsername($data['username']);
                        $user->setPhone($data['code'].$data['phone']);
                        $user->setRegId($data['region']);
                        $user->setCityId($data['city']);

                        $ins_id = $user->save();		
;
                         * 
                         */
                        $this->_helper->redirector('mymenu', 'user', 'default', array('id' => $ins_id));
                } /* else { 
                    $messages = array();
                    foreach($form->getMessages() as $k => $v){
                        $messages[$k]['label'] = $form->getElement($k)->getLabel();
                        
                        foreach($v as $err => $text){
                            $messages[$k]['message'] = $text;
                        }
                        
                    }
                      $this->view->messages = $messages;
                      */
            }
       //}
       
       $this->view->form = $form;
        
        
    }
    
    


}

