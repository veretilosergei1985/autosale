<?php


class Application_Model_DriveMapper
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
            $this->setDbTable('Application_Model_DbTable_Drive');
        }
        return $this->_dbTable;
    }
   
    public function find($id, Application_Model_Drive $drive)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $drive->setId($row->id)
            ->setType($row->type);
    }
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Drive();
            $entry->setId($row->id)
                   ->setType($row->type)
                   ->setMapper($this);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    
    
}

?>
