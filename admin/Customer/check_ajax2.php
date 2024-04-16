<?php
include("../../system_config.php");


$prefix = "";

?>
<?php
$prefix = "";
if (!empty($_POST['user_phone']))
{
	$user_phone = $_POST['user_phone'];	
	$sql_check = mysqli_query($link,"SELECT user_phone FROM customer WHERE user_phone='$user_phone'");
	$row1 = mysqli_fetch_row($sql_check);
	if (!empty($row1))
	{
		echo '<div style="color:#c40000;"><STRONG>' . $user_phone . '</STRONG> is already in use.</div>';
	}
	else
	{
		echo 'OK';
	}
}
?>