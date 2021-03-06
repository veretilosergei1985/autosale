<?php

class Application_Model_Models
{
    protected $_id;
    protected $_mark_id;
    protected $_name;
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
    
    public function setMarkId($id)
    {
        $this->_mark_id = (string) $id;
        return $this;
    }
    public function getMarkId()
    {
        return $this->_mark_id;
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
            $this->setMapper(new Application_Model_ModelsMapper());
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
    
    public function findByMarkId($id)
    {
        return $this->getMapper()->findByMarkId($id);
    }
    
    public function findByAttrs($mark_id, $subcat_id)
    {
        return $this->getMapper()->findByAttrs($mark_id, $subcat_id);
    }

}

?>
