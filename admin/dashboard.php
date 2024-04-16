<?php 
include("../system_config.php");
include_once("common/head.php");
?>
<style>
.cdsdf {
	color: white;
	font-size: 70px;
}
</style>
</head><body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
<?php include_once("common/left_menu.php");?>
<div class="content-wrapper"> 
  <section class="content-header">
    <h1> Dashboard </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
  <div class="row">
    <div class="col-lg-1"> </div>
    
  
    <div class="col-lg-1"> </div>
    <div class="clearfix"></div>
    <style>
		/*--chit chart layer start here--*/
.panel {
    padding: 1em 1em;
    margin-bottom:0px;
    background: none;
    box-shadow: none;
}
.chit-chat-layer1 {
    margin:2em  0em;
}
.chit-chat-heading {
    font-size: 1.2em;
    font-weight: 700;
    color: #5F5D5D;
    text-transform: uppercase;
   font-family: 'Carrois Gothic', sans-serif;
}
.work-progres {
    box-shadow: 0px 0px 2px 1px rgba(0,0,0,0.15);
    padding: 1.34em 1em;
    background: #fff;
}
/*--geochart start here--*/
section#charts1 {
    padding: 0px;
}
.geo-chart {
    box-shadow: 0px 0px 2px 1px rgba(0,0,0,0.15);
    padding: 1em 1em;
    background: #fff;
}
.revenue {
    padding: 1em;
    background: #fff;
    box-shadow: 0px 0px 2px 1px rgba(0,0,0,0.15);
}
div#geoChart {
    width: 100% !important;
    height: 305px!important;
    border: 4px solid #fff;
}
h3#geoChartTitle {
    font-size: 1.3em;
    font-weight: 700;
    color: #5F5D5D;
    text-transform: uppercase;
    font-family: 'Carrois Gothic', sans-serif;
}

