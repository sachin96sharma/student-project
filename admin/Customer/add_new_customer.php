<?php
include("../../system_config.php");
include_once("../common/head.php");
$name = "Add New Customer";
if (isset($_GET['id'])) {
  $name = "Update Customer";
  $id = decryptIt($_GET['id']);
  $res = getcustomer_byID($id);
}
if ($per['user']['add'] == 0) { ?>
  <script>
    window.location.href = "../dashboard.php";
  </script>
<?php } ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?php echo $name; ?></title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js" type="text/javascript"></script>

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#user_email").change(function() {

        var user_email = $("#user_email").val();
        var msgbox = $("#status");


        if (user_email.length > 3) {
          $("#status").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking availability...');

          $.ajax({
            type: "POST",
            url: "check_ajax.php",
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
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#user_phone").change(function() {

        var user_phone = $("#user_phone").val();
        var msgbox = $("#status2");


        if (user_phone.length > 3) {
          $("#status2").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking availability...');

          $.ajax({
            type: "POST",
            url: "check_ajax2.php",
            data: "user_phone=" + user_phone,
            success: function(msg) {

              $("#status2").ajaxComplete(function(event, request) {

                if (msg == 'OK') {

                  $("#user_phone").removeClass("red");
                  $("#user_phone").addClass("green");
                  msgbox.html('<img src="yes.png" align="absmiddle"> <font color="Green"> Available </font>  ');
                } else {
                  $("#user_phone").removeClass("green");
                  $("#user_phone").addClass("red");
                  msgbox.html(msg);
                }

              });
            }

          });

        } else {
          $("#user_phone").addClass("red");
          $("#status2").html('<font color="#cc0000">Enter valid User Name</font>');
        }



        return false;
      });

    });
  </script>


  <!-- <script>
    const datetimeInput = document.getElementById('datetimeInput');
    const displayDate = document.getElementById('displayDate');

    datetimeInput.addEventListener('input', () => {
      const selectedDateTime = datetimeInput.value;
      const selectedDate = selectedDateTime.split('T')[0]; // Get only the date part

      displayDate.textContent = `Selected Date: ${selectedDate}`;
    });
  </script> -->
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
          <div class="box-header with-border"> </div>
          <form id="form" name="form" action="<?php echo SITEPATH; ?>admin/action/customer.php?action=save" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <input id="data_id" name="data_id" type="hidden" value="<?php echo $id ?>" />
            <div class="box-body">
              <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                  <h4 class="divd">Login Detail</h4>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                  <label>Email</label>
                  <input class="form-control" id="user_email" required name="user_email" placeholder="" value="<?php echo $res['user_email']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                  <label class="label-brdr" style="width: 0%;"></label>

                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                  <label> <span id="status"></span></label>
                </div>
              </div>
              <h2 id='result'></h2>
              <div class="clearfix"></div>
              <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                  <label>Mobile Number</label>
                  <input class="form-control" id="user_phone" required name="user_phone" minlength='10' , maxlength='10' , onkeypress='return isNumber();' , placeholder="" value="<?php echo $res['user_phone']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                  <label class="label-brdr" style="width: 0%;"></label>
                  <span id="mobileError" class="error"></span>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                  <label> <span id="status2"></span></label>
                </div>
              </div>
              <h2 id='result2'></h2>
              <div class="clearfix"></div>
              <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Password</label>
                  <input class="form-control" name="password" id="password" required placeholder="" minlength=6 value="<?php if (!$res['user_pass'] == "") {
                                                                                                                          echo decryptIt($res['user_pass']);
                                                                                                                        } ?>" type="password" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                  <label class="label-brdr" style="width: 0%;"></label>
                </div>
              </div>
              <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input class="form-control" name="confirm_password" id="confirm_password" minlength=6 placeholder="" value="<?php if (!$res['user_pass'] == "") {
                                                                                                                                echo decryptIt($res['user_pass']);
                                                                                                                              } ?>" type="password" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                  <label class="label-brdr" style="width: 0%;"></label>
                </div>
              </div>
              <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                  <label> <span id='message'></span></label>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                  <h4 class="divd">Profile Detail</h4>
                </div>
                <!-- <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Member Type</label>
                    <select id="user_type" name="user_type" class="form-control" onClick="myFunction()">
                      <?php
                      foreach ($config['customer_type'] as $key => $value) {
                        $selected = ($key == $res['user_type']) ? ' selected="selected"' : '';
                        echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div> -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Profile Name</label>
                    <input class="form-control" required name="first_name" placeholder="" type="text" value="<?php echo $res['first_name']; ?>" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Profile Image</label>
                    <input class="form-control" name="image" type="file" accept="image/*" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Customer Balance</label>
                    <input class="form-control" name="balance" required type="number" value="<?php echo $res['balance']; ?>" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label for="datepicker">Date of Birth</label>
                    <?php
                    // Assuming $res['dob'] contains the date value from PHP
                    $dob_value = isset($res['dob']) ? htmlspecialchars($res['dob']) : '';
                    ?>
                    <input type="date" name="dob" id="datepicker" class="form-control" value="<?php echo $dob_value; ?>" required>

                    <script>
                      document.addEventListener('DOMContentLoaded', function() {
                        const datePicker = document.getElementById('datepicker');

                        datePicker.addEventListener('input', function() {
                          const selectedDateTime = datePicker.value;
                          const selectedDate = selectedDateTime.split('T')[0];
                          datePicker.value = selectedDate;
                        });
                      });
                    </script>


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
                    <label>Country</label>
                    <select id="user_country" name="user_country" class="form-control" onChange="getState(this.value)">
                      <?php
                      foreach ($config['country'] as $key => $value) {
                        $selected = ($key == $res['user_country']) ? ' selected="selected"' : '';
                        echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <script>
                  // function getState(countryId) {
                  //   var stateDropdown = document.getElementById('user_state');
                  //   var cityDropdown = document.getElementById('user_city');

                  //   if (countryId) {
                  //     stateDropdown.disabled = false;
                  //     cityDropdown.disabled = true;
                  //     cityDropdown.innerHTML = '<option value="">Select a state first</option>';

                  //     fetchStates(countryId)
                  //       .then(function(response) {
                  //         populateStates(response.states);
                  //         populateCities(response.cities);
                  //       })
                  //       .catch(function(error) {
                  //         console.log('Error:', error);
                  //       });
                  //   } else {
                  //     stateDropdown.disabled = true;
                  //     cityDropdown.disabled = true;
                  //     stateDropdown.innerHTML = '<option value="">Select a Country first</option>';
                  //     cityDropdown.innerHTML = '<option value="">Select a State first</option>';
                  //   }
                  // }

                  // function fetchStates(countryId) {
                  //   return fetch('get_states_cites.php?countryId=' + countryId)
                  //     .then(function(response) {
                  //       if (!response.ok) {
                  //         throw new Error('Failed to fetch states');
                  //       }
                  //       return response.json();
                  //     });
                  // }

                  function getCites(stateId) {
                    var stateDropdown = document.getElementById('user_state');
                    var cityDropdown = document.getElementById('user_district');

                    if (stateId) {
                      cityDropdown.disabled = false;

                      fetchCites(stateId)
                        .then(function(response) {
                          populateCities(response.cities);
                        })
                        .catch(function(error) {
                          console.log('Error:', error);
                        });
                    } else {
                      stateDropdown.disabled = true;
                      cityDropdown.disabled = true;
                      stateDropdown.innerHTML = '<option value="">Select a Country first</option>';
                      cityDropdown.innerHTML = '<option value="">Select a State first</option>';
                    }
                  }

                  function fetchCites(stateId) {
                    return fetch('get_states_cites.php?stateId=' + stateId)
                      .then(function(response) {
                        if (!response.ok) {
                          throw new Error('Failed to fetch states');
                        }
                        return response.json();
                      });
                  }

                  function populateStates(states) {
                    var stateDropdown = document.getElementById('user_state');
                    stateDropdown.innerHTML = '<option value="">Select a state</option>';
                    states.forEach(function(state) {
                      var option = document.createElement('option');
                      option.value = state.id;
                      option.textContent = state.name;
                      stateDropdown.appendChild(option);
                    });
                  }

                  function populateCities(cities) {
                    var cityDropdown = document.getElementById('user_district');
                    cityDropdown.innerHTML = '<option value="">Select a City</option>';
                    cities.forEach(function(city) {
                      var option = document.createElement('option');
                      option.value = city.id;
                      option.textContent = city.name;
                      cityDropdown.appendChild(option);
                    });
                  }
                </script>

                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>State</label>
                    <!-- <select id="user_state" name="user_state" class="form-control" onChange="getState(this.value)"> -->
                    <select id="user_state" name="user_state" onchange="getCites(this.value)" class="form-control">

                      <?php
                      $rows_list = getState_list();
                      $i = 1;
                      foreach ($rows_list as $rows) { ?>
                        <option value="<?php echo $rows['id']; ?>" <?php if ($rows['id'] == $res['user_state'])  echo "selected"; ?>><?php echo $rows['name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Town / City / District</label>
                    <select id="user_district" name="user_district" class="form-control"ś>
                      <option value="">Select City</option>
                      <?php
                    if (!empty($res['user_district'])) {
                      $cities_list = getCityList();
                      foreach ($cities_list as $city) {
                        $selected = ($city['id'] == $res['user_district']) ? 'selected' : '';
                        echo '<option value="' . $city['id'] . '" ' . $selected . '>' . $city['name'] . '</option>';
                      }
                    }
                    ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Pincode</label>
                    <input class="form-control" required name="user_pincode" placeholder="" value="<?php echo $res['user_pincode']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-12">
                  <h4 class="divd">Referral</h4>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Referral Id</label>
                    <input class="form-control" required name="ref_id" placeholder="" minlength='8' maxlength='8' value="<?php echo $res['ref_id']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Referral By</label>
                    <input class="form-control" required name="ref_by" placeholder="" minlength='8' maxlength='8' value="<?php echo $res['ref_by']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                  <h4 class="divd">Bank Deatil</h4>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Account Holder Name</label>
                    <input class="form-control" required name="accountholder_name" placeholder="" value="<?php echo $res['accountholder_name']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Bank Account Number</label>
                    <input class="form-control" required name="bank_accountno" placeholder="" value="<?php echo $res['bank_accountno']; ?>" type="number" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Bank IFSC Code</label>
                    <input class="form-control" required name="bank_ifsccode" placeholder="" value="<?php echo $res['bank_ifsccode']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Bank Name</label>
                    <input class="form-control" required name="bank_name" placeholder="" value="<?php echo $res['bank_name']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                    <label class="label-brdr" style="width: 0%;"></label>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <!-- <div class="col-sm-12 col-md-12 col-lg-12">
                  <h4 class="divd">Other Information</h4>
                </div> -->
              <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label>Description</label>
                  <input class="form-control" name="user_desc" placeholder="" value="<?php echo $res['user_desc']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                </div>
              </div>
              <div class="col-sm-4 col-md-4 col-lg-4">
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

              <!--buttons-->
              <div class="clearfix"></div>
              <div class="btn-submit-active">
                <input type="submit" value="Submit" />
                <span></span>
              </div>
              <a href="<?php echo SITEPATH; ?>admin/Customer" class="btn btn-cancel">Cancel</a>
            </div>
        </div>
        </form>
        <div class="box-footer clearfix"> </div>
    </div>
    </section>
  </div>
  <script>
    function myFunction() {
      if (document.getElementById("user_type").value == "1") {
        document.getElementById("o_name").style.display = 'none';
        document.getElementById("gst").style.display = 'none';
      } else {
        document.getElementById("o_name").style.display = 'block';
        document.getElementById("gst").style.display = 'block';
      }

    }
  </script>
  <!--close page contets , start footer-->
  <footer class="main-footer">
    <?php include_once("../common/copyright.php"); ?>
  </footer>
  </div>
  <script>
    $('#password, #confirm_password').on('keyup', function() {
      if ($('#password').val() == $('#confirm_password').val()) {
        $('#message').html('Matching').css('color', 'green');
      } else
        $('#message').html('Not Matching').css('color', 'red');
    });
  </script>
  <script type="text/javascript">
    <?php
    if ($r['user_type'] == "1") {
    ?>

      function validateEmail(email) {
        var = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return.test(String(email).toLowerCase());
      }
    <?php } ?>

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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script>
    function validateForm() {
      var valid = true; // Declare and initialize 'valid' as true

      // Reset any existing error messages
      var errorElements = document.getElementsByClassName("error");
      for (var i = 0; i < errorElements.length; i++) {
        errorElements[i].innerHTML = "";
      }

      // Validate Mobile Number
      var mobileLabel = document.querySelector('label[for="user_phone"]');
      var mobileInput = document.getElementById("user_phone");
      var mobileValue = mobileInput.value.trim();
      var mobileError = document.createElement("span");
      mobileError.classList.add("error");

      if (mobileValue === "") {
        mobileError.innerHTML = "Mobile number must be filled out";
        mobileLabel.appendChild(mobileError);
        valid = false;
      } else if (!/^\d{10}$/.test(mobileValue)) {
        mobileError.innerHTML = "Invalid mobile number format";
        mobileLabel.appendChild(mobileError);
        valid = false;
      }

      return valid;
    }
  </script>
  <script>
    // JavaScript to initialize the datepicker
    $(document).ready(function() {
      // Configure the datepicker
      $("#datepicker").datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true,
        yearRange: '1900:2024'
      });
    });
  </script>
  <?php include_once("../common/footer.php"); ?>


</body>

</html>