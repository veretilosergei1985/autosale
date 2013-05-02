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
    public function find($id, Application_Model_Cars $car)
    {
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
        $oSelect = $oDbTable->select()->from('cars') 
                                      ->joinLeft('region','cars.reg_id=region.id', array()
                                      ); 
        echo $oSelect; exit;
        $oResultSet = $oDbTable->fetchAll($oSelect);        
       // echo "<pre>"; print_r($oResultSet);  exit;
        
        foreach($oResultSet as $row){
            echo  $row['title']."  ".$row['name']; exit;
        }
        
        
    }
}

?>
