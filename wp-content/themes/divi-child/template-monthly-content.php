<?php
/* 
Template Name: Monthly Content
*/
if (is_user_logged_in()) {
  get_header();
  $category_name = $_GET['cat'];
  $categoryObj = get_category_by_slug($category_name);
  global $post;
  $today = date( 'Y-m-d' );
  $date_mid_month = date("Y-m-d", strtotime($today ." -15 days") );
  $args = array(
    'category_name' => $category_name,
    'numberposts' => -1,
    'date_query' => array(
      array(
        //'column' => 'post_modified_gmt',
        'after'     => $date_mid_month,
        'before'    => $today,
        'inclusive' => true,
      ),
    ),
  );
  $query = new WP_Query( $args );

//  $args = array('numberposts' => -1, 'category_name' => $category_name);
//  $posts = get_posts($args);
  ?>
    <div id="main-content">
        <div class="container">
            <div id="content-area" class="clearfix">
                <div id="left-area">
                    <div class="header">
                        <div class="header-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h1 class="header-title entry-title main_title"><?php echo ucwords(str_replace("-", " ", $category_name)); ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="strategy-note">
                        <h2>A strategy note from <span>Boss Ladies of Real Estate</span></h2>
                        <p><?php echo $categoryObj->description ?></p>
                    </div>
                  <?php
                  if($query->have_posts()) :
                  while($query->have_posts()) :
                    $query->the_post();
                    $image = get_the_post_thumbnail();
                    ?>
                      <article id="post-<?php the_ID() ?>" <?php post_class('et_pb_post'); ?>
                               onclick="openPopup('<?php the_ID() ?>', '<?php echo get_stylesheet_directory_uri() ?>')">
                          <a href="javascript:" class="entry-featured-image-url">
                            <?php
                            echo $image;
                            ?>
                          </a>
                          <div class="post-actions">
                              <a class="btn btn-block btn-outline-primary stretched-link post-details-btn"
                                 href="javascript:;">View Post Details
                              </a>
                          </div>
                          <div class="entry-content">
                            <?php the_content(); ?>
                          </div><!-- .entry-content -->
                      </article>
                  <?php endwhile; // end of the loop.
                  else: ?>
                          <h2>No posts for this month</h2>
                          <p>Missed some previous week's content? Looking for some more post ideas?
                              Checkout in <a href="/archives">Archive Directory</a></p>
                  <?php endif;
                  ?>
                </div>
                <div id="branding-image"></div>
                <!-- The Modal -->
                <div id="myModal" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <div class="modal-body">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- #content -->
    </div><!-- #primary -->
    <script>
    
    </script>
  <?php get_footer();
} else {
  wp_redirect(site_url(), 301);
  exit();
}
?>
