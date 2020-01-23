<?php include 'inc/header.php'; ?>
<?php
$login= session::get('customerLogin');
if($login==FALSE){
    header("Location:login.php");
}
?>
<style>
    .car h2{width: 268px;}
</style>
<?php
if(isset($_GET['delpro'])){
    $id=$_GET['delpro'];
    $date=$_GET['date'];
    $oId=$_GET['id'];
    $confirm=$cart->confirmProduct($id,$date,$oId);
}
?>
 <div class="main">
    <div class="content">
    	 
        <div class="cartpage car">
            <h2>Order page Details</h2>
            <table class="tblone">

                    <tr>
                        <th>SL</th>
                        <th >Product Name</th>
                        <th>Image</th>
                        <th >Quantity</th>
                        <th >Price</th>
                        <th >Date</th>
                        <th >Status</th>
                        <th >Action</th>
                    </tr>
                    <tr>
                            <?php
                            $customerId=session::get('customerId');

                            $getOrder = $cart->getorderProduct($customerId);
                            if ($getOrder) {
                            $i = 0;
                            $sum = 0;
                            $Quntity = 0;
                            while ($result = $getOrder->fetch_assoc()) {
                                $i++;
                                    ?>
                            <td><?php echo $i; ?> </td>
                            <td><?php echo $result['productName']; ?></td>
                            <td><img src="admin//<?php echo $result['image']; ?>" alt=""/></td>
                            <td><?php echo $result['quantity']; ?></td>
                            <td>$ <?php
                             $totalPrice = $result['quantity'] * $result['price'];
                             echo $totalPrice;
                        ?>
                                </td>
                           <td><?php echo $fm->formateDate($result['date']); ?></td>
                          <td> 
                              <?php 
                           if($result['status']==1){
                               echo 'Pending';
                           }elseif($result['status']==2){?>
           <a  href="?delpro=<?php echo $result['cmrId'];?>& date=<?php echo $result['date'];?>& id=<?php echo $result['id'];?> ">Shifted</a>
                          <?php }else{
                           echo 'confirm';
                          }?>
                         </td>
                            <?php 
                           if($result['status']==3){?>
                                <td><a href=" #">Shifted</a></td>
                          <?php }elseif($result['status']==2){?>
                                <td>OK</td>
                         <?php  }elseif($result['status']==1){?>
                                    <td><a href=" #">N/A</a></td>

                       <?php }else{
                                 echo 'Confirm'; 
                       }?>


                            </tr>
                        
                        <?php }
                    } ?>
                </table>
        </div>
       <div class="clear"></div>
    </div>
 </div>
<?php include'inc/footer.php'; ?>