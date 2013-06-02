<?php



class Base_Validator_FloatValidator extends Zend_Validate_Abstract
{
    const FLOAT = 'float';

    protected $_messageTemplates = array(
        self::FLOAT => "'%value%' не является числом"
    );

    public function isValid($value)
    {
        $this->_setValue($value);

        if (!is_numeric($value)) {
            $this->_error();
            return false;
        }

        return true;
    }
}


?>