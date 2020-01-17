<!DOCTYPE html>

<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		body{
			min-width: 1000px;
			overflow-x: scroll;
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
		.email-tem{
			background: #efefef;
		    position: relative;
		    overflow: hidden;
		}
		.email-tem-inn {
		    width: 50%;
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
		    background: #e62263 url(<?=base_url()?>assets/emaildata/bg.png) repeat;
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
		.email-tem-body a {
		    background: #e62263;
		    color: #fff;
		    padding: 12px;
		    border-radius: 2px;
		    margin-top: 15px;
		    position: relative;
		    display: inline-block;
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
	</style>
</head>
<body>	
	<section style="color: #73848e;width: 100%;height: 100%;">
		<div class="email-tem" style="background: #efefef;position: relative;overflow: hidden;">
			<div class="email-tem-inn" style="width: 95%;margin: 0 auto;padding: 4%;background: #ffffff;">
				<div class="email-tem-main"  style="background: #fdfdfd;box-shadow: 0px 10px 24px -10px rgba(0, 0, 0, 0.8);margin-bottom: 3%;border-radius: 1%;" >
					<div class="email-tem-head" style="width: 100%;background: #e62263 url(<?= base_url() ?>assets/emaildata/bg.png) repeat;padding: 3% 4% 7% 4%;box-sizing: border-box;border-radius:5px 5px 0px 0px;" >
						<h2 style="color: #fff;font-size: 18px;text-transform: capitalize;" >
							<img src="<?=base_url()?>assets/emaildata/letter3.png" alt="" style=" float: left;padding-right: 3%;width: 100px;"> Frinza Payment Confirmation!</h2>
					</div>
					<div class="email-tem-body" style="padding: 5% 3% 5% 3%;color: #636363;font-size: 15px;font-family: 'Poppins', sans-serif;font-weight: 400;">
						<h3>Dear <?= @$restData[0]['name'].' '.@$restData[0]['last_name'] ?>,</h3>
						<p>Thank you for shopping at Frinza. This is a confirmation for the payment made by you. We recommend you keep this email for your records.</p>
						<p><b>Order number:</b> #<?= @$restData[0]['order_id'] ?>
							<br>
							<b>Order date:</b> <?= @date('d M Y', strtotime($restData[0]['created_at'])) ?></p>
						<p>To access the order details on our website, kindly sign in and select 'My Account' to view the details.</p>
						<p>Sincerely,<br>
						Team Frinza</p>
						<a href="<?=base_url('login')?>" style="background: #e62263;color: #fff;padding: 12px;border-radius: 2px;margin-top: 15px;position: relative;display: inline-block;">Login Now</a>
					</div>
				</div>
				<div class="email-tem-foot" style="text-align: center;">
					<h4>Stay in touch</h4>
					<!-- <ul style="overflow: hidden;margin: 0 auto;display: table;margin-bottom: 18px;margin-top: 25px;"> -->
					<ul style="position: relative;overflow: hidden;margin: 0 auto;display: table;margin-bottom: 4%;margin-top: 3%;">
						<li style="float: left;display: inline-block;padding: 0px 10px;" >
							<a href="https://www.facebook.com/info.frinza/">
								<img src="<?= base_url() ?>assets/emaildata/s1.png" alt="">
							</a>
						</li>
						<li style="float: left;display: inline-block;padding: 0px 10px;" >
							<a href="https://www.instagram.com/frinza.official">
								<img src="<?= base_url() ?>assets/emaildata/s6.png" alt="">
							</a>
						</li>
						<li style="float: left;display: inline-block;padding: 0px 10px;" >
							<a href="https://in.linkedin.com/company/frinza">
								<img src="<?= base_url() ?>assets/emaildata/s5.png" alt="">
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