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
        //$this->view->list = $carsModel->findAll();
        
        
        $result =  $carsModel->findAll();
        $page=$this->_getParam('p',1);
        
        $paginator = Zend_Paginator::factory($result);
        $paginator->setItemCountPerPage(5);
        $paginator->setCurrentPageNumber($page);

        $this->view->paginator=$paginator;    
        
        
        $er = new Base_Exchange();
        $data = $er->getExchangeRateByChar3("USD");
        $this->view->er = $data->rate/100;
        
    }
    
    public function viewAction()
    {
        $this->view->headScript()->appendFile('/js/init_view.js');
        
        $id = $this->_getParam('id');
        $main_photo = '';
        
        $carsModel = new Application_Model_Cars();
        $data = $carsModel->find($id);
        $this->view->data = $data;

        $photosModel = new Application_Model_Photos();
        $photos = $photosModel->findByAutoId($id);
        $this->view->photos = $photos; 
                
        foreach($photos as $photo){
            if($photo['is_main'] == 1){
                $main_photo = $photo['image'];
                break;
            }
        }
        $this->view->main_photo = $main_photo;
        
        $er = new Base_Exchange();
        $usd = $er->getExchangeRateByChar3("USD");
        $eur = $er->getExchangeRateByChar3("EUR");
        
        $this->view->usd = $usd->rate/100;
        $this->view->eur = $eur->rate/100;
        $this->view->rel = floatval($this->view->eur)/floatval($this->view->usd);

        $elapsed_time = new Base_ElapsedTime();
        //$this->view->elapsed_time = $elapsed_time->get_elapsed_time(strtotime($data['user_added']));
        //$this->view->reg_time = $elapsed_time->get_reg_time(strtotime($data['last_login']));
        
        // get full characteristics
        $safety = $carsModel->getAttributesById($id, 'safety');
        $comfort = $carsModel->getAttributesById($id, 'comfort');
        //$other = $carsModel->getAttributesById($id, 'other');
        $multimedia = $carsModel->getAttributesById($id, 'multimedia');
        $state = $carsModel->getAttributesById($id, 'state');
        
        $this->view->safety = $safety; 
        $this->view->comfort = $comfort;
        //$this->view->other = $other;
        $this->view->multimedia = $multimedia;
        $this->view->state = $state;
                        
        
        
        //echo "<pre>"; print_r($this->view->safety); exit;
    }
    
    public function testAction(){
        echo "1111111111"; exit;
    }
    
    

}

