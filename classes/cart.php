<?php 
$filepath=  realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/format.php');
?>
<?php

class Cart{
    private $db;
    private $fm;
    
public function __construct(){
        $this->db=new Database();
        $this->fm=new format();
}
public function addCartproduct($quantity,$id){
    $quantity       =$this->fm->validation($quantity);
       
    $quantity =  mysqli_real_escape_string($this->db->link,$quantity);
    $productId=  mysqli_real_escape_string($this->db->link,$id);
    $sId      =  session_id();
    
    $query="select *from tbl_products where product_id='$productId'";
    $result=  $this->db->select($query)->fetch_assoc();
    
    $productName=$result['productName'];
    $price      =$result['price'];
    $image      =$result['image'];
    
    //check duplicate this portion
    $checkquery="select *from tbl_cart where productId='$productId' AND sId='$sId'";
    $getProductfound   =  $this->db->select($checkquery);
    if($getProductfound){
        $msg=" Product Already Added..Pleaze Try Another...";
            return $msg;
    }else{
    
    $query = "INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image)VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
        $inserted_rows = $this->db->insert($query);

        if ($inserted_rows) {
            header("Location:cart.php");
            } else {
            header("Location:404.php");
    
            }
}
}
public function getCartProduct(){
    $sId      =  session_id();
    $query="select *from tbl_cart where sId='$sId'";
    $result=  $this->db->select($query);
    return $result;

}
public function updateCartQuantity($quantity,$carId){
    $quantity=$this->fm->validation($quantity);
    $carId=$this->fm->validation($carId);
       
    $catName   =  mysqli_real_escape_string($this->db->link,$quantity);
    $carId     =  mysqli_real_escape_string($this->db->link,$carId);
    
    $query="UPDATE tbl_cart SET  quantity='$quantity' where carId='$carId'";
        $update_row=  $this->db->update($query);
        if($update_row){
            header("Location:cart.php");
        }  else {
            $msg="<span class='error'> Quantity Not Updated </span>";
              return $msg;
        }
}
public function deleteCartById($id){
      $query="delete from tbl_cart where carId='$id'";
        $delete_row=  $this->db->delete($query);
        if($delete_row){
             echo "<script>Window.location='cart.php';</script>";
        }  else {
            $msg="<span class='error'> Product Not Deleted </span>";
              return $msg;
        }
}
public function checkCartTable(){
    $sId=  session_id();
    $query="select *from tbl_cart where sId='$sId'";
    $result=  $this->db->select($query);
    return $result;
}

public function logoutproductremoveCart(){
     $sId=  session_id();
    $query="delete from tbl_cart where sId='$sId'";
    $result=  $this->db->delete($query);
    return $result; 
}
public function orderProduct($customerId){
    $sId=  session_id();
    $query="select *from tbl_cart where sId='$sId'";
    $getdata=  $this->db->select($query);
    if($getdata){
        while ($result=$getdata->fetch_assoc()){
            $productId=$result['productId'];
            $productName=$result['productName'];
            $quantity=$result['quantity'];
            $price=$result['price']*$quantity;
            $image=$result['image'];
            $query = "INSERT INTO tbl_order(cmrId,productId,productName,quantity,price,image)
                    VALUES('$customerId','$productId','$productName','$quantity','$price','$image')";
        $inserted_rows = $this->db->insert($query);  
        }
    }
}

public function totalpayamount($customerId){
   $query="select price from tbl_order where cmrId='$customerId' AND date=now()";
    $result=  $this->db->select($query); 
    return $result;
}

public function getorderProduct($customerId){
    $query="select *from tbl_order where cmrId='$customerId'order by date desc";
    $result=  $this->db->select($query); 
    return $result; 
}

public function checkOrderTable($customerId){
    $query="select *from tbl_order where cmrId='$customerId'";
    $result=  $this->db->select($query); 
    return $result; 
}

public function allProductfromtable(){
   $query="select *from tbl_order order by date desc";
    $result=  $this->db->select($query); 
    return $result;  
}
public function productShift($id,$date,$oId){
     $id=  mysqli_real_escape_string($this->db->link,$id);
     $date=  mysqli_real_escape_string($this->db->link,$date);
     $oId=  mysqli_real_escape_string($this->db->link,$oId);
   $query="UPDATE tbl_order SET  status='2' where cmrId='$id' AND date='$date' AND id='$oId'";
        $update_row=  $this->db->update($query);
        if($update_row){
            $msg="<span class='success'>  Updated Successfully</span>";
              return $msg;
        }  else {
            $msg="<span class='error'>  Not Updated </span>";
              return $msg;
        }
}
public function removeproductShift($id,$date,$oId){
      $id=  mysqli_real_escape_string($this->db->link,$id);
     $date=  mysqli_real_escape_string($this->db->link,$date);
     $oId=  mysqli_real_escape_string($this->db->link,$oId);
           
     $query="delete from tbl_order where cmrId='$id' AND date='$date' AND id='$oId'";
        $delete_row=  $this->db->delete($query);
        if($delete_row){
              $msg="<span class='success'> Product Deleted </span>";
              return $msg;
        }  else {
            $msg="<span class='error'> Product Not Deleted </span>";
              return $msg;
        }
}
public function confirmProduct($id,$date,$oId){
      $id=  mysqli_real_escape_string($this->db->link,$id);
     $date=  mysqli_real_escape_string($this->db->link,$date);
     $oId=  mysqli_real_escape_string($this->db->link,$oId);
     $query="UPDATE tbl_order SET  status='3' where cmrId='$id' AND date='$date' AND id='$oId'";
        $update_row=  $this->db->update($query);
        if($update_row){
            $msg="<span class='success'>  Updated Successfully</span>";
              return $msg;
        }  else {
            $msg="<span class='error'>  Not Updated </span>";
              return $msg;
        } 
}
}