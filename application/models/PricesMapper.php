<?php


class Application_Model_PricesMapper
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
            $this->setDbTable('Application_Model_DbTable_Prices');
        }
        return $this->_dbTable;
    }
    
        
     public function findByAutoId($auto_id){
        
        $oDbTable = $this->getDbTable();
        $oSelect = $oDbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)
                            ->where('auto_id = ?', $auto_id); 

        $oResultSet = $oDbTable->fetchAll($oSelect);        
              
        return $oResultSet;
        
    }
    
    public function fetchAll(){
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Prices();
            $entry->setId($row->id)
                  ->setName($row->name)
                  ->setValue($row->value)
                  ->setMapper($this);
            $entries[] = $entry;
        }
        return $entries;
    }
        
    
    public function save(Application_Model_Prices $model)
    {
        $data = array(
            'name'    => $model->getName(),
            'value'   => $model->getValue(),
            
        );
        
        if (null === ($id = $model->getId())) {
            unset($data['id']);
            $ins_id = $this->getDbTable()->insert($data);
            return $ins_id;
        } else {
            $ins_id = $this->getDbTable()->update($data, array('id = ?' => $id));
            return $id;
        }
    }
    
   
    
    
}

?>
