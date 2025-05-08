<?php
/**
 * Render form block controller
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

namespace Pronamic\PronamicForms;

/**
 * Render form block controller class
 * 
 * @link https://github.com/WordPress/WordPress/blob/ee3beccbd150fce4fb508c7a597d876b6dfc1693/wp-includes/blocks.php#L2043-L2074s
 * @phpstan-type BlockAttributes array{ id?: string, type?: string, name?: string, value?: string }
 * @phpstan-type ParsedBlock array{ blockName: string, attrs: BlockAttributes, innerBlocks: array, innerHTML: string }
 */
final class RenderFormBlockController {
	/**
	 * Setup.
	 * 
	 * @return void
	 */
	public function setup() {
		\add_filter( 'render_block_data', $this->render_block_data( ... ) );
	}

	/**
	 * Render block data.
	 * 
	 * @link https://github.com/WordPress/WordPress/blob/ee3beccbd150fce4fb508c7a597d876b6dfc1693/wp-includes/blocks.php#L2043-L2074
	 * @param ParsedBlock $parsed_block Parsed block.
	 * @return ParsedBlock
	 */
	private function render_block_data( $parsed_block ) {
		$block_name = $parsed_block['blockName'];

		if ( 'pronamic/form' !== $block_name ) {
			return $parsed_block;
		}

		$hash = \wp_hash( \serialize_block( $parsed_block ) );

		$render_form_block_updater = new RenderFormBlockUpdater();

		$parsed_block = $render_form_block_updater->update_parsed_block( $parsed_block );

		$parsed_block['attrs']['hash']   = $hash;
		$parsed_block['attrs']['result'] = '';

		$parsed_block = $this->maybe_process_form( $parsed_block );

		return $parsed_block;
	}

	/**
	 * Maybe process form.
	 *
	 * @param ParsedBlock $parsed_block Parsed block.
	 * @return ParsedBlock
	 */
	private function maybe_process_form( $parsed_block ) {
		if ( ! \array_key_exists( 'hash', $parsed_block['attrs'] ) ) {
			return $parsed_block;
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Public form.
		if ( ! \array_key_exists( 'pronamic_pay_form_hash', $_POST ) ) {
			return $parsed_block;
		}

		$hash = $parsed_block['attrs']['hash'];

		// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Public form.
		$post_hash = \sanitize_text_field( \wp_unslash( $_POST['pronamic_pay_form_hash'] ) );

		if ( $post_hash !== $hash ) {
			$parsed_block['attrs']['result'] = 'error';

			return $parsed_block;
		}

		$form_submission_processor = new FormSubmissionProcessor();

		$parsed_block['attrs']['result'] = 'success';

		try {
			$form_submission_processor->maybe_process_form( $parsed_block );
		} catch ( \Exception ) {
			$parsed_block['attrs']['result'] = 'error';
		}       

		return $parsed_block;
	}
}
