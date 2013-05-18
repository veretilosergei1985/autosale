<?php

class Application_Form_Register extends Zend_Form
{
    public function init(){
     

        $this->setMethod('post');
        $this->setAttrib('class', 'grid grid-span1');
                
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
        
        $region = new Zend_Form_Element_Select('region', array());
        $region->setLabel("Область:<ins>*</ins>");
        $region->addMultiOptions(array('' => 'Выберите'));
        //
        $oRegion = new Application_Model_Regions();
        foreach ($oRegion->fetchAll() as $reg) {
            $region->addMultiOption($reg->id, $reg->name);
        }
        //
        $region->setAttrib('class', 'span3');
                
        $region->removeDecorator('Errors');
        $region->setRequired(true)
                ->addValidator('NotEmpty',true)
                ->setRegisterInArrayValidator(false);
        
        $city = new Zend_Form_Element_Select('city', array());
        $city->setLabel("Город:<ins>*</ins>");
        $city->addMultiOptions(array('' => 'Выберите'));
        $city->setAttrib('class', 'span3');
                
        $city->removeDecorator('Errors');
        $city->setRequired(true)
             ->addValidator('NotEmpty',true)
                ->setRegisterInArrayValidator(false);
        
//        $flashMessenger = $this->getHelper('FlashMessenger');
//        if($flashMessenger->getMessages()){
//            echo $this->_helper->flashMessenger->getMessages(); exit;
//            $city->setValue();
//        }
        if(!empty($_SESSION['city'])){
             $city->setValue($_SESSION['city']); 
        } 
        
       
        $news_letters = new Zend_Form_Element_Checkbox('news_letters', array('disableLoadDefaultDecorators' => true, 'required' => false));
        $news_letters->setDecorators(
                array(
                        'ViewHelper',
                        array('Description', array('escape' => false, 'tag' => 'span', 'class' => 'sub')), //escape false because I want html output
                        array(array('w' => 'HtmlTag'), array('tag' => 'div', 'class' => 'indent'))
                )
        )->setDescription("Разрешить контактировать со мной через e-mail");
        $news_letters->setAttrib('checked', true); 
        
        $subscribe = new Zend_Form_Element_Checkbox('subscribe', array('disableLoadDefaultDecorators' => true, 'required' => false));
        $subscribe->setDecorators(
                array(
                        'ViewHelper',
                        array('Description', array('escape' => false, 'tag' => 'span', 'class' => 'sub')), //escape false because I want html output
                        array(array('w' => 'HtmlTag'), array('tag' => 'div', 'class' => 'indent'))
                )
        )->setDescription("Получать рассылки про обновления, акции, конкурсы");
        $subscribe->setAttrib('checked', true); 
        
        $agreement = new Zend_Form_Element_Checkbox('agreement', array('disableLoadDefaultDecorators' => true, 'required' => false));
        $agreement->setDecorators(
                array(
                        'ViewHelper',
                        array('Description', array('escape' => false, 'tag' => 'span', 'class' => 'sub')), //escape false because I want html output
                        array(array('w' => 'HtmlTag'), array('tag' => 'div', 'class' => 'indent'))
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
        $submit->setOptions(array('class' => 'button large green'));
        $submit->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        $submit->setLabel('Зарегистрироваться');
      

        
               
        $this->addElements(
                array($email, $password, $password_repeat, $username, $code, $phone, $region, $city, $news_letters, $subscribe, $agreement)
                );
       
        $this->addElements(
                array($submit)
                );
        $this->addElement(
                'note', 
                'login_link', 
                array('value' => '<div class="sub indent">Уже регистрировались?<a title="Войдите" href="/login.html">Войдите»</a></div>', 
                      'decorators' => array(
                          //array('HtmlTag', array('tag' => 'div')),
                       )
                    )
               );
        $this->addElement('note','hr', array('value' => '<div class="hr"></div>'));
        $this->addElement('note', 'help_block', array('value' => '<div class="boxed">
                                                                    <p class="rows bold float-l" style="width:210px">
                                                                        Возникли вопросы?<br>
                                                                        <a title="" href="/question/login/0/">Служба поддержки</a>:
                                                                    </p>
                                                                    <div class="list-phone indent">
                                                                        <p class="phone">
                                                                            <i class="icon-phone"></i>
                                                                                (067) 469-04-10<br>
                                                                            <i class="icon-phone"></i>
                                                                                0-800-21-00-12
                                                                        </p>
                                                                    </div>
                                                                  </div>'
                        ));
        
    }
}

?>
