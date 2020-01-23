<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/customer.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
if(!isset($_GET['cmrId'])|| $_GET['cmrId']==NULL){
    echo "<script>window.location='inbox.php'</script>";
}  else {
        $id=$_GET['cmrId'];
    $id=preg_replace("/[^A-Za-z0-9?! ]/","",$_GET['cmrId']);
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    echo "<script>window.location='inbox.php'</script>";
}


?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Details</h2>
               <div class="block copyblock"> 

                   <?php  
                   $customer=new customer();
                   $SingleCustomer=$customer->SingleCustomer($id);
                   if($SingleCustomer){
                       while ($result=$SingleCustomer->fetch_assoc()){

                   ?>
                   <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" readonly value="<?php echo $result['name']; ?>" name="name" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" readonly value="<?php echo $result['city']; ?>" name="city" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text"  readonly value="<?php echo $result['zipcode']; ?>" name="zipcode" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" readonly value="<?php echo $result['country']; ?>" name="country" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <input type="text" readonly value="<?php echo $result['email']; ?>" name="email" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <input type="text" readonly value="<?php echo $result['address']; ?>" name="address" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <input type="text" readonly value="<?php echo $result['phone']; ?>" name="phone" class="medium" />
                            </td>
                        </tr>
                          <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Read" />
                            </td>
                        </tr>
                    </table>
                    </form>
                   <?php }}?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>