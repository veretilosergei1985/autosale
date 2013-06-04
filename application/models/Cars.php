<?php

class Application_Model_Cars
{    
    protected $_id;
    protected $_user_id;
    protected $_cat_id;
    protected $_body_id;
    protected $_reg_id;
    protected $_model_id;
    protected $_mark_id;
    protected $_city_id;
    protected $_transmission_id;
    protected $_drive_id;
    protected $_doors;
    protected $_fuel_id;
    protected $_color_id;
    protected $_metallic;
    protected $_year;
    protected $_mileage;
    protected $_volume;
    protected $_price;
    protected $_currency;
    protected $_status;
    protected $_added;
    
    protected $_title;
    protected $_description;


    
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
    
    public function setUserId($id)
    {
        $this->_user_id = (int) $id;
        return $this;
    }
    public function getUserId()
    {
        return $this->_user_id;
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
    
    public function setBodyId($id)
    {
        $this->_body_id = (int) $id;
        return $this;
    }
    public function getBodyId()
    {
        return $this->_body_id;
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
    
    public function setModelId($id)
    {
        $this->_model_id = (int) $id;
        return $this;
    }
    public function getModelId()
    {
        return $this->_model_id;
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
    
    public function setCityId($id)
    {
        $this->_city_id = (int) $id;
        return $this;
    }
    public function getCityId()
    {
        return $this->_city_id;
    }
    
    public function setTransmissionId($id)
    {
        $this->_transmission_id = (int) $id;
        return $this;
    }
    public function getTransmissionId()
    {
        return $this->_transmission_id;
    }
    
    public function setDriveId($id)
    {
        $this->_drive_id = (int) $id;
        return $this;
    }
    public function getDriveId()
    {
        return $this->_drive_id;
    }
    
    public function setDoors($num)
    {
        $this->_doors = (int) $num;
        return $this;
    }
    public function getDoors()
    {
        return $this->_doors;
    }
    
    public function setFuelId($id)
    {
        $this->_fuel_id = (int) $id;
        return $this;
    }
    public function getFuelId()
    {
        return $this->_fuel_id;
    }
    
    public function setColorId($id)
    {
        $this->_color_id = (int) $id;
        return $this;
    }
    public function getColorId()
    {
        return $this->_color_id;
    }
    
    public function setMetallic($val)
    {
        $this->_metallic = (int)$val;
        return $this;
    }
    public function getMetallic()
    {
        return $this->_metallic;
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
    
    public function setMileage($val)
    {
        $this->_mileage = (int)$val;
        return $this;
    }
    public function getMileage()
    {
        return $this->_mileage;
    }
    
    public function setVolume($val)
    {
        $this->_volume = $val;
        return $this;
    }
    public function getVolume()
    {
        return $this->_volume;
    }
    
    public function setPrice($val)
    {
        $this->_price = $val;
        return $this;
    }
    public function getPrice()
    {
        return $this->_price;
    }
    
    public function setCurrency($val)
    {
        $this->_currency = $val;
        return $this;
    }
    public function getCurrency()
    {
        return $this->_currency;
    }
    
    public function setStatus($val)
    {
        $this->_status = $val;
        return $this;
    }
    public function getStatus()
    {
        return $this->_status;
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
  ////////////////////////////////////////////////////  
    
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
