<?php

class UserController extends Zend_Controller_Action
{
    protected $session;
    
    public function preDispatch(){

        //$this->session = new Zend_Session_Namespace('Default');
    }
    
    public function init()
    {
        $this->session = new Zend_Session_Namespace('Default');
    }
    
    

    public function registerAction()
    {
        //$translate = include(APPLICATION_PATH . '/forms/translate.php');
        require_once APPLICATION_PATH . '/forms/translate.php';
              
        $this->_helper->layout->setLayout('layout1');
        $this->view->headScript()->appendFile('/js/init_register.js');
        $this->view->headLink()->appendStylesheet('/css/init_register.css');
        
        $this->view->title = "Регистрация нового пользователя.";
        $this->view->headTitle($this->view->title, 'PREPEND');
       
        $form = new Application_Form_Register();

        if ($this->getRequest()->isPost()) {
                        
             $city = $this->_getParam('city');
             if($city != ''){ 
               $_SESSION['city'] = $city;
             } 
                if ($form->isValid($this->getRequest()->getPost())) {
                        $data = $form->getValues();
                        $user = new Application_Model_Users();
                        
                        $user->setEmail($data['email']);
                        $user->setPassword($data['password']);
                        $user->setUsername($data['username']);
                        $user->setPhone($data['code'].$data['phone']);
                        $user->setRegId($data['region']);
                        $user->setCityId($data['city']);
                                                
//                        echo "<pre>";
//                        print_r($user);
//                        exit;
                        //$data = $form->getValues();	
                        $ins_id = $user->save();		
                        //$user->sendActivationEmail();		
                        //$this->_helper->redirector('index');
                        $this->_helper->redirector('mymenu', 'user', 'default', array('id' => $ins_id));
                }
        }

        $this->view->form = $form;
        //////////////
        /*
        $activationCode = sha1(uniqid('xyz', true)); 
 
        $newUser = array(
            'username' => $username,
            'password' => $this->computePasswordHash($password),
            'email' => $email,
            'active' => 0,
            'code' => $activationCode,
            'registered_on' => new Zend_Db_Expr('NOW()')
        );
 
        $userId = $this->insert($newUser);
 
        // send activation email
        $mailer = new Mailer();
        $languageCode = (string) Zend_Registry::get('Zend_Translate')->getAdapter()->getLocale();
        $activationLink = Zend_Registry::get('configuration')->general->url . '/user/activate/' . $userId . '/' . $activationCode;
        $mailer->sendRegistrationMail($email, $username, $activationLink, $languageCode);        
 
        return $userId;
       */ 
    }
    
    public function carregisterAction()
    {
        //$translate = include(APPLICATION_PATH . '/forms/translate.php');
        require_once APPLICATION_PATH . '/forms/translate.php';
              
        $this->_helper->layout->disableLayout();
       
        $form = new Application_Form_CarRegister();

        if ($this->getRequest()->isPost()) {

                if ($form->isValid($this->getRequest()->getPost())) {
                        $data = $form->getValues();
                        $user = new Application_Model_Users();
                        
                        $user->setEmail($data['email']);
                        $user->setPassword($data['password']);
                        $user->setUsername($data['username']);
                        $user->setPhone($data['code'].$data['phone']);
                        $user->setRegId($data['region']);
                        $user->setCityId($data['city']);
	
                        $ins_id = $user->save();		

                        $this->_helper->redirector('mymenu', 'user', 'default', array('id' => $ins_id));
                } else {
                    echo json_encode($form->getMessages()); exit;
                }
        }


    }
    
    public function mymenuAction(){
        $this->_helper->layout->setLayout('layout1');
        $this->view->headLink()->appendStylesheet('/css/init_mymenu.css');
        
        $user_id = $this->_getParam('id');
        $user = new Application_Model_Users();
        $data = $user->find($user_id);
        
        //echo "<pre>";
        //print_r($data->id); exit;
        
        $this->view->data = $data;
    }
    
    public function loginAction(){
        
        $this->view->headLink()->appendStylesheet('/css/init_login.css');
        $this->_helper->layout->setLayout('layout1');
        
        
        /////////
        $user = new Application_Model_Users();
        $form = new Application_Form_Login();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($_POST)) {
                if ($user->authorize($form->getValue('email'), $form->getValue('password'))) {
                        $this->_helper->redirector('mymenu');
                } else {
                        $this->view->error = 'Неверные данные авторизации.';
                }
            }
        }
        $this->view->form = $form;
       
    }
    
    public function logoutAction()
    {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_helper->redirector('login');
    }
      
    

}

