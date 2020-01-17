<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/headerlinks.php') ?>
<style type="text/css">
	ol.progtrckr {
	    margin: 0;
	    padding: 0;
	    list-style-type none;
	}

	ol.progtrckr li {
	    display: inline-block;
	    text-align: center;
	    line-height: 3.5em;
	}

	ol.progtrckr[data-progtrckr-steps="2"] li { width: 49%; }
	ol.progtrckr[data-progtrckr-steps="3"] li { width: 33%; }
	ol.progtrckr[data-progtrckr-steps="4"] li { width: 24%; }
	ol.progtrckr[data-progtrckr-steps="5"] li { width: 19%; }
	ol.progtrckr[data-progtrckr-steps="6"] li { width: 16%; }
	ol.progtrckr[data-progtrckr-steps="7"] li { width: 14%; }
	ol.progtrckr[data-progtrckr-steps="8"] li { width: 12%; }
	ol.progtrckr[data-progtrckr-steps="9"] li { width: 11%; }

	ol.progtrckr li.progtrckr-done {
	    color: black;
	    border-bottom: 4px solid yellowgreen;
	}
	ol.progtrckr li.progtrckr-todo {
	    color: silver; 
	    border-bottom: 4px solid silver;
	}

	ol.progtrckr li:after {
	    content: "\00a0\00a0";
	}
	ol.progtrckr li:before {
	    position: relative;
	    bottom: -2.5em;
	    float: left;
	    left: 50%;
	    line-height: 1em;
	}
	ol.progtrckr li.progtrckr-done:before {
	    content: "\2713";
	    color: white;
	    background-color: yellowgreen;
	    height: 2.2em;
	    width: 2.2em;
	    line-height: 2.2em;
	    border: none;
	    border-radius: 2.2em;
	}
	ol.progtrckr li.progtrckr-todo:before {
	    content: "\039F";
	    color: silver;
	    background-color: white;
	    font-size: 2.2em;
	    bottom: -1.2em;
	}
	.myBorderBox{
	    border: 1px solid #d8d8d8;
    	padding: 15px;
    	box-shadow: 0px 0px 7px 0px #dedede;
	}
</style>
<body class="shopping-cart-page">
	<div id="page"> 
		<!-- Header -->
		<?php include_once('includes/header.php') ?>  
		<!-- end header --> 
		<!-- Navigation -->
		<?php include_once('includes/navigation.php') ?>
		<!-- end nav -->
		<!-- Breadcrumbs -->
 <!-- <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Go to Home Page" href="<?= base_url() ?>">Home</a> <span>/</span> </li>
            <li class="category1601"> <strong>About Us</strong> </li>
          </ul>
        </div>
      </div>
    </div>
