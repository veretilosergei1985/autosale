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
            'title'   => $car->getTitle(),
            'description' => $car->getDescription(),
            'added' => date('Y-m-d H:i:s'),
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
}

?>
