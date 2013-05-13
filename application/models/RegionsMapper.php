<?php


class Application_Model_RegionsMapper
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
            $this->setDbTable('Application_Model_DbTable_Regions');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Regions $region)
    {
        $data = array(
            'name'   => $region->getName(),
            
        );
      if (null === ($id = $region->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    public function find($id, Application_Model_Regions $region)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $region->setId($row->id)
            ->setName($row->name);
    }
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Regions();
            $entry->setId($row->id)
                   ->setName($row->name)
                   ->setMapper($this);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function getRegion()
    {
	return $this->_row->findParentRow(new Model_DbTable_Users, 'User');
                
    }
    
}

?>
