<?php

class Application_Form_CarLogin extends Zend_Form
{
    public function init(){
     

        $this->setMethod('post');
        $this->setAttrib('class', 'grid grid-span2 log_form');
                
//        $this->setDecorators(array(
//                        array('FormErrors', array('markupListEnd' => '', 'markupListStart' => '','markupListItemStart' => '', 'markupListItemEnd' => '')),
//                        array('FormElements'),
//                        array('Form')
//                    ));

        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel("E-mail:<ins>*</ins>")
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addValidator('EmailAddress')
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'span3');
        

        
        $email->removeDecorator('Errors');
        
        
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Пароль:<ins>*</ins>')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addValidator('stringLength', false, array(4, 12))
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'span3');
        $password->removeDecorator('Errors');
                               
        
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
            array('Description', array('escape' => false, 'tag' => 'span', 'class' => 'sub')),
        ))->setDescription("<br><a class='sub' href='/user/forgotpassword'> Забыли пароль? </a>");
        
               
                       
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setOptions(array('class' => 'button  large green car_log_submit'));
        $submit->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows submit-form-add')),
        ));
        $submit->setLabel('Войти');
        
        $this->addElements(
                array($email, $password)
                );
               
        
        $this->addElements(
                array($submit)
                );
        
         $this->addElement(
                'note', 
                'link1', 
                array('value' => '<div class="rows">
                            <p class="indent help-block" partner_id="1">
                            Ваш e-mail и пароль едины для любого из проектов
                            <a href="http://www.ria.ua">RIA.ua</a>
                            </p>
                            </div>', 
                      'decorators' => array(
                          //array('HtmlTag', array('tag' => 'div', 'class' => 'rows')),
                       )
                    )
               );
         
         
         $this->addElement(
                'note', 
                'link2', 
                array('value' => '<div class="rows">
                                    <p class="indent help-block">
                                    Рекомендуем:
                                    <a href="http://bezpeka.ria.ua/ru/account-security">Безопасность учетной записи RIA.ua </a>
                                    </p>
                                    </div>', 
                      'decorators' => array(
                          //array('HtmlTag', array('tag' => 'div', 'class' => 'rows')),
                       )
                    )
               );
       
            
        
    }
}

?>
