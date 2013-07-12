<?php


class Application_Model_CategoriesMarksMapper
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
            $this->setDbTable('Application_Model_DbTable_CategoriesMarks');
        }
        return $this->_dbTable;
    }
      
        
    
    public function save(Application_Model_CarComfort $model)
    {
        $data = array(
            'cat_id'    => $model->getCatId(),
            'mark_id'   => $model->getMarkId(),
            
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
    
    public function getMarksByCat($cat_id){
        
        //select id, name FROM marks LEFT JOIN categories_marks ON marks.id = categories_marks.mark_id LEFT JOIN categories ON categories.id = categories_marks.cat_id WHERE categories.id = 2 
        
        // SELECT mark.id, mark.name FROM mark LEFT JOIN categories_marks ON mark.id = categories_marks.mark_id LEFT JOIN category ON category.id = categories_marks.cat_id
        
        $db = Zend_Db_Table::getDefaultAdapter();
        $oSelect = $db->select()->from('mark', array('id', 'name'))
                                ->joinLeft('categories_marks', 'mark.id = categories_marks.mark_id', array())
                                ->joinLeft('category', 'category.id = categories_marks.cat_id', array())
                                ->where('category.id = ?', $cat_id); 

        
        //echo $oSelect; exit;
        $oResultSet = $db->fetchAll($oSelect);        
        // echo "<pre>"; print_r($oResultSet);  exit;
               
        return $oResultSet;
    }
        
}

?>
