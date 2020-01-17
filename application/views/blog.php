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
        <div class="col-sm-9 bounceInUp animated">
        <div class="col-main">
          <div class="page-title">
            <h2>Blog</h2>
          </div>
          <div class="blog-wrapper" id="main">
            <div class="site-content" id="primary">
              <div role="main" id="content">
              <?php foreach ($blogs as $r) {
                $blogURL = base_url('blog/').$r->blog_id.'/'.url_title($r->title);
                $catURL = base_url('blog/category/').$r->category.'/'.url_title($r->category_name);
                $date = date('M d, Y',strtotime($r->updated_at));
               ?> 
                <article class="blog_entry clearfix">
                  <header class="blog_entry-header clearfix">
                    <div class="blog_entry-header-inner">
                      <h2 class="blog_entry-title"> <a rel="bookmark" href="<?= $blogURL ?>"><?= $r->title ?></a> </h2>
                    </div>
                    <!--blog_entry-header-inner--> 
                  </header>
                  <div class="entry-content">
                    <div class="featured-thumb"><a href="<?= $blogURL ?>"><img alt="<?= word_limiter($r->title,5) ?>" src="<?= FOLDER_ASSETS_TEMPLATEBLOG.$r->blog_img ?>"></a></div>
                    <div class="entry-content">
                      <p><?= word_limiter(strip_tags($r->details,'<br>'),80) ?></p>
                    </div>
                    <p> <a class="btn" href="<?= $blogURL ?>">Read More</a> </p>
                  </div>
                  <footer class="entry-meta"> This entry was posted						in <a rel="category tag" title="View all posts in <?= $r->category_name ?>" href="<?= $catURL ?>"><?= $r->category_name ?></a> On
                    <time datetime="2018-07-10T06:59:14+00:00" class="entry-date"><?= $date ?></time>
                    . </footer>
                </article>
              <?php } ?>
                
              </div>
            </div>
            <div class="pager">
              <p class="amount"> <strong><?= count($blogs) ?> Item(s)</strong> </p>
              <div class="limiter">
                <label>Show</label>
                <select onchange="setLocation(this.value)">
                  <option selected="selected" value="#/blog/?limit=5"> 5 </option>
                  <option value="#/blog/?limit=10"> 10 </option>
                  <option value="#/blog/?limit=15"> 15 </option>
                  <option value="#/blog/?limit=20"> 20 </option>
                  <option value="#/blog/?limit=all"> All </option>
                </select>
                per page </div>
            </div>
          </div>
        </div></div>
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
          </div>
        </div>
      </div>
    </div>
  </div>
 

<!-- Brand and features bar -->
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