
<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

<!-- FlexSlider -->
</div>
<div class="clear"></div>
</div>	

<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Feature Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $getProduct=$product->showFeatureProduct();
            if($getProduct){
                while ($result=$getProduct->fetch_assoc()){
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php?productId=<?php echo $result['product_id'];?>"><img src="admin/<?php echo $result['image'];?>" alt="" /></a>
                <h2><?php echo $result['productName'];?> </h2>
                <p><?php echo $fm->textshorten($result['body'],50);?></p>
                <p><span class="price">$<?php echo $result['price'];?></span></p>
                <div class="button"><span><a href="details.php?productId=<?php echo $result['product_id'];?>" class="details">Details</a></span></div>
            </div>
            <?php }}?>
          
        </div>
        <div class="content_bottom">
            <div class="heading">
                <h3>New Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
       <?php
            $getProduct=$product->showNewProduct();
            if($getProduct){
                while ($result=$getProduct->fetch_assoc()){
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php?productId=<?php echo $result['product_id'];?>"><img src="admin/<?php echo $result['image'];?>" alt="" /></a>
                <h2><?php echo $result['productName'];?> </h2>
                <p><?php echo $fm->textshorten($result['body'],50);?></p>
                <p><span class="price">$<?php echo $result['price'];?></span></p>
                <div class="button"><span><a href="details.php?productId=<?php echo $result['product_id'];?>" class="details">Details</a></span></div>
            </div>
            <?php }}?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php' ?>