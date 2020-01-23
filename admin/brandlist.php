<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php';?>
<?php  
$brand=new Brand();
if(isset($_GET['deleteid'])){
    $id=preg_replace("/[^A-Za-z0-9?! ]/","",$_GET['deleteid']);
    $deleteBrand=$brand->delteById($id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Brand List</h2>
        <div class="block">  
            <?php 
            if(isset($deleteBrand)){
                echo $deleteBrand;
            }
            
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Brand Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $getBrand=$brand->getallBrandcat();
                    if($getBrand){
                        $i=0;
                        while ($result=$getBrand->fetch_assoc()){
                         $i++;
                    ?>
                    
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['brandName']; ?></td>
                        <td><a href="editbrand.php?Idbrand=<?php echo $result['brandId']; ?>">Edit</a> ||
                            <a onclick="return confirm('Are You Sure To Delete..!')" href="?deleteid=<?php echo $result['brandId']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php }} ?>
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

