<?php 
$filepath=  realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/format.php');
?>
<?php

class Customer{
    private $db;
    private $fm;
    
public function __construct(){
        $this->db=new Database();
        $this->fm=new format();
}

public function customerRegistration($data){
    $name=$this->fm->validation($data['name']);
    $city=$this->fm->validation($data['city']);
    $zipcode=$this->fm->validation($data['zipcode']);
    $email=$this->fm->validation($data['email']);
    $address=$this->fm->validation($data['address']);
    $country=$this->fm->validation($data['country']);
    $phone=$this->fm->validation($data['phone']);
    $password=  md5(($data['password']));
   
    
    $name =  mysqli_real_escape_string($this->db->link,$name);
    $city =  mysqli_real_escape_string($this->db->link,$city);
    $zipcode =  mysqli_real_escape_string($this->db->link,$zipcode);
    $email =  mysqli_real_escape_string($this->db->link,$email);
    $address =  mysqli_real_escape_string($this->db->link,$address);
    $country =  mysqli_real_escape_string($this->db->link,$country);
    $phone =  mysqli_real_escape_string($this->db->link,$phone);
    $password =  mysqli_real_escape_string($this->db->link,$password);

      if ($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" || $country == "" || $phone== "" || $password== "") {
            $msg="<span class='error'> Fields  Must Not Empty..!</span>";
              return $msg;            
    }
    $mailcheck="select *from tbl_customer where email='$email' limit 1";
    $result=  $this->db->select($mailcheck);
    if($result !=FALSE){
         $msg="<span class='error'> Email  Already  Exist ..!</span>";
              return $msg;
    }  else {
        
    $query = "INSERT INTO tbl_customer(name,city,zipcode,email,address,country,phone,password) VALUES('$name','$city','$zipcode','$email','$address','$country','$phone','$password')";
    $inserted_rows = $this->db->insert($query);
     if ($inserted_rows) {
            $msg="<span class='success'> Customer Inserted Successfully</span>";
              return $msg;
            } else {
            $msg="<span class='error'> Customer Not Inserted Successfully</span>";
              return $msg;      
            }
    }
}
public function customerLoginSystem($data){
    $email   =  mysqli_real_escape_string($this->db->link,$data['email']);
    $password=  mysqli_real_escape_string($this->db->link,  md5($data['password']));
       
       if(empty($email)||empty($password)){
           $msg="<span class='error'> Field must Not Empty !</span>";
              return $msg;
}
       $query="select *from  tbl_customer where email='$email' AND password='$password' ";
           $result=$this->db->select($query);
    if($result !=FALSE){
       $value=$result->fetch_assoc();
       session::set('customerLogin', TRUE);
       session::set('customerId', $value['id']);
       session::set('customerName', $value['name']);
       header("Location:order.php");
    }else{
        $msg="<span class='error'> User Name and Password  Not  Match ..!</span>";
              return $msg;
    }
    
}
public function SingleCustomer($id){
    $query="select *from tbl_customer where id='$id'";
    $result=  $this->db->select($query);
    return $result;
}
public function customerRegisterUpdate($data,$id){
    $name=$this->fm->validation($data['name']);
    $city=$this->fm->validation($data['city']);
    $zipcode=$this->fm->validation($data['zipcode']);
    $email=$this->fm->validation($data['email']);
    $address=$this->fm->validation($data['address']);
    $country=$this->fm->validation($data['country']);
    $phone=$this->fm->validation($data['phone']);
   
    
    $name =  mysqli_real_escape_string($this->db->link,$name);
    $city =  mysqli_real_escape_string($this->db->link,$city);
    $zipcode =  mysqli_real_escape_string($this->db->link,$zipcode);
    $email =  mysqli_real_escape_string($this->db->link,$email);
    $address =  mysqli_real_escape_string($this->db->link,$address);
    $country =  mysqli_real_escape_string($this->db->link,$country);
    $phone =  mysqli_real_escape_string($this->db->link,$phone);
    
        if ($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" || $country == "" || $phone== "") {
            $msg="<span class='error'> Fields  Must Not Empty..!</span>";
              return $msg;            
    }else{
         $query="UPDATE tbl_customer SET  name='$name',city='$city',zipcode='$zipcode',email='$email',address='$address',country='$country',
                phone='$phone'  where id='$id'";
        $update_row=  $this->db->update($query);
        if($update_row){
            $msg="<span class='success'> Cutomer Profile Updated Successfully</span>";
              return $msg;
        }  else {
            $msg="<span class='error'>  Cutomer Profile Not Updated </span>";
              return $msg;
        }
    }
 
}
}