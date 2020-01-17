<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/headerlinks.php') ?>

<body class="product-page">
<div id="page"> 
  <!-- Header -->
 <?php include_once('includes/header.php') ?>
  <!-- end header --> 
  
  <!-- Navigation -->
  
 <?php include_once('includes/navigation.php') ?>
  <!-- end nav -->
  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <div class="col-sm-9">
          <?php
            $title = $blog[0]->title;
            $img = FOLDER_ASSETS_TEMPLATEBLOG.$blog[0]->blog_img;
            $details = $blog[0]->details;
            $catURL = base_url('blog/category/').$blog[0]->category.'/'.url_title($blog[0]->category_name);
            $date = date('M d, Y',strtotime($blog[0]->updated_at));
          ?>
          <div class="col-main">
            <div class="page-title">
              <h1>Blog</h1>
            </div>
            <div class="blog-wrapper" id="main">
              <div class="site-content" id="primary">
                <div role="main" id="content">
                  <article class="blog_entry clearfix">
                    <header class="blog_entry-header clearfix">
                      <div class="blog_entry-header-inner">
                        <h2 class="blog_entry-title"><?= $title ?></h2>
                      </div>
                      <!--blog_entry-header-inner--> 
                    </header>
                    <!--blog_entry-header clearfix-->
                    <div class="entry-content">
                      <div class="featured-thumb"><a href="#"><img alt="<?= word_limiter($title,5) ?>" src="<?= $img ?>"></a></div>
                      <div class="entry-content">
                        <?= $details ?>
                      </div>
                    </div>
                    <footer class="entry-meta"> This entry was posted           in <a rel="category tag" title="View all posts in <?= $blog[0]->category_name ?>" href="<?= $catURL ?>"><?= $blog[0]->category_name ?></a> On
                      <time datetime="2018-07-10T06:53:43+00:00" class="entry-date"><?= $date ?></time>
                      . </footer>
                  </article>
                  <?php include_once('includes/comments.php') ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-right sidebar col-sm-3 col-xs-12 bounceInUp animated">
          <div role="complementary" class="widget_wrapper13" id="secondary">
            <div class="popular-posts widget widget__sidebar" id="recent-posts-4">
              <h3 class="widget-title"><span>Most Popular Post</span></h3>
              <div class="widget-content">
                <ul class="posts-list unstyled clearfix">
                  <?php
                    foreach ($randomBlogs as $r) {
                      $date = date('M d, Y',strtotime($r->updated_at));
                      $blogURL = base_url('blog/').$r->blog_id.'/'.url_title($r->title);
                      $title = $r->title;
                      $img = FOLDER_ASSETS_TEMPLATEBLOG.$r->blog_img;
                    
                  ?>
                  <li> <figure class="featured-thumb"> <a href="<?= $blogURL ?>"> <img width="80" height="53" alt="<?= word_limiter($title,5) ?>" src="<?= $img ?>"> </a> </figure>
                    <!--featured-thumb-->
                    <h4><a title="<?= $title ?>" href="<?= $blogURL ?>"><?= word_limiter($title,10) ?></a></h4>
                    <p class="post-meta"><i class="icon-calendar"></i>
                      <time datetime="2018-07-10T07:09:31+00:00" class="entry-date"><?= $date ?></time>
                      .</p>
                  </li>
                <?php } ?>
                </ul>
              </div>
              <!--widget-content--> 
            </div>
            <div class="popular-posts widget widget_categories">
              <h3 class="widget-title"><span>Categories</span></h3>
            <ul>
              <?php
                foreach ($blogCategories as $r) {
                  $id = $r->category_id;
                  $name = $r->category_name;
                  $count = catBlogCount($id);
                  $catURL = base_url('blog/category/').$id.'/'.url_title($name);
              ?>
                <li class="cat-item"><a href="<?= $catURL ?>"><?= $name.' ('.$count.')' ?></a></li>
              <?php    }
              ?>
              </ul>
            </div>
            <!-- Banner Ad Block -->
            <!-- <div class="ad-spots widget widget__sidebar">
              <h3 class="widget-title"><span>Ad Spots</span></h3>
              <div class="widget-content"><a target="_self" href="#" title=""><img alt="offer banner" src="http://via.placeholder.com/262x420"></a></div>
            </div> -->
            <!-- Banner Text Block -->
            <!-- <div class="text-widget widget widget__sidebar">
              <h3 class="widget-title"><span>Text Widget</span></h3>
              <div class="widget-content">Mauris at blandit erat. Nam vel tortor non quam scelerisque cursus. Praesent nunc vitae magna pellentesque auctor. Quisque id lectus.<br>
                <br>
                Massa, eget eleifend tellus. Proin nec ante leo ssim nunc sit amet velit malesuada pharetra. Nulla neque sapien, sollicitudin non ornare quis, malesuada.</div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Brand Logo -->
  <?php include_once('includes/brands.php') ?>
  <!-- Footer -->
  <?php include_once('includes/footer.php') ?>
</div>
<?php include_once('includes/mobilemenu.php') ?>

<!-- End Footer --> 

<!-- JavaScript --> 
<?php include_once('includes/footerlinks.php') ?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#postComment').on('submit',function(e){
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: '<?= base_url('blog/commentsubmit') ?>',
        type: 'post',
        contentType: false,
        processData: false,
        data: formData,
        success: function(a){
          $('.myMsg').html(a);
          $('#postComment').trigger('reset');
        }
      })
    })
  })
</script>
</body>
</html>