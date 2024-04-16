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
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <?php
	  if($_SESSION['msg']=="success")
	 {
 		
		?>
          <div id="sign_up_success"><i class="fa fa-error" aria-hidden="true"></i>
            <h4>order successfully generated</h4>
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
          <div class="small-container cart-page table-responsive mt-5 paddingg-5">
            <table>
              <tr>
                 <th style="background: #e3154f;"><strong>DATABASE NAME</strong></th>
                <th style="background: #e3154f; text-align: right !important;"><strong>DOWNLOAD</strong></th>
         
              </tr>
              
              <?php 
			  $rows_list = getorders_byID_user($_SESSION['userid']) ;
			  foreach ($rows_list as $rows) {
				  $res1 = getorders_byID_product_index($rows['order_id']);
				    foreach ($res1 as $rows1) {
						$doc = getdocument_byID($rows1['product_id']);
			  ?>
              
              <tr>
                <td><p><?php echo $rows1['name']; ?></p></td>
                <td><a class="pay-pending text-center" href="<?php  echo SITEPATH;?>/upload/document_file/<?php  echo $doc['document_file']; ?>">DOWNLOAD</a></td>
              </tr>
             <?php 
					}
			 }?>
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