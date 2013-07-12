<?php

class Application_Model_CategoriesMarks
{
    protected $_id;
    protected $_cat_id;
    protected $_mark_id;
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
    
    public function setCatId($id)
    {
        $this->_cat_id = (int) $id;
        return $this;
    }
    public function getCatId()
    {
        return $this->_cat_id;
    }
    
    public function setMarkId($id)
    {
        $this->_mark_id = (int) $id;
        return $this;
    }
    public function getMarkId()
    {
        return $this->_mark_id;
    }
        
    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }
    public function getMapper()
    {
        if (null === $this->_mapper) {
            $this->setMapper(new Application_Model_CategoriesMarksMapper());
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
    
    public function getMarksByCat($cat_id){
        return $this->getMapper()->getMarksByCat($cat_id);
    }
      
    
}

?>
