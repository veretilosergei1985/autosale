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
                        $user->save();		
                        //$user->sendActivationEmail();		
                        $this->_helper->redirector('index');
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
      
    

}

