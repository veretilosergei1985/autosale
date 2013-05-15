<?php

class Application_Form_Register extends Zend_Form
{
    public function init(){
       
        $myHtml = function($content, $element, array $options) {
                return '$';
            };
                   
        $this->setMethod('post');
        $this->setAttrib('class', 'grid grid-span1');
        
        $this->setDecorators(array(
                                array('FormErrors', array('markupListItemStart' => '', 'markupListItemEnd' => '')),
                                array('FormElements'),
                                array('Form')
                            ));
        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel("E-mail:<ins>*</ins>")
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'span3');
                
        $email->removeDecorator('Errors');
        
        
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Пароль:<ins>*</ins>')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'span3');
        $password->removeDecorator('Errors');
        
        $password_repeat = new Zend_Form_Element_Password('password_repeat');
        $password_repeat->setLabel('Повторите пароль<ins>*</ins>:')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'span3');
        $password_repeat->removeDecorator('Errors');
        
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Имя:<ins>*</ins>')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'span3');
        $username->removeDecorator('Errors');
        
        $code = new Zend_Form_Element_Text('code');
        $code->setLabel("Телефон:<ins>*</ins>")
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'code')
                ->setAttrib('placeholder', 'XXX');
                
        $code->removeDecorator('Errors');
        
        $phone = new Zend_Form_Element_Text('phone');
        $phone->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'number')
                ->setAttrib('placeholder', 'XX-XX-XXX');
                
        $phone->removeDecorator('Errors');
        
        $region = new Zend_Form_Element_Select('region', array(
                                                "required" => true,
                                             ));
        $region->setLabel("Область:<ins>*</ins>");
        $region->addMultiOptions(array(0 => 'Выберите'));
        $region->setAttrib('class', 'span3');
                
        $region->removeDecorator('Errors');
        
        $city = new Zend_Form_Element_Select('city', array(
                                                "required" => true,
                                             ));
        $city->setLabel("Город:<ins>*</ins>");
        $city->addMultiOptions(array(0 => 'Выберите'));
        $city->setAttrib('class', 'span3');
                
        $city->removeDecorator('Errors');
       
//        $email->addDecorator('HtmlTag', array('tag' => 'div' ));
//        $password->addDecorator('HtmlTag', array('tag' => 'div'));
//        $password_repeat->addDecorator('HtmlTag', array('tag' => 'div'));
//        $username->addDecorator('HtmlTag', array('tag' => 'div')); 
                
        
        $email->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        
        $password->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        
        $password_repeat->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        
        $username->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        
 
        
        $code->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input', 'openOnly' => 'true',) ),
            array('Label', array('class' => 'label', 'escape' => false)),
            array('Description', array('placement' => Zend_Form_Decorator_Abstract::PREPEND, 'tag' => 'em'))
            //array('Callback', array('callback' => function() { return '$'; }, 'placement' => 'PREPEND')),
            //array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        
        $phone->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'closeOnly' => 'true')),
            array('Label', array('class' => 'label', 'escape' => false)),
        ));
        
        $region->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        
        $city->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        //$code->addDecorator('HtmlTag', array('tag' => 'div', 'class' => 'authors_list','openOnly' => 'true',  'placement' => Zend_Form_Decorator_Abstract::APPEND,));
        //$phone->addDecorator('HtmlTag', array('tag' => 'div', 'closeOnly' => 'true', ));
               
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Save')
                ->setOptions(array('class' => 'add_button'));
        
      
        
        $this->addElements(
                array($email, $password, $password_repeat, $username, $code, $phone, $region, $city)
                );
       
        $this->addElements(
                array($submit)
                );
             
        
        
        
    }
    
    
}

?>
