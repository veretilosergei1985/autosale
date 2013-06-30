<?php

class Base_ModelsHelper
{
    
    public static function deleteAutoOptions($autoId) {      

        $oSafety = new Application_Model_CarSafety();
        $oSafety->deleteAutoOptions($autoId);

        $oComfort = new Application_Model_CarComfort();
        $oComfort->deleteAutoOptions($autoId);

        $oMultimedia = new Application_Model_CarMultimedia();
        $oMultimedia->deleteAutoOptions($autoId);

        $oOther = new Application_Model_CarOther();
        $oOther->deleteAutoOptions($autoId);

        $oState = new Application_Model_CarState();
        $oState->deleteAutoOptions($autoId);

    } 
    
    
    
}

?>
