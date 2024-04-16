<div class="top-bar">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-xs-12"> <a href="/">All India Students Database</a> </div>
      <?php if (isset($_SESSION['userid'])) { ?>
        <div class="col-lg-9 col-md-9 col-xs-12">
          <nav>
            <ul id="menu-top-bar-right" class="nav nav-inline pull-right animate-dropdown flip">
              <li class="menu-item animate-dropdown c_name">
                <?php
                $sql = "SELECT * FROM customer WHERE user_id='" . $_SESSION['userid'] . "' and user_status='0' LIMIT 1";
                $rowsuser = mysqli_query($link, $sql);
                if (mysqli_num_rows($rowsuser) == 1) {
                  $rowuser = mysqli_fetch_row($rowsuser);
                  echo $rowuser['1'];
                } else {
                  echo 'Welcome Guest';
                }
                ?>
              </li>
              <li class="menu-item animate-dropdown wallet"><a title="Wallet" href="<?php echo SITEPATH; ?>wallet">Wallet: <span class="zero"> ₹ <span id="wallet_balance"><?php echo $rowuser['22']; ?></span></span></a></li>
              <li class="menu-item animate-dropdown"><a title="My Downloads" href="<?php echo SITEPATH; ?>downloads"><i class="fa fa-folder-open-o my_download" aria-hidden="true"></i>My Downloads</a></li>
              <li class="menu-item animate-dropdown"><a title="Account &amp; Settings" href="<?php echo SITEPATH; ?>account-settings"><i class="fa fa-cogs" aria-hidden="true"></i>Account &amp; Settings</a></li>
              <li class="menu-item animate-dropdown"><a title="Logout" href="<?php echo SITEPATH; ?>logout"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a><!--
  </ul-->
              </li>
            </ul>
          </nav>
        </div>
      <?php } else { ?>
        <div class="col-lg-9 col-md-9 col-xs-12">
          <ul id="menu-top-bar-right" class="middle-header2">
            <li class="menu-item"><a href="<?php echo SITEPATH; ?>Login"><i class="fa fa-user"></i>Login Here</a></li>
          </ul>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

<style>
  #sdcart {
    z-index: 5000;
    background-color: #fed700;
    padding-top: 0.7em;
    padding-bottom: 0.7em;
    text-align: right;
    display: none;
  }

  #sdcart a.button {
    padding: 0.4em 1em 0.4em 1em;
    font-size: 0.9em;
    margin-right: 1em;
  }

  #sign_up_success {
    background-color: #f1f9f7;
    border-color: #e0f1e9;
    color: #1d9d74;
    padding: 0.5em 0.8em 0.5em 0.8em;
    text-align: center;
  }

  #sign_up_success i {
    padding: 0.1em;
    color: #09543c;
    font-size: 2.5em;
    display: block;
  }

  #sign_up_success p {
    color: #1A1A1A;
    text-align: center;
  }

  #sign_up_success p.check_spam {
    font-style: italic;
    font-size: 0.95em;
  }
</style>
<?php

if (!empty($_SESSION["shopping_cart"])) {
  $cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
  <div id="sdcart" style="display: block;">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-5 carthead"><i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 1.3em;"></i>Total item(s) in the Cart: <span id="cart_count"><?php echo $cart_count; ?></span> </div>
        <div class="col-xs-12 col-md-7 cartlink"> <a class="button view_cart" href="<?php echo SITEPATH; ?>Cart"><i class="fa fa-shopping-bag" aria-hidden="true"></i>View Cart</a> <a class="button checkout" href="<?php echo SITEPATH; ?>Checkout"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>Checkout</a> <a class="button delete" href="<?php echo SITEPATH; ?>remove-cart"><i class="fa fa-trash-o" aria-hidden="true"></i>Remove Cart</a> </div>
      </div>
    </div>
  </div>
<?php
}
?>


