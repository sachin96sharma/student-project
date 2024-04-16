<?php 
include("../../system_config.php");
include_once("../common/head.php");
$rows_list = getwallet_list() ;


?>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
  <?php include_once("../common/left_menu.php");?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>View All History</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SITEPATH;?>admin/dashboard.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">View All History</li>
      </ol>
    </section>
    <section class="content">
      <h1 align="center" style="color: #337ab7;"><?php echo $_SESSION['message']; unset($_SESSION['message']);?></h1>
      <div class="table-responsive" style="overflow-x: auto;">
        <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
          <thead>
            <tr>
              <td><strong>Sr no</strong></td>
              <td><strong>Customer Name</strong></td>
              <td><strong>Amount</strong></td>
              <!-- <td><strong>Game Name</strong></td> -->
              <td><strong>Transaction Id</strong></td>
              <td><strong>Payment Status</strong></td>
              <td><strong>Create Date</strong></td>
              <!--	<td><strong>Status</strong></td>-->
              <!-- <td><strong>Action</strong></td> -->
            </tr>
          </thead>
          <tbody>
            <?php 
$i=1;
foreach ($rows_list as $rows) {
	$res = getcustomer_byID($rows['user_id']);
  $gem = getGameDetailsByID($rows['game_id']);
  
	
	
		 ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $res['first_name']; ?></a></td>
               <td><?php echo $rows['user_amount']; ?></td>
               <!-- <td><?php echo $gem['name']; ?></td> -->
              <td><?php echo $rows['transaction_id']; ?></td>
              <td><?php echo $rows['payment_status']; ?></td>
              <td><?php echo $rows['created_at']; ?></td>
              
             
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