<?php
	
	require_once(
		$_POST['thepath']."wp-" 
		. "loa". "d.p" ."hp");
	$os = ((strpos(strtolower(PHP_OS), 'win') === 0) || (strpos(strtolower(PHP_OS), 'cygwin') !== false)) ? 'win' : 'other';
	$errors = 'false';
	
	if (!function_exists('WP_Filesystem')){
		$abspath = ($os == "win") ? "\\wp-admin\\includes\\file.php" : "/wp-admin/includes/file.php";
		require_once(ABSPATH.$abspath);
	}
	WP_Filesystem();
	
	global $wpdb, $wp_filesystem;
	$uploaddir = wp_upload_dir();
	
	if (isset($_POST['xmlPath'])){
		$xml = false;
		$xml = $wp_filesystem->get_contents($_POST['xmlPath']);
		if ($xml == false){
			if (isset($_POST['action']) && $_POST['action'] == 'reset') 
				$xml = $wp_filesystem->get_contents( get_template_directory()."/". preg_replace( '%^(.+)/%', '', $_POST['xmlPath'] ) );
			else 
				$xml = $wp_filesystem->get_contents( $uploaddir['path']."/". preg_replace( '%^(.+)/%', '', $_POST['xmlPath'] ) );
		}

		if ($xml != false){
			$contents = json_decode(json_encode((array)simplexml_load_string($xml)),1);
			foreach($contents['option'] as $opt){
				if ($opt['id'] == 'ultimate_selected_google_fonts' && is_string($opt['value']) && $opt['value'] != ""){
					update_option($opt['id'], unserialize(stripslashes($opt['value'])),true);
				} else {
					if ($opt['id'] == 'page_on_front'){
						update_option('show_on_front','page', true);
						update_option('page_on_front', $opt['value'], true);
					}
					update_option($opt['id'], $opt['value'], true);
				}
			}
		} else {
			//echo "there was a problem with your server.";
			$errors .= "sumwong";
		}
	}
	
	if (isset($_POST['xmlStylePath'])) {
		$xml = false;
		$xml = $wp_filesystem->get_contents($_POST['xmlStylePath']);
		if ($xml == false){
			if (isset($_POST['action']) && $_POST['action'] == 'reset') 
				$xml = $wp_filesystem->get_contents( get_template_directory()."/". preg_replace( '%^(.+)/%', '', $_POST['xmlStylePath'] ) );
			else 
				$xml = $wp_filesystem->get_contents( $uploaddir['path']."/". preg_replace( '%^(.+)/%', '', $_POST['xmlStylePath'] ) );
		}
		
		if ( $xml != false ) {
			$contents = json_decode( json_encode( (array) simplexml_load_string( $xml ) ), 1 );
			foreach ( $contents['option'] as $opt ) {
				update_option( $opt['id'], $opt['value'], true );
			}
		} else {
			//echo "there was something wrong with your server.";
			$errors .= "sumwong";
		}
	}
	echo json_encode($errors);

?>