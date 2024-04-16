<?php
include("../../system_config.php");
$name="Add New Order";
if(isset($_GET['id']))
{
  $name="Update Order";
  $id = urlencode(decryptIt($_GET['id']));  
  $row = getorders_byID_new_admin($id);
   $res = getcustomer_byID($row['customer_id']);

}
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
@media print {
/*  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }*/
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		></script>
<div class="container" id="GFG" style="width:100%">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2 style="display: inline-block;"><img src="https://www.studentdatabasekart.in/web/images/logo.png"  style="width: 120px;"/></h2><h3 class="pull-right" style="float: right!important;">Order # <?php echo $id; ?></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6" style="width:50%;float: left;">
    				<address>
    				<strong>Billed To:</strong><br>
    				<?php echo $res['first_name']; ?><br>
    					<?php echo $res['user_address']; ?><br>
    					<?php
	$resb = getState_byID($res['user_state']);
	
	
					
						 echo $res['user_district']; ?>&nbsp;<?php
						
						 echo $resb['stateName']; ?>&nbsp;
    					<?php echo $res['user_pincode']; ?><br>
						<?php echo $res['user_phone']; ?><br>
                        <?php echo $res['user_email']; ?><br>
                        <?php echo $res['o_name']; ?><br><?php echo $res['gst']; ?>
    				</address>
    			</div>
    			
				<div class="col-xs-6 text-right" style="text-align:right; width:50%;float: left;">
    				<address>
        			<strong>Student Database Kart</strong><br>
    					Bengaluru, Karnataka 560078<br>
India<br>
    					databasekartindia@gmail.com<br>
    					Phone: +919535056409<br>
Company ID: GSTIN :<br>
29BHNPC6903M1ZW

    				</address>
    			</div>
    		</div>
    		
    	</div>
    </div>
    <div class="row">
    			<div class="col-xs-6" style="width:50%;">
    				<address>
    					<strong>Payment Method:</strong><br>
    					<?php
						$config['paymentyype'] = array("0" => "Cash On Delivery", "1" => "Online Payment");
						 echo $config['paymentyype'][$row['paymentyype']]; ?>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right" style="width:50%;float: right;">
    				<address>
    					<strong>Order Date:</strong><br>
    					<?php echo $row['orderdate']; ?><br><br>
    				</address>
    			</div>
    		</div>
    <div class="row" >
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td colspan="2"><strong>Product</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Price</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							 <?php 
								 $price="0";
	$quantity="0";
	$rows_list = getorders_byID_product_index($id);
	
								// $rows_list = getorders_byID_product_index($id) ;
$i=1;
foreach ($rows_list as $rows) {

$pric = $rows['price'] * $rows['quantity'];
	$total_price += ($pric);
				
		 ?>
								
								<tr>
    								 <td colspan="2"><?php echo $rows['name']; ?></td>
    								<td class="text-center"><?php echo $rows['quantity']; ?></td>
    								<td class="text-right"><?php echo  number_format(round($pric,2),2); ?></td>
    							</tr>
                              
						  <?php 
$i++;
} ?>	  
							  
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-right"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right"><?php echo number_format(round($total_price,2),2); ?></td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-right"><strong>GST</strong></td>  <?php $gst = $total_price*18/100;?>
    								<td class="no-line text-right"><?php echo number_format(round($gst,2),2); ?></td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-right"><strong>Total</strong></td>  <?php $tp = $gst+$total_price; ?>
    								<td class="no-line text-right"><?php echo number_format(round($tp,2)); ?>.00</td>
    							</tr>
    						</tbody>
    					</table>
                       
    				</div>
                    
    			</div>
    		</div>  
          <!-- <script>
        function printDiv() {
            var divContents = document.getElementById("GFG").innerHTML;
            var a = window.open('', '', '');
            a.document.write('<html>');
            a.document.write('<body >');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script><input type="button" value="Print" onclick="printDiv()" style="text-align:center">-->
    	</div>
    </div>
</div>
<button id="download-button">Download as PDF</button>
  
   <script>
			const button = document.getElementById('download-button');

			function generatePDF() {
				// Choose the element that your content will be rendered to.
				const element = document.getElementById('GFG');
				// Choose the element and save the PDF for your user.
				html2pdf().from(element).save();
			}

			button.addEventListener('click', generatePDF);
		</script>