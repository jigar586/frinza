<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Registration Mail</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=1024">
	<style type="text/css">
		body{
			/*min-width: 1000px;*/
			overflow-x: scroll;
			background: #efefef;
		}
		body, table, p, a, li, span, label, td, th, input{
			-webkit-text-size-adjust:100%;
			-ms-text-size-adjust:100%;
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
		    display: flex;
		}
		.email-tem-inn {
		    /*width: 70%;*/
		    margin: 0 auto;
		    padding: 15px;
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
<body style="">	
<!-- <table align="center" width="700" border="0" cellspacing="0" cellpadding="0" class="em_main_table" style="width:700px;">
	<tr>
		<td> -->
			<div class="email-tem">
				<div class="email-tem-inn">
					<div class="email-tem-main">
						<div class="email-tem-head">
							<h2><img src="<?=base_url()?>assets/emaildata/letter3.png" alt=""> Welcome to Frinza!</h2>
						</div>
						<div class="email-tem-body">

							<h3>Congratulations, <?= @$username ?>!</h3>
							<p>Sincerely,</p><p><b>Team Frinza</b></p><p>For any queries related to your order, get in touch with us here or on +91-9871816726, between 8:00 A.M. and 10:00 P.M. IST on all 7 days a week.</p>
							<a href="<?=base_url('login')?>">Login Now</a>
						</div>
					</div>
					<div class="email-tem-foot">
						<h4>Stay in touch</h4>
						<ul>
							<li><a href="https://www.facebook.com/info.frinza/"><img src="<?=base_url()?>assets/emaildata/s1.png" alt=""></a></li>
							<li><a href="https://www.instagram.com/frinza_india/"><img src="<?=base_url()?>assets/emaildata/s6.png" alt=""></a></li>
							<li><a href="https://in.linkedin.com/company/frinza"><img src="<?=base_url()?>assets/emaildata/s5.png" alt=""></a></li>
						</ul>
						<p>Email send by Frinza</p>
						<p>copyrights © 2018 Frinza.com.   All rights reserved.</p>
					</div>
				</div>
			</div>
		<!-- </td>
	</tr>
</table> -->
</body>
</html>