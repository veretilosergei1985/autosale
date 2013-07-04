<?php

class Application_Model_Prices
{
    protected $_id;
    protected $_name;
    protected $_value;
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
    
    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
    public function getId()
    {
        return $this->_id;
    }
    
    public function setName($val)
    {
        $this->_name = (string) $val;
        return $this;
    }
    public function getName()
    {
        return $this->_name;
    }
    
    public function setValue($val)
    {
        $this->_value = $val;
        return $this;
    }
    public function getValue()
    {
        return $this->_value;
    }
        
    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }
    public function getMapper()
    {
        if (null === $this->_mapper) {
            $this->setMapper(new Application_Model_PricesMapper());
        }
        return $this->_mapper;
    }
    public function save()
    {
       return $this->getMapper()->save($this);
    }
      
    public function fetchAll()
    {
        return $this->getMapper()->fetchAll();
    }
         
    public function find($id)
    {
        return $this->getMapper()->find($id);
    }
    
    
}

?>
