<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $carsModel = new Application_Model_Cars();
        $this->view->list = $carsModel->fetchAll();
        
    }


}

