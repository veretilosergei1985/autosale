<?php

class Application_Form_AddCarPhoto extends Zend_Form
{
    public function init(){
     

        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        //$this->setAction("/display/olduploadcarphoto");
                
        $this->setDecorators(array(
                        array('FormErrors', array('markupListEnd' => '', 'markupListStart' => '','markupListItemStart' => '', 'markupListItemEnd' => '')),
                        array('FormElements'),
                        array('Form')
                    ));
        

        
        $photo = new Zend_Form_Element_File('photo');
        $photo//->setDestination('images/photos/')
            ->setRequired(true)
            ->addValidator('Extension', false, 'jpg,png,gif');
            //->addValidator('MimeType', false, array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png'))
            //->addValidator('ImageSize', false, array('maxwidth' => 700, 'maxheight' => 700));
        
                
        //////////////////////////////////////////////
        
       $this->setElementDecorators(array(
            'File',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'span')),
            array('Label', array('tag' => 'span')),
            array(array('row' => 'HtmlTag'), array('tag' => 'span'))
      ));
        
                   
        $submit = new Zend_Form_Element_Submit('photo_submit');
        $submit->setOptions(array('class' => 'button green'));
        $submit->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div')),
        ));
        $submit->getDecorator('description')->setOption('escape',false); 
        $submit->setLabel('Добавить фото');
        
        
        
        $this->addElements(array($photo, $submit));
    
       
            
        
    }
}

?>
