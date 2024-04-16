<?php
 include("system_config.php"); 
 include('common/head.php');?>
</head>
<body>
<?php include('common/header.php'); ?>
<div class="container">
  <div class="row">
    <div class="col-lg-9">
      <style>
        #sign_up_success {
    background-color: #f1f9f7;
    border-color: #e0f1e9;
    color: #1d9d74;
    padding: 0.5em 0.8em 0.5em 0.8em;
    text-align: center;
}
#sign_up_success i {
    padding: 0.1em;
    color: #09543c;
    font-size: 2.5em;
    display: block;
}#sign_up_success p {
    color: #1A1A1A;
	text-align: center;
}#sign_up_success p.check_spam {
    font-style: italic;
    font-size: 0.95em;
}
        </style>
        <?php 
		if($_SESSION['msg']=='error')
		{
		?>
        <div id="sign_up_success"><i class="fa fa-check-circle-o" aria-hidden="true"></i><h4>You have signed up error.</h4>  
                            <p>Already Registered</p>
                            </div>
                          <?php }?>
      <form class="register-form border-radius-0" action="<?php echo SITEPATH; ?>sign-up-post"  method="post" name="form" id="form">
        <div class="form-group">
          <h6 class="border-custom">Member Type</h6>
          <div class="content-bg">
            <div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="opt" id="exampleRadios1" value="option1" checked onClick="myFunction1()">
                  <strong class="form-check-label" for="exampleRadios1"> Organization </strong> </div>
              </div>
              <div class="col-md-6 col-xs-12">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="opt" id="exampleRadios2" value="option2" onClick="myFunction2()">
                  <strong class="form-check-label" for="exampleRadios2"> Individual </strong> </div>
              </div>
            </div>
          </div>
        </div>
        <h6 class="border-custom border-custom1">Basic Details</h6>
        <label><strong>Full Name </strong></label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="first_name" aria-label="Text input with dropdown button" placeholder="Enter Your Full Name" required>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label><strong>Email Address </strong></label>
            <input type="email" class="form-control" id="inputEmail4" name="user_email" placeholder="Your Email ID" required>
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4"><strong>Mobile </strong></label>
            <input type="text" class="form-control" id="inputPassword4" onKeyPress="return event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57" placeholder="10 Digit Indian Mobile Number" name="user_phone" required maxlength="10">
          </div>
        </div>
       
        <h6 class="border-custom border-custom1">Billing Details</h6>
        <div class="form-group" id="orgdiv">
          <label for="inputAddress"><strong>Organization Name</strong></label>
          <input type="text" class="form-control" id="inputoname" placeholder="Your Organization Name" name="o_name">
        </div>
        <div class="form-group">
          <label for="inputAddress2"><strong>Billing Address </strong></label>
          <input type="text" class="form-control" id="inputAddress2" placeholder="Your Address" required name="user_address">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputCity"><strong>Town / City / District</strong></label>
            <input type="text" class="form-control" id="inputCity" placeholder="Town / City / District" required name="user_district">
          </div>
          <div class="form-group col-md-6">
            <label for="inputState"><strong>State </strong></label>
            <select id="inputState" class="form-control  select-custom" name="user_state">
               <?php  
					$rows_list = getState_list(); 
$i=1;
					foreach ($rows_list as $rows) {?>
                    <option value="<?php echo $rows['stateID'];?>"<?php if($rows['stateID']=='35')  echo "selected"; ?> ><?php echo $rows['stateName'] ;?></option>
                    <?php }?>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputState"><strong>Country</strong></label>
            <select id="inputState" class="form-control select-custom" name="user_country">
              <?php  
					  foreach ($config['country'] as $key => $value) {
                                          $selected = ($key == $res['user_country']) ? ' selected="selected"' : '';
                                    echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
                                    }
                                    ?>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="inputZip"><strong>Pincode</strong></label>
            <input type="text" class="form-control" id="inputZip" onKeyPress="return event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57" maxlength="6" placeholder="Postal Code" required name="user_pincode">
          </div>
        </div>
        <div class="form-group" id="gstdiv">
          <label for="inputAddress"><strong>GST Number</strong></label>
          <input type="text" class="form-control" id="inputgst" placeholder="GST Number" name="gst">
        </div>
        <div class="form-row">
        <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="gridCheck" required>
          <label class="form-check-label" for="gridCheck"> <strong>I’ve read and accept the <a style="color:#e3154f" href="<?php echo SITEPATH; ?>terms">terms & conditions</a> , <a style="color:#e3154f" href="<?php echo SITEPATH; ?>PRIVACY-POLICY">Privacy Policy</a> , <a style="color:#e3154f" href="<?php echo SITEPATH; ?>disclaimer">Disclaimer</a> </strong> </label>
        </div>
        <button style="    color: #fff;
        background-color: #e3154f;
        border-color: #e3154f;
        font-size: 1.2rem;
        border-radius: 0px !important;
        padding: 10px 60px !important;
        font-weight: 400;" type="submit" class="btn btn-primary mt-3" onClick="IsEmpty()">Register</button>
      </form>
    </div>
  </div>
</div>
</div>
<script>
function myFunction2() {
  document.getElementById("gstdiv").style.display = 'none';
  document.getElementById("orgdiv").style.display = 'none';
}
function myFunction1() {
  document.getElementById("gstdiv").style.display = 'block';
  document.getElementById("orgdiv").style.display = 'block';
}
function IsEmpty() {
if (document.form.opt.value == "option1") {
  if (document.form.inputoname.value == "") {
    alert("Please Enter Organization Name");
  }
}
  return;
}
</script>
</div>
<?php include('common/footer.php');?>
</body>
</html></body>
</html>
