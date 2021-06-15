<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* TREETHEMES */ 
if (!function_exists('treethemes_vc_modules_templates_for_vc') && defined('HAZEL_PLG_PATH')) require_once(HAZEL_PLG_PATH."lib/treethemes-vc-modules/treethemes-vc-modules-templates.php");
treethemes_vc_modules_templates_for_vc();
