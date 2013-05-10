<?php

class DisplayController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function showemailformAction(){
        
        $car_user_id = $this->_getParam('car_user_id');
        $curr_user_id = $this->_getParam('curr_user_id');
        
        $this->_helper->layout->disableLayout();
        // проверить залогинен ли пользователь
        
        $user = new Application_Model_Users();
        $this->view->curr_data = $user->find($curr_user_id);
        $this->view->owner_id = $curr_user_id;
        
        
    }


}

