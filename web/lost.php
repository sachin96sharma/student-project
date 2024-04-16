<?php
 include("system_config.php"); 
 include('common/head.php');?>
</head>
<body>
<?php include('common/header.php'); ?>
<div class="container">
  <div class="row">
    <div class="col-lg-9">
       <!-- Form -->
       <div class="container">
        <div class="row">
        <?php 
		if($_SESSION['lost']=='error')
		{
		?>
          <div id="sign_up_success"><i class="fa fa-error" aria-hidden="true"></i>
            <h4>Email id And Mobile Number is Incorect</h4>
          </div>
          <?php
		}
		unset($_SESSION['lost']); ?>
         
          <?php 
		if($_SESSION['msg']=='success')
		{
		?>
          <div id="sign_up_success"><i class="fa fa-error" aria-hidden="true"></i>
            <h4> Password is sent to your Email ID</h4>
          </div>
          <?php
		}
		unset($_SESSION['msg']); ?>
          <div class="col-xs-12 col-md-6">
            <h6 class="custom-login-title custom-login-title1">Lost Password</h6>
            <form method="post" action="lost-post" class="login border-radius-0" name="loginwithpassword" id="loginwithpassword">
              <p class="form-row form-row-wide">
                  <label for="username">Enter Email or Mobile</label>
                  <input type="text" class="input-text" name="username" id="username" required value="" placeholder="Email or Mobile (without +91)" maxlength="50"> 
              </p>
              
              <p class="form-row">
                  <input class="button" type="submit" value="Submit" name="btnloginwithpassword" id="btnloginwithpassword">
                  
              </p>
              
          </form>
        
          </div>
          <div class="col-xs-12 col-md-6">
            <img class="mt-2" src="<?php echo SITEPATH; ?>web/images/Password.png">
          
          </div>
        </div>
       </div>


      </div>
    </div>
  </div>
<?php include('common/footer.php');?>
</body>
</html></body>
</html>
