<?php

class Application_Form_Login extends Zend_Form
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
        ))->setDescription("<a class='sub' href='/user/forgotpassword'> Забыли пароль? </a>");
        
        $remember = new Zend_Form_Element_Checkbox('remember', array('disableLoadDefaultDecorators' => true, 'required' => false));
        $remember->setDecorators(
                array(
                        'ViewHelper',
                        array('Description', array('escape' => false, 'tag' => 'span', 'class' => 'sub')), //escape false because I want html output
                        array(array('w' => 'HtmlTag'), array('tag' => 'div', 'class' => 'indent'))
                )
        )->setDescription("Запомнить мои данные на этом компьютере ");
        $remember->setAttrib('checked', true); 
        
                       
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setOptions(array('class' => 'button  large green'));
        $submit->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows submit-form-add')),
        ));
        $submit->setLabel('Войти');
        
        $this->addElements(
                array($email, $password,$remember)
                );
        
        $this->addElement(
                'note', 
                'bezpeka', 
                array('value' => '<p class="item bezpeka_link">
                                    <i class="icon-bezpeka"></i>
                                        <a class="sub" target="blank" href="http://bezpeka.ria.ua/ru/account-security/"> Безопасность учетной записи Ria.ua </a>
                                  </p>', 
                      'decorators' => array(
                          //array('HtmlTag', array('tag' => 'div')),
                       )
                    )
               )->removeDecorator('HtmlTag');;
        
        $this->addElements(
                array($submit)
                );
       
         
        
       
        $this->addElement(
                'note', 
                'login_link', 
                array('value' => '<div class="sub" style="padding-left: 80px;">
                                        Впервые на AUTO.ria.ua?<br>
                                        <a title="Зарегистрируйтесь" href="/user/register"> Зарегистрируйтесь» </a>
                                  </div>', 
                      'decorators' => array(
                          //array('HtmlTag', array('tag' => 'div')),
                       )
                    )
               );
        $this->addElement('note','hr', array('value' => '<div class="hr"></div>'));
        $this->addElement('note', 'help_block', array('value' => '<div class="delimeter">
                                                                    <p class="rows bold">
                                                                        Возникли вопросы?
                                                                        <a title="" href="/question/login/0"> Служба поддержки: </a>
                                                                    </p>
                                                                    <div class="list-phone indent">
                                                                        <p class="phone">
                                                                            <i class="icon-phone"></i>
                                                                                (067) 469-04-10
                                                                        </p>
                                                                        <p class="phone ">
                                                                                <i class="icon-phone"></i>
                                                                                    0-800-21-00-12
                                                                        </p>
                                                                        <p class="phone ">
                                                                            <i class="icon-phone"></i>
                                                                                (0432) 555-213
                                                                        </p>
                                                                      </div>
                                                                    </div>
                                                                    <p class="rows bold"> Присоединиться к нам в социальных сетях: </p>
                                                                    <div class="indent">
                                                                        <div class="social-network ">
                                                                            <a class="item-social" title="вконтакте" href="http://vkontakte.ru/auto_ria_ua" target="_blank">
                                                                                <i class="icon-social-vkontakte"></i>
                                                                                вконтакте
                                                                            </a>
                                                                            <a class="item-social" title="Facebook" href="http://www.facebook.com/AUTO.ria.ua" target="_blank">
                                                                                <i class="icon-social-facebook"></i>
                                                                                facebook
                                                                            </a>
                                                                            <a class="item-social" title="Twitter" href="http://twitter.com/auto_ria_ua" target="_blank">
                                                                                <i class="icon-social-twitter"></i>
                                                                                twitter
                                                                            </a>
                                                                            <a class="item-social" title="google+" href="https://plus.google.com/110464453590594722256/posts" target="_blank">
                                                                                <i class="icon-social-google-plus"></i>
                                                                                google+
                                                                            </a>
                                                                        </div>
                                                                    </div>'
                        ));
        
    }
}

?>
