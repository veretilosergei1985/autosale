<?php

class Application_Form_Register extends Zend_Form
{
    public function init(){
       
                   
        $this->setMethod('post');
        $this->setAttrib('class', 'grid grid-span1');
        
        $this->setDecorators(array(
                                array('FormErrors', array('markupListItemStart' => '', 'markupListItemEnd' => '')),
                                array('FormElements'),
                                array('Form')
                            ));
        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('E-mail:')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim');
        $email->removeDecorator('Errors');
        
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Пароль:')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim');
        $password->removeDecorator('Errors');
        
        $password_repeat = new Zend_Form_Element_Password('password_repeat');
        $password_repeat->setLabel('Повторите пароль:')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim');
        $password_repeat->removeDecorator('Errors');
        
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Имя:')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim');
        $username->removeDecorator('Errors');
        
       
//        $email->addDecorator('HtmlTag', array('tag' => 'div' ));
//        $password->addDecorator('HtmlTag', array('tag' => 'div'));
//        $password_repeat->addDecorator('HtmlTag', array('tag' => 'div'));
//        $username->addDecorator('HtmlTag', array('tag' => 'div')); 
                
        
        $email->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        
        $password->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        
        $password_repeat->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        
        $username->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        //$description->addDecorator('HtmlTag', array('tag' => 'div', 'class' => 'authors_list','openOnly' => 'true',  'placement' => Zend_Form_Decorator_Abstract::APPEND,));
        //$author_fname->addDecorator('HtmlTag', array('tag' => 'div', 'closeOnly' => 'true', ));
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Save')
                ->setOptions(array('class' => 'add_button'));
        
       
        
        $this->addElements(
                array($email, $password, $password_repeat, $username)
                );
       
        $this->addElements(
                array($submit)
                );
             
        
        
        
    }
    
    
}

?>
