<?php		
 			include("system_config.php");
			$url_return = SITEPATH.'sign-up';
			
			
			$queryu = "SELECT * FROM customer where user_email = '".$_REQUEST["user_email"]."' or user_phone = '".$_REQUEST["user_phone"]."'";
    		$resultu = mysqli_query($link,$queryu);
 			$rowcount=mysqli_num_rows($resultu);
	if($rowcount=="0")
	{
			function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
			$pass= generateRandomString();
			$dates=date('Y-m-d h:i:s');
			
$sql = "INSERT into customer (user_email,user_phone,user_pass,user_type,first_name,o_name,gst,user_address,user_country,user_state,user_district,user_pincode,user_startfrom,user_desc,user_status) values ('".$_REQUEST["user_email"]."','".$_REQUEST["user_phone"]."','".encryptIt($pass)."','0','".$_REQUEST["first_name"]."','".$_REQUEST["o_name"]."','".$_REQUEST["gst"]."','".$_REQUEST["user_address"]."','0','".$_REQUEST["user_state"]."','".$_REQUEST["user_district"]."','".$_REQUEST["user_pincode"]."','".$dates."','".$_REQUEST["user_desc"]."','0')";
mysqli_query($link,$sql);
$_SESSION['msg']='success';
$_SESSION['pass'] = $pass;




 $to=$_REQUEST["user_email"];
       $subject='Password to access www.studentdatabasekart.in';
       
	   $message .= '<div id=":2f9" class="a3s aiL ">
  
  <p style="font-size:1.051em"><strong>Dear '.$_REQUEST["first_name"].',</strong><br>
    <br>
    Welcome to <span class="il">Students</span> <span class="il">Database</span>!<br>
    <br>
You have signed up successfully. You can now login with your registered Email ID: <strong><a href="mailto:'.$_REQUEST["user_email"].'" target="_blank">'
.$_REQUEST["user_email"].'</a></strong><br>
    <br>
    Your Password is:&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;font-size:1.3em;color:#f5210b">'.$pass.'</span><br>
    <br>
    You can change password by logging into your account. For any further assistance, you can reach us at <a href="mailto:studentsdatabaseindia@gmail.com?Subject=Need+Support" target="_blank">studentsdatabaseindia@gmail.com</a><br>
    <br>
    Warm Regards,<br>
    <br>
    <strong><span class="il">Students</span> <span class="il">Database</span></strong><br>
    <a href="https://www.studentdatabasekart.in/" target="_blank">www.studentdatabasekart.in</a></p>
</div>';
	   
       $headers = "MIME-Version: 1.0" . "\r\n";
       $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
       $headers .= "from:<info@studentdatabasekart>\r\n";
	   
	   $mail=mail($to,$subject,$message,$headers);

	

?>
<script type="text/javascript" language="javascript">
			 window.location.href = 'Login';
		  </script>
<?php 
	}
	else
	{
		$_SESSION['msg']='error';
			?>
<script type="text/javascript" language="javascript">
			  alert("Already Registered");
			 window.location.href = 'sign-up';
		  </script>
<?php 
	}
	
	?>