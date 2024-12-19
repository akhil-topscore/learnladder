<?php

namespace Topscore_Extra\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

/**
 *
 * Section Title Widget .
 *
 */
class Section_Title_Widget extends Widget_Base
{

	public function get_name()
	{
		return 'section-title';
	}

	public function get_title()
	{
		return __('Section Title', 'topscore-extra');
	}

	public function get_icon()
	{
		return 'eicon-animated-headline';
	}

	public function get_keywords()
	{
		return ['title', 'heading', 'section'];
	}

	public function get_style_depends()
	{
		return ['title-style'];
	}

	public function get_categories()
	{
		return ['topscore-extra'];
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'section_title_section',
			[
				'label'		 	=> __('Section Title', 'topscore-extra'),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'section_subtitle',
			[
				'label' 	=> __('Section Subtitle', 'topscore-extra'),
				'type' 		=> Controls_Manager::TEXTAREA,
				'default'  	=> __('Section Subtitle', 'topscore-extra'),
			]
		);

		$this->add_control(
			'section_subtitle_tag',
			[
				'label' 	=> __('Subitle Tag', 'topscore-extra'),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'p'  => 'P',
					'span'  => 'span',
				],
				'default' 	=> 'span',
				'condition'	=> ['section_subtitle!' => '']
			]
		);

		$this->add_control(
			'section_title',
			[
				'label' 	=> __('Section Title', 'topscore-extra'),
				'type' 		=> Controls_Manager::TEXTAREA,
				'default'  	=> __('Section Title', 'topscore-extra')
			]
		);

		$this->add_control(
			'section_title_tag',
			[
				'label' 	=> __('Title Tag', 'topscore-extra'),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'span'  => 'span',
				],
				'default' => 'h2',
			]
		);

		$this->add_control(
			'section_description',
			[
				'label' 	=> __('Section Description', 'topscore-extra'),
				'type' 		=> Controls_Manager::TEXTAREA,
				'default'  	=> __('Section Description', 'topscore-extra')
			]
		);

		$this->add_responsive_control(
			'section_align',
			[
				'label' 		=> __('Alignment', 'topscore-extra'),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' 	=> [
						'title' 		=> __('Left', 'topscore-extra'),
						'icon' 			=> 'eicon-text-align-left',
					],
					'center' 	=> [
						'title' 		=> __('Center', 'topscore-extra'),
						'icon' 			=> 'eicon-text-align-center',
					],
					'right' 	=> [
						'title' 		=> __('Right', 'topscore-extra'),
						'icon' 			=> 'eicon-text-align-right',
					],
				],
				'default' 	=> 'left',
				'toggle' 	=> true,
				'selectors' 	=> [
					'{{WRAPPER}} .title-area' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style_section',
			[
				'label' => __('Section Title Style', 'topscore-extra'),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'section_title!'    => ''
				]
			]
		);
		topscore_extra_all_elementor_style($this, 'Title', '{{WRAPPER}} .title-selector');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_subtitle_style_section',
			[
				'label' => __('Section Subtitle Style', 'topscore-extra'),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'section_subtitle!'    => ''
				],
			]
		);
		topscore_extra_all_elementor_style($this, 'Subtitle', '{{WRAPPER}} .subtitle-selector');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_style_section',
			[
				'label' => __('Section Description Style', 'topscore-extra'),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'section_description!'    => ''
				]
			]
		);
		topscore_extra_all_elementor_style($this, 'Description', '{{WRAPPER}} .desc-selector');

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		if (! empty($settings['section_description'])) {
			$this->add_render_attribute('wrapper', 'class', 'title-area mb-25');
			$sec_title = 'sec-title mb-20';
		} else {
			$this->add_render_attribute('wrapper', 'class', 'title-area');
			$sec_title = 'sec-title';
		}
		echo '<div ' . $this->get_render_attribute_string('wrapper') . ' >';
		if (!empty($settings['section_subtitle'])) {

			$align = $settings['section_align'] == 'center' ? '' : 'style1';

			echo '<' . esc_attr($settings['section_subtitle_tag']) . ' class="sub-title ' . esc_attr($align) . ' subtitle-selector">';

			echo wp_kses_post($settings['section_subtitle']);

			echo '</' . esc_attr($settings['section_subtitle_tag']) . '>';
		}
		if (! empty($settings['section_title'])) {
			echo '<' . esc_attr($settings['section_title_tag']) . ' class="' . esc_attr($sec_title) . '  title-selector">' . wp_kses_post($settings['section_title']) . '</' . esc_attr($settings['section_title_tag']) . '>';
		}

		if (! empty($settings['section_description'])) {
			echo '<p class="desc-selector">' . wp_kses_post($settings['section_description']) . '</p>';
		}
		echo '</div>';
	}
}
