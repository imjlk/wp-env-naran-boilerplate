<?php
/**
 * Plugin Name:       Naran Boilerplate Code
 * Plugin URI:        https://github.com/chwnam/naran-boilerplate-code
 * Description:       Naran boilerplate code for WordPress plugins/themes.
 * Version:           1.6.0-dev
 * Requires at least: 5.0.0
 * Requires PHP:      8.0
 * Author:            changwoo
 * Author URI:        https://blog.changwoo.pe.kr/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:
 * Text Domain:       nbpc
 * Domain Path:       /languages
 * CPBN Version:      1.6.0
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

const NBPC_MAIN_FILE = __FILE__;
const NBPC_VERSION   = '1.6.0-dev';
const NBPC_PRIORITY  = 100;

nbpc();
