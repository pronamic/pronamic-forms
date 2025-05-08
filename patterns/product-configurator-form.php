<?php
/**
 * Product configurator form
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\Forms
 */

?>

<!-- wp:pronamic/form -->
<form action="" method="post" class="wp-block-pronamic-form"><!-- wp:pronamic/form-submission-notification {"type":"success","style":{"color":{"text":"#345C00"},"elements":{"link":{"color":{"text":"#345C00"}}}}} -->
<div class="wp-block-pronamic-form-submission-notification has-text-color has-link-color" style="color:#345C00"><!-- wp:paragraph -->
<p><?php \esc_html_e( 'Your form has been submitted successfully.', 'pronamic-forms' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:pronamic/form-submission-notification -->

<!-- wp:pronamic/form-submission-notification {"type":"error","style":{"color":{"text":"#CF2E2E"},"elements":{"link":{"color":{"text":"#CF2E2E"}}}}} -->
<div class="wp-block-pronamic-form-submission-notification has-text-color has-link-color" style="color:#CF2E2E"><!-- wp:paragraph -->
<p><?php \esc_html_e( 'There was an error submitting your form.', 'pronamic-forms' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:pronamic/form-submission-notification -->

	<!-- wp:heading -->
	<h2 class="wp-block-heading"><?php echo \esc_html_x( 'Bookcase', 'Product configurator form pattern', 'pronamic-forms' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p><?php echo \esc_html_x( 'Standard bookcase', 'Product configurator form pattern', 'pronamic-forms' ); ?> = <strong>€ 400</strong></p>
	<!-- /wp:paragraph -->

	<!-- wp:pronamic/hidden-payment-amount {"paymentAmount":"400"} /-->

	<!-- wp:heading -->
	<h2 class="wp-block-heading"><?php echo \esc_html_x( 'Extras', 'Product configurator form pattern', 'pronamic-forms' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:pronamic/form-checkbox-field -->
	<div class="wp-block-pronamic-form-checkbox-field wp-block-pronamic-form-field"><div class="wp-block-pronamic-form-label"><span><?php echo \esc_html_x( 'Add extra options:', 'Product configurator form pattern', 'pronamic-forms' ); ?></span></div><div class="wp-block-pronamic-form-radio-field__inner-blocks"><!-- wp:pronamic/form-checkbox-option {"paymentAmount":"82"} -->
			<div class="wp-block-pronamic-form-checkbox-option"><input class="wp-block-pronamic-form-control__element" name="" value="" type="checkbox"/><label><?php echo \esc_html_x( 'Doors', 'Product configurator form pattern', 'pronamic-forms' ); ?> (€ 82)</label></div>
			<!-- /wp:pronamic/form-checkbox-option -->

			<!-- wp:pronamic/form-checkbox-option {"paymentAmount":"40"} -->
			<div class="wp-block-pronamic-form-checkbox-option"><input class="wp-block-pronamic-form-control__element" name="" value="" type="checkbox"/><label><?php echo \esc_html_x( 'Back panel', 'Product configurator form pattern', 'pronamic-forms' ); ?> (€ 40)</label></div>
			<!-- /wp:pronamic/form-checkbox-option -->

			<!-- wp:pronamic/form-checkbox-option {"paymentAmount":"25"} -->
			<div class="wp-block-pronamic-form-checkbox-option"><input class="wp-block-pronamic-form-control__element" name="" value="" type="checkbox"/><label><?php echo \esc_html_x( 'Wheels', 'Product configurator form pattern', 'pronamic-forms' ); ?> (€ 25)</label></div>
			<!-- /wp:pronamic/form-checkbox-option --></div></div>
	<!-- /wp:pronamic/form-checkbox-field -->

	<!-- wp:heading -->
	<h2 class="wp-block-heading"><?php echo \esc_html_x( 'Billing details', 'Product configurator form pattern', 'pronamic-forms' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:columns -->
	<div class="wp-block-columns"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:pronamic/form-field {"required":true} -->
			<div class="wp-block-pronamic-form-field"><div class="wp-block-pronamic-form-label"><label><?php \esc_html_e( 'First Name', 'pronamic-forms' ); ?></label></div><div class="wp-block-pronamic-form-control"><input required class="wp-block-pronamic-form-control__element" value="" type="text"/></div></div>
			<!-- /wp:pronamic/form-field --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:pronamic/form-field {"required":true} -->
			<div class="wp-block-pronamic-form-field"><div class="wp-block-pronamic-form-label"><label><?php \esc_html_e( 'Last Name', 'pronamic-forms' ); ?></label></div><div class="wp-block-pronamic-form-control"><input required class="wp-block-pronamic-form-control__element" value="" type="text"/></div></div>
			<!-- /wp:pronamic/form-field --></div>
		<!-- /wp:column --></div>
	<!-- /wp:columns -->

	<!-- wp:pronamic/form-field {"type":"email","required":true} -->
	<div class="wp-block-pronamic-form-field"><div class="wp-block-pronamic-form-label"><label><?php \esc_html_e( 'Email Address', 'pronamic-forms' ); ?></label></div><div class="wp-block-pronamic-form-control"><input required class="wp-block-pronamic-form-control__element" value="" type="email"/></div></div>
	<!-- /wp:pronamic/form-field -->

	<!-- wp:pronamic/form-field {"type":"textarea"} -->
	<div class="wp-block-pronamic-form-field"><div class="wp-block-pronamic-form-label"><label><?php echo \esc_html_x( 'Message', 'Product configurator form pattern', 'pronamic-forms' ); ?></label></div><div class="wp-block-pronamic-form-control"><textarea class="wp-block-pronamic-form-control__element"></textarea></div></div>
	<!-- /wp:pronamic/form-field -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"tagName":"button","type":"submit"} -->
<div class="wp-block-button"><button type="submit" class="wp-block-button__link wp-element-button"><?php echo \esc_html_x( 'Place order', 'Product configurator form pattern', 'pronamic-forms' ); ?></button></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></form>
<!-- /wp:pronamic/form -->
