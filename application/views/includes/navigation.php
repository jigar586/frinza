<nav>
    <div class="container no-paddingrl">
        <div class="mm-toggle-wrap" id="sidebar-toggle">
            <div class="mm-toggle12"><i class="fa fa-align-justify"></i> </div>
        </div>
        <div class="nav-inner">
            <ul id="nav" class="hidden-xs">
                <li class="level0 parent drop-menu" id="nav-home"><a href="<?= base_url() ?>" class="level-top"><i class="fa fa-home"></i><span class="hidden">Home</span></a>
                </li>
                <?php 
                    $specOcc = $this->shop->getContentPage(4);
                    if (count($specOcc) > 0 && $specOcc[0]->page_data != 0) { 
                        $specOccID = $specOcc[0]->page_data;
                        $specOccName = @getChildName($specOcc[0]->page_data);
                ?>
                <li class="level0 parent drop-menu">
                    <a class="level-top " href="<?= base_url('').url_title(@$specOccName,'-',TRUE).'/cc'.$specOccID ?>">
                        <span><?= $specOccName ?></span>
                    </a>
                </li>
                <?php } ?>
                <?php
                    $category = $this->shop->getCategory();
                    foreach ($category as $cat) { 
                ?>
                <li class="mega-menu">
                    <a class="level-top" href="<?= base_url('').url_title($cat->category_name,'-',TRUE).'/c'.$cat->category_id ?>">
                        <span><?= $cat->category_name ?></span>
                    </a>

                    <?php $subcat = $this->shop->getSubCategory($cat->category_id); ?>

                    <div class="level0-wrapper dropdown-6col">
                        <div class="container">
                            <div class="level0-wrapper2">
                                <div class="nav-block nav-block-center">
                                    <ul class="level0">
                                        <?php
                                            foreach ($subcat as $sub) {
                                        ?>
                                        <li class="level3 nav-6-1 parent item"><a href="#"><span><?= $sub->subcategory_name ?></span></a>
                                            <ul class="level1">
                                                <?php
                                                    $hiddenCount = $this->shop->getHiddenChildCount($sub->subcategory_id);
                                                    $childcat = $this->shop->getChildCategory($sub->subcategory_id,1);
                                                    foreach ($childcat as $cc) { 
                                                ?>
                                                <li class="level2"><a
                                                        href="<?= base_url('').url_title($cat->category_name,'-',TRUE).'/'.url_title($cc->child_name,'-',TRUE).'/cc'.$cc->child_id ?>"><span><?= $cc->child_name ?></span></a>
                                                </li>
                                                <?php  }
												    if($hiddenCount){
												?>
                                                <li class="level2">
                                                    <a
                                                        href="<?= base_url(url_title($sub->subcategory_name,'-',TRUE).'/ct'.$sub->subcategory_id) ?>">View
                                                        All</a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <?php  } 
                                            if( $cat->category_id == '2' ){
                                        ?>
                                        <li id="nav-menu-item-2055" class="men-img menu-item menu-item-type-custom menu-item-object-custom imgitem" data-cols="1" style="width: 20%;">
                                            <img class="img-responsive"
                                                src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>images/menu1-img.png"
                                                style="height: 250px">
                                        </li>
                                        <li id="nav-menu-item-2055" class="men-img menu-item menu-item-type-custom menu-item-object-custom imgitem" data-cols="1" style="width: 20%;">
                                            <img class="img-responsive"
                                                src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>images/menu-img.jpg"
                                                style="height: 250px">
                                        </li>
                                        <?php
                                            }
                                            if( $cat->category_id == '3' ){
                                        ?>
                                        <li id="nav-menu-item-2055" class="men-img menu-item menu-item-type-custom menu-item-object-custom imgitem " data-cols="1" style="width: 24%;">
                                            <img class="img-responsive" src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>images/chocolate1.jpg" style="height: 250px">
                                        </li>
                                        <?php
                                            }
                                            if( $cat->category_id == '7' ){
                                        ?>
                                        <li id="nav-menu-item-2055" class="men-img menu-item menu-item-type-custom menu-item-object-custom imgitem " data-cols="1" style="width: 24%;">
                                            <img class="img-responsive" src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>images/book1.png" style="height: 250px">
                                        </li>
                                        <li id="nav-menu-item-2055" class="men-img menu-item menu-item-type-custom menu-item-object-custom imgitem" data-cols="1" style="width: 24%;">
                                            <img class="img-responsive" src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>images/book2.png" style="height: 250px">
                                        </li>
                                        <?php
                                            }
                                            if( $cat->category_id == '5' ){
                                        ?>
                                        <li id="nav-menu-item-2055" class="men-img menu-item menu-item-type-custom menu-item-object-custom imgitem" data-cols="1" style="width: 24%;">
                                            <img class="img-responsive" src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>images/gift1.jpg" style="height: 250px">
                                        </li>
                                        <li id="nav-menu-item-2055" class="men-img menu-item menu-item-type-custom menu-item-object-custom imgitem" data-cols="1" style="width: 24%;">
                                            <img class="img-responsive" src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>images/gift2.jpg" style="height: 250px">
                                        </li>
                                        <?php
                                            }
                                            if( $cat->category_id == '1' ){
                                        ?>
                                        <li id="nav-menu-item-2055" class="men-img menu-item menu-item-type-custom menu-item-object-custom imgitem" data-cols="1" style="width: 20%;">
                                            <img class="img-responsive" src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>images/cake1.png" style="height: 250px">
                                        </li>
                                        <li id="nav-menu-item-2055" class="men-img menu-item menu-item-type-custom menu-item-object-custom imgitem" data-cols="1" style="width: 20%;">
                                            <img class="img-responsive" src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>images/cake2.png" style="height: 250px">
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php  } ?>
            </ul>
        </div>
    </div>
</nav>

</div>