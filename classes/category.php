<?php 
$filepath=  realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/format.php');
?>

<?php


class Category{
    
    private $db;
    private $fm;
    public function __construct(){
        $this->db=new Database();
        $this->fm=new format();
    }
    public function catInsert($catName){
       $catName=$this->fm->validation($catName);
       
       $catName=  mysqli_real_escape_string($this->db->link,$catName);
       
       if(empty($catName)){
           $msg="<span class='error'> Category Field Must Not Be Empty..!</span>";
              return $msg;
       }else{
           $query="INSERT INTO tbl_category (catName)VALUES('$catName')";
           $result=$this->db->insert($query);
           if($result){
              $msg="<span class='success'> Category Inserted Successfully</span>";
              return $msg;
           }  else {
              $msg="<span class='error'> Category Not Inserted </span>";
             return $msg;    
           }
       }
       
    }
     public function getallcategory(){
        $query="SELECT *from tbl_category order by catId desc";
        $result=  $this->db->select($query);
        return $result;
    }
    public function getcatidBy($id){
        $query="SELECT *from tbl_category where catId='$id'";
        $result=  $this->db->select($query);
        return $result;
    }
    public function catUpdate($catName,$id){
        $catName=$this->fm->validation($catName);
       
       $catName=  mysqli_real_escape_string($this->db->link,$catName);
       $id     =  mysqli_real_escape_string($this->db->link,$id);
       
       if(empty($catName)){
           $msg="<span class='error'> Category Field Must Not Be Empty..!</span>";
              return $msg;
       }else{
        $query="UPDATE tbl_category SET  catName='$catName' where catId='$id'";
        $update_row=  $this->db->update($query);
        if($update_row){
            $msg="<span class='success'> Category Updated Successfully</span>";
              return $msg;
        }  else {
            $msg="<span class='error'> Category Not Updated </span>";
              return $msg;
        }
        
        }

    }
    public function delteById($idc){
        $query="delete from tbl_category where catId='$idc'";
        $delete_row=  $this->db->delete($query);
        if($delete_row){
            $msg="<span class='success'> Category Deleted Successfully</span>";
              return $msg;
        }  else {
            $msg="<span class='error'> Category Not Deleted </span>";
              return $msg;
        }
    }
    
//    public function count($catId){
//        $conn = mysqli_connect('localhost', 'root', '', 'db_shop');
//        
//        $query = "SELECT count(*) as total FROM tbl_products WHERE catId='$catId'";
//        $query = mysqli_query($conn, $query);
//        $rows = mysqli_fetch_assoc($query);
//        <?php echo $cat->count($result['catId']); 
//        return $rows['total'];
        
  //  }
}