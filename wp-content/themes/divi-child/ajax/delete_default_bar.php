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
  $get_bars = $wpdb->get_results("SELECT * FROM E6h_users_branding_bars where user_id = $logged_in_user ORDER BY id DESC limit 1 ");
  
  $data = array(
    'is_default' => 1,
  );
  
  $where = array(
    'id' => $get_bars[0]->id,
    'user_id' => $logged_in_user
  );
  $wpdb->update("E6h_users_branding_bars", $data, $where );
  unlink($imgPath);
  echo 'success';
}
