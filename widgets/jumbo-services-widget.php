<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Utils;

class Jumbo_Services_Widget extends Widget_Base {
    public function get_name() {
        return 'jumbo-services';
    }

    public function get_title() {
        return esc_html__( 'Services', 'jumbo-services' );
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_keywords() {
        return [ 'services', 'showcase', 'jumbo' ];
    }

    public function get_custom_help_url() {
        return '#';
    }

    public function get_style_depends() {
		return [ 'jumbo-services-styles' ];
	}

    public function get_script_depends() {
		return [ 'jumbo-services-scripts' ];
	}

	protected function register_controls() {       
        // Content Tab

        // Layout Section
        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__( 'Layout', 'jumbo-services' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
    
            $this->add_responsive_control(
                'layout-align',
                [
                    'label' => esc_html__( 'Align', 'jumbo-services' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'jumbo-services' ),
                            'icon' => 'eicon-align-start-h',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'jumbo-services' ),
                            'icon' => 'eicon-align-center-h',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'jumbo-services' ),
                            'icon' => 'eicon-align-end-h',
                        ],
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
    
        $this->end_controls_section();
        // End Layout Section
        
        // Headings Section
        $this->start_controls_section(
            'section_headings',
            [
                'label' => esc_html__( 'Headings', 'jumbo-services' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

            // Title Control
            $this->add_control(
                'title',
                [
                    'label' => esc_html__( 'Title', 'jumbo-services' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Custom Marketing Solutions', 'jumbo-services' ),
                    'placeholder' => esc_html__( 'Enter your title', 'jumbo-services' ),
                    'label_block' => true,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );
        
            $this->add_control(
                'title_tag',
                [
                    'label' => esc_html__( 'Title HTML Tag', 'jumbo-services' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                        'div' => 'div',
                        'span' => 'span',
                        'p' => 'p',
                    ],
                    'default' => 'h2',
                ]
            );

            // Separator Control
            $this->add_control(
                'hr',
                [
                    'type' => \Elementor\Controls_Manager::DIVIDER,
                ]
            );
            
            // Description Control
            $this->add_control(
                'description',
                [
                    'label' => esc_html__( 'Description', 'jumbo-services' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore', 'jumbo-services' ),
                    'placeholder' => esc_html__( 'Enter your description', 'jumbo-services' ),
                    'rows' => 5,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );
    
        $this->end_controls_section();
        // End Heading Section

        // Services Section
        $this->start_controls_section(
            'section_services',
            [
                'label' => esc_html__( 'Services', 'jumbo-services' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'num_services',
            [
                'label' => esc_html__( 'Number of Services', 'jumbo-services' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '3' => '3',
                    '4' => '4',
                    '6' => '6',
                ],
                'default' => '3',
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs( 'service_tabs' );

        $repeater->start_controls_tab(
            'tab_content',
            [
                'label' => esc_html__( 'Content', 'jumbo-services' ),
            ]
        );

        $repeater->add_control(
            'graphic_element',
            [
                'label' => esc_html__( 'Graphic Element', 'jumbo-services' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'none' => [
                        'title' => esc_html__( 'None', 'jumbo-services' ),
                        'icon' => 'eicon-ban',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'jumbo-services' ),
                        'icon' => 'eicon-image',
                    ],
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'jumbo-services' ),
                        'icon' => 'eicon-star',
                    ],
                ],
                'default' => 'icon',
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __( 'Image', 'jumbo-services' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'jumbo-services' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'heading',
            [
                'label' => esc_html__( 'Heading', 'jumbo-services' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Service Heading', 'jumbo-services' ),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__( 'Description', 'jumbo-services' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'jumbo-services' ),
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'jumbo-services' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Learn More', 'jumbo-services' ),
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'jumbo-services' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'Paste URL or type', 'jumbo-services' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'tab_style',
            [
                'label' => esc_html__( 'Background', 'jumbo-services' ),
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'services',
            [
                'label' => esc_html__( 'Services', 'jumbo-services' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ heading }}}',
                'default' => [
                    [
                        'heading' => esc_html__( 'Service 1', 'jumbo-services' ),
                    ],
                    [
                        'heading' => esc_html__( 'Service 2', 'jumbo-services' ),
                    ],
                    [
                        'heading' => esc_html__( 'Service 3', 'jumbo-services' ),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // End Content Tab

        // Begin Style Tab

        // Headings Section
        $this->start_controls_section(
            'section_headings_style',
            [
                'label' => esc_html__( 'Headings', 'jumbo-services' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            // Heading Label Control
            $this->add_control(
                'heading_label',
                [
                    'label' => esc_html__( 'Heading', 'jumbo-services' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );
            // Heading Text Color Control
            $this->add_control(
                'heading_color',
                [
                    'label' => esc_html__( 'Text Color', 'jumbo-services' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#212121',
                    'selectors' => [
                        '{{WRAPPER}} .jumbo-services-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // Heading Typography Control
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_typography',
                    'selector' => '{{WRAPPER}} .jumbo-services-title',
                    'fields_options' => [
                        'typography' => ['default' => 'yes'],
                        'font_family' => [
                            'default' => 'Poppins',
                        ],
                        'font_weight' => [
                            'default' => '500',
                        ],
                        'font_size' => [
                            'default' => [
                                'size' => 37.28,
                                'unit' => 'px',
                            ],
                        ],
                        'line_height' => [
                            'default' => [
                                'size' => 45.04,
                                'unit' => 'px',
                            ],
                        ],
                        'letter_spacing' => [
                            'default' => [
                                'size' => -1.55,
                                'unit' => 'px',
                            ],
                        ],
                    ],
                ]
            );

            // Separator Control
            $this->add_control(
                'headings_separator',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            // Description Label
            $this->add_control(
                'description_label',
                [
                    'label' => esc_html__( 'Description', 'jumbo-services' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            // Description Text Color Control
            $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Text Color', 'jumbo-services' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#222',
                    'selectors' => [
                        '{{WRAPPER}} .jumbo-services-description' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // Description Typography Control
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .jumbo-services-description',
                    'fields_options' => [
                        'typography' => ['default' => 'yes'],
                        'font_family' => [
                            'default' => 'Poppins',
                        ],
                        'font_weight' => [
                            'default' => '300',
                        ],
                        'font_size' => [
                            'default' => [
                                'size' => 17.08,
                                'unit' => 'px',
                            ],
                        ],
                        'line_height' => [
                            'default' => [
                                'size' => 25.63,
                                'unit' => 'px',
                            ],
                        ],
                    ],
                ]
            );

        $this->end_controls_section();
        // End Headings Style Section

        // Begin Services Style Section
        $this->start_controls_section(
            'section_services_style',
            [
                'label' => esc_html__( 'Services', 'jumbo-services' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            // Columns
            // Columns Label
            $this->add_control(
                'columns_label',
                [
                    'label' => esc_html__( 'Columns', 'jumbo-services' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $this->add_responsive_control(
                'space_between',
                [
                    'label' => esc_html__('Space Between', 'jumbo-services'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 5,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jumbo-services-items' => 'margin-left: -{{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .jumbo-services-item' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            // Separator Control
            $this->add_control(
                'columns_separator',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            // If Icon selected in the services repeater
             // Icon styling
            $this->add_control(
                'icon_label',
                [
                    'label' => esc_html__( 'Icon', 'jumbo-services' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $this->add_control(
                'icon_color',
                [
                    'label' => esc_html__( 'Color', 'jumbo-services' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .jumbo-services-icon i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .jumbo-services-icon svg' => 'fill: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_size',
                [
                    'label' => esc_html__( 'Size', 'jumbo-services' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%'],
                    'range' => [
                        'px' => [
                            'min' => 6,
                            'max' => 300,
                            'step' => 5,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 100,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jumbo-services-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .jumbo-services-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            // If its image selected under services repeater
            // Image styling
            $this->add_control(
                'services_image_label',
                [
                    'label' => esc_html__( 'Image', 'jumbo-services' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $this->add_responsive_control(
                'services_image_size',
                [
                    'label' => esc_html__( 'Size', 'jumbo-services' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%'],
                    'range' => [
                        'px' => [
                            'min' => 6,
                            'max' => 300,
                            'step' => 5,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jumbo-services-img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );            

            // border
            $this->add_control(
                'services_border_label',
                [
                    'label' => esc_html__( 'Border', 'jumbo-services' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $this->add_control(
                'services_image_border',
                [
                    'label' => esc_html__( 'Border', 'jumbo-services'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_off' => esc_html__('No', 'jumbo-services'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_responsive_control(
                'services_image_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'jumbo-services' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 300,
                            'step' => 5,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jumbo-services-border' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            

            $this->add_control(
                'services_image_box_shadow',
                [
                    'label' => esc_html__( 'Box Shadow', 'jumbo-services'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_off' => esc_html__('No', 'jumbo-services'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            // End if styling section for icon and image

            // Heading
            $this->add_control(
                'services_heading_label',
                [
                    'label' => esc_html__( 'Heading', 'jumbo-services' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'services_heading_color',
                [
                    'label' => esc_html__( 'Text Color', 'jumbo-services' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#212121',
                    'selectors' => [
                        '{{WRAPPER}} .jumbo-services-item-title' => 'color: {{VALUE}};',
                    ],
                    
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'services_heading_typography',
                    'selector' => '{{WRAPPER}} .jumbo-services-item-title',
                    'fields_options' => [
                        'typography' => ['default' => 'yes'],
                        'font_family' => [
                            'default' => 'Poppins',
                        ],
                        'font_weight' => [
                            'default' => '600',
                        ],
                        'font_size' => [
                            'default' => [
                                'size' => 18.64,
                                'unit' => 'px',
                            ],
                        ],
                        'line_height' => [
                            'default' => [
                                'size' => 23.3,
                                'unit' => 'px',
                            ],
                        ],
                    ],

                ]
            );

            // Paragraph
            $this->add_control(
                'paragraph_label',
                [
                    'label' => esc_html__( 'Paragraph', 'jumbo-services' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'paragraph_color',
                [
                    'label' => esc_html__( 'Text Color', 'jumbo-services' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .jumbo-services-item-description' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'paragraph_typography',
                    'selector' => '{{WRAPPER}} .jumbo-services-item-description',
                    'fields_options' => [
                        'typography' => ['default' => 'yes'],
                        'font_family' => [
                            'default' => 'Poppins',
                        ],
                        'font_weight' => [
                            'default' => '300',
                        ],
                        'font_size' => [
                            'default' => [
                                'size' => 12.43,
                                'unit' => 'px',
                            ],
                        ],
                        'line_height' => [
                            'default' => [
                                'size' => 18.64,
                                'unit' => 'px',
                            ],
                        ],
                    ],
                ]
            );

            // Button
            $this->add_control(
                'button_label',
                [
                    'label' => esc_html__( 'Button', 'jumbo-services' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'selector' => '{{WRAPPER}} .jumbo-services-item-button',
                    'fields_options' => [
                        'typography' => ['default' => 'yes'],
                        'font_family' => [
                            'default' => 'Poppins',
                        ],
                        'font_weight' => [
                            'default' => '500',
                        ],
                        'font_size' => [
                            'default' => [
                                'size' => 13.98,
                                'unit' => 'px',
                            ],
                        ],
                        'text_decoration' => [
                            'default' => 'underline',
                        ],
                        'line_height' => [
                            'default' => [
                                'size' => 18.64,
                                'unit' => 'px',
                            ],
                        ],
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_icon_position',
                [
                    'label' => esc_html__( 'Icon Position', 'jumbo-services' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'jumbo-services' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'jumbo-services' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'left',
                    'selectors' => [
                        '{{WRAPPER}}' => 'icon-text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_icon_spacing',
                [
                    'label' => esc_html__( 'Icon Spacing', 'jumbo-services' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 50,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jumbo-services-item-button .button-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .jumbo-services-item-button .button-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs( 'button_tabs' );

                $this->start_controls_tab(
                    'button_normal',
                    [
                        'label' => esc_html__( 'Normal', 'jumbo-services' ),
                    ]
                );

                $this->add_control(
                    'button_text_color',
                    [
                        'label' => esc_html__( 'Text Color', 'jumbo-services' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .jumbo-services-item-button' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'button_icon_color',
                    [
                        'label' => esc_html__( 'Icon Color', 'jumbo-services' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .jumbo-services-item-button .button-icon' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'button_background_color',
                    [
                        'label' => esc_html__( 'Background Color', 'jumbo-services' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .jumbo-services-item-button' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'button_hover',
                    [
                        'label' => esc_html__( 'Hover', 'jumbo-services' ),
                    ]
                );

                $this->add_control(
                    'button_text_color_hover',
                    [
                        'label' => esc_html__( 'Text Color', 'jumbo-services' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .jumbo-services-item-button:hover' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'button_icon_color_hover',
                    [
                        'label' => esc_html__( 'Icon Color', 'jumbo-services' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .jumbo-services-item-button:hover .button-icon' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'button_background_color_hover',
                    [
                        'label' => esc_html__( 'Background Color', 'jumbo-services' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .jumbo-services-item-button:hover' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'button_hoover_animation',
                    [
                        'label' => esc_html__('Hover Animation', 'jumbo-services'),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'none',
                        'options' => [
                            'none' => esc_html__('None', 'jumbo-services'),
                            'fade' => esc_html__('Fade', 'jumbo-services'),
                            'zoom' => esc_html__('Zoom', 'jumbo-services'),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .jumbo-services-item-button:hover' => 'animation-name: {{VALUE}};',
                        ],
                    ]
                );

                $this->end_controls_tab();

            $this->end_controls_tabs();
            

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'button_border',
                    'selector' => '{{WRAPPER}} .jumbo-services-item-button',
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow',
                    'selector' => '{{WRAPPER}} .jumbo-services-item-button',
                ]
            );

        $this->end_controls_section();
        // End Services Style Section

        // Begin Background Style Section
        $this->start_controls_section(
            'background_style_section',
            [
                'label' => esc_html__('Background', 'jumbo-services'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            // Background
            $this->add_control(
                'services_background_label',
                [
                    'label' => esc_html__( 'Background', 'jumbo-services' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .jumbo-services-background',
                ]
            );

            // Background Overlay
            $this->add_control(
                'services_background_overlay_label',
                [
                    'label' => esc_html__( 'Background Overlay', 'jumbo-services' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'background_overlay',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .jumbo-services-background::before',
                ]
            );

		$this->end_controls_section();
        // End Background Style Section

        // Border Style Section
        $this->start_controls_section(
            'border_style_section',
            [
                'label' => esc_html__('Border', 'jumbo-services'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'border_style_label',
                [
                    'label' => esc_html__('Border', 'jumbo-services'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'jumbo-services'),
                    'label_off' => esc_html__('No', 'jumbo-services'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_responsive_control(
                'services-border_width',
                [
                    'label' => esc_html__('Border Width', 'jumbo-services'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 20,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jumbo-services-border' => 'border-width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'border_style_label' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'services_border_color',
                [
                    'label' => esc_html__( 'Border Color', 'jumbo-services' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'condition' => [
                        'border_style_label' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jumbo-services-border' => 'border-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'services-border_radius',
                [
                    'label' => esc_html__('Border Radius', 'jumbo-services'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 300,
                            'step' => 5,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jumbo-services-border' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'services_box_shadow',
                [
                    'label' => esc_html__('Box Shadow', 'jumbo-services'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'jumbo-services'),
                    'label_off' => __('No', 'jumbo-services'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

        $this->end_controls_section();
        // End Border Style Section
        // End Style Tab

        // Begin Advanced Tab        
        $this->start_controls_section(
            'services_advanced_layout',
            [
                'label' => esc_html__('Layout', 'jumbo-services'),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        // Layout controls
        $this->add_control(
            'full_width',
            [
                'label' => esc_html__( 'Full Width', 'jumbo-services' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'jumbo-services' ),
                'label_off' => esc_html__( 'No', 'jumbo-services' ),
                'return_value' => 'yes',
                'default' => '',
                'prefix_class' => 'jumbo-services-full-width-',
            ]
        );

        $this->add_responsive_control(
            'services_jumbo_width',
            [
                'label' => esc_html__( 'Jumbo Width', 'jumbo-services' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1400,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1300,
                ],
                'selectors' => [
                    '{{WRAPPER}} .jumbo-services-container' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'full_width!' => 'yes',
                ]
            ]
        );
        
        $this->add_responsive_control(
            'content_width',
            [
                'label' => esc_html__( 'Content Width', 'jumbo-services' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1140,
                ],
                'selectors' => [
                    '{{WRAPPER}} .jumbo-services-container' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'top_padding',
            [
                'label' => esc_html__( 'Top Padding', 'jumbo-services' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 85,
                ],
                'selectors' => [
                    '{{WRAPPER}} .jumbo-services-container' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'bottom_padding',
            [
                'label' => esc_html__( 'Bottom Padding', 'jumbo-services' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 85,
                ],
                'selectors' => [
                    '{{WRAPPER}} .jumbo-services-container' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'element_spacing',
            [
                'label' => esc_html__( 'Element Spacing', 'jumbo-services' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'jumbo-services' ),
                    'none' => esc_html__( 'None', 'jumbo-services' ),
                ],
                'default' => 'default',
            ]
        );

        $this->end_controls_section();
        
        // Custom Section
        $this->start_controls_section(
            'services_custom_section',
            [
                'label' => esc_html__('Custom', 'jumbo-services'),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        // Custom controls
            // CSS ID control
            $this->add_control(
                'services_css_id',
                [
                    'label' => esc_html__( 'CSS ID', 'navbar' ),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => '',
                    'title' => esc_html__( 'Add your custom ID without the "#" prefix.', 'navbar' ),
                    'separator' => 'before',
                ]
            );

            // CSS Classes control
            $this->add_control(
                'services_css_classes',
                [
                    'label' => esc_html__( 'CSS Classes', 'navbar' ),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'prefix_class' => '',
                    'title' => esc_html__( 'Add your custom class without the dot. e.g: my-class', 'navbar' ),
                ]
            );

            // Custom CSS control
            $this->add_control(
                'services_custom_css',
                [
                    'label' => esc_html__( 'Add your own custom CSS here', 'navbar' ),
                    'type' => Controls_Manager::CODE,
                    'language' => 'css',
                    'rows' => 20,
                    'separator' => 'before',
                ]
            );

            // Custom Attributes control
            $this->add_control(
                'custom_attributes',
                [
                    'label' => esc_html__( 'Custom Attributes', 'navbar' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'placeholder' => esc_html__( 'key|value', 'navbar' ),
                    'description' => esc_html__( 'Set custom attributes for the wrapper element. Each attribute in a separate line. Separate attribute key from the value using | character.', 'navbar' ),
                    'separator' => 'before',
                ]
            );
    }    

	protected function render() {
        $settings = $this->get_settings_for_display();
    
        $this->add_render_attribute( 'wrapper', 'class', 'jumbo-services-wrapper' );
        $this->add_render_attribute( 'services', 'class', 'jumbo-services-items' );
        $this->add_render_attribute( 'services', 'class', 'jumbo-services-items-' . $settings['num_services'] );
    
        // Classes for background and border
        $this->add_render_attribute( 'wrapper', 'class', 'jumbo-services-background' );
        if ( 'yes' === $settings['border_style_label'] ) {
            $this->add_render_attribute( 'wrapper', 'class', 'jumbo-services-border' );
        }
        if ( 'yes' === $settings['services_box_shadow'] ) {
            $this->add_render_attribute( 'wrapper', 'class', 'jumbo-services-box-shadow' );
        }

        // Classes for full width
        if ( 'yes' === $settings['full_width'] ) {
            $this->add_render_attribute( 'wrapper', 'class', 'services-full-width' );
        }
    
        $num_services = intval( $settings['num_services'] );
    
        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <div class="jumbo-services-container">
                <div class="jumbo-services-headings">
                    <?php if ( $settings['title'] ) : ?>
                        <<?php echo $settings['title_tag']; ?> class="jumbo-services-title">
                            <?php echo $settings['title']; ?>
                        </<?php echo $settings['title_tag']; ?>>
                    <?php endif; ?>
        
                    <?php if ( $settings['description'] ) : ?>
                        <div class="jumbo-services-description">
                            <?php echo $settings['description']; ?>
                        </div>
                    <?php endif; ?>
                </div>
        
                <?php if ( $num_services > 0 ) : ?>
                    <div <?php echo $this->get_render_attribute_string( 'services' ); ?>>
                        <?php for ( $i = 0; $i < $num_services; $i++ ) : ?>
                            <?php if ( isset( $settings['services'][$i] ) ) : ?>
                                <?php $item = $settings['services'][$i]; ?>
                                <div class="jumbo-services-item">
                                    <?php if ( 'image' === $item['graphic_element'] && ! empty( $item['image']['url'] ) ) : ?>
                                        <div class="jumbo-services-image">
                                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $item, 'image' ); ?>
                                        </div>
                                    <?php elseif ( 'icon' === $item['graphic_element'] && ! empty( $item['icon']['value'] ) ) : ?>
                                        <div class="jumbo-services-icon">
                                            <?php Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </div>
                                    <?php endif; ?>
        
                                    <h3 class="jumbo-services-item-title"><?php echo $item['heading']; ?></h3>
                                    <div class="jumbo-services-item-description">
                                        <?php echo $item['description']; ?>
                                    </div>
        
                                    <?php if ( ! empty( $item['button_text'] ) && ! empty( $item['link']['url'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['link']['url'] ); ?>" class="jumbo-services-item-button">
                                            <?php echo $item['button_text']; ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
    
    protected function content_template() {
        ?>
        <#
            view.addRenderAttribute( 'wrapper', 'class', 'jumbo-services-wrapper' );
            view.addRenderAttribute( 'services', 'class', 'jumbo-services-items' );
            view.addRenderAttribute( 'services', 'class', 'jumbo-services-items-' + settings.num_services );
    
            // Add classes for background and border
            view.addRenderAttribute( 'wrapper', 'class', 'jumbo-services-background' );
            if ( 'yes' === settings.border_style_label ) {
                view.addRenderAttribute( 'wrapper', 'class', 'jumbo-services-border' );
            }
            if ( 'yes' === settings.services_box_shadow ) {
                view.addRenderAttribute( 'wrapper', 'class', 'jumbo-services-box-shadow' );
            }

            if ( 'yes' === settings.full_width ) {
                view.addRenderAttribute( 'wrapper', 'class', 'services-full-width' );
            }
    
            var numServices = parseInt( settings.num_services );
        #>
        <div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
            <div class="jumbo-services-container">
                <div class="jumbo-services-headings">
                    <# if ( settings.title ) { #>
                        <{{{ settings.title_tag }}} class="jumbo-services-title">
                            {{{ settings.title }}}
                        </{{{ settings.title_tag }}}>
                    <# } #>
    
                    <# if ( settings.description ) { #>
                        <div class="jumbo-services-description">
                            {{{ settings.description }}}
                        </div>
                    <# } #>
                </div>
    
                <# if ( numServices > 0 ) { #>
                    <div {{{ view.getRenderAttributeString( 'services' ) }}}>
                        <# for ( var i = 0; i < numServices; i++ ) { #>
                            <# if ( settings.services[i] ) { #>
                                <# var item = settings.services[i]; #>
                                <div class="jumbo-services-item">
                                    <# if ( 'image' === item.graphic_element && item.image.url ) { #>
                                        <div class="jumbo-services-image">
                                            <img src="{{{ item.image.url }}}" alt="">
                                        </div>
                                    <# } else if ( 'icon' === item.graphic_element && item.icon.value ) { #>
                                        <div class="jumbo-services-icon">
                                            <i class="{{{ item.icon.value }}}"></i>
                                        </div>
                                    <# } #>
    
                                    <h3 class="jumbo-services-item-title">{{{ item.heading }}}</h3>
                                    <div class="jumbo-services-item-description">
                                        {{{ item.description }}}
                                    </div>
    
                                    <# if ( item.button_text && item.link.url ) { #>
                                        <a href="{{{ item.link.url }}}" class="jumbo-services-item-button">
                                            {{{ item.button_text }}}
                                        </a>
                                    <# } #>
                                </div>
                            <# } #>
                        <# } #>
                    </div>
                <# } #>
            </div>
        </div>
        <?php
    }
}