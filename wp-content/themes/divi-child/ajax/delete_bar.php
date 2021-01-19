<?php
require_once('../../../../wp-load.php');
global $wpdb;
$logged_in_user = get_current_user_id();
$postId = $_POST['postID'];
$imgPath = $_POST['imgPath'];
// delete the current bar
$res_delete = $wpdb->delete( 'E6h_users_branding_bars', array( 'id' => $postId ) );

if( $res_delete === false ){
  echo 'failed';
  // error_log( 'my error');
} else {
    unlink($imgPath);
  echo 'success';
}
