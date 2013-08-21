<?php

class AjaxController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function sendmailtoownerAction(){
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
        $data = array();
        
        $this->_helper->layout->disableLayout();
  
        $fio = $this->getRequest()->getPost('fio');
        $email = $this->getRequest()->getPost('email');
        $phone = $this->getRequest()->getPost('phone');
        $message = $this->getRequest()->getPost('message');
        $user_id = $this->getRequest()->getPost('user_id');
        $car_id = $this->getRequest()->getPost('car_id');
        
        $owner_id = $this->getRequest()->getPost('owner_id');
    
        $ownerModel = new Application_Model_Users();
        $owner = $ownerModel->find($owner_id);
        
        $senderModel = new Application_Model_Users();
        $sender = $senderModel->find($user_id);
        
        $carModel = new Application_Model_Cars();
        $car_data = $carModel->find($car_id);
        
        $email_to = $owner->email;
        $email_from = $email;
        
        
        $data['owner_username'] = $owner->username;
        $data['sender_username'] = $sender->username;
        $data['sender_phone'] = $phone;
        $data['sender_email'] = $email;  
        $data['car_id'] = $car_id;
        $data['car_model'] = $car_data->model_name;
        $data['car_mark'] = $car_data->mark_name;
        $data['message'] = $message;
            
             
        /*
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
        
        $name_to = "Receiver's Name";
        //echo $email_from ."--". $name_from . "--". $email_to;      exit;  
        $mail = new Zend_Mail('UTF-8');
        
        //$mail->setReplyTo($email_from, $name_from);
        $mail->setFrom($email_from, $name_from);
        $mail->addTo($email_to, 'NAME TO');
        $mail->setSubject('Testing email using google accounts and Zend_Mail');
        $mail->setBodyText($message);
        
        if($mail->send($transport)){
                echo "ok"; exit;
        } else {
            echo "error"; exit;
        }

        $text = '';

        $mail = new Zend_Mail('UTF-8');
        $mail->setBodyHtml($text);
        $mail->addTo($email_to);
        $mail->setSubject('Вопрос по Вашему объявлению.');
        $mail->setFrom($email_from);
        if($mail->send()){
            echo "ok"; exit;
        } else {
            echo "error"; exit;
        }
        */
        
        $mail = new Base_Mail();
        $mail->setFrom($email_from);
        $mail->addTo($email_to);
        $mail->setSubject('Вопрос по Вашему объявлению.');
        $mail->setBodyView('emailtoowner', $data);
       
        if($mail->send()){
            echo "ok"; exit;
        } else {
            echo "error"; exit;
        }
       
    }
    
    


}

