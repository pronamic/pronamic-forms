<?php
/**
 * Render form block updater
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

namespace Pronamic\PronamicForms;

use WP_Block_Type;
use WP_Block_Type_Registry;

/**
 * Render form block updater class
 *
 * @link https://github.com/WordPress/WordPress/blob/ee3beccbd150fce4fb508c7a597d876b6dfc1693/wp-includes/blocks.php#L2043-L2074s
 * @phpstan-type BlockAttributes array{ id?: string, type?: string, name?: string, serverName?: string, value?: string }
 * @phpstan-type ParsedBlock array{ blockName: string, attrs: BlockAttributes, innerBlocks: array, innerHTML: string }
 */
class RenderFormBlockUpdater {
	/**
	 * Updaters.
	 *
	 * @var BlockUpdater[]
	 */
	private $updaters;

	/**
	 * Construct render form block updater.
	 */
	public function __construct() {
		$this->updaters = [
			'pronamic/form-control'         => new BlockUpdaterFormField(),
			'pronamic/form-field'           => new BlockUpdaterFormField(),
			'pronamic/form-checkbox-field'  => new BlockUpdater(),
			'pronamic/form-checkbox-option' => new BlockUpdaterCheckField(),
			'pronamic/form-radio-field'     => new BlockUpdater(),
			'pronamic/form-radio-option'    => new BlockUpdaterCheckField(),
		];
	}

	/**
	 * Update parsed block.
	 *
	 * @param ParsedBlock           $parsed_block      Parsed block array.
	 * @param array<string, string> $available_context Available context.
	 * @return ParsedBlock
	 */
	public function update_parsed_block( $parsed_block, $available_context = [] ) {
		$block_name = $parsed_block['blockName'];

		$block_type = WP_Block_Type_Registry::get_instance()->get_registered( $block_name );

		$context = $this->get_block_context( $block_type, $available_context );

		if ( \array_key_exists( $block_name, $this->updaters ) ) {
			$updater = $this->updaters[ $block_name ];

			$parsed_block = $updater->update_block_attributes( $parsed_block, $context );
			$parsed_block = $updater->update_value_from_input( $parsed_block );
			$parsed_block = $this->update_inner_content( $parsed_block, $updater->update_inner_content( ... ) );
		}

		$child_context = $this->get_child_context( $block_type, $parsed_block['attrs'], $available_context );

		$parsed_block['innerBlocks'] = \array_map(
			fn( $inner_block ) => $this->update_parsed_block( $inner_block, $child_context ),
			$parsed_block['innerBlocks']
		);

		return $parsed_block;
	}

	/**
	 * Get block context.
	 *
	 * @link https://github.com/WordPress/WordPress/blob/24ebcea8b89414c2782148ff2ce47280c266d900/wp-includes/class-wp-block.php#L151-L163
	 * @param WP_Block_Type         $block_type        Block type.
	 * @param array<string, string> $available_context Available context.
	 * @return array<string, string>
	 */
	private function get_block_context( $block_type, $available_context ) {
		$context = [];

		foreach ( $block_type->uses_context as $context_name ) {
			if ( \array_key_exists( $context_name, $available_context ) ) {
				$context[ $context_name ] = $available_context[ $context_name ];
			}
		}
		return $context;
	}

	/**
	 * Get child context.
	 *
	 * @link https://github.com/WordPress/WordPress/blob/24ebcea8b89414c2782148ff2ce47280c266d900/wp-includes/class-wp-block.php#L151-L163
	 * @param WP_Block_Type         $block_type        Block type.
	 * @param array<string, string> $attributes        Attributes.
	 * @param array<string, string> $available_context Available context.
	 * @return array<string, string>
	 */
	private function get_child_context( $block_type, $attributes, $available_context ) {
		$child_context = $available_context;

		if ( null !== $block_type->provides_context ) {
			foreach ( $block_type->provides_context as $context_name => $attribute_name ) {
				if ( \array_key_exists( $attribute_name, $attributes ) ) {
					$child_context[ $context_name ] = $attributes[ $attribute_name ];
				}
			}
		}

		return $child_context;
	}

	/**
	 * Update the inner content of the parsed block via a callback function.
	 *
	 * @param ParsedBlock $parsed_block Parsed block.
	 * @param callabl     $callback     Callback function.
	 * @return ParsedBlock
	 */
	private function update_inner_content( $parsed_block, $callback ) {
		foreach ( $parsed_block['innerContent'] as &$chunk ) {
			if ( is_string( $chunk ) ) {
				$chunk = \call_user_func( $callback, $chunk, $parsed_block );
			}
		}

		return $parsed_block;
	}
}
