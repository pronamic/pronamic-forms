<?php
/**
 * Submissions REST controller
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2026 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

declare(strict_types=1);

namespace Pronamic\PronamicForms;

use WP_Error;
use WP_REST_Posts_Controller;
use WP_REST_Request;

/**
 * Submissions REST controller class
 *
 * Submissions are stored with the `private` status and are only meant to be
 * viewed by users who can edit them. The default posts controller allows
 * everyone to read posts with the `publish` status, for example submissions
 * stored by earlier versions or submissions whose visibility is changed in the
 * editor.
 *
 * @link https://github.com/pronamic/pronamic-forms/issues/14
 */
final class SubmissionsRestController extends WP_REST_Posts_Controller {
	/**
	 * Checks if a given request has access to read submissions.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return true|WP_Error
	 */
	public function get_items_permissions_check( $request ) {
		if ( ! \current_user_can( 'edit_posts' ) ) {
			return new WP_Error(
				'rest_forbidden',
				\__( 'Sorry, you are not allowed to view submissions.', 'pronamic-forms' ),
				[
					'status' => \rest_authorization_required_code(),
				]
			);
		}

		return parent::get_items_permissions_check( $request );
	}

	/**
	 * Checks if a given request has access to read a submission.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return bool|WP_Error
	 */
	public function get_item_permissions_check( $request ) {
		$result = parent::get_item_permissions_check( $request );

		if ( true !== $result ) {
			return $result;
		}

		$id = $request['id'];

		if ( ! \is_numeric( $id ) || ! \current_user_can( 'edit_post', (int) $id ) ) {
			return new WP_Error(
				'rest_forbidden',
				\__( 'Sorry, you are not allowed to view this submission.', 'pronamic-forms' ),
				[
					'status' => \rest_authorization_required_code(),
				]
			);
		}

		return true;
	}
}
