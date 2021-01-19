<?php
require_once('../../../../wp-load.php');
global $wpdb;
$logged_in_user = get_current_user_id();
$data = $_POST['data'];
$image_type = $_POST['image_type'];
list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);


$data = base64_decode($data);

$uploaddir = wp_get_upload_dir()['basedir'].'/users_branding_bars/';

if (!is_dir($uploaddir)) {
  mkdir($uploaddir, 0777, true);
}
$time = date_timestamp_get(date_create());
$name = 'FaisalAli-'.$time.".png";
$uploadfile = $uploaddir.$name;

if(file_put_contents($uploadfile, $data)){
  echo 'success';
} else {
  echo 'Failed';
}