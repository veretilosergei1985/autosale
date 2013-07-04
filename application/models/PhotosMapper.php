<?php


class Application_Model_PhotosMapper
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
            $this->setDbTable('Application_Model_DbTable_Photos');
        }
        return $this->_dbTable;
    }
    
    public function find($id, Application_Model_Photos $oPhoto)
    {
        $result = $this->getDbTable()->find($id);
       
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();

        $oPhoto->setId($row->id)
                ->setImage($row->image)
                ->setIsMain($row->is_main)
                ->setAutoId($row->auto_id);
                
    }
    
     public function findByAutoId($auto_id){
        
        $oDbTable = $this->getDbTable();
        $oSelect = $oDbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)
                            ->where('auto_id = ?', $auto_id); 

        $oResultSet = $oDbTable->fetchAll($oSelect);        
              
        return $oResultSet;
        
    }
        
    
    public function save(Application_Model_Photos $photo)
    {
        $data = array(
            'auto_id'    => $photo->getAutoId(),
            'image'   => $photo->getImage(),
            'is_main'  => $photo->getIsMain(),
            'video_url'  => $photo->getVideoUrl(),
        );
        
        if (null === ($id = $photo->getId())) {
            unset($data['id']);
            $ins_id = $this->getDbTable()->insert($data);
            return $ins_id;
        } else {
            $ins_id = $this->getDbTable()->update($data, array('id = ?' => $id));
            return $id;
        }
    }
    
    public function mainExist($auto_id){
        $db = Zend_Db_Table::getDefaultAdapter();
        $oSelect = $db->select()->from('photos')->where('auto_id = ? AND is_main = 1', $auto_id); 

        $oResultSet = $db->fetchAll($oSelect);        
       
        if(count($oResultSet) > 0){
            return true;
        } else {
            return false;
        }

    }
    
    public function deletePhoto($photo_id){
        
        $image = $this->getImageById($photo_id);
        $oWhere = $this->getDbTable()->getAdapter()->quoteInto('id = ?', $photo_id);
        
            if($this->getDbTable()->delete($oWhere)){
                return $image;
            } else {
                return false;
            }

    }
    
    public function getImageById($photo_id){
        
        $result = $this->getDbTable()->find($photo_id);
        $row = $result->current();
        return $row->image;
    }
    
    public function isVideoExist($auto_id){
        $db = Zend_Db_Table::getDefaultAdapter();
        $oSelect = $db->select()->from('photos')->where("auto_id = ? AND video_url <> ''", $auto_id); 

        $oResultSet = $db->fetchAll($oSelect);        
       
        if(count($oResultSet) > 0){
            return true;
        } else {
            return false;
        }        
    }
    
    public function getMainImage($auto_id){
        $oDbTable = $this->getDbTable();
        $oSelect = $oDbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)
                            ->where('auto_id = ? AND is_main = 1', $auto_id); 

        $oResultSet = $oDbTable->fetchAll($oSelect);        
              
        return $oResultSet;
    }
    
    public function getPhotosCount(){
        $oDbTable = $this->getDbTable();
        $oSelect = $oDbTable->select()
                            ->from('photos', array('COUNT(photos.image) as cnt', 'photos.auto_id'))
                            ->group('auto_id');
        
        //echo $oSelect; exit;
        $oResultSet = $oDbTable->fetchAll($oSelect);        
        // echo "<pre>"; print_r($oResultSet);  exit;
               
        return $oResultSet;
    }
    
    
}

?>
