<?php include 'inc/header.php'; ?>

<style>
    .com h2{width: 250px;}
   table.tblone img { height: 70px; width: 90px;}
</style>


<div class="main">
    <div class="content">
        <div class="cartoption">		
            <div class="cartpage com">
                <h2>Compare Product</h2>

                <table class="tblone">

                    <tr>
                        <th width="5%">SL</th>
                        <th width="20%">Product Name</th>
                        <th width="15%">Price</th>
                        <th width="25%">image</th>
                        <th width="15%">Action</th>
                    </tr>
                    <tr>
                            <?php
                            $customerId=session::get('customerId');

                            $getCart = $product->getCopareProduct($customerId);
                            if ($getCart) {
                            $i = 0;
                       
                            while ($result = $getCart->fetch_assoc()) {
                                $i++;
                                    ?>
                            <td><?php echo $i; ?> </td>
                            <td><?php echo $result['productName']; ?></td>
                            <td>$ <?php echo $result['price']; ?></td>

                            <td><img src="admin//<?php echo $result['image']; ?>" alt=""/></td>

                            <td><a href="details.php?productId=<?php echo $result['productId'];?>" class="details">View</a></td>
                            </tr>
                         
                        <?php }
                    } ?>
                </table>
                   

                     
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