<?php


class Application_Model_ModelsMapper
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
            $this->setDbTable('Application_Model_DbTable_Models');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Models $model)
    {
        $data = array(
            'name'   => $model->getName(),
            
        );
      if (null === ($id = $model->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    public function find($id, Application_Model_Models $model)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $model->setId($row->id)
            ->setName($row->name);
    }
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Models();
            $entry->setId($row->id)
                   ->setName($row->name)
                   ->setMapper($this);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function findByMarkId($mark_id){
        
        $oDbTable = $this->getDbTable();
        $oSelect = $oDbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)
                            ->where('model.mark_id = ?', $mark_id); 

        $oResultSet = $oDbTable->fetchAll($oSelect);        
              
        return $oResultSet;
        
    }
    
    public function findByAttrs($mark_id, $subcat_id){
        $oDbTable = $this->getDbTable();
        $oSelect = $oDbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        
                   if($mark_id != ''){
                        $oSelect->where('model.mark_id = ?', $mark_id); 
                   }
                   
//                   if($subcat_id != ''){
//                        $oSelect->where('model.subcat_id = ?', $subcat_id); 
//                   }
        //echo $oSelect; exit;                
        $oResultSet = $oDbTable->fetchAll($oSelect);        
              
        return $oResultSet;
        
    }

    
}

?>
