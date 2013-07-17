<?php

class Application_Form_IndexSearchUsed extends Zend_Form
{
    public function init(){
     

        $this->setMethod('get');
        $this->setAttrib('class', 'grid grid-span2');
        $this->setAttrib('id', 'main_search_form');
        $this->setAction('/search/index');
                
        $this->setDecorators(array(
                        array('FormErrors', array('markupListEnd' => '', 'markupListStart' => '','markupListItemStart' => '', 'markupListItemEnd' => '')),
                        array('FormElements'),
                        array('Form')
                    ));
       
        
        $region = new Zend_Form_Element_Select('region', array());
        $region->setLabel("Регион:");
        $region->addMultiOptions(array('' => 'Любой'));
        //
        $oRegion = new Application_Model_Regions();
        foreach ($oRegion->fetchAll() as $reg) {
            $region->addMultiOption($reg->id, $reg->name);
        }
        //
        $region->setAttrib('class', 'span3');
        
        
                $mark = new Zend_Form_Element_Select('mark', array());
                $mark->setLabel("Марка:");
                $mark->addMultiOptions(array('' => 'Любая'));
                //
                $oMark = new Application_Model_Marks();
                foreach ($oMark->fetchAll() as $item) {
                    $mark->addMultiOption($item->id, $item->name);
                }
                //      
                $mark->setAttrib('class', 'span3');
                $mark->setAttrib('id', 'select_auto_used_marka');

                //$mark->removeDecorator('Errors');
                $mark->setRegisterInArrayValidator(false);

        
        $model = new Zend_Form_Element_Select('model', array());
        $model->setLabel("Модель:<ins>*</ins>");
        $model->addMultiOptions(array('' => 'Любая'));

        $model->setAttrib('class', 'span3');
        $model->setAttrib('id', 'select_auto_used_model');
        $model->setRegisterInArrayValidator(false);
               
                $bodystyle = new Zend_Form_Element_Select('bodystyle', array());
                $bodystyle->setLabel("Подкатегория:");
                $bodystyle->addMultiOptions(array('' => 'Любая'));
                
                $oSubCategories = new Application_Model_Subcats();
                $defaultSubCats = $oSubCategories->getByParentId(1);
                
                foreach ($defaultSubCats as $item) {
                    $bodystyle->addMultiOption($item->id, $item->name);
                }

                $bodystyle->setAttrib('class', 'span3');
                $bodystyle->setAttrib('id', 'select_auto_used_bodystyle');
                $bodystyle->setRegisterInArrayValidator(false);
        
                        
        $year_start = new Zend_Form_Element_Select('year_start', array());
        $year_start->setLabel("Год выпуска:");
        $year_start->setAttrib('style', 'float: left; width: 72px; margin: 0 5px 5px 0;');
        $year_start->addMultiOptions(array('' => 'Любой'));

        $cur_year = intval(date('Y'));
        for($i = $cur_year; $i >= 1901; $i--) {
            $year_start->addMultiOption($i, $i);
        }
        $year_start->setAttrib('class', 'years');
        
            $year_end = new Zend_Form_Element_Select('year_end', array());
            
            $year_end->setAttrib('style', 'float: left;  width: 72px;');
            $year_end->addMultiOptions(array('' => 'Любой'));

            $cur_year = intval(date('Y'));
            for($i = $cur_year; $i >= 1901; $i--) {
                $year_end->addMultiOption($i, $i);
            }
            $year_end->setAttrib('class', 'years');

        $price_start = new Zend_Form_Element_Text('price_start', array());
        $price_start->setLabel("Цена:");
        //$price_start->setAttrib('style', 'float: left;  width: 68px;');
        $price_start->setAttrib('class', 'price'); 
        $price_start->setAttrib ( 'placeholder', 'от' );
            
            $price_end = new Zend_Form_Element_Text('price_end', array());
            $price_end->setLabel("Цена:");
            //$price_end->setAttrib('style', 'float: left; width: 68px;');
            $price_end->setAttrib('class', 'price');
            $price_end->setAttrib ( 'placeholder', 'до' );
        
        $currency = new Zend_Form_Element_Select('currency', array());
        $currency->addMultiOptions(array('USD' => '$'));
        $currency->addMultiOptions(array('EUR' => '€'));
        $currency->addMultiOptions(array('UAH' => 'грн.'));
        $currency->setAttrib('class', 'currency');
        $currency->setAttrib('id', 'currency__addcars');
        
            $with_photo = new Zend_Form_Element_Checkbox('with_photo', array('disableLoadDefaultDecorators' => true, 'required' => false));
            $with_photo->setAttrib('id', 'check1');
        
        $with_video = new Zend_Form_Element_Checkbox('$with_video', array('disableLoadDefaultDecorators' => true, 'required' => false));
        $with_video->setAttrib('id', 'check2');

                
        //////////////////////////////////////////////
        
        
        $region->setDecorators(array(
            'ViewHelper',
            'Description',
            'FormErrors',
            array('HtmlTag', array('tag' => 'span', 'class' => 'indent select')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'p', 'class' => 'rows')),
        ))->addDecorator('Errors');      
        
        $mark->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span', 'class' => 'indent select')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'p', 'class' => 'rows')),
        ))->addDecorator('Errors');    
        
        $model->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span', 'class' => 'indent select')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'p', 'class' => 'rows')),
        ))->addDecorator('Errors'); 
        
        $bodystyle->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span', 'class' => 'indent select')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'p', 'class' => 'rows')),
        ))->addDecorator('Errors'); 
                 
        $year_start->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span', 'class' => 'indent select')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'p', 'class' => 'rows')),
        ))->addDecorator('Errors');    
        
        $year_end->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span', 'class' => 'indent select')),
            array('Label', array('class' => 'label st_end_label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'p', 'class' => 'rows')),
        ))->addDecorator('Errors');    
        
        $price_start->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span', 'class' => 'indent')),
            array('Label', array('class' => 'label', 'escape' => false, 'style'=> 'width: 58px;', 'placeholder'=>"от")),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'rows', 'style'=> 'display: inline-block; width: 60px;')),
        ))->addDecorator('Errors');    
        
        $price_end->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span', 'class' => 'indent')),
            array('Label', array('class' => 'label st_end_label', 'escape' => false, 'style'=> 'width: 58px;')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => '', 'style'=> 'display: inline-block; width: 60px;')),
        ))->addDecorator('Errors');  
        
        $currency->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span', 'class' => 'indent')),
            array('Label', array('class' => 'label', 'escape' => false, 'style'=> 'width: 58px;')),
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => '', 'style'=> 'display: inline-block; width: 1px;')),
        ))->addDecorator('Errors');  
        
         $with_photo->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div')),
         ))->addDecorator('Errors');
         $with_photo->setDescription('<label for="check1"><i class="icon-photo-white"></i>только с фото </label>'); 
         $with_photo->getDecorator('description')->setOption('escape', false); 
         
        $with_video->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'div')),
        ))->addDecorator('Errors'); 
        $with_video->setDescription('<label for="check2"><i class="icon-video-white"></i>только с видео </label>'); 
        $with_video->getDecorator('description')->setOption('escape', false); 
        
                              
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setOptions(array('class' => ''));
        $submit->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'div', 'class' => '')),
            array(array('row' => 'HtmlTag'), array('tag' => 'span', 'class' => '')),
        ));
        
        $submit->setLabel('Далее');
        
        $this->addElements(
                array($region, $mark, $model, $year_start, $year_end, $bodystyle, $price_start, $price_end, $currency, $with_photo, $with_video)
                );
        
        $this->addElements(
                array($submit)
                );
  
    }
}

?>
