<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include'../classes/brand.php';?>

<?php 
$brand=new Brand();
if($_SERVER['REQUEST_METHOD']=='POST'){
  $brandName=$_POST['brandName'];
  $brandNmaeInsert=$brand->addBrand($brandName);  
}

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brands</h2>
               <div class="block copyblock"> 
                   <?php 
                   if(isset($brandNmaeInsert)){
                       echo  $brandNmaeInsert;
                   }
                   ?>
                   <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Brand Name..." name="brandName" class="medium" />
                            </td>
                        </tr>
                          <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>