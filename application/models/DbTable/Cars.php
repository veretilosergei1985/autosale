<?php

class Application_Model_DbTable_Cars extends Zend_Db_Table_Abstract
{
    protected $_name = 'cars';
    protected $_dependentTables = array(
		'Model_DbTable_Regions'
	);
}

?>
