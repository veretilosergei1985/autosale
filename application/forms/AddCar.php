<?php

class Application_Form_AddCar extends Zend_Form
{
    public function init(){
     

        $this->setMethod('post');
        $this->setAttrib('class', 'grid grid-span2 add_car_form');
        $this->setAttrib('position','relative');
                
        $this->setDecorators(array(
                        array('FormErrors', array('markupListEnd' => '', 'markupListStart' => '','markupListItemStart' => '', 'markupListItemEnd' => '')),
                        array('FormElements'),
                        array('Form')
                    ));
        
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

                //$region->removeDecorator('Errors');
                $region->setRequired(true)
                        ->addValidator('NotEmpty',true)
                        ->setRegisterInArrayValidator(false);
        
        
        $mark = new Zend_Form_Element_Select('mark', array());
        $mark->setLabel("Марка:<ins>*</ins>");
        $mark->addMultiOptions(array('' => 'Выберите'));
        //
        $oMark = new Application_Model_Marks();
        foreach ($oMark->fetchAll() as $item) {
            $mark->addMultiOption($item->id, $item->name);
        }
        //      
        $mark->setAttrib('class', 'span3');
                
        //$mark->removeDecorator('Errors');
        $mark->setRequired(true)
                ->addValidator('NotEmpty',true)
                ->setRegisterInArrayValidator(false);
        
                $model = new Zend_Form_Element_Select('model', array());
                $model->setLabel("Модель:<ins>*</ins>");
                $model->addMultiOptions(array('' => 'Выберите'));

                $model->setAttrib('class', 'span3');

                //$model->removeDecorator('Errors');
                $model->setRequired(true)
                        ->addValidator('NotEmpty',true)
                        ->setRegisterInArrayValidator(false);
        
        $version = new Zend_Form_Element_Text('version');
        $version->setLabel('Версия:')
                ->setRequired(true)
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim');
        $version->setAttrib('class', 'span3');
        //$version->removeDecorator('Errors');
        
                $vin = new Zend_Form_Element_Text('vin');
                $vin->setLabel('VIN номер:')
                        ->addFilter('HtmlEntities')
                        ->addFilter('StringTrim');
                $vin->setAttrib('class', 'span3');
                //$vin->removeDecorator('Errors');
        
        $transmission = new Zend_Form_Element_Select('transmission', array());
        $transmission->setLabel("Коробка передач:");
        $transmission->addMultiOptions(array('' => 'Выберите'));
        
        $oTransmission = new Application_Model_Transmission();
        foreach ($oTransmission->fetchAll() as $item) {
            $transmission->addMultiOption($item->id, $item->type);
        }
        
        $transmission->setAttrib('class', 'span3');
                
        //$transmission->removeDecorator('Errors');
        $transmission->setRegisterInArrayValidator(false);
        
                $drive = new Zend_Form_Element_Select('drive', array());
                $drive->setLabel("Привод:");
                $drive->addMultiOptions(array('' => 'Выберите'));

                $oDrive = new Application_Model_Drive();
                foreach ($oDrive->fetchAll() as $item) {
                    $drive->addMultiOption($item->id, $item->type);
                }

                $drive->setAttrib('class', 'span3');

                //$drive->removeDecorator('Errors');
                $drive->setRegisterInArrayValidator(false);
        
        $doors = new Zend_Form_Element_Select('doors', array());
        $doors->setLabel("Количество дверей:");
        $doors->addMultiOptions(array('' => 'Выберите'));
                
        for($i = 1; $i <= 5; $i++) {
            $doors->addMultiOption($i, $i);
        }
        $doors->setAttrib('class', 'span2');
        //$doors->removeDecorator('Errors');
        $doors->setRegisterInArrayValidator(false);
        
        
                $fuel = new Zend_Form_Element_Select('fuel', array());
                $fuel->setLabel("Топливо:");
                $fuel->addMultiOptions(array('' => 'Выберите'));

                $oFuel = new Application_Model_Fuel();
                foreach ($oFuel->fetchAll() as $item) {
                    $fuel->addMultiOption($item->id, $item->type);
                }

                $fuel->setAttrib('class', 'span3');

                //$fuel->removeDecorator('Errors');
                $fuel->setRegisterInArrayValidator(false);
                
        $year = new Zend_Form_Element_Select('year', array());
        $year->setLabel("Год выпуска:<ins>*</ins>");
        $year->addMultiOptions(array('' => 'Выберите'));
        
        $cur_year = intval(date('Y'));
        for($i = $cur_year; $i >= 1901; $i--) {
            $year->addMultiOption($i, $i);
        }
        $year->setAttrib('class', 'span2');
        //$year->removeDecorator('Errors');
        $year->setRequired(true)
                        ->addValidator('NotEmpty',true)
                        ->setRegisterInArrayValidator(false);
        

                $race = new Zend_Form_Element_Text('race');
                $race->setLabel("Пробег:<ins>*</ins>")
                        ->setRequired(true)
                        ->addValidator('NotEmpty', true)
                        ->addFilter('HtmlEntities')
                        ->addFilter('StringTrim')
                        ->setAttrib('class', 'span1'); 
                
        $volume = new Zend_Form_Element_Text('volume');
        $volume->setLabel("Объем двигателя:")
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'span1'); 
        
