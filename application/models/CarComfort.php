<?php

class Application_Model_CarComfort
{
    protected $_id;
    protected $_car_id;
    protected $_comfort_id;
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
    
    public function setCarId($id)
    {
        $this->_car_id = (int) $id;
        return $this;
    }
    public function getCarId()
    {
        return $this->_car_id;
    }
    
    public function setComfortId($id)
    {
        $this->_comfort_id = (int) $id;
        return $this;
    }
    public function getComfortId()
    {
        return $this->_comfort_id;
    }
        
    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }
    public function getMapper()
    {
        if (null === $this->_mapper) {
            $this->setMapper(new Application_Model_CarComfortMapper());
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
         
    public function findByAutoId($id)
    {
        return $this->getMapper()->findByAutoId($id);
    }
    
   
    
}

?>
