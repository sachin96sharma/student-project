<?php
 include("system_config.php"); 
 include('common/head.php');?>
</head>
<body>
<?php 
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		if($_POST["code"] == $key){
		unset($_SESSION["shopping_cart"][$key]);
		$status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
		
		}
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}
  	
}
include('common/header.php'); 
?>
<div class="container">
  <div class="row">
    <div class="col-lg-9">
      <div class="small-container cart-page">
      <?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
        <table>
          <tr>
            <th>Action</th>
            <th>Product Name</th>
            <th>Subtotal</th>
          </tr>
          <?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
          <tr>
            <td>
            <form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove' style="border: 0px;background: white;"><i class="fa fa-trash" aria-hidden="true"></i></button>
</form>
            </td>
            <td><p><?php echo $product["name"]; ?></p>
              <small><strong>Record Count:</strong> <?php echo number_format($product["count"]); ?></small></td>
            <td>₹<?php echo number_format(round($product["price"],2),2); ?></td>
          </tr>
         <?php
$total_price += ($product["price"]*1);
}
?>

        </table>
      </div>
      <div class="total-price">
        <table>
          <tr>
            <td colspan="2" class="cart-total"><h2 class="text-left">Cart Totals</h2></td>
          </tr>
          
          <tr class="subtotal">
            <td><strong>Subtotal</strong></td>
            <td>₹ <?php echo number_format(round($total_price,2),2); ?> </td>
          </tr>
          <tr>
            <td><strong>GST</strong></td>
            <?php $gst = $total_price*18/100;?>
            <td>₹ <?php echo number_format(round($gst,2),2); ?></td>
          </tr>
          <tr>
            <td><strong>Total</strong></td>
            <td>₹<?php echo number_format(round($gst+$total_price)); ?></td>
          </tr>
        </table>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-md-12 mb-5">
            <div class="ad-action border-radius-0"> <a href="<?php echo SITEPATH; ?>Checkout">Proceed to Checkout</a> </div>
          </div>
        </div>
      </div>
      <?php
}else{
	?>
<script type="text/javascript" language="javascript">
			 window.location.href = 'index.php';
		  </script>
<?php 
	}
?>
      
    </div>
  </div>
</div>
</div>
<?php include('common/footer.php');?>
</body></html></body>
</html>
