<?php
// This file is generated. Do not modify it manually.
return array(
	'form' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pronamic/form',
		'version' => '1.0.0',
		'title' => 'Pronamic form',
		'category' => 'pronamic-forms',
		'allowedBlocks' => array(
			'core/buttons',
			'core/paragraph',
			'core/heading',
			'core/group',
			'core/columns',
			'pronamic/form-checkbox-field',
			'pronamic/form-control',
			'pronamic/form-field',
			'pronamic/form-radio-field',
			'pronamic/form-label',
			'pronamic/form-submission-notification',
			'pronamic/hidden-payment-amount'
		),
		'description' => 'The Pronamic Form block makes it easy to add custom forms to your WordPress site.',
		'icon' => 'feedback',
		'keywords' => array(
			'form',
			'payment',
			'pronamic',
			'pronamic-pay'
		),
		'attributes' => array(
			'result' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'providesContext' => array(
			'pronamic/form-result' => 'result'
		),
		'example' => array(
			'attributes' => array(
				
			),
			'innerBlocks' => array(
				array(
					'name' => 'pronamic/form-field',
					'attributes' => array(
						'label' => 'Name',
						'type' => 'text'
					)
				),
				array(
					'name' => 'pronamic/form-field',
					'attributes' => array(
						'label' => 'Email',
						'type' => 'email'
					)
				),
				array(
					'name' => 'pronamic/form-field',
					'attributes' => array(
						'label' => 'Message',
						'type' => 'textarea'
					)
				),
				array(
					'name' => 'core/buttons',
					'innerBlocks' => array(
						array(
							'name' => 'core/button',
							'attributes' => array(
								'tagName' => 'button',
								'type' => 'submit',
								'text' => 'Submit'
							)
						)
					)
				)
			)
		),
		'supports' => array(
			'__experimentalLayout' => array(
				'default' => 'flex'
			),
			'color' => true,
			'html' => false,
			'spacing' => array(
				'margin' => true,
				'padding' => true,
				'blockGap' => true,
				'__experimentalDefaultControls' => array(
					'padding' => true,
					'blockGap' => true
				)
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'textAlign' => true
			)
		),
		'textdomain' => 'pronamic-forms',
		'style' => 'file:style-index.css',
		'editorScript' => 'file:index.js'
	),
	'form-checkbox-field' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pronamic/form-checkbox-field',
		'version' => '1.0.0',
		'title' => 'Multiple-choice field',
		'category' => 'pronamic-forms',
		'ancestor' => array(
			'pronamic/form'
		),
		'allowedBlocks' => array(
			'pronamic/form-checkbox-option'
		),
		'icon' => 'feedback',
		'description' => '',
		'attributes' => array(
			'label' => array(
				'type' => 'rich-text',
				'source' => 'rich-text',
				'selector' => '.wp-block-pronamic-form-label span'
			),
			'name' => array(
				'type' => 'string',
				'default' => ''
			),
			'value' => array(
				'type' => 'string',
				'default' => ''
			),
			'required' => array(
				'type' => 'boolean',
				'default' => false
			),
			'reference' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'providesContext' => array(
			'pronamic/form-field-id' => 'id',
			'pronamic/form-field-name' => 'name'
		),
		'example' => array(
			'attributes' => array(
				'content' => 'Single choice'
			)
		),
		'supports' => array(
			'anchor' => true,
			'html' => false,
			'__experimentalBorder' => array(
				'color' => true,
				'radius' => true,
				'style' => true,
				'width' => true,
				'__experimentalDefaultControls' => array(
					'color' => true,
					'radius' => true,
					'style' => true,
					'width' => true
				)
			),
			'color' => array(
				'background' => true
			),
			'layout' => array(
				'default' => array(
					'type' => 'flex',
					'orientation' => 'vertical'
				)
			),
			'spacing' => array(
				'margin' => true,
				'padding' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'textAlign' => true
			),
			'pronamicFormControlRequired' => true
		),
		'textdomain' => 'pronamic-forms',
		'style' => 'file:style-index.css',
		'editorScript' => 'file:index.js'
	),
	'form-checkbox-option' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pronamic/form-checkbox-option',
		'version' => '1.0.0',
		'title' => 'Multiple-choice option',
		'category' => 'pronamic-forms',
		'ancestor' => array(
			'pronamic/form'
		),
		'icon' => 'feedback',
		'description' => '',
		'attributes' => array(
			'name' => array(
				'type' => 'string',
				'default' => ''
			),
			'value' => array(
				'type' => 'string',
				'default' => ''
			),
			'label' => array(
				'type' => 'rich-text',
				'source' => 'rich-text',
				'selector' => 'label'
			),
			'checked' => array(
				'type' => 'boolean',
				'default' => false
			),
			'paymentAmount' => array(
				'type' => 'string',
				'deafult' => ''
			)
		),
		'usesContext' => array(
			'pronamic/form-field-id',
			'pronamic/form-field-name'
		),
		'supports' => array(
			'splitting' => true,
			'pronamicFormControlRequired' => true,
			'pronamicFormsAutoGenerateName' => true,
			'pronamicFormsAutoGenerateValue' => true,
			'__experimentalBorder' => array(
				'color' => true,
				'radius' => true,
				'style' => true,
				'width' => true,
				'__experimentalDefaultControls' => array(
					'color' => true,
					'radius' => true,
					'style' => true,
					'width' => true
				)
			),
			'color' => array(
				'background' => true
			),
			'spacing' => array(
				'margin' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'textAlign' => true
			)
		),
		'textdomain' => 'pronamic-forms',
		'style' => array(
			'pronamic-form-control-style',
			'file:style-index.css'
		),
		'editorScript' => 'file:./index.js'
	),
	'form-control' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pronamic/form-control',
		'version' => '1.0.0',
		'title' => 'Form control',
		'category' => 'pronamic-forms',
		'ancestor' => array(
			'pronamic/form'
		),
		'icon' => 'feedback',
		'description' => '',
		'attributes' => array(
			'name' => array(
				'type' => 'string',
				'default' => ''
			),
			'value' => array(
				'type' => 'string',
				'default' => ''
			),
			'type' => array(
				'type' => 'string',
				'default' => 'text',
				'enum' => array(
					'text',
					'textarea',
					'url',
					'email',
					'password',
					'tel',
					'checkbox',
					'radio'
				)
			),
			'placeholder' => array(
				'type' => 'string',
				'default' => ''
			),
			'required' => array(
				'type' => 'boolean',
				'default' => false
			),
			'reference' => array(
				'type' => 'string',
				'default' => ''
			),
			'checked' => array(
				'type' => 'boolean',
				'default' => false
			)
		),
		'example' => array(
			'attributes' => array(
				'type' => 'text',
				'value' => 'Text'
			)
		),
		'usesContext' => array(
			'pronamic/form-field-id',
			'pronamic/form-field-name',
			'pronamic/form-field-value'
		),
		'selectors' => array(
			'border' => '.wp-block-pronamic-form-control__element',
			'color' => '.wp-block-pronamic-form-control__element'
		),
		'supports' => array(
			'anchor' => true,
			'color' => array(
				'__experimentalSkipSerialization' => true,
				'background' => true
			),
			'html' => false,
			'__experimentalBorder' => array(
				'__experimentalSkipSerialization' => true,
				'color' => true,
				'radius' => true,
				'style' => true,
				'width' => true,
				'__experimentalDefaultControls' => array(
					'color' => true,
					'radius' => true,
					'style' => true,
					'width' => true
				)
			),
			'spacing' => array(
				'margin' => true,
				'padding' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'textAlign' => true
			),
			'pronamicFormControlRequired' => true,
			'pronamicFormsAutoGenerateName' => true
		),
		'textdomain' => 'pronamic-forms',
		'style' => 'file:style-index.css',
		'editorScript' => 'file:index.js'
	),
	'form-field' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pronamic/form-field',
		'version' => '1.0.0',
		'title' => 'Form field',
		'category' => 'pronamic-forms',
		'ancestor' => array(
			'pronamic/form'
		),
		'icon' => 'feedback',
		'description' => '',
		'attributes' => array(
			'label' => array(
				'type' => 'rich-text',
				'source' => 'rich-text',
				'selector' => '.wp-block-pronamic-form-label label'
			),
			'name' => array(
				'type' => 'string',
				'default' => ''
			),
			'value' => array(
				'type' => 'string',
				'default' => ''
			),
			'type' => array(
				'type' => 'string',
				'default' => 'text',
				'enum' => array(
					'text',
					'textarea',
					'url',
					'email',
					'password',
					'tel'
				)
			),
			'placeholder' => array(
				'type' => 'string',
				'default' => ''
			),
			'required' => array(
				'type' => 'boolean',
				'default' => false
			),
			'reference' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'providesContext' => array(
			'pronamic/form-field-id' => 'id',
			'pronamic/form-field-name' => 'name'
		),
		'example' => array(
			'attributes' => array(
				'label' => 'Label',
				'type' => 'text'
			)
		),
		'supports' => array(
			'anchor' => true,
			'html' => false,
			'color' => array(
				'background' => true
			),
			'spacing' => array(
				'margin' => true,
				'padding' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'textAlign' => true
			),
			'pronamicFormControlRequired' => true,
			'pronamicFormsAutoGenerateName' => true
		),
		'textdomain' => 'pronamic-forms',
		'editorScript' => 'file:index.js',
		'style' => array(
			'pronamic-form-control-style',
			'pronamic-form-label-style',
			'file:style-index.css'
		)
	),
	'form-label' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pronamic/form-label',
		'version' => '1.0.0',
		'title' => 'Form label',
		'category' => 'pronamic-forms',
		'ancestor' => array(
			'pronamic/form'
		),
		'icon' => 'feedback',
		'description' => '',
		'attributes' => array(
			'tagName' => array(
				'type' => 'string',
				'default' => 'label'
			),
			'content' => array(
				'type' => 'rich-text',
				'source' => 'rich-text',
				'selector' => 'label, span'
			),
			'htmlFor' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'example' => array(
			'attributes' => array(
				'content' => 'Label'
			)
		),
		'usesContext' => array(
			'pronamic/form-field-id'
		),
		'supports' => array(
			'anchor' => true,
			'html' => false,
			'__experimentalBorder' => array(
				'color' => true,
				'radius' => true,
				'style' => true,
				'width' => true,
				'__experimentalDefaultControls' => array(
					'color' => true,
					'radius' => true,
					'style' => true,
					'width' => true
				)
			),
			'color' => array(
				'background' => true
			),
			'spacing' => array(
				'margin' => true,
				'padding' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'textAlign' => true,
				'__experimentalFontStyle' => true,
				'__experimentalFontWeight' => true,
				'__experimentalLetterSpacing' => true,
				'__experimentalTextTransform' => true
			)
		),
		'textdomain' => 'pronamic-forms',
		'style' => 'file:style-index.css',
		'editorScript' => 'file:index.js'
	),
	'form-radio-field' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pronamic/form-radio-field',
		'version' => '1.0.0',
		'title' => 'Single-choice field',
		'category' => 'pronamic-forms',
		'ancestor' => array(
			'pronamic/form'
		),
		'allowedBlocks' => array(
			'pronamic/form-radio-option'
		),
		'icon' => 'feedback',
		'description' => '',
		'attributes' => array(
			'label' => array(
				'type' => 'rich-text',
				'source' => 'rich-text',
				'selector' => '.wp-block-pronamic-form-label span'
			),
			'name' => array(
				'type' => 'string',
				'default' => ''
			),
			'value' => array(
				'type' => 'string',
				'default' => ''
			),
			'required' => array(
				'type' => 'boolean',
				'default' => false
			),
			'reference' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'providesContext' => array(
			'pronamic/form-field-id' => 'id',
			'pronamic/form-field-name' => 'name',
			'pronamic/form-field-reference' => 'reference',
			'pronamic/form-field-value' => 'value'
		),
		'example' => array(
			'attributes' => array(
				'content' => 'Single choice'
			)
		),
		'supports' => array(
			'__experimentalOnEnter' => true,
			'anchor' => true,
			'html' => false,
			'__experimentalBorder' => array(
				'color' => true,
				'radius' => true,
				'style' => true,
				'width' => true,
				'__experimentalDefaultControls' => array(
					'color' => true,
					'radius' => true,
					'style' => true,
					'width' => true
				)
			),
			'color' => array(
				'background' => true
			),
			'layout' => array(
				'default' => array(
					'type' => 'flex',
					'orientation' => 'vertical'
				)
			),
			'spacing' => array(
				'margin' => true,
				'padding' => true,
				'blockGap' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'textAlign' => true
			),
			'pronamicFormControlRequired' => true,
			'pronamicFormsAutoGenerateName' => true
		),
		'textdomain' => 'pronamic-forms',
		'style' => 'file:style-index.css',
		'editorScript' => 'file:index.js'
	),
	'form-radio-option' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pronamic/form-radio-option',
		'version' => '1.0.0',
		'title' => 'Single-choice option',
		'category' => 'pronamic-forms',
		'ancestor' => array(
			'pronamic/form'
		),
		'icon' => 'feedback',
		'description' => '',
		'attributes' => array(
			'name' => array(
				'type' => 'string',
				'default' => ''
			),
			'value' => array(
				'type' => 'string',
				'default' => ''
			),
			'label' => array(
				'type' => 'rich-text',
				'source' => 'rich-text',
				'selector' => 'label'
			),
			'checked' => array(
				'type' => 'boolean',
				'default' => false
			),
			'reference' => array(
				'type' => 'string',
				'default' => ''
			),
			'paymentAmount' => array(
				'type' => 'string',
				'deafult' => ''
			)
		),
		'usesContext' => array(
			'pronamic/form-field-id',
			'pronamic/form-field-name',
			'pronamic/form-field-reference',
			'pronamic/form-field-value'
		),
		'supports' => array(
			'splitting' => true,
			'pronamicFormControlRequired' => true,
			'pronamicFormsAutoGenerateName' => true,
			'pronamicFormsAutoGenerateValue' => true,
			'__experimentalBorder' => array(
				'color' => true,
				'radius' => true,
				'style' => true,
				'width' => true,
				'__experimentalDefaultControls' => array(
					'color' => true,
					'radius' => true,
					'style' => true,
					'width' => true
				)
			),
			'color' => array(
				'background' => true
			),
			'spacing' => array(
				'margin' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'textAlign' => true
			)
		),
		'textdomain' => 'pronamic-forms',
		'style' => array(
			'pronamic-form-control-style',
			'file:style-index.css'
		),
		'editorScript' => 'file:index.js'
	),
	'form-submission-notification' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pronamic/form-submission-notification',
		'version' => '1.0.0',
		'title' => 'Form submission notification',
		'category' => 'pronamic-forms',
		'ancestor' => array(
			'pronamic/form'
		),
		'icon' => 'megaphone',
		'description' => '',
		'attributes' => array(
			'type' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'usesContext' => array(
			'pronamic/form-result'
		),
		'supports' => array(
			'anchor' => true,
			'html' => false,
			'color' => array(
				'background' => true,
				'link' => true,
				'text' => true
			),
			'spacing' => array(
				'margin' => true,
				'padding' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'textAlign' => true
			)
		),
		'textdomain' => 'pronamic-forms',
		'editorScript' => 'file:index.js',
		'style' => 'file:style-index.css'
	),
	'hidden-payment-amount' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'pronamic/hidden-payment-amount',
		'version' => '1.0.0',
		'title' => 'Hidden payment amount',
		'category' => 'pronamic-forms',
		'description' => 'Hidden payment amount for payment forms.',
		'ancestor' => array(
			'pronamic/form'
		),
		'icon' => 'feedback',
		'attributes' => array(
			'paymentAmount' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'pronamic-forms',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css'
	)
);
