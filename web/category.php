<?php
 include("system_config.php"); 
 include('common/head.php');
//session_destroy();

$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($link,"SELECT * FROM `document` WHERE `document_id`='$code'");
$row = mysqli_fetch_assoc($result);
$name = $row['document_name'];
$code = $row['document_id'];
$price = $row['price'];
$count = $row['count'];
$cartArray = array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'count'=>$count,
	'quantity'=>1
);
if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"][$code] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(array_key_exists($code,$_SESSION["shopping_cart"])) {
		$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"][$code] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}

?>
</head>
<body>
<?php include('common/header.php'); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-9">
      <div class="container">
        <?php 
		
		if (isset($_POST['term']) && $_POST['term']!=""){
			
	$rows_list = getdocument_byList_dash_search($_POST['term']);
	if(empty($rows_list))
	{?>
        <div class="row box">
          <div class="col-xs-12 col-md-8">
            <div  style="margin-top: 50px;">
              <h3 class="data-title"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i>Record Not Found</h3>
            </div>
          </div>
          <div class="col-xs-12 col-md-4"> </div>
        </div>
        <?php }
	else
	{
	foreach($rows_list as $rows) {	 ?>
        <div class="row box">
          <div class="col-xs-12 col-md-8">
            <div  style="margin-top: 50px;">
              <h3 class="data-title"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i><?php echo $rows['document_name']; ?></h3>
              <div class="record-count"><span>Record Count:</span> <?php echo number_format($rows['count']); ?></div>
              <div class="fields"><span>Fields:</span> <?php echo $rows['document_description']; ?></div>
              <div class="post-note"><?php echo $rows['s_desc']; ?></div>
              <div class="prices" > <i class="fa fa-inr" aria-hidden="true"></i><?php 
			  $gst = $rows['price']*18/100;
			  echo number_format($rows['price']+$gst); ?></div>
            </div>
          </div>
          <div class="col-xs-12 col-md-4">
            <div class="prices-download" > <a href="<?php  echo SITEPATH;?>/upload/document_sample/<?php  echo $rows['document_sample']; ?>"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i>Download Samples</a></div>
            <div class="prices-download-cart" >
              <form method='post' action=''>
               <input type='hidden' name='term' value="<?php echo $_POST['term']; ?>" />
                <input type='hidden' name='code' value="<?php echo $rows['document_id']; ?>" />
                <button type='submit' style="color: white;background: #e3154f;border: 0;"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to Cart</button>
              </form>
            </div>
          </div>
        </div>
        <?php 
	  }
	}

}
else
{
	$rows_list = getdocument_byList_dash(decryptIt($part_url['3']));
	if(empty($rows_list))
	{?>
        <div class="row box">
          <div class="col-xs-12 col-md-8">
            <div  style="margin-top: 50px;">
              <h3 class="data-title"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i>Record Not Found</h3>
            </div>
          </div>
          <div class="col-xs-12 col-md-4"> </div>
        </div>
        <?php }
	else
	{
	foreach($rows_list as $rows) {	 ?>
        <div class="row box">
          <div class="col-xs-12 col-md-8">
            <div  style="margin-top: 50px;">
              <h3 class="data-title"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i><?php echo $rows['document_name']; ?></h3>
              <div class="record-count"><span>Record Count:</span> <?php echo number_format($rows['count']); ?></div>
              <div class="fields"><span>Fields:</span> <?php echo $rows['document_description']; ?></div>
               <div class="post-note"><?php echo $rows['s_desc']; ?></div>
              <div class="prices" > <i class="fa fa-inr" aria-hidden="true"></i><?php 
			  $gst = $rows['price']*18/100;
			  echo number_format($rows['price']+$gst); ?></div>
            </div>
          </div>
          <div class="col-xs-12 col-md-4">
            <div class="prices-download" > <a href="<?php  echo SITEPATH;?>/upload/document_sample/<?php  echo $rows['document_sample']; ?>"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i>Download Samples</a></div>
            <div class="prices-download-cart" >
              <form method='post' action=''>
                <input type='hidden' name='code' value="<?php echo $rows['document_id']; ?>" />
                <button type='submit' style="color: white;background: #e3154f;border: 0;"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to Cart</button>
              </form>
            </div>
          </div>
        </div>
        <?php 
	  }
	}
}
	   ?>
       <!-- <div class="message_box" style="margin:10px 0px;"> <?php echo $status; ?> </div>-->
      </div>
    </div>
  </div>
</div>
<?php include('common/footer.php');?>
</body>
</html></body>
</html>
