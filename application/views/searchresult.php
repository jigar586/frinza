<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/headerlinks.php') ?>
<style type="text/css">
  .pageData {
    display: none !important;
  }
  .page-active {
    display: block !important;
  }
  .pageLi {
    display: none;
  }
  #perPagePost{
    margin: 0;
    background: #f8f8f8;
    padding: 6px;
  }
</style>
<body class="category-page">
<div id="page"> 
  <!-- Header -->
  <?php include_once('includes/header.php') ?>
  <!-- end header --> 
  
  <!-- Navigation -->
  
  <?php include_once('includes/navigation.php') ?>
  
  <!-- Main Container -->
  <section class="main-container col2-left-layout bounceInUp animated">
    <div class="container">
      <div class="row">

        <div class="col-sm-9 col-sm-push-3 noPadding">
          <?php include_once('includes/slider.php') ?>
          <article class="col-main">
            <h2 class="page-heading"> <label class="page-heading-title" style="max-width: 70vw; font-weight: 800"><?= $catName ?></label> </h2>
            <div class="display-product-option">
              <div class="sorter">
                <div class="view-mode"> <a title="Grid" data-toggle='tab' href="#product-grid" class="button button-active button-grid">&nbsp;</a><a data-toggle='tab' href="#product-list" title="List" class="button button-list">&nbsp;</a> </div>
              </div>
            </div>
            <div class="col-xs-12 mobileShow noPadding" style="display: none;">
              <div class="col-xs-4 noPadding" style="padding: 2px;">
                <a class=" text-center" href="?filt=" ><button class="btn button btn-block <?php if($this->input->get('filt') == ''){ echo "active"; } ?>"><i class="fa fa-star"></i> Popularity</button></a>
              </div>
              <div class="col-xs-4 noPadding" style="padding: 2px;">
                <a class=" text-center" href="?filt=asc"><button class="btn button btn-block  <?php if($this->input->get('filt') == 'asc'){ echo "active"; } ?>" ><i class="fa fa-arrow-down"></i> Low to High</button></a>
              </div>
              <div class="col-xs-4 noPadding" style="padding: 2px;">
                <a class=" text-center" href="?filt=desc"><button class="btn button btn-block text-center <?php if($this->input->get('filt') == 'desc'){ echo "active"; } ?>"><i class="fa fa-arrow-up"></i> High to Low</button></a>
              </div>
            </div>
            <div class="category-products tab-content" id="productContent">
            </div>
            <div class="toolbar">
              <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 pull-center text-center">
                  <div class="pager">
                    <div class="pages">
                      <ul class="pagination">
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </article>
        </div>
        <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9 noPadding">
          <aside class="col-left sidebar">
            <div class="side-nav-categories">
              <div class="block-title"><h3>Shop By Price</h3></div>
              <div class="box-content box-category">
                <ul>
                  <li><a href = "?filt=asc&term=<?= $this->input->get('term') ?>">Low to High</a></li>
                  <li><a href = "?filt=desc&term=<?= $this->input->get('term') ?>">High to Low</a></li>
                  <li><a href = "?bl=200&term=<?= $this->input->get('term') ?>">below Rs. 200</a></li>
                  <li><a href = "?ab=200&bl=400&term=<?= $this->input->get('term') ?>">Rs. 200 - Rs. 400</a></li>
                  <li><a href = "?ab=400&bl=600&term=<?= $this->input->get('term') ?>">Rs. 400 - Rs. 600</a></li>
                  <li><a href = "?ab=600&bl=800&term=<?= $this->input->get('term') ?>">Rs. 600 - Rs. 800</a></li>
                  <li><a href = "?ab=800&bl=1000&term=<?= $this->input->get('term') ?>">Rs. 800 - Rs. 1000</a></li>
                  <li><a href = "?ab=1000&term=<?= $this->input->get('term') ?>">Rs. 1000 Above</a></li>
                </ul>
              </div>
              <!--box-content box-category--> 
            </div>
          </aside>
          <aside class="col-left sidebar">
            <div class="side-nav-categories">
              <div class="block-title"><h3>Categories</h3></div>
              <div class="box-content box-category">
                <ul>
                  <?php
                    foreach ($category as $cat) {
                      $catURL = base_url('category/').$cat->category_id.'/'.url_title($cat->category_name);
                  ?>
                  <li> <a href = "<?= $catURL ?>"><?= $cat->category_name ?></a> <span class="subDropdown plus"></span>
                    <ul>
                      <?php
                        $tempSub = $this->shop->getSubCategory($cat->category_id);
                        foreach ($tempSub as $sub) {
                         
                        
                      ?>
                      <li> <a href = "#"> <?= $sub->subcategory_name ?> </a> <span class="subDropdown plus"></span>
                        <ul class="level1">
                        <?php
                          $tempChild = $this->shop->getChildCategory($sub->subcategory_id);
                          foreach ($tempChild as $cc) {
                            $childURL = base_url('childcategory/').$cc->child_id.'/'.url_title($cc->child_name);
                          
                        ?>
                          <li> <a href = "<?= $childURL ?>"><?= $cc->child_name ?></a> </li>
                          <?php } ?>
                          <!--end for-each -->
                        </ul>
                        <!--level1--> 
                      </li>
                    <?php } ?>
                    </ul> 
                  </li>
                <?php } ?>
                </ul>

              </div>
              <!--box-content box-category--> 
            </div>
            <?php if (count($OfferBan) != 0) {
            ?>
            <div class="custom-slider">
              <div>
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <?php 
                      for ($j=0; $j < count($OfferBan) ; $j++) { 
                        ?>
                        <li class="<?php if($j == 0){echo 'active';} ?>" data-target="#carousel-example-generic" data-slide-to="<?= $j ?>"></li>
                     <?php }
                     ?>
                  </ol>
                  <div class="carousel-inner">
                    <?php
                    $i = 0;
                      foreach ($OfferBan as $ob) {
                      $offerImg = json_decode($ob->banner);
                     
                    ?>
                    <div class="item <?php if($i == 0){echo 'active'; $i++;} ?>"><img src="<?= FOLDER_ASSETS_TEMPLATEBANNER.$offerImg[0] ?>" alt="slide2">
                      <div class="carousel-caption">
                        <h3><a title="<?= $ob->offer_name ?>" href="#">
                          <?php
                            if ($ob->offer_type == 1) {
                              echo "₹".$ob->amount;
                            }else{
                              echo $ob->amount."%";
                            }
                            if ($ob->is_coupon == 1) {
                              echo " Cashback";
                            }else{
                              echo " OFF";
                            }
                          ?>
                        </a></h3>
                        <p><?= $ob->offer_name ?></p>
                      </div>
                    </div>

                  <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </aside>
        </div>
      </div>
    </div>
  </section>
  <!-- Main Container End --> 
  
  <!-- Brand Logo -->  
  <?php include_once('includes/brands.php') ?>
  <!-- Footer -->
  <?php include_once('includes/footer.php') ?>
</div>
<?php include_once('includes/mobilemenu.php') ?>

<!-- End Footer --> 

<!-- JavaScript --> 
<?php include_once('includes/footerlinks.php') ?>
<script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>js/jquery.twbsPagination.js"></script>
<script> 
      var pageSize = "12";
      var pageCount =  "<?= $productCount ?? 0 ?>";
      var perPageNo = Math.ceil(pageCount/pageSize);
      $('.pagination').twbsPagination({
      totalPages: perPageNo,
      // the current page that show on start
      startPage: 1,
      // maximum visible pages
      visiblePages: 6,
      initiateStartPageClick: true,
      // template for pagination links
      href: false,
      // variable name in href template for page number
      hrefVariable: '{{number}}',

      // Text labels
      first: '«',
      prev: '',
      next: '',
      last: '»',

      // carousel-style pagination
      loop: false,

      // callback function
      onPageClick: function (event, page) {
        var formData = new FormData();
        var cond = '<?= json_encode($newProducts) ?>';
        formData.set('arr',cond);
        formData.set('pageNo',(page-1)*12);
        $.ajax({
          url: '<?= base_url('searching/loadlist') ?>',
          type: 'post',
          contentType: false,
          processData: false,
          data: formData,
          success: function(a){
            $('#productContent').html(a);
          }
        })
      },

      // pagination Classes
      paginationClass: 'pagination',
      nextClass: 'next',
      prevClass: 'prev',
      lastClass: 'last',
      firstClass: 'first',
      pageClass: 'pageLi',
      activeClass: 'active',
      disabledClass: 'disabled'

      }); 
</script>
<script type="text/javascript">
  
  $(document).ready(function(){
    $('.button').click(function(){
      $('.button-active').removeClass('button-active');
      $(this).addClass('button-active');
    });
  })
</script>
</body>
</html>
