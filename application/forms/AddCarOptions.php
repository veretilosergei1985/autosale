<?php

class Application_Form_AddCarOptions extends Zend_Form
{
    public function init(){
     

        $this->setMethod('post');
        $this->setAttrib('id','optionsform__addcars');
                
        $this->setDecorators(array(
                        array('FormErrors', array('markupListEnd' => '', 'markupListStart' => '','markupListItemStart' => '', 'markupListItemEnd' => '')),
                        array('FormElements'),
                        array('Form')
                    ));
        
       
        $safety = new Zend_Form_Element_MultiCheckbox('safety', array(
            'multiOptions' => array(
                '1' => 'ABD',
                '2' => 'ABS',
                '3' => 'ESP',
                '4' => 'Галогенные фары',
                '5' => 'Замок на КПП',
                '6' => 'Иммобилайзер',
                '7' => 'Пневмоподвеска',
                '8' => 'Подушка безопасности (Airbag)',
                '9' => 'Серворуль',
                '10' => 'Сигнализация',
                '11' => 'Центральный замок',
               
            )
        ));
        //$safety->setSeparator(PHP_EOL);

        $comfort = new Zend_Form_Element_MultiCheckbox('comfort', array(
            'multiOptions' => array(
                '1' => 'Бортовой компьютер',
                '2' => 'Датчик света',
                '3' => 'Климат контроль',
                '4' => 'Кожаный салон',
                '5' => 'Кондиционер',
                '6' => 'Круиз контроль',
                '7' => 'Люк',
                '8' => 'Мультируль',
                '9' => 'Омыватель фар',
                '10' => 'Парктроник',
                '11' => 'Подогрев зеркал',
                '12' => 'Подогрев сидений',
                '13' => 'Сенсор дождя',
                '14' => 'Усилитель руля',
                '15' => 'Эл. стеклоподъемники',
                '16' => 'Электропакет',
               
            )
        ));
        
        $multimedia = new Zend_Form_Element_MultiCheckbox('multimedia', array(
            'multiOptions' => array(
                '1' => 'CD',
                '2' => 'DVD',
                '3' => 'MP3',
                '4' => 'Акустика',
                '5' => 'Магнитола',
                '6' => 'Сабвуфер',
                '7' => 'Система навигации GPS '
               
            )
        ));
        
        $other = new Zend_Form_Element_MultiCheckbox('other', array(
            'multiOptions' => array(
                '1' => 'Газовая установка (ГБО)',
                '2' => 'Дерево',
                '3' => 'Длинная база',
                '4' => 'Кузов MAXI',
                '5' => 'Правый руль',
                '6' => 'Тонирование стекол',
                '7' => 'Тюнинг',
                '8' => 'Фаркоп'
            )
        ));
        
        $state = new Zend_Form_Element_MultiCheckbox('state', array(
            'multiOptions' => array(
                '1' => 'Гаражное хранение',
                '2' => 'Не бит',
                '3' => 'Не крашен',
                '4' => 'Первая регистрация',
                '5' => 'Первый владелец',
                '6' => 'Ручное управление',
                '7' => 'Сервисная книжка',
                '8' => 'Нерастаможенный',
                '9' => 'После ДТП',
                '10' => 'Не на ходу',
                '11' => 'Взято в кредит',
                '12' => 'Автоконфискат',
                '13' => 'Пригнан из'
               
            )
        ));
       
        $country = new Zend_Form_Element_Select('country', array());
       
        $country->addMultiOptions(array('' => 'Выберите страну'));
        $country->addMultiOption("40", "Австрия");
        $country->addMultiOption("826", "Англия");
        $country->addMultiOption("112", "Беларусь");
        $country->addMultiOption("56", "Бельгия");
        $country->addMultiOption("100", "Болгария");
        $country->addMultiOption("76", "Бразилия");
        $country->addMultiOption("348", "Венгрия");
        $country->addMultiOption("276", "Германия");
        $country->addMultiOption("208", "Дания");
        $country->addMultiOption("356", "Индия");
        $country->addMultiOption("364", "Иран");
        $country->addMultiOption("724", "Испания");
        $country->addMultiOption("380", "Италия");
        $country->addMultiOption("398", "Казахстан");
        $country->addMultiOption("124", "Канада");
        $country->addMultiOption("158", "Китай");
        $country->addMultiOption("408", "Корея");
        $country->addMultiOption("428", "Латвия");
        $country->addMultiOption("440", "Литва");
        $country->addMultiOption("458", "Малайзия");
        $country->addMultiOption("528", "Нидерланды");
        $country->addMultiOption("578", "Норвегия");
        $country->addMultiOption("616", "Польша");
        $country->addMultiOption("643", "Россия");
        $country->addMultiOption("642", "Румыния");
        $country->addMultiOption("688", "Сербия");
        $country->addMultiOption("703", "Словакия");
        $country->addMultiOption("705", "Словения");
        $country->addMultiOption("850", "США");
        $country->addMultiOption("792", "Турция");
        $country->addMultiOption("804", "Украина");
        $country->addMultiOption("246", "Финляндия");
        $country->addMultiOption("250", "Франция");
        $country->addMultiOption("203", "Чехия");
        $country->addMultiOption("752", "Швеция");
        $country->addMultiOption("392", "Япония");
        
        $country->setAttrib('id', 'matchedCarCountry');
        $country->setAttrib('style', 'display: none');
        $country->setAttrib('disabled', 'disabled');
        $country->removeDecorator('Errors');
        
        
        $dont_comment = new Zend_Form_Element_Checkbox('enable_comment', array('disableLoadDefaultDecorators' => true, 'required' => false));
        $dont_comment->setDecorators(
                array(
                        'ViewHelper',
                        array('Description', array('escape' => false, 'tag' => 'span', 'class' => 'sub')), //escape false because I want html output
                        array(array('w' => 'HtmlTag'), array('tag' => 'div', 'class' => 'indent'))
                )
        )->setDescription("Разрешить комментирование объявления");
        $dont_comment->setAttrib('checked', true); 
        
        $send_comments = new Zend_Form_Element_Checkbox('send_comments', array('disableLoadDefaultDecorators' => true, 'required' => false));
        $send_comments->setDecorators(
                array(
                        'ViewHelper',
                        array('Description', array('escape' => false, 'tag' => 'span', 'class' => 'sub')), //escape false because I want html output
                        array(array('w' => 'HtmlTag'), array('tag' => 'div', 'class' => 'indent'))
                )
        )->setDescription("Присылать мне комментарии на E-mail для проверки");
        $send_comments->setAttrib('checked', true); 
        
        $desc = new Zend_Form_Element_Textarea('description');
        $desc->setAttrib('id', 'description__addcars')
            ->setAttrib('cols', '80')
            ->setAttrib('rows', '6')
            ->setAttrib('maxlength', '1024');
        
                       
        $submit = new Zend_Form_Element_Submit('options_submit');
        $submit->setOptions(array('class' => 'button green'));
        $submit->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows submit-form-add')),
        ));
        $submit->getDecorator('description')->setOption('escape',false); 
        $submit->setLabel('Далее');
        
        $this->addElements(
                array($safety, $comfort, $multimedia, $state, $other, $country, $dont_comment, $send_comments, $desc)
                );
 
            
        $this->addElements(
                array($submit)
                );
    
       
            
        
    }
}

?>
