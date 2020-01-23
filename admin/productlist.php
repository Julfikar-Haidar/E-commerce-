<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include'../classes/product.php';?>
<?php include_once'../helpers/format.php';?>

<?php 
$product=new Product();
$fm=new format();
if(isset($_GET['delproductId'])){
    $id=preg_replace("/[^A-Za-z0-9?! ]/","",$_GET['delproductId']);
    $deleteProduct=$product->deleteById($id);
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <?php 
        if(isset($deleteProduct)){
            echo $deleteProduct;
        }
        
        
        ?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Image</th>
					<th>Price</th>
					<th>Type</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
                            <?Php 
                            $getProduct=$product->allProductshow();
                            if($getProduct){ 
                                $i=0;
                                while ($result=$getProduct->fetch_assoc()){
                                $i++;  
                            ?>
                            
				<tr class="odd gradeX">
                                    <td> <?php echo $i;?></td>
					<td><?php echo $result['productName'];?></td>
					<td><?php echo $result['catName'];?></td>
					<td><?php echo $result['brandName'];?></td>
                                        <td><?php echo $fm->textshorten($result['body'],20);?></td>
                                        <td><img src="<?php echo $result['image'];?> " width="60px" height="60px" /></td>
					<td> $<?php echo $result['price'];?></td>
                                        <td>
                                         <?php 
                                         if( $result['type']==1){
                                             echo 'Featured';
                                         }  else {
                                             echo 'Non-Featured';
                                         }
                                        ?>
                                            
                                        <td><?php echo $fm->formateDate($result['date']);?></td>  
                                        </td>
                                        <td><a href="editproduct.php?productId=<?php echo $result['product_id'];?>">Edit</a> || 
                                            <a onclick="return confirm('Are You Sure To Delete..!')" href="?delproductId=<?php echo $result['product_id'];?>">Delete</a></td>
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
<?php include 'inc/footer.php';?>
