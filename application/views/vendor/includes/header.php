	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand" style="padding:0;">
			<a href="<?= base_url('admin') ?>" class="d-inline-block">
				<img src="<?= FOLDER_ASSETS_ADMINDATA ?>/images/logo.png" style='height: 40px;width:150px;margin-top: 4px;' alt="">
			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>

			<span class="navbar-text ml-md-3 mr-md-auto">
				<span class="badge bg-success">Online</span>
			</span>

			<ul class="navbar-nav">
				
				<li class="nav-item">
					<a href="#" class="navbar-nav-link"><i class="icon-coins"></i><span class=""> ₹ <?= $myBalance ?></span></a>
				</li>
				<li class="nav-item">
						<a href="<?= base_url('vendor/logout') ?>" class="navbar-nav-link"><i class="icon-switch2"></i> Logout</a>
				</li>
			</ul>
		</div>
	</div>