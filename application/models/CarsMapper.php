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
            'cat_id' => $car->getCatId(), 
            'body_id' => $car->getBodyId(), 
            'reg_id' => $car->getRegId(),
            'model_id' => $car->getModelId(),
            'mark_id' => $car->getMarkId(),
            'transmission_id' => $car->getTransmissionId(), 
            'drive_id' => $car->getDriveId(),
            'doors' => $car->getDoors(),
            'fuel_id' => $car->getFuelId(),
            'color_id' => $car->getColorId(),
            'metallic' => $car->getMetallic(),
            'year' => $car->getYear(),
            'mileage' => $car->getMileage(),
            'volume' => $car->getVolume(),                           
            'price'  => $car->getPrice(),
            'currency' => $car->getCurrency(),
            'status' => $car->getStatus()
            
        );
      if (null === ($id = $car->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    public function find($id)
    {
        $oDbTable = $this->getDbTable();
        $oSelect = $oDbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)
                                      ->joinLeft('region','region.id = cars.reg_id', array('reg_name'=>'name'))
                                      ->joinLeft('city','city.id = cars.city_id', array('city_name'=>'name'))
                                      ->joinLeft('fuel','fuel.id = cars.fuel_id', array('fuel_type'=>'type'))
                                      ->joinLeft('transmission','transmission.id = cars.transmission_id', array('trans_type'=>'type'))
                                      ->joinLeft('color','color.id = cars.color_id', array('color'=>'name'))
                                      ->joinLeft('drive','drive.id = cars.drive_id', array('drive'=>'title'))
                                      //->joinLeft('users','users.id = cars.user_id', array('username', 'first_name', 'last_name', 'user_added' => 'added', 'last_login'))
                                      ->where('cars.id = ?', $id); 

        
        //echo $oSelect; exit;
        $oResultSet = $oDbTable->fetchRow($oSelect);        
        // echo "<pre>"; print_r($oResultSet);  exit;
               
        return $oResultSet;
     
        
        /*
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $car->setId($row->id)
            ->setTitle($row->title)
            ->setDesription($row->description)
            ->setYear($row->year)
            ->setAdded($row->added);
         * 
         */
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
                                      ->joinLeft('region','region.id = cars.reg_id', array('reg_name'=>'name'))
                                      ->joinLeft('city','city.id = cars.city_id', array('city_name'=>'name'))
                                      ->joinLeft('fuel','fuel.id = cars.fuel_id', array('fuel_type'=>'type'))
                                      ->joinLeft('transmission','transmission.id = cars.transmission_id', array('trans_type'=>'type'))
                                      ->joinLeft('color','color.id = cars.color_id', array('color'=>'name')
                                      ); 

        
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
    
    
}

?>
