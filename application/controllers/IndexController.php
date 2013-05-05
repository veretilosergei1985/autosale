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
        //$this->view->list = $carsModel->fetchAll();
        
        //$regionsModel = new Application_Model_Regions();
        //$this->view->regions = $regionsModel->fetchAll();

//        echo "<pre>";
//        print_r($carsModel->findAll()); exit;
        $this->view->list = $carsModel->findAll();
        
        $er = new Base_Exchange();
        $data = $er->getExchangeRateByChar3("USD");
        $this->view->er = $data->rate/100;
        
    }


}

