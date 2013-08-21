<?php

class SearchController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    
    public function indexAction()
    {
        $this->view->headLink()->appendStylesheet('/css/init_search_new.css');
        $this->view->headLink()->appendStylesheet('/css/init_search_index.css'); 
        $this->view->headScript()->appendFile('/js/init_search_index.js');
        $requestData = $this->getRequest()->getParams();
        $requestDataForForm = $requestData;
        //echo "<pre>"; print_r($requestDataForForm); exit;      
        
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
        
        //find current user car ids (if logged)
        if(Zend_Auth::getInstance()->hasIdentity()){
            $ids = array();
            $carsModel1 = new Application_Model_Cars();
            $res =  $carsModel1->getIdsByUser(Zend_Auth::getInstance()->getIdentity()->id);
            
            foreach($res->toArray() as $item){
                array_push($ids, $item['id']);
            }
        } 
        $this->view->ids = $ids;  
        
        $photosModelCount = new Application_Model_Photos();
        $data = $photosModelCount->getPhotosCount();
        $photos_count = array();
        foreach($data as $item){
            $photos_count[$item->auto_id] = $item->cnt;
        }
        $this->view->photos_cnt = $photos_count;    
               
                
        $page=$this->_getParam('p',1);
        
        $paginator = Zend_Paginator::factory($result);
        
        if(!empty($requestDataForForm['count_per_page'])){
            $paginator->setItemCountPerPage($requestDataForForm['count_per_page']);
        } else {
             $paginator->setItemCountPerPage(5);
        }
        
        $paginator->setCurrentPageNumber($page);

        $this->view->paginator = $paginator;    
                
        $er = new Base_Exchange();
        $data = $er->getExchangeRateByChar3("USD");
        $this->view->er = $data->rate/100;
        
        // для левой формы - фильтры (ajax)
        $this->view->category_id = $requestData['category_id'];
        $this->view->query = $requestDataForForm;
        $this->view->queryString = $_SERVER['QUERY_STRING'];
        
        $this->view->count_result = count($result);
        
        if($requestDataForForm['block_view'] == 1){
            $this->render('block_index');
        }
                
    }
    
    public function ajaxAction(){
        //$this->view->headLink()->appendStylesheet('/css/init_search_new.css');
        $this->_helper->layout->disableLayout();
        
        $requestData = $this->getRequest()->getParams();
        $requestDataForForm = $requestData;
      //echo "<pre>"; print_r($requestData); exit;
        
        
//        $query = $this->_getParam('query_str');
//        $mark_id = $this->_getParam('mark_id');
//        $subcat_id = $this->_getParam('subcat_id');
//        $model_id = $this->_getParam('model_id');
        
//        $requestData = Base_UrlHelper::queryToArray($query);

/*
        if($requestData != false){
            
            if(!empty($mark_id)){
               $requestData['mark'] = $mark_id; 
            }
            
            if(!empty($subcat_id)){
               $requestData['bodystyle'] = $subcat_id; 
            }
            
            if(!empty($model_id)){
               $requestData['model'] = $model_id; 
            }
            
            
            
        }
*/
        
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
//echo "<pre>"; print_r($result); exit;        
        $photosModelCount = new Application_Model_Photos();
        $data = $photosModelCount->getPhotosCount();
        $photos_count = array();
        foreach($data as $item){
            $photos_count[$item->auto_id] = $item->cnt;
        }
        $this->view->photos_cnt = $photos_count;    
               
                
        //$page=$this->_getParam('p',1);
        
        $paginator = Zend_Paginator::factory($result);
        
        if(!empty($requestDataForForm['count_per_page'])){
            $paginator->setItemCountPerPage($requestDataForForm['count_per_page']);
        } else {
             $paginator->setItemCountPerPage(5);
        }
        
        $paginator->setCurrentPageNumber('1');

        $this->view->paginator = $paginator;    
                
        $er = new Base_Exchange();
        $data = $er->getExchangeRateByChar3("USD");
        $this->view->er = $data->rate/100;
        
        // для левой формы - фильтры (ajax)
        $this->view->category_id = $requestData['category_id'];
        $this->view->query = $requestDataForForm;
        $this->view->queryString = http_build_query($requestDataForForm);
        //echo "<pre>"; print_r($this->view->queryString); exit; 
        $this->view->count_result = count($result);   
        
        if($requestDataForForm['block_view'] == 1){
            $this->render('block_ajax');
        }
    }
    
    
    

}

