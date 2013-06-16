<?php

class Application_Model_Photos
{
    protected $_id;
    protected $_auto_id;
    protected $_image;
    protected $_is_main;
    protected $_video_url;
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
    
    public function setAutoId($id)
    {
        $this->_auto_id = (int) $id;
        return $this;
    }
    public function getAutoId()
    {
        return $this->_auto_id;
    }
    
    public function setImage($val)
    {
        $this->_image = (string) $val;
        return $this;
    }
    public function getImage()
    {
        return $this->_image;
    }
    
    public function setIsMain($val)
    {
        $this->_is_main = $val;
        return $this;
    }
    public function getIsMain()
    {
        return $this->_is_main;
    }
    
    public function setVideoUrl($val)
    {
        $this->_video_url = $val;
        return $this;
    }
    public function getVideoUrl()
    {
        return $this->_video_url;
    }
        
    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }
    public function getMapper()
    {
        if (null === $this->_mapper) {
            $this->setMapper(new Application_Model_PhotosMapper());
        }
        return $this->_mapper;
    }
    public function save()
    {
       return $this->getMapper()->save($this);
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
    
    public function mainExist($auto_id){
        return $this->getMapper()->mainExist($auto_id);
    }
    
    public function deletePhoto($photo_id){
        
        return $this->getMapper()->deletePhoto($photo_id);
    }
      
    public function findByAutoId($id)
    {
        return $this->getMapper()->findByAutoId($id);
    }
    
    public function isVideoExist($auto_id){
         return $this->getMapper()->isVideoExist($auto_id);
    }
    
}

?>
