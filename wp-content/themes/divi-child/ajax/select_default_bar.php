<?php
require_once('../../../../wp-load.php');
global $wpdb;
$logged_in_user = get_current_user_id();
$postId = $_POST['postID'];

// Update the all bar statuses to 0
$wpdb->update(
  'E6h_users_branding_bars',
  array(
    'is_default' => '0',
  ),
  array( 'user_id' => $logged_in_user )
);

// Now update the current bar
$data = array(
  'is_default' => 1,
);

$where = array(
  'id' => $postId,
  'user_id' => $logged_in_user
);

$res_update = $wpdb->update("E6h_users_branding_bars", $data, $where );

if( $res_update === false ){
  echo 'failed';
  // error_log( 'my error');
} else {
  echo 'success';
}
