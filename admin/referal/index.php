<?php
include("../../system_config.php");
include_once("../common/head.php");
$rows_list = getrefer_list();
// pr("hello");die;
?>
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
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">
        <?php include_once("../common/left_menu.php"); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>View All History</h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li class="active">View All History</li>
                </ol>
            </section>
            <section class="content">
                <h1 align="center" style="color: #337ab7;"><?php echo $_SESSION['message'];
                                                            unset($_SESSION['message']); ?></h1>
                <div class="button-wrapper ">
                    <button onclick="location.href='<?php echo SITEPATH; ?>admin/referal/addreferal.php'">
                        Add Referal
                    </button>
                </div>
                <div class="table-responsive" style="overflow-x: auto;">
                    <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <td><strong>Sr no</strong></td>
                                <td><strong>Customer Name</strong></td>
                                <td><strong>Refer Amount</strong></td>

                                <td><strong>Status</strong></td>
                                <td><strong>Create Date</strong></td>
                                <!--	<td><strong>Status</strong></td>-->
                                <td><strong>Action</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($rows_list as $rows) {
                                $res = getcustomer_byID($rows['user']);
                                // $gem = getrows$rowsDetailsByID($rows['rows$rows_id']);



                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $res['first_name']; ?></a></td>
                                    <td><?php echo $rows['amount']; ?></td>
                                    <td><?php echo $rows['status']; ?></td>
                                    <td><?php echo $rows['created_at']; ?></td>

                                    <td id="font12" style="width:10%">
                                        <?php if ($per['user']['edit'] == 1) { ?>
                                            <a href="<?php echo htmlspecialchars(SITEPATH); ?>/admin/action/referal.php?action=status&id=<?php echo urlencode(encryptIt($rows['id'])); ?>" <?php if ($rows['status'] == "Active") { ?> onMouseOver="showbox('active<?php echo $i; ?>')" onMouseOut="hidebox('Active<?php echo $i; ?>')"><i class="fa fa-angle-double-up"></i>
                                            <?php } else { ?>
                                                onMouseOver="showbox('inactive<?php echo $i; ?>')" onMouseOut="hidebox('Inactive<?php echo $i; ?>')"> <i class="fa fa-angle-double-down"></i>
                                            <?php } ?>
                                            </a>
                                            <div id="active<?php echo $i; ?>" class="hide1">
                                                <p>Active</p>
                                            </div>
                                            <div id="inactive<?php echo $i; ?>" class="hide1">
                                                <p>Inactive</p>
                                            </div>
                                            &nbsp;&nbsp; <a href="<?php echo htmlspecialchars(SITEPATH); ?>/admin/referal/addreferal.php?id=<?php echo urlencode(encryptIt($rows['id'])); ?>" onMouseOver="showbox('Edit<?php echo $i; ?>')" onMouseOut="hidebox('Edit<?php echo $i; ?>')"> <i class="fa fa-pencil"></i></a>
                                            <div id="Edit<?php echo $i; ?>" class="hide1">
                                                <p>Edit</p>
                                            </div>
                                            <!-- &nbsp;&nbsp;<a href="<?php echo SITEPATH; ?>/admin/action/notifications.php?action=del&id=<?php echo urlencode(encryptIt($rows['id'])); ?>" onClick="return confirm('Are you sure you want to delete?');" onMouseOver="showbox('Delete<?php echo $i; ?>')" onMouseOut="hidebox('Delete<?php echo $i; ?>')"><i class="fa fa-times"></i></a> -->

                                            <div id="Delete<?php echo $i; ?>" class="hide1">
                                                <p>Delete</p>
                                            </div>
                                        <?php } ?>
                                    </td>

                                </tr>
                            <?php
                                $i++;
                            } ?>
                        </tbody>
                    </table>
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