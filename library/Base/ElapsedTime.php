<?php

class Base_ElapsedTime
{
 
    public function get_elapsed_time($ts) {
        
        $mins = floor((time() - $ts) / 60);
        $hours = floor($mins / 60);
        $mins -= $hours * 60;
        $days = floor($hours / 24);
        $hours -= $days * 24;
        $weeks = floor($days / 7);
        $days -= $weeks * 7;
        $t = "";
        
        if ($weeks > 0)
          return "$weeks недел" . ($weeks > 1 ? "ь" : "ю");
        if ($days > 0)
          return "$days д" . ($days > 1 ? "ней" : "ень");
        if ($hours > 0)
          return "$hours час" . ($hours > 1 ? "ов" : "");
        if ($mins > 0)
          return "$mins минут" . ($mins > 1 ? "" : "а");
        return "< 1 минуты";
        
     }
     
     public function get_reg_time($ts) {
        
        $mins = floor((time() - $ts) / 60);
        $hours = floor($mins / 60);
        $mins -= $hours * 60;
        $days = floor($hours / 24);
        $hours -= $days * 24;
        $weeks = floor($days / 7);
        $days -= $weeks * 7;
        $t = "";
        
        if ($weeks > 0)
          return "$weeks недел" . ($weeks > 1 ? "и" : "ю");
        if ($days > 0)
          return "$days д" . ($days > 1 ? "ней" : "ень");
        if ($hours > 0)
          return "$hours час" . ($hours > 1 ? "ов" : "");
        if ($mins > 0)
          return "$mins минут" . ($mins > 1 ? "" : "а");
        return "< 1 минуты";
        
     }
}

?>
