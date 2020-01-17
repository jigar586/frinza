		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								<a href="#"><img src="<?= FOLDER_ASSETS_ADMINDATA ?>images/placeholders/placeholder.jpg" width="38" height="38" class="rounded-circle" alt=""></a>
							</div>

							<div class="media-body">
								<div class="media-title font-weight-semibold">Vendor</div>
							</div>

							<div class="ml-3 align-self-center">
								<a href="<?= base_url('vendor/changepass') ?>" class="text-white"><i class="icon-cog3"></i></a>
							</div>
						</div>
					</div>
				</div>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->
						<li class="nav-item">
							<a href="<?= base_url('vendor/dashboard') ?>" class="nav-link"><i class="icon-wallet"></i> <span>My Wallet</span></a>
						</li>
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Order Management</div> <i class="icon-menu" title="Main"></i></li>

						<li class="nav-item">
							<a href="<?= base_url('vendor/orderrequests') ?>" class="nav-link"><i class="icon-cart-add2"></i> <span>Order Requests</span></a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('vendor/myorders') ?>" class="nav-link"><i class="icon-cart5"></i> <span>Accepted Orders</span></a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('vendor/mydeliveredorders') ?>" class="nav-link"><i class="icon-basket"></i> <span>Delivered Orders</span></a>
						</li>
					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div>
