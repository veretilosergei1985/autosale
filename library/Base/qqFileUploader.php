<?php
/**
 * Handle file uploads via XMLHttpRequest
 */
class Base_qqUploadedFileXhr {

    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
     function create_thumbnail($filename, $newfilename, $targ_w = 85, $targ_h = 56) {
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
    
    function resize_image1($filename, $targ_w = 380, $targ_h = 250, $change_proportion = true) {
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
    
    function imageResize($distFileName, $srcFileName) {
        // Get Image Info
        
        $is = getimagesize($srcFileName);

        $image['type'] = $is['mime'];
        $image['width'] = $is['0'];
        $image['height'] = $is['1'];
//print_r($image); exit;
        // Create image link
        if ($image['type'] == 'image/jpeg')
            $image['link'] = imagecreatefromjpeg($srcFileName);
        elseif ($image['type'] == 'image/gif')
            $image['link'] = imagecreatefromgif($srcFileName);
        elseif ($image['type'] == 'image/png')
            $image['link'] = imagecreatefrompng($srcFileName);
        else
            return false;

        // Calculate Sizes by percent relations
        // reference width - 150
        // reference height - 150
        $dWidth = $image['width'] / 150;
        $dHeight = $image['height'] / 150;

        if ($dWidth > $dHeight) {
            $width = 150;
            $height = $image['height'] / $dWidth;
        } else {
            $width = $image['width'] / $dHeight;
            $height = 150;
        }
        // Create new image
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $image['link'], 0, 0, 0, 0, $width, $height, $image['width'], $image['height']);
        // Save new image
        imagejpeg($new_image, $distFileName, 75);
        
        // my

        /////chmod($new_image, '0755');
        ////chmod($distFileName, '0755');
        
        // my
    }

    function save($path, $path_thumb) {
        
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);

        if ($realSize != $this->getSize()) {
            return false;
        }

        $target = fopen($path, "w");
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
        // my  !!!!!!!!!!
        //chmod($path, '0777');
        //my
        
        // Resize image
        $this->resize_image1($path);
        $this->create_thumbnail($path, $path_thumb, $targ_w = 85, $targ_h = 56);
        return true;
    }

    function getName() {
        return $_GET['qqfile'];
    }

    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])) {
            return (int) $_SERVER["CONTENT_LENGTH"];
        } else {
            throw new Exception('Getting content length is not supported.');
        }
    }

}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class Base_qqUploadedFileForm {

    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {
        if (move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)) {
            chmod($path, '755');
            return true;
        } else {
            return false;
        }
    }

    function getName() {
        return $_FILES['qqfile']['name'];
    }

    function getSize() {
        return $_FILES['qqfile']['size'];
    }


}

class Base_qqFileUploader {

    private $allowedExtensions = array();
    private $sizeLimit = 10485760;
    private $file;
    

    function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760) {
        $allowedExtensions = array_map("strtolower", $allowedExtensions);

        $this->allowedExtensions = $allowedExtensions;
        $this->sizeLimit = $sizeLimit;
        
//        $this->checkServerSettings();

        if (isset($_GET['qqfile'])) {
            $this->file = new Base_qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new Base_qqUploadedFileForm();
        } else {
            $this->file = false;
        }
    }

    private function checkServerSettings() {
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));

        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit) {
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';
            die("{'error':'increase post_max_size and upload_max_filesize to $size'}");
        }
    }

    private function toBytes($str) {
        $val = trim($str);
        $last = strtolower($str[strlen($str) - 1]);
        switch ($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;
        }
        return $val;
    }

    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($uploadDirectory, $replaceOldFile = FALSE, $folder) {
        
        $result = array();
        
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory);
            // chmod($uploadDirectory, '0755');
        }
        
        if (!is_writable($uploadDirectory)) {
            return array('error' => "Server error. Upload directory isn't writable.");
        }

        if (!$this->file) {
            return array('error' => 'No files were uploaded.');
        }

        $size = $this->file->getSize();

        if ($size == 0) {
            return array('error' => 'File is empty');
        }

        if ($size > $this->sizeLimit) {
            return array('error' => 'File is too large');
        }

        $pathinfo = pathinfo($this->file->getName());
        $filename = $pathinfo['filename'];
        //$filename = md5(uniqid());
        $ext = $pathinfo['extension'];

        if ($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)) {
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of ' . $these . '.');
        }

        if (!$replaceOldFile) {
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
                $filename .= rand(10, 99);
            }
        }

        $filename = Base_Gen::mkSecret(6);
        
        if ($this->file->save($uploadDirectory . $filename . '.' . $ext, $uploadDirectory . $filename . '_thumb.' . $ext)) {
            
            $photo = new Application_Model_Photos();

            $photo->setAutoId($folder);
            $photo->setImage($filename . '.' . $ext);
          
            /*
            $items = scandir($uploadDirectory);
            $isset = false;
            $count = 0;
            $tmp = '';
            
            foreach ($items as $k =>$f)
            {
              if (is_file($uploadDirectory.$f))
              {
                  $tmp.=$uploadDirectory.$f.'---'; 
                $isset = true;
                $count++;
                //break;
              }
            }
            //echo $tmp; exit;
            if($count == 2){
               $photo->setIsMain(1);
            } else {
               $photo->setIsMain(0);
            }
            */
            $is_exist = $photo->mainExist($folder);
            
            if($is_exist == false){
               $photo->setIsMain(1);
            } else {
               $photo->setIsMain(0);
            }
            
            $photo_id = $photo->save();
            
            $result['success'] = true;
            $result['photo_id'] = $photo_id;
            $result['photo'] = '/images/photos/'.$folder.'/' . $filename . '.' . $ext;
            
            if($is_exist == false){
                $result['main_photo'] = $photo_id;
            }
            
            return $result;
        } else {
            $result['error'] = 'Could not save uploaded file. The upload was cancelled, or server error encountered';
            return $result;
        }
    }

}
