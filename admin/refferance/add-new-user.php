<?php
include("../../system_config.php");
include_once("../common/head.php");
$name = "Add New User";
// pr($_SESSION);exit;
if (isset($_GET['id'])) {
  $name = "Update User";
  $id = decryptIt($_GET['id']);
  $res = getUserByID($id);
} else {
  if ($per['user']['add'] == 0) { ?>
    <script>
      window.location.href = "../dashboard.php";
    </script>
<?php }
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js" type="text/javascript">
</script>


<script type="text/javascript">
  /*input hover effect*/
  function txtFocus(Inp) {
    $(Inp).next(".label-brdr").css("width", "100%");
    $(Inp).parent(".form-group").find("label").css("color", "#06b5ef");
  }

  function txtFocusOut(Inp) {
    $(Inp).next(".label-brdr").css("width", "0%");
    $(Inp).parent(".form-group").find("label").css("color", "#999");
  }

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

<script type="text/javascript" src="<?php echo SITEPATH; ?>syspanel/js/custom.js">
</script>

<script language="javascript" type="text/javascript">
  function getXMLHTTP() {
    var xmlhttp = false;
    try {
      xmlhttp = new XMLHttpRequest();
    } catch (e) {
      try {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e) {
        try {
          xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e1) {
          xmlhttp = false;
        }
      }
    }

    return xmlhttp;
  }
</script>


<!-- image validation  -->
<script>
  function validateFileInput(input) {
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    var files = input.files;

    for (var i = 0; i < files.length; i++) {
      var file = files[i];
      var fileName = file.name;

      if (!allowedExtensions.test(fileName)) {
        alert("Please select a valid file with extension .jpg, .jpeg, or .png.");
        input.value = ""; // Clear the selected file
        return false;
      }
    }

    return true;
  }
</script>

</head>

<body class="hold-transition skin-blue sidebar-mini fixed">

  <div class="wrapper">
    <?php include_once("../common/left_menu.php"); ?>
    <div class="content-wrapper">
      <!-- Content Header -->
      <section class="content-header">
        <h1>
          <?php if ($per['user']['add'] == 1) { ?>
            <?php echo $name; ?>
          <?php } else {
            echo "&nbsp;";
          } ?>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">
            <?php if ($per['user']['view'] == 1) { ?>
              <?php echo $name; ?>
            <?php } else {
              echo "&nbsp;";
            } ?>
          </li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="box box-info">
          <form id="form" name="form" action="<?php echo SITEPATH; ?>admin/action/user.php?action=save" method="post" enctype="multipart/form-data">
            <input id="data_id" name="data_id" type="hidden" value="<?php echo encryptIt($id); ?>" />
            <div class="box-body">
              <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                  <h4 class="divd">Login Detail</h4>
                </div>
              </div>

              <div class="clearfix"></div>
              <?php if ($r['user_type'] == "1") { ?>
                <div class="col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" id="user_email" autocomplete="username" name="user_email" placeholder="" value="<?php echo $res['user_email']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">

                  </div>
                </div>
              <?php } else {
              ?>
                <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label><?php echo $res['user_email']; ?></label>
                  </div>
                </div>
              <?php } ?>
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
                  <input class="form-control" name="password" id="password" minlength="6" value="<?php if (!$res['user_pass'] == "") {
                                                                                                    echo decryptIt($res['user_pass']);
                                                                                                  } ?>" type="password" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);" autocomplete="new-password">


                </div>
              </div>
              <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input class="form-control" name="confirm_password" id="confirm_password" minlength=6 autocomplete="new-password" value="<?php if (!$res['user_pass'] == "") {
                                                                                                                                              echo decryptIt($res['user_pass']);
                                                                                                                                            } ?>" type="password" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">

                </div>
              </div>
              <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                  <label> <span id='message'></span></label>
                </div>
              </div>
              <div style=" <?php if ($per['user']['add'] == 1) { ?> display:block;<?php } else { ?> display:none;<?php } ?>">
                <div class="col-sm-12 col-md-12 col-lg-12"> </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Profile Detail</h4>
              </div>
              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Name</label>
                  <input class="form-control" required name="first_name" placeholder="" type="text" value="<?php echo $res['first_name']; ?>" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">

                </div>
              </div>

              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Mobile Number </label>
                  <input class="form-control" required name="user_phone" placeholder="" value="<?php echo $res['user_phone']; ?>" type="number" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">

                </div>
              </div>

              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Address</h4>
              </div>

              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Full Address</label>
                  <input class="form-control" required name="user_address" placeholder="" value="<?php echo $res['user_address']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">

                </div>
              </div>

              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>State Name</label>
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
                  var cityDropdown = document.getElementById('user_city');

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
                  var cityDropdown = document.getElementById('user_city');
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
                  <label>City</label>
                  <select id="user_city" name="user_district" class="form-control" <?php echo empty($res['user_district']) ? 'disabled' : ''; ?>>
                    <?php
                    if (!empty($res['user_state'])) {
                      $cities_list = getCityList($res['user_state']);
                      foreach ($cities_list as $city) {
                        $selected = ($city['id'] == $res['user_district']) ? 'selected' : '';
                        echo '<option value="' . $city['id'] . '" ' . $selected . '>' . $city['name'] . '</option>';
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="clearfix"></div>


              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>PinCode</label>
                  <input class="form-control" name="user_tel" placeholder="" value="<?php echo $res['user_tel']; ?>" type="number" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">

                </div>
              </div>


              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <h4 class="divd">Other Information</h4>
              </div>
              <div class="col-sm-6 col-md-4 col-lg-4" style=" <?php if ($per['user']['add'] == 1) { ?> display:block;<?php } else { ?> display:none;<?php } ?>">
                <div class="form-group">
                  <label>Status</label>
                  <select id="user_status" name="user_status" class="form-control">
                    <?php foreach ($config['display_status'] as $key => $value) {
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
                  <input type="file" name="user_logo" accept=".jpg, .jpeg, .png" onchange="validateFileInput(this);" id="user_logo" class="form-control">
                </div>
              </div>


              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label>Description</label>
                  <input class="form-control" maxlength="500" name="user_desc" placeholder="" value="<?php echo $res['user_desc']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                </div>
              </div>
              <div class="btn-submit-active">
                <input type="submit" id="validate" value="Submit" onClick="ValidateEmail(document.form.user_email)" />
                <span></span>
              </div>
              <a href="<?php echo SITEPATH; ?>admin/user" class="btn btn-cancel">Cancel</a>
            </div>
        </div>
        </form>
        <div class="box-footer clearfix"> </div>
      </section>
    </div>
  </div>

  <script>
    function validateNonNegativeNumber(input) {
      let value = input.value.replace(/[^0-9.]/g, '');
      if (value !== '' && parseFloat(value) < 0) {
        input.value = '';
      } else {
        input.value = value;
      }
    }
  </script>

  <!--close page contets , start footer-->
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
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
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

  <script type="text/javascript">
    function changetextbox() {
      var id = document.getElementById("user_type").value;
      if (id == "0") {
        document.getElementById('salesman').style.display = 'none';
        document.getElementById('supplier').style.display = 'none';
        document.getElementById('salesman').style.display = 'none';
        document.getElementById('customer').style.display = 'none';
      }
      if (id == "1") {
        document.getElementById('supplier').style.display = 'none';
        document.getElementById('salesman').style.display = 'none';
        document.getElementById('customer').style.display = 'none';
      }
      if (id == "2") {
        document.getElementById('supplier').style.display = 'block';
        document.getElementById('salesman').style.display = 'none';
        document.getElementById('customer').style.display = 'none';
      }

      if (id == "3") {
        document.getElementById('salesman').style.display = 'block';
        document.getElementById('supplier').style.display = 'none';
        document.getElementById('customer').style.display = 'none';
      }

      if (id == "4") {
        document.getElementById('customer').style.display = 'block';
        document.getElementById('supplier').style.display = 'none';
        document.getElementById('salesman').style.display = 'none';
      }

    }
  </script>

  <footer class="main-footer">
    <?php include_once("../common/copyright.php"); ?>
  </footer>

  </div>
  <?php include_once("../common/footer.php"); ?>
</body>

</html>