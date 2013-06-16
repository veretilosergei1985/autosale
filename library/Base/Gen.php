<?php

class Base_Gen
{
    
    public static function mkSecret($length = 20)
    {
        $set = array(
            "a",
            "A",
            "b",
            "B",
            "c",
            "C",
            "d",
            "D",
            "e",
            "E",
            "f",
            "F",
            "g",
            "G",
            "h",
            "H",
            "i",
            "I",
            "j",
            "J",
            "k",
            "K",
            "l",
            "L",
            "m",
            "M",
            "n",
            "N",
            "o",
            "O",
            "p",
            "P",
            "q",
            "Q",
            "r",
            "R",
            "s",
            "S",
            "t",
            "T",
            "u",
            "U",
            "v",
            "V",
            "w",
            "W",
            "x",
            "X",
            "y",
            "Y",
            "z",
            "Z",
            "1",
            "2",
            "3",
            "4",
            "5",
            "6",
            "7",
            "8",
            "9"
        );
        $str = '';

        for ($i = 1; $i <= $length; $i++) {
            $ch = rand(0, count($set) - 1);
            $str .= $set[$ch];
        }
        return $str;
    }
    
}

?>
