<style type="text/css">
	li.loginReg {
		width: 50%;
		border-right: 1px solid #ddd;
	}
</style>
<div id="mobile-menu" class="swipe-area">
	<ul>
		<?php if (!isset($_SESSION['loggedUser'])) { ?>
			<li class="last loginReg"><a title="Login" href="<?= base_url('login') ?>"><i class="fa fa-sign-in" style="font-size:18px; "></i>&nbsp;&nbsp;Login</a> </li>
			<li class="loginReg"><a title="Register" href="<?= base_url('register') ?>"><i class="fa fa-user-plus" style="font-size:18px; "></i>&nbsp;&nbsp;Register</a> </li>
			<?php } ?>
			<li>
				<div class="noPadding noMargin">
					<form action="<?= base_url('search') ?>" method="POST"  name="Categories" id="search1" >
						<div class="input-group">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i> </button>
							</div>
							<input type="text" class="form-control simple" placeholder="Search ..." name="search" id="srch-term">
						</div>
					</form>
				</div>
			</li>
			<li><a href="<?= base_url() ?>">Home</a>
			</li>
			<?php
			$category = $this->shop->getCategory();
			foreach ($category as $cat) {
				$tempCatURL = base_url('').url_title($cat->category_name,'-',TRUE).'/c'.$cat->category_id;
				?>
				<li><a href="<?= $tempCatURL ?>"><?= $cat->category_name ?></a>
					<ul>
						<?php
						$subcat = $this->shop->getSubCategory($cat->category_id);
						foreach ($subcat as $sc) { ?>
							<li>
								<a href="#" class=""><?= $sc->subcategory_name ?></a>
								<ul>
									<?php
									$childcat1 = $this->shop->getChildCategory($sc->subcategory_id);
									foreach ($childcat1 as $cc) {
										$tempSubURL = base_url('').url_title($cat->category_name,'-',TRUE).'/'.url_title($cc->child_name,'-',TRUE).'/cc'.$cc->child_id;
										?>
										<li><a href="<?= $tempSubURL ?>"><?= $cc->child_name ?></a> </li>
										<?php }
										?>
									</ul>
								</li>
								<?php  }
								?>
							</ul>
						</li>
						<?php } ?>
						<li><a title="Blog" href="<?= base_url('blog') ?>">Blog</a> </li>
						<li><a href="<?= base_url('aboutus') ?>">About Us</a></li>
						<li><a href="<?= base_url('contactus') ?>">Contact Us</a></li>
						<li><a href="<?= base_url('career') ?>">Career</a></li>
						<li><a href="<?= base_url('corporate') ?>">Corporate</a></li>
						<li><a href="<?= base_url('franchise') ?>">Franchise</a></li>
						<li><a href="<?= base_url('terms') ?>">Terms And Conditions</a></li>
						<li><a href="<?= base_url('refundCancle') ?>">Refund and Cancellation Policy</a></li>
						<li><a href="<?= base_url('privacypolicy ') ?>">Privacy Policy</a></li>
					</ul>
					<div class="top-links">
						<ul class="links">
							<?php if (isset($_SESSION['loggedUser'])) { ?>
								<li><a title="My Account" href="<?= base_url('dashboard') ?>">My Account</a> </li>
								<li><a title="Wishlist" href="<?= base_url('wishlist') ?>">Wishlist</a> </li>
								<li><a title="Checkout" href="<?= base_url('order') ?>">Orders</a> </li>
								<li><a title="Checkout" href="<?= base_url('trackorder') ?>">Track Order</a> </li>
								<li><a title="Logout" href="<?= base_url('logout') ?>">Logout</a> </li>
								<?php }else{ ?>
									<li><a title="Checkout" href="<?= base_url('trackorder') ?>">Track Order</a> </li>
									<?php } ?>
									<li><b><i class="fa fa-phone" style="font-size: 14px; padding-top: 2px;"></i> </b> &nbsp; +91 98718 16726 (10 AM - 6 PM)</li>
									<li style="text-transform: lowercase;"><b><i class="fa fa-envelope" style="font-size: 14px; padding-top: 2px;"></i> </b> &nbsp; support@frinza.com</li>
								</ul>
							</div>
						</div>
						