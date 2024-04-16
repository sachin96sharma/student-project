<?php
 include("system_config.php"); 
 include('common/head.php');
?>
</head>
<body>
<?php include('common/header.php'); ?>


<section id="sliderSec">
  <div class="owl-carousel owl-theme owl-loaded sliderOwl">
    <div class="owl-stage-outer">
      <div class="owl-stage">
        <?php 
	$rows_list = getbanner_list_status();
	$i="current";	
	$j="1";
	foreach($rows_list as $rows) {	 ?>
        <div class="owl-item">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-5 col-md-12 col-sm-12">
                <div class="sliderImg"> <img src="<?php echo SITEPATH;?>/upload/thumb/<?php echo $rows['banner_img']; ?>" alt="Web Development"/> </div>
              </div>
              <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="sliderCnt" data-aos="fade-down" data-aos-easing="linear"
data-aos-duration="1500">
                  <h3 class="h3-carousel-item"><img style="height: 30px; margin-right: 20px;" src="<?php echo SITEPATH; ?>web/images/icon.png"><?php echo $rows['banner_name']; ?></h3>
                  <h3 class="h3-carousel-item"><img style="height: 30px; margin-right: 20px;" src="<?php echo SITEPATH; ?>web/images/icon.png"><?php echo $rows['banner_name2']; ?></h3>
                  <h3 class="h3-carousel-item"><img style="height: 30px; margin-right: 20px;" src="<?php echo SITEPATH; ?>web/images/icon.png"><?php echo $rows['banner_name3']; ?></h3>
                  <h3 class="h3-carousel-item"><img style="height: 30px; margin-right: 20px;" src="<?php echo SITEPATH; ?>web/images/icon.png"><?php echo $rows['banner_name4']; ?></h3>
                  <h3 class="h3-carousel-item"><img style="height: 30px; margin-right: 20px;" src="<?php echo SITEPATH; ?>web/images/icon.png"><?php echo $rows['banner_name5']; ?></h3>
                </div>
              </div>
              <!--  --> 
              
              <!--  --> 
            </div>
          </div>
        </div>
<?php 
	  $j++;
	  $i="";
	  } ?>
      </div>
    </div>
  </div>
</section>
    <?php include('common/footer.php');?>
</body>
</html>
</body>
</html>
