<?php
/**
 * Form submission processor
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

namespace Pronamic\PronamicForms;

use WP_Error;
use WP_Post;

/**
 * Form submission processor class
 */
final class FormSubmissionProcessor {
	/**
	 * Maybe process form.
	 *
	 * Executed from the `render_block_data` filter.
	 *
	 * @link https://developer.wordpress.org/reference/classes/wp_block_type/__construct/
	 * @param array $parsed_block Parsed block.
	 * @return void
	 * @throws \Exception Throws an exception if the form cannot be saved as a submission post.
	 */
	public function maybe_process_form( $parsed_block ) {
		$date_format = \sprintf(
			/* translators: 1: date format, 2: time format */
			\_x( '%1$s %2$s', 'date time format', 'pronamic-forms' ),
			\get_option( 'date_format' ),
			\get_option( 'time_format' )
		);

		$meta_input = [];

		$origin_post = \get_post();

		if ( $origin_post instanceof WP_Post ) {
			$meta_input['_pronamic_submission_origin_post_id']   = $origin_post->ID;
			$meta_input['_pronamic_submission_origin_title']     = \get_the_title( $origin_post );
			$meta_input['_pronamic_submission_origin_permalink'] = \get_permalink( $origin_post );
			
		}

		if ( \array_key_exists( 'HTTP_HOST', $_SERVER ) && \array_key_exists( 'REQUEST_URI', $_SERVER ) ) {
			$http_host   = \sanitize_text_field( \wp_unslash( $_SERVER['HTTP_HOST'] ) );
			$request_uri = \sanitize_text_field( \wp_unslash( $_SERVER['REQUEST_URI'] ) );

			$url = ( \is_ssl() ? 'https://' : 'http://' ) . $http_host . $request_uri;

			$meta_input['_pronamic_submission_origin_url'] = $url;
		}

		if ( \array_key_exists( 'REMOTE_ADDR', $_SERVER ) ) {
			$ip = \sanitize_text_field( \wp_unslash( $_SERVER['REMOTE_ADDR'] ) );

			$meta_input['_pronamic_submission_ip_address'] = $ip;
		}

		if ( \array_key_exists( 'HTTP_USER_AGENT', $_SERVER ) ) {
			$user_agent = \sanitize_text_field( \wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) );

			$meta_input['_pronamic_submission_user_agent'] = $user_agent;
		}

		$result = \wp_insert_post(
			[
				'post_content' => \wp_slash( \serialize_block( $parsed_block ) ),
				'post_title'   => \sprintf(
					/* translators: %s: formatted date */
					\__( 'Entry – %s', 'pronamic-forms' ),
					\wp_date( $date_format )
				),
				'post_status'  => 'publish',
				'post_type'    => 'pronamic_submission',
				'meta_input'   => $meta_input,
			],
			true
		);

		if ( $result instanceof WP_Error ) {
			throw new \Exception( \esc_html( $result->get_error_message() ) );
		}

		\do_action( 'pronamic_forms_entry_inserted', $parsed_block, $result );
	}
}
