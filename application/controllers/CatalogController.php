<?php

class CatalogController extends Zend_Controller_Action
{

    protected function _getPublicPath() {
        return realpath(APPLICATION_PATH . '/../public');
    }
    
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {

        $this->view->text = 'Вася';

        
    }
    
    public function addAction()
    {
       $this->view->headLink()->appendStylesheet('/css/init_add.css');  
       $this->_helper->layout->setLayout('layout1');
       $this->view->headLink()->appendStylesheet('/css/init_add.css');
       
              
       $step = $this->_getParam('step');
       $autoId = $this->_getParam('autoId');
       $oldSystem = $this->_getParam('oldSystem');
       
       if(!$step){
           // redirect
       }
      
       if($step == 'autoinfo'){

            $this->view->headScript()->appendFile('/js/init_add.js');
            $form = new Application_Form_AddCar();
            
            if($autoId == ''){
                if ($this->getRequest()->isPost()) {
                    if ($form->isValid($this->getRequest()->getPost())) {
                        
                                if(!Zend_Auth::getInstance()->hasIdentity()){ 
                                     $this->_helper->redirector('add', 'catalog', 'default', array('step' => 'addphoto'));
                                 }
                                 
                                 $data = $form->getValues();
                                 //echo "<pre>"; print_r($data); exit;
                                 $car = new Application_Model_Cars();

                                 $car->setUserId(Zend_Auth::getInstance()->getIdentity()->id);
                                 $car->setCatId($data['cat_id']);
                                 $car->setBodyId($data['body_id']);
                                 $car->setRegId($data['reg_id']);
                                 $car->setModelId($data['model_id']);
                                 $car->setMarkId($data['mark_id']);
                                 //$car->setCityId($data['']);
                                 $car->setTransmissionId($data['transmission_id']);
                                 $car->setDriveId($data['drive_id']);
                                 $car->setDoors($data['doors']);
                                 $car->setFuelId($data['fuel_id']);
                                 $car->setFuelCity($data['fuel_city']);
                                 $car->setFuelRoute($data['fuel_route']);
                                 $car->setFuelCombine($data['fuel_combine']);
                                 $car->setColorId($data['color_id']);
                                 $car->setMetallic($data['metallic']);
                                 $car->setYear($data['year']);
                                 $car->setMileage($data['mileage']);
                                 $car->setVolume($data['volume']);                              
                                 $car->setPrice($data['price']);
                                 $car->setCurrency($data['currency']);
                                 $car->setVersion($data['version']);
                                 $car->setVin($data['vin']);
                                 $car->setExchange($data['exchange']);
                                 $car->setAuction($data['auction']);
                                 $car->setStatus('waiting');
                                 $car->setAdded(date('Y-m-d H:i:s'));
                                 $car->setPriority($data['priority']);
                                 
                                 $car->setTitle('Title');
                                 $car->setDescription('Description');
            
                                 $ins_id = $car->save();		
                                 $this->_helper->redirector('add', 'catalog', 'default', array('autoId' => $ins_id, 'step' => 'addphoto'));
                    }
                    //echo "<pre>"; print_r($form->getErrors()); exit;
                }
           
            } else if($autoId != ''){
                        
                                
                // fill form
                $carsModel = new Application_Model_Cars();
                $data = $carsModel->find($autoId);

                // check owner
                if(count($data) < 1 || ($data->user_id != Zend_Auth::getInstance()->getIdentity()->id)){
                    $this->_helper->redirector('add', 'catalog', 'default', array('step' => 'autoinfo'));
                }
                $this->view->auto_id = $autoId;
                $this->view->is_new = false;
                                                
                $data = $data->toArray();
                unset($data['color']);
                $form->populate($data);
                
                                
                if ($this->getRequest()->isPost()) {
                    if ($form->isValid($this->getRequest()->getPost())) {

                            $data = $form->getValues();
                            //echo "<pre>"; print_r($data); exit;
                            $car = new Application_Model_Cars();

                            $car->setId($autoId);
                            $car->setUserId(Zend_Auth::getInstance()->getIdentity()->id);
                            $car->setCatId($data['cat_id']);
                            $car->setBodyId($data['body_id']);
                            $car->setRegId($data['reg_id']);
                            $car->setModelId($data['model_id']);
                            $car->setMarkId($data['mark_id']);
                            //$car->setCityId($data['']);
                            $car->setTransmissionId($data['transmission_id']);
                            $car->setDriveId($data['drive_id']);
                            $car->setDoors($data['doors']);
                            $car->setFuelId($data['fuel_id']);
                            $car->setFuelCity($data['fuel_city']);
                            $car->setFuelRoute($data['fuel_route']);
                            $car->setFuelCombine($data['fuel_combine']);
                            $car->setColorId($data['color_id']);
                            $car->setMetallic($data['metallic']);
                            $car->setYear($data['year']);
                            $car->setMileage($data['mileage']);
                            $car->setVolume($data['volume']);                              
                            $car->setPrice($data['price']);
                            $car->setCurrency($data['currency']);
                            $car->setVersion($data['version']);
                            $car->setVin($data['vin']);
                            $car->setExchange($data['exchange']);
                            $car->setAuction($data['auction']);
                            $car->setStatus('waiting');
                            $car->setAdded(date('Y-m-d H:i:s'));
                            $car->setPriority($data['priority']);

                            $car->setTitle('Title');
                            $car->setDescription('Description');

                            $ins_id = $car->save();		
                            $this->_helper->redirector('add', 'catalog', 'default', array('autoId' => $ins_id, 'step' => 'addphoto'));
                    }
 
                }
                
            }
            
            
            $this->view->form = $form;
       }
       
       if($autoId != '' && $step == 'addphoto'){
           
           // check owner
           $carsModel = new Application_Model_Cars();
           $data = $carsModel->find($autoId);

           if(count($data) < 1 || ($data->user_id != Zend_Auth::getInstance()->getIdentity()->id)){
               $this->_helper->redirector('add', 'catalog', 'default', array('step' => 'autoinfo'));
           }
           $this->view->is_new = false;
        
           $this->view->headScript()->appendFile('/js/jquery.limit.js');
           $this->view->headScript()->appendFile('/js/init_add_upload.js');
           
           $formData = $this->getRequest()->getPost();
           
           $optionsForm = new Application_Form_AddCarOptions();
           
           
           /// populate options form
           $car = new Application_Model_Cars();
           $car_data = $car->find($autoId);
           $optionsForm->populate($car_data->toArray());
           
           $oSafety = new Application_Model_CarSafety();
           $safety_data = $oSafety->findByAutoId($autoId);
           $safety_data= $safety_data->toArray();
           $arr = Array();
           if(count($safety_data) > 0){
                foreach($safety_data as $item){
                    array_push($arr, $item['safety_id']);
                }
                $optionsForm->populate(array('safety' => $arr));
           }
            
           $oComfort = new Application_Model_CarComfort();
           $comfort_data = $oComfort->findByAutoId($autoId);
           $comfort_data= $comfort_data->toArray();
           $arr = Array();
           if(count($comfort_data) > 0){
                foreach($comfort_data as $item){
                    array_push($arr, $item['comfort_id']);
                }
                $optionsForm->populate(array('comfort' => $arr));
           }
            
           $oMultimedia = new Application_Model_CarMultimedia();
           $multimedia_data = $oMultimedia->findByAutoId($autoId);
           $multimedia_data= $multimedia_data->toArray();
           $arr = Array();
           if(count($multimedia_data) > 0){
                foreach($multimedia_data as $item){
                    array_push($arr, $item['multimedia_id']);
                }
                $optionsForm->populate(array('multimedia' => $arr));
           }
           
           $oOther = new Application_Model_CarOther();
           $other_data = $oOther->findByAutoId($autoId);
           $other_data= $other_data->toArray();
           $arr = Array();
           if(count($other_data) > 0){
                foreach($other_data as $item){
                    array_push($arr, $item['other_id']);
                }
                $optionsForm->populate(array('other' => $arr));
           }
           
           $oState = new Application_Model_CarState();
           $state_data = $oState->findByAutoId($autoId);
           $state_data= $state_data->toArray();
           $arr = Array();
           if(count($state_data) > 0){
                foreach($state_data as $item){
                    array_push($arr, $item['state_id']);
                }
                $optionsForm->populate(array('state' => $arr));
           }
           /// end populate options form
           
           if(!empty($oldSystem) && $oldSystem == 1){
              
               $form = new Application_Form_AddCarPhoto();
                              
                if ($this->getRequest()->isPost()) {
                    if(isset($formData['options_submit']) && $optionsForm->isValid($this->getRequest()->getPost())){
                        
                        // delete previous data
                        Base_ModelsHelper::deleteAutoOptions($autoId); 
                        
                        $carsModel = new Application_Model_Cars();
                        $carsModel->findById($autoId);
                        $carsModel->setId($autoId);
                        $carsModel->setEnableComment(0);
                        $carsModel->setSendComments(0);
                        $carsModel->save();
                        
                        if(count($formData['safety']) > 0){
                            foreach($formData['safety'] as $k => $v){
                                $oSafety = new Application_Model_CarSafety();
                                $oSafety->setCarId($autoId);
                                $oSafety->setSafetyId($v);
                                $oSafety->save();                            
                            }
                        }

                        if(count($formData['comfort']) > 0){
                            foreach($formData['comfort'] as $k => $v){
                                $oComfort = new Application_Model_CarComfort();
                                $oComfort->setCarId($autoId);
                                $oComfort->setComfortId($v);
                                $oComfort->save();                            
                            }
                        }

                        if(count($formData['multimedia']) > 0){
                            foreach($formData['multimedia'] as $k => $v){
                                $oMultimedia = new Application_Model_CarMultimedia();
                                $oMultimedia->setCarId($autoId);
                                $oMultimedia->setMultimediaId($v);
                                $oMultimedia->save();                            
                            }
                        }

                        if(count($formData['other']) > 0){
                            foreach($formData['other'] as $k => $v){
                                $oOther = new Application_Model_CarOther();
                                $oOther->setCarId($autoId);
                                $oOther->setOtherId($v);
                                $oOther->save();                            
                            }
                        }

                        if(count($formData['state']) > 0){
                            foreach($formData['state'] as $k => $v){
                                $oState = new Application_Model_CarState();
                                $oState->setCarId($autoId);
                                $oState->setStateId($v);
                                $oState->save();                            
                            }
                        }

                        if(isset($formData['description']) || isset($formData['enable_comment']) || isset($formData['send_comments'])){
                            $car = new Application_Model_Cars();
                            $car->findById($autoId);

                            if(isset($formData['description'])){
                                $car->setDescription($formData['description']);
                            }

                            if(isset($formData['enable_comment'])){
                                $car->setEnableComment($formData['enable_comment']);
                            }

                            if(isset($formData['send_comments'])){
                                $car->setSendComments($formData['send_comments']);
                            }
                            $car->save();                        
                        }
                        
                        $this->_helper->redirector('add', 'catalog', 'default', array('autoId' => $autoId, 'step' => 'publication'));
                        
                    }
                    
                    
                    if (isset($formData['photo_submit']) && $form->isValid($this->getRequest()->getPost())) {
                        
                        if (!file_exists($this->_getPublicPath().'/images/photos/'.$autoId)) {
                            mkdir($this->_getPublicPath().'/images/photos/'.$autoId);
                            // chmod($autoId, '0755');
                        }
                        
                        $uploadHandler = new Zend_File_Transfer_Adapter_Http();
                        $uploadHandler->setDestination($this->_getPublicPath().'/images/photos/'.$autoId );
                        try {
                            $uploadHandler->receive();

                            $data = $form->getValues();
                            Zend_Debug::dump($data, 'Form Data:');

                            $fullPath = $uploadHandler->getFileName( 'photo' );
                            $fileInfo = pathinfo( $fullPath );
                            
                            $hash = Base_Gen::mkSecret(6); 
                                                        
                            $newName = $hash.'.'. $fileInfo['extension'];
                            $newNameThumb = $hash.'_thumb.'. $fileInfo['extension'];
                            
                            $fullFilePath = $this->_getPublicPath().'/images/photos/'.$autoId.'/'.$newName;
                            $fullFilePathThumb = $this->_getPublicPath().'/images/photos/'.$autoId.'/'.$newNameThumb;

                            $filterFileRename = new Zend_Filter_File_Rename(
                                array('target' => $fullFilePath, 'overwrite' => true)
                            );
                            $filterFileRename -> filter($fullPath);
                                                                                  
                            Base_ImageHelper::resize_image1($fullFilePath);
                            Base_ImageHelper::create_thumbnail($fullFilePath, $fullFilePathThumb, $targ_w = 85, $targ_h = 56);
                            
                            // save in table
                            $photo = new Application_Model_Photos();

                            $photo->setAutoId($autoId);
                            $photo->setImage($newName);
                                                        
                            $is_exist = $photo->mainExist($autoId);

                            if($is_exist == false){
                               $photo->setIsMain(1);
                            } else {
                               $photo->setIsMain(0);
                            }
                           
                            $photo_id = $photo->save();
                            
                            $this->_helper->redirector('add', 'catalog', 'default', array('step' => 'addphoto', 'autoId' => $autoId, 'oldSystem' => '1'));

                        } catch ( Zend_File_Transfer_Exception $e ) {
                            echo $e->getMessage();
                        }
                        
                    }

                }
              // echo "<pre>"; print_r($photos_list); exit;
               $this->view->autoId = $autoId;
               $this->view->form = $form;
               $this->view->oldSystem = true;
               $this->view->list = $photos_list;
               
           } else {
               
               
               $this->view->headLink()->appendStylesheet('/css/fileuploader.css'); 
               $this->view->headScript()->appendFile('/js/fileuploader.js');
               $this->view->headScript()->appendFile('/js/init_uploader.js');
               
               if(isset($formData['options_submit']) && $optionsForm->isValid($this->getRequest()->getPost())){

                    // delete previous data
                    Base_ModelsHelper::deleteAutoOptions($autoId); 
                    
                    $carsModel = new Application_Model_Cars();
                    $carsModel->findById($autoId);
                    $carsModel->setId($autoId);
                    $carsModel->setEnableComment(0);
                    $carsModel->setSendComments(0);
                    $carsModel->save();
                   
                    if(count($formData['safety']) > 0){
                        foreach($formData['safety'] as $k => $v){
                            $oSafety = new Application_Model_CarSafety();
                            $oSafety->setCarId($autoId);
                            $oSafety->setSafetyId($v);
                            $oSafety->save();                            
                        }
                    }
                    
                    if(count($formData['comfort']) > 0){
                        foreach($formData['comfort'] as $k => $v){
                            $oComfort = new Application_Model_CarComfort();
                            $oComfort->setCarId($autoId);
                            $oComfort->setComfortId($v);
                            $oComfort->save();                            
                        }
                    }
                    
                    if(count($formData['multimedia']) > 0){
                        foreach($formData['multimedia'] as $k => $v){
                            $oMultimedia = new Application_Model_CarMultimedia();
                            $oMultimedia->setCarId($autoId);
                            $oMultimedia->setMultimediaId($v);
                            $oMultimedia->save();                            
                        }
                    }
                    
                    if(count($formData['other']) > 0){
                        foreach($formData['other'] as $k => $v){
                            $oOther = new Application_Model_CarOther();
                            $oOther->setCarId($autoId);
                            $oOther->setOtherId($v);
                            $oOther->save();                            
                        }
                    }
                    
                    if(count($formData['state']) > 0){
                        foreach($formData['state'] as $k => $v){
                            $oState = new Application_Model_CarState();
                            $oState->setCarId($autoId);
                            $oState->setStateId($v);
                            $oState->save();                            
                        }
                    }
                    
                    if(isset($formData['description']) || isset($formData['enable_comment']) || isset($formData['send_comments'])){
                        $car = new Application_Model_Cars();
                        $car->findById($autoId);
                        
                        if(isset($formData['description'])){
                            $car->setDescription($formData['description']);
                        }
                        
                        if(isset($formData['enable_comment'])){
                            $car->setEnableComment($formData['enable_comment']);
                        }
                        
                        if(isset($formData['send_comments'])){
                            $car->setSendComments($formData['send_comments']);
                        }
                        $car->save();                        
                    }
                    
                    $this->_helper->redirector('add', 'catalog', 'default', array('autoId' => $autoId, 'step' => 'publication'));
                }
                           
               $this->view->oldSystem = false;
               
           }
                    
            $oPhotos = new Application_Model_Photos();
            $photos_list = $oPhotos->findByAutoId($autoId);
            $this->view->list = $photos_list;
            $this->view->optionsForm = $optionsForm;
                       
            $this->view->autoId = $autoId;
            $this->render('addphoto');
           
       }
       
       if($autoId != '' && $step == 'publication'){
           
           // check owner
           $carsModel_tmp = new Application_Model_Cars();
           $data_tmp = $carsModel_tmp->find($autoId);

           if(count($data_tmp) < 1 || ($data_tmp->user_id != Zend_Auth::getInstance()->getIdentity()->id)){
               $this->_helper->redirector('add', 'catalog', 'default', array('step' => 'autoinfo'));
           }
           $this->view->is_new = false;
           
           $this->view->headScript()->appendFile('/js/init_publication.js');
           
                      
           $carsModel = new Application_Model_Cars();
                    
           $data = $carsModel->find($autoId);
           //echo "<pre>"; print_r($data); exit;
           $this->view->data = $data;
           
           $photosModel = new Application_Model_Photos();
           $photos = $photosModel->findByAutoId($autoId);
           $main_photo = array();
           
           $pricesModel = new Application_Model_Prices();
           $prices = array();
           foreach($pricesModel->fetchAll() as $item){
               $prices[$item->name] = $item->value;
           }
           //echo "<pre>"; print_r($prices); exit();
           
           foreach($photos as $photo){
               if($photo['is_main'] == 1){
                   $main_photo = $photo['image'];
                   break;
               }
           }
           
           $form = new Application_Form_AddCarPublication($prices['simple']);
           
           if ($this->getRequest()->isPost()) {
                if($form->isValid($this->getRequest()->getPost())){
                    // save data from payment form
                    //
                                       
                    $this->_helper->redirector('add', 'catalog', 'default', array('step' => 'published', 'autoId' => $autoId));
                }
           
           }     

           $this->view->main_photo = $main_photo;
           $this->view->auto_id = $autoId;
           $this->view->form = $form;
           $this->view->prices = $prices;
           
           $this->render('publication');
       }
       
       if($autoId != '' && $step == 'published'){
            // check owner
           $carsModel_tmp = new Application_Model_Cars();
           $data_tmp = $carsModel_tmp->find($autoId);

           if(count($data_tmp) < 1 || ($data_tmp->user_id != Zend_Auth::getInstance()->getIdentity()->id)){
               $this->_helper->redirector('add', 'catalog', 'default', array('step' => 'autoinfo'));
           }
           $this->view->is_new = false;
           
           $carsModel = new Application_Model_Cars();
                    
           $data = $carsModel->find($autoId);
           $this->view->data = $data;
           
           $photosModel = new Application_Model_Photos();
           $photos = $photosModel->findByAutoId($autoId);
           $main_photo = '';
           
           $pricesModel = new Application_Model_Prices();
           $prices = array();
           foreach($pricesModel->fetchAll() as $item){
               $prices[$item->name] = $item->value;
           }

           
           foreach($photos as $photo){
               if($photo['is_main'] == 1){
                   $main_photo = $photo['image'];
                   break;
               }
           }
           
           $this->view->main_photo = $main_photo;
           $this->view->auto_id = $autoId;
           $this->view->prices = $prices;
           
           $this->render('published');
       }
       

    }
    
    public function viewmyAction(){
        
        
    }


}

