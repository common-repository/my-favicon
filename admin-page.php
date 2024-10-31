<?php

/*
	this page deal with the plugin admin page (settings)
*/

//add a menu page to the theme menu

add_action('admin_menu','bluet_favicon_add_menu');

function bluet_favicon_add_menu(){
	add_theme_page('Favicon settings','My Favicon * (BlueT)', 'manage_options','bluet-favicon','bluet_favicon_settings');
}

function bluet_favicon_settings(){
	$upload_dir = wp_upload_dir(); 
	
	$uploaddir = $upload_dir['basedir'].'/my-favicon/';
	$uploadfile = $uploaddir.'favicon.png';
	
	//adding img file process

	if($_FILES['favicon_file']['name'] && preg_match('(image)i',$_FILES['favicon_file']['type']) && $_FILES['favicon_file']['error']!=2){
	
			
		/*delete dir content*/
		// Open the directory
		$dirHandle = opendir($uploaddir); 
		// Loop over all of the files in the folder
		while ($file = readdir($dirHandle)) { 
			// If $file is NOT a directory remove it
			if(!is_dir($file)) { 
				unlink ("$uploaddir"."$file"); // unlink() deletes the files
			}
		}
		// Close the directory
		closedir($dirHandle); 
		/*end delete*/
		

		if (move_uploaded_file($_FILES['favicon_file']['tmp_name'], $uploadfile)) {
			echo '<div class="updated" style="font-size:1.2em;"><b>Update done with success ;)</b></div>';
		} else {
			echo '<div class="error" style="font-size:1.2em;">Error tray again !</div>';
		}

	}else{
		echo '<div class="error" style="font-size:1.2em;">Please choose a small size image file !</div>';
	}
	?>
	<div class="wrap">
	<h2>
	<img src="<?php echo $upload_dir['baseurl'].'/my-favicon/favicon.png';?>" width="50" height="50">
	Favicon settings page (<a href="http://profiles.wordpress.org/lebleut">BlueT</a>)</h2>
	
	<div class="update-nag">This page allows you to change your site's Favicon by uploading a custom image file (.png .jpg .gif .ico) :)
	<br>(<b>For any support</b> please contact me at <a href="mailto:lebleut@gmail.com?subject=Bluet Favicon support">lebleut@gmail.com</a>)</div>
	
	<h3>Current Favicon :</h3>	

	<img src="<?php echo $upload_dir['baseurl'].'/my-favicon/favicon.png';?>" />
	
	<h3>Upload a new Favicon :</h3>
	<form  enctype="multipart/form-data"  method="post" action="<?php echo get_admin_url(); ?>themes.php?page=bluet-favicon">
		<input type="hidden" name="MAX_FILE_SIZE" value="60000" />
		<input type="file" name="favicon_file" />
		<?php submit_button('Save this new one');?>

	</form>
	<div class="error" style="font-size:1.2em;"><b>(!) if the new Favicon doesn't appear on the front pages, use "F5" or "Maj+F5" keys to refresh the page.	</b></div>
	<div>Other useful Plugin : <a href="http://wordpress.org/plugins/bluet-keywords-tooltip-generator/">Keywords Tooltip Generator</a></div>
	</div>
	<?php
	
}
