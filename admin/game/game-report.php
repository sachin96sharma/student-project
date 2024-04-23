<?php
include("../../system_config.php");
include_once("../common/head.php");
// pr('hello');die;
$gameId = $_GET['gameId'];
// pr($gameId);die;
// Check permissions
if ($per['user']['view'] == 0) {
    header("Location: ../dashboard.php");
    exit;
}

// Retrieve game data from the database
if ($r['user_type'] == "1") {
    $gameArra = getReport_bylist($gameId);
    
} else {
    $games = getGameDetailsByID($_SESSION['AdminLogin']); // Implement this function to get games by user
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once("../common/head.php"); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">
        <?php include_once("../common/left_menu.php"); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>View reports</h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li class="active">View Report</li>
                </ol>
            </section>
            <section class="content">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#view">View Data</a></li>
                    <li><a data-toggle="tab" href="#group">Group by User & Bet Amount</a></li>
                </ul>
                <div class="tab-content">
                    <div id="view" class="tab-pane fade in active">
                        <h1 align="center" style="color: #337ab7;"><?php echo htmlspecialchars($_SESSION['message']);
                                                                    unset($_SESSION['message']); ?></h1>
                        <div class="table-responsive" style="overflow-x: auto;">
                            <table id="exportableView" align="center" class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <td><strong>S.no</strong></td>
                                        <td><strong>Game Name</strong></td>
                                        <td><strong>User Name</strong></td>
                                        <td><strong>Bet Amount</strong></td>
                                        <td><strong>Game biding</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $serialNumber = 1;
                                    foreach ($gameArra as $game) {
                                        $getCategory = getCategoryName_byID($game['category_id']);
                                        $res = getGameDetailsByID($game['game_id']);
                                        $user = getcustomer_byID($game['user_id']);
                                    ?>
                                        <tr>
                                            <td><?php echo $serialNumber++; ?></td>
                                            <td><?php echo htmlspecialchars($res['name']); ?></td>
                                            <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                                            <td><?php echo htmlspecialchars($game['bet_amount']); ?></td>
                                            <td><?php echo htmlspecialchars($game['created_at']); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="group" class="tab-pane fade">
                        <!-- Grouped data will be shown here -->
                        <div class="table-responsive" style="overflow-x: auto;">
                            <table id="exportableGroup" align="center" class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <td><strong>S.no</strong></td>
                                        <td><strong>User Name</strong></td>
                                        <td><strong>Bet Amount</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $serialNumber = 1;
                                    foreach ($gameArra as $game) {
                                        $res = getGameDetailsByID($game['game_id']);
                                        $user = getcustomer_byID($game['user_id']);
                                    ?>
                                        <tr>
                                            <td><?php echo $serialNumber++; ?></td>
                                            <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                                            <td><?php echo htmlspecialchars($game['bet_amount']); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <?php include_once("../common/copyright.php"); ?>
        </footer>
    </div>
    <?php include_once("../common/footer.php"); ?>
    <!-- Include JavaScript libraries like jQuery and Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>
