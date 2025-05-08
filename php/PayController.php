<?php
/**
 * Pay controller
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

namespace Pronamic\PronamicForms;

use Pronamic\WordPress\DateTime\DateTimeImmutable;
use Pronamic\WordPress\Money\Currencies;
use Pronamic\WordPress\Money\Currency;
use Pronamic\WordPress\Money\Money;
use Pronamic\WordPress\Pay\Plugin as PronamicPayPlugin;
use Pronamic\WordPress\Pay\Payments\Payment;
use Pronamic\WordPress\Pay\Payments\PaymentLines;
use Pronamic\WordPress\Pay\Subscriptions\Subscription;
use Pronamic\WordPress\Pay\Subscriptions\SubscriptionInterval;
use Pronamic\WordPress\Pay\Subscriptions\SubscriptionPhase;

/**
 * Pay controller class
 */
final class PayController {
	/**
	 * Setup.
	 *
	 * @return void
	 */
	public function setup() {
		if ( ! \class_exists( Payment::class ) ) {
			return;
		}

		\add_action( 'pronamic_forms_entry_inserted', $this->process_payment( ... ), 10, 2 );

		\add_filter( 'pronamic_payment_source_description_pronamic_forms_entry', $this->source_description( ... ) );
		\add_filter( 'pronamic_payment_source_url_pronamic_forms_entry', $this->source_url( ... ), 10, 2 );
	}

	/**
	 * Process payment.
	 *
	 * @link https://developer.wordpress.org/reference/classes/wp_block_type/__construct/
	 * @param array $parsed_block  Parsed block.
	 * @param int   $entry_post_id Entry post ID.
	 * @return void
	 */
	private function process_payment( $parsed_block, $entry_post_id ) {
		$payment = new Payment();

		$payment->source    = 'pronamic_forms_entry';
		$payment->source_id = $entry_post_id;

		$currency = $this->get_currency_via_block_recursive( $parsed_block );

		if ( null === $currency ) {
			$currency = Currencies::get_currency( 'EUR' );
		}

		$this->complement_payment_via_block_recursive( $payment, $currency, $parsed_block );

		if ( null !== $payment->lines ) {
			$payment->set_total_amount( $payment->lines->get_amount() );
		}

		$total = $payment->get_total_amount();

		if ( $total->is_zero() ) {
			return;
		}

		$this->complement_payment_subscriptions_via_block_recursive( $payment, $parsed_block );

		$payment->set_description( 'Test' );

		$gateway = PronamicPayPlugin::get_gateway( \get_option( 'pronamic_pay_config_id' ) );

		if ( null === $gateway ) {
			\wp_die( 'No gateway.' );
		}

		try {
			$payment = PronamicPayPlugin::start_payment( $payment );
		} catch ( \Exception $e ) {
			PronamicPayPlugin::render_exception( $e );

			exit;
		}

		$gateway->redirect( $payment );

		exit;
	}

	/**
	 * Complement payment via block.
	 *
	 * @param Payment  $payment      Payment.
	 * @param Currency $currency     Currency.
	 * @param array    $parsed_block Parsed block.
	 * @return void
	 */
	private function complement_payment_via_block( $payment, $currency, $parsed_block ) {
		if ( null === $payment->lines ) {
			$payment->lines = new PaymentLines();
		}

		$block_name = $parsed_block['blockName'];
		$attributes = $parsed_block['attrs'];

		$this->complement_payment_lines_via_block( $payment, $currency, $parsed_block );

		if ( \array_key_exists( 'reference', $attributes ) ) {
			$reference = $attributes['reference'];

			if ( 'pronamic_pay_payment_method' === $reference ) {
				$checked = $attributes['checked'] ?? false;
				$value   = $attributes['value'] ?? '';

				if ( true === $checked && '' !== $value ) {
					$payment->set_payment_method( $value );
				}
			}
		}
	}

	/**
	 * Complement payment via block recursive.
	 *
	 * @param Payment  $payment      Payment.
	 * @param Currency $currency     Currency.
	 * @param array    $parsed_block Parsed block.
	 * @return void
	 */
	private function complement_payment_via_block_recursive( $payment, $currency, $parsed_block ) {
		$this->complement_payment_via_block( $payment, $currency, $parsed_block );

		foreach ( $parsed_block['innerBlocks'] as $inner_block ) {
			$this->complement_payment_via_block_recursive( $payment, $currency, $inner_block );
		}
	}

