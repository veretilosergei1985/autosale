<?php

class Base_ImageHelper
{
    
    static function create_thumbnail($filename, $newfilename, $targ_w = 85, $targ_h = 56) {
        $src = $filename;
        $newfilename = $newfilename;
        $jpeg_quality = 90;
        $prop = $targ_w / $targ_h;
        $info = pathinfo($src);
        $ext = $info['extension'];
        $info = getimagesize($src);
        if (empty($info))
            return '';
        $w = $info[0];
        $h = $info[1];
        if ($targ_h == 0) {
            $targ_h = round(($h * $targ_w) / $w);
        }
        if ($w > $h) {
            $pr = $w / $h;
            if ($pr < $prop) {
                $h = (int) ($w / $prop);
            } else {
                $w = (int) ($h * $prop);
            }
        } else {
            $pr = $w / $h;
            if ($pr < $prop) {
                $h = (int) ($w / $prop);
            } else {
                $w = (int) ($h * $prop);
            }
        }
        $startX = 0;
        $startY = 0;
        if ($w < $info[0]) {
            $startX = (int) (($info[0] - $w) / 2);
        }
        if ($h < $info[1]) {
            $startY = (int) (($info[1] - $h) / 2);
        }
        if (strtoupper($ext) == strtoupper("gif")) {
            $img_r = imagecreatefromgif($src);
            $dst_r = ImageCreate($targ_w, $targ_h);
            imagecopyresampled($dst_r, $img_r, 0, 0, $startX, $startY, $targ_w, $targ_h, $w, $h);
            if (imagejpeg($dst_r, $newfilename, $jpeg_quality)) {
                
            }
        } else if (strtoupper($ext) == strtoupper("png")) {
            $img_r = imagecreatefrompng($src);
            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
            imagecopyresampled($dst_r, $img_r, 0, 0, $startX, $startY, $targ_w, $targ_h, $w, $h);
            if (imagejpeg($dst_r, $newfilename, $jpeg_quality)) {
                
            }
        } else {
            $img_r = imagecreatefromjpeg($src);
            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
            imagecopyresampled($dst_r, $img_r, 0, 0, $startX, $startY, $targ_w, $targ_h, $w, $h);
            if (imagejpeg($dst_r, $newfilename, $jpeg_quality)) {
                
            }
        }
    }
    
    function resize_image($filename, $targ_w = 380, $targ_h = 250) {
        $jpeg_quality = 90;
        $info = pathinfo($filename);
        $prop = $targ_w / $targ_h;
        $ext = $info['extension'];
        $src = $filename;
        $newfilename = $src;
        $info = getimagesize($src);
        if (empty($info))
            return '';
        $w = $info[0];
        $h = $info[1];
        if($w < $targ_w && $h < $targ_h) {
            return true;
        }
        
        $prw = $w / $targ_w;
        $prh = $h / $targ_h;
        
        if($prw > $prh) {
            $new_w = (int) ($w / $prw);
            $new_h = (int) ($h / $prw);
        } else {
            $new_w = (int) ($w / $prh);
            $new_h = (int) ($h / $prh);
        }

        if (strtoupper($ext) == strtoupper("gif")) {
            $img_r = imagecreatefromgif($src);
            $dst_r = ImageCreate($new_w, $new_h);
            imagefilledrectangle($dst_r, 0, 0, $targ_w, $targ_h, $black);
            imagecopyresampled($dst_r, $img_r, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
            if (imagejpeg($dst_r, $newfilename, $jpeg_quality)) {
                
            }
        } else if (strtoupper($ext) == strtoupper("png")) {
            $img_r = imagecreatefrompng($src);
            $dst_r = ImageCreateTrueColor($new_w, $new_h);
            imagecopyresampled($dst_r, $img_r, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
            if (imagejpeg($dst_r, $newfilename, $jpeg_quality)) {
                
            }
        } else {
            $img_r = imagecreatefromjpeg($src);
            $dst_r = ImageCreateTrueColor($new_w, $new_h);
            imagecopyresampled($dst_r, $img_r, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
            if (imagejpeg($dst_r, $newfilename, $jpeg_quality)) {
                
            }
        }
    }
    
    static function resize_image1($filename, $targ_w = 380, $targ_h = 250, $change_proportion = true) {
        $jpeg_quality = 90;
        $info = pathinfo($filename);
        $prop = $targ_w / $targ_h;
        $ext = $info['extension'];
        $src = $filename;
        $newfilename = $src;
        $info = getimagesize($src);
        if (empty($info))
            return '';
        $w = $info[0];
        $h = $info[1];
        $prop1 = $w / $h;
        if ($prop1 > $prop) {
            $add_black = false;
        } else {
            $add_black = true;
        }
        if ($targ_h == 0) {
            $targ_h = round(($h * $targ_w) / $w);
        }
        $startX = 0;
        $startY = 0;
        if (!$change_proportion) {
            $pr1 = $targ_w / $w;
            $pr2 = $targ_h / $h;
            if ($add_black) {
                if ($pr1 < $pr2) {
                    $w = $w * $pr1;
                    $h = $h * $pr1;
                    $startY = (int) (($targ_h - $h) / 2);
                } else {
                    $w = (int) ($w * $pr2);
                    $h = (int) ($h * $pr2);
                    $startX = (int) (($targ_w - $w) / 2);
                }
                $new_w = $info[0];
                $new_h = $info[1];
                $new_dest_w = $w;
                $new_dest_h = $h;
            } else {
                if ($w > $h) {
                    $pr = $w / $h;
                    if ($pr < $prop) {
                        $h = (int) ($w / $prop);
                    } else {
                        $w = (int) ($h * $prop);
                    }
                } else {
                    $pr = $w / $h;
                    if ($pr < $prop) {
                        $h = (int) ($w / $prop);
                    } else {
                        $w = (int) ($h * $prop);
                    }
                }
                $new_w = $w;
                $new_h = $h;
                $new_dest_w = $targ_w;
                $new_dest_h = $targ_h;
            }
        } else {
            $new_w = $w;
            $new_h = $h;
            $new_dest_w = $targ_w;
            $new_dest_h = $targ_h;
        }
        if (strtoupper($ext) == strtoupper("gif")) {
            $img_r = imagecreatefromgif($src);
            $dst_r = ImageCreate($targ_w, $targ_h);
            $black = imagecolorallocate($im, 0, 0, 0);
            imagefilledrectangle($dst_r, 0, 0, $targ_w, $targ_h, $black);
            imagecopyresampled($dst_r, $img_r, $startX, $startY, 0, 0, $new_dest_w, $new_dest_h, $new_w, $new_h);
            if (imagejpeg($dst_r, $newfilename, $jpeg_quality)) {
                
            }
        } else if (strtoupper($ext) == strtoupper("png")) {
            $img_r = imagecreatefrompng($src);
            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
            imagecopyresampled($dst_r, $img_r, $startX, $startY, 0, 0, $new_dest_w, $new_dest_h, $new_w, $new_h);
            if (imagejpeg($dst_r, $newfilename, $jpeg_quality)) {
                
            }
        } else {
            $img_r = imagecreatefromjpeg($src);
            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
            imagecopyresampled($dst_r, $img_r, $startX, $startY, 0, 0, $new_dest_w, $new_dest_h, $new_w, $new_h);
            if (imagejpeg($dst_r, $newfilename, $jpeg_quality)) {
                
            }
        }
    }
    
}

?>
