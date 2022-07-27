<?php
/**
 * Plugin Name: Города и строения
 * Plugin URI: studio-av.com
 * Description: Плагин для тестового задания. Добавляет города и строения
 * Version: 1.0.0
 * Author: Vladimir Yanchuk
 * Author URI: https://studio-av.com/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AFCP_DIR', plugin_dir_path( __FILE__ ) );
define( 'AFCP_URI', plugin_dir_url( __FILE__ ) );

require AFCP_DIR . 'inc/Estate_Core.php';

if (!function_exists('estate')){
	function estate() {

		return Estate_Core::instance();
	}

	estate();
}
