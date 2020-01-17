<!DOCTYPE html>

<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">
	<style type="text/css">
		body{
			min-width: 1000px;
			overflow-x: scroll;
		}
		table {
		    width: 100%;
		    display: table;
		}
		section{
		    color: #73848e;
		    width: 100%;
		    height: 100%;
		}
		h1, h2, h3, h4, h5, h6 {
		    font-family: 'Quicksand', sans-serif;
		    color: #2a2b33;
		    font-weight: 700;
		    margin-top: 0px;
		    margin-bottom: 0px;
		}
		p, a, li, span, label, input {
		    color: #636363;
		    font-size: 15px;
		    font-family: 'Poppins', sans-serif;
		    font-weight: 400;
		}
		/*.dir-pr-p3-right p, li {
		    font-size: 13px;
		    color: #343c42;
		    line-height: 24px;
		    font-weight: 600;
		}*/
		.email-tem{
			background: #efefef;
		    position: relative;
		    overflow: hidden;
		}
		.email-tem-inn {
		    width: 70%;
		    margin: 0 auto;
		    padding: 50px;
		    background: #ffffff;
		}
		.email-tem-main {
		    background: #fdfdfd;
		    box-shadow: 0px 10px 24px -10px rgba(0, 0, 0, 0.8);
		    margin-bottom: 50px;
		    border-radius: 10px;
		}
		.email-tem-head {
		    width: 100%;
		    background: #e62263 url(<?= base_url() ?>assets/emaildata/bg.png) repeat;
		    padding: 50px;
		    box-sizing: border-box;
		    border-radius: 5px 5px 0px 0px;
		}
		.email-tem-head h2 {
		    color: #fff;
		    font-size: 32px;
		    text-transform: capitalize;
		}
		.email-tem-head h2 img {
		    float: left;
		    padding-right: 25px;
		    width: 100px;
		}
		.email-tem-body {
		    padding: 50px;
		}
		.email-tem-body h3 {
		    margin-bottom: 25px;
		}
		.invoice {
		    position: relative;
		    overflow: hidden;
		    width: 100%;
		    border: 1px solid #eaedef;
		}
		.invoice-1 {
		    padding: 50px;
		}
		.invoice-2 {
		    background: #fdfae9;
		    padding: 50px;
		}
		.invoice-1-logo {
		    margin-bottom: 60px;
		}
		.invoice-1-add {
		    position: relative;
		    overflow: hidden;
		    margin-bottom: 50px;
		}
		.invoice-1-add-left {
		    float: left;
		    width: 100%;
		    margin-bottom: 40px;
		}
		.invoice-1-add-right {
		    float: left;
		    padding: 20px;
		    background: #fdfae9;
		    border-radius: 4px;
		    /* display: inline-block; */
		    width: 100%;
		}
		.invoice-1-add-right ul {
		    margin: 0;
   			padding: 0;
   			list-style: none;
		}
		.invoice-1-add-right ul li span {
		    float: left;
		    width: 50%;
		    color: #343c42;
		}
		.invoice-2 {
		    background: #fdfae9;
		    padding: 50px;
		}
		.invoice-price th,.invoice-1-tab table th {
		    text-transform: uppercase;
		    text-align: left;
		    font-size: 10px;
		}
		.email-tem-foot {
		    text-align: center;
		}
		.email-tem-foot ul {
		    position: relative;
		    overflow: hidden;
		    margin: 0 auto;
		    display: table;
		    margin-bottom: 18px;
		    margin-top: 25px;
		}
		.email-tem-foot ul li {
		    float: left;
		    display: inline-block;
		    padding: 0px 10px;
		}
		.email-tem-foot p {
		    margin-bottom: 0px;
		    padding-top: 5px;
		    font-size: 13px;
		}
		.invo-sub {
		    font-family: 'Quicksand', sans-serif;
		    font-weight: 700;
		    font-size: 18px !important;
		}
		.invoice:hover {
		    box-shadow: 0px 0px 50px 7px rgba(150, 150, 150, 0.8);
		}
		table {
		  border-collapse: collapse;
		}
		table tr{
			border-bottom: 1px solid #d0d0d0;
		}
		.invo-date {
		    font-family: 'Quicksand', sans-serif;
		    font-weight: 700;
		    font-size: 20px;
		}
		.invo-tot {
		    font-family: 'Quicksand', sans-serif;
		    font-weight: 700;
		    font-size: 20px;
		    color: #F44336;
		}
	</style>
