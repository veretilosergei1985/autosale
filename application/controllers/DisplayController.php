<?php

class DisplayController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        
    }
    
    protected function _getPublicPath() {
        return realpath(APPLICATION_PATH . '/../public');
    }

    public function showemailformAction(){
        
        $car_user_id = $this->_getParam('car_user_id');
        $curr_user_id = $this->_getParam('curr_user_id');
        $car_id = $this->_getParam('car_id');
        
        $this->_helper->layout->disableLayout();
        // проверить залогинен ли пользователь
        if(empty($curr_user_id)){
            $this->render('cantshowemailform');
        } else {
        
            $user = new Application_Model_Users();
            $curr_data = $user->find($curr_user_id);
            //echo "<pre>"; print_r($curr_data->username); exit;
            $this->view->curr_data = $curr_data;
            $this->view->owner_id = $car_user_id;
            $this->view->car_id = $car_id;
        }
        
        
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
    
    public function findmodelsbyattrsAction(){
        
       $this->_helper->layout->disableLayout();
       
       if($this->_getParam('mark_id')){
           $mark_id = $this->_getParam('mark_id');
       } else {
           $mark_id = '';
       }
       
       if($this->_getParam('subcat_id')){
           $subcat_id = $this->_getParam('subcat_id');
       } else {
           $subcat_id = '';
       }
       
       $modelModel = new Application_Model_Models(); 
       $result = $modelModel->findByAttrs($mark_id, $subcat_id);

       print_r(json_encode($result->toArray())); exit;

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
    
     public function getbodytypeselectAction(){
         $this->_helper->layout->disableLayout();
         
         $cat_id = $this->_getParam('category_id');
      
         if(empty($cat_id)){
             $cat_id = 1; 
         }
         
         $oSubCat = new Application_Model_Subcats();
         $result = $oSubCat->getByParentId($cat_id);

         print_r(json_encode($result->toArray())); exit;
        
        
    }
    
    public function uploadphotoscarAction(){

        $auto_id = $this->_getParam('auto_id');
        
        $this->_helper->layout->disableLayout();
        // list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $allowedExtensions = array("jpeg", "jpg", "gif", "png");
        // max file size in bytes
        $sizeLimit = 10 * 1024 * 1024;

        $uploader = new Base_qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($this->_getPublicPath().'/images/photos/'.$auto_id.'/', true, $auto_id);
        // to pass data through iframe you will need to encode all html tags
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES); exit;
    }
    
    public function deletephotoAction(){
        $this->_helper->layout->disableLayout();
        $photo_id = $this->_getParam('photo_id');
        $auto_id = $this->_getParam('auto_id');
        
        if(!empty($auto_id) && !empty($photo_id)){
            $oPhoto = new Application_Model_Photos();
            $result = $oPhoto->deletePhoto($photo_id);
            
                if($result){
                    $image = array();
                    $image = explode('.', $result);
                    
                    unlink($this->_getPublicPath().'/images/photos/'.$auto_id.'/'.$result);
                    unlink($this->_getPublicPath().'/images/photos/'.$auto_id.'/'.$image[0].'_thumb.'.$image[1]);
                    echo '1'; exit;
                } else {
                    echo '0'; exit;
                }
        } else {
            echo '1'; exit;
        }
        
    }
    
    public function deletevideoAction(){
        $this->_helper->layout->disableLayout();
        $video_id = $this->_getParam('video_id');
        $auto_id = $this->_getParam('auto_id');
        
        if(!empty($auto_id) && !empty($video_id)){
            $oPhoto = new Application_Model_Photos();
            $result = $oPhoto->deletePhoto($video_id);
            
                if($result){
                    $image = array();
                    $image = explode('.', $result);
                    
                    unlink($this->_getPublicPath().'/images/photos/'.$auto_id.'/'.$result);
                    
                    echo '1'; exit;
                } else {
                    echo '0'; exit;
                }
        } else {
            echo '1'; exit;
        }
        
    }
    
    public function deletemainphotoAction(){
        
        $this->_helper->layout->disableLayout();
        
        $old_photo = $this->_getParam('old_photo');
        $new_photo= $this->_getParam('new_photo');
        $auto_id= $this->_getParam('auto_id');
        
        if(!empty($new_photo)){
            $oPhoto = new Application_Model_Photos();
            $oPhoto->find($new_photo);
            $oPhoto->setIsMain(1);
            $main_id = $oPhoto->save();
        }
                        
        $oPhotoOld = new Application_Model_Photos();
        $result = $oPhotoOld->deletePhoto($old_photo);
        
        if($result){
            $image = array();
            $image = explode('.', $result);

            unlink($this->_getPublicPath().'/images/photos/'.$auto_id.'/'.$result);
            unlink($this->_getPublicPath().'/images/photos/'.$auto_id.'/'.$image[0].'_thumb.'.$image[1]);
            
            if(!empty($new_photo)){
                echo json_encode(array('result' => 'ok', 'path' => '/images/photos/'.$auto_id.'/'.$oPhoto->image, 'main_photo' => $main_id, 'old_main_photo' => $old_photo)); exit;
            } else {
                echo json_encode(array('result' => 'ok')); exit;
            }
          
        } else {
            echo json_encode(array('result' => 'error')); exit;
        }
                
    }
    
    public function changemainphotoAction(){
        
        $this->_helper->layout->disableLayout();
        
        $old_photo = $this->_getParam('old_photo');
        $new_photo= $this->_getParam('new_photo');
        $auto_id= $this->_getParam('auto_id');
        
        if(!empty($new_photo) && !empty($old_photo)){
            $oPhotoNew = new Application_Model_Photos();
            $oPhotoNew->find($new_photo);
            $oPhotoNew->setIsMain(1);
            $new_main_id = $oPhotoNew->save();
            
            $oPhotoOld = new Application_Model_Photos();
            $oPhotoOld->find($old_photo);
            $oPhotoOld->setIsMain(0);
            $old_main_id = $oPhotoOld->save();
            
            echo json_encode(array('result' => 'ok', 'new_path' => '/images/photos/'.$auto_id.'/'.$oPhotoNew->image, 'new_main_photo' => $new_main_id, 'old_path' => '/images/photos/'.$auto_id.'/'.$oPhotoOld->image,'old_main_id' => $old_main_id)); exit;
            
        }
        
        
    }
    
    public function showuploadvideopopupAction(){
        $this->_helper->layout->disableLayout();
   }
    
   public function downloadfromyoutubeAction(){
        $this->_helper->layout->disableLayout();
       
        $url = $this->_getParam('url');
        $auto_id = $this->_getParam('auto_id');
        $url_id = explode('=', $url);
       
        $oPhoto = new Application_Model_Photos();
        $result = $oPhoto->isVideoExist($auto_id);
        
        if(!$result){

            $feedURL = 'http://gdata.youtube.com/feeds/api/videos/' . $url_id['1'];
            // read feed into SimpleXML object
            $entry = simplexml_load_file($feedURL);
            $video = Base_VideoHelper::parseVideoEntry($entry);

            if($video->thumbnailURL){

                if (!file_exists($this->_getPublicPath().'/images/photos/'.$auto_id)) {
                    mkdir($this->_getPublicPath().'/images/photos/'.$auto_id);
                    // chmod($autoId, '0755');
                }

                $filename = Base_Gen::mkSecret(6);
                $file_path = $this->_getPublicPath().'/images/photos/'.$auto_id.'/'.$filename.'.jpg';
                
                $content = file_get_contents($video->thumbnailURL);
                $fp = fopen($file_path, 'w');
                fwrite($fp, $content);
                fclose($fp);

                // resize
                 Base_ImageHelper::resize_image1($file_path, 120, 90);
                
                // save in db
                $oNewPhoto = new Application_Model_Photos();
                $oNewPhoto->setAutoId($auto_id);
                $oNewPhoto->setImage($filename . '.jpg');
                $oNewPhoto->setIsMain(0);
                $oNewPhoto->setVideoUrl($video->watchURL);
            
                $photo_id = $oNewPhoto->save();
                $video_url =$video->watchURL; 
                // display
                echo json_encode(array('result' => 'ok', 'id' =>$photo_id, 'path' => '/images/photos/'.$auto_id.'/'.$filename.'.jpg', 'video_url' => $video_url)); exit;
                
            } else {
            echo json_encode(array('result' => 'error', 'reason' => 'no_found', 'message' => '<strong id="errortitle__addcars">Возникла ошибка</strong><br><span id="errortext__addcars">Введен неверный youtube адрес</span>')); exit;
        }   
        
        } else {
            echo json_encode(array('result' => 'error', 'reason' => 'video_exist', 'message' => '<strong id="errortitle__addcars">Возникла ошибка</strong><br><span id="errortext__addcars">Нельзя добавлять более одного видео</span>')); exit;
            
        }   
        exit;
   }
   
    public function cancommentautoAction(){
        $this->_helper->layout->disableLayout();
        
        // check is logged
        //if is logged
        if(Zend_Auth::getInstance()->hasIdentity()){
            echo json_encode(array('result' => 'ok')); exit;
        } else {
            echo json_encode(array('result' => 'error')); exit;
        }
        
    }
   
   public function showautocommentformAction(){
        $this->_helper->layout->disableLayout();
   }
   
   public function getmarksbycatselectAction(){
       
       $this->_helper->layout->disableLayout();
       $cat_id = $this->_getParam('cat_id');
       
       $oCategoriesMarks = new Application_Model_CategoriesMarksMapper();
       $result = $oCategoriesMarks->getMarksByCat($cat_id);
       
       print_r(json_encode($result)); exit;
   }
   
   public function findmarksbysubcatAction(){
       
       $this->_helper->layout->disableLayout();
       $subcat_id = $this->_getParam('subcat_id');
       
       $oCategoriesMarks = new Application_Model_CategoriesMarksMapper();
       $result = $oCategoriesMarks->getMarksBySubCat($subcat_id);
       
       print_r(json_encode($result)); exit;
   }
   
   public function showregionspopupAction(){
        $this->_helper->layout->disableLayout();
        
        $regionsModel = new Application_Model_Regions();
        $regions = $regionsModel->fetchAll();
        
        $citiesModel = new Application_Model_Cities();
        $cities = $citiesModel->findByRegId($regions[0]->id);
   
        $this->view->regions = $regions;
        $this->view->cities = $cities;
   }
   
   public function findcitiesbyregAction(){
        $this->_helper->layout->disableLayout();
        $reg_id = $this->_getParam('reg_id');       
        
        $citiesModel = new Application_Model_Cities();
        $cities = $citiesModel->findByRegId($reg_id);
 
        print_r(json_encode($cities->toArray())); exit;
   }


}

