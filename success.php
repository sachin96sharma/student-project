<?php 
include("system_config.php");
if($_SERVER['HTTP_REFERER']=='https://www.payumoney.com/' or  $_SERVER['HTTP_ORIGIN']=='https://www.payumoney.com' or $_SERVER['HTTP_REFERER']=='https://checkout.citruspay.com' or  $_SERVER['HTTP_ORIGIN']=='https://checkout.citruspay.com' )
{
	$json = $_REQUEST;
	$_SESSION['userid']=$json['udf2'];

	 if($json['status']=='success' && $json['udf1']=='R2Frc2h1QDk3ODJTaW5naEAxMDI0ODU')
	 {
		$sql="UPDATE ordertable set paymentstatus = '1',paymentyype = '1',orderstatus = '1',bank_ref_num = '".$json['mihpayid']."' where order_id =".$json['txnid'];
		mysqli_query($link,$sql);
		unset($_SESSION["shopping_cart"]);
		$_SESSION['msg']='success';
		header('Location: downloads');
	}
	else
	{
		 $sql="UPDATE ordertable set paymentyype = '1',orderstatus = '0',bank_ref_num = '".$json['mihpayid']."' where order_id =".$json['txnid'];
		 mysqli_query($link,$sql);
		 unset($_SESSION["shopping_cart"]);
		 $_SESSION['msg']='error';
		 header('Location: downloads');
	}

}
else
{
	unset($_SESSION["shopping_cart"]);
	$_SESSION['msg']='error';
	header('Location: index.php');
}
?>