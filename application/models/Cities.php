<?php

class Application_Model_Cities
{
    protected $_id;
    protected $_region_id;
    protected $_name;
    protected $_phone_code;
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
    public function setPhoneCode($code)
    {
        $this->_phone_code = (string) $code;
        return $this;
    }
    public function getPhoneCode()
    {
        return $this->_phone_code;
    }
    public function setRegion_id($id)
    {
        $this->_region_id = (string) $id;
        return $this;
    }
    public function getRegion_id()
    {
        return $this->_region_id;
    }
    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }
    public function getName()
    {
        return $this->_name;
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
    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }
    public function getMapper()
    {
        if (null === $this->_mapper) {
            $this->setMapper(new Application_Model_CitiesMapper());
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
    
    public function findByRegId($id)
    {
        return $this->getMapper()->findByRegId($id);
    }

}

?>
