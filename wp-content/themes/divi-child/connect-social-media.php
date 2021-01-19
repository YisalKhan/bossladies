<?php 
/**
 * @template
 * Template Name: Social Media Profiles
 */
global $wpdb;
if(!is_user_logged_in()) {
	wp_redirect(site_url(), 301);
  exit();
}
get_header();
if(!defined(THEME_IMG_PATH)){
	define( 'THEME_IMG_PATH', get_stylesheet_directory_uri() . '/assets/images' );
}
if(isset($_GET["platform"])) {
	$wpdb->insert("user_social_profile", array(
		"user_id" => get_current_user_id(),
		"platform" => $_GET["platform"],
		"social_user_id" => $_GET["social_id"],
		"social_user_name" => $_GET["social_name"],
		"social_user_picture" => $_COOKIE['profileImage'],
		"token" => $_GET["token"]
	));
	unset($_COOKIE['profileImage']); 
  setcookie('profileImage', null, -1, '/'); 
	 ?>
	<script>
		window.history.replaceState(null, null, window.location.pathname);
	</script>
<?php }
	$user_id = get_current_user_id();
	$platform_facebook = 'facebook';
	$profile_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM user_social_profile WHERE user_id = %s AND platform =%s", array($user_id, $platform_facebook)));
	// print_r($profile_data);

?>

<script>
	var facebookAccessToken;
	window.fbAsyncInit = function() {
    FB.init({
      appId      : '225178252437467',
      cookie     : true,
      xfbml      : true,
      version    : 'v9.0'
    });
  };

  function facebookLogin() {
  	FB.login((response) => {
			if (response.authResponse) {
				statusChangeCallback(response);
			}
		}, {scope: 'email,public_profile', return_scopes: true});
  }

  function statusChangeCallback(response) {
    if (response.status === 'connected') {
    	// console.log(response);
    	facebookAccessToken = response.authResponse.accessToken;
      facebookConnectAPI();  
    } else {
      document.getElementById('status').innerHTML = 'Please log ' + 'into this webpage.';
    }
  }

  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
 
  function facebookConnectAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
    	console.log(response);
    	FB.api(response.id+'/picture?redirect=false', function(res) {
    		console.log(res);
    		document.cookie = "profileImage="+res.data.url;
    		var url = window.location.href;
    		url = url+'?platform=facebook&social_id='+response.id+'&social_name='+response.name+'&user_image='+res.data.url+'&token='+facebookAccessToken;
    		console.log(url);
    		window.location=url;
    	});
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
    });
  }

</script>

	<div id="main-content">
		<div class="container" role="main">
			<div id="content-area" class="clearfix">
				<div class="header">
          <div class="header-body">
            <div class="row align-items-center">
              <div class="col-lg">
                <h6 class="header-pretitle">Boss Ladies of Real Estate</h6>
                <h1 class="header-title entry-title main_title"><?php the_title() ?></h1>
              </div>
            </div>
          </div>
        </div>
        <div class="binding-context" id="binding-context">
        	<h2 style="font-size: 1.25rem;">
        		<img src="<?php echo THEME_IMG_PATH; ?>/facebook.png" style="width:20px;">
        		Facebook Pages
        	</h2>
        	<div class="card archive-text">
        		<?php if(isset($profile_data) && $profile_data != null) {
        			foreach ($profile_data as $key => $value) {
        		 ?>
        		<div class="card-body">
	            <div class="card-text text-center lead">
	              	<div class="row profile-data">
	              		<div class="col-md-3">
			              	<img src="<?php echo $value->social_user_picture; ?>" alt="facebook-profile-image">
	              		</div>
	              		<div class="col-md-6" style="width: 85%; text-align: left; padding: 10px;">
			              	<h5><?php echo $value->social_user_name; ?></h5>
	              		</div>
	              		<div class="col-md-3">
	              			<button type="button" data-bind="click:$root.removeLinkedIn" class="btn btn-link text-decoration-none text-secondary" title="Remove Profile">Delete</button>
	              		</div>
		              </div>
	            </div>
	          </div>
          </div>
          <p class="text-secondary mx-auto" style="max-width: 420px;">
            If you need to add, update, or reconnect facebook pages, use the "Reconnect Facebook" button below.
          </p>
          <div style="text-align: center;">
            <button type="button" class="btn btn-info" data-bind="click:connectFacebook">Reconnect Facebook</button>
            <button type="button" class="btn btn-info" onclick="facebookLogin()">Connect Another Facebook</button>
          </div>
	        	<?php	} 
	        } else {
	        		?>
	        <div class="card archive-text">
	          <div class="card-body">
	            <div class="card-text text-center lead">
	              You do not have any connected facebook pages
	            </div>
	          </div>
	        <?php } ?>
	        </div>
	        <div class="mt-4 text-center">
	        	<?php if(isset($profile_data) && $profile_data != null) {
	        	} else {
	        		?>
	          <div class="mt-4 text-center">
		          <button type="button" class="btn btn-info" onclick="facebookLogin()">Connect Facebook</button>
		        </div>
	        	<?php } ?>
	        </div>
	        <hr class="my-4 my-md-5">
	        <h2 style="font-size: 1.25rem;">
        		<img src="<?php echo THEME_IMG_PATH; ?>/linkedin.png" style="width:20px;">
        		LinkedIn
        	</h2>
        	<div class="card archive-text">
	          <div class="card-body">
	            <div class="card-text text-center lead">
	              You do not have any connected LinkedIn profiles
	            </div>
	          </div>
	        </div>
	        <div class="mt-4 text-center">
	          <button type="button" class="btn btn-info" data-bind="click:connectFacebook">Connect LinkedIn</button>
	        </div>
	        <hr class="my-4 my-md-5">
	        <h2 style="font-size: 1.25rem;">
        		<img src="<?php echo THEME_IMG_PATH; ?>/twitter.png" style="width:20px;">
        		Twitter
        	</h2>
        	<div class="card archive-text">
	          <div class="card-body">
	            <div class="card-text text-center lead">
	              You do not have any connected Twitter profiles
	            </div>
	          </div>
	        </div>
	        <div class="mt-4 text-center">
	          <button type="button" class="btn btn-info" data-bind="click:connectFacebook">Connect Twitter</button>
	        </div>
	        <hr class="my-4 my-md-5">
        </div>
			</div>
		</div>
	</div>



<?php get_footer(); ?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId=225178252437467&autoLogAppEvents=1" nonce="V9QX0TIq"></script>
<!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script> -->
