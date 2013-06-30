<?php


class Application_Model_CarComfortMapper
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
            $this->setDbTable('Application_Model_DbTable_CarComfort');
        }
        return $this->_dbTable;
    }
    
        
     public function findByAutoId($auto_id){
        
        $oDbTable = $this->getDbTable();
        $oSelect = $oDbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)
                            ->where('car_id = ?', $auto_id); 

        $oResultSet = $oDbTable->fetchAll($oSelect);        
              
        return $oResultSet;
        
    }
        
    
    public function save(Application_Model_CarComfort $model)
    {
        $data = array(
            'car_id'    => $model->getCarId(),
            'comfort_id'   => $model->getComfortId(),
            
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
    
    public function deleteAutoOptions($id){
        $oWhere = $this->getDbTable()->getAdapter()->quoteInto('car_id = ?', $id);
        $this->getDbTable()->delete($oWhere);
    }
    
    
}

?>
