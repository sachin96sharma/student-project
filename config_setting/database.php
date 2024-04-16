
<?php 
// // 	$dbhost = "localhost";
// // $dbuser = "u537024319_database";
// // $dbpass = "m~06RnryR";
// // $db = "u537024319_database";
// $dbuser = "root";
//  $dbpass = "";
// $db = "abc";
	
// $link= mysqli_connect($dbhost,$dbuser,$dbpass);
// mysqli_select_db($link,$db);



// function connectme() {
// $dbhost = "localhost";
// // $dbuser = "u537024319_database";
// // $dbuser = "abc";
// // $dbpass = "m~06RnryR";
// // $db = "u537024319_database";
// $dbuser = "root";
// $dbpass = "";
// $db = "abc";
// $con= mysqli_connect($dbhost,$dbuser,$dbpass);
// mysqli_select_db($con,$db);
        
//     return $con;
// }
// function FetchAll($sql) {
//     $link = connectme();
//     $rowObj = mysqli_query($link,$sql);
//     $result = array();
//     $i = 0;
//     while ($rows = mysqli_fetch_object($rowObj)) {
//         foreach ($rows as $k => $v) {
//             $result[$i][$k] = stripslashes($v);
//         }
//         $i++;
//     }
//     mysqli_free_result($rowObj);
//     return $result;
// }

// function FetchRow($sql) {
//     $link = connectme();
//     $rowObj = mysqli_query($link,$sql);
//     $result = array();
//     while ($rows = mysqli_fetch_object($rowObj)) {
//         foreach ($rows as $k => $v) {
//             $result[$k] = stripcslashes($v);
//         }
//     }
//     mysqli_free_result($rowObj);
//     return $result;
// }
// function run_mysql_query($sql) {
//     $link = connectme();
//      mysqli_query($link,$sql);   
// }
?>
<?php  
error_reporting(E_ALL);
ini_set('display_errors', 0);

$dbhost = "localhost";
$dbuser = "root"; // Assuming you're using root as the username
$dbpass = ""; // Assuming you're not setting a password for the root user
$db = "abc";

$link = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

function connectme() {
    global $dbhost, $dbuser, $dbpass, $db;
    $con = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}

function FetchAll($sql) {
    $link = connectme();
    $rowObj = mysqli_query($link, $sql);
    $result = array();
    $i = 0;
    while ($rows = mysqli_fetch_assoc($rowObj)) {
        $result[$i] = $rows;
        $i++;
    }
    mysqli_free_result($rowObj);
    return $result;
}

function FetchRow($sql) {
    $link = connectme();
    $rowObj = mysqli_query($link, $sql);
    $result = mysqli_fetch_assoc($rowObj);
    mysqli_free_result($rowObj);
    return $result;
}

function run_mysql_query($sql) {
    $link = connectme();
    mysqli_query($link, $sql);   
}

?>
