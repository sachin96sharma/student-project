<?php 
include("../../system_config.php");
include_once("../common/head.php");

$name="Add New Banner";
if(isset($_GET['id']))
{
  $name="Update Banner";
  $id = urlencode(decryptIt($_GET['id']));  
  $row = getbanner_byID($id);
}
?>
<body class="hold-transition skin-blue sidebar-mini fixed">
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
        <form id="form" name="form" action="<?php  echo SITEPATH;?>/admin/action/banner.php?action=save" method="post" enctype="multipart/form-data"  >
          <input id="data_id" name="data_id" type="hidden" value="<?php echo $id ?>" />
          <div class="box-body">
            <div class="row">
              
             
              
              <!--buttons-->
              <div class="clearfix"></div>
              
              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Title 1</label>
                  <input id="title" class="form-control" name="title" type="text" REQUIRED value="<?php echo (isset($row['banner_name'])) ? $row['banner_name'] : ''; ?>"/>
                  <label class="label-brdr" style="width: 0%;"></label>
                </div>
              </div>
              <div class="clearfix"></div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Title 2</label>
                  <input id="title2" class="form-control" name="title2" type="text" REQUIRED value="<?php echo (isset($row['banner_name2'])) ? $row['banner_name2'] : ''; ?>"/>
                  <label class="label-brdr" style="width: 0%;"></label>
                </div>
              </div>
              <div class="clearfix"></div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Title 3</label>
                  <input id="title3" class="form-control" name="title3" type="text" REQUIRED value="<?php echo (isset($row['banner_name3'])) ? $row['banner_name3'] : ''; ?>"/>
                  <label class="label-brdr" style="width: 0%;"></label>
                </div>
              </div>
              <div class="clearfix"></div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Title 4</label>
                  <input id="title4" class="form-control" name="title4" type="text" REQUIRED value="<?php echo (isset($row['banner_name4'])) ? $row['banner_name4'] : ''; ?>"/>
                  <label class="label-brdr" style="width: 0%;"></label>
                </div>
              </div>
              <div class="clearfix"></div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Title 5</label>
                  <input id="title5" class="form-control" name="title5" type="text" REQUIRED value="<?php echo (isset($row['banner_name5'])) ? $row['banner_name5'] : ''; ?>"/>
                  <label class="label-brdr" style="width: 0%;"></label>
                </div>
              </div>
             
			  
              <div class="clearfix"></div>
              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Upload Image :</label>
				   <input type="file" name="images" id="images" accept="image/*" class="form-control"/>
                  <label class="label-brdr" style="width: 0%;"></label>
                </div>
              </div>
			  
			  
              <div class="clearfix"></div>
              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Status</label>
                  <select id="select" name="select" class="form-control">
                    <?php
                                    foreach ($config['display_status'] as $key => $value) {
                                          $selected = ($key == $row['banner_status']) ? ' selected="selected"' : '';
                                    echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
                                    }
                                    ?>
                  </select>
                </div>
              </div>
              
              <!--buttons-->
              <div class="clearfix"></div>
              <div class="btn-submit-active">
                <input type="submit" value="Submit"/>
                <span></span></div>
              <a href="<?php  echo SITEPATH;?>/admin/Banner" class="btn btn-cancel">Cancel</a> </div>
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