<?php
include("../../system_config.php");
include_once("../common/head.php");
$name = "Add New Category";
if (isset($_GET['id'])) {
  $name = "Update Category";
  $id = decryptIt($_GET['id']);
  $res = getCategory_byID($id);
}

if ($per['categories']['add'] == 0) { ?>
  <script>
    window.location.href = "../dashboard.php";
  </script>
<?php } ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js" type="text/javascript"></script>
<SCRIPT type="text/javascript">
  $(document).ready(function() {
    $("#user_email").change(function() {

      var user_email = $("#user_email").val();
      var msgbox = $("#status");


      if (user_email.length > 3) {
        $("#status").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking availability...');

        $.ajax({
          type: "POST",
          url: "check_url.php",
          data: "user_email=" + user_email,
          success: function(msg) {

            $("#status").ajaxComplete(function(event, request) {

              if (msg == 'OK') {

                $("#user_email").removeClass("red");
                $("#user_email").addClass("green");
                msgbox.html('<img src="yes.png" align="absmiddle"> <font color="Green"> Available </font>  ');
              } else {
                $("#user_email").removeClass("green");
                $("#user_email").addClass("red");
                msgbox.html(msg);
              }

            });
          }

        });

      } else {
        $("#user_email").addClass("red");
        $("#status").html('<font color="#cc0000">Enter valid User Name</font>');
      }



      return false;
    });

  });
</SCRIPT>
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
  <div class="wrapper">
    <?php include_once("../common/left_menu.php"); ?>
    <div class="content-wrapper">
      <!-- Content Header -->
      <section class="content-header">
        <h1><?php echo $name; ?></h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?php echo $name; ?></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="box box-info">
          <!-- <div align="center" style="color:#FF0000">
            <?= $_SESSION['msg']; ?>
          </div> -->
          <form id="form" name="form" action="<?php echo SITEPATH; ?>/admin/action/categories.php?action=save" method="post" enctype="multipart/form-data">
            <input id="data_id" name="data_id" type="hidden" value="<?php echo $id ?>" />
            <div class="box-body">
              <div class="row">
                <input type="hidden" name="cat_sub" value="1">

                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Category Name</label>
                    <input class="form-control" required name="cat_name" placeholder="" type="text" value="<?php echo $res['cat_name']; ?>" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" name="image" id="image" class="form-control">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Description</label>
                    <input class="form-control" required id="user_email" name="url" placeholder="" value="<?php echo $res['url']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Status</label>
                    <select id="display_status" name="display_status" class="form-control">
                      <?php
                      foreach ($config['display_status'] as $key => $value) {
                        $selected = ($key == $res['cat_status']) ? ' selected="selected"' : '';
                        echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                
                <div class="clearfix"></div>

                <div class="clearfix"></div>
                <div class="btn-submit-active">
                  <input type="submit" value="Submit" />
                  <span></span>
                </div>
                <a href="<?php echo SITEPATH; ?>/admin/Category" class="btn btn-cancel">Cancel</a>
              </div>
            </div>
          </form>
          <div class="box-footer clearfix"> </div>
        </div>
      </section>
    </div>
    <footer class="main-footer">
      <?php include_once("../common/copyright.php"); ?>
    </footer>
  </div>
  <?php include_once("../common/footer.php"); ?>
</body>