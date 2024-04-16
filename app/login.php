<?php
include("system_config.php");
$url_return = SITEPATH . 'index.php';
$dates = date('Y-m-d');
$sql = "SELECT * FROM customer WHERE user_email='" . $_REQUEST['username'] . "' AND  user_pass='" . encryptIt($_REQUEST["password"]) . "' and user_status='0' LIMIT 1";

$rows = mysqli_query($link, $sql);
if (mysqli_num_rows($rows) == 1) {
	$row = mysqli_fetch_row($rows);
	$_SESSION['userid'] = $row['0'];
	if (isset($_SESSION["shopping_cart"])) {
		header('Location: Checkout');
	} else {
		header('Location: account-settings');
	}
} else {

	header('Location: Login');
	$_SESSION['msglogin'] = 'error';
}
