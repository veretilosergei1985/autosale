<?php

class SearchController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    
    public function indexAction()
    {
        $this->view->headLink()->appendStylesheet('/css/init_search_index.css'); 
        $this->view->headScript()->appendFile('/js/init_search_index.js');
        $requestData = $this->getRequest()->getParams();
              
        
        $er = new Base_Exchange();
        $usd = $er->getExchangeRateByChar3("USD");
        $eur = $er->getExchangeRateByChar3("EUR");
        
        $usd = $usd->rate/100;
        $eur = $eur->rate/100;
        
        if(!empty($requestData['price_start'])){
            $currency = $requestData['currency'];
            
            if($currency == 'USD'){
               $requestData['price_start'] = $requestData['price_start'] * $usd; 
            } else if($currency == 'EUR'){
               $requestData['price_start'] = $requestData['price_start'] * $eur; 
            }
        }
        
        if(!empty($requestData['price_end'])){
            $currency = $requestData['currency'];
            
            if($currency == 'USD'){
               $requestData['price_end'] = $requestData['price_end'] * $usd; 
            } else if($currency == 'EUR'){
               $requestData['price_end'] = $requestData['price_end'] * $eur; 
            }
        }
        
        $carsModel = new Application_Model_Cars();
        $result =  $carsModel->findByAttrs($requestData);
        
        $photosModelCount = new Application_Model_Photos();
        $data = $photosModelCount->getPhotosCount();
        $photos_count = array();
        foreach($data as $item){
            $photos_count[$item->auto_id] = $item->cnt;
        }
        $this->view->photos_cnt = $photos_count;    
               
                
        $page=$this->_getParam('p',1);
        
        $paginator = Zend_Paginator::factory($result);
        $paginator->setItemCountPerPage(7);
        $paginator->setCurrentPageNumber($page);

        $this->view->paginator = $paginator;    
                
        $er = new Base_Exchange();
        $data = $er->getExchangeRateByChar3("USD");
        $this->view->er = $data->rate/100;
        
        // для левой формы - фильтры (ajax)
        $this->view->category_id = $requestData['category_id'];
        $this->view->query = $requestData;
                
    }
    
    
    

}

