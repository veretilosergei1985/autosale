<?php

class Application_Model_Users
{
    protected $_id;
    protected $_username;
    protected $_password;
    protected $_first_name;
    protected $_last_name;
    protected $_email;
    protected $_phone;
    protected $_reg_id;
    protected $_city_id;
    
    protected $_mapper;
   
    
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
      }
    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Неправильное свойство');
        }
        $this->$method($value);
    }
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Неправильное свойство');
        }
        return $this->$method();
    }
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
     public function setFirstName($val)
    {
        $this->_first_name = (string) $val;
        return $this;
    }
    public function getFirstName()
    {
        return $this->_first_name;
    }
    public function setLastName($val)
    {
        $this->_last_name = (string) $val;
        return $this;
    }
    public function getLastName()
    {
        return $this->_last_name;
    }
    public function setUsername($val)
    {
        $this->_username = (string) $val;
        return $this;
    }
    public function getUsername()
    {
        return $this->_username;
    }
    public function setEmail($val)
    {
        $this->_email = (string) $val;
        return $this;
    }
    public function getEmail()
    {
        return $this->_email;
    }
    
    public function setPassword($val)
    {
        $this->_password = (string) $val;
        return $this;
    }
    public function getPassword()
    {
        return $this->_password;
    }
    
    public function setPhone($val)
    {
        $this->_phone = (string) $val;
        return $this;
    }
    public function getPhone()
    {
        return $this->_phone;
    }
  
    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
    public function getId()
    {
        return $this->_id;
    }
    
    public function setRegId($id)
    {
        $this->_reg_id = (int) $id;
        return $this;
    }
    public function getRegId()
    {
        return $this->_reg_id;
    }
    
    public function setCityId($id)
    {
        $this->_city_id = (int) $id;
        return $this;
    }
    public function getCityId()
    {
        return $this->_city_id;
    }
    
    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }
    public function getMapper()
    {
        if (null === $this->_mapper) {
            $this->setMapper(new Application_Model_UsersMapper());
        }
        return $this->_mapper;
    }
    public function save()
    {
        $this->getMapper()->save($this);
    }
   
    public function find($id)
    {
        $this->getMapper()->find($id, $this);
        return $this;
    }
    public function fetchAll()
    {
        return $this->getMapper()->fetchAll();
    }
        
}

?>
