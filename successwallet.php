<?php 
include("system_config.php");

if($_SERVER['HTTP_REFERER']=='https://www.payumoney.com/' or  $_SERVER['HTTP_ORIGIN']=='https://www.payumoney.com' or $_SERVER['HTTP_REFERER']=='https://checkout.citruspay.com' or  $_SERVER['HTTP_ORIGIN']=='https://checkout.citruspay.com' )
{
	$json = $_REQUEST;
	$_SESSION['userid']=$json['udf2'];
	 if($json['status']=='success' && $json['udf1']=='R2Frc2h1QDk3ODJTaW5naEAxMDI0ODU')
	 {
		 $amt = $json['amount'] + $json['udf3'];
		 
			$sql="UPDATE `wallet_history` SET `ref_ID` = '".$json['mihpayid']."',`remaining_amount` = '".$amt."', `status` = '1' WHERE `wallet_history`.`id` =".$json['txnid'];
			mysqli_query($link,$sql);
			
			
			$sql="UPDATE `customer` SET `fund_wallet` = '".$amt."' WHERE `customer`.`user_id` = ".$json['udf2'];
			mysqli_query($link,$sql);
			
			
			$_SESSION['msg']='success';
			header('Location: wallet');
	}
	else
	{
		
		 $sql="UPDATE `wallet_history` SET `ref_ID` = '".$json['mihpayid']."',`remaining_amount` = '".$json['udf3']."', `status` = '0' WHERE `wallet_history`.`id` =".$json['txnid'];
		 mysqli_query($link,$sql);
		 
		 $_SESSION['msg']='error';
		 header('Location: wallet');
	}

}
else
{
	$_SESSION['msg']='error';
	header('Location: index.php');
}
?>