                $price = new Zend_Form_Element_Text('price');
                $price->setLabel("Цена:<ins>*</ins>")
                        ->setRequired(true)
                        ->addValidator('NotEmpty', true)
                        ->addFilter('HtmlEntities')
                        ->addFilter('StringTrim')
                        ->setAttrib('class', 'span2'); 
        
        //////////////////////////////////////////////
        
        $region->setDecorators(array(
            'ViewHelper',
            'Description',
            'FormErrors',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ))->addDecorator('Errors');      
        
        $mark->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ))->addDecorator('Errors');    
        
        $model->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ))->addDecorator('Errors');    
                 
        $version->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        
        $vin->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));
        
         $transmission->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));      
         
        $drive->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));     
        
        $doors->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));    
        
        $fuel->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ));  
        
         $year->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ))->addDecorator('Errors');    
        
        $race->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ))->setDescription('<em class="add-on">тыс.км</em>');
        $race->getDecorator('description')->setOption('escape',  
        false); 
        $race->addDecorator('Errors');
        
        $volume->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ))->setDescription('<em class="add-on">л.</em> <a id="specifypower__addcars" href="javascript:void(0);">Указать мощность</a>
                            <span id="powerblock__addcars" class="add-power span2" style="display: none;">
                                <input id="power__addcars" class="span1" type="text" value="" name="power">
                                <select id="powername__addcars" class="currency" name="powerName">
                                    <option selected="selected" label="л. с." value="1">л. с.</option>
                                    <option label="кВт" value="2">кВт</option>
                                </select>
                            </span>');
        $volume->getDecorator('description')->setOption('escape',  
        false); 
        
        $price->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ))->setDescription('<select style="margin-left: 10px;" id="currency__addcars" class="currency" tabindex="26" name="currencyId">
                                <option label="$" value="1">$</option>
                                <option label="€" value="2">€</option>
                                <option label="грн." value="3">грн.</option>
                            </select>');
        $price->getDecorator('description')->setOption('escape',  
        false); 
        $price->addDecorator('Errors');
        
                       
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setOptions(array('class' => 'button  large green'));
        $submit->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows submit-form-add')),
        ))->setDescription('<p class="help-block"> При клике на кнопку "Далее" Вы перейдете к более подробному описанию своего объявления, а также добавлению фото </p>');
        $submit->getDecorator('description')->setOption('escape',false); 
        $submit->setLabel('Далее');
        
        $this->addElements(
                array($cat_id, $region, $mark, $model, $version, $vin, $transmission, $drive, $doors, $fuel, $year, $race, $volume, $price)
                );
 
        
         $this->addElement(
                'note', 
                'transport_type', 
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
                'color', 
                array('value'=>'<div id="colorselectblock__addcars" class="rows">
                                    <input id="colorid__addcars" type="hidden" value="0" name="colorId">
                                    <label class="label" for=""> Цвет: </label>
                                    
                                    <div class="select">
                                        <span class="element-select multicolor">
                                            <a id="selectcolor__addcars" class="selected" href="javascript:void(0);">
                                            <i class="color-0"></i>
                                            <span>Выбрать</span>
                                        </a>
                                        <span id="colorslist__addcars" class="options" style="display: none;">
                                            <a id="color0__addcars" class="item" color_id="0" href="javascript:void(0);">
                                                <i class="color-0"></i>
                                                Выбрать
                                            </a>
                                            <a id="color15__addcars" class="item" color_id="15" href="javascript:void(0);">
                                                <i class="color-15"></i>
                                                Белый
                                            </a>
                                            <a id="color2__addcars" class="item" color_id="2" href="javascript:void(0);">
                                                <i class="color-2"></i>
                                                Черный
                                            </a>
                                            <a id="color3__addcars" class="item" color_id="3" href="javascript:void(0);">
                                                <i class="color-3"></i>
                                                Синий
                                            </a>
                                            <a id="color14__addcars" class="item" color_id="14" href="javascript:void(0);">
                                                <i class="color-14"></i>
                                                Серебряный
                                            </a>
                                            <a id="color8__addcars" class="item" color_id="8" href="javascript:void(0);">
                                                <i class="color-8"></i>
                                                Серый
                                            </a>
                                            <a id="color9__addcars" class="item" color_id="9" href="javascript:void(0);">
                                                <i class="color-9"></i>
                                                Апельсин
                                            </a>
                                            <a id="color21__addcars" class="item" color_id="21" href="javascript:void(0);">
                                                <i class="color-21"></i>
                                                Асфальт
                                            </a>
                                            <a id="color1__addcars" class="item" color_id="1" href="javascript:void(0);">
                                                <i class="color-1"></i>
                                                Бежевый
                                            </a>
                                            <a id="color4__addcars" class="item" color_id="4" href="javascript:void(0);">
                                                <i class="color-4"></i>
                                                Бронзовый
                                            </a>
                                            <a id="color18__addcars" class="item" color_id="18" href="javascript:void(0);">
                                                <i class="color-18"></i>
                                                Вишнёвый
                                            </a>
                                            <a id="color17__addcars" class="item" color_id="17" href="javascript:void(0);">
                                                <i class="color-17"></i>
                                                Голубой
                                            </a>
                                            <a id="color20__addcars" class="item" color_id="20" href="javascript:void(0);">
                                                <i class="color-20"></i>
                                                Гранатовый
                                            </a>
                                            <a id="color16__addcars" class="item" color_id="16" href="javascript:void(0);">
                                                <i class="color-16"></i>
                                                Желтый
                                            </a>
                                            <a id="color7__addcars" class="item" color_id="7" href="javascript:void(0);">
                                                <i class="color-7"></i>
                                                Зеленый
                                            </a>
                                            <a id="color6__addcars" class="item" color_id="6" href="javascript:void(0);">
                                                <i class="color-6"></i>
                                                Золотой
                                            </a>
                                            <a id="color5__addcars" class="item" color_id="5" href="javascript:void(0);">
                                                <i class="color-5"></i>
                                                Коричневый
                                            </a>
                                            <a id="color13__addcars" class="item" color_id="13" href="javascript:void(0);">
                                                <i class="color-13"></i>
                                                Красный
                                            </a>
                                            <a id="color10__addcars" class="item" color_id="10" href="javascript:void(0);">
                                                <i class="color-10"></i>
                                                Магнолии
                                            </a>
                                            <a id="color11__addcars" class="item" color_id="11" href="javascript:void(0);">
                                                <i class="color-11"></i>
                                                Розовый
                                            </a>
                                            <a id="color19__addcars" class="item" color_id="19" href="javascript:void(0);">
                                                <i class="color-19"></i>
                                                Сафари
                                            </a>
                                            <a id="color12__addcars" class="item" color_id="12" href="javascript:void(0);">
                                                <i class="color-12"></i>
                                                Фиолетовый
                                            </a>
                                        </span>
                                        </span>
                                        <label class="exception" for="metallic__addcars">
                                            <input type="hidden" value="0" name="metallic">
                                            <input id="metallic__addcars" type="checkbox" value="1" name="metallic">
                                                Металлик
                                        </label>
                                    </div>
                                </div>', 
                      'decorators' => array(
                          //array('HtmlTag', array('tag' => 'div', 'class' => 'rows')),
                       )
                    )
               );
          
        $this->addElement(
                'note', 
                'body_type', 
                array('value' => '<div class="rows bodystyle">
                                    <label class="label" title="Нажмите, чтоб указать этот Тип кузова" for="choosebodystyle__addcars"> Тип кузова: </label>
                                        <div id="replacedelement__addcars" class="select">
                                            <span class="element-select">
                                            <a id="choosebodystyle__addcars" class="selected" href="javascript:void(0);">Выбрать</a>
                                            </span>
                                        </div>
                                        <div id="categoryerrormessage__addcars" class="error larr __smoll __top" style="display: none;">
                                            <a class="close" href="javascript:void(0);">×</a>
                                            Сначала выберите Тип транспорта
                                        </div>
                                  </div>', 
                      'decorators' => array(
                          //array('HtmlTag', array('tag' => 'div', 'class' => 'rows')),
                       )
                    )
               );
         
         $this->addElement(
                'note', 
                'fuelrate', 
                array('value' => '<div id="fuelselectblock__addcars" class="rows">
                                    <p style="display: block;">
                                        <a id="choosefuelrates__addcars" style="margin-left:160px; " href="javascript:void(0);">Указать расход топлива</a>
                                    </p>
                                    
                                    <div id="showchoosefuelratesnotice__addcars" class="error larr __smoll __top" style="display: none;">
                                        <a class="close" href="javascript:void(0);">×</a>
                                        Для того, что бы указать расход, необходимо указать топливо
                                    </div>
                                    
                                    <div id="fuelratesblock__addcars" class="rows" style="display: none;">
                                        <label class="label" for="input3"> Расход топлива </label>
                                        <div class="input">
                                            <div class="fuel-consumption">
                                                <label for="fuelratescity__addcars">город</label>
                                                <input id="fuelratescity__addcars" class="span1" type="text" value="" maxlength="4" name="fuelRates[city] " onkeyup="return check_num(this);">
                                                <label for="fuelratesrace__addcars">шоссе</label>
                                                <input id="fuelratesrace__addcars" class="span1" type="text" value="" maxlength="4" name="fuelRates[route]" onkeyup="return check_num(this);">
                                                <label for="fuelratescombine__addcars">смеш.</label>
                                                <input id="fuelratescombine__addcars" class="span1" type="text" value="" maxlength="4" name="fuelRates[combine]" onkeyup="return check_num(this);">
                                                <em>л/100км.</em>
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
                'indent', 
                array('value' => '<div class="indent ckecklist">
                                    <p class="item">
                                        <input type="hidden" value="0" name="auctionPossible">
                                        <input id="auction__addcars" type="checkbox" tabindex="27" value="1" name="auctionPossible">
                                        <label for="auction__addcars">
                                            <i class="icon-auction-red"></i>
                                                Возможен торг
                                            <em> (+ включить блок Торги)</em>
                                        </label>
                                    </p>
                                    <div class="item">
                                        <input type="hidden" value="0" name="isExchange">
                                        <input id="exchange__addcars" type="checkbox" tabindex="28" value="1" name="isExchange">
                                        <label for="exchange__addcars">
                                            <i class="icon-exchange-red"></i>
                                                Возможен обмен
                                            <em>(+ включить блок Обмен)</em>
                                        </label>
                                    </div>
                                 </div>', 
                      'decorators' => array(
                          //array('HtmlTag', array('tag' => 'div', 'class' => 'rows')),
                       )
                    )
               );
          
          
          $this->addElement(
                'note', 
                'preview', 
                array('value' => '<div id="previewblock__addcars" class="rows preview-title-ad span7">
                                        <label class="label" for="input3"> Заглавие объявления: </label>
                                        <div class="indent">
                                            <div id="previewticket__addcars" class="ticket-item ">
                                                <div class="head-ticket">
                                                    <span class="city">
                                                        <span id="previewcity__addcars" style="color : #256799">Город</span>
                                                    </span>
                                                    <h3 class="head-car">
                                                        <i id="previewishot__addcars" class=""></i>
                                                        <span id="previewmarka__addcars" style="color : #256799">Марка</span>
                                                        <span id="previewmodel__addcars" style="color : #256799">Модель</span>
                                                        <span id="previewversion__addcars" style="color : #256799"></span>
                                                        <span id="previewyear__addcars">Год выпуска</span>
                                                    </h3>
                                                </div>
                                            </div>
                                            <dl class="swich-title-ad">
                                            <dt class="title-ad"> Добавить к заглавию: </dt>
                                            <dd class="item-ad">
                                                <input id="previewradio1__addcars" type="radio" value="1" name="title-ad">
                                                <label class="label-hot" for="previewradio1__addcars"></label>
                                            </dd>
                                            <dd class="item-ad">
                                                <input id="previewradio2__addcars" type="radio" value="2" name="title-ad">
                                                <label class="label-less" for="previewradio2__addcars"></label>
                                            </dd>
                                            <dd class="item-ad">
                                                <input id="previewradio3__addcars" type="radio" value="3" name="title-ad">
                                                <label class="label-urgently" for="previewradio3__addcars"></label>
                                            </dd>
                                            <dd class="item-ad">
                                                <input id="previewradio0__addcars" type="radio" value="0" name="title-ad" checked="checked">
                                                <label for="previewradio0__addcars"> ничего не добавлять </label>
                                            </dd>
                                            </dl>
                                        </div>
                                    </div>', 
                      'decorators' => array(
                          //array('HtmlTag', array('tag' => 'div', 'class' => 'rows')),
                       )
                    )
               );
         
               
        
        $this->addElements(
                array($submit)
                );
    
       
            
        
    }
}

?>
