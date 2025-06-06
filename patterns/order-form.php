<?php
/**
 * Order form
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
<p><?php esc_html_e( 'Your form has been submitted successfully.', 'pronamic-forms' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:pronamic/form-submission-notification -->

<!-- wp:pronamic/form-submission-notification {"type":"error","style":{"color":{"text":"#CF2E2E"},"elements":{"link":{"color":{"text":"#CF2E2E"}}}}} -->
<div class="wp-block-pronamic-form-submission-notification has-text-color has-link-color" style="color:#CF2E2E"><!-- wp:paragraph -->
<p><?php esc_html_e( 'There was an error submitting your form.', 'pronamic-forms' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:pronamic/form-submission-notification -->

<!-- wp:paragraph -->
<p><?php \esc_html_e( 'One-time', 'pronamic-forms' ); ?><br><s>€ 311,00</s><br>€ 267,00</p>
<!-- /wp:paragraph -->

<!-- wp:pronamic/hidden-payment-amount {"paymentAmount":"267"} /-->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:pronamic/form-field {"required":true} -->
<div class="wp-block-pronamic-form-field"><div class="wp-block-pronamic-form-label"><label><?php \esc_html_e( 'First name', 'pronamic-forms' ); ?></label></div><div class="wp-block-pronamic-form-control"><input required class="wp-block-pronamic-form-control__element" value="" type="text"/></div></div>
<!-- /wp:pronamic/form-field -->

<!-- wp:pronamic/form-field -->
<div class="wp-block-pronamic-form-field"><div class="wp-block-pronamic-form-label"><label><?php \esc_html_e( 'Last name', 'pronamic-forms' ); ?></label></div><div class="wp-block-pronamic-form-control"><input class="wp-block-pronamic-form-control__element" value="" type="text"/></div></div>
<!-- /wp:pronamic/form-field --></div>
<!-- /wp:group -->

<!-- wp:pronamic/form-field {"type":"email","required":true} -->
<div class="wp-block-pronamic-form-field"><div class="wp-block-pronamic-form-label"><label><?php \esc_html_e( 'Email address', 'pronamic-forms' ); ?></label></div><div class="wp-block-pronamic-form-control"><input required class="wp-block-pronamic-form-control__element" value="" type="email"/></div></div>
<!-- /wp:pronamic/form-field -->

<!-- wp:pronamic/form-field {"type":"textarea"} -->
<div class="wp-block-pronamic-form-field"><div class="wp-block-pronamic-form-label"><label><?php \esc_html_e( 'Message', 'pronamic-forms' ); ?></label></div><div class="wp-block-pronamic-form-control"><textarea class="wp-block-pronamic-form-control__element"></textarea></div></div>
<!-- /wp:pronamic/form-field -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"tagName":"button","type":"submit"} -->
<div class="wp-block-button"><button type="submit" class="wp-block-button__link wp-element-button"><?php echo \esc_html_x( 'Order', 'button text to place an order', 'pronamic-forms' ); ?></button></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></form>
<!-- /wp:pronamic/form -->
