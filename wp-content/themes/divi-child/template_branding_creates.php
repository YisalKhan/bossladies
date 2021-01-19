<?php
/*
 * @template
 * Template Name: Create Branding
 * */
if (!is_user_logged_in()) {
  wp_redirect(site_url(), 301);
  exit();
}
get_header();
$slug = basename(get_permalink());
global $wpdb;
$logged_in_user = wp_get_current_user();
$brandingTemplateTable = $wpdb->prefix . 'branding_bars_templates';
$result = $wpdb->get_results("SELECT * FROM $brandingTemplateTable where (user_id = 0 || user_id = $logged_in_user->ID) ");
?>
<div id="main-content">
    <div class="container">
        <div id="content-area" class="clearfix">
            <div class="header">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h1 class="header-title entry-title main_title"><?php echo ucwords(str_replace('-', ' ', $slug . ' Bar')); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="branding-top-cols col-12 col-md">
                    <div class="accordion mb-5" id="steps">
                        <h3>Step 1: Logo & Potrait</h3>
                        <div>
                          <?php include('inc/logo_potrait.php') ?>
                        </div>
                        <h3>Step 2: Text & Colors</h3>
                        <div>
                          <?php include('inc/text_color.php') ?>
                        </div>
                        <h3>Step 3: Layout Style</h3>
                        <div>
                          <?php include('inc/layout_style.php') ?>
                        </div>
                    </div>
                    <!-- end accordion -->
                    <!-- end container -->
                </div>
                <div class="col-auto previewContainer">
                    <div class="position-sticky" style="top: 10px;">
                        <div class="row align-items-center mb-2">
                            <div class="col">
                                <h3 class="m-0 p-0">
                                    Preview
                                </h3>
                            </div>
                            <div class="col-auto">
                              <?php
                              global $post;
                              $args = array('numberposts' => -1, 'category_name' => 'sample-posts', 'order' => 'ASC');
                              $posts = get_posts($args);
                              $sample_post1 = '';
                              ?>
                                <select class="form-control form-control-sm d-inline-block w-auto px-3"
                                        id="sampleposts_dd">
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

                        <div class="d-flex flex-column align-items-center border border-light bg-white p-2 shadow-sm">
                            <div class="bar-preview  showSamplePosts">
                                <div class="post-image" style="margin-bottom:-13%">
                                    <img class="img-fluid" alt=""
                                         src="<?php echo $sample_post1; ?>">
                                </div>

                            </div>
                            <div id="PreviewContainer">
                                <div class="scaled-preview scaled-preview-360 with-wave">
                                    <div class="post-branding-bar-container bar-style-a font-set-1">
                                        <div class="post-branding-bar">
                                            <svg width="1080" height="344" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 1080 344">
                                                <g transform="translate(0 -1005.998)">
                                                    <path d="M-5970,3589.154s65.565,40.2,326.344,67.593S-4890,3606.156-4890,3606.156v327H-5970Z"
                                                          transform="translate(5970 -2583.156)"
                                                          data-bind="fill:$root.accentColor" fill="#f9c823">
                                                    </path>
                                                    <path d="M-5970,3589.154s65.565,40.2,326.344,67.593S-4890,3606.156-4890,3606.156v317H-5970Z"
                                                          transform="translate(5970 -2573.156)"
                                                          data-bind="fill:$root.bgColor" fill="#242424"></path>
                                                </g>
                                            </svg>
                                            <div class="post-branding-content">
                                                <div class="post-branding-avatar">
                                                    <div class="post-branding-avatar-img"
                                                         style="background-image: url('<?php echo site_url() ?>/wp-content/uploads/company_branding_bars/template1/portrait-placeholder.png');background-position: 50% 25%">
                                                    </div>
                                                </div>
                                                <div class="post-branding-text" style="color: rgb(255, 255, 255);">
                                                    <div class="post-branding-line1">Scarlett Russell
                                                    </div> <?php //echo $logged_in_user->display_name ?>
                                                    <div class="post-branding-line1b">Associate Broker License
                                                        #BR12345678
                                                    </div>
                                                    <div class="post-branding-line2">(602) 124-4321</div>
                                                    <div class="post-branding-line3">www.yourwebsite.com</div>
                                                </div>
                                                <div class="post-branding-logo">
                                                    <img class="post-branding-logo-img" alt=""
                                                         src="<?php echo site_url() ?>/wp-content/uploads/company_branding_bars/template1/logo-placeholder.png">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center text-secondary mt-2 small font-italic">Note: Final rendered result
                            may vary slightly
                        </div>
                        <div class="text-center mt-4">
                            <div class="small text-secondary mb-3">
                                Once you are happy with your design, <br>click the "Create" button below
                            </div>
                            <button id="CreateBtn" class="btn btn-info btn-lg px-5 position-relative pulse">
                                Create
                            </button>
                            <!--tets-->

                            <!--tets-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- #content -->
