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
     
     public static function getAddCarTime($ts) {
                    
        $start_yesterday = date('Y-m-d H:i:s' ,mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"))); 
        $end_yesterday = date('Y-m-d H:i:s' ,mktime(23, 59, 59, date("m")  , date("d")-1, date("Y"))); 
        if($start_yesterday <= date('Y-m-d H:i:s', $ts) && date('Y-m-d H:i:s', $ts) <= $end_yesterday){
            //вчера
            return "<i class='icon-time-blue'></i><span class='blue' style='font-weight: bold;'>Вчера</span>";
        } 
        
        $start_before_yesterday = date('Y-m-d H:i:s' ,mktime(0, 0, 0, date("m")  , date("d")-2, date("Y"))); 
        $end_before_yesterday = date('Y-m-d H:i:s' ,mktime(23, 59, 59, date("m")  , date("d")-2, date("Y"))); 
        if($start_before_yesterday <= date('Y-m-d H:i:s', $ts) && date('Y-m-d H:i:s', $ts) <= $end_before_yesterday){
            //позавчера
            return "<i class='icon-time-blue'></i><span class='blue' style='font-weight: bold;'>Позавчера</span>";
        } 
        
        if($start_before_yesterday > date('Y-m-d H:i:s', $ts)){
            return "<i class='icon-time-grey'></i><span>" . date('d.m.Y', $ts) . "</span>";
        } 
        
        $today = date('Y-m-d H:i:s' ,mktime(0, 0, 0, date("m")  , date("d"), date("Y"))); 
        if($today <= date('Y-m-d H:i:s', $ts)){
            
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
              return "<i class='icon-time-green'></i>
                      <span class='green' style='font-weight: bold;'>" . $hours . " час" . ($hours > 1 ? "ов" : "") . " назад</span>";
           
            if ($mins > 0)
                return "<i class='icon-time-green'></i>
                      <span class='green' style='font-weight: bold;'>" . $mins . " минут" . ($mins > 1 ? "" : "а") . " назад</span>";

            return "< 1 минуты назад";

            }
   
        
     }
}

?>
