<?php

class Base_UrlHelper
{
    
    public static function queryToArray($qry)
    {
            $result = array();
            //string must contain at least one = and cannot be in first position
            if(strpos($qry,'=')) {
             if(strpos($qry,'?')!==false) {
               $q = parse_url($qry);
               $qry = $q['query'];
              }
            }else {
                    return false;
            }
            foreach (explode('&', $qry) as $couple) {
                    list ($key, $val) = explode('=', $couple);
                    $result[$key] = $val;
            }
            return empty($result) ? false : $result;
    }
    
    
    
}

?>
