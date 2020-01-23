<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include'../classes/brand.php';?>

<?php
if(!isset($_GET['Idbrand'])&& $_GET['Idbrand']==NULL){
    echo "<script>window.location:'brandlist.php'</script>";
}  else {
    $id=preg_replace("/[^A-Za-z0-9?! ]/","",$_GET['Idbrand']);
}

$brand=new Brand();
if($_SERVER['REQUEST_METHOD']=='POST'){
  $brandName=$_POST['brandName'];
  $brandUpdateby=$brand->UpdateBrand($brandName,$id);  
}


?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brands</h2>
               <div class="block copyblock"> 
                   <?php 
                   if(isset($brandUpdateby)){
                       echo  $brandUpdateby;
                   }
                   ?>
                   <?php    
                   $getBrandid=$brand->getbrandidBy($id);
                   if($getBrandid){
                       while ($result=$getBrandid->fetch_assoc()){

                   ?>
                   <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['brandName']; ?>" name="brandName" class="medium" />
                            </td>
                        </tr>
                          <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                   <?php }}?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>