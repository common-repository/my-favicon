<?php
/*
Plugin Name: BleuT FavIcon
Description: "BleuT FavIcon" plugin allows you simply customise your site's favicon by uploading an image file
Author: Jamel Zarga
Version: 1.0
Author URI: https://www.facebook.com/jameleddine.zarga

*/

//create directory 'uploads/my-favicon' if not exists
register_activation_hook(__FILE__,function(){
	$upload_dir = wp_upload_dir();
	$fav_dir=$upload_dir['basedir'].'/my-favicon';
	//if dont exists
	if(!file_exists($fav_dir)){
		//create dir
		mkdir($fav_dir,0777);
	}
 
});

if ( is_admin() )
	require_once dirname( __FILE__ ) . '/admin-page.php';


function BleuT_favicon() {
 $upload_dir = wp_upload_dir();

?>
	<link rel="shortcut icon" href="<?php echo $upload_dir['baseurl'].'/my-favicon/favicon.png'; ?>" > 
<?php 
}
add_action('wp_head', 'BleuT_favicon',1);
