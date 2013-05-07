<?php

class Application_Model_Cars
{
    protected $_title;
    protected $_description;
    protected $_added;
    protected $_id;
    protected $_mapper;
    protected $_year;
protected $_user_id;
    
    
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
    public function setTitle($title)
    {
        $this->_title = (string) $title;
        return $this;
    }
    public function getTitle()
    {
        return $this->_title;
    }
    public function setDescription($desc)
    {
        $this->_description = (string) $desc;
        return $this;
    }
    public function getDescription()
    {
        return $this->_description;
    }
    public function setAdded($ts)
    {
        $this->_added = $ts;
        return $this;
    }
    public function getAdded()
    {
        return $this->_added;
    }
    public function setYear($val)
    {
        $this->_year = $val;
        return $this;
    }
    public function getYear()
    {
        return $this->_year;
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
            $this->setMapper(new Application_Model_CarsMapper());
        }
        return $this->_mapper;
    }
    public function save()
    {
        $this->getMapper()->save($this);
    }
    public function getAttributesById($id, $table_name) {
        return $this->getMapper()->getAttributesById($id, $table_name);
    }
    public function find($id)
    {
        return $this->getMapper()->find($id);
    }
    public function fetchAll()
    {
        return $this->getMapper()->fetchAll();
    }
    
    public function findAll()
    {
        return $this->getMapper()->findAll();
    }
}

?>
