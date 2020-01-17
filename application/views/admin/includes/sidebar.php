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
							<div class="media-body">
								<div class="media-title font-weight-semibold">Admin Panel</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /user menu -->
				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">
						<!-- Main -->
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-bag"></i> <span>Category Management</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Category Management">
								<li class="nav-item">
									<a href="<?= base_url('admin/addCategory') ?>" class="nav-link">Category</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/addSubCategory') ?>" class="nav-link">Sub Category</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/addChildCategory') ?>" class="nav-link">Child Category</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/addAddonCategory') ?>" class="nav-link">Addon Category</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/transferCategory') ?>" class="nav-link">Transfer Category</a>
								</li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-store2"></i> <span>Products</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Products">
								<li class="nav-item">
									<a href="<?= base_url('admin/addProduct') ?>" class="nav-link">Create Product</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/viewProduct') ?>" class="nav-link">View Products</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/sortProduct') ?>" class="nav-link">Sorting Products</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/homeSort') ?>" class="nav-link">Home Sorting</a>
								</li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-city"></i> <span>State & City</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="State & City">
								<li class="nav-item">
									<a href="<?= base_url('admin/availStates') ?>" class="nav-link">Manage States</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/availCities') ?>" class="nav-link">Manage Cities</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/availPincodes') ?>" class="nav-link">Manage Pincodes</a>
								</li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-percent"></i> <span>Discount</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Discount">
								<li class="nav-item">
									<a href="<?= base_url('admin/addDiscount') ?>" class="nav-link">Create Offer</a>
								</li>
								<?php if(0): ?>
									<li class="nav-item">
										<a href="<?= base_url('admin/applyDiscount') ?>" class="nav-link">Apply Offer</a>
									</li>
								<?php endif; ?>
							</ul>
						</li>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-price-tag"></i><span>Charges</span></a>
							<ul class="nav nav-group-sub" data-submenu-title='Charges'>
								<li class="nav-item">
									<a href="<?= base_url('admin/addSpecials') ?>" class="nav-link"><span>Extra</span></a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/addshippings') ?>" class="nav-link"><span>Shipping Charges</span></a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/addtimeslots') ?>" class="nav-link"><span>Time Slots</span></a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/corporateOrder') ?>" class='nav-link'><i class="icon-atom2"></i><span>Corporate Order</span></a>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-cart5"></i> <span>Orders</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Orders">
								<li class="nav-item">
									<a href="<?= base_url('admin/viewOrders') ?>" class="nav-link">New Orders</a>
								</li>
								
								<li class="nav-item">
									<a href="<?= base_url('admin/forwardedOrders') ?>" class="nav-link">Forwarded Orders</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/acceptedOrders') ?>" class="nav-link">Accepted Orders</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/shippedOrders') ?>" class="nav-link">Shipped Orders</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/deliveredOrders') ?>" class="nav-link">Delivered Orders</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/cancelledorder') ?>" class="nav-link">Cancelled Orders</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/refundWallet') ?>" class="nav-link">Refunded to wallet</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/refundBank') ?>" class="nav-link">Refunded to bank</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/pendingOrders') ?>" class="nav-link">Cart Orders</a>
								</li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-user-tie"></i> <span>Vendors</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Vendors">
								<li class="nav-item">
									<a href="<?= base_url('admin/addVendor') ?>" class="nav-link">Add Vendor</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('admin/viewVendors') ?>" class="nav-link">View Vendors</a>
								</li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-collaboration"></i> <span>CRM</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="CRM">
								<li class="nav-item">
									<a href="<?= base_url('admin/customers') ?>" class="nav-link">All Customers</a>
								</li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-reading"></i> <span>Blogs</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Blogs">
								<li class="nav-item"><a href="<?= base_url('admin/blog/category') ?>" class="nav-link">Add Blog Category</a></li>
								<li class="nav-item"><a href="<?= base_url('admin/addBlog') ?>" class="nav-link">Add Blog</a></li>
								<li class="nav-item"><a href="<?= base_url('admin/viewBlogs') ?>" class="nav-link">View Blogs</a></li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-sphere"></i> <span>Website</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Website">
								<li class="nav-item"><a href="<?= base_url('admin/extraSettings') ?>" class="nav-link">Additional Settings</a></li>
								<li class="nav-item"><a href="<?= base_url('admin/addAboutUs') ?>" class="nav-link">About Us</a></li>
								<li class="nav-item"><a href="<?= base_url('admin/addBanners') ?>" class="nav-link">Banners</a></li>
								<li class="nav-item"><a href="<?= base_url('admin/addTerms') ?>" class="nav-link">Terms & Condition</a></li>
								<li class="nav-item"><a href="<?= base_url('admin/addRefCan') ?>" class="nav-link">Refund & Cancellation</a></li>
								<li class="nav-item"><a href="<?= base_url('admin/privacyPage') ?>" class="nav-link">Privacy Policy</a></li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/tax') ?>" class="nav-link"><i class="icon-calculator2"></i> <span>Manage Tax</span></a>
						</li>																		

					</ul>
				</div>
				<!-- /main navigation -->
			</div>
			<!-- /sidebar content -->
			
		</div>
