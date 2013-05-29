<?php


class Application_Model_FuelMapper
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
            $this->setDbTable('Application_Model_DbTable_Fuel');
        }
        return $this->_dbTable;
    }
   
    public function find($id, Application_Model_Fuel $fuel)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $fuel->setId($row->id)
            ->setType($row->type);
    }
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Fuel();
            $entry->setId($row->id)
                   ->setType($row->type)
                   ->setMapper($this);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    
    
}

?>
