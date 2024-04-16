<?php		
 			include("system_config.php");
			$url_return = SITEPATH.'sign-up';
			if(isset($_REQUEST['username']))
			{
				    $sql = "SELECT * FROM customer WHERE user_email='".$_REQUEST['username']."' or user_phone = '".$_REQUEST["username"]."' LIMIT 1";
					$rows = mysqli_query($link,$sql);
					if(mysqli_num_rows($rows) == 1)
								{ 
									//$_SESSION['password'] = $_REQUEST['user_phone'];
									$row = mysqli_fetch_row($rows);
									 
									 $to=$row['5'];
									   $subject='Your Password';
									   
									   $message .= '<div id=":2f9" class="a3s aiL ">
								  
								  <p style="font-size:1.051em"><strong>Dear '.$row['1'].',</strong><br>
									<br>
									Welcome to <span class="il">Students</span> <span class="il">Database</span>!<br>
									<br>
								You recently requested for the password to access Students Database.<br>
									<br>
									Your Password is:&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;font-size:1.3em;color:#f5210b">'.decryptIt($row['4']).'</span><br>
									<br>
									If you did not request for this, please ignore this email or you can reach us at <a href="mailto:studentsdatabaseindia@gmail.com?Subject=Need+Support" target="_blank">studentsdatabaseindia@gmail.com</a><br>
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
									 
									 
									 
									$_SESSION['msg']='success';
									header('Location: lost-password');
								}
								else
								{ 
									$_SESSION['lost'] = 'error'; 
									header('Location: lost-password');
								}	
			
			
			}
			else
			{
				$_SESSION['msg'] = 'lost-password'; 	
			}
			
	
	?>