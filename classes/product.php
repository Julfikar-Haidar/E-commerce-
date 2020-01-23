<?php 
$filepath=  realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/format.php');
?>
<?php

class Product{
    private $db;
    private $fm;
    
public function __construct(){
        $this->db=new Database();
        $this->fm=new format();
}
public function productInserted($data,$files){
       $productName=$this->fm->validation($data['productName']);
       $catId      =$this->fm->validation($data['catId']);
       $brandId    =$this->fm->validation($data['brandId']);
       $body       =$this->fm->validation($data['body']);
       $price      =$this->fm->validation($data['price']);
       $type       =$this->fm->validation($data['type']);
       
       $productNam =  mysqli_real_escape_string($this->db->link,$productName);
       $catId      =  mysqli_real_escape_string($this->db->link,$catId);
       $brandId    =  mysqli_real_escape_string($this->db->link,$brandId);
       $body       =  mysqli_real_escape_string($this->db->link,$body);
       $price      =  mysqli_real_escape_string($this->db->link,$price);
       $type       =  mysqli_real_escape_string($this->db->link,$type);
       
       $permited  = array('jpg', 'jpeg', 'png', 'gif');
       $file_name = $files['image']['name'];
       $file_size = $files['image']['size'];
       $file_temp = $files['image']['tmp_name'];

       $div           = explode('.', $file_name);
       $file_ext      = strtolower(end($div));
       $unique_image  = substr(md5(time()), 0, 10) . '.' . $file_ext;
       $uploaded_image= "upload/" . $unique_image;

    if ($productName == "" || $catId == "" || $brandId == "" || $price == "" || $type == "" || $file_name == "") {
            $msg="<span class='error'> Fields  Must Not Empty..!</span>";
              return $msg;            
    } elseif ($file_size > 1048567) {
            $msg="<span class='error'> Fields  Must Not Empty..!</span>";
              return $msg;    
    } elseif (in_array($file_ext, $permited) === false) {
            $msg="<span class='error'>You can upload only:-" . implode(', ', $permited) . "</span>";
              return $msg;  
    } else {
        move_uploaded_file($file_temp, $uploaded_image);
        $query = "INSERT INTO tbl_products(productName,catId,brandId,body,price,type,image) VALUES('$productName','$catId','$brandId','$body','$price','$type','$uploaded_image')";
        $inserted_rows = $this->db->insert($query);

        if ($inserted_rows) {
            $msg="<span class='success'> Product Inserted Successfully</span>";
              return $msg;
            } else {
            $msg="<span class='error'> Product Not Inserted Successfully</span>";
              return $msg;      
            }
    }
}
public function allProductshow(){
    $query="select p.*,c.catName,b.brandName from tbl_products as p ,tbl_category as c,tbl_brands as b
        where p.catId=c.catId AND p.brandId=b.brandId 
        order by p.product_id desc";
//    $query="select tbl_products.*,tbl_category.catName,tbl_brands.brandName
//        from tbl_products
//        INNER JOIN tbl_category ON tbl_products.catId=tbl_category.catId
//        INNER JOIN tbl_brands ON tbl_products.brandId=tbl_brands.brandId
//        order by tbl_products.product_id desc";
    $result=  $this->db->select($query);
    return $result;
}

