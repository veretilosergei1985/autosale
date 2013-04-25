<?php

class CreateUsersTable extends Akrabat_Db_Schema_AbstractChange 

{

    function up()

    {

        $sql = "CREATE TABLE IF NOT EXISTS users (

                  id int(11) NOT NULL AUTO_INCREMENT,

                  username varchar(50) NOT NULL,

                  password varchar(75) NOT NULL,

                  roles varchar(200) NOT NULL DEFAULT 'user',

                  PRIMARY KEY (id)

                )";

        $this->_db->query($sql);

    

        $data = array();

        $data['username'] = 'admin';

        $data['password'] = sha1('password');

        $data['roles'] = 'user,admin';

        $this->_db->insert('users', $data);

        

    }

    

    function down()

    {

        $sql = "DROP TABLE IF EXISTS users";

        $this->_db->query($sql);

    }

}
?>
