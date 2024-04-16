<?php
 include("system_config.php");
if(isset($_SESSION['userid']))
{
 
 include('common/head.php');?>
</head>
<body>
<?php include('common/header.php'); ?>
<div class="container">
  <div class="row">
    <div class="col-lg-9 mt-5">
   <!-- col-lg-9 -->   
    <?php
	  if($_SESSION['msg']=="success")
	 {
 		
		?>
          <div id="sign_up_success"><i class="fa fa-error" aria-hidden="true"></i>
            <h4>Payment successfully Added</h4>
          </div>
	<?php
	}
	  ?>
 <?php
	if($_SESSION['msg']=="error")
	{
		?>
          <div id="sign_up_success"><i class="fa fa-error" aria-hidden="true"></i>
            <h4>Payment error</h4>
          </div>
         
          
	<?php
	}
	unset($_SESSION['msg']);
	  ?>
      <br>
<div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
      <div class="wallet-box">
      <h6 class="total-bal text-center">TOTAL BALANCE (₹)</h6>
      <h2 class="text-center" style="color: #e3154f;"><?php if($rowuser['22']==""){ echo '0';}else{ echo $rowuser['22'];} ?></h2>
    </div>

    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mb-3">
      
      <form method="post" action="<?php echo SITEPATH; ?>wallet-add-money" class="login border-radius-0 wallet-custom" name="loginwithpassword" id="loginwithpassword">
       
        <div class="wallet-box"> <p class="form-row form-row-wide">
          <h6 class="total-bal">ADD MONEY TO WALLET</h6>
      <input type="text" class="wallet_balance" name="amount" required>
      <button class="btn btn-secondary wallet-custom" type="submit" id="btn_add_money">Add Money</button>
      </p>
      </div>
    </form>
    </div>
  </div>
</div>

<!--<div class="container">
  <div class="row">
    <div class="col-lg-12 text-center mt-4">
      <a class="pay-pending text-center" href="#">PAY PENDING BILLS</a>
    </div>
  </div>
</div>-->
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="small-container cart-page table-responsive mt-5">
        <table>
          <tr>
           <th style="background: #e3154f;"><strong>Transaction ID</strong></th>
             <th style="background: #e3154f;"><strong>DATE & TIME</strong></th>
            <th style="background: #e3154f;"><strong>TRANSACTION</strong></th>
             <th style="background: #e3154f;"><strong>STATUS</strong></th>
            <th style="background: #e3154f;"><strong>AMOUNT (₹)</strong></th>
            <th style="background: #e3154f;"><strong>WALLET BALANCE (₹)</strong></th>
          </tr>
          
          <?php $rows_list = getwallet_history_byUser($_SESSION['userid']) ;
$i=1;
foreach ($rows_list as $rows) {
		  ?>
          <tr>
           <td><p><?php echo $rows['id']; ?></p></td>
            <td><p><?php echo $rows['date_time']; ?></p></td>
            <td><?php
			if($rows['wallet']=='fund_add')
			{
			?>
                  <p>Added to Wallet</p>
                  <?php }?>
                  <?php
			if($rows['wallet']=='order')
			{
			?>
                  <p>Order</p>
                  <p><?php echo $rows['order_id']; ?></p>
                  <?php }?>
                  
                  <p class="text-left">Ref ID: <strong style="color: #e3154f;"><?php echo $rows['ref_ID']; ?></strong></p>
                  
             <td><?php echo $config['paymentstatus'][$rows['status']]; ?></td>
            <td>₹<?php echo $rows['amount']; ?></td>
            <td>₹<?php echo $rows['remaining_amount']; ?></td>
          </tr>
           <?php }?>
        </table>
      </div>
    </div>
  </div>
</div>




<!-- col-lg-9 -->
      </div>
    </div>
  </div>


<?php include('common/footer.php');?>
</body>
</html></body>
</html>
<?php }
else
{
		header('Location: Login');
}
?>