<?php

add_action('admin_init','load_bedit_script');
add_action('init','load_bedit_script');
add_action('admin_init','create_fontfaces_css');
add_action('init','create_fontfaces_css');
// add bedit.js to admin-header.php
// and enable Uyghur input

function load_bedit_script () {
	wp_register_script('bEdit', WP_CONTENT_URL . '/languages/bedit.js');
	wp_enqueue_script('bEdit');
return;
}

function create_fontfaces_css () {
	$cssFile = dirname(dirname(__FILE__)). '/languages/fontfaces.css';

	if (file_exists($cssFile)){
		$cssContent = file_get_contents($cssFile, NULL, NULL, 40, 0);
		$pos = strpos($cssContent, "font-face settings for WordPress 3.4");
		if ($pos === false) {
			unlink($cssFile) or die("[$cssFile] ni ochurgili bolmidi.\n");
		}
	}
	if (!file_exists($cssFile)) {
		$baseFile = basename($_SERVER['PHP_SELF']);
		if( strcmp($baseFile, 'install.php') == 0 )
			$wpUrl = 'http://' . $_SERVER['HTTP_HOST'] . str_replace('wp-admin/install.php','',$_SERVER['PHP_SELF']);
		else if( strcmp($baseFile, 'update-core.php') == 0 )
			$wpUrl = 'http://' . $_SERVER['HTTP_HOST'] . str_replace('wp-admin/update-core.php','',$_SERVER['PHP_SELF']);
		else if( strcmp($baseFile, 'wp-login.php') == 0 )
			$wpUrl = 'http://' . $_SERVER['HTTP_HOST'] . str_replace('wp-login.php','',$_SERVER['PHP_SELF']);
		else 
			$wpUrl = get_bloginfo('wpurl') . '/';
		
		$wpUrl .= 'wp-content/languages/UKIJTuT.';

		$hndFile = fopen($cssFile, 'w') or die("wp-content/languages/fontfaces.css ni qurghili bolmidi.");
		$stringData = '/* font-face settings for WordPress 3.4 */' . "\n" . '/* Generated by Font Squirrel on September 16, 2011. Prepared by Uyghur Translation Team */' . "\n\n";
    	$stringData .= '@font-face {' . "\n\t" . 'font-family:\'UKIJ Tuz Tom\';' . "\n";
		$stringData .= "\t" . 'src:url(\'' . $wpUrl . 'eot\');' . "\n";
		$stringData .= "\t" . 'src:local(\'UKIJ Tuz Tom\'),url(\'' . $wpUrl . 'ttf\') format(\'truetype\'),' . "\n";
		$stringData .= "\t\t" . 'url(\'' . $wpUrl . 'eot?#iefix\') format(\'embedded-opentype\'),' . "\n";
		$stringData .= "\t\t" . 'url(\'' . $wpUrl . 'woff\') format(\'woff\'),' . "\n";
		$stringData .= "\t\t" . 'url(\'' . $wpUrl . 'svg#UKIJTuzTomRegular\') format(\'svg\');' . "\n";
		$stringData .= "\t" . 'font-weight: normal;' . "\n\t" . 'font-style: normal;' . "\n" . '}' . "\n";
		fwrite($hndFile, $stringData);
		fclose($hndFile);
	}

	$cssFontFile = WP_CONTENT_URL . '/languages/fontfaces.css';
	wp_register_style('fontFaces', $cssFontFile);
	wp_enqueue_style( 'fontFaces');
}
function PluginUrl() {

        //Try to use WP API if possible, introduced in WP 2.6
        if (function_exists('plugins_url')) return trailingslashit(plugins_url(basename(dirname(__FILE__))));

        //Try to find manually... can't work if wp-content was renamed or is redirected
        $path = dirname(__FILE__);
        $path = str_replace("\\","/",$path);
        $path = trailingslashit(get_bloginfo('wpurl')) . trailingslashit(substr($path,strpos($path,"wp-content/")));
        return $path;
    }

?>