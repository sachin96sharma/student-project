<?php 
include("../../system_config.php");
include_once("../common/head.php");
$name="Add New User";
if(isset($_GET['id']))
{
  $name="Update User";
  $id = decryptIt($_GET['id']);  
  $res = getuser_byID($id);
}
else
{
    if($r['user_type']=="0"){?>
<script>
window.location.href="../dashboard.php";
</script>
<?php }?>
<?php }
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js" type="text/javascript"></script>
<SCRIPT type="text/javascript">
$(document).ready(function()
{
$("#user_email").change(function() 
{ 

var user_email = $("#user_email").val();
var msgbox = $("#status");


if(user_email.length > 3)
{
$("#status").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking availability...');

$.ajax({  
    type: "POST",  
    url: "check_ajax.php",  
    data: "user_email="+ user_email,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request){ 

	if(msg == 'OK')
	{ 
	
	    $("#user_email").removeClass("red");
	    $("#user_email").addClass("green");
        msgbox.html('<img src="yes.png" align="absmiddle"> <font color="Green"> Available </font>  ');
	}  
	else  
	{  
	     $("#user_email").removeClass("green");
		 $("#user_email").addClass("red");
		msgbox.html(msg);
	}  
   
   });
   } 
   
  }); 

}
else
{
 $("#user_email").addClass("red");
$("#status").html('<font color="#cc0000">Enter valid User Name</font>');
}



return false;
});

});
</SCRIPT>
<script type="text/javascript" src="<?php echo SITEPATH;?>/syspanel/js/custom.js"></script>
<script language="javascript" type="text/javascript">
function getXMLHTTP() { 
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	function getState(countryId) {		
		var strURL="<?php echo SITEPATH;?>/admin/user/findState.php?country="+countryId;
		var req = getXMLHTTP();
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					if (req.status == 200) {						
						document.getElementById('statediv').innerHTML=req.responseText;
						document.getElementById('citydiv').innerHTML='<select name="city"required class="form-control1">'+
						'<option>Select District</option>'+
				        '</select>';						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
  <?php include_once("../common/left_menu.php");?>
  <div class="content-wrapper"> 
    <!-- Content Header -->
    <section class="content-header">
      <h1>
        <?php if($per['user']['add']==1)
			{ ?>
        <?php echo $name;?>
        <?php }else { echo "&nbsp;";}?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SITEPATH;?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">
          <?php if($per['user']['view']==1)
			{ ?>
          <?php echo $name;?>
          <?php }else { echo "&nbsp;";}?>
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="box box-info">
    <form id="form" name="form" action="<?php  echo SITEPATH;?>/admin/action/user.php?action=save" method="post" enctype="multipart/form-data"  >
      <input id="data_id" name="data_id" type="hidden" value="<?php echo $id ?>" />
      <div class="box-body">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="divd">Login Detail</h4>
          </div>
        </div>
        
        <div class="clearfix"></div>
        <?php if($r['user_type']=="1")
			{ ?>
        <div class="col-sm-6 col-md-6 col-lg-6">
          <div class="form-group">
            <label>Email</label>
            <input class="form-control" id="user_email"  name="user_email" placeholder="" value="<?php echo $res['user_email']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
            <label class="label-brdr" style="width: 0%;"></label>
          </div>
        </div>
        <?php }
			else
			{
			?>
        <div class="col-sm-6 col-md-6 col-lg-6">
          <div class="form-group">
            <label><?php echo $res['user_email']; ?></label>
          </div>
        </div>
        <?php }?>
        <div class="col-sm-6 col-md-6 col-lg-6">
          <div class="form-group">
            <label> <span id="status"></span></label>
          </div>
        </div>
        <h2 id='result'></h2>
        <div class="clearfix"></div>
        <div class="col-sm-4 col-md-4 col-lg-4">
          <div class="form-group">
            <label>Password</label>
            <input class="form-control"  name="password" id="password" placeholder="" minlength=6 value="<?php if(!$res['user_pass']==""){ echo decryptIt($res['user_pass']); }?>" type="password" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
            <label class="label-brdr" style="width: 0%;"></label>
          </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
          <div class="form-group">
            <label>Confirm Password</label>
            <input class="form-control"  name="confirm_password" id="confirm_password" minlength=6 placeholder="" value="<?php if(!$res['user_pass']==""){ echo decryptIt($res['user_pass']); }?>" type="password" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
            <label class="label-brdr" style="width: 0%;"></label>
          </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
          <div class="form-group">
            <label> <span id='message'></span></label>
          </div>
        </div>
        <div style=" <?php if($per['user']['add']==1)
			{ ?> display:block;<?php }else {?> display:none;<?php } ?>">
          <div class="col-sm-12 col-md-12 col-lg-12"> </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12">
          <h4 class="divd">Profile Detail</h4>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="form-group">
            <label>Name</label>
            <input class="form-control" required name="first_name" placeholder="" type="text" value="<?php echo $res['first_name']; ?>" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
            <label class="label-brdr" style="width: 0%;"></label>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="form-group">
            <label>Mobile Number </label>
            <input class="form-control" required name="user_phone" placeholder="" value="<?php echo $res['user_phone']; ?>" type="number" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
            <label class="label-brdr" style="width: 0%;"></label>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="form-group">
            <label>Pincode</label>
            <input class="form-control" name="user_tel" placeholder="" value="<?php echo $res['user_tel']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
            <label class="label-brdr" style="width: 0%;"></label>
          </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12">
          <h4 class="divd">Address</h4>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="form-group">
            <label>Address</label>
            <input class="form-control" required name="user_address" placeholder="" value="<?php echo $res['user_address']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
            <label class="label-brdr" style="width: 0%;"></label>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="form-group">
            <label>State Name</label>
            <select id="user_state" name="user_state" class="form-control" onChange="getState(this.value)">
              <?php  
					$rows_list = getState_list(); 
$i=1;
					foreach ($rows_list as $rows) {?>
              <option value="<?php echo $rows['stateID'];?>"<?php if($rows['stateID']==$res['user_state'])  echo "selected"; ?> ><?php echo $rows['stateName'] ;?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="form-group">
            <label >City Name</label>
            <input class="form-control" required name="user_district" placeholder="" value="<?php echo $res['user_district']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12 col-md-12 col-lg-12">
          <h4 class="divd">Other Information</h4>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4" style=" <?php if($per['user']['add']==1)
			{ ?> display:block;<?php }else {?> display:none;<?php } ?>">
          <div class="form-group">
            <label>Status</label>
            <select id="user_status" name="user_status" class="form-control">
              <?php
                                    foreach ($config['display_status'] as $key => $value) {
                                          $selected = ($key == $res['user_status']) ? ' selected="selected"' : '';
                                    echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
                                    }
                                    ?>
            </select>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="form-group">
            <label>Logo</label>
            <input type="file" name="user_logo" id="user_logo" class="form-control">
          </div>
        </div>
       
        <div class="clearfix"></div>
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="form-group">
            <label >Description</label>
            <input class="form-control" maxlength="500" required name="user_desc" placeholder="" value="<?php echo $res['user_desc']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
          </div>
        </div>
        <div class="btn-submit-active">
          <input type="submit" id="validate" value="Submit" onClick="ValidateEmail(document.form.user_email)"/>
          <span></span></div>
        <a href="<?php  echo SITEPATH;?>/admin/user" class="btn btn-cancel">Cancel</a> </div>
      </div>
    </form>
    <div class="box-footer clearfix"> </div>
  </div>
  </section>
</div>
<!--close page contets , start footer--> 
<script>
  $('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});
  </script> 
<script type="text/javascript">
  
  <?php 
  if($r['user_type']=="1")
		 {
		 ?>
       function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
<?php }?>
function validate() {
  var email = $("#user_email").val();

  if (validateEmail(email)) {
     return true;
  } else {
    alert(email + " is not valid");
	  return false;
  }

}

$("#validate").on("click", validate);
    </script> 
<script type="text/javascript">
function changetextbox()
{
	var id=document.getElementById("user_type").value;
  if(id=="0")
	{
    document.getElementById('salesman').style.display =  'none' ;
		document.getElementById('supplier').style.display =  'none' ;
    document.getElementById('salesman').style.display =  'none' ;
    document.getElementById('customer').style.display =  'none' ;
	}
  if(id=="1")
	{
		document.getElementById('supplier').style.display =  'none' ;
    document.getElementById('salesman').style.display =  'none' ;
    document.getElementById('customer').style.display =  'none' ;
	}
	if(id=="2")
	{
		document.getElementById('supplier').style.display =  'block' ;
    document.getElementById('salesman').style.display =  'none' ;
    document.getElementById('customer').style.display =  'none' ;
	}
	
  if(id=="3")
	{
		document.getElementById('salesman').style.display =  'block' ;
    document.getElementById('supplier').style.display =  'none' ;
    document.getElementById('customer').style.display =  'none' ;
	}
	
  if(id=="4")
	{
		document.getElementById('customer').style.display =  'block' ;
    document.getElementById('supplier').style.display =  'none' ;
    document.getElementById('salesman').style.display =  'none' ;
	}
	
}
	 </script>
<footer class="main-footer">
  <?php include_once("../common/copyright.php");?>
</footer>
</div>
<?php include_once("../common/footer.php");?>
</body>
</html>