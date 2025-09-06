<?php
namespace Elementor;

use Elementor\Controls_Manager;

defined('ABSPATH') || die();

class ElementsKit_Liquid_Glass {
	public  function __construct() {
		// Register the module controls
		add_action( 'elementor/element/column/section_advanced/after_section_end', [ $this, 'register_module_controls' ], 10 );
		add_action( 'elementor/element/section/section_advanced/after_section_end', [ $this, 'register_module_controls' ], 10 );
		add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'register_module_controls' ], 10 );

		// Flexbox Container support
		add_action( 'elementor/element/container/section_layout/after_section_end', array( $this, 'register_module_controls' ) );

		// Hooks the 'register_widget_controls' method to the 'ekit/liquid/glass' action.
		add_action( 'ekit/liquid/glass/controls', [ $this, 'register_widget_controls' ], 10, 3 );

		// Adds a filter to modify the attributes for the Liquid Glass widget.
		add_filter( 'ekit/liquid/glass/attr', [ $this, 'render_widget_attributes'], 10, 4 );
	}

	public function enqueue_frontend_scripts($key = 'ekit_liquid_glass_enable') {
		return [
			'scripts' => [
				[
					'name' => 'ekit-liquid-glass',
					'conditions' => [
						'terms' => [
							[
								'name' => $key,
								'operator' => '===',
								'value' => 'yes',
							],
						],
					],
				],
			],
			'styles' => [
				[
					'name' => 'ekit-liquid-glass',
					'conditions' => [
						'terms' => [
							[
								'name' => $key,
								'operator' => '===',
								'value' => 'yes',
							],
						],
					],
				],
			],
		];
	}

	public function register_module_controls($element) {
		$element->start_controls_section(
			'elementskit_liquid_glass_section',
			[
				'label' => esc_html__( 'Elementskit Liquid Glass', 'elementskit' ),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'ekit_liquid_glass_enable',
			[
				'label' => esc_html__('Enable Liquid Glass', 'elementskit'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'elementskit' ),
				'label_off' => esc_html__( 'No', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
				'assets' => $this->enqueue_frontend_scripts(),
			]
		);

		$element->add_control(
			'ekit_liquid_glass_preset',
			[
				'label' => esc_html__( 'Liquid Glass Effect', 'elementskit' ),
				'description' => esc_html__( 'Tip: Use a semi-transparent background to see the effect clearly.', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'preset2',
				'options' => [
					'preset1'  => esc_html__( 'Soft Ripple', 'elementskit' ),
					'preset2'  => esc_html__( 'Deep Glass', 'elementskit' ),
					'preset3'  => esc_html__( 'Crystal Flow', 'elementskit' ),
					'preset4'  => esc_html__( 'Heavy Distortion', 'elementskit' ),
					'preset5'  => esc_html__( 'Liquid Mist', 'elementskit' ),
					'preset6'  => esc_html__( 'Vertical Wave', 'elementskit' ),
					'preset7'  => esc_html__( 'Horizontal Flow', 'elementskit' ),
					'preset8'  => esc_html__( 'Balanced Blur', 'elementskit' ),
					'preset9'  => esc_html__( 'Glass Storm', 'elementskit' ),
					'preset10' => esc_html__( 'Molten Glass', 'elementskit' ),
				],
				'render_type' => 'template',
				'prefix_class' => 'ekit-liquid-glass-',
				'condition' => [
					'ekit_liquid_glass_enable' => 'yes',
				],
			]
		);

		$element->add_control(
			'ekit_liquid_glass_blur',
			[
				'label' => esc_html__('Blur Strength', 'elementskit'),
				'description' => esc_html__('Leave empty to use the default value of the selected preset.', 'elementskit'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ekit-liquid-glass-blur: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_liquid_glass_enable' => 'yes',
				],
			]
		);

		$element->add_control(
			'ekit_liquid_glass_shadow',
			[
				'label' => esc_html__( 'Shadow', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'shadow1',
				'options' => [
					'none' => esc_html__( 'None', 'elementskit' ),
					'shadow1' => esc_html__( 'Shadow Preset 01', 'elementskit' ),
					'shadow2' => esc_html__( 'Shadow Preset 02', 'elementskit' ),
					'shadow3' => esc_html__( 'Shadow Preset 03', 'elementskit' ),
					'shadow4' => esc_html__( 'Shadow Preset 04', 'elementskit' ),
					'shadow5' => esc_html__( 'Shadow Preset 05', 'elementskit' ),
					'shadow6' => esc_html__( 'Shadow Preset 06', 'elementskit' ),
					'shadow7' => esc_html__( 'Shadow Preset 07', 'elementskit' ),
					'shadow8' => esc_html__( 'Shadow Preset 08', 'elementskit' ),
					'shadow9' => esc_html__( 'Shadow Preset 09', 'elementskit' ),
					'shadow10' => esc_html__( 'Shadow Preset 10', 'elementskit' ),
					'custom' => esc_html__( 'Custom Shadow', 'elementskit' ),
				],
				// 'render_type' => 'template',
				'prefix_class' => 'ekit-liquid-glass-',
				'condition' => [
					'ekit_liquid_glass_enable' => 'yes',
				],
				'selectors_dictionary' => [
					'none' => '',
					'shadow1' => 'box-shadow: 0 0 15px 0 rgba(255, 255 ,255, 0.6) inset;',
					'shadow2' => 'box-shadow: 0 0 20px 0 rgba(255, 255, 255, 0.65) inset;',
					'shadow3' => 'box-shadow: 0 0 15px 0 rgba(255, 255, 255, 0.7) inset;',
					'shadow4' => 'box-shadow: 0 20px 15px -5px rgba(255, 255, 255, 0.5) inset;',
					'shadow5' => 'box-shadow: 0 0 30px 1px rgba(255, 255, 255, 0.7) inset;',
					'shadow6' => 'box-shadow: 0 -20px 25px -15px rgba(255, 255, 255, 0.5) inset;',
					'shadow7' => 'box-shadow: 0 10px 25px -10px rgba(255, 255, 255, 0.4) inset;',
					'shadow8' => 'box-shadow: 0 -10px 20px -5px rgba(255, 255, 255, 0.55) inset;',
					'shadow9' => 'box-shadow: 0 0 40px 5px rgba(255, 255, 255, 0.6) inset;',
					'shadow10' => 'box-shadow: 0 15px 15px -10px rgba(255, 255, 255, 0.45) inset;',
					'custom' => '',
				],
				'selectors' => [
					'{{WRAPPER}}' => '{{VALUE}};',
				],
			]
		);

		$element->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ekit_liquid_glass_shadow_custom',
				'label' => esc_html__( 'Custom Shadow', 'elementskit' ),
				'fields_options' => [
					'box_shadow' => [
						'default'	=> [
							'color' => 'rgba(255, 255, 255, 0.5)',
							'horizontal' => 0,
							'vertical' => 0,
							'blur' => 15,
							'spread' => 0,
							'position' => 'inset',
						],
					],
				],
				'condition' => [
					'ekit_liquid_glass_enable' => 'yes',
					'ekit_liquid_glass_shadow' => 'custom',
				],
				'selector' => '{{WRAPPER}}',
			]
		);

		$element->end_controls_section();
	}

	/**
	 * Registers the controls for the Liquid Glass effect in the Elementor widget panel.
	 *
	 * Adds a popover toggle to enable or disable the Liquid Glass effect, and provides
	 * additional controls for selecting effect presets, adjusting blur strength, and
	 * configuring shadow options (including custom shadows).
	 *
	 * @param object $element   The Elementor widget or section object to which controls are added.
	 * @param string $selector  (Optional) CSS selector for applying styles. Default '{{WRAPPER}}'.
	 * @param string $id_suffix (Optional) Suffix to append to control IDs for uniqueness.
	 *
	 * Controls added:
	 * - Enable Liquid Glass (popover toggle)
	 * - Liquid Glass Effect (preset selection)
	 * - Blur Strength (slider)
	 * - Shadow (preset selection with selectors dictionary)
	 * - Custom Shadow (group control, shown when 'custom' shadow is selected)
	 *
	 * @return void
	 */
	public function register_widget_controls($element, $selector = '{{WRAPPER}}', $id_suffix = '') {
		if (!is_object($element)) {
			return;
		}

		$element->add_control(
			'ekit_enable_widget_liquid_glass' . $id_suffix,
			[
				'label' => esc_html__('Enable Liquid Glass', 'elementskit'),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_on' => esc_html__( 'Yes', 'elementskit' ),
				'label_off' => esc_html__( 'No', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
				'assets' => $this->enqueue_frontend_scripts('ekit_enable_widget_liquid_glass' . $id_suffix),
			]
		);

		$element->start_popover();

		$element->add_control(
			'ekit_widget_liquid_glass_preset' . $id_suffix,
			[
				'label' => esc_html__( 'Liquid Glass Effect', 'elementskit' ),
				'description' => esc_html__( 'Tip: Use a semi-transparent background to see the effect clearly.', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'preset2',
				'options' => [
					'preset1'  => esc_html__( 'Soft Ripple', 'elementskit' ),
					'preset2'  => esc_html__( 'Deep Glass', 'elementskit' ),
					'preset3'  => esc_html__( 'Crystal Flow', 'elementskit' ),
					'preset4'  => esc_html__( 'Heavy Distortion', 'elementskit' ),
					'preset5'  => esc_html__( 'Liquid Mist', 'elementskit' ),
					'preset6'  => esc_html__( 'Vertical Wave', 'elementskit' ),
					'preset7'  => esc_html__( 'Horizontal Flow', 'elementskit' ),
					'preset8'  => esc_html__( 'Balanced Blur', 'elementskit' ),
					'preset9'  => esc_html__( 'Glass Storm', 'elementskit' ),
					'preset10' => esc_html__( 'Molten Glass', 'elementskit' ),
				],
				'render_type' => 'template',
				'condition' => [
					'ekit_enable_widget_liquid_glass' . $id_suffix => 'yes',
				],
			]
		);

		$element->add_control(
			'ekit_widget_liquid_glass_blur' . $id_suffix,
			[
				'label' => esc_html__('Blur Strength', 'elementskit'),
				'description' => esc_html__('Leave empty to use the default value of the selected preset.', 'elementskit'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					$selector => '--ekit-liquid-glass-blur: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_enable_widget_liquid_glass' . $id_suffix => 'yes',
				],
			]
		);

		$element->add_control(
			'ekit_widget_liquid_glass_shadow' . $id_suffix,
			[
				'label' => esc_html__( 'Shadow', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				// 'default' => 'shadow3',
				'options' => [
					'none' => esc_html__( 'None', 'elementskit' ),
					'shadow1' => esc_html__( 'Shadow Preset 01', 'elementskit' ),
					'shadow2' => esc_html__( 'Shadow Preset 02', 'elementskit' ),
					'shadow3' => esc_html__( 'Shadow Preset 03', 'elementskit' ),
					'shadow4' => esc_html__( 'Shadow Preset 04', 'elementskit' ),
					'shadow5' => esc_html__( 'Shadow Preset 05', 'elementskit' ),
					'shadow6' => esc_html__( 'Shadow Preset 06', 'elementskit' ),
					'shadow7' => esc_html__( 'Shadow Preset 07', 'elementskit' ),
					'shadow8' => esc_html__( 'Shadow Preset 08', 'elementskit' ),
					'shadow9' => esc_html__( 'Shadow Preset 09', 'elementskit' ),
					'shadow10' => esc_html__( 'Shadow Preset 10', 'elementskit' ),
					'custom' => esc_html__( 'Custom Shadow', 'elementskit' ),
				],
				'condition' => [
					'ekit_enable_widget_liquid_glass' . $id_suffix => 'yes',
				],
				'selectors_dictionary' => [
					'none' => '',
					'shadow1' => 'box-shadow: 0 0 15px 0 rgba(255, 255 ,255, 0.6) inset;',
					'shadow2' => 'box-shadow: 0 0 20px 0 rgba(255, 255, 255, 0.65) inset;',
					'shadow3' => 'box-shadow: 0 0 15px 0 rgba(255, 255, 255, 0.7) inset;',
					'shadow4' => 'box-shadow: 0 20px 15px -5px rgba(255, 255, 255, 0.5) inset;',
					'shadow5' => 'box-shadow: 0 0 30px 1px rgba(255, 255, 255, 0.7) inset;',
					'shadow6' => 'box-shadow: 0 -20px 25px -15px rgba(255, 255, 255, 0.5) inset;',
					'shadow7' => 'box-shadow: 0 10px 25px -10px rgba(255, 255, 255, 0.4) inset;',
					'shadow8' => 'box-shadow: 0 -10px 20px -5px rgba(255, 255, 255, 0.55) inset;',
					'shadow9' => 'box-shadow: 0 0 40px 5px rgba(255, 255, 255, 0.6) inset;',
					'shadow10' => 'box-shadow: 0 15px 15px -10px rgba(255, 255, 255, 0.45) inset;',
					'custom' => '',
				],
				'selectors' => [
					$selector => '{{VALUE}};',
				],
			]
		);

		$element->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ekit_widget_liquid_glass_shadow_custom' . $id_suffix,
				'label' => esc_html__( 'Custom Shadow', 'elementskit' ),
				'fields_options' => [
					'box_shadow' => [
						'default'	=> [
							'color' => 'rgba(255, 255, 255, 0.5)',
							'horizontal' => 0,
							'vertical' => 0,
							'blur' => 15,
							'spread' => 0,
							'position' => 'inset',
						],
					],
				],
				'condition' => [
					'ekit_enable_widget_liquid_glass' . $id_suffix => 'yes',
					'ekit_widget_liquid_glass_shadow' . $id_suffix => 'custom',
				],
				'selector' => $selector,
			]
		);

		$element->end_popover();
	}

	/**
	 * Adds and prints custom "liquid glass" CSS classes to an Elementor element based on widget settings.
	 *
	 * This function checks if the "liquid glass" effect is enabled in the provided settings array.
	 * If enabled, it appends the appropriate CSS classes for the preset and shadow options to the element.
	 * The classes are added using Elementor's render attribute system, and the attribute string is printed.
	 *
	 * @param object $element   The Elementor element object to which attributes will be added.
	 * @param string $class     Additional CSS classes to append (optional).
	 * @param string $id_suffix Optional suffix to distinguish between multiple widget instances.
	 *
	 * @return void
	 */
	public function render_widget_attributes(object $element, string $id_suffix = ''): string {
		$settings = $element->get_settings_for_display();

		// 1. Define setting keys using the suffix for reusability.
		$enable_key = 'ekit_enable_widget_liquid_glass' . $id_suffix;
		$preset_key = 'ekit_widget_liquid_glass_preset' . $id_suffix;
		$shadow_key = 'ekit_widget_liquid_glass_shadow' . $id_suffix;

		// 2. Initialize an array with any base classes passed to the function.
		// This handles multiple classes in the initial string.
		$classes = [];

		// 3. Conditionally add liquid glass classes if the feature is enabled in settings.
		if (!empty($settings[$enable_key]) && 'yes' === $settings[$enable_key]) {
			// Add preset class if it exists in settings
			if (!empty($settings[$preset_key])) {
				$classes[] = 'ekit-liquid-glass-' . $settings[$preset_key];
			}

			// Add shadow class if it exists in settings
			if (!empty($settings[$shadow_key])) {
				$classes[] = 'ekit-liquid-glass-' . $settings[$shadow_key];
			}
		}

		// 4. If there are no classes to apply, exit early.
		if (empty($classes)) {
			return '';
		}

		// 5. Build the final class string, filtering out any empty array elements.
		$final_class_string = implode(' ', array_filter($classes));

		return $final_class_string;
	}
}
