<?php 
include("../../system_config.php");
include_once("../common/head.php");

// Check permissions
if($per['user']['view'] == 0) {
    header("Location: ../dashboard.php");
    exit;
}

// Retrieve game data from the database
if($r['user_type'] == "1") {
    $games = getNotification_list();
} else {
    $games = getNotificationDetailsByID($_SESSION['AdminLogin']); // Implement this function to get games by user
}
?>
<!DOCTYPE html>
<html>
<head>
  <?php include_once("../common/head.php"); ?>
  <style>
    .button-wrapper {
        text-align: right;
    }
    .button-wrapper button {
        background-color: blue;
        width: 150px;
        height: 40px;
        margin-bottom: 10px;
        color: white;
        border: none;
        
                cursor: pointer;

    }
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
  <?php include_once("../common/left_menu.php"); ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>View All Notification</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SITEPATH;?>admin/dashboard.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">View All Games</li>
      </ol>
    </section>
    <section class="content">
      <h1 align="center" style="color: #337ab7;"><?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?></h1>
      <div class="button-wrapper ">
    <button onclick="location.href='<?php echo SITEPATH;?>admin/notification/add-notification.php'">
        Add Notification
    </button>
</div>
      <div class="table-responsive" style="overflow-x: auto;">
        <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
          <thead>
            <tr>
              <td><strong>S.no</strong></td>
              <td><strong>Type</strong></td>
              <td><strong>Description</strong></td>
              <td><strong>Created At</strong></td>
              <td><strong>Status</strong></td>
              <td><strong>Action</strong></td>
            </tr>
          </thead>
          <tbody>
<?php 
$serialNumber = 1;
foreach ($games as $game) { 
   
?>
<tr>
  <td><?php echo $serialNumber++ ;?></td>
  
  <td><?php echo htmlspecialchars($config['type2'][$game['type']]); ?></td>

 
  <td><?php echo htmlspecialchars($game['description']);?></td>
  <td><?php echo htmlspecialchars($game['created_at']);?></td>
  <td><?php echo htmlspecialchars($game['status']);?></td>
 
  <?php if($r['user_type'] == "1") {?>
  <td id="font12" style="width:10%">
    <?php if($per['user']['edit'] == 1) {?>
      <a href="<?php echo htmlspecialchars(SITEPATH);?>/admin/action/notifications.php?action=status&id=<?php echo urlencode(encryptIt($game['id']));?>" <?php if($game['status'] == "Active") {?> onMouseOver="showbox('active<?php echo $i;?>')" onMouseOut="hidebox('Active<?php echo $i;?>')" ><i class="fa fa-angle-double-up"></i>
      <?php } else {?>
      onMouseOver="showbox('inactive<?php echo $i;?>')" onMouseOut="hidebox('Inactive<?php echo $i;?>')"> <i class="fa fa-angle-double-down"></i>
      <?php }?>
      </a>
      <div id="active<?php echo $i;?>" class="hide1">
        <p>Active</p>
      </div>
      <div id="inactive<?php echo $i;?>" class="hide1">
        <p>Inactive</p>
      </div>
      &nbsp;&nbsp; <a href="<?php echo htmlspecialchars(SITEPATH);?>/admin/Notification/add-notification.php?id=<?php echo urlencode(encryptIt($game['id']));?>" onMouseOver="showbox('Edit<?php echo $i;?>')"  onMouseOut="hidebox('Edit<?php echo $i;?>')"> <i class="fa fa-pencil"></i></a>
      <div id="Edit<?php echo $i;?>" class="hide1">
        <p>Edit</p>
      </div>
      &nbsp;&nbsp;<a href="<?php echo SITEPATH;?>/admin/action/notifications.php?action=del&id=<?php echo urlencode(encryptIt($rows['id'])); ?>" onClick="return confirm('Are you sure you want to delete?');" onMouseOver="showbox('Delete<?php echo $i;?>')" onMouseOut="hidebox('Delete<?php echo $i;?>')"><i class="fa fa-times"></i></a>

<div id="Delete<?php echo $i;?>" class="hide1">
  <p>Delete</p>
</div>
    <?php }?>
  </td>
</tr>
<?php 
} // end of if($r['user_type'] == "1")
} // end of foreach ($games as $game)
?>
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
