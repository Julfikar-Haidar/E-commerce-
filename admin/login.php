<?php include_once '../classes/adminlogin.php';?>

<?php 
$adminlog=new adminlogin();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $adminUser=$_POST['adminUser'];
    $adminPass=  md5($_POST['adminPass']);
    $logcheck=$adminlog->login($adminUser,$adminPass);
}
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
            <form action="login.php" method="post">
			<h1>Admin Login</h1>
                        <span style="color: red;font-size: 20px;">
                           <?php
                            if(isset($logcheck)){
                                echo $logcheck;
                            }
                           ?>
                        </span>
			<div>
				<input type="text" placeholder="Username"  name="adminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Login" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>