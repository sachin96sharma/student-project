<?php 
include("../system_config.php");
?>
<html>
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Students Database</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo SITEPATH;?>admin/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo SITEPATH;?>admin/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SITEPATH;?>admin/css/admin.css">
  <!-- Skins -->
  <style type="text/css">
.fa {
	font-size:20px;
}
.form-group {
    margin-top: 20px!important;
}
</style>
  </head>
  <body style="background:url(images/123456789.jpg) top right no-repeat;background-size: cover;">
<div class="container login-container">
    <div class="row">
    <div class="col-sm-7" style="border:0px solid "> </div>
    <div class="col-sm-5" style="border:0px solid ">
        <div class="login-box">
        <div class="login-logo"> <a href=""><img src="<?php echo SITEPATH;?>web/images/logo.png" class="img-responsive center-block"></a> </div>
      </div>
        <form class='input-form' action='action/login.php?action=login' method="post" name="form">
        <div class="login-box-body" style="padding: 10px;">
            <h1>Login</h1>
            <p style="color: #0058b4;"><?php echo $_SESSION['msg'];unset($_SESSION['msg']); ?></p>
            <div class="form-group has-feedback">
            <input name="txt_userId" type="text" maxlength="50" class="form-control" placeholder="Username">
            <span class="fa fa-unlock form-control-feedback"></span> </div>
            <div class="form-group has-feedback">
            <input name="txt_password" type="password" maxlength="50" class="form-control" placeholder="Password">
            <span class="fa fa-key form-control-feedback"></span> </div>
            <div class="row">
            <div class="clearfix"></div>
            <div class="col-sm-12">
                <div class="btn-submit-active">
                <input value="Login" type="submit">
                <span></span></div>
              </div>
            <div style="font-size: 15px;margin-top: 27px;">© 2023 Students Database. All rights reserved. </div>
          </div>
      </form>
      </div>
  </div>
  </div>
</body>
</html>