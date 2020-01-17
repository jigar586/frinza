<div class="comment-content">
                    <div class="comments-wrapper">
                      <h3> Comments </h3>
                      <ul class="commentlist">
                        <?php
                          foreach ($comments as $r) {
                            $date = date('D, M d, Y h:i:s a',strtotime($r->created_at)); 
                        ?>
                        <li class="comment">
                          <div class="comment-wrapper">
                            <div class="comment-author vcard">
                              <!-- <p class="gravatar"><a href="#"><img width="60" height="60" alt="avatar" src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>images/avatar60x60.jpg"></a></p> -->
                              <span class="author"><b><?= $r->c_name ?></b></span> </div>
                            <!--comment-author vcard-->
                            <div class="comment-meta">
                              <time datetime="2018-07-10T07:26:28+00:00" class="entry-date"><?= $date ?></time>
                              . </div>
                            <!--comment-meta-->
                            <div class="comment-body"><?= $r->c_detail ?></div>
                          </div>
                        </li>
                      <?php } ?>
                      </ul>
                      <!--commentlist--> 
                    </div>
                    <!--comments-wrapper-->
                    
                    <div class="comments-form-wrapper clearfix">
                      <h3>Leave A reply</h3>
                      <div class="myMsg"></div>
                      <form class="comment-form" method="post" id="postComment">
                        <div class="field">
                          <label>Name<em class="required">*</em></label>
                          <input type="text" class="input-text" title="Name" value="" id="user" name="user_name" required="required">
                        </div>
                        <div class="field">
                          <label for="email">Email<em class="required">*</em></label>
                          <input type="text" class="input-text validate-email" title="Email" value="" id="email" name="user_email" required="required">
                          <input type="hidden" name="txthdn" value="<?= $blog[0]->blog_id ?>">
                        </div>
                        <div class="clear"></div>
                        <div class="field aw-blog-comment-area">
                          <label for="comment">Comment<em class="required">*</em></label>
                          <textarea rows="5" cols="50" class="input-text" title="Comment" id="comment" name="comment" required="required"></textarea>
                        </div>
                        <div class="button-set">
                          <input type="hidden" value="1" name="blog_id">
                          <button type="submit" class="bnt-comment"><span><span>Add Comment</span></span></button>
                        </div>
                      </form>
                    </div>
                    <!--comments-form-wrapper clearfix--> 
                    
                  </div>
                  