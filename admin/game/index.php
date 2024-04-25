<?php
include("../../system_config.php");
include_once("../common/head.php");

// Check permissions
if ($per['user']['view'] == 0) {
  header("Location: ../dashboard.php");
  exit;
}

// Retrieve game data from the database
if ($r['user_type'] == "1") {
  $games = getGame_list();
} else {
  $games = getGameDetailsByID($_SESSION['AdminLogin']); // Implement this function to get games by user
}
?>

<!DOCTYPE html>
<html>

<head>
  <?php include_once("../common/head.php"); ?>
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
        <h1>View All Games</h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i>Home</a></li>
          <li class="active">View All Games</li>
        </ol>
      </section>
      <section class="content">
        <h1 align="center" style="color: #337ab7;"><?php echo htmlspecialchars($_SESSION['message']);
                                                    unset($_SESSION['message']); ?></h1>
        <div class="button-wrapper ">
          <button onclick="location.href='<?php echo SITEPATH; ?>admin/Game/add-game.php'">
            Add Game
          </button>
        </div>

        <div class="table-responsive" style="overflow-x: auto;">
          <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
            <thead>
              <tr>
                <td><strong>S.no</strong></td>
                <td><strong>Category</strong></td>
                <td><strong>Game Name</strong></td>
                <td><strong>Image</strong></td>
                <td><strong>Game Play Date</strong></td>
                <td><strong>Biding Start Date</strong></td>
                <td><strong> Biding End Date</strong></td>
                <td><strong>Result</strong></td>
                <!-- <td><strong>Status</strong></td> -->
                <td><strong>Action</strong></td>
              </tr>
            </thead>
            <tbody>
              <?php
              $serialNumber = 1;
              foreach ($games as $game) {
                $getCategory = getCategoryName_byID($game['category_id']);
                
              ?>
                <tr>
                  <td><?php echo $serialNumber++; ?></td>
                  <td><?php echo htmlspecialchars($getCategory['cat_name']); ?></td>
                  <td><?php echo htmlspecialchars($game['name']); ?></td>
                  <td><img src="<?php echo htmlspecialchars(SITEPATH . 'upload/image/' . $game['image']); ?>" width="100" height="100"></td>
                  <td><?php echo htmlspecialchars($game['gamestart']); ?></td>
                  <td><?php echo htmlspecialchars($game['gamebiding']); ?></td>
                  <td><?php echo htmlspecialchars($game['gameend']); ?></td>
                  <td><?php echo htmlspecialchars($game['result']); ?></td>
                  <!-- <td><?php echo htmlspecialchars($game['status']); ?></td> -->

                  <?php if ($r['user_type'] == "1") { ?>
                    <td id="font12" style="width:10%">
                      <?php if ($per['user']['edit'] == 1) { ?>
                        <a href="<?php echo htmlspecialchars(SITEPATH); ?>/admin/action/games.php?action=status&id=<?php echo urlencode(encryptIt($game['id'])); ?>" <?php if ($game['status'] == "active") { ?> onMouseOver="showbox('active<?php echo $i; ?>')" onMouseOut="hidebox('active<?php echo $i; ?>')"><i class="fa fa-angle-double-up"></i>
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
                        &nbsp;&nbsp; <a href="<?php echo htmlspecialchars(SITEPATH); ?>/admin/Game/add-game.php?id=<?php echo urlencode(encryptIt($game['id'])); ?>" onMouseOver="showbox('Edit<?php echo $i; ?>')" onMouseOut="hidebox('Edit<?php echo $i; ?>')"> <i class="fa fa-pencil"></i></a>
                        <div id="Edit<?php echo $i; ?>" class="hide1">
                          <p>Edit</p>
                        </div>
                      <?php } ?>

                      &nbsp;&nbsp;
                      <a href="<?= SITEPATH . 'admin/game/game-report.php?gameId=' . $game['id']; ?>" title="Game Report" target="_blank">
                      <i class="fa fa-bar-chart"></i>
                      </a>

                    </td>
                </tr>
            <?php
                  } // end of if($r['user_type'] == "1")
                } // end of foreach ($games as $game)
            ?>
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