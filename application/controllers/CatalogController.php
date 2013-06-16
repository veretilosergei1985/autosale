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


                                 $data = $form->getValues();
                                 //echo "<pre>"; print_r($data); exit;
                                 $car = new Application_Model_Cars();

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
                                 $car->setMileage($data['race']);
                                 $car->setVolume($data['volume']);                              
                                 $car->setPrice($data['price']);
                                 $car->setCurrency($data['currency']);
                                 $car->setVersion($data['version']);
                                 $car->setVin($data['vin']);
                                 $car->setExchange($data['exchange']);
                                 $car->setAuction($data['auction']);
                                 $car->setStatus('waiting');
                                 $car->setAdded(date('Y-m-d H:i:s'));
                                 
                                 $car->setTitle('Title');
                                 $car->setDescription('Description');
            
                                 $ins_id = $car->save();		
                                 $this->_helper->redirector('add', 'catalog', 'default', array('autoId' => $ins_id, 'step' => 'addphoto'));
                    }
                    //echo "<pre>"; print_r($form->getErrors()); exit;
                }
           
            } else if($autoId != ''){
                
                
            }
            
            
            $this->view->form = $form;
       }
       
       if($autoId != '' && $step == 'addphoto'){
           
           $this->view->headScript()->appendFile('/js/jquery.limit.js');
           $this->view->headScript()->appendFile('/js/init_add_upload.js');
           
           $formData = $this->getRequest()->getPost();
           
           $optionsForm = new Application_Form_AddCarOptions();
           
           if(!empty($oldSystem) && $oldSystem == 1){
              
               $form = new Application_Form_AddCarPhoto();
                              
                if ($this->getRequest()->isPost()) {
                    if(isset($formData['options_submit']) && $optionsForm->isValid($this->getRequest()->getPost())){
                        
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

                        if(isset($formData['description']) || isset($formData['dont_comment']) || isset($formData['send_comments'])){
                            $car = new Application_Model_Cars();
                            $car->findById($autoId);

                            if(isset($formData['description'])){
                                $car->setDescription($formData['description']);
                            }

                            if(isset($formData['dont_comment'])){
                                $car->setEnableComment($formData['dont_comment']);
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
                    
                    if(isset($formData['description']) || isset($formData['dont_comment']) || isset($formData['send_comments'])){
                        $car = new Application_Model_Cars();
                        $car->findById($autoId);
                        
                        if(isset($formData['description'])){
                            $car->setDescription($formData['description']);
                        }
                        
                        if(isset($formData['dont_comment'])){
                            $car->setEnableComment($formData['dont_comment']);
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

           $this->view->main_photo = $main_photo;
           $this->view->auto_id = $autoId;
           $this->view->form = $form;
           $this->view->prices = $prices;
           
           $this->render('publication');
       }

    }
    
    


}

