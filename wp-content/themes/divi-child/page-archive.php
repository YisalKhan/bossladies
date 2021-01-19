<?php
/* 
Template Name: Archives
*/
if(!is_user_logged_in()){
  wp_redirect(site_url(), 301);
  exit();
}
get_header(); ?>

    <div id="main-content">
        <div class="container" role="main">
            <div id="content-area" class="clearfix">
                <div class="header">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col-lg">
                                <h6 class="header-pretitle">Boss Ladies of Real Estate</h6>
                                <h1 class="header-title entry-title main_title"><?php the_title() ?></h1>
                            </div>
                            <div class="col-lg-auto mt-4 mt-lg-0 text-center">
                                <a class="btn btn-primary btn-lastest-posts" href="/content/?cat=monthly-content">View Latest Content</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card archive-text">
                    <div class="card-body">
                        <div class="card-text text-center lead">
                            If you missed some previous content or you are looking for some additional post ideas...<br>
                            Below are some recent posts from our Monthly Archive.
                        </div>
                    </div>
                </div>
                <!--                          --><?php //the_post(); ?><!--                           -->
              <?php echo get_archive_posts('monthly-content') ?>
                <!--                          <h2>By Months</h2>-->
                <!--                            --><?php //echo wp_custom_archive(); ?>
                <!--                            <ul>--><?php //wp_get_archives('type=monthly'); ?><!--</ul>-->
                <!--                    <h2>Archives by Category:</h2>-->
                <!--                    <ul>--><?php //wp_list_categories();
              ?>
            </div><!-- #primary -->
            <div id="branding-image">
            </div>
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
    </div>
<?php get_footer(); ?>
