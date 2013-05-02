<?php

class Application_Model_DbTable_Regions extends Zend_Db_Table_Abstract
{
    protected $_name = 'region';
    protected $_referenceMap = array(
		'Region' => array(
			'columns' => 'reg_id',
			'refTableClass' => 'Model_DbTable_Cars',
			'refColumns' => 'id',
			'onDelete' => self::CASCADE
		)
	);
    
}

?>