 public function getproducById($id){
        $query="SELECT *from tbl_products where product_id='$id'";
        $result=  $this->db->select($query);
        return $result;
    }
public function productUpdated($data,$files,$id){
     $productName  =$this->fm->validation($data['productName']);
       $catId      =$this->fm->validation($data['catId']);
       $brandId    =$this->fm->validation($data['brandId']);
       $body       =$this->fm->validation($data['body']);
       $price      =$this->fm->validation($data['price']);
       $type       =$this->fm->validation($data['type']);
       
       $productNam =  mysqli_real_escape_string($this->db->link,$productName);
       $catId      =  mysqli_real_escape_string($this->db->link,$catId);
       $brandId    =  mysqli_real_escape_string($this->db->link,$brandId);
       $body       =  mysqli_real_escape_string($this->db->link,$body);
       $price      =  mysqli_real_escape_string($this->db->link,$price);
       $type       =  mysqli_real_escape_string($this->db->link,$type);
       
       $permited  = array('jpg', 'jpeg', 'png', 'gif');
       $file_name = $files['image']['name'];
       $file_size = $files['image']['size'];
       $file_temp = $files['image']['tmp_name'];

       $div           = explode('.', $file_name);
       $file_ext      = strtolower(end($div));
       $unique_image  = substr(md5(time()), 0, 10) . '.' . $file_ext;
       $uploaded_image= "upload/" . $unique_image;

    if ($productName == "" || $catId == "" || $brandId == "" || $price == "" || $type == "") {
            $msg="<span class='error'> Fields  Must Not Empty..!</span>";
              return $msg;            
    }else {
    if(!empty($file_name)){
            
   if ($file_size > 1048567) {
            $msg="<span class='error'> Fields  Must Not Empty..!</span>";
              return $msg;    
    }elseif (in_array($file_ext, $permited) === false) {
            $msg="<span class='error'>You can upload only:-" . implode(', ', $permited) . "</span>";
              return $msg;  
    }else{
        move_uploaded_file($file_temp, $uploaded_image);
        $query ="UPDATE tbl_products
            SET
            productName='$productName',
            catId      ='$catId',
            brandId    ='$brandId',
            body       ='$body',
            price      ='$price',
            type       ='$type',
            image      ='$uploaded_image'
            where product_id='$id'";    
        $updated_rows = $this->db->update($query);

        if ($updated_rows) {
            $msg="<span class='success'> Product Updated Successfully</span>";
              return $msg;
            } else {
            $msg="<span class='error'> Product Not Updated </span>";
              return $msg;      
            }
    }
    }else{
        $query ="UPDATE tbl_products
            SET
            productName='$productName',
            catId      ='$catId',
            brandId    ='$brandId',
            body       ='$body',
            price      ='$price',
            type       ='$type'
            where product_id='$id'";    
        $updated_rows  = $this->db->update($query);

        if ($updated_rows) {
            $msg="<span class='success'> Product Updated Successfully</span>";
              return $msg;
            } else {
            $msg="<span class='error'> Product Not Updated </span>";
              return $msg;      
            }
    }
    }
}
public function deleteById($id){
    $query="select *from tbl_products where product_id='$id'";
    $getproductdata=  $this->db->select($query);
    if($getproductdata){
        while ($result=$getproductdata->fetch_assoc()){
            $deleteimage=$result['image'];
            unlink($deleteimage);
        }
    }
    $query="delete from tbl_products where product_id='$id'";
    $delete_row=  $this->db->delete($query);
    if($delete_row){
        $msg="<span class='success'> Product Deleted Successfully</span>";
            return $msg;
        }else{
        $msg="<span class='error'> Product Not Deleted </span>";
            return $msg;
        }
}

public function showFeatureProduct(){
    $query="SELECT *from tbl_products where type='1' order by product_id desc limit 4";
    $result=  $this->db->select($query);
    return $result;
    
}
public function showNewProduct(){
    $query="SELECT *from tbl_products order by product_id desc limit 4";
    $result=  $this->db->select($query);
    return $result;
}
public function getSingleProductById($id){
    $query="select p.*,c.catName,b.brandName from tbl_products as p ,tbl_category as c,tbl_brands as b
    where p.catId=c.catId AND p.brandId=b.brandId AND p.product_id='$id'";
//    $query="select tbl_products.*,tbl_category.catName,tbl_brands.brandName
//  from tbl_products
//  INNER JOIN tbl_category ON tbl_products.catId=tbl_category.catId
//  INNER JOIN tbl_brands ON tbl_products.brandId=tbl_brands.brandId
//  order by tbl_products.product_id desc";
    $result=  $this->db->select($query);
    return $result;
}

public function latestbrandIphone(){
    $query="select *from tbl_products where brandId='1' order by product_id desc limit 1";
    $result=  $this->db->select($query);
    return $result;
}
public function latestbrandISamsung(){
    $query="select *from tbl_products where brandId='3' order by product_id desc limit 1";
    $result=  $this->db->select($query);
    return $result;
}
public function latestbrandIAcer(){
    $query="select *from tbl_products where brandId='4' order by product_id desc limit 1";
    $result=  $this->db->select($query);
    return $result;
}
public function latestbrandCannon(){
    $query="select *from tbl_products where brandId='5' order by product_id desc limit 1";
    $result=  $this->db->select($query);
    return $result;
}
public function getProductcatById($id){
    $catId=  mysqli_real_escape_string($this->db->link,$id);
    $query="select *from tbl_products where catId='$catId'";
    $result=  $this->db->select($query);
    return $result;
}

public function insertComparedata($customerId,$productId){
    $customerId=  mysqli_real_escape_string($this->db->link,$customerId);
    $productId=  mysqli_real_escape_string($this->db->link,$productId);
    $checkquery="select *from tbl_compare where cmrId='$customerId' AND productId='$productId'";
    $check=  $this->db->select($checkquery);
    if($check){
        $msg="<span class='error'> Already  Exist ..!</span>";
              return $msg;
    }
    
  $query="select *from tbl_products where product_id='$productId'";
  $result=  $this->db->select($query)->fetch_assoc();
  if($result){
      $productId=$result['product_id'];
      $productName=$result['productName'];
      $price=$result['price'];
      $image=$result['image'];
     $query = "INSERT INTO tbl_compare(cmrId,productId,productName,price,image)
                    VALUES('$customerId','$productId','$productName','$price','$image')";
        $inserted_rows = $this->db->insert($query);
          if ($inserted_rows) {
            $msg="<span class='success'>Compare Added ! Check compare page</span>";
              return $msg;
            } else {
            $msg="<span class='error'> Compare Not Added</span>";
              return $msg;      
            }
  }
          
}

public function getCopareProduct($customerId){
    $query="select *from tbl_compare where cmrId='$customerId' order by id desc";
    $result=  $this->db->select($query);
    return $result;
}
public function compareRemovedata($customerId){
    $query="delete from tbl_compare where cmrId='$customerId'";
    $result=  $this->db->delete($query);
    return $result;
}

public function saveWishlist($id,$customerId){
    $productId=  mysqli_real_escape_string($this->db->link,$id);
    $customerId=  mysqli_real_escape_string($this->db->link,$customerId);
    $checkquery="select *from tbl_wishlist where cmrId='$customerId' AND productId='$productId'";
    $check=  $this->db->select($checkquery);
    if($check){
        $msg="<span class='error'> Already  Exist ..!</span>";
              return $msg;
    }
    
  $query="select *from tbl_products where product_id='$productId'";
  $result=  $this->db->select($query)->fetch_assoc();
  if($result){
      $productId=$result['product_id'];
      $productName=$result['productName'];
      $price=$result['price'];
      $image=$result['image'];
     $query = "INSERT INTO tbl_wishlist(cmrId,productId,productName,price,image)
                    VALUES('$customerId','$productId','$productName','$price','$image')";
        $inserted_rows = $this->db->insert($query);
          if ($inserted_rows) {
            $msg="<span class='success'>Wishlist Added ! Check Wishlist page</span>";
              return $msg;
            } else {
            $msg="<span class='error'> Wishlist Not Added</span>";
              return $msg;      
            }
  }
}
public function getdatawishlistProduct($customerId){
    $query="select *from tbl_wishlist where cmrId='$customerId' order by id desc";
    $result=  $this->db->select($query);
    return $result;
}
public function deleteWishlist($customerId,$id){
     $query="delete from tbl_wishlist where cmrId='$customerId' AND productId='$id'";
    $result=  $this->db->delete($query);
    return $result; 
}
}