<?php
include('../../../../wp-load.php');
global $wpdb;
$logged_in = get_current_user_id();
$get_default_bars = $wpdb->get_results("SELECT * FROM E6h_users_branding_bars where user_id = $logged_in and is_default = 1");
$postId = $_POST['postID'];
$content_post = get_post($postId);
$content = $content_post->post_title;
$postSlug = $content_post->post_name;
$suggest_comment = get_field('suggested_comment', $postId);
$suggest_hashtags = get_field('suggested_hashtags', $postId);
$image = get_the_post_thumbnail($postId);
$image_path = get_the_post_thumbnail_url($postId);
$html = '';
$html .= '
<div class="row">
<input type="hidden" id="postmodal-slug" value="'.$postSlug.'">
    <div class="col-12 col-lg-6">
        <div class="border-light" id="downloadPreviewContainer">
        <img src="'.$image_path.'">
            <div class="branding-bar-preview">
                <!-- Branding Bar -->
                <img src="'.site_url() . $get_default_bars[0]->branding_bar_path.'">
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 mt-4 mt-lg-0">
        <div class="d-flex h-100" style="flex-flow: column;">
            <div style="flex: 1 1 auto;">
                <h4 class="text-muted">Suggested Comment</h4>
                <p class="card-text" id="suggested-comment">'.$suggest_comment.'</p>
                <h4 class="text-muted mt-4 mt-lg-5">Suggested Hashtags</h4>
                <p class="card-text" id="suggested-tags">'.$suggest_hashtags.'</p>
            </div>
            <div style="flex: 0 1 auto;">
            <hr>
            <div class>
                <div class="row align-items-center">
                    <div class="col">
                        <div class="custom-control custom-switch d-inline-block align-top">
                            <input type="checkbox" class="custom-control-input branding-bar-toggle" id="has_bar">
                            <label class="custom-control-label" for="has_bar">Branding Bar</label>
                            <div class="tooltip" id="first">
                              <div class="info">
                                <h3>Branding Bar</h3>
                                <p>Selecting this option adds your personalized branding bar to the bottom of the post graphic</p>
                                <div class="arrow"></div>
                              </div>
                            </div>
                        </div>
                        <span class="fe fe-help-circle text-info ml-1" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" title="" data-content="Selecting this option adds your personalized branding bar to the bottom of the post graphic" data-original-title="Branding Bar"></span>              
                    </div>
                    <div class="col-auto">
                    <a class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="left" title="" href="/branding" data-original-title="Configure your branding bar">Configure 
                        <span data-feather="feather" class="ml-1"></span>
                    </a>
                    </div>
                </div>
                <div class="mt-3 row align-items-center">
                    <div class="col">
                        Edit/Customize Post
                    </div>
                    <div class="col-auto">
                    <a class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="left" title="" href="https://bit.ly/2TBbhZG" data-original-title="Edit on Canva">Edit on Canva 
                        <span data-feather="feather" class="ml-1"></span>
                    </a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col small text-muted py-1">Copy:</div>
                <div class="col-auto">
                    <div class="info-comment">
                      <p>Copied!</p>
                      <div class="arrow-comment"></div>
                    </div>
                    <button class="btn btn-sm btn-secondary copy-comment-btn" data-original-title="" title="">Comment</button>
                    <div class="info-tags">
                      <p>Copied!</p>
                      <div class="arrow-tags"></div>
                    </div>
                    <button class="btn btn-sm btn-secondary copy-tags-btn">Tags</button>
                    <div class="info-both">
                      <p>Copied!</p>
                      <div class="arrow-both"></div>
                    </div>
                    <button class="btn btn-sm btn-secondary copy-all-btn" data-original-title="" title="">Both</button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-8">
                    <div class="mt-1">
                      <a class="btn btn-sm text-left popup-download-btn" href="#">
                         <span data-feather="download-cloud"></span>
                         Download
                      </a>
                    </div>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-light btn-block btn-close" data-dismiss="modal"><span class="fe fe-x"></span> Close</button>
                </div>
            </div>
            <!-- Configuration Options Here -->
            </div>
        </div>
    </div>
</div>';
echo $html;
