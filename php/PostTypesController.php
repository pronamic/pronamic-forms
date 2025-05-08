<?php
/**
 * Post types controller
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

namespace Pronamic\PronamicForms;

/**
 * Post types controller class
 */
final class PostTypesController {
	/**
	 * Setup.
	 * 
	 * @return void
	 */
	public function setup() {
		\add_action( 'init', $this->init( ... ) );

		\add_filter( 'manage_pronamic_submission_posts_columns', $this->manage_posts_columns( ... ) );
		\add_action( 'manage_pronamic_submission_posts_custom_column', $this->manage_posts_custom_column( ... ), 10, 2 );
	}

	/**
	 * Init.
	 * 
	 * @return void
	 */
	private function init() {
		\register_post_type(
			'pronamic_submission',
			[
				'label'        => \__( 'Submissions', 'pronamic-forms' ),
				'show_ui'      => true,
				'menu_icon'    => 'dashicons-feedback',
				'show_in_rest' => true,
				'supports'     => [
					'title',
					'editor',
					'revisions',
				],
			]
		);
	}

	/**
	 * Manage posts columns.
	 * 
	 * @link https://developer.wordpress.org/reference/hooks/manage_post_type_posts_columns/
	 * @param array $columns Columns.
	 * @return array
	 */
	private function manage_posts_columns( $columns ) {
		$columns['pronamic_submission_origin'] = \__( 'Origin', 'pronamic-forms' );

		$new_columns = [];

		foreach ( $columns as $name => $label ) {
			$new_columns[ $name ] = $label;

			if ( 'title' === $name ) {
				$new_columns['pronamic_submission_origin'] = $columns['pronamic_submission_origin'];
			}
		}

		$columns = $new_columns;

		return $columns;
	}

	/**
	 * Manage posts custom column.
	 * 
	 * @link https://developer.wordpress.org/reference/hooks/manage_post-post_type_posts_custom_column/
	 * @param string $column_name Column name.
	 * @param int    $post_id     Post ID.
	 * @return void
	 */
	private function manage_posts_custom_column( $column_name, $post_id ) {
		switch ( $column_name ) {
			case 'pronamic_submission_origin':
				$origin_title = \get_post_meta( $post_id, '_pronamic_submission_origin_title', true );
				$origin_url   = \get_post_meta( $post_id, '_pronamic_submission_origin_url', true );

				if ( '' !== $origin_url ) {
					\printf(
						'<a href="%s">%s</a>',
						\esc_url( $origin_url ),
						\esc_html( $origin_title )
					);
				}

				if ( '' === $origin_url ) {
					echo \esc_html( $origin_title );
				}
		}
	}
}
