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
    
    public function viewAction()
    {
        $id = $this->_getParam('id');
        
        $carsModel = new Application_Model_Cars();
        //$data = $carsModel->find($id)->toArray();
        $this->view->data = $carsModel->find($id);
         //echo "<pre>"; print_r($this->view->data); exit;
        
        $er = new Base_Exchange();
        $usd = $er->getExchangeRateByChar3("USD");
        $eur = $er->getExchangeRateByChar3("EUR");
        
        $this->view->usd = $usd->rate/100;
        $this->view->eur = $eur->rate/100;
        $this->view->rel = floatval($this->view->eur)/floatval($this->view->usd);
    }


}

