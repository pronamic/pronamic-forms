<?php
/**
 * Form
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

<!-- wp:pronamic/form-field {"required":true} -->
<div class="wp-block-pronamic-form-field"><div class="wp-block-pronamic-form-label"><label><?php \esc_html_e( 'Name', 'pronamic-forms' ); ?></label></div><div class="wp-block-pronamic-form-control"><input required class="wp-block-pronamic-form-control__element" value="" type="text"/></div></div>
<!-- /wp:pronamic/form-field -->

<!-- wp:pronamic/form-field {"type":"email","required":true} -->
<div class="wp-block-pronamic-form-field"><div class="wp-block-pronamic-form-label"><label><?php \esc_html_e( 'Email address', 'pronamic-forms' ); ?></label></div><div class="wp-block-pronamic-form-control"><input required class="wp-block-pronamic-form-control__element" value="" type="email"/></div></div>
<!-- /wp:pronamic/form-field -->

<!-- wp:pronamic/form-field {"type":"textarea"} -->
<div class="wp-block-pronamic-form-field"><div class="wp-block-pronamic-form-label"><label><?php \esc_html_e( 'Message', 'pronamic-forms' ); ?></label></div><div class="wp-block-pronamic-form-control"><textarea class="wp-block-pronamic-form-control__element"></textarea></div></div>
<!-- /wp:pronamic/form-field -->

<!-- wp:pronamic/form-radio-field {"required":true,"reference":"pronamic_pay_subscription_frequency"} -->
<div class="wp-block-pronamic-form-radio-field wp-block-pronamic-form-field"><div class="wp-block-pronamic-form-label"><span><?php \esc_html_e( 'Frequency', 'pronamic-forms' ); ?></span></div><div class="wp-block-pronamic-form-radio-field__inner-blocks"><!-- wp:pronamic/form-radio-option {"value":"once","reference":"pronamic_pay_subscription_frequency"} -->
<div class="wp-block-pronamic-form-radio-option"><input class="wp-block-pronamic-form-control__element" name="" value="once" type="radio"/> <label><?php \esc_html_e( 'Once', 'pronamic-forms' ); ?></label></div>
<!-- /wp:pronamic/form-radio-option -->

<!-- wp:pronamic/form-radio-option {"value":"monthly","reference":"pronamic_pay_subscription_frequency"} -->
<div class="wp-block-pronamic-form-radio-option"><input class="wp-block-pronamic-form-control__element" name="" value="monthly" type="radio"/> <label><?php \esc_html_e( 'Monthly', 'pronamic-forms' ); ?></label></div>
<!-- /wp:pronamic/form-radio-option -->

<!-- wp:pronamic/form-radio-option {"value":"yearly","reference":"pronamic_pay_subscription_frequency"} -->
<div class="wp-block-pronamic-form-radio-option"><input class="wp-block-pronamic-form-control__element" name="" value="yearly" type="radio"/> <label><?php \esc_html_e( 'Yearly', 'pronamic-forms' ); ?></label></div>
<!-- /wp:pronamic/form-radio-option --></div></div>
<!-- /wp:pronamic/form-radio-field -->

<!-- wp:pronamic/form-field {"reference":"pronamic-pay-amount"} -->
<div class="wp-block-pronamic-form-field"><div class="wp-block-pronamic-form-label"><label><?php echo \esc_html_x( 'Amount', 'payment amount', 'pronamic-forms' ); ?></label></div><div class="wp-block-pronamic-form-control"><input class="wp-block-pronamic-form-control__element" value="" type="text"/></div></div>
<!-- /wp:pronamic/form-field -->

<!-- wp:pronamic/form-radio-field {"required":true,"reference":"pronamic_pay_payment_method"} -->
<div class="wp-block-pronamic-form-radio-field wp-block-pronamic-form-field"><div class="wp-block-pronamic-form-label"><span><?php \esc_html_e( 'Payment method', 'pronamic-forms' ); ?></span></div><div class="wp-block-pronamic-form-radio-field__inner-blocks"><!-- wp:pronamic/form-radio-option {"value":"bancontact","reference":"pronamic_pay_payment_method"} -->
<div class="wp-block-pronamic-form-radio-option"><input class="wp-block-pronamic-form-control__element" name="" value="bancontact" type="radio"/> <label><img class="pronamic-forms-radio-option-image" style="width: 48px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NDAiIGhlaWdodD0iMzYwIiBmaWxsPSJub25lIj48bGluZWFyR3JhZGllbnQgaWQ9ImEiIHgxPSIxODMuMDIxIiB4Mj0iMzA4Ljc4MSIgeTE9IjE4MC4wNTUiIHkyPSIxMzMuMzQ0IiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjMDA1YWI5Ii8+PHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjMWUzNzY0Ii8+PC9saW5lYXJHcmFkaWVudD48bGluZWFyR3JhZGllbnQgaWQ9ImIiIHgxPSIzMzAuNTY5IiB4Mj0iNDY0LjEiIHkxPSIxNDguMzE4IiB5Mj0iMTAyLjc2IiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjZmJhOTAwIi8+PHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjZmZkODAwIi8+PC9saW5lYXJHcmFkaWVudD48cGF0aCBmaWxsPSIjZmZmIiBkPSJNMTI1LjQgMzZoMzg5LjUxOGExNC40IDE0LjQgMCAwIDEgMTQuNCAxNC40djI1OS4yYTE0LjQgMTQuNCAwIDAgMS0xNC40IDE0LjRIMTI1LjRhMTQuNCAxNC40IDAgMCAxLTEwLjE4Mi00LjIxOEExNC40IDE0LjQgMCAwIDEgMTExIDMwOS42VjUwLjRBMTQuNCAxNC40IDAgMCAxIDEyNS40IDM2Ii8+PHBhdGggZmlsbD0iIzFlMzc2NCIgZD0iTTE0OC4yNDkgMjg1LjkwMXYtNDkuNjY0aDE1LjMyNWMxMS4xMzkgMCAxOC4zMDUgNC4xODYgMTguMzA1IDEyLjg0MiAwIDQuODk1LTIuMjcxIDguMzAxLTUuNDYzIDEwLjI4NyA0LjYxMSAyLjEyOCA3LjMwNyA2LjI0MyA3LjMwNyAxMS44NDggMCAxMC4wMDQtNy4zMDcgMTQuNjg3LTE4LjY1OSAxNC42ODd6bTkuODYyLTI5LjAxOGg3LjMwOGM0LjQ2OSAwIDYuMzg1LTIuMiA2LjM4NS02LjI0NCAwLTQuMzI4LTMuNDc2LTUuNzQ2LTguMTU5LTUuNzQ2aC01LjUzNHptMCAyMC4zNjJoNi4xMDFjNS45NiAwIDkuNDM3LTEuNDkgOS40MzctNi4xNzIgMC00LjYxMi0yLjk4LTYuNTI4LTguNTg1LTYuNTI4aC02Ljk1M3ptNDQuNzM3IDkuNTA3Yy05LjcyIDAtMTQuNjE1LTQuNzUzLTE0LjYxNS0xMS4xMzkgMC03LjAyNCA1Ljc0Ny0xMS4xMzkgMTQuMjYtMTEuMjEgMi4xMTYuMDM5IDQuMjI2LjIyOSA2LjMxNS41Njh2LTEuNzAzYzAtNC4zMjgtMi40ODMtNi4zODUtNy4yMzctNi4zODVhMjQuOSAyNC45IDAgMCAwLTkuMzY1IDEuNzAzbC0xLjc3NC03LjY2M2MzLjA1MS0xLjI3NyA3Ljk0Ni0yLjEyOCAxMi4yNzQtMi4xMjggMTAuNDMgMCAxNS42MDkgNS41MzQgMTUuNjA5IDE1LjExMnYxOS43MjRjLTIuOTA5IDEuNDktOC4zNzIgMy4xMjEtMTUuNDY3IDMuMTIxbTUuOTYtOC4wMTd2LTcuNTkxYTIzLjggMjMuOCAwIDAgMC01LjAzNy0uNTY4Yy0zLjI2NCAwLTUuODE4IDEuMjc3LTUuODE4IDQuNjEyIDAgMi45OCAyLjEyOCA0LjU0IDUuODg4IDQuNTQgMS43MS4wNTYgMy40MS0uMjg0IDQuOTY3LS45OTNtMTYuNCA3LjE2NnYtMzMuOTg1YTQzLjMgNDMuMyAwIDAgMSAxNi4wMzUtMy4xMjFjMTAuMzU4IDAgMTYuMzE4IDUuMTA4IDE2LjMxOCAxNC41NDR2MjIuNTYyaC05Ljc5MXYtMjEuODUyYzAtNC44OTYtMi4yNzEtNy4xNjYtNi41OTgtNy4xNjZhMTQuOSAxNC45IDAgMCAwLTYuMjQ0IDEuMjc3djI3Ljc0MXptNjYuNTY5LTM0Ljk3OC0xLjg0NSA3LjczNGEyMS42IDIxLjYgMCAwIDAtOC4wMTctMS43NzRjLTUuNzQ3IDAtOC44NjkgNC4wNDQtOC44NjkgMTAuNzEzIDAgNy4zMDggMy4yNjQgMTEuMDY4IDkuMzY2IDExLjA2OGEyMC4xIDIwLjEgMCAwIDAgNy44NzUtMS44NDVsMS41NjEgNy44NzZhMjMuOSAyMy45IDAgMCAxLTEwLjIxNyAyLjA1N2MtMTEuNzc4IDAtMTguNTg5LTcuMzA3LTE4LjU4OS0xOC44NzIgMC0xMS40OTQgNi43NDEtMTkuMDg1IDE4LjAyMi0xOS4wODVhMjcuNCAyNy40IDAgMCAxIDEwLjcxMyAyLjEyOG0yMS4xNTEgMzUuODI5Yy0xMC45MjYgMC0xNy43MzctNy41OTEtMTcuNzM3LTE5LjAxNCAwLTExLjM1MiA2LjgxMS0xOC45NDMgMTcuNzM3LTE4Ljk0MyAxMC45OTcgMCAxNy42NjcgNy41OTEgMTcuNjY3IDE4Ljk0MyAwIDExLjQyMy02LjY3IDE5LjAxNC0xNy42NjcgMTkuMDE0bTAtOC4wODhjNS4wMzggMCA3LjY2My00LjE4NiA3LjY2My0xMC45MjYgMC02LjY2OS0yLjYyNS0xMC44NTUtNy42NjMtMTAuODU1LTQuOTY2IDAtNy43MzMgNC4xODYtNy43MzMgMTAuODU1IDAgNi43NCAyLjc2NyAxMC45MjYgNy43MzMgMTAuOTI2bTIzLjMzMiA3LjIzN3YtMzMuOTg1YTQzLjMgNDMuMyAwIDAgMSAxNi4wMzUtMy4xMjFjMTAuMzU4IDAgMTYuMzE4IDUuMTA4IDE2LjMxOCAxNC41NDR2MjIuNTYyaC05Ljc5MXYtMjEuODUyYzAtNC44OTYtMi4yNy03LjE2Ni02LjU5OC03LjE2NmExNC45IDE0LjkgMCAwIDAtNi4yNDQgMS4yNzd2MjcuNzQxem01NC40MzQuODUxYy04LjQ0MyAwLTEyLjc3MS00LjYxMS0xMi43NzEtMTMuOTc3di0xNS4zMjRoLTQuODI0di03LjgwNWg0LjgyNHYtNy44NzVsOS43OTEtLjQ5N3Y4LjM3Mmg3Ljg3NXY3LjgwNWgtNy44NzV2MTUuMTgzYzAgNC4xMTUgMS43MDMgNi4wMyA0Ljg5NiA2LjAzYTE3LjIgMTcuMiAwIDAgMCAzLjc2LS40MjVsLjQ5NyA3Ljg3NWEyNyAyNyAwIDAgMS02LjE3My42MzhtMjQuNzEzIDBjLTkuNzIgMC0xNC42MTYtNC43NTMtMTQuNjE2LTExLjEzOSAwLTcuMDI0IDUuNzQ3LTExLjEzOSAxNC4yNjEtMTEuMjEgMi4xMTYuMDM5IDQuMjI2LjIyOSA2LjMxNS41Njh2LTEuNzAzYzAtNC4zMjgtMi40ODQtNi4zODUtNy4yMzctNi4zODVhMjQuOSAyNC45IDAgMCAwLTkuMzY1IDEuNzAzbC0xLjc3NC03LjY2M2MzLjA1MS0xLjI3NyA3Ljk0Ni0yLjEyOCAxMi4yNzQtMi4xMjggMTAuNDMgMCAxNS42MDkgNS41MzQgMTUuNjA5IDE1LjExMnYxOS43MjRjLTIuOTA5IDEuNDktOC4zNzIgMy4xMjEtMTUuNDY3IDMuMTIxbTUuOTYtOC4wMTd2LTcuNTkxYTIzLjggMjMuOCAwIDAgMC01LjAzOC0uNTY4Yy0zLjI2MyAwLTUuODE3IDEuMjc3LTUuODE3IDQuNjEyIDAgMi45OCAyLjEyOCA0LjU0IDUuODg4IDQuNTQgMS43MS4wNTYgMy40MS0uMjg0IDQuOTY3LS45OTNtNDMuMDA1LTI3LjgxMi0xLjg0NSA3LjczNGEyMS42IDIxLjYgMCAwIDAtOC4wMTctMS43NzRjLTUuNzQ3IDAtOC44NjggNC4wNDQtOC44NjggMTAuNzEzIDAgNy4zMDggMy4yNjMgMTEuMDY4IDkuMzY1IDExLjA2OGEyMC4xIDIwLjEgMCAwIDAgNy44NzUtMS44NDVsMS41NjEgNy44NzZhMjMuOSAyMy45IDAgMCAxLTEwLjIxNyAyLjA1N2MtMTEuNzc3IDAtMTguNTg4LTcuMzA3LTE4LjU4OC0xOC44NzIgMC0xMS40OTQgNi43NC0xOS4wODUgMTguMDIxLTE5LjA4NWEyNy40IDI3LjQgMCAwIDEgMTAuNzEzIDIuMTI4bTIxLjUyNiAzNS44MjljLTguNDQyIDAtMTIuNzctNC42MTEtMTIuNzctMTMuOTc3di0xNS4zMjRoLTQuODI1di03LjgwNWg0LjgyNXYtNy44NzVsOS43OTEtLjQ5N3Y4LjM3Mmg3Ljg3NXY3LjgwNWgtNy44NzV2MTUuMTgzYzAgNC4xMTUgMS43MDIgNi4wMyA0Ljg5NSA2LjAzYTE3LjIgMTcuMiAwIDAgMCAzLjc2LS40MjVsLjQ5NyA3Ljg3NWEyNyAyNyAwIDAgMS02LjE3My42MzgiLz48cGF0aCBmaWxsPSJ1cmwoI2EpIiBkPSJNMjE2LjU0MyAyMTEuNDA1YzUxLjgwOCAwIDc3LjcxMy0zNC41MzkgMTAzLjYxNy02OS4wNzlIMTQ4LjI0OXY2OS4wNzl6Ii8+PHBhdGggZmlsbD0idXJsKCNiKSIgZD0iTTQyMy43NzcgNzMuMjQ4Yy01MS44MDggMC03Ny43MTMgMzQuNTM5LTEwMy42MTcgNjkuMDc4aDE3MS45MTFWNzMuMjQ4eiIvPjwvc3ZnPg==" alt=""> <?php \esc_html_e( 'Bancontact', 'pronamic-forms' ); ?></label></div>
<!-- /wp:pronamic/form-radio-option -->

<!-- wp:pronamic/form-radio-option {"value":"card","reference":"pronamic_pay_payment_method"} -->
<div class="wp-block-pronamic-form-radio-option"><input class="wp-block-pronamic-form-control__element" name="" value="card" type="radio"/> <label><img class="pronamic-forms-radio-option-image" style="width: 48px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NDAiIGhlaWdodD0iMzYwIj48cGF0aCBmaWxsPSIjMkMzMzQxIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik00NzAgMTY0Ljc5NHY5Ny41ODFjMCA4LjI5MS02LjcxNiAxNS4wMTMtMTUgMTUuMDEzSDE4NWMtOC4yODQgMC0xNS02LjcyMi0xNS0xNS4wMTN2LTk3LjU4ek0yOTIuNTQ4IDIzMi41aC04MC4xMzNjLTIuNzY2IDAtNS4wMDkgMi4yNi01LjAwOSA1LjA1IDAgMi43MDQgMi4xMDkgNC45MTIgNC43NTkgNS4wNDRsLjI1LjAwNmg4MC4xMzNjMi43NjYgMCA1LjAwOC0yLjI2MSA1LjAwOC01LjA1IDAtMi43OS0yLjI0Mi01LjA1LTUuMDA4LTUuMDVtLTQ1LjI0MS0yNS4wNjJoLTM0LjkxM2MtMi43NTUgMC00Ljk4OCAyLjI2LTQuOTg4IDUuMDUgMCAyLjcwNCAyLjEgNC45MTIgNC43NCA1LjA0M2wuMjQ4LjAwNmgzNC45MTNjMi43NTQgMCA0Ljk4Ny0yLjI2IDQuOTg3LTUuMDUgMC0yLjc4OC0yLjIzMy01LjA1LTQuOTg3LTUuMDVtNTcuNjA2IDBIMjcwYy0yLjc1NSAwLTQuOTg4IDIuMjYtNC45ODggNS4wNSAwIDIuNzA0IDIuMSA0LjkxMiA0Ljc0IDUuMDQzbC4yNDguMDA2aDM0LjkxM2MyLjc1NCAwIDQuOTg3LTIuMjYgNC45ODctNS4wNSAwLTIuNzg4LTIuMjMzLTUuMDUtNC45ODctNS4wNW01Ny42MDYgMGgtMzQuOTEzYy0yLjc1NSAwLTQuOTg4IDIuMjYtNC45ODggNS4wNSAwIDIuNzA0IDIuMSA0LjkxMiA0Ljc0IDUuMDQzbC4yNDguMDA2aDM0LjkxM2MyLjc1NCAwIDQuOTg3LTIuMjYgNC45ODctNS4wNSAwLTIuNzA0LTIuMS00LjkxMi00LjczOC01LjA0M3ptNTcuNjA2IDBoLTM0LjkxM2MtMi43NTUgMC00Ljk4OCAyLjI2LTQuOTg4IDUuMDUgMCAyLjcwNCAyLjEgNC45MTIgNC43MzkgNS4wNDNsLjI0OS4wMDZoMzQuOTEzYzIuNzU0IDAgNC45ODctMi4yNiA0Ljk4Ny01LjA1IDAtMi43MDQtMi4xLTQuOTEyLTQuNzM4LTUuMDQzek00NTUgODIuNWM4LjI4NCAwIDE1IDYuNjk5IDE1IDE0Ljk2M3YyMi40NDNIMTcwVjk3LjQ2M2MwLTguMjY0IDYuNzE2LTE0Ljk2MyAxNS0xNC45NjN6Ii8+PC9zdmc+" alt=""> <?php \esc_html_e( 'Card', 'pronamic-forms' ); ?></label></div>
<!-- /wp:pronamic/form-radio-option -->

<!-- wp:pronamic/form-radio-option {"value":"ideal","reference":"pronamic_pay_payment_method"} -->
<div class="wp-block-pronamic-form-radio-option"><input class="wp-block-pronamic-form-control__element" name="" value="ideal" type="radio"/> <label><img class="pronamic-forms-radio-option-image" style="width: 48px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbDpzcGFjZT0icHJlc2VydmUiIGlkPSJMYXllcl8xIiB3aWR0aD0iNjQwIiBoZWlnaHQ9IjM2MCIgeD0iMCIgeT0iMCIgdmVyc2lvbj0iMS4xIj48c3R5bGUgaWQ9InN0eWxlMTYxIiB0eXBlPSJ0ZXh0L2NzcyI+LnN0MHtmaWxsOiNmZmZ9PC9zdHlsZT48ZyBpZD0iZzE5MSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTI5Ljk2NCAxMi41KXNjYWxlKDEuMjQxNjYpIj48ZyBpZD0iZzE3MyI+PHBhdGggaWQ9InBhdGgxNjMiIGQ9Ik0wIDIwdjIyOS44YzAgMTEgOSAyMCAyMCAyMGgxMzcuM2MxMDMuOCAwIDE0OC44LTU4LjEgMTQ4LjgtMTM1LjJDMzA2LjEgNTcuOSAyNjEuMSAwIDE1Ny4zIDBIMjBDOSAwIDAgOSAwIDIwIiBjbGFzcz0ic3QwIi8+PHBhdGggaWQ9InBhdGgxNjUiIGQ9Ik05MS45IDU2LjR2MTY5LjhoNzMuOWM2Ny4xIDAgOTYuMi0zNy45IDk2LjItOTEuNSAwLTUxLjMtMjkuMS05MS4xLTk2LjItOTEuMWgtNjEuMWMtNy4xIDAtMTIuOCA1LjgtMTIuOCAxMi44IiBzdHlsZT0iZmlsbDojYzA2Ii8+PGcgaWQ9ImcxNzEiPjxnIGlkPSJnMTY5Ij48cGF0aCBpZD0icGF0aDE2NyIgZD0iTTE1Ny4zIDI1MS41SDM3LjljLTEwLjYgMC0xOS4yLTguNi0xOS4yLTE5LjJWMzcuNmMwLTEwLjYgOC42LTE5LjIgMTkuMi0xOS4yaDExOS40YzExMy4zIDAgMTMwLjIgNzIuOSAxMzAuMiAxMTYuMyAwIDc1LjMtNDYuMyAxMTYuOC0xMzAuMiAxMTYuOE0zNy45IDI0LjhjLTcuMSAwLTEyLjggNS43LTEyLjggMTIuOHYxOTQuN2MwIDcuMSA1LjcgMTIuOCAxMi44IDEyLjhoMTE5LjRjNzkuOCAwIDEyMy44LTM5LjIgMTIzLjgtMTEwLjQgMC05NS42LTc3LjYtMTA5LjktMTIzLjgtMTA5Ljl6Ii8+PC9nPjwvZz48L2c+PGcgaWQ9ImcxODMiPjxwYXRoIGlkPSJwYXRoMTc1IiBkPSJNMTE3LjkgMTExLjhjMi42IDAgNSAuNCA3LjMgMS4yczQuMiAyLjEgNS45IDMuN2MxLjYgMS43IDIuOSAzLjggMy45IDYuMi45IDIuNSAxLjQgNS40IDEuNCA4LjggMCAzLS40IDUuNy0xLjEgOC4yLS44IDIuNS0xLjkgNC43LTMuNCA2LjVzLTMuNCAzLjItNS43IDQuM2MtMi4zIDEtNSAxLjYtOC4xIDEuNmgtMTcuNXYtNDAuNmgxNy4zem0tLjYgMzMuMWMxLjMgMCAyLjUtLjIgMy44LS42IDEuMi0uNCAyLjMtMS4xIDMuMi0yLjFzMS43LTIuMiAyLjMtMy44LjktMy40LjktNS43YzAtMi0uMi0zLjktLjYtNS41cy0xLjEtMy4xLTItNC4yLTIuMS0yLjEtMy42LTIuNy0zLjMtLjktNS41LS45aC02LjRWMTQ1aDcuOXoiIGNsYXNzPSJzdDAiLz48cGF0aCBpZD0icGF0aDE3NyIgZD0iTTE3Mi41IDExMS44djcuNWgtMjEuNHY4LjdoMTkuN3Y2LjloLTE5Ljd2OS45SDE3M3Y3LjVoLTMwLjh2LTQwLjZoMzAuM3oiIGNsYXNzPSJzdDAiLz48cGF0aCBpZD0icGF0aDE3OSIgZD0ibTIwMy4xIDExMS44IDE1LjIgNDAuNkgyMDlsLTMuMS05aC0xNS4ybC0zLjIgOWgtOWwxNS4zLTQwLjZ6bS41IDI0LjktNS4xLTE0LjloLS4xbC01LjMgMTQuOXoiIGNsYXNzPSJzdDAiLz48cGF0aCBpZD0icGF0aDE4MSIgZD0iTTIzMi44IDExMS44djMzLjFoMTkuOHY3LjVoLTI4Ljd2LTQwLjZ6IiBjbGFzcz0ic3QwIi8+PC9nPjxnIGlkPSJnMTg3Ij48Y2lyY2xlIGlkPSJjaXJjbGUxODUiIGN4PSI1OC41IiBjeT0iMTMyLjEiIHI9IjE4LjciLz48L2c+PHBhdGggaWQ9InBhdGgxODkiIGQ9Ik03Mi42IDIyNi4yYy0xNS43IDAtMjguMy0xMi43LTI4LjMtMjguM3YtMjIuMWMwLTcuOCA2LjMtMTQuMiAxNC4yLTE0LjIgNy44IDAgMTQuMiA2LjMgMTQuMiAxNC4ydjUwLjR6Ii8+PC9nPjwvc3ZnPg==" alt=""> <?php \esc_html_e( 'iDEAL', 'pronamic-forms' ); ?></label></div>
<!-- /wp:pronamic/form-radio-option --></div></div>
<!-- /wp:pronamic/form-radio-field -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><?php \esc_html_e( 'By making a recurring donation, you authorize automatic collection of future payments. For Bancontact, iDEAL, and SOFORT Banking, future payments will be collected via SEPA direct debit.', 'pronamic-forms' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"tagName":"button","type":"submit"} -->
<div class="wp-block-button"><button type="submit" class="wp-block-button__link wp-element-button"><?php \esc_html_e( 'Donate', 'pronamic-forms' ); ?></button></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></form>
<!-- /wp:pronamic/form -->
