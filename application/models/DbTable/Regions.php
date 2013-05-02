<?php

class Application_Model_DbTable_Regions extends Zend_Db_Table_Abstract
{
    protected $_name = 'region';
    protected $_referenceMap    = array(
        'Car' => array(
            'columns'           => 'id',
            'refTableClass'     => 'Application_Model_DbTable_Cars',
            'refColumns'        => 'reg_id'
        ));
        
}

?>
