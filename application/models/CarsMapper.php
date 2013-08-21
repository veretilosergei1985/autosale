<?php


class Application_Model_CarsMapper
{
    protected $_dbTable;
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Неприавльные данные');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Cars');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Cars $car)
    { 
        $data = array(
            'id' => $car->getId(),
            'user_id' =>$car->getUserId(),
            'cat_id' => $car->getCatId(), 
            'body_id' => $car->getBodyId(), 
            'reg_id' => $car->getRegId(),
            'city_id' => $car->getCityId(),
            'model_id' => $car->getModelId(),
            'mark_id' => $car->getMarkId(),
            'transmission_id' => $car->getTransmissionId(), 
            'drive_id' => $car->getDriveId(),
            'doors' => $car->getDoors(),
            'fuel_id' => $car->getFuelId(),
            'fuel_city' => $car->getFuelCity(),
            'fuel_route' => $car->getFuelRoute(),
            'fuel_combine' => $car->getFuelCombine(),
            'color_id' => $car->getColorId(),
            'metallic' => $car->getMetallic(),
            'year' => $car->getYear(),
            'mileage' => $car->getMileage(),
            'volume' => $car->getVolume(),                           
            'price'  => $car->getPrice(),
            'currency' => $car->getCurrency(),
            'version' => $car->getVersion(),         
            'vin' => $car->getVin(),     
            'exchange' => $car->getExchange(),     
            'auction' => $car->getAuction(),     
            'status' => $car->getStatus(),
            'send_comments' => $car->getSendComments(),
            'enable_comment' => $car->getEnableComment(),
            'description' => $car->getDescription(),
            'added' => $car->getAdded(),
            'priority' => $car->getPriority(),
            
        );
//echo "<pre>"; print_r($data); exit;
        if (null === ($id = $car->getId())) {

            unset($data['id']);
            return $this->getDbTable()->insert($data);
        } else {
           $this->getDbTable()->update($data, array('id = ?' => $id));
           return $id;
        }
    }
    public function find($id)
    {
        $oDbTable = $this->getDbTable();
        $oSelect = $oDbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)
                                      ->joinLeft('sub_category','sub_category.id = cars.body_id', array('body_name'=>'name'))
                                      ->joinLeft('mark','mark.id = cars.mark_id', array('mark_name'=>'name'))
                                      ->joinLeft('model','model.id = cars.model_id', array('model_name'=>'name'))
                                      ->joinLeft('region','region.id = cars.reg_id', array('reg_name'=>'name'))
                                      ->joinLeft('city','city.id = cars.city_id', array('city_name'=>'name'))
                                      ->joinLeft('fuel','fuel.id = cars.fuel_id', array('fuel_type'=>'type'))
                                      ->joinLeft('transmission','transmission.id = cars.transmission_id', array('trans_type'=>'type'))
                                      ->joinLeft('color','color.id = cars.color_id', array('color'=>'name'))
                                      ->joinLeft('drive','drive.id = cars.drive_id', array('drive'=>'type'))
                                      //->joinLeft('users','users.id = cars.user_id', array('username', 'first_name', 'last_name', 'user_added' => 'added', 'last_login'))
                                      ->where('cars.id = ?', $id); 

        
        //echo $oSelect; exit;
        $oResultSet = $oDbTable->fetchRow($oSelect);        
        // echo "<pre>"; print_r($oResultSet);  exit;
               
        return $oResultSet;
     
                
    }
    
    public function findById($id, Application_Model_Cars $car)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        
        $car->setId($row->id);
        $car->setUserId($row->user_id);
        $car->setCatId($row->cat_id);
        $car->setBodyId($row->body_id);
        $car->setRegId($row->reg_id);
        $car->setModelId($row->model_id);
        $car->setMarkId($row->mark_id);
        //$car->setCityId($data['']);
        $car->setTransmissionId($row->transmission_id);
        $car->setDriveId($row->drive_id);
        $car->setDoors($row->doors);
        $car->setFuelId($row->fuel_id);
        $car->setFuelCity($row->fuel_city);
        $car->setFuelRoute($row->fuel_route);
        $car->setFuelCombine($row->fuel_combine);
        $car->setColorId($row->color_id);
        $car->setMetallic($row->metallic);
        $car->setYear($row->year);
        $car->setMileage($row->mileage);
        $car->setVolume($row->volume);                              
        $car->setPrice($row->price);
        $car->setCurrency($row->currency);
        $car->setVersion($row->version);
        $car->setVin($row->vin);
        $car->setExchange($row->exchange);
        $car->setAuction($row->auction);
        $car->setStatus($row->status);
        $car->setAdded($row->added);
        $car->setPriority($row->priority);

        //$car->setTitle('Title');
        $car->setDescription($row->description);
        $car->setEnableComment($row->enable_comment);
        $car->setSendComments($row->send_comments);
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Cars();
            $entry->setId($row->id)
                   ->setTitle($row->title)
                   ->setDescription($row->description)
                   ->setAdded($row->added)
                   ->setYear($row->year)
                   ->setMapper($this);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    
    public function findAll()
    {
       $oDbTable = $this->getDbTable();
       $oSelect = $oDbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)
                                      ->joinLeft('mark','mark.id = cars.mark_id', array('mark_name'=>'name'))
                                      ->joinLeft('model','model.id = cars.model_id', array('model_name'=>'name'))
                                      ->joinLeft('region','region.id = cars.reg_id', array('reg_name'=>'name'))
                                      ->joinLeft('city','city.id = cars.city_id', array('city_name'=>'name'))
                                      ->joinLeft('fuel','fuel.id = cars.fuel_id', array('fuel_type'=>'type'))
                                      ->joinLeft('transmission','transmission.id = cars.transmission_id', array('trans_type'=>'type'))
                                      ->joinLeft('color','color.id = cars.color_id', array('color'=>'name'))
                                      ->joinLeft('drive','drive.id = cars.drive_id', array('drive'=>'type'))
                                      ->joinLeft('photos','photos.auto_id = cars.id AND photos.is_main = 1', array('image'))
                                      ;

        
        //echo $oSelect; exit;
        $oResultSet = $oDbTable->fetchAll($oSelect);        
        // echo "<pre>"; print_r($oResultSet);  exit;
               
        return $oResultSet;
        
    }
    
    public function findByAttrs($data)
    {
                     
       $oDbTable = $this->getDbTable();
       $oSelect = $oDbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)
                                      //->columns(array('img_cnt'=>'count(photos.id)'), false)
                                      ->joinLeft('mark','mark.id = cars.mark_id', array('mark_name'=>'name'))
                                      ->joinLeft('model','model.id = cars.model_id', array('model_name'=>'name', 'subcat_id'))
                                      ->joinLeft('region','region.id = cars.reg_id', array('reg_name'=>'name'))
                                      ->joinLeft('city','city.id = cars.city_id', array('city_name'=>'name'))
                                      ->joinLeft('fuel','fuel.id = cars.fuel_id', array('fuel_type'=>'type'))
                                      ->joinLeft('transmission','transmission.id = cars.transmission_id', array('trans_type'=>'type'))
                                      ->joinLeft('color','color.id = cars.color_id', array('color'=>'name'))
                                      ->joinLeft('drive','drive.id = cars.drive_id', array('drive'=>'type'));
                                        if(!empty($data['with_photo'])){
                                            $oSelect->joinInner('photos','photos.auto_id = cars.id', array('image', 'img_cnt' => 'COUNT(photos.id)'));
                                            $oSelect->group('cars.id');
                                        } else {
                                            $oSelect->joinLeft('photos','photos.auto_id = cars.id', array('image'));
                                            $oSelect->group('cars.id');
                                        }
                                        
        if(!empty($data['auto_id'])){
            $oSelect->where('cars.id = ?', $data['auto_id']); 
        }     
                                        
        if(!empty($data['category_id'])){
            $oSelect->where('cars.cat_id = ?', $data['category_id']); 
        }                  
                
        if(!empty($data['region'])){
            $oSelect->where('cars.reg_id = ?', $data['region']); 
        }
        
        if(!empty($data['mark'])){
            $oSelect->where('cars.mark_id = ?', $data['mark']); 
        }
        
        if(!empty($data['model'])){
            $oSelect->where('cars.model_id = ?', $data['model']); 
        }
        
        if(!empty($data['bodystyle'])){
            $oSelect->where('model.subcat_id = ?', $data['bodystyle']); 
        }
        
        if(!empty($data['with_photo'])){
            $oSelect->group('photos.auto_id');
        }
        
        if(!empty($data['with_video'])){
            $oSelect->where("photos.video_url <> 'NULL'");
        }
        
        if(!empty($data['year_start']) && !empty($data['year_end']) ){
            $oSelect->where('year >= ?',  $data['year_start']);
            $oSelect->where("year <= ?",  $data['year_end']);
        } else {
            if(!empty($data['year_start'])){
                $oSelect->where('year >= ?',  $data['year_start']);
            }
            
            if(!empty($data['year_end'])){
                $oSelect->where("year <= ?",  $data['year_end']);
            }
        }
        
        if(!empty($data['price_start']) && !empty($data['price_end']) ){
            $oSelect->where('price >= ?',  $data['price_start']);
            $oSelect->where("price <= ?",  $data['price_end']);
        } else {
            if(!empty($data['price_start'])){
                $oSelect->where('price >= ?',  $data['price_start']);
            }
            
            if(!empty($data['price_end'])){
                $oSelect->where("price <= ?",  $data['price_end']);
            }
        }
        
        if(!empty($data['mileage_start']) && !empty($data['mileage_end']) ){
            $oSelect->where('mileage >= ?',  $data['mileage_start']);
            $oSelect->where("mileage <= ?",  $data['mileage_end']);
        } else {
            if(!empty($data['mileage_start'])){
                $oSelect->where('mileage >= ?',  $data['mileage_start']);
            }
            
            if(!empty($data['mileage_end'])){
                $oSelect->where("mileage <= ?",  $data['mileage_end']);
            }
        }
        
        if(!empty($data['transmission_id'])){
            $oSelect->where('cars.transmission_id = ?', $data['transmission_id']); 
        }
        
        if(!empty($data['volume_start']) && !empty($data['volume_end']) ){
            $oSelect->where('volume >= ?',  $data['volume_start']);
            $oSelect->where("volume <= ?",  $data['volume_end']);
        } else {
            if(!empty($data['volume_start'])){
                $oSelect->where('volume >= ?',  $data['volume_start']);
            }
            
            if(!empty($data['volume_end'])){
                $oSelect->where("volume <= ?",  $data['volume_end']);
            }
        }
        
        if(!empty($data['fuel_id'])){
            $oSelect->where('cars.fuel_id = ?', $data['fuel_id']); 
        }
        
        if(!empty($data['drive_id'])){
            $oSelect->where('cars.drive_id = ?', $data['drive_id']); 
        }
        
        if(!empty($data['color_id'])){
            $oSelect->where('cars.color_id = ?', $data['color_id']); 
        }
        
        /*
        if(isset($data['m_state'])){
            foreach($data['m_state'] as $k => $v){
              if($k == 0){  
                if(empty($data['region'])){ 
                    $oSelect->where('cars.reg_id = ?', $v); 
                }else{
                    $oSelect->orWhere('cars.reg_id = ?', $v); 
                }
              } else {
                  $oSelect->orWhere('cars.reg_id = ?', $v); 
              }
            }            
        }
        
         * 
         */
        
        if(isset($data['m_state'])){
            $check = false;
            //if(isset($data['m_state']) && array_search(''))
            $cnt = count($data['m_state']);
            for($i = 0; $i < $cnt; $i++){
                if($data['m_city'][$i] == '0'){
                    $tmp = $data['m_state'];
                    unset($tmp[$i]);
                    if(!array_search($data['m_state'][$i], $tmp)){
                        //echo array_search($data['m_state'][$i], $data['m_state']); exit;
                        if($i == 0){
                            if($cnt > 1){
                                $oSelect->where("(cars.reg_id = '".$data['m_state'][$i]."'");
                                $check = true;
                            } else {
                                $oSelect->where("cars.reg_id = '".$data['m_state'][$i]."'");
                                $check = true;
                            }
                        } else {
                            if($i == $cnt-1){
                                $oSelect->orWhere("cars.reg_id = '".$data['m_state'][$i]."')"); 
                            } else {
                                $oSelect->orWhere("cars.reg_id = '".$data['m_state'][$i]."'"); 
                            }
                        }
                        //$oSelect->orWhere("(cars.reg_id = '".$data['m_state'][$i]."' AND cars.city_id = '".$data['m_city'][$i]."')");
                    } 
                } else {
                     if($check == false){
                         $oSelect->where("(cars.reg_id = '".$data['m_state'][$i]."' AND cars.city_id = '".$data['m_city'][$i]."')");
                         $check = true;
                     } else {
                         if($i == $cnt-1){
                            $oSelect->orWhere("(cars.reg_id = '".$data['m_state'][$i]."' AND cars.city_id = '".$data['m_city'][$i]."')");
                         } else {
                            $oSelect->orWhere("(cars.reg_id = '".$data['m_state'][$i]."' AND cars.city_id = '".$data['m_city'][$i]."')"); 
                         }

                     }
                }
            }
        }
        
        if(!empty($data['search_sort'])){
            //$oSelect->where('cars.id = ?', $data['auto_id']); 
            if($data['search_sort'] == 3){
                $oSelect->order(array('price DESC'));
            } else if($data['search_sort'] == 2){
                 $oSelect->order(array('price ASC'));
            } 
        }    
        
        //echo $oSelect; exit;
        $oResultSet = $oDbTable->fetchAll($oSelect);        
        // echo "<pre>"; print_r($oResultSet);  exit;
               
        return $oResultSet;
    }
    
    public function getAttributesById($id, $table_name){
        
        // SELECT * FROM car_comfort LEFT JOIN comfort ON comfort.id = car_comfort.comfort_id WHERE car_comfort.car_id = 1 
               
        $db = Zend_Db_Table::getDefaultAdapter();
        $oSelect = $db->select()->from('car_' . $table_name)
                                ->joinLeft($table_name, $table_name . '.id = car_' . $table_name . '.' . $table_name . '_id', array('attr'))
                                ->where('car_' . $table_name . '.car_id = ?', $id); 

        
        //echo $oSelect; exit;
        $oResultSet = $db->fetchAll($oSelect);        
        // echo "<pre>"; print_r($oResultSet);  exit;
               
        return $oResultSet;
          
    }
    
    public function countByUser($user_id){
        $oDbTable = $this->getDbTable();
        $oSelect = $oDbTable->select()
                            ->from('cars', array('COUNT(cars.id) as cnt'))
                            ->where("cars.user_id = ? AND cars.status = 'active'", $user_id); ;
        $oResultSet = $oDbTable->fetchAll($oSelect);        
        //echo $oSelect; exit;
        return $oResultSet;
    }
    
    public function getIdsByUser($user_id){
        $oDbTable = $this->getDbTable();
        $oSelect = $oDbTable->select()
                            ->from('cars', array('cars.id'))
                            ->where("cars.user_id = ? AND cars.status = 'active'", $user_id); ;
        $oResultSet = $oDbTable->fetchAll($oSelect);        
        //echo $oSelect; exit;
        return $oResultSet;
    }
    
    public function checkAutoOwner($auto_id ,$user_id){
        $oDbTable = $this->getDbTable();
        $oSelect = $oDbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)
                                      ->where('cars.user_id = ?', $user_id)
                                      ->where('cars.id = ?', $auto_id); 
                
        //echo $oSelect; exit;
        $oResultSet = $oDbTable->fetchRow($oSelect);        
        //echo "<pre>"; print_r($oResultSet->toArray());  exit;
        if($oResultSet != null){
            return true;
        } else {
            return false;
        }
               
        //return $oResultSet;
    }
   
   
    
    
}

?>