</head>
<body>
	<section style="color: #73848e;width: 100%;height: 100%;" >
		<div class="email-tem" style="background: #efefef;position: absolute;overflow: hidden;">
			<div class="email-tem-inn" style="width: 95%;margin: 0 auto;padding: 4%;background: #ffffff;position: absolute;overflow: hidden;">
				<div class="email-tem-main" style="background: #fdfdfd;box-shadow: 0px 10px 24px -10px rgba(0, 0, 0, 0.8);margin-bottom: 3%;border-radius: 1%;" >
					<div class="email-tem-head" style="width: 100%;background: #e62263 url(<?= base_url() ?>assets/emaildata/bg.png) repeat;padding: 3% 4% 7% 4%;box-sizing: border-box;border-radius:5px 5px 0px 0px;">
						<?php 
						$order_nos = array_map(function($ar) {
						   		return '#'.$ar['detail_id'];
						   	}, $restData);
						   	$ord_id = implode(', ', $order_nos);
						?>
						<h2 style="color: #fff;font-size: 18px;text-transform: capitalize;">
							<img src="<?= base_url() ?>assets/emaildata/letter3.png" alt="" style=" float: left;padding-right: 3%;width: 100px;">Your Order <?= @$ord_id ?> has been placed at Frinza.</h2>
					</div>
					<div class="email-tem-body" style="padding: 5% 3% 5% 3%;">

						<h3 style="margin-bottom: 25px;">Order Invoice</h3>
						<div class="invoice" style=" position: relative;overflow: hidden;width: 100%;border: 1px solid #eaedef;">
							<div class="invoice-1" style="padding: 5% 3% 5% 3%;">
								<div class="invoice-1-add" style=" position: relative;overflow: hidden;margin-bottom: 5%;">
									<div class="invoice-1-add-left" style=" float: left;width: 100%;margin-bottom: 5%;">
										<h3><?= @$restData[0]['name'].' '.@$restData[0]['last_name']?></h3>
										<p><?= @$restData[0]['address_1'].'<br>'.@$restData[0]['address_2'] ?><br><?= @$restData[0]['pin_code'].', '.@$restData[0]['city'] ?></p>
										<h5 style="margin-bottom: 0px;">Bill To</h5>
										<p style="margin: 0">Email: <?= @$restData[0]['email'] ?></p>
										<?php
											if (@$restData[0]['msg_card']) {
												echo "<h5>Message On Card:</h5><p>".@$restData[0]['msg_card']."</p>";
											}
										?>
									</div>
								</div>
								<div class="invoice-1-tab">
									<table class="responsive-table bordered" style="border-collapse: collapse;width: 100%;display: table;">
										<thead>
											<tr>
												<th style="text-transform: uppercase;text-align: left;" >Tracking No</th>
												<th style="text-transform: uppercase;text-align: left;" >Product Name</th>
												<th style="text-transform: uppercase;text-align: left;" >Price</th>
												<th style="text-transform: uppercase;text-align: left;" >Qty</th>
												<th style="text-transform: uppercase;text-align: left;" >Subtotal</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$total = 0;
												for ($i=0; $i < count($restData); $i++) {
													$subTotal = @$restData[$i]['price']*$restData[$i]['qty'];
													$total += $subTotal;
											?>
											<tr style="border-bottom: 1px solid #d0d0d0;" >
												<td>#<?= @$restData[$i]['detail_id'] ?></td>
												<td><?= @$restData[$i]['product_title'] ?></td>
												<td>₹<?= @$restData[$i]['price'] ?></td>
												<td><?= @$restData[$i]['qty'] ?></td>
												<td class="invo-sub" style="font-family: 'Quicksand', sans-serif;font-weight: 700;font-size: 13px !important;">₹<?= $subTotal ?></td>
											</tr>	
											<?php } ?>										
										</tbody>
									</table>								
								</div>
							</div>
							<div class="invoice-2" style=" background: #fdfae9;padding: 5% 3% 5% 3%;">
								<div class="invoice-price">
									<table class="responsive-table bordered" style="border-collapse: collapse;width: 100%;display: table;" >
										<tbody>
											<tr style="border-bottom: 1px solid #d0d0d0;" >
												<td>Sub Total</td>
												<td class="invo-date">₹<?= @$total ?></td>									
											</tr>
											<tr style="border-bottom: 1px solid #d0d0d0;" >
												<td>Shipping Charge</td>
												<td class="invo-date">₹<?= @$restData[0]['ship_price'] ?></td>									
											</tr>
											<tr style="border-bottom: 1px solid #d0d0d0;" >
												<td>Discount</td>
												<td class="invo-date">₹<?= @$restData[0]['ship_price'] + $total - @$restData[0]['amount'] ?></td>									
											</tr>
											<tr style="border-bottom: 1px solid #d0d0d0;" >
												<td>Grand Total</td>
												<td class="invo-tot">₹<?= @$restData[0]['amount'] ?></td>									
											</tr>											
										</tbody>
									</table>								
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="email-tem-foot" style="text-align: center;">
                    <h4>Stay in touch</h4>
                    <!-- <ul style="overflow: hidden;margin: 0 auto;display: table;margin-bottom: 18px;margin-top: 25px;"> -->
                    <ul style="position: relative;overflow: hidden;margin: 0 auto;display: table;margin-bottom: 4%;margin-top: 3%;">
                        <li style="float: left;display: inline-block;padding: 0px 10px;" >
                            <a href="https://www.facebook.com/info.frinza/">
                                <img src="https://frinza.com/assets/emaildata/s1.png" alt="">
                            </a>
                        </li>
                        <li style="float: left;display: inline-block;padding: 0px 10px;" >
                            <a href="https://www.instagram.com/frinza.official">
                                <img src="https://frinza.com/assets/emaildata/s6.png" alt="">
                            </a>
                        </li>
                        <li style="float: left;display: inline-block;padding: 0px 10px;" >
                            <a href="https://in.linkedin.com/company/frinza">
                                <img src="https://frinza.com/assets/emaildata/s5.png" alt="">
                            </a>
                        </li>
                    </ul>
                    <p>Email send by Frinza</p>
                    <p>copyrights © 2018 Frinza.com.   All rights reserved.</p>
                </div>
			</div>
		</div>
	</section>
</body>
</html>