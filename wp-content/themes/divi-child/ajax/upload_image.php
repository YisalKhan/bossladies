<?php
require_once('../../../../wp-load.php');
$user_id=get_current_user_id();
global $wpdb;
$data = $_POST['image'];
$image_type = $_POST['image_type'];
list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);


$data = base64_decode($data);

$uploaddir = wp_get_upload_dir()['basedir'].'/users_branding_bars/';

if (!is_dir($uploaddir)) {
  mkdir($uploaddir, 0777, true);
}
$time = date_timestamp_get(date_create());
$name = $time.".png";
$uploadfile = $uploaddir.$name;

if(file_put_contents($uploadfile, $data)){
  echo site_url().'/wp-content/uploads/users_branding_bars/'.$name;
} else {
  echo 'Failed';
}

?>
