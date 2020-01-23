<?php include 'inc/header.php'; ?>



<?php
if (isset($_GET['delcart'])) {
    $delid = preg_replace("/[^A-Za-z0-9?! ]/", "", $_GET['delcart']);
    $deleteCart = $cart->deleteCartById($delid);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = $_POST['quantity'];
    $carId = $_POST['carId'];
    $updatecart = $cart->updateCartQuantity($quantity, $carId);
    if ($quantity <= 0) {
        $deleteCart = $cart->deleteCartById($carId); //i already got id that mens cartid not use $delid
    }
}
?>
<?php
//cart refresh cahce
if(!isset($_GET['id'])){
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
}

?>

<div class="main">
    <div class="content">
        <div class="cartoption">		
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
                        <th width="20%">Image</th>
                        <th width="15%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="20%">Total Price</th>
                        <th width="15%">Action</th>
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
                            <td><img src="admin//<?php echo $result['image']; ?>" alt=""/></td>
                            <td>$ <?php echo $result['price']; ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
                                    <input type="hidden" name="carId" value="<?php echo $result['carId']; ?>"/>
                                    <input type="submit" name="submit" value="Update"/>
                                </form>
                            </td>
                            <td>$ <?php
                             $totalPrice = $result['quantity'] * $result['price'];
                             echo $totalPrice;
                        ?>
                                </td>
                                <td><a onclick="return confirm('Are You Sure To delete..!')" href="?delcart=<?php echo $result['carId']; ?>">X</a></td>
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
                            <td>$. 10%</td>
                        </tr>
                        <tr>
                            <th>Grand Total =</th>
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
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"> <img src="images/check.png" alt="" /></a>
                </div>
            </div>
        </div>  	
        <div class="clear"></div>
    </div>
</div>
<?php include'inc/footer.php'; ?>