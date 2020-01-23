<?php include 'inc/header.php'; ?>

<?php
$login= session::get('customerLogin');
if($login==FALSE){
    header("Location:login.php");
}
?>

<style>
    .pay{border:2px solid #ddd; width: 500px;margin: 30px auto;height:300px; text-align: center;}
    .pay h3{color:#60D44D;font-size: 30px;font-weight: bold; border-bottom:2px solid #ddd;padding: 10px;margin-bottom:70px;}
    .pay p{ font-size: 18px;text-align: justify;padding:10px;}
    .am{color: #ff0000;}
</style>
<div class="main">
    <div class="content">
         <div class="pay">
            <h3>Success</h3>
                         <?php  
                            $customerId=session::get('customerId');
                            $getdata=$cart->totalpayamount($customerId);
                            if($getdata){
                                $sum=0;
                                while ($result=$getdata->fetch_assoc()){
                                    $price=$result['price'];
                                    $sum=$sum+$price;
                                }
                            }

                             ?>
       
            <p class="am">Total payable amount(including vat):$
            <?php 
            $vat=$sum*0.1;
            $total=$sum+$vat;
            echo $total;
            
            ?>
            </p>
            <p>Thanks for purchase.Recive your order successfully.
            We will contact you soon as delivery details.Here is your order details....<a href="order.php">Visit here.</a></p>
           
        </div>  
       
        <div class="clear"></div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>