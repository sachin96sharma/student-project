
<?php 
include("../../system_config.php");
include_once("../common/head.php");
if($r['user_type']=="1")
{
	$rows_list = getCategory_list();
}
else
{
	$rows_list = getCategory_byList_byuser($_SESSION['AdminLogin']);
}


?>
</head>
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
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
  <?php include_once("../common/left_menu.php");?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>View All Category </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SITEPATH;?>admin/dashboard.php"><i class="fa fa-dashboard"></i>Home</a></li>
        

        <li class="active">View All Category</li>
      </ol>
    </section>
    <section class="content">
      <h1 align="center" style="color: #337ab7;"><?php echo $_SESSION['message']; unset($_SESSION['message']);?></h1>
      <div class="button-wrapper ">
    <button onclick="location.href='<?php echo SITEPATH;?>admin/Category/add_new_Category_page.php'">
        Add Category
    </button>
</div>

      <div class="table-responsive" style="overflow-x: auto;">
        <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
          <thead>
            <tr>
              <td><strong>Sr no</strong></td>
              <td><strong>Category Name</strong></td>
              <td><strong>Image</strong></td>
              <td><strong>Decsription</strong></td>
              <td><strong>Create Date</strong></td>
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
?>
            <tr>
              <td><?php echo $i; ?></td>
              <td ><?php  echo $rows['cat_name']; ?></td>
              <td><img src="<?php echo htmlspecialchars(SITEPATH. 'upload/image/'. $rows['image']);?>" width="100" height="100"></td>

              <td ><?php  echo $rows['url']; ?></td>
              <td ><?php echo $rows['cat_startfrom']; ?></td>
              <?php if($r['user_type']=="1")
			{ ?>
              <td id="font12" width="20%"><?php if( $per['categories']['edit']==1 ){?>
                <a href="<?php  echo SITEPATH;?>/admin/action/categories.php?action=status&id=<?php echo  urlencode(encryptIt($rows['cat_id'])); ?>"<?php if($rows['cat_status']=="0"){ ?> onMouseOver="showbox('active<?php echo $i;?>')" onMouseOut="hidebox('active<?php echo $i;?>')" ><i class="fa fa-angle-double-up"></i>
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
                &nbsp;&nbsp; <a href="<?php echo SITEPATH; ?>/admin/Category/add_new_Category_page.php?id=<?php echo  urlencode(encryptIt($rows['cat_id'])); ?>"onMouseOver="showbox('Edit<?php echo $i;?>')"  onMouseOut="hidebox('Edit<?php echo $i;?>')"> <i class="fa fa-pencil"></i></a>
                <div id="Edit<?php echo $i;?>" class="hide1">
                  <p>Edit</p>
                </div>
                &nbsp;&nbsp;
                <?php }?>
                <?php if( $per['categories']['del']==1 ){?><a href="<?php echo SITEPATH;?>/admin/action/categories.php?action=del&id=<?php echo urlencode(encryptIt($rows['cat_id'])); ?>" onClick="return confirm('Are you sure you want to delete?');" onMouseOver="showbox('Delete<?php echo $i;?>')" onMouseOut="hidebox('Delete<?php echo $i;?>')"><i class="fa fa-times"></i></a>

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
  <footer class="main-footer">
    <?php include_once("../common/copyright.php");?>
  </footer>
</div>
<?php include_once("../common/footer.php");?>
</body>
</html>