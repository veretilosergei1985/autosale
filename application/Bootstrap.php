<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initLocale()
    {
//        $locale = new Zend_Locale('ru_RU'); // Тут пробовал и auto and ru но эффекта нет
//
//        Zend_Locale::setDefault($locale->toString());
//
//        Zend_Registry::set('Zend_Locale', $locale);
//
//        return $locale;
    }
    
    protected function _initTranslate()
    {
        //Icore_Cache::init();
        //Zend_Translate::setCache(Icore_Cache::getInstance());

//        $translate = new Zend_Translate(
//                                        'array',
//                                        APPLICATION_PATH . '/../library/translate/ru/Zend_Validate.php',
//                                        'ru'
//                                       );
//        Zend_Registry::set('Zend_Translate', $translate);
//        Zend_Validate_Abstract::setDefaultTranslator($translate);
//        
//        return $translate;
    }
    
    protected function _initViewHelpers(){ 
        $this->bootstrap("layout");
        $layout = $this->getResource('layout');

        $view = $layout->getView();
        $view->headMeta()->appendHttpEquiv('Content-Type','text/html;charset=utf-8');
        $view->headTitle('Автопродажа');
        $view->headTitle()->setSeparator(' :: ');
        
        
        
    }
    
    protected function _initAutoload() 
    {
            $moduleLoader = new Zend_Application_Module_Autoloader(array( 
                    'namespace' => '', 
                    'basePath'  => APPLICATION_PATH)); 

            $autoloader = Zend_Loader_Autoloader::getInstance();
            $autoloader->registerNamespace(array('Base_'));

            return $moduleLoader;
    }
    
     protected function _initLanguage()
     {
        
       try {
            $translator = new Zend_Translate(
                array (
                      'adapter' => 'array',
                      'content' => APPLICATION_PATH . '/../library/translate',
                      'locale'  => 'ru',
                      'scan'    => Zend_Translate::LOCALE_DIRECTORY
                )
            );
            Zend_Validate_Abstract::setDefaultTranslator($translator);
             Zend_Registry::set('Zend_Translate', $translate);
        } catch (Exception $e) {
            Zend_Debug::dump($e->getMessage());
        }
         return $translate;
     }
    

}

