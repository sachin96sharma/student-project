<?php
 include("system_config.php");
if(isset($_SESSION['userid']))
{
 
 include('common/head.php');

 ?>
</head>
<body>
<?php include('common/header.php');  ?>
<div class="container">
  <div class="row">
    <div class="col-lg-9">
   <!-- col-lg-9 -->   
   <?php 
		if($_SESSION['msg']=='error')
		{
		?>
          <div id="sign_up_success"><i class=" fa fa-window-close" aria-hidden="true"></i>
            <h4>Error.</h4>
           </div>
          <?php unset($_SESSION['msg']); }?>
          <?php 
		if($_SESSION['msg']=='success')
		{
		?>
          <div id="sign_up_success"><i class="fa fa-check-circle-o" aria-hidden="true"></i>
            <h4>Password Changed successfully.</h4>
           </div>
          <?php unset($_SESSION['msg']); unset($_SESSION['pass']);}?>
   <article class="page type-page status-publish hentry">

 
    <div itemprop="mainContentOfPage" class="entry-content">
        <div id="accordion" role="tablist" aria-multiselectable="true">
            <div class="vc_toggle panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <div class="vc_toggle_title">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="">Member Basic Details</a>
                        </h4>
                        <i class="vc_toggle_icon"></i>
                    </div>
                </div>
                <div id="collapseOne" class="vc_toggle_content panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true" style="">
                    <div class="table-responsive">
                   
                        <table class="table table-compare" style="margin-bottom: 0px;">
                            <tbody>
                                <tr>
                                    <th>Member Type</th>
                                    <td><?php echo $config['customer_type'][$rowuser['6']]; ?></td>
                                </tr>
                                <tr>
                                    <th>Full Name</th>
                                    <td><?php echo $rowuser['1']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email ID</th>
                                     <td><?php echo $rowuser['5']; ?></td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <td><?php echo $rowuser['12']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- <p>If you'd like to make any changes in your <strong>Basic Details</strong>, please send mail to <a href="mailto:data@studentsdatabase.in">data@studentsdatabase.in</a> mentioning the required changes.</p> -->
                </div>
            </div>
            <div class="vc_toggle panel panel-default">
                <div class="panel-heading" role="tab" id="headingTow">
                    <div class="vc_toggle_title">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTow" aria-expanded="false" aria-controls="collapseTow" class="collapsed">Change your Password</a>
                        </h4>
                        <i class="vc_toggle_icon"></i>
                    </div>
                </div>
                <div id="collapseTow" class="vc_toggle_content panel-collapse collapse" role="tabpanel" aria-labelledby="headingTow" aria-expanded="false" style="height: 0px;">
                 <div id="changepassword_error" style="padding-top: 1em; border: 1px solid #f25858;"><h5 style="font-size: 0.9em;"><i class="fa fa-exclamation-circle"></i>Error Occured!</h5><span style="margin-left: 1.5em; display: block; font-size: 0.9em;">Technical Error</span></div>
                 <div id="changepassword_success"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Password is updated successfuly.</div>

<style>


#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 0px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green !important;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
</style>
            <div class="col2-set" id="customer_login" style="padding-top: 0em; padding-bottom: 0em;">
                <div class="col-1 login-cols">
                    <form method="post" class="login border-radius-0" name="changepassword" id="changepassword" style="margin-top: -15px;" onSubmit = "return checkPassword(this)" action="<?php echo SITEPATH; ?>changepassword" >
                        <p class="form-row form-row-wide">
                            <label for="currentpassword">Your Current Password</label>
                            <input class="input-text" type="password" name="currentpassword" placeholder="Existing password" id="currentpassword" maxlength="15">
                        </p>
                        <p class="form-row form-row-wide">
                            <label for="newpassword">New Password</label>
                            <input class="input-text" type="password" id="psw" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required maxlength="15">
                          
                       
                        </p>
                        
                        <p class="form-row form-row-wide">
                            <label for="repassword">Re-enter Password</label>
                            <input class="input-text" type="password" name="pswd2" placeholder="Re-enter new password" id="pswd2" maxlength="15">
                        </p>
                        <p class="form-row">
                            <input class="button" type="submit" value="Submit" name="btnchangepassword" id="btnchangepassword" onClick=" return  matchPassword()">
                        </p>
                         <div class="clear"></div>
                    </form>
                </div><!-- .col-1 -->
                <!-- .col-2 -->
                <div class="col-2" >
                   <div id="message">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
                </div>
            </div><!-- .col2-set -->

  <script>
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
<script>
          
            // Function to check Whether both passwords
            // is same or not.
            function checkPassword(form) {
                password1 = changepassword.psw.value;
                password2 = changepassword.pswd2.value;
  
                // If password not entered
                if (password1 == '')
                    alert ("Please enter Password");
                      
                // If confirm password not entered
                else if (password2 == '')
                    alert ("Please enter confirm password");
                      
                // If Not same return False.    
                else if (password1 != password2) {
                    alert ("\nPassword did not match: Please try again...")
                    return false;
                }
  
                // If same return True.
                else{
                    return true;
                }
            }
        </script>  
                </div>
            </div>
            <div class="vc_toggle panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <div class="vc_toggle_title">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="collapsed">Billing Details</a>
                        </h4>
                        <i class="vc_toggle_icon"></i>
                    </div>
                </div>
                <div id="collapseThree" class="vc_toggle_content panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false" style="height: 0px;">
                    <div class="table-responsive">
                     <?php  //print_r($rowuser);
	$res = getState_byID($rowuser['14']);
					 ?>
                        <table class="table table-compare" style="margin-bottom: 0px;">
                            <tbody>
                            <?php if ($rowuser['6']=="0"){?>
                                <tr>
                                <th>Organization Name</th>
                               <td><?php echo $rowuser['20']; ?></td>
                                </tr>
                                <?php }?>
                                <tr>
                                    <th>Address</th>
                                    
                                       <td><?php echo $rowuser['17'].'&nbsp;'.$rowuser['13'].'&nbsp;'.$res['stateName'].'&nbsp;'.$config['country'][$rowuser['7']].'&nbsp;'.$rowuser['21']; ?></td>
                                    
                                </tr>
                                  <?php if ($rowuser['6']=="0"){?>
                                <tr>
                                    <th>GST Number</th>
                                   
                                   <td><?php echo $rowuser['18']; ?></td>
                                  
                                </tr><?php }?>
                            </tbody>
                        </table>
                    </div>
                    <!-- <p>If you'd like to make any changes in your <strong>Basic Details</strong>, please send mail to <a href="mailto:data@studentsdatabase.in">data@studentsdatabase.in</a> mentioning the required changes.</p> -->


                </div>
            </div>

            <div class="vc_toggle panel panel-default">
                <div class="panel-heading" role="tab" id="headingFour">
                    <div class="vc_toggle_title">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour" class="collapsed">Order List</a>
                        </h4>
                        <i class="vc_toggle_icon"></i>
                    </div>
                </div>
                <div id="collapseFour" class="vc_toggle_content panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour" aria-expanded="false" style="height: 0px;">
                    <?php $rows_list = getorders_byID_user_acc($rowuser['0']) ;?>

                  <table class="table table-compare compare-list tir" style="margin-bottom: 0em;">
                                            <tbody>
                                                <tr>
                                                    <th class="sno">No</th>
                                                    <th class="t_date">Date</th>
                                                    <th>Database(s) Purchased</th>
                                                    <th class="inv">Amount</th>
                                                    <th>Payment Type</th>
                                                    <th>Payment</th>
                                                    <th>Invoice</th>
                                                </tr>
                                                <?php 
$i=1;
foreach ($rows_list as $rows) {
	$res = getcustomer_byID($rows['customer_id']);
	$price="0";
	$quantity="0";
	$res1 = getorders_byID_product_index($rows['order_id']);
	
		 ?>
                                                <tr>
                                                    <td><?php echo $rows['order_id']; ?></td>
                                                    <td  style="width: 110px;"><?php echo date("d-m-Y", strtotime($rows['createdate'])); ?></td>          
                                                    <td>
                                                    <?php
			  foreach ($res1 as $rows1) {
		$doc = getdocument_byID($rows1['product_id']);
		$quantity=$quantity+$rows1['quantity'];
		$price=$price+($rows1['price']*$rows1['quantity']);
		
		
	?>
                                                    <ul style="margin: 0px 0px 0px 10px;"><li><?php echo $rows1['name']; ?></li></ul>
                                                    
                                                    <?php }?></td>
                                                    <td class="Inv">
                                                   <?php 
				$gst = $price*18/100;
				//echo $gst+$price; 
				echo number_format(round($gst+$price));
				?>

                                                    </td>
                                                     <td><?php echo $config['paymentyype'][$rows['paymentyype']].'<br>'.$rows['bank_ref_num']; ?></td>
                                                    <td class="Rcpt"><?php echo $config['paymentstatus'][$rows['paymentstatus']].'<br>'.$rows['p_desc']; ?></td>
 <td><a href="<?php echo SITEPATH; ?>invoice/<?php echo  urlencode(encryptIt($rows['order_id'])); ?>">Invoice</a></td>
                                                </tr>
                                            <?php }?>
                                            </tbody>
                                        </table>
                    
                

    
                </div>
            </div>
            <!-- <div class="vc_toggle panel panel-default">
                <div class="panel-heading" role="tab" id="headingFive">
                    <div class="vc_toggle_title">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive" class="collapsed">Receive notification settings</a>
                        </h4>
                        <i class="vc_toggle_icon"></i>
                    </div>
                </div>
                <div id="collapseFive" class="vc_toggle_content panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" aria-expanded="false" style="height: 0px;">
                    <form method="post" name="notify" id="notify" style="margin-top: -10px;">
                  
                    
                    <div style="margin-bottom: 2em;">I want to receive <strong>new database update</strong> on:</div>
                    <div style="margin-bottom: 2em;">
                      <label class="receive_update">Email<input id="chkEmail" name="chkEmail" type="checkbox" checked="checked" wfd-id="id4"><span class="checkmark"></span></label><label class="receive_update">SMS<input id="chkSMS" name="chkSMS" type="checkbox" checked="checked" wfd-id="id5"><span class="checkmark"></span></label><label class="receive_update">WhatsApp<input id="chkWhatsapp" name="chkWhatsapp" type="checkbox" checked="checked" wfd-id="id6"><span class="checkmark"></span></label></div>

                    <input id="btnnotify" type="submit" value="save changes" class="button alt" style="font-size: 0.9em; padding: 0.7em 1.5em 0.7em 1.5em; font-weight: 600;">
                    </form>
                </div>
            </div> -->
        </div>
    </div><!-- .entry-content -->
</article>







<!-- col-lg-9 -->
      </div>
    </div>
  </div>



<!-- slider-closed -->

<?php include('common/footer.php');?>
</body>
</html></body>
</html>
<?php }
else
{
		header('Location: Login');
}
