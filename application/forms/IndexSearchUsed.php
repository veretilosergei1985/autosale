<?php

class Application_Form_IndexSearchUsed extends Zend_Form
{
    public function init(){
     

        $this->setMethod('post');
        $this->setAttrib('class', 'grid grid-span2');
        $this->setAttrib('id', 'main_search_form');
                
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
        $year_start->setAttrib('style', 'float: left; width: 72px;');
        $year_start->addMultiOptions(array('' => 'Выберите'));

        $cur_year = intval(date('Y'));
        for($i = $cur_year; $i >= 1901; $i--) {
            $year_start->addMultiOption($i, $i);
        }
        $year_start->setAttrib('class', 'years');
        
            $year_end = new Zend_Form_Element_Select('year_end', array());
            
            $year_end->setAttrib('style', 'float: left;  width: 72px;');
            $year_end->addMultiOptions(array('' => 'Выберите'));

            $cur_year = intval(date('Y'));
            for($i = $cur_year; $i >= 1901; $i--) {
                $year_end->addMultiOption($i, $i);
            }
            $year_end->setAttrib('class', 'years');

        

                
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
            array('Label', array('class' => 'label st_end_label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'p', 'class' => 'rows')),
        ))->addDecorator('Errors');    
        
        $year_end->setDecorators(array(
            'ViewHelper',
            'Description',
            array('HtmlTag', array('tag' => 'span', 'class' => 'indent select')),
            array('Label', array('class' => 'label', 'escape' => false)),
            array(array('row' => 'HtmlTag'), array('tag' => 'p', 'class' => 'rows')),
        ))->addDecorator('Errors');    
        
                              
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
                array($region, $mark, $model, $year_start, $year_end, $bodystyle)
                );
        
        $this->addElements(
                array($submit)
                );
  
    }
}

?>
