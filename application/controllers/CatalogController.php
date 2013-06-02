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
       $this->view->headLink()->appendStylesheet('/css/init_add.css');
       $this->view->headScript()->appendFile('/js/init_add.js');
       $this->_helper->layout->setLayout('layout1');
       
       $step = $this->_getParam('step');
       $autoId = $this->_getParam('autoId');
       
       if(!$step){
           // redirect
       }
       
       if($step == 'autoinfo'){

            $form = new Application_Form_AddCar();
            
            if($autoId == ''){
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

                                 $this->_helper->redirector('add', 'catalog', 'default', array('autoId' => 1, 'step' => 'addphoto'));
                    }
                    //echo "<pre>"; print_r($form->getErrors()); exit;
                }
           
            } else if($autoId != ''){
                
                
            }
            
            
            $this->view->form = $form;
       }
       
       if($autoId != '' && $step == 'addphoto'){
           
           $this->render('addphoto');
           
       }
       
       //// 2 step

    }
    
    


}

