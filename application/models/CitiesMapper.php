<?php


class Application_Model_CitiesMapper
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
            $this->setDbTable('Application_Model_DbTable_Cities');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Cities $city)
    {
        $data = array(
            'name'   => $city->getName(),
            
        );
      if (null === ($id = $city->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    public function find($id, Application_Model_Cities $city)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $city->setId($row->id)
            ->setName($row->name);
    }
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Cities();
            $entry->setId($row->id)
                   ->setName($row->name)
                   ->setMapper($this);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function findByRegId($reg_id){
        
        $oDbTable = $this->getDbTable();
        $oSelect = $oDbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)
                            //->joinLeft('region','city.id = cars.city_id', array('city_name'=>'name'))
                            ->where('city.region_id = ?', $reg_id); 

        
        //echo $oSelect; exit;
        $oResultSet = $oDbTable->fetchAll($oSelect);        
        // echo "<pre>"; print_r($oResultSet);  exit;
               
        return $oResultSet;
        
    }

    
}

?>
