<?php
 include("system_config.php"); 
 include('common/head.php');?>
</head>
<body>
<?php include('common/header.php'); 
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

?>
<div class="container">
  <div class="row">
    <div class="col-lg-9">
      <div class="back_cart"><a href="<?php echo SITEPATH; ?>Cart"> <i class="fa fa-angle-left"></i>back to cart</a></div>
      <?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>
      
          <?php		
foreach ($_SESSION["shopping_cart"] as $product){
	$rows_list = getorders_byID_user($_SESSION['userid']) ;
	
	foreach ($rows_list as $rows) 
	{
		$res1 = getorders_byID_product_index($rows['order_id']);
		 foreach ($res1 as $rows1) 
		 {
			 	if($rows1['product_id']==$product["code"])
				{
					$arrpr[] =   $product["name"]; 
					unset($_SESSION["shopping_cart"][$product["code"]]);
				}
				else
				{
		
				}
	 	}
	}
}
	?>
     <?php if(sizeof($arrpr)!="0")
	 { ?> 
     <style>
                    #no_cart {
    background: #ffcaca;
    padding: 1.5em;
    color: #000;
    margin-bottom: 1.5em;
    font-size: 0.98em;
    display: none;
}
                    </style>
                  
    <div id="no_cart" style="display: block;">Following database(s) is already been purchased and available for <a href="<?php echo SITEPATH; ?>downloads">download</a>. It is removed from the current Cart.<ul>
    <?php 
	foreach ($arrpr as $key => $value) {
	?>
    <li><?php  echo "$value\n"; ?> </li>
    <?php }?>
    </ul></div>
    <?php }?>
    <table class="checkout">
        <thead>
          <tr>
            <th class="database-name" style="border-top: none;">Product</th>
            <th class="product-total" style="border-top: none;">TOTAL</th>
          </tr>
        </thead>
        <tbody>
	<?php foreach ($_SESSION["shopping_cart"] as $product){
?>
          <tr class="cart_item">
            <td class="database-name"><?php echo $product["name"]; ?></td>
            <td class="product-total"><span class="amount">₹ <?php echo number_format(round($product["price"],2),2); ?> </span></td>
          </tr>
          <?php
$total_price += ($product["price"]*1);

	
}
?>
        </tbody>
        <tfoot style="display: table-footer-group;">
          <tr class="cart-subtotal">
            <th>Sub Total</th>
            <td>₹ <span id="sub_total" class="amount"><?php echo number_format(round($total_price,2),2); ?> </span></td>
          </tr>
          <?php $gst = $total_price*18/100;?>
          <tr class="cart-subtotal">
            <th>GST</th>
            <td>₹ <span id="sub_total" class="amount"><?php echo number_format(round($gst,2),2); ?></span></td>
          </tr>
          <tr class="order-total" id="grand_total">
            <th>Total Payable</th>
            <?php $tp = $gst+$total_price; ?>
            <td><strong>₹ <span class="amount" id="final_total"><?php echo number_format(round($tp)); ?></span></strong></td>
          </tr>
        </tfoot>
      </table>
      <?php
	  if(isset($_SESSION['userid']))
{
	if(round($tp)<=round($rowuser['22']))
	{
	?>
      <div class="confirm-order"> <a href="<?php echo SITEPATH; ?>wallet-money">Confirm Order</a> </div>
      <?php
	}
	else
	{
		?>
      <div class="confirm-order"> <a href="<?php echo SITEPATH; ?>payment">Confirm Order</a> </div>
      <?php	
	}
}
else
{?>
      <div class="confirm-order"> <a href="<?php echo SITEPATH; ?>Login">Confirm Order</a> </div>
      <?php }
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
<?php include('common/footer.php');?>
</body>
</html></body>
</html>
