<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');
 $cart=new cart();
 $fm=new format();
?>

<?php
if(isset($_GET['shift'])){
    $id=$_GET['shift'];
    $date=$_GET['date'];
    $oId=$_GET['id'];
    $shifted=$cart->productShift($id,$date,$oId);
}

if(isset($_GET['delpro'])){
    $id=$_GET['delpro'];
    $date=$_GET['date'];
    $oId=$_GET['id'];
    $removeproduct=$cart->removeproductShift($id,$date,$oId);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <?php
        if(isset($shifted)){
            echo $shifted;
        }
        
        if(isset($removeproduct)){
            echo $removeproduct;
        }
        
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>ID No.</th>
                        <th>Order Time</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Customer</th>
                        <th>Address Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $cart=new cart();
                    $fm=new format();
                    $getdata=$cart->allProductfromtable();
                    if($getdata){
                        while ($result=$getdata->fetch_assoc()){
               
                    ?>
                    <tr class="odd gradeX">
                        <td> <?php echo $result['id'];?></td>
                        <td><?php echo $fm->formateDate($result['date']);?></td>
                        <td><?php echo $result['productName'];?></td>
                        <td><?php echo $result['quantity'];?></td>
                        <td>$ <?php echo $result['price'];?></td>
                        <td> <?php echo $result['cmrId'];?></td>
                        <td><a href="customer.php?cmrId=<?php echo $result['cmrId'];?>">View Details</a></td>
                  
                  <?php 
                           if($result['status']==1){?>
                                <td><a  href=" ?shift=<?php echo $result['cmrId'];?>& date=<?php echo $result['date'];?>& id=<?php echo $result['id'];?> ">Shifted</a></td>
                          <?php }elseif ($result['status']==2) {?>
                                          <td>Pending</td>  
                                  <?php  }else{?>
                                <td><a  href="?delpro=<?php echo $result['cmrId'];?>& date=<?php echo $result['date'];?> & id=<?php echo $result['id'];?>">Remove</a></td>
                         <?php  }?>
                    
                       
                    </tr>

                    <?php }}?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>
