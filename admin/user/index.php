<?php die;
include("../../system_config.php");
include_once("../common/head.php");
if($r['user_type']=="1")
{
	$rows_list = getuser_byList();
}
else
{
	$rows_list = getuser_byList_byuser($_SESSION['AdminLogin']);
}
?>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
  <?php include_once("../common/left_menu.php");?>
  <div class="content-wrapper"> 
    <!-- Content Header -->
    <section class="content-header">
      <h1>
        <?php if($r['user_type']=="1")
			{ ?>
        <a style="text-decoration: underline;" href="<?php echo SITEPATH; ?>/admin/user/add-new-user.php">Add New User</a>
        <?php }?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SITEPATH;?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">
          <?php if($per['user']['view']==1)
			{ ?>
          View All user
          <?php }?>
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content"> <br/>
      <div class="table-responsive" style="overflow-x: auto;">
        <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
          <thead>
            <tr>
              <td><strong>Sr no</strong></td>
              <td>Image</td>
              <td><strong>Name</strong></td>
              <td><strong>Email</strong></td>
              <td><strong>Password</strong></td>
              <td><strong>Number</strong></td>
              <td><strong>Address</strong></td>
              <td><strong>District Name</strong></td>
              <td><strong>State</strong></td>
              <?php if($r['user_type']=="1")
			{ ?>
              <td><strong>Action</strong></td>
              <?php }?>
            </tr>
          </thead>
          <tbody>
            <?php 
$i=1;
foreach ($rows_list as $rows) {
	$ress = getdistrict_byID($rows['user_district']);
	$res = getState_byID($rows['user_state']);
	
	
	 ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><a href="#" ><img src="<?php echo SITEPATH; ?>/upload/thumb/<?php echo $rows['user_logo']; ?>" width="50px" height="50px"></a></td>
              <td><b><?php echo $rows['first_name']; ?></b></td>
              <td><?php echo $rows['user_email']; ?></td>
              <td><?php echo decryptIt($rows['user_pass']); ?></td>
              <td><?php echo $rows['user_phone']; ?></td>
              <td><?php echo $rows['user_address'] ?></td>
              <td><?php echo $rows['user_district']; ?></td>
              <td><?php echo $res['stateName']; ?></td>
              <?php if($r['user_type']=="1")
 
			{ ?>
              <td id="font12"><?php if( $per['user']['edit']==1 ){?>
                <a href="<?php  echo SITEPATH;?>/admin/action/user.php?action=status&id=<?php echo  urlencode(encryptIt($rows['user_id'])); ?>"<?php if($rows['user_status']=="0"){ ?> onMouseOver="showbox('active<?php echo $i;?>')" onMouseOut="hidebox('active<?php echo $i;?>')" ><i class="fa fa-angle-double-up"></i>
                <?php }else{?>
                onMouseOver="showbox('inactive<?php echo $i;?>')" onMouseOut="hidebox('inactive<?php echo $i;?>')"> <i class="fa fa-angle-double-down"></i>
                <?php }?>
                </a>
                <div id="active<?php echo $i;?>" class="hide1">
                  <p>Active</p>
                </div>
                <div id="inactive<?php echo $i;?>" class="hide1">
                  <p>Inactive</p>
                </div>
                
                <!-- <?php if($r['user_id']=="1"){?>
                <?php ?> &nbsp;&nbsp; <a href="<?php echo SITEPATH; ?>/admin/user/setting.php?id=<?php echo  urlencode(encryptIt($rows['user_id'])); ?>"onMouseOver="showbox('Setting<?php echo $i;?>')"  onMouseOut="hidebox('Setting<?php echo $i;?>')"> <i class="fa fa-cogs"></i></a>
                <div id="Setting<?php echo $i;?>" class="hide1">
                  <p>Setting</p>
                </div><?php }?>--> 
                &nbsp;&nbsp; <a href="<?php echo SITEPATH; ?>/admin/user/add-new-user.php?id=<?php echo  urlencode(encryptIt($rows['user_id'])); ?>"onMouseOver="showbox('Edit<?php echo $i;?>')"  onMouseOut="hidebox('Edit<?php echo $i;?>')"> <i class="fa fa-pencil"></i></a>
                <div id="Edit<?php echo $i;?>" class="hide1">
                  <p>Edit</p>
                </div>
                <?php }?>
                &nbsp;&nbsp;
                <?php if( $per['user']['del']==1){?>
                <a href="<?php  echo SITEPATH;?>/admin/action/user.php?action=del&id=<?php echo  urlencode(encryptIt($rows['user_id'])); ?>"onClick="return confirmDelete();" onMouseOver="showbox('Delete<?php echo $i;?>')" onMouseOut="hidebox('Delete<?php echo $i;?>')"><i class="fa fa-times"></i></a>
                <div id="Delete<?php echo $i;?>" class="hide1">
                  <p>Delete</p>
                </div>
                <?php }?></td>
              <?php }?>
            </tr>
            <?php 
$i++;
} ?>
          </tbody>
        </table>
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