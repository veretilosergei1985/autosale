<?php

class Application_Form_CarRegister extends Zend_Form
{
    public function init(){
     

        $this->setMethod('post');
        $this->setAction('/display/checkaddcar');
        $this->setAttrib('class', 'grid grid-span2 reg_form');
                
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
                ->addValidator('Db_NoRecordExists', false, array(
				'table' => 'users',
				'field' => 'email'
                               ))
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'span3');
        
        $email->getValidator('Db_NoRecordExists')->setMessages(array(
            'recordFound' => html_entity_decode('Уже зарегистрирован. Вы можете <a href="/login.html">Войти</a> или <a href="/user/forgot_password.html">Восстановить пароль</a>')
        ));
        
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
        
        $password_repeat = new Zend_Form_Element_Password('password_repeat');
        $password_repeat->setLabel('Повторите пароль<ins>*</ins>:')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addValidator('stringLength', false, array(4, 12))
                ->addPrefixPath('Base_Validator', 'Base/Validator', 'validate')		
                                ->addValidator('Passwordconfirm')
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'span3');
        $password_repeat->removeDecorator('Errors');
        
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Имя:<ins>*</ins>')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addValidator('stringLength', false, array(4, 24))
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'span3');
        $username->removeDecorator('Errors');
        
        $code = new Zend_Form_Element_Text('code');
        $code->setLabel("Код:<ins>*</ins>")
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addValidator('stringLength', false, array(3, 3))
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'code')
                ->setAttrib('placeholder', 'XXX');
        $code->getDecorator('Label')->setOptions(array('class' => 'other'));        
        $code->removeDecorator('Errors');
        
        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel("Телефон:<ins>*</ins>")
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addValidator('stringLength', false, array(7, 7))
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'number')
                ->setAttrib('placeholder', 'XX-XX-XXX');
                
        $phone->removeDecorator('Errors');
        $phone->getDecorator('Label')->setOptions(array('class' => 'other')); 
          
        
        $subscribe = new Zend_Form_Element_Checkbox('subscribe', array('disableLoadDefaultDecorators' => true, 'required' => false));
        $subscribe->setDecorators(
                array(
                        'ViewHelper',
                        array('Description', array('escape' => false, 'tag' => 'span', 'class' => 'sub')), //escape false because I want html output
                        array(array('w' => 'HtmlTag'), array('tag' => 'div', 'class' => 'indent reg_car_pad'))
                )
        )->setDescription("Получать рассылки про обновления, акции, конкурсы");
        $subscribe->setAttrib('checked', true); 
        
        $agreement = new Zend_Form_Element_Checkbox('agreement', array('disableLoadDefaultDecorators' => true, 'required' => false));
        $agreement->setDecorators(
                array(
                        'ViewHelper',
                        array('Description', array('escape' => false, 'tag' => 'span', 'class' => 'sub')), //escape false because I want html output
                        array(array('w' => 'HtmlTag'), array('tag' => 'div', 'class' => 'indent reg_car_pad'))
                )
        )->setDescription('Я принимаю условия, изложенные в "<a target="_blank" href="/?target=view&event=lic">Соглашении о предоставлении услуг</a>
                          " и "<a target="_blank" href="/privacy-policy/">Политике конфиденциальности</a>"');
        $agreement->setAttrib('checked', true); 
        
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
            array('HtmlTag', array('tag' => 'div', 'class' => '', 'openOnly' => 'true',) ),
            array('Label', array('class' => 'label no_wisible_label', 'escape' => false)),
            array('Description', array('placement' => Zend_Form_Decorator_Abstract::PREPEND, 'tag' => 'em'))
            //array('Callback', array('callback' => function() { return '$'; }, 'placement' => 'PREPEND')),
            //array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        
        $phone->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'closeOnly' => 'true')),
            array('Label', array('class' => 'label code_padding', 'escape' => false)),
        ));
       
                      
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setOptions(array('class' => 'button green'));
        $submit->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'submit-form-add indent')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        $submit->setLabel('Зарегистрироваться');
      

        
               
        $this->addElements(
                array($email, $password, $password_repeat, $username, $code, $phone, $subscribe, $agreement)
                );
       
        $this->addElements(
                array($submit)
                );
       
       
    }
}

?>
