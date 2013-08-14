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
        
        //$cat_id = new Zend_Form_Element_Hidden('cat_id');
        $cat_id = new Zend_Form_Element_Hidden('cat_id');
        $cat_id->setAttrib('id', 'category__addcars');
        
        $body_id = new Zend_Form_Element_Hidden('body_id');
        $body_id->setAttrib('id', 'body_id_tmp__addcars');
        
        $model_id = new Zend_Form_Element_Hidden('model_id');
        $model_id->setAttrib('id', 'model_id');
        
        $color_id = new Zend_Form_Element_Hidden('color_id');
        $color_id->setAttrib('id', 'colorid__addcars');
        
        $metallic = new Zend_Form_Element_Hidden('metallic');
       
        
                $region = new Zend_Form_Element_Select('reg_id', array());
                $region->setLabel("Регион:<ins>*</ins>");
                $region->addMultiOptions(array('' => 'Выберите'));
                $region->addMultiOptions(array('choose' => 'Выбрать другой регион'));
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
                
                $region->getValidator('NotEmpty')->setMessage('Выберите регион');
        
        
        $mark = new Zend_Form_Element_Select('mark_id', array());
        $mark->setLabel("Марка:<ins>*</ins>");
        $mark->addMultiOptions(array('' => 'Выберите'));
        //
        $oMark = new Application_Model_Marks();
        foreach ($oMark->fetchAll() as $item) {
            $mark->addMultiOption($item->id, $item->name);
        }
        //      
        $mark->setAttrib('class', 'span3');
        $mark->setAttrib('id', 'mark');
                
        //$mark->removeDecorator('Errors');
        $mark->setRequired(true)
                ->addValidator('NotEmpty',true)
                ->setRegisterInArrayValidator(false);
        $mark->getValidator('NotEmpty')->setMessage('Выберите марку');
        
                $model = new Zend_Form_Element_Select('model', array());
                $model->setLabel("Модель:<ins>*</ins>");
                $model->addMultiOptions(array('' => 'Выберите'));

                $model->setAttrib('class', 'span3');
                $model->setAttrib('id', 'model');

                //$model->removeDecorator('Errors');
                $model->setRequired(true)
                        ->addValidator('NotEmpty',true)
                        ->setRegisterInArrayValidator(false);
                $model->getValidator('NotEmpty')->setMessage('Выберите модель');
        
        $version = new Zend_Form_Element_Text('version');
        $version->setLabel('Версия:')
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
        
        $transmission = new Zend_Form_Element_Select('transmission_id', array());
        $transmission->setLabel("Коробка передач:");
        $transmission->addMultiOptions(array('' => 'Выберите'));
        
        $oTransmission = new Application_Model_Transmission();
        foreach ($oTransmission->fetchAll() as $item) {
            $transmission->addMultiOption($item->id, $item->type);
        }
        
        $transmission->setAttrib('class', 'span3');
                
        //$transmission->removeDecorator('Errors');
        $transmission->setRegisterInArrayValidator(false);
        
                $drive = new Zend_Form_Element_Select('drive_id', array());
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
        
        
                $fuel = new Zend_Form_Element_Select('fuel_id', array());
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
        $year->getValidator('NotEmpty')->setMessage('Выберите год выпуска');
        

                $mileage = new Zend_Form_Element_Text('mileage');
                $mileage->setLabel("Пробег:<ins>*</ins>")
                        ->setRequired(true)
                        ->addValidator('NotEmpty', true)
                        ->addFilter('HtmlEntities')
                        ->addFilter('StringTrim')
                        ->setAttrib('class', 'span1');
                $mileage->getValidator('NotEmpty')->setMessage('Пробег б/у автомобиля должен быть более 1 тыс.км. Продажа новых автомобилей доступна только в коммерческом разделе “Новые авто”. Детальнее по телефону (067)430-79-91 ');
                $mileage->setAttrib('onkeyup','return check_num(this);');
                
        $volume = new Zend_Form_Element_Text('volume');
        $volume->setLabel("Объем двигателя:")
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'span1'); 
        $volume->addPrefixPath('Base_Validator', 'Base/Validator', 'validate')		
                                ->addValidator('FloatValidator');

        
        
                $price = new Zend_Form_Element_Text('price');
                $price->setLabel("Цена:<ins>*</ins>")
                        ->setRequired(true)
                        ->addValidator('NotEmpty', true)
                        ->addFilter('HtmlEntities')
                        ->addFilter('StringTrim')
                        ->setAttrib('class', 'span2'); 
                $price->getValidator('NotEmpty')->setMessage('Укажите адекватную стоимость. Введите 0 для “договорной”. ');
                $price->setAttrib('onkeyup','return check_num(this);');
                
                
                $currency = new Zend_Form_Element_Select('currency', array());
                $currency->addMultiOptions(array('USD' => '$'));
                $currency->addMultiOptions(array('EUR' => '€'));
                $currency->addMultiOptions(array('UAH' => 'грн.'));
                $currency->setAttrib('class', 'currency');
                $currency->setAttrib('id', 'currency__addcars');
               
                
                
        $fuel_city = new Zend_Form_Element_Text('fuel_city');
        $fuel_city->setLabel('город')
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim');
        $fuel_city->setAttrib('class', 'span1');
        
                $fuel_route = new Zend_Form_Element_Text('fuel_route');
                $fuel_route->setLabel('шоссе')
                        ->addFilter('HtmlEntities')
                        ->addFilter('StringTrim');
                $fuel_route->setAttrib('class', 'span1');
        
        $fuel_combine = new Zend_Form_Element_Text('fuel_combine');
        $fuel_combine->setLabel('смеш.')
                ->addFilter('HtmlEntities')
                ->addFilter('StringTrim');
        $fuel_combine->setAttrib('class', 'span1');
        
            $auction = new Zend_Form_Element_Checkbox('auction', array('disableLoadDefaultDecorators' => true, 'required' => false));
            $auction->setAttrib('id', 'auction__addcars');
            
            $exchange = new Zend_Form_Element_Checkbox('exchange', array('disableLoadDefaultDecorators' => true, 'required' => false));
            $exchange->setAttrib('id', 'exchange__addcars');
            
            
        $this->addElement('radio', 'priority', array(
            'label' => '',
            'multiOptions' => array(
                'hot'=>'<label class="label-hot" for="previewradio1__addcars"></label>',
                'less'=>'<label class="label-less" for="previewradio2__addcars"></label>',
                'urgently'=>'<label class="label-urgently" for="previewradio3__addcars"></label>',
                'none'=>'<label for="previewradio0__addcars"> ничего не добавлять </label>'
            ),
            'escape' => false,
            'value' => 'none',
           'decorators' => array(),
        ));
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
        
        $mileage->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ))->setDescription('<em class="add-on">тыс.км</em>');
        $mileage->getDecorator('description')->setOption('escape',  
        false); 
        $mileage->addDecorator('Errors');
        
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
        $volume->addDecorator('Errors');
        
        $price->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input', 'style'=>'padding-bottom:5px;')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative', 'openOnly' => true)),
        ));
        $price->getDecorator('description')->setOption('escape',  
        false); 
        $price->addDecorator('Errors');
        
        $currency->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span', 'class' => 'span_absolute')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'closeOnly' => true)),
        ));
        
        
        $fuel_city->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'span')),
        ));
        $fuel_city->getDecorator('Label')->setOption('style','float:none;');

         
        $fuel_route->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'span')),
        ));
        $fuel_route->getDecorator('Label')->setOption('style','float:none;');
          
         $fuel_combine->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'span')),
        ));
        $fuel_combine->getDecorator('Label')->setOption('style','float:none;');
        
        $exchange->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ))->setDescription('<label for="exchange__addcars">
                    <i class="icon-exchange-red"></i>
                        Возможен обмен
                    <em>(+ включить блок Обмен)</em>
                </label>');
        $exchange->getDecorator('description')->setOption('escape',false);
        
        $auction->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows relative')),
        ))->setDescription('<label for="auction__addcars"><i class="icon-auction-red"></i>Возможен торг<em> (+ включить блок Торги)</em></label>'); 
        $auction->getDecorator('description')->setOption('escape', false);
                      
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
                array($auction, $exchange, $currency, $fuel_city, $fuel_route, $fuel_combine, $metallic, $color_id, $model_id, $body_id, $cat_id, $region, $mark, $model, $version, $vin, $transmission, $drive, $doors, $fuel, $year, $mileage, $volume, $price)
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
                                            <input id="metallic__addcars" type="checkbox">
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
         
          
          
          
         
               
        
        $this->addElements(
                array($submit)
                );
    
       
            
        
    }
}

?>
