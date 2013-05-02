<?php

class CreateAttrTable extends Akrabat_Db_Schema_AbstractChange 

{

    function up()

    {

        $sql = "CREATE TABLE IF NOT EXISTS attr (
                  id int(11) NOT NULL AUTO_INCREMENT,
                  title varchar(50) NOT NULL,
                  PRIMARY KEY (id)
                )";

        $this->_db->query($sql);

    

        $data = array();
        $data['title'] = 'attr';
        $this->_db->insert('attr', $data);

        

    }

    

    function down()

    {

        $sql = "DROP TABLE IF EXISTS attr";

        $this->_db->query($sql);

    }

}
?>
