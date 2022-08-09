<?php
/**
 * Naran Boilerplate Core
 *
 * abstracts/registers/abstract-nbpc-register-base-wp-cli.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NBPC_Register_Base_WP_CLI' ) ) {
	abstract class NBPC_Register_Base_WP_CLI implements NBPC_Register {
		use NBPC_Hook_Impl;

		/**
		 * Constructor method.
		 */
		public function __construct() {
			if ( defined( 'WP_CLI' ) && WP_CLI ) {
				$this->add_action( 'plugins_loaded', 'register' );
			}
		}

		/**
		 * @return void
		 *
		 * @throws Exception Thrown from WP_CLI.
		 */
		public function register(): void {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof NBPC_Reg_WP_CLI ) {
					$item->register();
				}
			}
		}
	}
}