<style>
  .search-box {
    width: 300px;
    position: relative;
    display: inline-block;
    font-size: 14px;
  }

  .search-box input[type="text"] {
    height: 36px;
    padding: 5px 10px;
    border: 1px solid #CCCCCC;
    font-size: 14px;
  }

  .result {
    position: absolute;
    z-index: 999;
    top: 100%;
    left: 0;
  }

  .search-box input[type="text"],
  .result {
    width: 100%;
    box-sizing: border-box;
  }

  /* Formatting result items */
  .result p {
    margin: 0;
    padding: 7px 10px;
    border: 1px solid #CCCCCC;
    border-top: none;
    cursor: pointer;
  }

  .result p:hover {
    background: #f2f2f2;
  }

  @media screen and (min-width: 991px) {
    .middle-header2 {
      display: none;
    }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
  jQuery(document).ready(function() {
    jQuery('.search-box input[type="text"]').on("keyup input", function() {
      /* Get input value on change */
      var inputVal = $(this).val();
      var resultDropdown = $(this).siblings(".result");
      if (inputVal.length) {
        jQuery.get("<?php echo SITEPATH; ?>app/backend-search.php", {
          term: inputVal
        }).done(function(data) {
          // Display the returned data in browser
          resultDropdown.html(data);

        });
      } else {
        resultDropdown.empty();
      }
    });

    // Set search input value on click of result item
    jQuery(document).on("click", ".result p", function() {
      jQuery(this).parents(".search-box").find('input[type="text"]').val($(this).text());
      jQuery(this).parent(".result").empty();
    });
  });
</script>

</ <form method="post" action="<?php echo SITEPATH; ?>Search">
<div class="middle-header mt-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-xs-12"> <a href="<?php echo SITEPATH; ?>"><img style="width: 42%;" src="<?php echo SITEPATH; ?>web/images/logo.png" /> </a></div>
      <div class="col-lg-5">
        <label class="sr-only" for="inlineFormInputGroup">Please Enter Keywords</label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></div>
          </div>
          <div class="search-box">
            <input type="text" class="form-control" name="term" autocomplete="off" placeholder="Please Enter Keywords..." value="<?php echo $_REQUEST['term']; ?>" required="required" />
            <!-- <div class="result"></div>-->
          </div>
          <input class="button" type="submit" value="Submit" name="btnloginwithpassword" id="btnloginwithpassword">
        </div>
      </div>
      <div class="col-lg-4 col-md-9 col-xs-12">
        <ul id="menu-top-bar-right" class="">
          <?php

          if (isset($_SESSION['userid']) && mysqli_num_rows($rowsuser) == 1) {
          ?>
            <li class="menu-item">Welcome <?php echo $rowuser['1']; ?></li>
            <li class="menu-item"><a href="<?php echo SITEPATH; ?>account-settings"><i class="fa fa-user"></i>My Account</a></li>
          <?php
          } else {
          ?>
            <li class="menu-item">Welcome Guest</li>
            <li class="menu-item"><a href="<?php echo SITEPATH; ?>Login"><i class="fa fa-user"></i>Login Here</a></li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>
</form>

<div class="mobilemenu">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-6"> <img style="width: 35%;" src="<?php echo SITEPATH; ?>web/images/logo.png" /> </div>
      <div class="col-sm-6 col-6">
        <nav class="navbar navbar-expand-lg navbar-light"> <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <?php
              $rows_list = getCategory_list_index();
              foreach ($rows_list as $rows) {   ?>
                <li class="nav-item"> <a class="nav-link" href="<?php echo SITEPATH; ?>Category/<?php echo myUrlEncode($rows['cat_name']); ?>/<?php echo encryptIt($rows['cat_id']); ?>"><?php echo $rows['cat_name']; ?></a> </li>
              <?php
              } ?>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </div>
</div>

<div id="mySidenav" class="sidenav">
  <p style="    display: block;
          background-color: rgba(0, 0, 0, 0.5);
          cursor: pointer;
          color: #fff;
          overflow: hidden;
          font-weight: bold;
          border-bottom: 1px solid rgba(255, 255, 255, 0.2);     margin-bottom: 0;
          padding: 10px;"><span>Close</span><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></p>
  <?php
  $rows_list = getCategory_list_index();
  foreach ($rows_list as $rows) {   ?>
    <a href="<?php echo SITEPATH; ?>Category/<?php echo myUrlEncode($rows['cat_name']); ?>/<?php echo encryptIt($rows['cat_id']); ?>"><?php echo $rows['cat_name']; ?></a>
  <?php
  } ?>

</div>


<script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "80%";
    document.getElementById("main").style.marginLeft = "80%";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
  }
</script>


<div class="left-category mt-3">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 offset-lg-9">
        <div class="databaseHead">
          <p> <span id="mini_dc_head">Database </span>Categories &nbsp; &nbsp;<i class="fa fa-caret-down"></i></p>
          <div class="desktopmenu">
            <div class="deskHead">
              <ul class="list-group vertical-menu yamm make-absolute">
                <?php
                $rows_list = getCategory_list_index();
                foreach ($rows_list as $rows) {   ?>
                  <li class="menu-item-menu "><a href="<?php echo SITEPATH; ?>Category/<?php echo myUrlEncode($rows['cat_name']); ?>/<?php echo encryptIt($rows['cat_id']); ?>"><?php echo $rows['cat_name']; ?></a></li>
                <?php
                } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 