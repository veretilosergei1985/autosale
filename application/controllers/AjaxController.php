<?php

class AjaxController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function sendAction(){
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
       
    }


}

