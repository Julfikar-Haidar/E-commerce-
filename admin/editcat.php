<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once'../classes/category.php';?>

<?php
if(!isset($_GET['catid'])|| $_GET['catid']==NULL){
    echo "<script>window.location='catlist.php'</script>";
}  else {
        $id=$_GET['catid'];
    $id=preg_replace("/[^A-Za-z0-9?! ]/","",$_GET['catid']);
}

$cat=new Category();
if($_SERVER['REQUEST_METHOD']=='POST'){
  $catName=$_POST['catName'];
  $catUpdateby=$cat->catUpdate($catName,$id);  
}


?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                   <?php 
                   if(isset($catUpdateby)){
                       echo  $catUpdateby;
                   }
                   ?>
                   <?php    
                   $getid=$cat->getcatidBy($id);
                   if($getid){
                       while ($result=$getid->fetch_assoc()){

                   ?>
                   <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['catName']; ?>" name="catName" class="medium" />
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