/*--climate start here--*/
.climate-grid1 {
    background: url(../images/climate.jpg)no-repeat;
    min-height:375px;
    background-size: cover;
    box-shadow: 0px 0px 2px 1px rgba(0,0,0,0.15);
}
.climate-gd1top-left h4 {
    font-size: 1.2em;
    color: #fff;
    margin-bottom: 0.5em;
        font-family: 'Carrois Gothic', sans-serif;
}
.climate-gd1top-left h3 {
    font-size: 2em;
    color:#FC8213;
    margin-bottom: 0.5em;
    font-family: 'Carrois Gothic', sans-serif;
}
.climate-gd1top-left p {
    font-size: 1em;
    color: #fff;
    line-height: 2em;
}
.climate-gd1top-right{
	font-size: 1em;
    color: #fff;
    line-height: 2em;
}
.climate-gd1-top {
    padding: 1em 1em;
    margin-bottom:1.6em;
}
.climate-gd1-bottom {
    padding: 1em 0em;
    background:rgba(252, 130, 19, 0.86);
}
.cloudy1 h4 {
    font-size: 1em;
    color: #fff;
    margin-bottom: 0.5em;
}
.cloudy1 {
    text-align: center;
}
i.fa.fa-cloud {
    color: #fff;
    font-size: 2.5em;
    margin: 0.2em 0em 0.2em 0em;
}
.cloudy1 h3 {
    font-size: 1.2em;
    color: #fff;
}
span.timein-pms {
    font-size: 0.4em;
    vertical-align: top;
    color: #fff;
}
span.clime-icon {
    display: block;
    margin-bottom: 0.3em;
}
.climate-grid2 {
    background: url(../assets/images/shoppy.jpg)no-repeat bottom;
    min-height:310px;
    background-size: cover;
    position:relative;
}
.shoppy {
    padding: 1.4em 1em;
    background: #fff;
    box-shadow: 0px 0px 2px 1px rgba(0,0,0,0.15);
}
.climate-grid2 ul {
    position: absolute;
    bottom: -10px;
    right: 0px;
    list-style: none;
}
.climate-grid2 ul li {
    display: inline-block;
    margin-right: 0.5em;
}
.climate-grid2 ul li i.fa.fa-credit-card {
    width: 35px;
    height: 30px;
    display: inline-block;
    background: #337AB7;
    font-size: 1em;
    color: #FFFFFF;
    line-height: 2em;
    text-align: center;
    border-radius: 4px;
    -webkit-border-radius: 4px;
    -moz-border-radius:4px;
    -o-border-radius:4px;
}
.climate-grid2 ul li i.fa.fa-credit-card:hover {
	 background: #ec8526;
}
.climate-grid2 ul li i.fa.fa-usd {
    width: 35px;
    height: 30px;
    display: inline-block;
    background: #337AB7;
    font-size: 1em;
    color: #fff;
    line-height: 2em;
    text-align: center;
    border-radius: 4px;
}
.climate-grid2 ul li i.fa.fa-usd:hover {
	background: #ec8526;
}
span.shoppy-rate {
    background:#FC8213;   
    margin: 1em 1em;
    width: 70px;
    height:70px;
    text-align: center;   
    border-radius: 49px;
    -webkit-border-radius: 49px;
    -moz-border-radius:49px;
    -o-border-radius:49px;
    display: inline-block;
}
span.shoppy-rate h4 {
    font-size: 1.2em;
    line-height: 3.5em;
    color: #fff;
    font-family: 'Carrois Gothic', sans-serif;
}
.shoppy h3 {
    font-size: 1.2em;
    color: #68AE00;
    font-family: 'Carrois Gothic', sans-serif;
}
.popular-brand {
    box-shadow: 0px 0px 2px 1px rgba(0,0,0,0.15);
}
.popular-bran-right {
    background:#FC8213;
    padding: 3em 1em;
}
.popular-bran-left {
    background: #fff;
    padding: 2em 1em;
}
.popular-bran-left h3 {
    font-size: 1.2em;
    color:#68AE00;
    margin-bottom: 0.2em;
    font-family: 'Carrois Gothic', sans-serif;
}
.popular-bran-left h4 {
    font-size: 0.9em;
    color:#FC8213;
}
.popular-bran-right h3 {
    font-size: 1.3em;
    color: #fff;
    text-align: center;
}
.popular-bran-right h3 {
    font-size: 1.55em;
    color: #fff;
    width: 77px;
    height: 77px;
    margin: 0 auto;
    line-height: 2.8em;
    border-radius: 62px;
    -webkit-border-radius: 62px;
    -moz-border-radius:62px;
    -o-border-radius:62px;
    border: 3px solid #fff;
    font-family: 'Carrois Gothic', sans-serif;
}
.popular-follo-left {
    background: #FDBB30;
}
.popular-follow {
    margin-top:2.35em;
    background: #fff;
    box-shadow: 0px 0px 2px 1px rgba(0,0,0,0.15);
}
.popular-follo-right {
    padding: 3em 1em;
        text-align: center;
}
.popular-follo-left {
    background:#68AE00;
    padding: 2.5em 1em;
}
.popular-follo-left p {
    font-size: 1em;
    color: #fff;
    line-height: 1.8em;
}
.popular-follo-right h4 {
    font-size: 1.5em;
    color:#FC8213;
    margin-bottom: 0.3em;
    font-family: 'Carrois Gothic', sans-serif;
}
.popular-follo-right h5 {
    font-size: 1em;
    color:#68AE00;
}
.popular-bran-left p {
    font-size: 1em;
    color: #000;
    margin-top: 1.3em;
    line-height: 1.5em;
}
.climate-gd1top-right p {
    font-size: 1em;
    color: #fff;
}
/*--climate end here--*/
#style-2::-webkit-scrollbar-thumb
{

background-color:#000;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
padding:5px;
}
.table {
    margin-bottom: 6px;
}
		</style>
    <div class="chit-chat-layer1">
      <div class="col-md-6 chit-chat-layer1-left">
        <div class="work-progres">
          <div class="chit-chat-heading">Customer List </div>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                   <th><strong>Name</strong></th>
              <th><strong>Email</strong></th>
              <th><strong>Number</strong></th>
              <th><strong>Address</strong></th>
              <th><strong>District Name</strong></th>
                </tr>
              </thead>
              <tbody>
                <?php
							$rows_list = getcustomer_byList_dah();
$i=1;
foreach ($rows_list as $rows) { 



?>
                <tr>
                  <td><?php echo $i;?></td>
                 <td><b><?php echo $rows['first_name']; ?></b></td>
              <td><?php echo $rows['user_email']; ?></td>
              <td><?php echo $rows['user_phone']; ?></td>
              <td><?php echo $rows['user_address'] ?></td>
              <td><?php echo $rows['user_district']; ?></td>
                </tr>
                <?php $i++;
	}?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    
      <div class="col-md-6">
        <div class="work-progres">
          <div class="chit-chat-heading">Order List </div>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                   <th>Email</th>
                  <th>Number</th>
                  <th>District Name</th>
                  <th>State</th>
                </tr>
              </thead>
              <tbody>
                <?php
				$i="1";
							 $rows_list = getuser_byList_bydash();
	foreach ($rows_list as $rows) {
	$ress = getdistrict_byID($rows['user_district']);
	$res = getState_byID($rows['user_state']);
							  ?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><b><?php echo $rows['first_name']; ?></b></td>
                   <td><b><?php echo $rows['user_email']; ?></b></td>
                  <td><?php echo $rows['user_phone']; ?></td>
                  <td><?php echo $ress['district_name']; ?></td>
                  <td><?php echo $res['stateName']; ?></td>
                </tr>
                <?php $i++;
	}?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      </section>
    </div>
  </div>
  <footer class="main-footer">
    <?php include_once("common/copyright.php");?>
  </footer>
</div>
<?php include_once("common/footer.php");?>
</body>
</html>