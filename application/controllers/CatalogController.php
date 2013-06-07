<?php

class CatalogController extends Zend_Controller_Action
{

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
           
         
           //$this->view->headScript()->appendFile('/js/init_add_upload.js');

           
           $this->render('addphoto');
           
       }
       
       //// 2 step

    }
    
    


}

