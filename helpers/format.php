<?php

class format {

    public function formateDate($date) {
        return date('F j,Y,g:i a', strtotime($date));
    }

    public function textshorten($text, $limit = 400) {

        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text . ".....";
        return $text;
    }
    
    public function validation($data){
        $data=  trim($data);
        $data=  stripcslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }
    
    //title method
    public function title(){
        $path=$_SERVER['SCRIPT_FILENAME'];
        $title=  basename($path,'.php');
        //$title=  str_replace('_', '', $title); if i used underscore(_)then its used and also used ucwords
        if($title=='index'){
            $title='home';
        }elseif ($title=='contact') {
            $title='contact';
            
        }
        return $title= ucfirst($title);
    }

}

?>
