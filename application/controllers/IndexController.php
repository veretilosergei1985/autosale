<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function searchAction()
    {
            
        $carsModel = new Application_Model_Cars();
       
        $photosModelCount = new Application_Model_Photos();
        $data = $photosModelCount->getPhotosCount();
        $photos_count = array();
        foreach($data as $item){
            $photos_count[$item->auto_id] = $item->cnt;
        }
        $this->view->photos_cnt = $photos_count;    
                        
        $result =  $carsModel->findAll();
                
        $page=$this->_getParam('p',1);
        
        $paginator = Zend_Paginator::factory($result);
        $paginator->setItemCountPerPage(1);
        $paginator->setCurrentPageNumber($page);

        $this->view->paginator = $paginator;    
                
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

        $userModel = new Application_Model_Users();
        $userModel->find($data->user_id);
        $this->view->owner = $userModel;
        //echo "<pre>"; print_r($data); exit;     
        
        $photosModel = new Application_Model_Photos();
        $photos = $photosModel->findByAutoId($id);
        $this->view->photos = $photos->toArray(); 
              
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
        $this->view->elapsed_time = $elapsed_time->get_elapsed_time(strtotime($userModel->added));
        //$this->view->reg_time = $elapsed_time->get_reg_time(strtotime($userModel->last_login));
        
        // get full characteristics
        $safety = $carsModel->getAttributesById($id, 'safety');
        $comfort = $carsModel->getAttributesById($id, 'comfort');
        //$other = $carsModel->getAttributesById($id, 'other');
        $multimedia = $carsModel->getAttributesById($id, 'multimedia');
        $state = $carsModel->getAttributesById($id, 'state');
        
        $carsModel1 = new Application_Model_Cars();
        $countAutosByUser = $carsModel1->countByUser($data->user_id);
        $this->view->countAutosByUser = $countAutosByUser[0]['cnt'];

        $this->view->safety = $safety; 
        $this->view->comfort = $comfort;
        //$this->view->other = $other;
        $this->view->multimedia = $multimedia;
        $this->view->state = $state;

    }
    
    public function indexAction(){ 
        $this->view->headScript()->appendFile('/js/init_index.js');
                        
        $form = new Application_Form_IndexSearchUsed();
        $this->view->form = $form;        
    }
    
    
    

}

