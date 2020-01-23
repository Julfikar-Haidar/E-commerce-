<?php 
$filepath=  realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/format.php');
?>


<?php
class Brand{
    private $db;
    private $fm;
    
public function __construct(){
        $this->db=new Database();
        $this->fm=new format();
}
public function addBrand($brandName){
    $brandName=  $this->fm->validation($brandName);
    
    $brandName=  mysqli_real_escape_string($this->db->link,$brandName);
    
    if(empty($brandName)){
        $msg="<span class='error'> Brand Name Field Must Not Be Empty..!</span>";
              return $msg;
    }  else {
        $query="INSERT INTO tbl_brands (brandName)VALUES('$brandName')";   
        $result=  $this->db->insert($query);
        if($result){
            $msg="<span class='success'> Brand Name Inserted Successfully</span>";
              return $msg;
        }else{
            $msg="<span class='error'> Brand Name Not Inserted </span>";
             return $msg; 
        }
    }
}
public function getallBrandcat(){
    $query="select *from tbl_brands order by brandId desc";
    $result=  $this->db->select($query);
    return $result;
}
public function getbrandidBy($id){
    $query="select *from tbl_brands where brandId='$id'";
    $result=  $this->db->select($query);
    return $result;
            
}
public function UpdateBrand($brandName,$id){
    $brandName=  $this->fm->validation($brandName);
    
    $brandName=  mysqli_real_escape_string($this->db->link,$brandName);
    $id       =  mysqli_real_escape_string($this->db->link,$id);
    if(empty($brandName)){
          $msg="<span class='error'> Brand Name Field Must Not Be Empty..!</span>";
              return $msg;
    }else{
        $query="UPDATE tbl_brands SET brandName='$brandName' where brandId='$id' ";
        $update_row=  $this->db->update($query);
        if($update_row){
            $msg="<span class='success'>Brand Name Updated Successfully</span>";
              return $msg;
        }else{
           $msg="<span class='error'> Brand Name Not Updated </span>";
              return $msg;
        }
    }
}
public function delteById($id){
    $query="delete from tbl_brands where brandId='$id'";
    $delete_row=  $this->db->delete($query);
    if($delete_row){
        $msg="<span class='success'> Brand Name Deleted Successfully</span>";
        return $msg;
        }  else {
        $msg="<span class='error'> Brand Name Not Deleted </span>";
        return $msg;
        } 
    
}
}