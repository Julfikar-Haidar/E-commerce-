<?php include 'inc/header.php'; ?>

<?php
$login= session::get('customerLogin');
if($login==TRUE){
    header("Location:order.php");
}


?>
        <?php 
            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])){

                $customerlogin=$customer->customerLoginSystem($_POST);  

            }

?>
<div class="main">
    <div class="content">
    
        <div class="login_panel">
            <?php 
            if(isset($customerlogin)){
                echo $customerlogin;
            }
            ?>
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>
            <form action="" method="post">
                <input name="email" type="text" placeholder="Enter your Email">
                <input name="password" type="text"placeholder="Enter your Password">
                <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
            </form>
       
        </div>
        <?php 
            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['registration'])){

                $customerRegister=$customer->customerRegistration($_POST);  

            }

?>
        
        
        <div class="register_account">
            <?php
            if(isset($customerRegister)){
                echo $customerRegister;
            }
            
            ?>
            <h3>Register New Account</h3>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <input type="text" name="name" placeholder="Enter Your Name" >
                                </div>

                                <div>
                                    <input type="text" name="city" placeholder="Enter Your City" >
                                </div>

                                <div>
                                    <input type="text" name="zipcode" placeholder="Enter Your Zipcode">
                                </div>
                                <div>
                                    <input type="text" name="email" placeholder="Enter Your Email">
                                </div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="address" placeholder="Enter Your Address" >
                                </div>

                                <div>
                                    <input type="text" name="country" placeholder="Enter Your Country" >
                                </div>

                                <div>
                                    <input type="text" name="phone" placeholder="Enter Your Phone Number">
                                </div>
                                <div>
                                    <input type="text" name="password" placeholder="Enter Your Password">
                                </div>
                            </td>
                        </tr> 
                    </tbody>
                </table> 
                <div class="search"><div><button class="grey" name="registration">Create Account</button></div></div>
                <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
                <div class="clear"></div>
            </form>
        </div>  	
        <div class="clear"></div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>