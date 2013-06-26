<?php

class Application_Form_AddCarPublication extends Zend_Form
{
    protected  $_simple_price;


    public function __construct($price) {
        $this->_simple_price = $price;
        parent::__construct();
    }
    
    public function init(){
     

        $this->setMethod('post');
        $this->setAttrib('id','publicationform__addcars');
        $this->setAttrib('class', 'grid grid-span2');
                
        $this->setDecorators(array(
                        array('FormErrors', array('markupListEnd' => '', 'markupListStart' => '','markupListItemStart' => '', 'markupListItemEnd' => '')),
                        array('FormElements'),
                        array('Form')
                    ));
        
       
        $simple_price = new Zend_Form_Element_Hidden('simple_price');
        $simple_price->setAttrib('id', 'simple_price');
        $simple_price->setValue($this->_simple_price);
              
        $publish_period = new Zend_Form_Element_Select('publish_period', array());
        $publish_period->addMultiOption('1', '1 месяц (бесплатно)');
        $publish_period->addMultiOption('2', '2 месяца (бесплатно)');
        $publish_period->addMultiOption('3', '3 месяца (бесплатно)');
        
        $publish_period->setAttrib('class', 'span2');
        $publish_period->setAttrib('id', 'publish_period');
        $publish_period->removeDecorator('Errors');
              
        $chk_activate = new Zend_Form_Element_Checkbox('chk_activate', array('disableLoadDefaultDecorators' => true, 'required' => false));
        $chk_activate->setDecorators(
                array(
                        'ViewHelper',
                        array('Description', array('escape' => false, 'tag' => 'span')), //escape false because I want html output
                        array(array('w' => 'HtmlTag'), array('tag' => 'span'))
                )
        )->setDescription(" Настроить <strong>повторную публикацию</strong>: ");
                
        $on_republ_reset_comments =  new Zend_Form_Element_Checkbox('on_republ_reset_comments', array('disableLoadDefaultDecorators' => true, 'required' => false));
        $on_republ_reset_comments->setDecorators(
                array(
                        'ViewHelper',
                        array('Description', array('escape' => false, 'tag' => 'span')), //escape false because I want html output
                        array(array('w' => 'HtmlTag'), array('tag' => 'div', 'class' => 'item'))
                )
        )->setDescription(" Удалять торги, обмены, комментарии после повторной публикации");
        $on_republ_reset_comments->setAttrib('checked', true);
        
        $on_republ_reset_counters =  new Zend_Form_Element_Checkbox('on_republ_reset_counters', array('disableLoadDefaultDecorators' => true, 'required' => false));
        $on_republ_reset_counters->setDecorators(
                array(
                        'ViewHelper',
                        array('Description', array('escape' => false, 'tag' => 'span')), //escape false because I want html output
                        array(array('w' => 'HtmlTag'), array('tag' => 'div', 'class' => 'item'))
                )
        )->setDescription(" Удалять информацию о количестве просмотров после повторной публикации");
        $on_republ_reset_counters->setAttrib('checked', true);
        
        $on_republ_reset_messages_stat =  new Zend_Form_Element_Checkbox('on_republ_reset_messages_stat', array('disableLoadDefaultDecorators' => true, 'required' => false));
        $on_republ_reset_messages_stat->setDecorators(
                array(
                        'ViewHelper',
                        array('Description', array('escape' => false, 'tag' => 'span')), //escape false because I want html output
                        array(array('w' => 'HtmlTag'), array('tag' => 'div', 'class' => 'item'))
                )
        )->setDescription(" Обнулять статистику полученных сообщений");
        
        $save_app_attr_for_user = new Zend_Form_Element_Checkbox('save_app_attr_for_user', array('disableLoadDefaultDecorators' => true, 'required' => false));
        $save_app_attr_for_user->setDecorators(
                array(
                        'ViewHelper',
                        array('Description', array('escape' => false, 'tag' => 'span')), //escape false because I want html output
                        array(array('w' => 'HtmlTag'), array('tag' => 'div', 'class' => 'item'))
                )
        )->setDescription("Предлагать эти настройки при публикации новых объявлений");
                       
        $submit = new Zend_Form_Element_Submit('publication_submit');
        $submit->setOptions(array('class' => 'button green'));
        $submit->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div')),
        ));
        $submit->getDecorator('description')->setOption('escape',false); 
        $submit->setLabel('Опубликовать объявление');
        
        $this->addElements(
                array($publish_period, $simple_price, $chk_activate, $on_republ_reset_comments, $on_republ_reset_counters, $on_republ_reset_messages_stat, $save_app_attr_for_user)
                );
 
            
        $this->addElements(
                array($submit)
                );
    
       
            
        
    }
}

?>
