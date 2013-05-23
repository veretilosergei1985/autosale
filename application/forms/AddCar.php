<?php

class Application_Form_AddCar extends Zend_Form
{
    public function init(){
     

        $this->setMethod('post');
        $this->setAttrib('class', 'grid grid-span2');
                
//        $this->setDecorators(array(
//                        array('FormErrors', array('markupListEnd' => '', 'markupListStart' => '','markupListItemStart' => '', 'markupListItemEnd' => '')),
//                        array('FormElements'),
//                        array('Form')
//                    ));
        
        $cat_id = new Zend_Form_Element_Hidden('cat_id');
        
        $region = new Zend_Form_Element_Select('region', array());
        $region->setLabel("Регион:<ins>*</ins>");
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
        
        $region->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));       
                       
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
                array($cat_id, $region)
                );
 
        
         $this->addElement(
                'note', 
                'link1', 
                array('value' => '<div class="rows type-cars">
                                        <label class="label" for="transpottype__addcars"> Тип транспорта: </label>
                                            <div class="select">
                                                <div class="choice-type-cars span3">
                                                    <div class="selector">
                                                        <a id="selecttranspottype__addcars" class="select-ed" href="javascript:void(0);">
                                                            <i id="selectedtypeicon__addcars" class="icon-head-all"></i>
                                                            <span id="selectedtypetext__addcars"> Все </span>
                                                        </a>
                                                    <div id="transpottype__addcars" class="optgroup" style="display: none;">
                                                        <a id="category0__addcars" class="item bold" href="javascript:void(0);" category_id="0">
                                                        <i class="icon-head-all"></i>
                                                        Все
                                                        </a>
                                                        <a id="category1__addcars" class="item" href="javascript:void(0);" category_id="1">
                                                        <i class="icon-head-cars"></i>
                                                        Легковые
                                                        </a>
                                                        <a id="category2__addcars" class="item" href="javascript:void(0);" category_id="2">
                                                        <i class="icon-head-moto"></i>
                                                        Мото
                                                        </a>
                                                        <a id="category3__addcars" class="item" href="javascript:void(0);" category_id="3">
                                                        <i class="icon-head-water"></i>
                                                        Водный транспорт
                                                        </a>
                                                        <a id="category4__addcars" class="item" href="javascript:void(0);" category_id="4">
                                                        <i class="icon-head-spectex"></i>
                                                        Спецтехника
                                                        </a>
                                                        <a id="category5__addcars" class="item" href="javascript:void(0);" category_id="5">
                                                        <i class="icon-head-trailers"></i>
                                                        Прицепы
                                                        </a>
                                                        <a id="category6__addcars" class="item" href="javascript:void(0);" category_id="6">
                                                        <i class="icon-head-trucks"></i>
                                                        Грузовики
                                                        </a>
                                                        <a id="category7__addcars" class="item" href="javascript:void(0);" category_id="7">
                                                        <i class="icon-head-autobus"></i>
                                                        Автобусы
                                                        </a>
                                                        <a id="category8__addcars" class="item" href="javascript:void(0);" category_id="8">
                                                        <i class="icon-head-autohome"></i>
                                                        Автодома
                                                        </a>
                                                        <a id="category9__addcars" class="item" href="javascript:void(0);" category_id="9">
                                                        <i class="icon-head-air"></i>
                                                        Воздушный транспорт
                                                        </a>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>', 
                      'decorators' => array(
                          //array('HtmlTag', array('tag' => 'div', 'class' => 'rows')),
                       )
                    )
               );
         
          $this->addElement(
                'note', 
                'link2', 
                array('value' => '<div class="rows bodystyle">
                                    <label class="label" title="Нажмите, чтоб указать этот Тип кузова" for="choosebodystyle__addcars"> Тип кузова: </label>
                                        <div id="replacedelement__addcars" class="select">
                                            <span class="element-select">
                                            <a id="choosebodystyle__addcars" class="selected" href="javascript:void(0);">Выбрать</a>
                                            </span>
                                        </div>
                                  </div>', 
                      'decorators' => array(
                          //array('HtmlTag', array('tag' => 'div', 'class' => 'rows')),
                       )
                    )
               );
         
         $this->addElements(
                array($email, $password)
                );
               
        
        $this->addElements(
                array($submit)
                );
    
       
            
        
    }
}

?>
