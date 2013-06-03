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
    
    public function checkaddcarAction(){
        $this->_helper->layout->disableLayout();
        
        // check is logged
        //if is logged
        if(Zend_Auth::getInstance()->hasIdentity()){
            $is_logged = true;
            $this->view->is_logged = $is_logged;
        } else {
        //else
        
            $reg_form = new Application_Form_CarRegister();
            $log_form = new Application_Form_CarLogin();

            $this->view->reg_form = $reg_form;
            $this->view->log_form = $log_form;

            $is_logged = false;
            $this->view->is_logged = $is_logged;
        }
        
    }
    
    public function getregionsAction(){
        
        $regModel = new Application_Model_Regions();
        $regions = $regModel->fetchAll();
                
        $result = array();
        $i =0 ;
        foreach($regions as $region){
            $result[$i]['id'] = $region->id;
            $result[$i]['name'] = $region->name;
            $i++;
        }
        
        echo json_encode($result); exit;
//        echo "<pre>";
//        print_r($regions); exit;
    }
    
    public function getcityAction(){
        session_start();
        $reg_id = $this->_getParam('region_id');
        
        $cityModel = new Application_Model_Cities(); 
        $cities = $cityModel->findByRegId($reg_id);
             
//        echo "<pre>";
//        print_r($cities); exit;
        
        $result = '';
        foreach($cities as $city){
            
            if(!empty($_SESSION['city'])){
                if($_SESSION['city'] == $city['id']){
                    $result.='<option selected="selected" value="'. $city['id'] .'">' . $city['name'] . '</option>';
                } else {
                    $result.='<option value="'. $city['id'] .'">' . $city['name'] . '</option>';
                }
             
            } else {
                $result.='<option value="'. $city['id'] .'">' . $city['name'] . '</option>';
            }
           
        }
        
        unset($_SESSION['city']);
        echo $result; exit;
//        echo "<pre>";
//        print_r($regions); exit;
    }
    
     public function getmodelAction(){
        //session_start();
        $mark_id = $this->_getParam('mark_id');
        
        $modelModel = new Application_Model_Models(); 
        $models = $modelModel->findByMarkId($mark_id);
        
        $result = '';
        foreach($models as $model){
         
            $result.='<option value="'. $model['id'] .'">' . $model['name'] . '</option>';
        /*    
            if(!empty($_SESSION['city'])){
                if($_SESSION['city'] == $city['id']){
                    $result.='<option selected="selected" value="'. $city['id'] .'">' . $city['name'] . '</option>';
                } else {
                    $result.='<option value="'. $city['id'] .'">' . $city['name'] . '</option>';
                }
             
            } else {
                $result.='<option value="'. $city['id'] .'">' . $city['name'] . '</option>';
            }
           
        }
        */
            
        }
        //unset($_SESSION['city']);
        echo $result; exit;

    }
    
    public function bodytypeAction(){
         $this->_helper->layout->disableLayout();
         
         $cat_id = $this->_getParam('category_id');
      
         if(!isset($cat_id)){
             $cat_id = 1; 
         }
         
         $oSubCat = new Application_Model_Subcats();
         $result = $oSubCat->getByParentId($cat_id);
//         echo "<pre>";
//         print_r($result); exit;
         $this->view->items = $result;
        
        
    }


}

