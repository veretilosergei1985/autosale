<?php

class Application_Form_Catalog extends Zend_Form
{
    public function init(){
       
               
        $this->setAction('/catalog/add')->setMethod('post');
        $this->setDecorators(array(
                                array('FormErrors', array('markupListItemStart' => '', 'markupListItemEnd' => '')),
                                array('FormElements'),
                                array('Form')
                            ));
        
        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Book title:')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addValidator(new Zend_Validate_StringLength(2, 255), true)
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim');
        $title->removeDecorator('Errors');
        
        $description = new Zend_Form_Element_Textarea('description');
        $description->setLabel('Description:')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim');
        $description->removeDecorator('Errors');
        
        $author_fname = new Zend_Form_Element_Text('full_name', array('isArray' => true));
        $author_fname->setLabel('Author Name:')
                //->setRequired(true)
                //->addValidator('NotEmpty', true)
                ;
        $author_fname->removeDecorator('Errors');
        
        $author_fname->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span')),
            array('Label', array('tag' => 'span')),
        ));
           
                
        $description->addDecorator('HtmlTag', array('tag' => 'div', 'class' => 'authors_list','openOnly' => 'true',  'placement' => Zend_Form_Decorator_Abstract::APPEND,));
        $author_fname->addDecorator('HtmlTag', array('tag' => 'div', 'closeOnly' => 'true', ));
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Save')
                ->setOptions(array('class' => 'add_button'));
        
       
        
        $this->addElements(
                array($title, $description, $author_fname)
                );
        $this->addElement('note', 'add_author', array(
            'value' => '<a href="#" id="add_author">Add Author</a>'
        ));
        $this->addElements(
                array($submit)
                );
             
        
        
        
    }
    
    
}

?>
