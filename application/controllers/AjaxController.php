<?php

class AjaxController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function sendAction(){
       // echo $_POST['owner_id']; exit;
        /*
        $settings = array(
              'ssl'=>'ssl',
    	      'port'=>465,
    	      'auth' => 'login',
    	      'username' => 'sergey.veretilo@gmail.com',
    	      'password' => 'serg10111985'
    	    );
        $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $settings);
        
        $email_from = "sender_address@domain.com";
        $name_from = "Sender's Name";
        $email_to = "receiver_address@gmail.com";
        $name_to = "Receiver's Name";
        
        $mail = new Zend_Mail ();
        //$mail->setReplyTo($email_from, $name_from);
        $mail->setFrom ($email_from, $name_from);
        $mail->addTo ($email_to, $name_to);
        $mail->setSubject ('Testing email using google accounts and Zend_Mail');
        $mail->setBodyText ("Email body");
        $mail->send($transport);
        
        echo "ok"; exit;
        
        */
        $this->_helper->layout->disableLayout();
  
        $fio = $this->getRequest()->getPost('fio');
        $email = $this->getRequest()->getPost('email');
        $phone = $this->getRequest()->getPost('phone');
        $message = $this->getRequest()->getPost('message');
        
        $owner_id = $this->getRequest()->getPost('owner_id');
    
        $user = new Application_Model_Users();
        $owner = $user->find($owner_id);

 //echo "<pre>"; print_r($owner);  exit;      
        $settings = array(
              'ssl'=>'ssl',
    	      'port'=>465,
    	      'auth' => 'login',
    	      'username' => 'sergey.veretilo@gmail.com',
    	      'password' => 'serg10111985'
    	    );
        $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $settings);
        
        $email_from = $email;
        $name_from = $fio;
        $email_to = $owner->email;
        $name_to = "Receiver's Name";
//echo $email_from ."--". $name_from . "--". $email_to;      exit;  
        $mail = new Zend_Mail('UTF-8');
        
        //$mail->setReplyTo($email_from, $name_from);
        $mail->setFrom ($email_from, $name_from);
        $mail->addTo ($email_to, 'NAME TO');
        $mail->setSubject ('Testing email using google accounts and Zend_Mail');
        $mail->setBodyText ($message);
        if($mail->send($transport)){
                echo "ok"; exit;
        } else {
            echo "error"; exit;
        }
       
    }


}

