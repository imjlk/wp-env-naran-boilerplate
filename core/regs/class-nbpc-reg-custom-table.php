<?php
/**
 * NBPC: Custom table reg.
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NBPC_Reg_Custom_Table' ) ) {
	class NBPC_Reg_Custom_Table implements NBPC_Reg {
		public string $table;

		public array $fields;

		public array $index;

		public string $engine;

		public string $charset;

		public string $collate;

		/**
		 * Constructor method
		 *
		 * @param string $table
		 * @param array  $fields
		 * @param array  $index
		 * @param string $engine
		 * @param string $charset
		 * @param string $collate
		 */
		public function __construct(
			string $table,
			array $fields,
			array $index = [],
			string $engine = 'InnoDB',
			string $charset = '',
			string $collate = ''
		) {
			$this->table   = $table;
			$this->fields  = $fields;
			$this->index   = $index;
			$this->engine  = $engine;
			$this->charset = $charset;
			$this->collate = $collate;
		}

		public function register( $dispatch = null ): void {
			$this->create_table();
		}

		public function unregister(): void {
			$this->drop_table();
		}

		public function create_table(): void {
			global $wpdb;

			$fields  = implode( ",\n  ", $this->fields );
			$index   = implode( ",\n  ", $this->index );
			$charset = $this->charset ?: $wpdb->charset;
			$collate = $this->collate ?: $wpdb->collate;

			if ( $fields ) {
				$sql = "CREATE TABLE IF NOT EXISTS `$this->table` (\n  $fields";
				if ( $index ) {
					$sql .= ",\n  $index";
				}
				$sql .= "\n) ENGINE=$this->engine DEFAULT CHARSET=$charset COLLATE=$collate;";

				dbDelta( $sql );
			}
		}

		public function drop_table(): void {
			global $wpdb;

			// phpcs:ignore WordPress.DB.DirectDatabaseQuery.SchemaChange, WordPress.DB.PreparedSQL.InterpolatedNotPrepared, WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.DirectDatabaseQuery.DirectQuery
			$wpdb->query( "DROP TABLE IF EXISTS $this->table" );
		}
	}
}
