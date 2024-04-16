<?php
include("../../system_config.php");
include_once("../common/head.php");

$name = "Add Game";

if (isset($_GET['id'])) {
    $name = "Update Game";

    $id = decryptIt($_GET['id']);
    // You might want to implement a function like getCategory_byID() for retrieving game details by ID
    $gameDetails = getGameDetailsByID($id);
    $st = $gameDetails['status'];
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
                    <!-- <div align="center" style="color:#FF0000">
                        ?php echo $_SESSION['msg']; ?>
                    </div> -->
                    <form id="form" name="form" action="<?php echo SITEPATH; ?>/admin/action/games.php?action=save" method="post" enctype="multipart/form-data" >
                        <input id="data_id" name="data_id" type="hidden" value="<?php echo isset($id) ? $id : ''; ?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="category_id">Category:</label>
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            <option value="">-- Select Category --</option>
                                            <?php
                                            $categories = getCategory_list();
                                            foreach ($categories as $category) {
                                                $selected = isset($gameDetails['category_id']) && $gameDetails['category_id'] == $category['cat_id'] ? 'selected' : '';
                                                echo '<option value="' . $category['cat_id'] . '" ' . $selected . '>' . $category['cat_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>


                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Game Name:</label>
                                        <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($gameDetails['name']) ? $gameDetails['name'] : ''; ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="image">Image:</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                            </div>
                            <div class="row">
                             
                                </div>
                                <!-- game -->
                               
                            </div>
                            <div class="row">
                            <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="gamebidingdate">Game Biding Start date and Time:</label>
                                        <input type="datetime-local" name="gamebiding" id="gamebiding" class="form-control" value="<?php echo isset($gameDetails['gamebiding']) ? $gameDetails['gamebiding'] : ''; ?>" step="1" required>
                                    </div>
                                </div>
                            <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="gameenddate">Game Biding End Date and Time:</label>
                                        <input type="datetime-local" name="gameend" id="gameend" class="form-control" value="<?php echo isset($gameDetails['gameend']) ? $gameDetails['gameend'] : ''; ?>" step="1" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="gamestartdate">Game Play Date and Time:</label>
                                        <input type="datetime-local" name="gamestart" id="gamestart" class="form-control" value="<?php echo isset($gameDetails['gamestart']) ? $gameDetails['gamestart'] : ''; ?>" step="1" required>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="result">Result:</label>
                                    <select name="result" id="result" class="form-control" required>
                                        <option value="">-- Select Result --</option>
                                        <?php
                                        for ($i = 0; $i <= 9; $i++) {
                                            $selected = isset($gameDetails['result']) && $gameDetails['result'] == $i ? 'selected' : '';
                                            echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="active" <?php if ($st == 'active') echo 'selected'; ?>>Active</option>
                                        <option value="inactive" <?php if ($st == 'inactive') echo 'selected'; ?>>Inactive</option>
                                    </select>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?php echo SITEPATH; ?>/admin/game/index.php" class="btn btn-default">Cancel</a>
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




<!-- 
    <script>
        function validateDateTime() {
            // Get the elements
            const gameBiding = document.getElementById("gamebiding");
            const gameStart = document.getElementById("gamestart");
            const gameEnd   = document.getElementById("gameend");
            // Convert values to Date objects for accurate comparison
            const gameBidingDate = new Date(gameBiding.value);
            const gameStartDate = new Date(gameStart.value);
            const gameEndDate = new Date(gameEnd.value);

            // Check if game start date is after game bidding date
            if (gameStartDate > gameBidingDate && gameEndDate > gameStartDate) {
                // Valid case
                return true;
          
            } else {
                // Show error message
                alert(" Game End Date and Game Start Date and Time must be after Game Bidding Date and Time.");
                return false;
            }
            
            
        }
    </script> -->






</body>

</html>