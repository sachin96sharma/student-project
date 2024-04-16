<?php 
include("../../system_config.php");
include_once("../common/head.php");
$rows_list = getorders_list() ;


?>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
  <?php include_once("../common/left_menu.php");?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>View All Order List </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SITEPATH;?>admin/dashboard.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">View All Order List</li>
      </ol>
    </section>
    <section class="content">
      <h1 align="center" style="color: #337ab7;"><?php echo $_SESSION['message']; unset($_SESSION['message']);?></h1>
      <div class="table-responsive" style="overflow-x: auto;">
        <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
          <thead>
            <tr>
              <td><strong>Sr no</strong></td>
              <td><strong>Order ID</strong></td>
              <td><strong>Customer Name</strong></td>
              <td><strong>Product</strong></td>
              <td><strong>Total QTY</strong></td>
              <td><strong>Total Price</strong></td>
				 <td><strong>Payment Type</strong></td>
                 <td><strong>Ref ID</strong></td>
				 <td><strong>Payment Status</strong></td>
				 <td><strong>Order Status</strong></td>
              <td><strong>Order Date</strong></td>
              <td><strong>Create Date</strong></td>
			<!--	<td><strong>Status</strong></td>-->
              <td><strong>Action</strong></td>
            </tr>
          </thead>
          <tbody>
            <?php 
$i=1;
foreach ($rows_list as $rows) {
	$res = getcustomer_byID($rows['customer_id']);
	$price="0";
	$quantity="0";
	$res1 = getorders_byID_product_index($rows['order_id']);
	
		 ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $rows['order_id']; ?></td>
              <td><a href="<?php echo SITEPATH; ?>/admin/Customer/add-new-customer.php?id=<?php echo   urlencode(encryptIt($rows['customer_id'])); ?>"><?php echo $res['first_name']; ?></a></td>
              <td>
              <?php
			  foreach ($res1 as $rows1) {
		$doc = getdocument_byID($rows1['product_id']);
		$quantity=$quantity+$rows1['quantity'];
		$price=$price+($rows1['price']*$rows1['quantity']);
		
		
	?>
              <a href="<?php echo SITEPATH; ?>admin/Document/add_new_document_page.php?id=<?php echo   urlencode(encryptIt($rows1['product_id'])); ?>"><?php echo $rows1['name']; ?></a><br>------------------------<br>
              <?php }?>
              </td>
               <td><?php echo $quantity; ?></td>
                <td><?php 
				$gst = $price*18/100;
				echo number_format(round($gst+$price)); ?></td>
				  <td><?php echo $config['paymentyype'][$rows['paymentyype']]; ?></td>
                  <td><?php echo $rows['bank_ref_num']; ?></td>
				   <td><?php echo $config['paymentstatus'][$rows['paymentstatus']].'<br>'.$rows['p_desc']; ?></td>
				<td><?php echo $config['orderstatus'][$rows['orderstatus']]; ?></td>
              <td><?php echo $rows['orderdate']; ?></td>
              <td><?php echo date("d-m-Y", strtotime($rows['createdate'])); ?></td>
			   <!--<td><?php echo $rows['spinst']; ?></td>-->
				<!-- <td><a href="https://www.google.com/maps/place/<?php echo $rows['lats']; ?>,<?php echo $rows['longs']; ?>" target="_blank">Maps</a></td>
				-->
				<!--  <td>
				
				<a href="<?php  echo SITEPATH;?>/admin/action/order.php?action=status&id=<?php echo urlencode(encryptIt($rows['order_id'])); ?>"<?php if($rows['status']=="0"){ ?> onMouseOver="showbox('active<?php echo $i;?>')" onMouseOut="hidebox('active<?php echo $i;?>')" ><span class="btn-info btn">Active</span>
                <?php }else{?>
                onMouseOver="showbox('inactive<?php echo $i;?>')" onMouseOut="hidebox('inactive<?php echo $i;?>')">  <span class="btn-danger btn">Inactive</span>
                <?php }?>
                </a>
                <div id="active<?php echo $i;?>" class="hide1">
                  <p>Active</p>
                </div>
                <div id="inactive<?php echo $i;?>" class="hide1">
                  <p>Inactive</p>
                </div></td>-->
              <td id="font12" width="10%"><a href="<?php echo SITEPATH; ?>invoice/<?php echo  urlencode(encryptIt($rows['order_id'])); ?>"onMouseOver="showbox('Invoice<?php echo $i;?>')"  onMouseOut="hidebox('Invoice<?php echo $i;?>')"> <i class="fa fa-file-o"></i></a>
																<div id="Invoice<?php echo $i;?>" class="hide1">
																		<p>Invoice</p>
																</div>
																 &nbsp;&nbsp;
																<!--<a href="<?php echo SITEPATH; ?>/syspanel/order/pslip.php?id=<?php echo  urlencode(encryptIt($rows['order_id'])); ?>"onMouseOver="showbox('Packing Slip<?php echo $i;?>')"  onMouseOut="hidebox('Packing Slip<?php echo $i;?>')"> <i class="fa fa-file-o"></i></a>
																<div id="Packing Slip<?php echo $i;?>" class="hide1">
																		<p>Packing Slip</p>
																</div>
																&nbsp;&nbsp; --><a href="<?php echo SITEPATH; ?>/admin/order/add_new_order.php?id=<?php echo   urlencode(encryptIt($rows['order_id'])); ?>" onMouseOver="showbox('Edit<?php echo $i;?>')" onMouseOut="hidebox('Edit<?php echo $i;?>')"> <i class="fa fa-pencil"></i></a>
                <div id="Edit<?php echo $i;?>"  class="hide1">Edit</div>
                &nbsp;&nbsp; <a href="<?php  echo SITEPATH;?>/admin/action/order.php?action=del&id=<?php echo urlencode(encryptIt($rows['order_id'])); ?> "onClick="return confirmDelete();" onMouseOver="showbox('Delete<?php echo $i;?>')" onMouseOut="hidebox('Delete<?php echo $i;?>')"><i class="fa fa-times"></i></a>
                <div id="Delete<?php echo $i;?>" class="hide1">
                  <p>Delete</p>
                </div></td>
            </tr>
            <?php 
$i++;
} ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>
  <footer class="main-footer">
    <?php include_once("../common/copyright.php");?>
  </footer>
</div>
<?php include_once("../common/footer.php");?>
</body>
</html>