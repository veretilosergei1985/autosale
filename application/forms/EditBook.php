<?php

class Application_Form_EditBook extends Zend_Form
{
    
    protected $_authors;
    protected $_inputs = array();
    
    public function __construct($options = null, $authors = null)
    {
        $this->_authors = $authors;
        parent::__construct($options);

    }
    
    
    public function init(){
       
      
        $this->setAction('/catalog/edit')->setMethod('post')->removeDecorator('HtmlTag');
        $this->setDecorators(array(
                                array('FormErrors', array('markupListItemStart' => '', 'markupListItemEnd' => '')),
                                array('FormElements'),
                                array('Form')
                            ));
                
        $id = new Zend_Form_Element_Hidden('id');

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
         
        $this->addElements(array($title, $description, $id));
        $this->addElement('note', 'add_author_from_edit', array(
            'value' => '<a href="#" id="add_author_from_edit">Add Author</a>'
        ));
                
        foreach($this->_authors as $i => $author){
           
            ${"author_fname".$i} = new Zend_Form_Element_Text('full_name');
            ${"author_fname".$i}->setLabel('Author Name:')
                    //->setRequired(true)
                    //->addValidator('NotEmpty', true)
                    ->setValue($author['full_name'])
                    ->setIsArray(true);
            ${"author_id".$i} = new Zend_Form_Element_Hidden('author_id');
            ${"author_id".$i}->setIsArray(true)->setValue($author['id']);
           
            ${"author_fname".$i}->setDecorators( array(
                                                        'Errors',
                                                        'ViewHelper',
                                                        array( array( 'wrapperField' => 'HtmlTag' ), array( 'tag' => 'div', 'class' => 'input' ) ),
                                                        array( 'Label', array( 'placement' => 'prepend' ) ),
                                                        array( array( 'wrapperAll' => 'HtmlTag' ), array( 'tag' => 'div', 'class' => 'authors_list author_block_'.$author['id'] ) ),
                                                ) );
            ${"author_fname".$i}->removeDecorator('Errors');

            $this->addElement('note', 'add_author'.$i, array(
                                                            'value' => "<a href='/catalog/delauthor' class='del_author_from_edit' rel='".$author['id']."'></a>"
                                                        ));
            
            $this->addElement(${"author_fname".$i}, 'el_'.$i);
            $this->addElement(${"author_id".$i}, 'hidden_'.$i);

        }

                
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Save')
                ->setOptions(array('class' => 'add_button'))
                ->setDecorators( array(
                                    'ViewHelper',
                                    array( array( 'wrapperAll' => 'HtmlTag' ), array( 'tag' => 'div', 'class' => 'button_edit_block' ) ),
                            ) );
            
       
        $this->addElements(
                array($submit)
                );
             
        
        
        
    }
    
    
}

?>
