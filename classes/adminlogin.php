<?php 
$filepath=  realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../lib/session.php');


session::checkLogin();
?>

<?php


class adminlogin{
    
    private $db;
    private $fm;
    public function __construct(){
        $this->db=new Database();
        $this->fm=new format();
    }
    public function login($adminUser,$adminPass){
       $adminUser=$this->fm->validation($adminUser);
       $adminPass=$this->fm->validation($adminPass);
       
       $adminUser=  mysqli_real_escape_string($this->db->link,$adminUser);
       $adminPass=  mysqli_real_escape_string($this->db->link,$adminPass);
       
       if(empty($adminUser)||empty($adminPass)){
           $loginmsg="User Name And Password Not Match !";
           return $loginmsg;
       }else{
           $query="select *from  tbl_adminuser where adminUser='$adminUser' AND adminPass='$adminPass' ";
           $result=$this->db->select($query);
           if($result!=FALSE){
               $value=$result->fetch_assoc();
               session::set('login',true);
               session::set('adminId',$value['adminId']);
               session::set('adminUser',$value['adminUser']);
               session::set('adminName',$value[adminName]);
               session::set('adminEmail',$value[adminEmail]);
               header("Location:index.php");
           }  else {
             $loginmsg="User Name And Password Not Match try again!";
             return $loginmsg;    
           }
       }
       
    }
}