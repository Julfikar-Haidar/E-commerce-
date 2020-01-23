<?php include 'inc/header.php'; ?>

<?php
$login= session::get('customerLogin');
if($login==FALSE){
    header("Location:login.php");
}
?>


            <?php 
               $id=session::get('customerId');
            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['registration'])){

                $customerRegisterUpdate=$customer->customerRegisterUpdate($_POST,$id);  

            }
?>
<style>
    .reg{ margin: 20px auto; float:none}
</style>
<div class="main">
    <div class="content">

        <div class="register_account reg">
            <?php
            if(isset($customerRegisterUpdate)){
                echo $customerRegisterUpdate;
            }
            ?>
      
            <h3>Update Profile Details</h3>
            <?php 
         $getdata=$customer->SingleCustomer($id);
         if($getdata){
             while ($result=$getdata->fetch_assoc()){

?>
            <form action="" method="POST" enctype="multipart/form-data">


                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <input type="text" name="name" value="<?php echo $result['name'];?>" >
                                </div>

                                <div>
                                    <input type="text" name="city" value="<?php echo $result['city'];?>" >
                                </div>

                                <div>
                                    <input type="text" name="zipcode" value="<?php echo $result['zipcode'];?>">
                                </div>
                                <div>
                                    <input type="text" name="email" value="<?php echo $result['email'];?>">
                                </div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="address" value="<?php echo $result['address'];?>" >
                                </div>

                                <div>
                                    <input type="text" name="country" value="<?php echo $result['country'];?>" >
                                </div>

                                <div>
                                    <input type="text" name="phone"value="<?php echo $result['phone'];?>" >
                                </div>

                            </td>
                        </tr> 
                    </tbody>
                </table> 
                <div class="search"><div><button class="grey" name="registration">Update Account</button></div></div>
                <div class="clear"></div>
            </form>
            <?php
            
         }}
            ?>
        </div>  	
        <div class="clear"></div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>