</div><!-- #primary -->
<div id="branding-image" style="display: none"></div>
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="ResultModalTitle">Success!</h2>
            <div>
            </div>
        </div>
        <div class="modal-body text-center">
        </div>
        <div class="modal-footer justify-content-between">
            <div class="text-left">
                <button type="button" class="btn btn-light btn-close" data-dismiss="modal">Discard</button>
            </div>
            <div class="text-right">
                <button type="button" class="btn btn-lg btn-info" id="branding-save">Save</button>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
<script>
    $('#sampleposts_dd').on('change', function () {
        $('.bar-preview .post-image img').attr('src', this.value);
    })
    $('#samplePreviewPost').on('change', function () {
        $('.preview-grid .post-image img').attr('src', this.value);
    })
    var bgcol = '';
    var accentcol = '';
    var textcol = ''
    $(function () {
        var icons = {
            header: "ui-icon-plusthick",
            activeHeader: "ui-icon-minusthick"
        };
        $("#steps").accordion({
            collapsible: true,
            active: 'none',
            heightStyle: "content",
            icons: icons,
        });
    });
    $(document).ready(function () {
        var defaultBgColr = localStorage.getItem('bgcolor');
        var defaultAccentColor = localStorage.getItem('accentcolor');
        var defaultTextColor = localStorage.getItem('textcolor');
        var defaultTemplate = localStorage.getItem('selected_template');

        if (defaultBgColr !== null) {
            $(".with-wave .post-branding-bar svg g path:nth-child(2)").attr("fill", defaultBgColr);
            $(".bar-style-c.post-branding-bar-container .post-branding-bar").css("background-color", defaultBgColr);
            $(".bar-style-d.post-branding-bar-container .post-branding-bar").css("background-color", defaultBgColr);
            $(".bar-style-e.post-branding-bar-container .post-branding-bar").css("background-color", defaultBgColr);
            $(".bar-style-f.post-branding-bar-container .post-branding-bar").css("background-color", defaultBgColr);
        } else {
            $(".with-wave .post-branding-bar svg g path:nth-child(2)").attr("fill", '#242424');
            $(".bar-style-c.post-branding-bar-container .post-branding-bar").css("background-color", '#242424');
            $(".bar-style-d.post-branding-bar-container .post-branding-bar").css("background-color", '#242424');
            $(".bar-style-e.post-branding-bar-container .post-branding-bar").css("background-color", '#242424');
            $(".bar-style-f.post-branding-bar-container .post-branding-bar").css("background-color", '#242424');
            $('.bg-spectrum .sp-preview-inner').css('background-color', '#242424');
            localStorage.setItem('bgcolor', '#242424');
        }
        if (defaultAccentColor !== null) {
            $(".with-wave .post-branding-bar svg g path:nth-child(1)").attr("fill", defaultAccentColor);
        } else {
            $('.accent-spectrum .sp-preview-inner').css('background-color', '#c0b590');
            $(".with-wave .post-branding-bar svg g path:nth-child(1)").attr("fill", '#c0b590');
            localStorage.setItem('accentcolor', '#c0b590');
        }
        if (defaultTextColor !== null) {
            $(".post-branding-bar .post-branding-content .post-branding-text").css("color", defaultTextColor);
        } else {
            $('.text-spectrum .sp-preview-inner').css('background-color', '#ffffff');
            $(".post-branding-bar .post-branding-content .post-branding-text").css("color", '#ffffff');
            localStorage.setItem('textcolor', '#ffffff');
        }
        if (defaultTemplate !== null) {
            localStorage.setItem('selected_template', defaultTemplate);
        } else {
            localStorage.setItem('selected_template', 'a');
            $('#selecthide-a').addClass('display-none');
            $('#selected-a').removeClass('display-none');
        }
        if (localStorage.getItem('line1text') === null) {
            localStorage.setItem('line1text', $('#line1keyup').val());
        }
        if (localStorage.getItem('line2text') === null) {
            localStorage.setItem('line2text', $('#line2-input').val());
        }
        if (localStorage.getItem('line3text') === null) {
            localStorage.setItem('line3text', $('#line3-input').val());
        }
        if (localStorage.getItem('line4text') === null) {
            localStorage.setItem('line4text', $('#line4-input').val());
        }
        if (localStorage.getItem('logo_path') === null) {
            localStorage.setItem('logo_path', '<?php echo site_url() ?>/wp-content/uploads/company_branding_bars/template1/logo-placeholder.png')
        }
        if (localStorage.getItem('potrait_path') === null) {
            localStorage.setItem('potrait_path', '<?php echo site_url() ?>/wp-content/uploads/company_branding_bars/template1/portrait-placeholder.png');
        }
        $('#selecthide-a').addClass('display-none');
        $('#selected-a').removeClass('display-none');
    });

    function selectTemplate(template) {
        $('.btn-select').removeClass('display-none');
        $('.btn-selected').addClass('display-none');
        var appendHtml = '';
        switch (template) {
            case 'a':
                appendHtml = '<div class="scaled-preview scaled-preview-360 with-wave"><div class="post-branding-bar-container bar-style-a font-set-1 four-lines">' + $('.bar-style-' + template).html() + '</div></div>';
                break;
            case 'b':
                appendHtml = '<div class="scaled-preview scaled-preview-360 with-wave"><div class="post-branding-bar-container bar-style-a font-set-1 four-lines">' + $('.bar-style-' + template).html() + '</div></div>';
                break;
            case 'c':
                appendHtml = '<div class="scaled-preview"><div class="post-branding-bar-container bar-style-c font-set-1 four-lines">' + $('.bar-style-' + template).html() + '</div></div>';
                break;
            case 'd':
                appendHtml = '<div class="scaled-preview"><div class="post-branding-bar-container bar-style-d font-set-1 four-lines">' + $('.bar-style-' + template).html() + '</div></div>';
                break;
            case 'e':
                appendHtml = '<div class="scaled-preview"><div class="post-branding-bar-container bar-style-e font-set-1 four-lines">' + $('.bar-style-' + template).html() + '</div></div>';
                break;
            case 'f':
                appendHtml = '<div class="scaled-preview"><div class="post-branding-bar-container bar-style-f font-set-1 four-lines">' + $('.bar-style-' + template).html() + '</div></div>';
                break;
            default:
                appendHtml = '<div class="scaled-preview scaled-preview-360 with-wave"><div class="post-branding-bar-container bar-style-a font-set-1 four-lines">' + $('.bar-style-' + template).html() + '</div></div>';
        }
        $('#PreviewContainer').html(appendHtml);
        $('#selecthide-' + template).addClass('display-none');
        $('#selected-' + template).removeClass('display-none');
        localStorage.setItem('selected_template', template);
    }

    function getBgColor() {
        BgColor = localStorage.getItem('bgcolor');
        if (BgColor !== '') {
            bgcol = localStorage.getItem('bgcolor');
        } else {
            bgcol = '#242424';
        }
        return bgcol;
    }

    function getAccentColor() {
        accentColor = localStorage.getItem('accentcolor');
        if (accentColor !== '') {
            accentcol = localStorage.getItem('accentcolor');
        } else {
            accentcol = 'rgb(192, 181, 144)';
        }
        return accentcol;
    }

    function getTextColor() {
        textColor = localStorage.getItem('textcolor');
        if (textColor !== '') {
            textcol = localStorage.getItem('textcolor');
        } else {
            textcol = '#ffffff';
        }
        return textcol;
    }

    $("#BgColorSelect").spectrum({
        color: getBgColor(),
        showInput: true,
        className: "bg-spectrum",
        showInitial: true,
        showSelectionPalette: true,
        maxSelectionSize: 10,
        preferredFormat: "hex",
        move: function (color) {
        },
        show: function () {
        },
        beforeShow: function () {
        },
        hide: function () {
        },
        change: function (color) {
            //color.toHexString();
            $(".with-wave .post-branding-bar svg g path:nth-child(2)").attr("fill", color.toHexString());
            $(".bar-style-c.post-branding-bar-container .post-branding-bar").css("background-color", color.toHexString());
            $(".bar-style-d.post-branding-bar-container .post-branding-bar").css("background-color", color.toHexString());
            $(".bar-style-e.post-branding-bar-container .post-branding-bar").css("background-color", color.toHexString());
            $(".bar-style-f.post-branding-bar-container .post-branding-bar").css("background-color", color.toHexString());
            localStorage.setItem('bgcolor', color.toHexString());
        }
    });
    $("#AccentColorSelect").spectrum({
        color: getAccentColor(),
        showInput: true,
        className: "accent-spectrum",
        showInitial: true,
        showSelectionPalette: true,
        maxSelectionSize: 10,
        preferredFormat: "hex",
        move: function (color) {
        },
        show: function () {
        },
        beforeShow: function () {
        },
        hide: function () {
        },
        change: function (color) {
            $(".with-wave .post-branding-bar svg g path:nth-child(1)").attr("fill", color.toHexString());
            localStorage.setItem('accentcolor', color.toHexString());
        }
    });
    $("#TextColorSelect").spectrum({
        color: getTextColor(),
        showInput: true,
        className: "text-spectrum",
        showInitial: true,
        showSelectionPalette: true,
        maxSelectionSize: 10,
        preferredFormat: "hex",
        move: function (color) {
        },
        show: function () {
        },
        beforeShow: function () {
        },
        hide: function () {
        },
        change: function (color) {
            $(".post-branding-bar .post-branding-content .post-branding-text").css("color", color.toHexString());
            localStorage.setItem('textcolor', color.toHexString());
        }
    });

    /* Croppie Code for Potrait */
    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.upload-demo').addClass('ready');
                $('#pot-preview').addClass('display-none');
                $('.image_potrait .cr-boundary').css('margin-top', '.25rem');
                $('.image_potrait .cr-boundary').css('border-radius', '5px');
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function () {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            swal("Sorry - you're browser doesn't support the FileReader API");
        }
    }

    $uploadCrop = $('#upload-demo').croppie({
        viewport: {
            width: 250,
            height: 250,
            type: 'square'
        },
        customClass: 'image_potrait',
        enableExif: true
    });
    $('#upload').on('change', function () {
        $('.upload-demo-wrap').removeClass('display-none');
        $('#pot-preview').removeClass('display-none');
        $('.upload-result').show();
        readFile(this);
    });

    $('#upload-demo').on('update.croppie', function (ev, cropData) {
        $('#upload-demo').croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {
            localStorage.setItem('potrait_path', resp);
            $('.demo-wrap a.file-btn span').text('Select New Photo');
            $('.post-branding-avatar-img').css('background-image', 'url(' + resp + ')');
        });
    });
    $('.upload-result').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {
            jQuery.ajax({
                url: "<?php echo get_stylesheet_directory_uri() ?>/ajax/upload_image.php",
                data: {"image": resp},
                type: "POST",
                success: function (data) {
                    if (data !== 'Failed') {
                        localStorage.setItem('potrait_path', data);
                        $('.upload-demo-wrap').addClass('display-none');
                        $('#pot-preview').removeClass('display-none');
                        $('.upload-result').hide();
                        $('#pot-preview').html('<img src="' + data + '">');
                        $('.post-branding-avatar-img').css('background-image', 'url(' + data + ')');
                    }
                    jQuery('#upload').val('');
                }
            });
        });
    });

    /* Logo Croppie Functions */
    // function readLogoFile(input) {
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();
    //
    //         reader.onload = function (e) {
    //             $('.upload-logo-demo').addClass('ready');
    //             $('#logo-preview').addClass('display-none');
    //             $('.image_logo .cr-boundary').css('margin-top', '.25rem');
    //             $('.image_logo .cr-boundary').css('border-radius', '5px');
    //             $uploadCropLogo.croppie('bind', {
    //                 url: e.target.result
    //             }).then(function () {
    //                 console.log('jQuery bind logo complete');
    //             })
    //         }
    //         reader.readAsDataURL(input.files[0]);
    //     } else {
    //         swal("Sorry - you're browser doesn't support the FileReader API");
    //     }
    // }
    //
    // $uploadCropLogo = $('#upload-logo-demo').croppie({
    //     viewport: {
    //         width: 250,
    //         height: 250,
    //         type: 'square'
    //     },
    //     customClass: 'image_logo',
    //     enableExif: true
    // });
    // $('#upload-logo').on('change', function () {
    //     $('#logo-preview').removeClass('display-none');
    //     $('.upload-demo-logo-wrap').removeClass('display-none');
    //     $('.upload-logo-result').show();
    //     readLogoFile(this);
    // });
    // $('#upload-logo-demo').on('update.croppie', function (ev, cropData) {
    //     $('#upload-logo-demo').croppie('result', {
    //         type: 'canvas',
    //         size: 'viewport'
    //     }).then(function (resp) {
    //         localStorage.setItem('logo_path', resp);
    //         $('.demo-upload-wrap a.file-btn span').text('Select New Logo');
    //         $('.post-branding-logo-img').attr('src',resp);
    //         $('.has_solid_toggle').css('display','block');
    //     });
    // });
    $('.upload-logo-result').on('click', function (ev) {
        $uploadCropLogo.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {
            jQuery.ajax({
                url: "<?php echo get_stylesheet_directory_uri() ?>/ajax/upload_image.php",
                data: {"image": resp},
                type: "POST",
                success: function (data) {
                    if (data !== 'Failed') {
                        localStorage.setItem('logo_path', data);
                        $('.upload-demo-logo-wrap').addClass('display-none');
                        $('#logo-preview').removeClass('display-none');
                        $('.upload-logo-result').hide();
                        $('#logo-preview').html('<img src="' + data + '">');
                        $('.post-branding-logo-img').attr('src', data);
                    }
                    jQuery('#upload-logo').val('');
                }
            });
        });
    });

    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function () {
            $('.upload-logo-demo').addClass('ready');
            $('#logo-preview').addClass('display-none');
            var output = document.getElementById('upload-logo-demo');
            output.src = reader.result;
            localStorage.setItem('logo_path', reader.result);
            $('.demo-upload-wrap a.file-btn span').text('Select New Logo');
            $('.post-branding-logo-img').attr('src', reader.result);
            $('.has_solid_toggle').css('display', 'block');
            $('.bar-style-e .post-branding-logo').css('display', 'none');
            $('.bar-style-f .post-branding-logo').css('display', 'none');
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    $('.has-solid-toggle').change(function () {
        if ($('.has-solid-toggle').is(":checked")) {
            $("#upload-logo-demo").addClass('img-solid-white');
            $('.post-branding-logo-img').addClass('img-solid-white');
        } else {
            $("#upload-logo-demo").removeClass('img-solid-white');
            $('.post-branding-logo-img').removeClass('img-solid-white');
        }
    });
    $('#customSwitch1').change(function () {
        if ($('#customSwitch1').is(":checked")) {
            $('.preview-grid .post-image').css('display', 'block');
            $('.preview-grid .scaled-preview').css('margin-top', '-50px');
        } else {
            $('.preview-grid .post-image').css('display', 'none');
            $('.preview-grid .scaled-preview').css('margin-top', '0px');
        }
    })
    $('#includePortrait').change(function () {
        if ($('#includePortrait').is(":checked")) {
            $('.post-branding-avatar').css('display', 'block');
            $('.bar-style-e .post-branding-logo').css('display', 'none');
            $('.bar-style-f .post-branding-logo').css('display', 'none');
        } else {
            $('.post-branding-avatar').css('display', 'none');
            $('.bar-style-e .post-branding-logo').css('display', 'block');
            $('.bar-style-f .post-branding-logo').css('display', 'block');
        }
    })
    /* Create Branding Bar Btn */
    $("#CreateBtn").on('click', function () {
        $('.modal-body').html('');
        var node = document.getElementById('PreviewContainer');
        domtoimage.toSvg(node)
            .then(function (dataUrl) {
                var img = new Image();
                img.src = dataUrl;
                $('.modal-body').append('<p class="lead">Please review your rendered branding bar graphic below</p>');
                $('.modal-body').append(img);
                // Display Modal
                var modal = document.getElementById("myModal");
                modal.style.display = "block";
                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("btn-close")[0];

                // When the user clicks the button, open the modal
                modal.style.display = "block";
                // When the user clicks on <span> (x), close the modal
                span.onclick = function () {
                    $('#myModal').slideUp('900');
                }
                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function (event) {
                    if (event.target == modal) {
                        $('#myModal').slideUp('900');
                    }
                }
            })
            .catch(function (error) {
                console.error('oops, something went wrong!', error);
            });
    });
    
    $('#branding-save').click(function () {
        $('#branding-save').prop('disabled', true);
        $('#branding-save').html('Saving...');
        var node = document.getElementById('PreviewContainer');
        
        const scale = 1500 / node.offsetWidth;
        domtoimage.toPng(node, {
            height: node.offsetHeight * scale,
            width: node.offsetWidth * scale,
            style: {
                transform: "scale(" + scale + ")",
                transformOrigin: "top left",
                width: node.offsetWidth + "px",
                height: node.offsetHeight + "px"
            }
        })
            .then(dataUrl => {
                this.baseData = dataUrl;
                save_img(this.baseData);
            })
            .catch(error => {
                console.error("oops, something went wrong!", error);
            });
    })

    //to save the canvas image
    function save_img(data) {
        //ajax method.
        $.post('<?php echo get_stylesheet_directory_uri() ?>/ajax/create_image.php',
            {data: data},
            function (res) {
                //if the file saved properly, trigger a popup to the user.
                if (res == 'success') {
                    //show branding bar in the modal popup
                    window.location.replace("<?php echo site_url() ?>/branding");
                } else {
                    alert('something wrong');
                }
            });
    }

    $('#linetext-font').change(function () {
        switch ($(this).val()) {
            case 'font-set-1':
                $('.post-branding-line1').css({fontFamily: "'Montserrat',sans-serif", fontSize: "45px"});
                break;
            case 'font-set-2':
                $('.post-branding-line1').css({fontFamily: "'Poppins', sans-serif", fontSize: "45px"});
                break;
            case 'font-set-3':
                $('.post-branding-line1').css({fontFamily: "'Playfair Display', serif", fontSize: "45px"});
                break;
            case 'font-set-4':
                $('.post-branding-line1').css({fontFamily: "'Oswald', sans-serif", fontSize: "52px"});
                break;
            case 'font-set-5':
                $('.post-branding-line1').css({
                    fontFamily: "'Yellowtail', cursive",
                    fontSize: "53px",
                    marginBottom: "12px"
                });
                break;
            default:
            // code block
        }
    })
    $('#previewlinetext-font').change(function () {
        switch ($(this).val()) {
            case 'font-set-1':
                $('.post-branding-line1').css({fontFamily: "'Montserrat',sans-serif", fontSize: "45px"});
                break;
            case 'font-set-2':
                $('.post-branding-line1').css({fontFamily: "'Poppins', sans-serif", fontSize: "45px"});
                break;
            case 'font-set-3':
                $('.post-branding-line1').css({fontFamily: "'Playfair Display', serif", fontSize: "45px"});
                break;
            case 'font-set-4':
                $('.post-branding-line1').css({fontFamily: "'Oswald', sans-serif", fontSize: "52px"});
                break;
            case 'font-set-5':
                $('.post-branding-line1').css({
                    fontFamily: "'Yellowtail', cursive",
                    fontSize: "53px",
                    marginBottom: "12px"
                });
                break;
            default:
            // code block
        }
    })

    function tabSwitch(elem) {
        $('#' + elem).click();
    }
</script>
