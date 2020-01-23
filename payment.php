<?php include 'inc/header.php'; ?>

<?php
$login= session::get('customerLogin');
if($login==FALSE){
    header("Location:login.php");
}
?>

<style>
    .pay{border:2px solid #ddd; width: 500px;margin: 30px auto;height:300px; text-align: center;}
    .pay h3{color:#6C6C6C;font-size: 30px;font-weight: bold; border-bottom:2px solid #ddd;padding: 10px;margin-bottom:70px;}
    .pay a{ text-align: center;color:#fff;font-size: 25px;font-weight: 400;border:1px solid #6C6C6C;background:#6C6C6C;transition: 0.5s;border-radius:5px;padding:10px;}
    .pay a:hover{background:#ff0000;color: #fff;border-color:#ff0000; }
    .back{width:200px;text-align: center;margin:0 auto;}
    .back a{padding:15px 40px;text-align: center;background:#6C6C6C;color: #fff;border-radius: 5px;transition: 0.5s;font-size:20px;}
    .back a:hover{background:#ff0000;color: #fff;}
</style>
<div class="main">
    <div class="content">

        <div class="pay">
            <h3>Choose Payment System</h3>
            <a href="offlinepayment.php">Offline Payment</a>
            <a href="onlinepayment.php">Online Payment</a>
            
        </div>  
        <div class="back">
            <a href="cart.php">Previous</a>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>