<?php

/**
 * imghost.php
 *
 * Main imghost class / functions
 *
 * @package imghost
 * @author Sascha Ohms
 * @copyright Copyright 2011, Sascha Ohms
 * @license http://www.gnu.org/licenses/lgpl.txt
 *
**/

class imghost extends main {
    private $db;
    private $imagedir = 'img/';
    private $thumbdir = 'thumb/';
    private $maxSize = 1536;

    
    public function  __construct() {
        parent::__construct();
        
        $this->db = new db('sqlite:'.F3::get('imgdb'));

        if(!function_exists('imagecreatetruecolor'))
            return false;

        if(!file_exists(F3::get('imgdb'))) {
            $this->db->sql('CREATE TABLE img_users (
		   userID INTEGER PRIMARY KEY,
		   userName VARCHAR,
		   userMail VARCHAR,
		   regDate INTEGER,
		   userPass VARCHAR);');

            $this->db->sql('CREATE TABLE img_images (
		   imageID INTEGER PRIMARY KEY,
		   hash VARCHAR,
		   numClicks INTEGER,
		   insertDate INTEGER,
		   deleteString VARCHAR,
           sum VARCHAR,
		   uploadedBy INTEGER,
           ext VARCHAR);');
        }
    }


    public function delImg() {
        $del = $this->get('PARAMS.del');
        $img = $this->get('PARAMS.img');

        $ax = new Axon('img_images');
        $ax->load('hash = "' .$img. '" AND deleteString = "'.$del.'"');

        # deletion works w/o being logged in for now
        if(!$ax->dry()) {
            $ext = $ax->ext;
            $hash = $ax->hash;

            unlink('img/'.$hash.$ext);
            unlink('thumb/'.$hash.$ext);

            $ax->erase();

            $this->set('SUCCESS', 'Image has been deleted');
            $this->set('template', 'add.tpl.php');
            $this->tpServe();
            return true;
        } else {
            $this->set('ERROR', 'Delete string and image name do not match.');
            $this->set('template', 'add.tpl.php');
            $this->tpServe();
            return false;
        }
    }
    

    public function addImg() {
        if($this->get('FILES.image.error')) {
            $this->set('ERROR', 'There was an error while uploading.');
            $this->set('template', 'add.tpl.php');
            $this->tpServe();
            return false;
        }
        
        $imgTmpName = $this->get('FILES.image.tmp_name');
        $imgOrigName = $this->get('FILES.image.name');
        $imgSize = round($this->get('FILES.image.size') / 1024, 2);
        $imgSum = md5_file($imgTmpName);
        
        if($this->checkImg($imgSize, $imgTmpName)) {
            $imgType = $this->get('imgInfo.2');
            $ext = $this->getExt($imgType);
            
            do {
                $imgNewName = $this->randString();
                $ax = new Axon('img_images');
                $ax->load('hash = "' .$imgNewName. '"');                
            } while(!$ax->dry());
            
            if(move_uploaded_file($imgTmpName, $this->imagedir . $imgNewName.$ext)) {
                $this->createThumb($imgType, $imgNewName, $ext);
                $delString = $this->randString();

                $user= new user;
                $ax = new Axon('img_images');
                
                $ax->hash = $imgNewName;
                $ax->insertDate = time();
                $ax->deleteString = $delString;
                $ax->sum = $imgSum;
                $ax->uploadedBy = $user->getUserId();
                $ax->ext = $ext;
                $ax->save();

                $this->set('ext', $ext);
                $this->set('name', $imgNewName);
                $this->set('del', $delString);

                $this->set('template', 'showInfo.php');
                $this->tpServe();
            } else {
                $this->set('ERROR', 'Missing write permissions on destination dir.');
                $this->set('template', 'add.tpl.php');
                $this->tpServe();
                return false;
            }
        }        
    }


    public function createThumb($type, $name, $ext) {
        $filename = $name.$ext;
        $width = $this->get('imgInfo.1');
        $height = $this->get('imgInfo.1');
        $thumb_width = 200;
        $percent_width = $thumb_width * 100 / $width;
        $thumb_height = $height * $percent_width / 100;

        switch($type) {
            case 1:
                $src = imagecreatefromgif($this->imagedir.$filename); break;
            case 2:
                $src = imagecreatefromjpeg($this->imagedir.$filename); break;
            case 3:
                $src = imagecreatefrompng($this->imagedir.$filename); break;
        }

        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
        imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
        
        switch($type){
            case 1:
                imagegif($thumb, $this->thumbdir.$filename); break;
            case 2:
                imagejpeg($thumb, $this->thumbdir.$filename); break;
            case 3:
                imagepng($thumb, $this->thumbdir.$filename); break;
        }

        imagedestroy($thumb);
    }
    
    
    // Found this function somewhere on the web a long time ago, sorry no credits yet
    public function imagecreatefrombmp($p_sFile) {
         $file = fopen($p_sFile, "rb");
         $read = fread($file, 10);
         
         while(!feof($file) && ($read <> ""))
             $read .= fread($file, 1024);

         $temp = unpack("H*", $read);
         $hex = $temp[1];
         $header = substr($hex, 0, 108);

         if(substr($header, 0, 4) == "424d") {
             $header_parts = str_split($header, 2);
             $width = hexdec($header_parts[19].$header_parts[18]);
             $height = hexdec($header_parts[23].$header_parts[22]);
             unset($header_parts);
         }

         $x = 0;
         $y = 1;
         $image = imagecreatetruecolor($width, $height);
         $body = substr($hex, 108);
         $body_size = (strlen($body) / 2);
         $header_size = ($width * $height);
         $usePadding = ($body_size > ($header_size * 3) + 4);

         for ($i = 0; $i < $body_size; $i += 3) {
             if ($x >= $width) {
                 if($usePadding)
                     $i += $width % 4;

                 $x = 0;
                 $y++;

                 if($y > $height)
                     break;
             }

             $i_pos = $i*2;
             $r = hexdec($body[$i_pos+4].$body[$i_pos+5]);
             $g = hexdec($body[$i_pos+2].$body[$i_pos+3]);
             $b = hexdec($body[$i_pos].$body[$i_pos+1]);

             $color = imagecolorallocate($image, $r, $g, $b);
             imagesetpixel($image, $x, $height - $y, $color);
             $x++;
         }

         unset($body);
         return $image;
     }
    

    private function checkImg($size, $imgName) {
        if($size > $this->maxSize)
            return false;
        
        $this->set('imgInfo', getimagesize($imgName));
        if(!in_array($this->get('imgInfo.2'), array(1,2,3)))
            return false;
            
        return true;
    }


    private function getExt($number) {
        switch($number) {
            case 1:
                return '.gif'; break;
            case 2:
                return '.jpg'; break;
            case 3:
                return '.png'; break;
        }
    }
    
     
    private function randString() {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
    }
}

?>