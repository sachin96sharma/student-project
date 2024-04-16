<?php		
 			include("system_config.php");
			$url_return = SITEPATH.'account-settings';
			$dates=date('Y-m-d');
$sql = "SELECT * FROM customer WHERE user_id='".$_SESSION['userid']."' AND  user_pass='".encryptIt($_REQUEST["currentpassword"])."' and user_status='0' LIMIT 1";
$rows = mysqli_query($link,$sql);
			if(mysqli_num_rows($rows) == 1)
			{ 
				if($_REQUEST["pswd2"]==$_REQUEST["psw"])
				{
					$sql = "UPDATE `customer` SET `user_pass` = '".encryptIt($_REQUEST["pswd2"])."' WHERE `customer`.`user_id` = ".$_SESSION['userid']."";
					$rows = mysqli_query($link,$sql);
					$_SESSION['msg']='success';
				}
				else
				{
					$_SESSION['msg']='error';	
				}
           	}
		   	else
		   	{ 
				$_SESSION['msg']='error';
   		   	}
			
			header('Location: account-settings');
				?>
