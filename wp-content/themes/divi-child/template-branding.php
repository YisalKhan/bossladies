<?php
/**
 * @template
 * Template Name: Branding Center
 */
if (is_user_logged_in()) {
  get_header();
  global $wpdb;
  $slug = basename(get_permalink());
  $logged_in_user = get_current_user_id();
  $default_branding_post = $wpdb->get_results("SELECT * FROM E6h_users_branding_bars WHERE user_id = $logged_in_user && is_default = 1");
  $other_branding_post = $wpdb->get_results("SELECT * FROM E6h_users_branding_bars WHERE user_id = $logged_in_user && is_default = 0");
  ?>
    <div id="main-content">
        <div class="container">
            <div id="content-area" class="clearfix">
                <div class="header">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1 class="header-title entry-title main_title"><?php echo ucwords('Social ' . $slug . ' Bars'); ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="branding-top-cols">
                  <?php the_content(); ?>
                </div>
              <?php if (!empty($default_branding_post[0])) { ?>
                  <div class="row justify-content-center mt-4">
                      <div class="col-auto">
                          <div class="bg-white border-2 border-gold shadow-sm rounded">
                              <div class="text-center p-2 text-white rounded-top bg-blue">
                                  Selected Automated Branding Bar
                              </div>
                              <div class="py-3 px-2 p-sm-4 text-center branding-image">
                                  <img class="img-fluid"
                                       src="<?php echo $default_branding_post[0]->branding_bar_path ?>" alt="">
                                  <div class="mt-3">
                                      <a class="btn btn-sm btn-outline-info"
                                         href="<?php echo $default_branding_post[0]->branding_bar_path ?>"
                                         download><span
                                                  data-feather="download-cloud"></span> Download</a>
                                      <a class="bar-delete-button btn btn-sm btn-outline-secondary"
                                         onclick="deleteDefaultBar('<?php echo $default_branding_post[0]->id ?>','<?php echo $default_branding_post[0]->branding_bar_path ?>')"><span
                                                  data-feather="trash"></span></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              <?php } ?>
              <?php if (!empty($other_branding_post)) { ?>
                  <h2 class="text-center mt-6 mb-4 other-bars-heading">Other bars you've created:</h2>
              <?php } ?>
                <div class="row justify-content-center">
                    <div class="col-auto">
                      <?php foreach ($other_branding_post as $post) { ?>
                          <div class="card card-sm">
                              <div class="card-body users-brandings">
                                  <div class="row align-items-center">
                                      <div class="col">
                                          <img src="<?php echo $post->branding_bar_path ?>"
                                               class="img-fluid" alt="Branding bar preview">
                                      </div>
                                      <div class="col-auto">
                                          <div class="mt-1">
                                              <a class="btn btn-sm btn-outline-orange text-left"
                                                 onclick="selectBar('<?php echo $post->id ?>')">
                                                  <span data-feather="chevrons-right" class="mr-2"></span>
                                                  Select
                                              </a>
                                          </div>
                                          <div class="mt-1">
                                              <a class="btn btn-sm btn-outline-info text-left"
                                                 href="<?php echo $post->branding_bar_path ?>" download>
                                                  <span data-feather="download-cloud" class="mr-2"></span>
                                                  Download
                                              </a>
                                          </div>
                                          <div class="mt-1">
                                              <a class="btn btn-sm btn-delete text-left"
                                                 onclick="deleteBar('<?php echo $post->id ?>','<?php echo $post->branding_bar_path ?>')">
                                                  <span data-feather="trash" class="mr-2"></span>
                                                  Delete
                                              </a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      <?php } ?>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <button type="button" class="btn btn-info px-3 branding-bar-btn" data-toggle="modal"
                            data-target="#CreateModal">
                        <span data-feather="plus" class="mr-1"></span> New Branding Bar
                    </button>
                </div>
            </div>
        </div><!-- #content -->
    </div><!-- #primary -->
    <div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="CreateModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="CreateModalTitle">Create A New Branding Bar</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="m-0">Use Our Simple Do It Yourself Bar Creator</h3>
                            <div class="mt-1">
                                Easily create professional branding for your posts in minutes.
                            </div>
                            <div class="mt-3">
                                <span class="badge badge-secondary bg-blue">Recommended</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-info start-btn" href="/create-branding"><span data-feather="plus"
                                                                                            class="mr-2"></span>
                                Start Designing</a>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="m-0">Do You Like Using Canva?</h3>
                            <div class="mt-1">
                                Design your own unique brand using Canva.
                            </div>
                            <div class="mt-1 canva-notice">
                                <b>* IMPORTANT *</b> You Will Need A Canva Account To Edit & Add Photos - If You Do Not
                                Have A Free Canva Account <a href="https://bit.ly/2TBbhZG">CLICK HERE TO SIGN UP</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="https://bit.ly/2TBbhZG" id="CanvaBtn" class="btn btn-canva-icon">Design on
                                Canva</a>
                            <!--<button id="CanvaBtn" class="btn btn-canva-icon">Design on Canva</button>-->
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
  <?php
  get_footer();
} else {
  wp_redirect(site_url(), 301);
  exit();
}
?>
<script>
    function deleteDefaultBar(postID, imgPath) {
        if (confirm("Are you sure you want to permanently delete this branding bar?")) {
            $.ajax({
                url: '<?php echo get_stylesheet_directory_uri() ?>/ajax/delete_default_bar.php',
                data: {postID: postID, imgPath: imgPath},
                type: "POST",
                success: function (response) {
                    location.reload();
                }
            })
        }
    }

    function selectBar(postID) {
        $.ajax({
            url: '<?php echo get_stylesheet_directory_uri() ?>/ajax/select_default_bar.php',
            data: {postID: postID},
            type: "POST",
            success: function (response) {
                location.reload();
            }
        })
    }

    function deleteBar(postID, imgPath) {
        if (confirm("Are you sure you want to permanently delete this branding bar?")) {
            $.ajax({
                url: '<?php echo get_stylesheet_directory_uri() ?>/ajax/delete_bar.php',
                data: {postID: postID, imgPath: imgPath},
                type: "POST",
                success: function (response) {
                    location.reload();
                }
            })
        }
    }

    jQuery('.branding-bar-btn').click(function () {
        var modal = document.getElementById("CreateModal");
        modal.style.display = "block";

        modal.style.display = "block";

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                $('#CreateModal').slideUp('900');
            }
        }
    });
    jQuery('.close').click(function () {
        $('#CreateModal').slideUp('900');
    })
</script>
