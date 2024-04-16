<?php
 include("system_config.php");
if(isset($_SESSION['userid']))
{
	header('Location: account-settings');
}
else
{
 include('common/head.php');?>
</head>
<body>
<?php include('common/header.php'); ?>
<div class="container">
  <div class="row">
    <div class="col-lg-9">
      <div class="container">
        <div class="row">
          <?php 
		if($_SESSION['msglogin']=='error')
		{
		?>
          <div id="sign_up_success"><i class="fa fa-error" aria-hidden="true"></i>
            <h4>Email id And Password is Incorect</h4>
          </div>
          <?php unset($_SESSION['msglogin']); }?>
          <?php 
		if($_SESSION['msg']=='success')
		{
		?>
          <div id="sign_up_success"><i class="fa fa-check-circle-o" aria-hidden="true"></i>
            <h4>You have signed up successfully.</h4>
            <p> Password is sent to your Email ID</span></p>
            <p class="check_spam">(check your spam folder as well)</p>
            </div>
          <?php unset($_SESSION['msg']); unset($_SESSION['pass']);}?>
          <div class="col-xs-12 col-md-6">
            <h6 class="custom-login-title mt-5">Login with Password</h6>
            <form method="post" action="<?php echo SITEPATH; ?>Sign-in-post" class="login border-radius-0" name="loginwithpassword" id="loginwithpassword">
              <p class="form-row form-row-wide">
                <label for="username">Enter Email Address</label>
                <input type="email" class="input-text" name="username" id="username" value="" placeholder="Enter Email Address " maxlength="50" required>
              </p>
              <p class="form-row form-row-wide">
                <label for="password">Password</label>
                <input class="input-text" type="password" name="password" placeholder="password" id="password" maxlength="25" required>
                <br>
              </p>
              <a class="mt-5" style="color:#e3154f" href="<?php echo SITEPATH; ?>sign-up">Register now <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
              <p class="form-row mt-5">
                <input class="button" type="submit" value="Login" name="btnloginwithpassword" id="btnloginwithpassword">
              </p>
              <p class="lost_password mt-5"><a href="<?php echo SITEPATH; ?>lost-password">Lost your password?</a></p>
            </form>
          </div>
          <div class="col-xs-12 col-md-6">
          <h5 class="custom-login-title mt-5">&nbsp;</h5>
            <!--<h6 class="custom-login-title mt-5">Login with OTP</h6>
            <form method="post" action="<?php echo SITEPATH; ?>otp" class="login border-radius-0" name="loginwithpassword" id="loginwithpassword">
              <p class="form-row form-row-wide">
                <?php 
		if($_SESSION['otperror']=='error')
		{
		?>
              <div id="sign_up_success"><i class="fa fa-error" aria-hidden="true"></i>
                <h4>Your Number Not Registered</h4>
              </div>
              <?php unset($_SESSION['otperror']); }?>
              <?php 
		if($_SESSION['otperrornew']=='error')
		{
		?>
              <div id="sign_up_success"><i class="fa fa-error" aria-hidden="true"></i>
                <h4>Wrong Otp</h4>
              </div>
              <?php unset($_SESSION['otperrornew']); }?>
              <?php if(isset($_SESSION['true'])) {?>
              <label for="username">Enter Your OTP</label>
              <input type="text" class="input-text" name="user_otp" id="user_otp" required onKeyPress="return event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57" placeholder="Enter Your OTP" maxlength="4">
              <input type="hidden" name="user_p" value="<?php echo  $_SESSION['otpnumber'];?>">
              <?php 
						}
						else
						{
					?>
              <label for="username">Enter Your Mobile Number</label>
              <input type="text" class="input-text" name="user_phone" id="user_phone" required onKeyPress="return event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57" placeholder="Enter Your Mobile Number(without +91)" maxlength="10">
              <?php }
					echo $_SESSION['otp'];
					?>
              </p>
              <p class="form-row mt-3">
                <?php if(isset($_SESSION['true'])) {?>
                <input class="button" type="submit" value="Submit" name="btnloginwithpassword" id="send">
                <a href="<?php echo SITEPATH; ?>otp" style="margin-left: 20px;
    font-size: 15px;
    text-decoration: underline !important;">Re-send OTP</a>
                <?php } else {?>
                <input class="button" type="submit" value="Submit" name="btnloginwithpassword" id="btnloginwithpassword">
                <?php } unset($_SESSION['true']);?>
              </p>
            </form>-->
            <img class="mt-2" src="<?php echo SITEPATH; ?>web/images/logon.png"> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('common/footer.php');?>
</body>
</html></body>
</html>
<?php }
?>