<?php include 'inc/header.php'; ?>

<?php

if(!isset($_GET['catId'])|| $_GET['catId']==NULL){
    echo "<script>window.location:'404.php'</script>";
}  else {
    $id=preg_replace("/[^A-Za-z0-9?! ]/","",$_GET['catId']);
}
?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Latest from Category </h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php 
            $getdata=$product->getProductcatById($id);
            if($getdata){
                while ($result=$getdata->fetch_assoc()){

            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="preview-3.php"><img src="admin/<?php echo $result['image'];?>" alt="" /></a>
                <h2><?php echo $result['productName'];?> </h2>
                <p><?php echo $fm->textshorten($result['body'],50);?></p>
                <p><span class="price">$<?php echo $result['price'];?></span></p>
                <div class="button"><span><a href="details.php?productId=<?php echo $result['product_id'];?>" class="details">Details</a></span></div>
            </div>
            <?php }}  else {
              header("Location:404.php"); 
    
}?>
        </div>



    </div>
</div>
<?php include 'inc/footer.php'; ?>
