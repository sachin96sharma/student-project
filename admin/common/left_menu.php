<style>
  .skin-blue .main-header .navbar .sidebar-toggle1 {
    color: #fff;
  }

  .main-header .sidebar-toggle1 {
    float: left;
    background-color: transparent;
    background-image: none;
    padding: 17px 15px;
    font-family: fontAwesome;
  }
</style>

<header class="main-header">

  <!-- Logo -->

  <a href="<?php echo SITEPATH; ?>admin/dashboard.php" class="logo"> <span class="logo-mini"><img src="<?php echo SITEPATH; ?>/web/images/logo.png"></span> <span class="logo-lg"> <img src="<?php echo SITEPATH; ?>/web/images/logo.png" style="width: 80px;"></span> </a>

  <!-- Navbar-->

  <nav class="navbar navbar-static-top" role="navigation">

    <!-- Sidebar toggle button-->

    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo SITEPATH; ?>/upload/thumb/<?php echo $r["user_logo"]; ?>" class="user-image" alt="User Image"> <span class="hidden-xs"><?php echo $r["first_name"]; ?></span> <i class="fa fa-angle-down"></i></a>
          <ul class="dropdown-menu">

            <!-- User image -->

            <li class="user-header"> <img src="<?php echo SITEPATH; ?>/upload/thumb/<?php echo $r["user_logo"]; ?>" class="img-circle" alt="User Image">
              <p><?php echo $r["first_name"]; ?><small><?php echo $r["user_startfrom"]; ?></small> </p>
            </li>
            <li class="user-footer">
              <div class="pull-left"> <a href="<?php echo SITEPATH; ?>/admin/user/add-new-user.php?id=<?php echo  urlencode(encryptIt($r['user_id'])); ?>" class="btn btn-default btn-flat">Profile</a> </div>
              <div class="pull-right"> <a href="<?php echo SITEPATH; ?>admin/logout.php" class="btn btn-default btn-flat">Logout</a> </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <?php





    ?>
    <?php if ($r['user_id'] == "1") { ?>

      <!--<div class="navbar-custom-menu">

    <ul class="nav navbar-nav">

      <li class="dropdown user user-menu"> <a href="<?php echo SITEPATH; ?>/admin/shipment_master/index.php?c=count" class="dropdown-toggle"> <i class="fa fa-truck"></i> <span class="hidden-xs" style="    font-size: 17px;"><?php echo $totalcount[0]['COUNT(shipment_master_id)']; ?></span> </a> </li>

    </ul>

  </div>-->

    <?php } ?>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu"> </li>
      </ul>
    </div>
  </nav>
</header>

<!--header close here, starts Left side column  -->

<aside class="main-sidebar">
  <section class="sidebar" style="">

    <!-- sidebar user panel -->

    <div class="user-panel">
      <div class="pull-left image"> <img src="<?php echo SITEPATH; ?>/upload/thumb/<?php echo $r["user_logo"]; ?>" class="img-circle" alt="User Image"> </div>
      <div class="pull-left info">
        <p style="color:#666666"><small>Welcome,</small></p>
        <p><?php echo $r["first_name"]; ?></p>
      </div>
    </div>
    <?php

    ?>
    <ul class="sidebar-menu">
      <!-- <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span> District Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo SITEPATH; ?>admin/District/add_new_District_page.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <li><a href="<?php echo SITEPATH; ?>admin/District/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li>-->
      <!-- banner management  -->
      <!-- <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span> Banner Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo SITEPATH; ?>admin/Banner/add_new_Banner_page.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <li><a href="<?php echo SITEPATH; ?>admin/Banner/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li> -->
      <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span> Category Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">

          <li><a href="<?php echo SITEPATH; ?>admin/Category/add_new_Category_page.php"><i class="fa fa-caret-right"></i> Add New Category</a></li>
          <li><a href="<?php echo SITEPATH; ?>admin/Category/index.php"><i class="fa fa-caret-right"></i> View All Category</a></li>
        </ul>
      </li>
      <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span> Customer Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo SITEPATH; ?>admin/Customer/add_new_customer.php"><i class="fa fa-caret-right"></i> Add New</a></li>
          <li><a href="<?php echo SITEPATH; ?>admin/Customer/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li>

      <!-- <li class="treeview"> <a><i class="fa  fa-rss-square nav_icon"></i> <span>Document Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo SITEPATH; ?>admin/Document/add_new_document_page.php"><i class="fa fa-caret-right"></i> Add New</a></li>
          <li><a href="<?php echo SITEPATH; ?>admin/Document/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li> -->


      <!--  <li class="treeview"> <a  ><i class="fa  fa-rss-square nav_icon"></i> <span> Contact Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo SITEPATH; ?>admin/contactus/add_new_contact_page.php"><i class="fa fa-caret-right"></i> Add New</a></li>
          <li><a href="<?php echo SITEPATH; ?>admin/contactus/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li>-->


      <!-- <li class="treeview"> <a><i class="fa  fa-rss-square nav_icon"></i> <span> Order Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo SITEPATH; ?>admin/order/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li> -->
<!-- game mangement -->
      <li class="treeview"> <a><i class="fa  fa-rss-square nav_icon"></i> <span>Game Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo SITEPATH; ?>admin/game/add-game.php"><i class="fa fa-caret-right"></i> Add New</a></li>
          <li><a href="<?php echo SITEPATH; ?>admin/game/index.php"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li>


      <li class="treeview"> <a><i class="fa  fa-rss-square nav_icon"></i> <span> Transaction Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
        <!-- <li><a href="<?php echo SITEPATH; ?>admin/transaction/add_new_transaction.php"><i class="fa fa-caret-right"></i> Add New</a></li> -->
          <li><a href="<?php echo SITEPATH; ?>admin/transaction/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li>

      <li class="treeview"> <a><i class="fa  fa-rss-square nav_icon"></i> <span>Notification management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo SITEPATH; ?>admin/notification/add-notification.php"><i class="fa fa-caret-right"></i> Add New</a></li>
          <li><a href="<?php echo SITEPATH; ?>admin/notification/index.php"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li>
      <li class="treeview"> <a><i class="fa  fa-rss-square nav_icon"></i> <span>Wallet Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <!-- <li><a href="<?php echo SITEPATH; ?>admin/notification/add-notification.php"><i class="fa fa-caret-right"></i> Add New</a></li> -->
          <li><a href="<?php echo SITEPATH; ?>admin/wallet/index.php"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li>



      <!--
       <li class="treeview"> <a  ><i class="fa fa-rss-square"></i><span> User Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>
          <li><a href="<?php echo SITEPATH; ?>admin/user/add-new-user.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/user/"><i class="fa fa-caret-right"></i>View All</a></li>
        </ul>
      </li>-->
      <!-- <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span> News Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>
          <li><a href="<?php echo SITEPATH; ?>admin/News/add_new_News_page.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/News/"><i class="fa fa-caret-right"></i> View All</a></li>
        </ul>
      </li>
      <li class="treeview"> <a> <i class="fa  fa-rss-square nav_icon"></i> <span> Fourm Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <?php

          if ($r['user_type'] == "1") { ?>
          <li><a href="<?php echo SITEPATH; ?>admin/Fourm/add_new_Fourm_page.php"><i class="fa fa-caret-right"></i>Add New</a></li>
          <?php } ?>
          <li><a href="<?php echo SITEPATH; ?>admin/Fourm/index.php"><i class="fa fa-caret-right"></i> View  All </a></li>
        </ul>
      </li>-->
      <?php  ?>
    </ul>
  </section>
</aside>

<!--close Left side column, starts page contets  -->