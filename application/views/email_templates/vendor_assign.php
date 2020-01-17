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
		p, a, li, span, label, tr, td, th, input {
		    color: #636363;
		    font-size: 15px;
		    font-family: 'Poppins', sans-serif;
		    font-weight: 400;
		}
		.dir-pr-p3-right p, li {
		    font-size: 13px;
		    color: #343c42;
		    line-height: 24px;
		    font-weight: 600;
		}
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
		table:not(.no-border) tr{
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
	<section>
		<div class="email-tem">
			<div class="email-tem-inn">
				<div class="email-tem-main">
					<div class="email-tem-head">
						<h2><img src="<?= base_url() ?>assets/emaildata/letter3.png" alt="">New Order #<?= @$restData['detail_id'] ?> Assigned to You at Frinza!</h2>
					</div>
					<div class="email-tem-body">

						<h3>Order Details</h3>
						<div class="invoice">
							<div class="invoice-1">
								<div class="invoice-1-add">
									<div class="invoice-1-add-right">
										<table class="no-border">
											<tr>
												<td><b>Recipient Name</b></td>
												<td> <?= @$restData['name'].' '.@$restData['last_name'] ?></td>
											</tr>
											<tr>
												<td><b>Recipient Contanct</b></td>
												<td> <?= @$restData['contact'] ?></td>
											</tr>
											<tr>
												<td><b>Delivery City</b></td>
												<td><?= @$restData['city'].'-'.$restData['pin_code'] ?></td>
											</tr>
											<tr>
												<td><b>Recipient Address</b></td>
												<td><?= @$restData['address_1'].' '.$restData['address_2'] ?></td>
											</tr>
											<tr>
												<td><b>Message On Card</b></td>
												<td> <?=  @$restData['msg_card'] ?></td>
											</tr>
											<tr>
												<td><b>Comment</b></td>
												<td><?= @$restData['vendor_msg'] ?></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="invoice-1-tab">
									<table class="responsive-table bordered">
										<tbody>
											<tr>
												<th><b>Tracking No</b></th>
												<td>#<?= @$restData['detail_id'] ?></td>
											</tr>
											<tr>
												<th><b>Product Name</b></th>
												<td><?= @$restData['product_title'] ?>
													<br>
													<img src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT ?><?= json_decode($restData['product_img'])[0] ?>" width="250">
												</td>
											</tr>
											<tr>
												<th><b>Product Description</b></th>
												<td><?= nl2br(@$restData['product_desc']) ?></td>
											</tr>
											<tr>
												<th><b>Additional</b></th>
												<td><?= @getExtraTitle(@$restData['extra'],'- ','<br>') ?></td>
											</tr>
											<tr>
												<th><b>Delivery Time</b></th>
												<td><?= date('d M, Y h:i a',strtotime(@$restData['ship_from'])).' - '.date('h:i a',strtotime(@$restData['ship_till'])) ?></td>
											</tr>
											<tr>
												<th><b>Qty</b></th>
												<td><?= @$restData['qty'] ?></td>
											</tr>
											<tr>
												<th><b>Total</b></th>
												<td class="invo-sub">₹<?= @$restData['vendor_price'] ?></td>
											</tr>										
										</tbody>
									</table>								
								</div>
							</div>
							
						</div>
						<a href="<?=base_url('vendor')?>" style="background: #e62263;color: #fff;padding: 12px;border-radius: 2px;margin-top: 15px;position: relative;display: inline-block;">Vendor Panel</a>
					</div>
				</div>
				<div class="email-tem-foot">
					<h4>Stay in touch</h4>
					<ul>
						<li><a href="https://www.facebook.com/info.frinza/"><img src="<?= base_url() ?>assets/emaildata/s1.png" alt=""></a></li>
						<li><a href="https://www.instagram.com/frinza.official"><img src="<?= base_url() ?>assets/emaildata/s6.png" alt=""></a></li>
						<li><a href="https://in.linkedin.com/company/frinza"><img src="<?= base_url() ?>assets/emaildata/s5.png" alt=""></a></li>
					</ul>
					<p>Email send by Frinza</p>
					<p>copyrights © 2018 Frinza.com.   All rights reserved.</p>
				</div>
			</div>
		</div>
	</section>
</body>
</html>