</div> -->
<!-- main-container -->
<div class="main-container col2-right-layout">
	<div class="main container noPadding">
		<div class="row">
			<section class="col-sm-9">
				<div class="col-main">
					<div class="page-title">
						<h1><center><?= $title ?></center></h1>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<?php if (@$display == 'track') { 
								$img = @json_decode($orderdata->product_img)[0];
								?>
							<div style="background: #d6d6d6; font-size: 18px; padding: 5px 10px; "><strong>Order No:</strong>&nbsp; <?= @$orderdata->detail_id ?></div>
							<div class="clearfix">
								<?php
								if (@$orderdata->suborder_status <= 4) { ?>
									<ol class="progtrckr col-sm-12" data-progtrckr-steps="4">
									    <li class="progtrckr-done">Placed</li>
									    <li class="<?= @$orderdata->suborder_status >= 2 ? 'progtrckr-done' : 'progtrckr-todo' ?>">Accepted</li>
									 	<li class="<?= @$orderdata->suborder_status >= 3 ? 'progtrckr-done' : 'progtrckr-todo' ?>">Shipped</li>
									 	<li class="<?= @$orderdata->suborder_status == 4 ? 'progtrckr-done' : 'progtrckr-todo' ?>">Delivered</li>
									</ol>
								<?php }else{ ?>
									<ol class="progtrckr col-sm-12 col-xs-12" data-progtrckr-steps="3">
									    <li class="progtrckr-done">Placed</li>
									    <li class="<?= @$orderdata->suborder_status >= 5 ? 'progtrckr-done' : 'progtrckr-todo' ?>">Cancelled</li>
									 	<li class="<?= @$orderdata->suborder_status >= 6 ? 'progtrckr-done' : 'progtrckr-todo' ?>">Refunded</li>
									</ol>
								<?php }
								?>
							</div>
							<br>
							<br>
							<div class="row">
								<div class="col-sm-2">
									
								</div>
								<div class="col-sm-8">
									<div class="myBorderBox">
										<div class="row">
											<div class="col-sm-3">
												<img class="img-responsive" src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.@$img ?>">
											</div>
											<div class="col-sm-9">
												<label><b><?= @$orderdata->product_title ?></b></label>
												<br>
												<label><b>Qty:</b> <?= @$orderdata->qty ?></label>
												<br>
												<label><b>price:</b> ₹<?= @$orderdata->price ?></label>
												<br>
												<label><b>Delivery Date:</b>&nbsp; <?= @date('d M,y',strtotime($orderdata->ship_from)) ?></label>
												<br>
												<label><b>Time Slot:</b>&nbsp;<?= @date('h:i A',strtotime($orderdata->ship_from)).' - '.@date('h:i A',strtotime($orderdata->ship_till)) ?></label>
											</div>
										</div>
									</div>
								</div>
									
							</div>
							<br>
							<br>
							<?php }else { ?>
							<?php
								if ($this->session->flashdata('errMsg')) { ?>
									<div class="alert alert-danger alert-dismissible">
									  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									  <?php echo $this->session->flashdata('errMsg'); ?>
									</div>
							<?php	}
							?>
							<p> Track Your Orders, just by putting your Email ID and Given Order Tracking No in fields below.</p>
							<form method="get" action="">
								<div class="row">
									<div class="col-xs-6 col-md-3">
										<label>Order No.<span class="required">*</span></label>
										<br>
										<input type="text" title="Order No." name="ordno" value="" class="input-text required-entry form-control" required>
									</div>
									<div class="col-xs-6 col-md-3">
										<label>Email Address.<span class="required">*</span></label>
										<br>
										<input type="text" title="Email Address." name="email" value="" class="input-text required-entry form-control" required>
									</div>
									<div class="col-xs-12">
										<br>
										<div class="require"><em class="required">* </em>Required Fields</div>
										<button type="submit" title="Submit" class="button submit"> <span> Submit </span> </button>
									
								</div>
							</form>
							<?php } ?>
						</div>
					</div>
				</div>
			</section>
			<aside class="col-right sidebar col-sm-3 col-xs-12">
				<div class="block block-company">
					<!-- <div class="block-title"><h3></h3></div> -->
					<div class="block-content">
						<ol id="recently-viewed-items">
							<li class="item odd"><a href="<?= base_url('aboutus') ?>">About Us</a></li>
							<li class="item even"><a href="<?= base_url('sitemap') ?>">Sitemap</a></li>
							<li class="item  odd"><a href="<?= base_url('terms') ?>">Terms and Condition</a></li>
							<li class="item even"><a href="<?= base_url('contactus') ?>">Contact Us</a></li>
							<li class="item even"><a href="<?= base_url('career') ?>">Career</a></li>
							<li class="item odd"><a href="<?= base_url('refundCancle') ?>">Refund and Cancellation Policy</a></li>
							<li class="item last"><strong><?= $title ?></strong></li>
						</ol>
					</div>
				</div>
			</aside>
		</div>
	</div>
</div>
	<!--End main-container --> 

	<!-- Brands & Feature -->  
	<?php include_once('includes/brands.php') ?>
	<!-- Footer -->
	<?php include_once('includes/footer.php') ?>
</div>
<?php include_once('includes/mobilemenu.php') ?>
<!-- End Footer -->
<!-- JavaScript --> 
<?php include_once('includes/footerlinks.php') ?>
</body>
</html>