<?php
include("../../system_config.php");
include_once("../common/head.php");
$rows_list = getcustomer_byList();
if ($per['user']['view'] == 0) { ?>
  <script>
    window.location.href = "../dashboard.php";
  </script>
<?php } ?>
</head>
<style>
  .button-wrapper {
    text-align: right;
  }

  .button-wrapper button {
    background-color: blue;
    width: 150px;
    height: 40px;
    margin-bottom: 10px;
    color: white;
    border: none;

    cursor: pointer;

  }
</style>

<body class="hold-transition skin-blue sidebar-mini fixed">
  <div class="wrapper">
    <?php include_once("../common/left_menu.php"); ?>
    <div class="content-wrapper">
      <!-- Content Header -->
      <section class="content-header">
        <h1>Customer List</h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Customer List</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <h1 align="center" style="color: #337ab7;"><?php echo $_SESSION['message'];
                                                    unset($_SESSION['message']); ?></h1>
        <div class="button-wrapper ">
          <button onclick="location.href='<?php echo SITEPATH; ?>admin/Customer/add-new-customer.php'">
            Add Customer
          </button>
        </div>
        <div class="table-responsive" style="overflow-x: auto;">
          <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
            <thead>
              <tr>
                <td><strong>Sr no</strong></td>
                <td><strong>Name</strong></td>
                <td><strong> Profile Image</strong></td>

                <td><strong>Email</strong></td>
                <td><strong>Number</strong></td>
                <td><strong>Bank Name</strong></td>
                <td><strong>Address</strong></td>
                <!-- <td><strong>State</strong></td>
              <td><strong>City</strong></td>
              <td><strong>Pincode</strong></td> -->
                <td><strong>Account No.</strong></td>
                <td><strong>Referral Id</strong></td>
                <td><strong>Customer Balance</strong></td>

                <?php if ($r['user_type'] == "1") { ?>
                  <td><strong>Action</strong></td>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($rows_list as $rows) {
                $ress = getdistrict_byID($rows['user_district']);
                $res = getState_byID($rows['user_state']);
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><b><?php echo $rows['first_name']; ?></b></td>

                  <!-- <td><img src="<?php echo SITEPATH . 'upload/image/' . $rows['image']; ?>" width="100" height="100"></td>  -->
                  <td>
                    <?php if ($rows['image'] != '') : ?>
                      <img src="<?php echo SITEPATH . 'upload/image/' . $rows['image']; ?>" width="100" height="100">
                    <?php else : ?>
                      <img src="<?php echo SITEPATH . 'upload/image/image.png'; ?>" width="100" height="100">
                    <?php endif; ?>
                  </td>

                  <td><?php echo $rows['user_email']; ?></td>
                  <td><?php echo $rows['user_phone']; ?></td>
                  <td><?php echo $rows['bank_name']; ?></td>
                  <td><?php echo $rows['user_address'] . ', ' . $rows['user_district'] . ', ' . $res['stateName'] . ', ' . $rows['user_pincode']; ?></td>

                  <!-- <td><?php echo $rows['user_address'] ?></td>
              <td><?php echo $res['stateName']; ?></td>
              <td><?php echo $rows['user_district']; ?></td>
               <td><?php echo $rows['user_pincode']; ?></td> -->

                  <td><?php echo $rows['bank_accountno']; ?></td>
                  <td><?php echo $rows['ref_id']; ?></td>
                  <td><?php echo $rows['balance']; ?></td>

                  <?php if ($r['user_type'] == "1") { ?>
                    <td id="font12" style="width:10%"><?php if ($per['user']['edit'] == 1) { ?>
                        <a href="<?php echo SITEPATH; ?>admin/action/customer.php?action=status&id=<?php echo  urlencode(encryptIt($rows['user_id'])); ?>" <?php if ($rows['user_status'] == "0") { ?> onMouseOver="showbox('active<?php echo $i; ?>')" onMouseOut="hidebox('active<?php echo $i; ?>')"><i class="fa fa-angle-double-up"></i>
                        <?php } else { ?>
                          onMouseOver="showbox('inactive<?php echo $i; ?>')" onMouseOut="hidebox('inactive<?php echo $i; ?>')"> <i class="fa fa-angle-double-down"></i>
                        <?php } ?>
                        </a>
                        <div id="active<?php echo $i; ?>" class="hide1">
                          <p>Active</p>
                        </div>
                        <div id="inactive<?php echo $i; ?>" class="hide1">
                          <p>Inactive</p>
                        </div>

                        <!-- <?php if ($r['user_id'] == "1") { ?>
                <?php ?> &nbsp;&nbsp; <a href="<?php echo SITEPATH; ?>/admin/user/setting.php?id=<?php echo  urlencode(encryptIt($rows['user_id'])); ?>"onMouseOver="showbox('Setting<?php echo $i; ?>')"  onMouseOut="hidebox('Setting<?php echo $i; ?>')"> <i class="fa fa-cogs"></i></a>
                <div id="Setting<?php echo $i; ?>" class="hide1">
                  <p>Setting</p>
                </div><?php } ?>-->
                        &nbsp;&nbsp; <a href="<?php echo SITEPATH; ?>admin/Customer/add_new_customer.php?id=<?php echo  urlencode(encryptIt($rows['user_id'])); ?>" onMouseOver="showbox('Edit<?php echo $i; ?>')" onMouseOut="hidebox('Edit<?php echo $i; ?>')"> <i class="fa fa-pencil"></i></a>
                        <div id="Edit<?php echo $i; ?>" class="hide1">
                          <p>Edit</p>
                        </div>
                      <?php } ?>
                      &nbsp;&nbsp;
                      <?php if ($per['user']['del'] == 1) { ?>
                        <a href="<?php echo SITEPATH; ?>/admin/action/customer.php?action=del&id=<?php echo  urlencode(encryptIt($rows['user_id'])); ?>" onClick="return confirm('Are you sure you want to delete?');" onMouseOver="showbox('Delete<?php echo $i; ?>')" onMouseOut="hidebox('Delete<?php echo $i; ?>')"><i class="fa fa-times"></i></a>
                        <div id="Delete<?php echo $i; ?>" class="hide1">
                          <p>Delete</p>
                        </div>
                      <?php } ?>
                    </td>
                  <?php } ?>
                </tr>
              <?php
                $i++;
              } ?>
            </tbody>
          </table>
        </div>
      </section>
    </div>
    <!--close page contets , start footer-->
    <footer class="main-footer">
      <?php include_once("../common/copyright.php"); ?>
    </footer>
  </div>
  <?php include_once("../common/footer.php"); ?>
</body>

</html>