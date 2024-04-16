<?php 
error_reporting(0);

include("../../system_config.php");
include_once("../common/head.php");
$name="Add New User";
 


if(isset($_GET['id']))
{
  $name="Update Settings";
   $id = decryptIt($_GET['id']); 
  $user_id=  decryptIt($_GET['id']);  
  $res = getuser_byID($id); 
   
   
    
}
extract($_REQUEST);
 

if($_REQUEST['Submit']){

             

$q=mysql_query("SELECT * FROM `user_permission` where user_id='".$user_id."'");

	if(!mysql_num_rows($q)){
	
	
		$qq="INSERT INTO `user_permission` (`user_id`, `module`, `add`, `view`, `edit`, `del`)
		 VALUES
		( '".$user_id."', 'type', '0', '0', '0', '0'), 
		( '".$user_id."', 'supplier', '0', '0', '0', '0'),
		( '".$user_id."', 'model', '0', '0', '0', '0'),
		( '".$user_id."', 'color', '0', '0', '0', '0'),
		( '".$user_id."', 'purchase_car_mster', '0', '0', '0', '0'),
		( '".$user_id."', 'ledger', '0', '0', '0', '0'),
		( '".$user_id."', 'brand', '0', '0', '0', '0'),
		( '".$user_id."', 'document', '0', '0', '0', '0'),
		( '".$user_id."', 'user', '0', '0', '0', '0'),
		( '".$user_id."', 'location', '0', '0', '0', '0'),
		( '".$user_id."', 'salesman', '0', '0', '0', '0'),
		( '".$user_id."', 'customer', '0', '0', '0', '0'),
		( '".$user_id."', 'car_exp', '0', '0', '0', '0'),
		( '".$user_id."', 'car_trans', '0', '0', '0', '0'),
		( '".$user_id."', 'receipt', '0', '0', '0', '0'),
		( '".$user_id."', 'car_book', '0', '0', '0', '0'),
		( '".$user_id."', 'car_sell', '0', '0', '0', '0'),
		( '".$user_id."', 'account', '0', '0', '0', '0'),
		( '".$user_id."', 'email', '0', '0', '0', '0');";
		
		mysql_query($qq);
	}
	


	mysql_query("UPDATE `user_permission` SET `add` = '0', `view` = '0', `edit` = '0', `del` = '0' WHERE `user_permission`.`user_id` = '".$user_id."'");
	
		 if($_REQUEST['type'] ){
		 
				$query="UPDATE `user_permission` SET `module` = 'type'";
				
				for($i=0; $i<count($_REQUEST['type']); $i++){
					$field=explode("_", $_REQUEST['type'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."' and module='type'";
				 mysql_query($query);
	      }	
		  
		  if($_REQUEST['supplier']){
		 
				$query="UPDATE `user_permission` SET `module` = 'supplier'";
				
				for($i=0; $i<count($_REQUEST['supplier']); $i++){
					$field=explode("_", $_REQUEST['supplier'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."' and module='supplier'";
				 mysql_query($query);
	      }	
		  if($_REQUEST['model']){
		 
				$query="UPDATE `user_permission` SET `module` = 'model'";
				
				for($i=0; $i<count($_REQUEST['model']); $i++){
					$field=explode("_", $_REQUEST['model'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."' and module='model'";
				 mysql_query($query);
	      }	
		  if($_REQUEST['color']){
		 
				$query="UPDATE `user_permission` SET `module` = 'color'";
				
				for($i=0; $i<count($_REQUEST['color']); $i++){
					$field=explode("_", $_REQUEST['color'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."' and module='color'";
				 mysql_query($query);
	      }	
		  if($_REQUEST['purchase_car_mster']){
		 
				$query="UPDATE `user_permission` SET `module` = 'purchase_car_mster'";
				
				for($i=0; $i<count($_REQUEST['purchase_car_mster']); $i++){
					$field=explode("_", $_REQUEST['purchase_car_mster'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."'  and module='purchase_car_mster'";
				 mysql_query($query);
	      }	
		  
		  
		  if($_REQUEST['ledger']){
		 
				$query="UPDATE `user_permission` SET `module` = 'ledger'";
				
				for($i=0; $i<count($_REQUEST['ledger']); $i++){
					$field=explode("_", $_REQUEST['ledger'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."'   and module='ledger'";
				 mysql_query($query);
	      }	
		   if($_REQUEST['brand']){
		 
				$query="UPDATE `user_permission` SET `module` = 'brand'";
				
				for($i=0; $i<count($_REQUEST['brand']); $i++){
					$field=explode("_", $_REQUEST['brand'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."'   and module='brand'";
				 mysql_query($query);
	      }	
		   if($_REQUEST['document']){
		 
				$query="UPDATE `user_permission` SET `module` = 'document'";
				
				for($i=0; $i<count($_REQUEST['document']); $i++){
					$field=explode("_", $_REQUEST['document'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."'    and module='document'";
				 mysql_query($query);
	      }	
		  if($_REQUEST['user']){
		 
				$query="UPDATE `user_permission` SET `module` = 'user'";
				
				for($i=0; $i<count($_REQUEST['user']); $i++){
					$field=explode("_", $_REQUEST['user'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."'    and module='user'";
				 mysql_query($query);
	      }	
		  if($_REQUEST['location']){
		 
				$query="UPDATE `user_permission` SET `module` = 'location'";
				
				for($i=0; $i<count($_REQUEST['location']); $i++){
					$field=explode("_", $_REQUEST['location'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."'    and module='location'";
				 mysql_query($query);
	      }	
		  if($_REQUEST['user']){
		 
				$query="UPDATE `user_permission` SET `module` = 'user'";
				
				for($i=0; $i<count($_REQUEST['user']); $i++){
					$field=explode("_", $_REQUEST['user'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."'  and module='user'";
				 mysql_query($query);
	      }	
		   if($_REQUEST['salesman'] ){
		 
				$query="UPDATE `user_permission` SET `module` = 'salesman'";
				
				for($i=0; $i<count($_REQUEST['salesman']); $i++){
					$field=explode("_", $_REQUEST['salesman'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."' and module='salesman'";
				 mysql_query($query);
	      }	
	      
		  
		   if($_REQUEST['customer'] ){
		 
				$query="UPDATE `user_permission` SET `module` = 'customer'";
				
				for($i=0; $i<count($_REQUEST['customer']); $i++){
					$field=explode("_", $_REQUEST['customer'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."' and module='customer'";
				 mysql_query($query);
	      }	
		   if($_REQUEST['car_exp'] ){
		 
				$query="UPDATE `user_permission` SET `module` = 'car_exp'";
				
				for($i=0; $i<count($_REQUEST['car_exp']); $i++){
					$field=explode("_", $_REQUEST['car_exp'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."' and module='car_exp'";
				 mysql_query($query);
	      }	
		  if($_REQUEST['car_trans'] ){
		 
				$query="UPDATE `user_permission` SET `module` = 'car_trans'";
				
				for($i=0; $i<count($_REQUEST['car_trans']); $i++){
					$field=explode("_", $_REQUEST['car_trans'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."' and module='car_trans'";
				 mysql_query($query);
	      }	
		   if($_REQUEST['receipt'] ){
		 
				$query="UPDATE `user_permission` SET `module` = 'receipt'";
				
				for($i=0; $i<count($_REQUEST['receipt']); $i++){
					$field=explode("_", $_REQUEST['receipt'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."' and module='receipt'";
				 mysql_query($query);
	      }	
		  if($_REQUEST['car_book'] ){
		 
				$query="UPDATE `user_permission` SET `module` = 'car_book'";
				
				for($i=0; $i<count($_REQUEST['car_book']); $i++){
					$field=explode("_", $_REQUEST['car_book'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."' and module='car_book'";
				 mysql_query($query);
	      }	
		   if($_REQUEST['car_sell'] ){
		 
				$query="UPDATE `user_permission` SET `module` = 'car_sell'";
				
				for($i=0; $i<count($_REQUEST['car_sell']); $i++){
					$field=explode("_", $_REQUEST['car_sell'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."' and module='car_sell'";
				 mysql_query($query);
	      }	
		  if($_REQUEST['account'] ){
		 
				$query="UPDATE `user_permission` SET `module` = 'account'";
				
				for($i=0; $i<count($_REQUEST['account']); $i++){
					$field=explode("_", $_REQUEST['account'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."' and module='account'";
				 mysql_query($query);
	      }	
		  if($_REQUEST['email'] ){
		 
				$query="UPDATE `user_permission` SET `module` = 'email'";
				
				for($i=0; $i<count($_REQUEST['email']); $i++){
					$field=explode("_", $_REQUEST['email'][$i]);
					$query.=", `".$field[0]."` = '1' ";
				 }
				 $query.=" WHERE `user_permission`.`user_id` = '".$user_id."' and module='email'";
				 mysql_query($query);
	      }	
} 




//user_permission($user_id); 
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js" type="text/javascript"></script>
<SCRIPT type="text/javascript">
$(document).ready(function()
{
$("#user_email").change(function() 
{ 

var user_email = $("#user_email").val();
var msgbox = $("#status");


if(user_email.length > 3)
{
$("#status").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking availability...');

$.ajax({  
    type: "POST",  
    url: "check_ajax.php",  
    data: "user_email="+ user_email,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request){ 

	if(msg == 'OK')
	{ 
	
	    $("#user_email").removeClass("red");
	    $("#user_email").addClass("green");
        msgbox.html('<img src="yes.png" align="absmiddle"> <font color="Green"> Available </font>  ');
	}  
	else  
	{  
	     $("#user_email").removeClass("green");
		 $("#user_email").addClass("red");
		msgbox.html(msg);
	}  
   
   });
   } 
   
  }); 

}
else
{
 $("#user_email").addClass("red");
$("#status").html('<font color="#cc0000">Enter valid User Name</font>');
}



return false;
});

});
</SCRIPT>
<?php 
if(isset($_GET['id']))
{
  $name="Update Settings";
   $id = decryptIt($_GET['id']); 
  $user_id=  decryptIt($_GET['id']);  
  $res = getuser_byID($id); 
   
   
    
}?>
<style>
.check {
	height: 17px;
	width: 17px;
}
</style>
</head><body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
  <?php include_once("../common/left_menu.php");?>
  <div class="content-wrapper"> 
    <!-- Content Header -->
    <section class="content-header">
      <h1><?php echo $name;?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SITEPATH;?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $name;?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
        <form id="form" name="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data"  >
          <input id="data_id" name="data_id" type="hidden" value="<?php echo $id ?>" />
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Location Master</h4>
                <?php $location=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='location'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="location[]" value="add_location" id="Add_new_location" <?php echo ($location['add']==1)?'checked="checked"':''?>  />
                  <label>&nbsp;&nbsp; Add Location</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="location[]"  value="view_location" id="Add_new_location"  <?php echo ($location['view']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; View Location</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="location[]"  value="edit_location" id="Add_new_location" <?php echo ($location['edit']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Edit Location</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="location[]"  value="del_location" id="Add_new_location" <?php echo ($location['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete Location</label>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Supplier Master</h4>
                <?php $supplier=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='supplier'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="supplier[]" value="add_supplier" <?php echo ($supplier['add']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Add Supplier Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="supplier[]" value="view_supplier"  <?php echo ($supplier['view']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; View Supplier Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="supplier[]" value="edit_supplier"  <?php echo ($supplier['edit']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Edit Supplier Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="supplier[]" value="del_supplier"  <?php echo ($supplier['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete Supplier Master</label>
                </div>
              </div>
              <div class="clearfix"></div>
              
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Document Master</h4>
                <?php $document=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='document'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="document[]" value="add_document"  <?php echo ($document['add']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Add Document Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="document[]" value="view_document" <?php echo ($document['view']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; View Document Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="document[]" value="edit_document" <?php echo ($document['edit']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Edit Document Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="document[]" value="del_document" <?php echo ($document['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete Document Master</label>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Salesman Master</h4>
                <?php 
				
				$salesman=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='salesman'"));
			
			  ?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="salesman[]" value="add_salesman" <?php echo ($salesman['add']==1)?'checked="checked"':''?>  />
                  <label>&nbsp;&nbsp; Add Salesman Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="salesman[]" value="view_salesman" <?php echo ($salesman['view']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; View Salesman Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="salesman[]" value="edit_salesman" <?php echo ($salesman['edit']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Edit Salesman Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="salesman[]" value="del_salesman" <?php echo ($salesman['del']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Delete Salesman Master</label>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Customer Master</h4>
                <?php $customer=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='customer'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="customer[]" value="add_customer"  <?php echo ($customer['add']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Add Customer Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="customer[]" value="view_customer" <?php echo ($customer['view']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; View Customer Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="customer[]" value="edit_customer" <?php echo ($customer['edit']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Edit Customer Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="customer[]" value="del_customer" <?php echo ($customer['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete Customer Master</label>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Car Brands Master</h4>
                <?php $brand=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='brand'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="brand[]" value="add_brand" <?php echo ($brand['add']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Add Car Brands Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="brand[]" value="view_brand" <?php echo ($brand['view']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; View Car Brands Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="brand[]" value="edit_brand" <?php echo ($brand['edit']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Edit Car Brands Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="brand[]" value="del_brand" <?php echo ($brand['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete Car Brands Master</label>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Car Type Master</h4>
                <?php $type=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='type'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="type[]" value="add_type" <?php echo ($type['add']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Add Car Type Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="type[]" value="view_type"  <?php echo ($type['view']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; View Car Type Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="type[]" value="edit_type"  <?php echo ($type['edit']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Edit Car Type Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="type[]" value="del_type"  <?php echo ($type['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete Car Type Master</label>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Car Model Master</h4>
                <?php $model=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='model'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="model[]" value="add_model"  <?php echo ($model['add']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Add Car Model Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="model[]" value="view_model" <?php echo ($model['view']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; View Car Model Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="model[]" value="edit_model" <?php echo ($model['edit']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Edit Car Model Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="model[]" value="del_model" <?php echo ($model['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete Car Model Master</label>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Car Colors Master</h4>
                <?php $color=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='color'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="color[]" value="add_color" <?php echo ($color['add']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Add Car Colors Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="color[]" value="view_color"  <?php echo ($color['view']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; View Car Colors Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="color[]" value="edit_color"  <?php echo ($color['edit']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Edit Car Colors Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="color[]" value="del_color"  <?php echo ($color['del']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Delete Car Colors Master</label>
                </div>
              </div>
              <div class="clearfix"></div>
              
              
             
              
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Purchase Car Master</h4>
                <?php $purchase_car_mster=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='purchase_car_mster'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="purchase_car_mster[]" value="add_purchase_car_mster" <?php echo ($purchase_car_mster['add']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Add Purchase Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="purchase_car_mster[]" value="view_purchase_car_mster" <?php echo ($purchase_car_mster['view']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; View Purchase Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="purchase_car_mster[]" value="edit_purchase_car_mster" <?php echo ($purchase_car_mster['edit']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Edit Purchase Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="purchase_car_mster[]" value="del_purchase_car_mster" <?php echo ($purchase_car_mster['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete Purchase Master</label>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Car Expenses Master</h4>
                <?php $car_exp=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='car_exp'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_exp[]" value="add_car_exp"  <?php echo ($car_exp['add']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Add Car Expenses Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_exp[]" value="view_shipment" <?php echo ($car_exp['view']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; View Car Expenses Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_exp[]" value="edit_shipment" <?php echo ($car_exp['edit']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Edit Car Expenses Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_exp[]" value="del_shipment" <?php echo ($car_exp['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete Car Expenses Master</label>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Car Transfer Master</h4>
                <?php $car_trans=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='car_trans'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_trans[]" value="add_car_trans" <?php echo ($car_trans['add']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Add Car Transfer Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_trans[]" value="view_car_trans"   <?php echo ($car_trans['view']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; View Car Transfer Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_trans[]" value="edit_car_trans"  <?php echo ($car_trans['edit']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Edit Car Transfer Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_trans[]" value="del_car_trans"   <?php echo ($car_trans['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete Car Transfer Master</label>
                </div>
              </div>
             
			
			
			<div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Car Booking Master</h4>
                <?php $car_book=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='car_book'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_book[]" value="add_car_book"  <?php echo ($car_book['add']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Add Car Booking Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_book[]" value="view_car_book"  <?php echo ($car_book['view']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; View Car Booking Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_book[]" value="edit_car_book"  <?php echo ($car_book['edit']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Edit Car Booking Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_book[]" value="del_car_book"  <?php echo ($car_book['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete Car Booking Master</label>
                </div>
              </div>
			
			
            <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Car Sell Master</h4>
                <?php $car_sell=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='car_sell'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_sell[]" value="add_car_sell"  <?php echo ($car_sell['add']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Add Car Sell Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_sell[]" value="view_car_sell"  <?php echo ($car_sell['view']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; View Car Sell Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_sell[]" value="edit_car_sell"  <?php echo ($car_sell['edit']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Edit Car Sell Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="car_sell[]" value="del_car_sell"  <?php echo ($car_sell['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete Car Sell Master</label>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Ledger Master</h4>
                <?php $ledger=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='ledger'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="ledger[]" value="add_ledger"  <?php echo ($ledger['add']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Add Ledger Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="ledger[]" value="view_ledger"  <?php echo ($ledger['view']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; View Ledger Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="ledger[]" value="edit_ledger"  <?php echo ($ledger['edit']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Edit Ledger Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="ledger[]" value="del_ledger"  <?php echo ($ledger['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete Ledger Master</label>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">User Master</h4>
                <?php $user=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='user'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="user[]" value="add_user"  <?php echo ($user['add']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Add User Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="user[]" value="view_user"  <?php echo ($user['view']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; View User Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="user[]" value="edit_user"  <?php echo ($user['edit']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Edit User Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="user[]" value="del_user"  <?php echo ($user['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete User Master</label>
                </div>
              </div>
              
             

              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Account Master</h4>
                <?php $account=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='account'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="account[]" value="add_account"  <?php echo ($account['add']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Add Account Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="account[]" value="view_account"  <?php echo ($account['view']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; View Account Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="account[]" value="edit_account"  <?php echo ($account['edit']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Edit Account Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="account[]" value="del_account"  <?php echo ($account['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete Account Master</label>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Email Master</h4>
                <?php $email=mysql_fetch_array(mysql_query("SELECT * FROM `user_permission` where user_id='".$id."' and module='email'"));?>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="email[]" value="add_email"  <?php echo ($email['add']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; Add Email Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="email[]" value="view_email"  <?php echo ($email['view']==1)?'checked="checked"':''?> />
                  <label>&nbsp;&nbsp; View Email Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="email[]" value="edit_email"  <?php echo ($email['edit']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Edit Email Master</label>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <input type="checkbox"  class="check" name="email[]" value="del_email"  <?php echo ($email['del']==1)?'checked="checked"':''?>/>
                  <label>&nbsp;&nbsp; Delete Email Master</label>
                </div>
              </div>

              <div class="btn-submit-active">
                <input type="submit" id="validate" value="Submit" name="Submit" />
                <span></span></div>
              <a href="<?php  echo SITEPATH;?>/admin/user" class="btn btn-cancel">Cancel</a> </div>
          </div>
        </form>
        <div class="box-footer clearfix"> </div>
      </div>
    </section>
  </div>
  <!--close page contets , start footer-->
  
  <footer class="main-footer">
    <?php include_once("../common/copyright.php");?>
  </footer>
</div>
<?php include_once("../common/footer.php");?>
</body>
</html>