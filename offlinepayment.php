<?php include 'inc/header.php'; ?>
<?php
$login= session::get('customerLogin');
if($login==FALSE){
    header("Location:login.php");
}
?>
   <?php
if(isset($_POST['registration'])){
header("Location:editprofile.php");
exit;
}
   ?> 
<?php
if(isset($_GET['orderId'])&& $_GET['orderId']='order' ){
    $customerId= session::get('customerId');
    $inserOrder=$cart->orderProduct($customerId);
    $productremoveCart=$cart->logoutproductremoveCart();
    header("Location:success.php");
}

?>
<style>
    .division1{width: 550px;float: left;}
    .division2{width: 500px;float: left; height: 500px;}
    .division3 {width:200px;text-align: center;margin:0 auto;}
    .division3 a {padding:15px 40px;text-align: center;background:#666666;color: #fff;border-radius: 5px;transition: 0.5s;font-size:20px;}
    .division3 a:hover{background:#ff0000;color: #fff;}
    .reg1{width:426px;height: auto;}
</style>
 <div class="main">
    <div class="content">
    	 
        <div class="division1">
            <div class="cartpage">
                <h2>Your Cart</h2>
            <?php
            if (isset($updatecart)) {
                echo $updatecart;
            }
            if (isset($deleteCart)) {
                echo $deleteCart;
            }
            ?>
                <table class="tblone">

                    <tr>
                        <th width="5%">SL</th>
                        <th width="20%">Product Name</th>
                        <th width="15%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="20%">Total Price</th>
                    </tr>
                    <tr>
                            <?php
                            $getCart = $cart->getCartProduct();
                            if ($getCart) {
                            $i = 0;
                            $sum = 0;
                            $Quntity = 0;
                            while ($result = $getCart->fetch_assoc()) {
                                $i++;
                                    ?>
                            <td><?php echo $i; ?> </td>
                            <td><?php echo $result['productName']; ?></td>
                            <td>$ <?php echo $result['price']; ?></td>
                            <td><?php echo $result['quantity']; ?></td>
                            <td>$ <?php
                             $totalPrice = $result['quantity'] * $result['price'];
                             echo $totalPrice;
                        ?>
                                </td>
                            </tr>
                            <?php
                            $sum = $sum + $totalPrice;
                            $Quntity = $Quntity + $result['quantity'];
                            session::set("Quntity", $Quntity);
                            ?>
                        <?php }
                    } ?>
                </table>
                    <?php
                    $getdata = $cart->checkCartTable();
                    if ($getdata) {
                        ?>
                    <table style="float:right;text-align:left;" width="40%">

                        <tr>
                            <th>Sub Total = </th>
                            <td>$ <?php echo $sum; ?> </td>
                        </tr>
                        <tr>
                            <th>VAT = </th>
                            <td>$. 10%(<?php echo $vat = $sum * 0.1;?>)</td>
                        </tr>
                        <tr>
                            <th>Quantity = </th>
                            <td><?php echo session::get("Quntity");?></td>
                        </tr>
                        <tr>
                            <th>Grand Total=</th>
                            <td>$ <?php
                $vat = $sum * 0.1;
                $grandTotal = $sum + $vat;
                echo $grandTotal; 

               session::set("sum", $grandTotal);

                ?>
                            </td>
                        </tr>
                    </table>
                            <?php
                            } else {
                                header("Location:index.php");
                            }
                            ?>
            </div>
        </div>
        <div class="division2">
            <div class="register_account reg reg1">
      
            <h3>Your Profile Details</h3>
            <?php 
               $id=session::get('customerId');
                $customerProfile=$customer->SingleCustomer($id); 
                if($customerProfile){
                    while ($result=$customerProfile->fetch_assoc()){?>
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
                <?php }}?>
        </div>
        </div>
        <div class="division3">
            <a href="?orderId=order">Order</a>
        </div>
       <div class="clear"></div>
    </div>
 </div>
<?php include'inc/footer.php'; ?>