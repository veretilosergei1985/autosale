<?php

class Application_Model_Fuel
{
    protected $_type;
    protected $_id;
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
    public function setType($value)
    {
        $this->_type = (string) $value;
        return $this;
    }
    public function getType()
    {
        return $this->_type;
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
            $this->setMapper(new Application_Model_FuelMapper());
        }
        return $this->_mapper;
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
