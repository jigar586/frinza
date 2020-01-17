  <!-- Header -->
  <div id="mobHeadWrap">
    <header>
        <div class="header-container">
            <div class="header-top">
                <div class="container hide-container">
                    <div class="row">
                        <!-- Header Language -->
                        <div class="col-xs-12 col-sm-6">
                            <div class="toplinks">
                                <div class="links" style="text-align: left;">
                                    <div class="demo">
                                        <a title="Corporate" href="<?= base_url('corporate') ?>">
                                            <span class="hidden-xs">Corporate</span>
                                        </a>
                                    </div>
                                    <div class="demo">
                                        <a title="Franchise" href="<?= base_url('franchise') ?>">
                                            <span class="hidden-xs">Franchise</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 hidden-xs">
                            <div class="toplinks">
                                <div class="links">
                                    <div class="demo">
                                        <a title="Wishlist" href="<?= base_url('gift') ?>">
                                            <span class="hidden-xs">Gift</span>
                                        </a>
                                    </div>
                                    <?php if (isset($_SESSION['loggedUser'])) { ?>
                                    <div class="myaccount">
                                        <a title="My Account" href="<?= base_url('dashboard') ?>">
                                            <span class="hidden-xs">My Account</span>
                                        </a>
                                    </div>
                                    <div class="demo">
                                        <a title="Wishlist" href="<?= base_url('wishlist') ?>">
                                            <span class="hidden-xs">Wishlist</span>
                                        </a>
                                    </div>
                                    <?php } ?>
                                    <div class="demo">
                                        <a title="Wishlist" href="<?= base_url('trackorder') ?>">
                                            <span class="hidden-xs">Track Order</span>
                                        </a>
                                    </div>
                                    
                                    <?php if (!isset($_SESSION['loggedUser'])) { ?>
                                    <div class="login"><a href="<?= base_url('login') ?>"><span class="hidden-xs">Log In</span></a> </div>
                                    <div class="login"><a href="<?= base_url('register') ?>"><span class="hidden-xs">Register</span></a> </div>
                                    <?php }else{ ?> Out</span></a> </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 hidden-xs top-15margin">
                            <div class="search-box">
                                <form action="<?= base_url('search') ?>" method="get" id="search_mini_form" name="Categories">
                                    <input type="text" placeholder="Search entire store here..." minlength='3' maxlength="70" name="term" id="search" required>
                                    <button type="submit" class="search-btn-bg"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12 logo-block">
                            <div class="logo"> <a title="Frinza" href="<?= base_url() ?>"><img alt="Frinza" src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>images/Frinza-logo-header.png"> </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 top-15margin">
                            <div class="top-cart-contain pull-right">
                                <div class="mini-cart">
                                    <div onclick='toggleCart()' class="basket dropdown-toggle"> <a href="javascript:void(0)"> <span class="cart_count"><?= getCartCount() ?></span><span class="price">My Cart / ₹<?= getCartValue() ?></span> </a> </div>
                                    <div>
                                        <div class="top-cart-content" style="display: none;">
                                            <?php if (getCartCount() != 0) { ?>
                                            <ul class="mini-products-list" id="cart-sidebar">
                                                <?php 
                                                    $cart = getCartData();
                                                    foreach ($cart as $r) {
                                                    ?>
                                                        <li class="item">
                                                            <div class="item-inner"> 
                                                                <a class="product-image" title="<?= $r['product_title'] ?>" href="#l">
                                                                    <img alt="<?= $r['product_title'] ?>" src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$r['product_img'] ?>">
                                                                </a>
                                                                <div class="product-details">
                                                                    <div class="access"><a class="btn-remove1" title="Remove This Item" href="javascript:void(0)" onclick="removeFromCart(<?= $r['product_id'] ?>,0)">Remove</a>
                                                                        <a class="btn-edit" title="Edit item" href="#"><i class="icon-pencil"></i><span class="hidden">Edit item</span></a> 
                                                                    </div>
                                                                    <strong><?= $r['qty'] ?></strong> x <span class="price">₹<?= $r['price'] ?></span>
                                                                    <p class="product-name">
                                                                        <a href="<?= base_url('').url_title($r['product_title'],'-',TRUE).'/p'.$r['product_id'] ?>"><?= $r['product_title'] ?></a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                <?php } ?>
                                            </ul>

                                            <div class="actions">
                                                <center><a href="<?= base_url('mycart') ?>" title="View cart" class="view-cart"><span>View Cart</span></a></center>
                                            </div>
                                            <?php }else{ ?><div>
                                                <p class="a-center noitem">&nbsp;Your Shopping Cart is empty.&nbsp;
                                                    <center><a href="<?= base_url('wishlist') ?>" class="view-cart"><span>Add item from wishlist</span></a>
                                                    </center>
                                                </p>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="ajaxconfig_info"> <a href="#/"></a>
                                    <input value="" type="hidden">
                                    <input id="enable_module" value="1" type="hidden">
                                    <input class="effect_to_cart" value="1" type="hidden">
                                    <input class="title_shopping_cart" value="Go to shopping cart" type="hidden">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </header>