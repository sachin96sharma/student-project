<?php
include("../../system_config.php");
include_once("../common/head.php");

$name = "Add referal";

if (isset($_GET['id'])) {
    $name = "Update referal";

    $id = decryptIt($_GET['id']);
    // You might want to implement a function like getCategory_byID() for retrieving game details by ID
    $referdetails = getreferDetailsByID($id);
    $st = $referdetails['status'];
    // $str = $referdetails['type'];
}

// Check permissions, redirect if necessary
if ($per['categories']['add'] == 0) {
    header("Location: ../dashboard.php");
    exit();
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Include your CSS files here -->
    <!-- Include your JavaScript files here -->
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
                    <form id="form" name="form" action="<?php echo SITEPATH; ?>admin/action/referal.php?action=save" method="post" enctype="multipart/form-data">
                        <input id="data_id" name="data_id" type="hidden" value="<?php echo isset($id) ? $id : ''; ?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>User Name</label>
                                        <select id="user" name="user" class="form-control" onfocusout="getState(this.value)">
                                            <?php
                                            $rows_list = getcustomer_byList();
                                            $i = "active";
                                            foreach ($rows_list as $rows) {     ?>
                                                <option value="<?php echo $rows['user_id']; ?>" <?php if ($row['username'] == $rows['user_id']) {  echo "selected";    } ?>><?php echo $rows['first_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="label-brdr" style="width: 0%;"></label>
                                    </div>
                                    <?php
                                    $res = getcustomer_byID($row['username']);
                                    ?>
                                    <input type="hidden" name="user_id" value="<?php echo $row['username']; ?>">

                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Refer Amount</label>
                                        <input class="form-control" required name="amount" placeholder="" value="<?php echo isset($referdetails['amount']) ? $referdetails['amount'] : ''; ?>" required type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="Active" <?php if ($st == 'Active') echo 'selected'; ?>>Active</option>
                                        <option value="Inactive" <?php if ($st == 'Inactive') echo 'selected'; ?>>Inactive</option>
                                    </select>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?php echo SITEPATH; ?>/admin/referal/index.php" class="btn btn-default">Cancel</a>
                        </div>
             
                    </form>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <?php include_once("../common/copyright.php"); ?>
        </footer>
    </div>
    <?php include_once("../common/footer.php"); ?>












</body>

</html>