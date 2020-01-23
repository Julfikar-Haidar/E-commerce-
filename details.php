<?php include 'inc/header.php'; ?>
<?php
if (!isset($_GET['productId']) || $_GET['productId'] == NULL) {
    echo "<script>window.location='404.php'</script>";
} else {
    $id = preg_replace("/[^A-Za-z0-9?! ]/", "", $_GET['productId']);
}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
  $quantity=$_POST['quantity'];
  $addcart=$cart->addCartproduct($quantity,$id);  
}
?>
       <?php 
             $customerId=session::get('customerId');
            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['compare'])){
              $productId=$_POST['product_id'];
              
                $insertCompare=$product->insertComparedata($customerId,$productId);  

            }
             if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['wishlist'])){
              $wishlist=$product->saveWishlist($id,$customerId);  

            }
?>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="cont-desc span_1_of_2">	
                <?php
                $getProduct=$product->getSingleProductById($id);
                if($getProduct){
                    while ($result=$getProduct->fetch_assoc()){

                ?>
                <div class="grid images_3_of_2">
                    <img src="admin/<?php echo $result['image'];?>" alt="" />
                </div>
                <div class="desc span_3_of_2">
                    <h2><?php echo $result['productName'];?> </h2>
                    <p><?php echo $fm->textshorten($result['body'],100);?></p>					
                    <div class="price">
                        <p>Price: <span>$ <?php echo $result['price'];?></span></p>
                        <p>Category: <span><?php echo $result['catName'];?></span></p>
                        <p>Brand:<span><?php echo $result['brandName'];?></span></p>
                    </div>
                    <div class="add-cart">
                        
                        <span style="color: red;font-size: 18px;">
                           <?php
                            if(isset($addcart)){
                                echo $addcart;
                            }
                           ?>
                        
                        </span>
                        
                        <form action="" method="post">
                            <input type="number" class="buyfield" name="quantity" value="1"/>
                            <input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
                        </form>	
                        
                    </div>
                       <div class="add-cart">
                                <?php
                            if(isset($insertCompare)){
                                echo $insertCompare;
                            }
                             if(isset($wishlist)){
                                echo $wishlist;
                            }
                           ?>
                            <?php
                            //only show in log in otherwise not
                $login= session::get('customerLogin');
                if($login==TRUE){?>
                       <form action="" method="post">
                           <input type="hidden" class="buyfield" name="product_id" value="<?php echo $result['product_id'];?>"/>
                            <input type="submit" class="buysubmit" name="compare" value="Add to Compare "/>
                            <input type="submit" class="buysubmit" name="wishlist" value="Save wishlist "/>
                        </form>	
                <?php }?>
                    </div>
                </div>
                <div class="product-desc">
                    <h2>Product Details</h2>
                    <p><?php echo $result['body'];?></p>
                </div>
                
                <?php }}?>

            </div>
            <div class="rightsidebar span_3_of_1">
                <h2>CATEGORIES</h2>
                <ul>
                    <?php
                    $getdata=$cat->getallcategory();
                    if($getdata){
                        while ($result=$getdata->fetch_assoc()){

                    ?>
                    <li><a href="productbycat.php?catId=<?php echo $result['catId'];?>"><?php echo $result['catName'];?> </a></li>
                    <?php }}?>

                </ul>

            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>