	/**
	 * Complement payment lines via block.
	 *
	 * @param Payment  $payment      Payment.
	 * @param Currency $currency     Currency.
	 * @param array    $parsed_block Parsed block.
	 * @return void
	 */
	public function complement_payment_lines_via_block( Payment $payment, $currency, $parsed_block ): void {
		$block_name = $parsed_block['blockName'];
		$attributes = $parsed_block['attrs'];

		$amount = $attributes['paymentAmount'] ?? null;

		$reference = $attributes['reference'] ?? null;

		if ( 'pronamic-pay-amount' === $reference ) {
			$value = $attributes['value'] ?? null;

			if ( null !== $value && '' !== $value ) {
				$amount = $value;
			}
		}

		// Check amount.
		if ( null === $amount ) {
			return;
		}

		// Check if option is checked.
		if (
			\in_array(
				$block_name,
				[
					'pronamic/form-checkbox-option',
					'pronamic/form-radio-option',
				],
				true
			)
				&&
			! \array_key_exists( 'checked', $attributes )
		) {
			return;
		}

		// Add line.
		$line = $payment->lines->new_line();

		$amount = new Money( $amount, $currency );

		$line->set_total_amount( $amount );
	}

	/**
	 * Complement payment subscriptions via block.
	 *
	 * @param Payment $payment Payment.
	 * @param array   $parsed_block Parsed block.
	 * @return void
	 */
	private function complement_payment_subscriptions_via_block( $payment, $parsed_block ) {
		$block_name = $parsed_block['blockName'];
		$attributes = $parsed_block['attrs'];

		/**
		 * For the checkbox field, only the inner blocks affect the payment.
		 */
		if ( 'pronamic/form-checkbox-field' === $block_name ) {
			return;
		}

		/**
		 * For the radio field, only the inner blocks affect the payment.
		 */
		if ( 'pronamic/form-radio-field' === $block_name ) {
			return;
		}

		if ( \array_key_exists( 'reference', $attributes ) ) {
			$reference = $attributes['reference'];

			if ( 'pronamic_pay_subscription_frequency' === $reference ) {
				$checked = $attributes['checked'] ?? false;
				$value   = $attributes['value'] ?? '';

				$interval = null;

				switch ( $value ) {
					case 'monthly':
						$interval = new SubscriptionInterval( 'P1M' );

						break;
					case 'yearly':
						$interval = new SubscriptionInterval( 'P1Y' );

						break;
				}

				if ( true === $checked && null !== $interval ) {
					$subscription = new Subscription();

					$subscription->set_lines( $payment->get_lines() );

					$phase = new SubscriptionPhase(
						$subscription,
						new DateTimeImmutable(),
						$interval,
						$payment->get_total_amount()
					);

					$subscription->add_phase( $phase );

					$period = $subscription->new_period();

					if ( null !== $period ) {
						$payment->add_period( $period );
					}
				}
			}
		}
	}

	/**
	 * Complement payment subscriptions via block recursive.
	 *
	 * @param Payment $payment      Payment.
	 * @param array   $parsed_block Parsed block.
	 * @return void
	 */
	private function complement_payment_subscriptions_via_block_recursive( $payment, $parsed_block ) {
		$this->complement_payment_subscriptions_via_block( $payment, $parsed_block );

		foreach ( $parsed_block['innerBlocks'] as $inner_block ) {
			$this->complement_payment_subscriptions_via_block_recursive( $payment, $inner_block );
		}
	}

	/**
	 * Get currency.
	 *
	 * @param array $parsed_block Parsed block.
	 * @return Currency|null
	 */
	private function get_currency_via_block_recursive( $parsed_block ) {
		$currency = $this->get_currency_via_block( $parsed_block );

		if ( null !== $currency ) {
			return $currency;
		}

		foreach ( $parsed_block['innerBlocks'] as $inner_block ) {
			$currency = $this->get_currency_via_block_recursive( $inner_block );

			if ( null !== $currency ) {
				return $currency;
			}
		}

		return null;
	}

	/**
	 * Get currency.
	 *
	 * @param array $parsed_block Parsed block.
	 * @return Currency|null
	 */
	private function get_currency_via_block( $parsed_block ) {
		$attributes = $parsed_block['attrs'];

		if ( ! \array_key_exists( 'reference', $attributes ) ) {
			return null;
		}

		$reference = $attributes['reference'];

		if ( 'pronamic-pay-currency' !== $reference ) {
			return null;
		}

		if ( ! \array_key_exists( 'value', $attributes ) ) {
			return null;
		}

		$currency_code = $attributes['value'];

		return Currencies::get_currency( $currency_code );
	}

	/**
	 * Source description.
	 *
	 * @return string
	 */
	private function source_description() {
		return \__( 'Pronamic Forms Entry', 'pronamic-forms' );
	}

	/**
	 * Source URL.
	 *
	 * @param string  $url     URL.
	 * @param Payment $payment The payment to create the source URL for.
	 *
	 * @return string
	 */
	private function source_url( $url, Payment $payment ) {
		$url = \add_query_arg(
			[
				'post'   => $payment->source_id,
				'action' => 'edit',
			],
			\admin_url( 'post.php' )
		);

		return $url;
	}
}
