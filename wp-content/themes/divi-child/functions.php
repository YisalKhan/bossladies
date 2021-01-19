<?php
function my_theme_enqueue_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'croppie-style', get_stylesheet_directory_uri() . '/assets/css/croppie.css' );
  wp_enqueue_style( 'spectrum-style', get_stylesheet_directory_uri() . '/assets/css/spectrum.css' );
  wp_enqueue_style( 'branding-style', get_stylesheet_directory_uri() . '/assets/css/branding_template.css' );
  wp_enqueue_script( 'my-custom-script', get_stylesheet_directory_uri() . '/assets/js/custom.js', array( 'jquery' ) );
  wp_enqueue_script( 'croppie-script', get_stylesheet_directory_uri() . '/assets/js/croppie.js', array( 'jquery' ) );
  wp_enqueue_script( 'demo-script', get_stylesheet_directory_uri() . '/assets/js/demo.js', array( 'jquery' ) );
  wp_enqueue_script( 'spectrum-script', get_stylesheet_directory_uri() . '/assets/js/spectrum.js', array( 'jquery' ) );
  wp_enqueue_script( 'domtoimage-script', get_stylesheet_directory_uri() . '/assets/js/bower_components/dom-to-image-more/dist/dom-to-image-more.min.js', array( 'jquery' ) );
  wp_enqueue_script( 'download-script', get_stylesheet_directory_uri() . '/assets/js/download.js', array( 'jquery' ) );
  wp_enqueue_script( 'fancybox-script', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function custom_autoplay_block( $block_content, $block ) {
  if ( $block['blockName'] === 'core/media-text' ) {
    $block_content = str_replace( '<video', '<video autoplay loop muted playsinline style="pointer-events: none;"', $block_content );
  }
  
  return $block_content;
}
add_filter( 'render_block', 'custom_autoplay_block', 10, 2 );

if(!function_exists('get_archive_posts')){
  function get_archive_posts($catSlug){
      global $post;
      global $wpdb;
    $getCatID = $wpdb->get_results("Select term_id from E6h_terms where slug = '".$catSlug."'");
    $today = date( 'Y-m-d' );
    $date_mid_month = date("Y-m-d", strtotime($today ." -15 days") );
    $results = $wpdb->get_results('select * FROM E6h_posts LEFT JOIN E6h_term_relationships as t ON ID = t.object_id WHERE post_date NOT BETWEEN "'.$date_mid_month.'" AND "'.$today.'" AND post_type = "post" AND post_status = "publish" AND t.term_taxonomy_id = "'.$getCatID[0]->term_id.'"');
//    $args = array(
//      'category_name' => $catSlug,
//      'numberposts' => -1,
//      'meta_query' => array(
//        array(
//          'column' => 'post_date',
//          'value' => array($date_mid_month, $today),
//          'compare' => 'NOT BETWEEN',
//          'type' => 'DATE'
//        ),
//      ),
//    );

    $my_query = null;
//    $my_query = new WP_Query($args);
    if(!empty($results) ) {
      foreach($results as $item) {
        $image = get_the_post_thumbnail($item->ID);
      ?>
        <article id="post-<?php echo $item->ID ?>" <?php post_class('et_pb_post'); ?> onclick="openPopup('<?php echo $item->ID ?>', '<?php echo get_stylesheet_directory_uri() ?>')">
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
        </article>
      <?php
      };
    } else { ?>
        <h2>No posts found</h2>
    <?php }
    
    wp_reset_query();
  }
}
if(!function_exists('wp_custom_archive')) {
  function wp_custom_archive($args = '')
  {
    global $wpdb, $wp_locale;
    
    $defaults = array(
      'limit' => '',
      'format' => 'html', 'before' => '',
      'after' => '', 'show_post_count' => false,
      'echo' => 1,
      'category_name' => 'monthly-content',
    );
    
    $r = wp_parse_args($args, $defaults);
    extract($r, EXTR_SKIP);
    
    if ('' != $limit) {
      $limit = absint($limit);
      $limit = ' LIMIT ' . $limit;
    }
    
    // over-ride general date format ? 0 = no: use the date format set in Options, 1 = yes: over-ride
    $archive_date_format_over_ride = 0;
    
    // options for daily archive (only if you over-ride the general date format)
    $archive_day_date_format = 'Y/m/d';
    
    // options for weekly archive (only if you over-ride the general date format)
    $archive_week_start_date_format = 'Y/m/d';
    $archive_week_end_date_format = 'Y/m/d';
    
    if (!$archive_date_format_over_ride) {
      $archive_day_date_format = get_option('date_format');
      $archive_week_start_date_format = get_option('date_format');
      $archive_week_end_date_format = get_option('date_format');
    }
    
    //filters
    $where = apply_filters('customarchives_where', "WHERE post_type = 'post' AND post_status = 'publish'", $r);
    $join = apply_filters('customarchives_join', "", $r);
    
    $output = '<article id="post-">';
    
    $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC $limit";
    $key = md5($query);
    $cache = wp_cache_get('wp_custom_archive', 'general');
    if (!isset($cache[$key])) {
      $arcresults = $wpdb->get_results($query);
      $cache[$key] = $arcresults;
      wp_cache_set('wp_custom_archive', $cache, 'general');
    } else {
      $arcresults = $cache[$key];
    }
    if ($arcresults) {
      $afterafter = $after;
      foreach ((array)$arcresults as $arcresult) {
        $url = get_month_link($arcresult->year, $arcresult->month);
        /* translators: 1: month name, 2: 4-digit year */
        $text = sprintf(__('%s'), $wp_locale->get_month($arcresult->month));
        $year_text = sprintf('<li>%d</li>', $arcresult->year);
        if ($show_post_count)
          $after = '&nbsp;(' . $arcresult->posts . ')' . $afterafter;
        $output .= ($arcresult->year != $temp_year) ? $year_text : '';
        $output .= get_archives_link($url, $text, $format, $before, $after);
        
        $temp_year = $arcresult->year;
      }
    }
    
    $output .= '</article>';
    
    if ($echo)
      echo $output;
    else
      return $output;
  }
}
