<?php


class Application_Model_SubcatsMapper
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
            $this->setDbTable('Application_Model_DbTable_Subcats');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Subcats $subcat)
    {
        $data = array(
            'name'   => $subcat->getName(),
            
        );
      if (null === ($id = $region->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    public function find($id, Application_Model_Subcats $subcat)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $subcat->setId($row->id)
            ->setName($row->name);
    }
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Subcats();
            $entry->setId($row->id)
                   ->setName($row->name)
                   ->setMapper($this);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function getByParentId($id){
        
        $oDbTable = $this->getDbTable();
        $oSelect = $oDbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)
                            ->where('sub_category.parent_id = ?', $id); 
        
        $oResultSet = $oDbTable->fetchAll($oSelect);        
              
        return $oResultSet;
        
    }
    
    
    
}

?>
