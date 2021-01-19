<!--<dd class="accordion-content accordionItem is-collapsed" id="accordion3" aria-hidden="true">-->
<div class="container-fluid" style="padding-top: 20px;">
    <div class="text-center mb-3">
        <div class="row justify-content-center align-items-center">
            <div class="col-auto">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label small-text" for="customSwitch1">Show with sample post</label>
                </div>
            </div>
            <div class="col-auto">
              <?php
              global $post;
              $args = array('numberposts' => -1, 'category_name' => 'sample-posts', 'order' => 'ASC');
              $posts = get_posts($args);
              $sample_post1 = '';
              ?>
                <select class="form-control form-control-sm d-inline-block w-auto px-3" id="samplePreviewPost">
                  <?php foreach ($posts as $key => $post) {
                    $post_image_url = get_the_post_thumbnail_url($post->ID);
                    if ($key == 0) {
                      $sample_post1 = $post_image_url;
                    }
                    ?>
                      <option value="<?php echo $post_image_url; ?>"><?php echo $post->post_title ?></option>
                  <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="mb-3 mx-auto text-center">
        <div class="row no-gutters justify-content-center align-items-center">
            <div class="col-auto mr-2 small-text">
                Line 1 Font Style
            </div>
            <div class="col-auto">
                <select class="form-control form-control-sm d-inline-block w-auto px-3" id="previewlinetext-font">
                    <option value="font-set-1">Standard</option>
                    <option value="font-set-2">Modern</option>
                    <option value="font-set-3">Classic</option>
                    <option value="font-set-4">Narrow</option>
                    <option value="font-set-5">Hand</option>
                </select>
            </div>
        </div>
    </div>
    <div class="text-center mb-5">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="includePortrait" checked>
            <label class="custom-control-label small-text" for="includePortrait">Include Portrait</label>
        </div>
    </div>
    <div class="preview-grid">
      <?php foreach ($result as $data) {
        $class360 = '';
        switch ($data->template_name) {
          case 'a':
            $class360 = 'scaled-preview-360 with-wave';
            break;
          case 'b':
            $class360 = 'scaled-preview-360 with-wave';
            break;
          default:
        }
        ?>
          <div class="bar-preview position-relative">
              <div class="post-image">
                  <img class="img-fluid" alt="" src="<?php echo $sample_post1 ?>">
              </div>
              <div>
                  <div class="scaled-preview <?php echo $class360 ?>">
                      <div class="post-branding-bar-container bar-style-<?php echo $data->template_name; ?> font-set-1 four-lines">
                          <div class="post-branding-bar">
                            <?php echo $data->background_image ?>
                              <div class="post-branding-content">
                                <?php if ($data->template_name === 'e') { ?>
                                    <div class="post-branding-text">
                                        <div class="post-branding-line1">Scarlett Russell</div>
                                        <div class="post-branding-line1b"
                                             style="display: block;">Associate Broker License #BR12345678</div>
                                        <div class="post-branding-line2">
                                            (602) 124-4321
                                        </div>
                                        <div class="post-branding-line3">
                                            www.yourwebsite.com
                                        </div>
                                    </div>
                                    <div class="post-branding-avatar">
                                        <div class="post-branding-avatar-img"
                                             style="background-image: url('<?php echo site_url() . '/' . $data->potrait ?>');"></div>
                                    </div>
                                    <div class="post-branding-logo">
                                      <?php if (!empty($data->style_c)) { ?>
                                        <?php echo $data->style_c ?>
                                      <?php } ?>
                                        <img class="post-branding-logo-img"
                                             alt=""
                                             src="<?php echo site_url() . '/' . $data->logo ?>">
                                    </div>
                                <?php } else if ($data->template_name === 'f') { ?>
                                    <div class="post-branding-avatar">
                                        <div class="post-branding-avatar-img"
                                             style="background-image: url('<?php echo site_url() . '/' . $data->potrait ?>');"></div>
                                    </div>
                                    <div class="post-branding-logo">
                                      <?php if (!empty($data->style_c)) { ?>
                                        <?php echo $data->style_c ?>
                                      <?php } ?>
                                        <img class="post-branding-logo-img"
                                             alt=""
                                             src="<?php echo site_url() . '/' . $data->logo ?>">
                                    </div>
                                    <div class="post-branding-text">
                                        <div class="post-branding-line1">Scarlett Russell</div>
                                        <div class="post-branding-line1b"
                                             style="display: block;">Associate Broker License #BR12345678</div>
                                        <div class="post-branding-line2">
                                            (602) 124-4321
                                        </div>
                                        <div class="post-branding-line3">
                                            www.yourwebsite.com
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="post-branding-avatar">
                                        <div class="post-branding-avatar-img"
                                             style="background-image: url('<?php echo site_url() . '/' . $data->potrait ?>');"></div>
                                    </div>
                                    <div class="post-branding-text">
                                        <div class="post-branding-line1">Scarlett Russell</div>
                                        <div class="post-branding-line1b"
                                             style="display: block;">Associate Broker License #BR12345678</div>
                                        <div class="post-branding-line2">
                                            (602) 124-4321
                                        </div>
                                        <div class="post-branding-line3">
                                            www.yourwebsite.com
                                        </div>
                                    </div>
                                    <div class="post-branding-logo">
                                      <?php if (!empty($data->style_c)) { ?>
                                        <?php echo $data->style_c ?>
                                      <?php } ?>
                                        <img class="post-branding-logo-img"
                                             alt=""
                                             src="<?php echo site_url() . '/' . $data->logo ?>">
                                    </div>
                                <?php } ?>
                              </div>
                            <?php if ($data->template_name === 'd') { ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="1080"
                                     height="270" viewBox="0 0 1080 270">
                                    <path d="M0,0,700.105,175.026,1080,270H0Z"
                                          fill="rgba(255,255,255,0.09)"></path>
                                </svg>
                            <?php } ?>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="<?php echo ($data->template_name === 'e') ? 'mt-10' : 'mt-1' ?> text-right">
                  <button class="btn btn-outline-info btn-sm stretched-link btn-select"
                          id="selecthide-<?php echo $data->template_name ?>"
                          onclick="selectTemplate('<?php echo $data->template_name ?>')">Select
                  </button>
                  <button class="btn btn-info btn-sm display-none btn-selected" disabled="disabled"
                          id="selected-<?php echo $data->template_name; ?>">
                      <span class="fe fe-check my-n1 mr-1 d-inline-block"></span>
                      Selected
                  </button>
              </div>
          </div>
      <?php } ?>
        <div class="text-center mt-5">
            <button class="btn btn-sm btn-light collapsed" onclick="tabSwitch('ui-id-3')" role="button"
                    aria-expanded="false"
                    aria-controls="step2">
                Previous
            </button>
            <button class="btn btn-sm btn-info px-4" onclick="tabSwitch('ui-id-5')" role="button" aria-expanded="true"
                    aria-controls="step3">
                Continue
            </button>
        </div>
    </div>
</div>
<!--</dd>-->
