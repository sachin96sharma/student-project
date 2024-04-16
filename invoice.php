<?php
include("system_config.php");
$name="Add New Order";

if(isset($part_url['2']))
{
  $name="Update Order";
  $id = urlencode(decryptIt($part_url['2']));  
  $row = getorders_byID_new_admin($id);
   $res = getcustomer_byID($row['customer_id']);

}
include('common/head.php');

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

/* Page margins are defined using CSS */
   
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		></script>
<div class="container" id="GFG" style="width:100%">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title" style="">
    			<h2 style="display: inline-block;margin-bottom: 5px;
    margin-top: 5px;"><img src="https://www.studentdatabasekart.in/web/images/logo.png"  style="width: 120px;"/></h2><h3 class="pull-right" style="float: right!important;">Order # <?php echo $row['order_id']; ?></h3>
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
    <div style="clear: both; display: table;"> &nbsp;</div>
    <div class="row" style="width:100%">
    			<div class="col-xs-6" style="width:50%;float: left;">
    				<address>
    					<strong>Payment Method:</strong><br>
    					<?php
						$config['paymentyype'] = array("0" => "Cash On Delivery", "1" => "Online Payment");
						 echo $config['paymentyype'][$row['paymentyype']]; ?>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right" style="width:50%;float: right;text-align: right;">
    				<address>
    					<strong>Order Date:</strong><br>
    					<?php echo $row['orderdate']; ?><br><br>
    				</address>
    			</div>
    		</div>
             <div style="clear: both; display: table;"> &nbsp;</div>
    <div class="row" >
    	<div class="col-md-12">
    		<div class="panel panel-default" style="margin-bottom: 20px;border: 1px solid #ddd;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
    box-shadow: 0 1px 1px rgba(0,0,0,.05);">
    			<div class="panel-heading" style="background-color: #f5f5f5;
    padding: 1px 10px;
    border-bottom: 1px solid #ddd;
    border-top-left-radius: 3px;">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body" style="    padding: 15px;">
    				<div class="table-responsive">
    					<table class="table table-condensed" style="width: 100%;">
    						<thead>
                                <tr>
        							<td colspan="2" style="padding: 5px;line-height: 1.428571429;"><strong>Product</strong></td>
        							<td class="text-center" style="padding: 5px;line-height: 1.428571429;"><strong>Quantity</strong></td>
        							<td class="text-right" style="padding: 5px;line-height: 1.428571429;"><strong>Price</strong></td>
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
    								 <td colspan="2" style="padding: 5px;line-height: 1.428571429;border-top: 1px solid #ddd;"><?php echo $rows['name']; ?></td>
    								<td class="text-center" style="padding: 5px;line-height: 1.428571429;border-top: 1px solid #ddd;"><?php echo $rows['quantity']; ?></td>
    								<td class="text-right" style="padding: 5px;line-height: 1.428571429;border-top: 1px solid #ddd;"><?php echo  number_format(round($pric,2),2); ?></td>
    							</tr>
                              
						  <?php 
$i++;
} ?>	  
							  
    							<tr>
    								<td class="thick-line" style="padding: 5px;line-height: 1.428571429;border-top: 1px solid #ddd;"></td>
    								<td class="thick-line" style="padding: 5px;line-height: 1.428571429;border-top: 1px solid #ddd;"></td>
    								<td class="thick-line text-right" style="padding: 5px;line-height: 1.428571429;border-top: 1px solid #ddd;"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right" style="padding: 5px;line-height: 1.428571429;border-top: 1px solid #ddd;"><?php echo number_format(round($total_price,2),2); ?></td>
    							</tr>
    							<tr>
    								<td class="no-line" style="padding: 5px;line-height: 1.428571429;"></td>
    								<td class="no-line" style="padding: 5px;line-height: 1.428571429;"></td>
    								
									
									<?php
									if($res['user_state']=='29')
									{?>
                                    <td class="no-line text-right" style="padding: 5px;line-height: 1.428571429;border-top: 1px solid #ddd;"><strong>CGST</strong></td>  
										 <td class="no-line text-right" style="padding: 5px;line-height: 1.428571429;border-top: 1px solid #ddd;"><?php echo number_format(round($total_price*9/100,2),2); ?></td>
                                         </tr>
                                         <tr>
                                         <td class="no-line" style="padding: 5px;line-height: 1.428571429;"></td>
    								<td class="no-line" style="padding: 5px;line-height: 1.428571429;"></td>
                                         <td class="no-line text-right" style="padding: 5px;line-height: 1.428571429;border-top: 1px solid #ddd;"><strong>SGST</strong></td>  
                                          <td class="no-line text-right" style="padding: 5px;line-height: 1.428571429;border-top: 1px solid #ddd;"><?php echo number_format(round($total_price*9/100,2),2); ?></td>	
									<?php }
									else
									{
										$gst = $total_price*18/100;
											?>
                                            <td class="no-line text-right" style="padding: 5px;line-height: 1.428571429border-top: 1px solid #ddd;;"><strong>GST</strong></td>  
                                            <td class="no-line text-right" style="padding: 5px;line-height: 1.428571429;border-top: 1px solid #ddd;"><?php echo number_format(round($gst,2),2); ?></td>
									<?php }
									 ?>
    								
    							</tr>
    							<tr>
    								<td class="no-line" style="padding: 5px;line-height: 1.428571429;"></td>
    								<td class="no-line" style="padding: 5px;line-height: 1.428571429;"></td>
    								<td class="no-line text-right" style="padding: 5px;line-height: 1.428571429;border-top: 1px solid #ddd;"><strong>Total</strong></td>  <?php $tp = $gst+$total_price; ?>
    								<td class="no-line text-right" style="padding: 5px;line-height: 1.428571429;border-top: 1px solid #ddd;"><?php echo number_format(round($tp,2)); ?>.00</td>
    							</tr>
    						</tbody>
    					</table>
                       
    				</div>
                    
    			</div>
    		</div>  
           <script>
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
    </script>
  
    	</div>
    </div>
</div> 
<div align="center">
<input type="button" value="Print" onclick="printDiv()" style="text-align:center"> 	<button id="download-button">Download as PDF</button>
<br />
</div>
      <br />   
  
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