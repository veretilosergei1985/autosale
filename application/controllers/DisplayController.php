<?php

class DisplayController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function showemailformAction(){
        
        $user_id = $this->_getParam('user_id');
        $this->_helper->layout->disableLayout();
        // проверить залогинен ли пользователь
        
        $user = new Application_Model_Users();
        $this->view->data = $user->find($user_id);
//        echo "<pre>"; 
//        print_r($this->view->data->getUsername()); exit;
    }


}

