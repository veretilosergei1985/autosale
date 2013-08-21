<?php


class Application_Model_UsersMapper
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
            $this->setDbTable('Application_Model_DbTable_Users');
        }
        return $this->_dbTable;
    }
    
    public function mkSecret($length = 20)
    {
        $set = array(
            "a",
            "A",
            "b",
            "B",
            "c",
            "C",
            "d",
            "D",
            "e",
            "E",
            "f",
            "F",
            "g",
            "G",
            "h",
            "H",
            "i",
            "I",
            "j",
            "J",
            "k",
            "K",
            "l",
            "L",
            "m",
            "M",
            "n",
            "N",
            "o",
            "O",
            "p",
            "P",
            "q",
            "Q",
            "r",
            "R",
            "s",
            "S",
            "t",
            "T",
            "u",
            "U",
            "v",
            "V",
            "w",
            "W",
            "x",
            "X",
            "y",
            "Y",
            "z",
            "Z",
            "1",
            "2",
            "3",
            "4",
            "5",
            "6",
            "7",
            "8",
            "9"
        );
        $str = '';

        for ($i = 1; $i <= $length; $i++) {
            $ch = rand(0, count($set) - 1);
            $str .= $set[$ch];
        }
        return $str;
    }
    
    public function save(Application_Model_Users $user)
    {
        $password_salt = $this->mkSecret(6);
        $data = array(
            'reg_id'    => $user->getRegId(),
            'city_id'   => $user->getCityId(),
            'username'  => $user->getUsername(),
            'salt' => $password_salt,
            'password'  => md5($password_salt.$user->getPassword()),
            'email'    => $user->getEmail(),
            'phone'    => $user->getPhone(),
            'added' => date('Y-m-d H:i:s'),
            'lastlogin' => $user->getLastLogin()
            
        );
        
        if (null === ($id = $user->getId())) {
            unset($data['id']);
            $ins_id = $this->getDbTable()->insert($data);
            return $ins_id;
        } else {
            $ins_id = $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    
    public function updateAttr(Application_Model_Users $user)
    {
       $data = array(
            'id' => $user->getId(),
            'reg_id'    => $user->getRegId(),
            'city_id'   => $user->getCityId(),
            'username'  => $user->getUsername(),
            'email'    => $user->getEmail(),
            'phone'    => $user->getPhone(),
            'lastlogin' => $user->getLastLogin()
            
        );
        
       $id = $user->getId();
       unset($data['id']);
       $ins_id = $this->getDbTable()->update($data, array('id = ?' => $id));
       //echo "<pre>"; print_r($data); exit;
 
    }
    
    public function find($id, Application_Model_Users $user)
    {

        $result = $this->getDbTable()->find($id);
       
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();

        $user->setId($row->id)
             ->setUsername($row->username)
             ->setEmail($row->email)
             ->setPhone($row->phone)
             ->setAdded($row->added)
             ->setLastLogin($row->lastlogin);
                //->setFirstName($row->first_name)
                //->setLastName($row->last_name)
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
                    ->setLastLogin($row->lastlogin)
                   ->setYear($row->year)
                   ->setMapper($this);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    
    public function findAll()
    {
        $oDbTable = $this->getDbTable();
        $oSelect = $oDbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)
                                      ->joinLeft('region','region.id = cars.reg_id', array('reg_name'=>'name'))
                                      ->joinLeft('city','city.id = cars.city_id', array('city_name'=>'name'))
                                      ->joinLeft('fuel','fuel.id = cars.fuel_id', array('fuel_type'=>'type'))
                                      ->joinLeft('transmission','transmission.id = cars.transmission_id', array('trans_type'=>'type'))
                                      ->joinLeft('color','color.id = cars.color_id', array('color'=>'name')
                                      ); 

        
        //echo $oSelect; exit;
        $oResultSet = $oDbTable->fetchAll($oSelect);        
       // echo "<pre>"; print_r($oResultSet);  exit;
               
        return $oResultSet;
        
    }
    
    public function getAttributesById($id, $table_name){
        
        // SELECT * FROM car_comfort LEFT JOIN comfort ON comfort.id = car_comfort.comfort_id WHERE car_comfort.car_id = 1 
               
        $db = Zend_Db_Table::getDefaultAdapter();
        $oSelect = $db->select()->from('car_' . $table_name)
                                ->joinLeft($table_name, $table_name . '.id = car_' . $table_name . '.' . $table_name . '_id', array('attr'))
                                ->where('car_' . $table_name . '.car_id = ?', $id); 

        
        //echo $oSelect; exit;
        $oResultSet = $db->fetchAll($oSelect);        
        // echo "<pre>"; print_r($oResultSet);  exit;
               
        return $oResultSet;
        
        
    }
    
    
}

?>
