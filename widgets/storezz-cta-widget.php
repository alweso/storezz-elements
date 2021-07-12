<?php
class Storezz_Cta_Widget extends \Elementor\Widget_Base {

    public function __construct( $data = array(), $args = null ) {
      parent::__construct( $data, $args );
      wp_register_style( 'storezz-elements', STOREZZ_ELEMENTS_ASSETS_URI . '/css/storezz-elements.css', array(), STOREZZ_ELEMENTS_VERSION );
      wp_register_style( 'se-cta', STOREZZ_ELEMENTS_ASSETS_URI . '/css/se-cta.css', array(), STOREZZ_ELEMENTS_VERSION );
    }

    /** Widget Name **/
    public function get_name() {
        return 'storezz-cta';
    }

    /** Widget Title **/
    public function get_title() {
        return esc_html__( 'Call To Action', 'storezz-elements' );
    }

    /** Widget Icon **/
    public function get_icon() {
        return 'eicon-instagram-gallery';
    }

    /** Categories **/
    public function get_categories() {
        return [ 'storezz-elements' ];
    }

    public function get_style_depends() {
      return array( 'storezz-elements', 'se-cta' );
    }

    /** Widget Controls **/
    protected function _register_controls() {

        $this->start_controls_section(
            'cta_content_section',
            [
                'label' => esc_html__( 'Call to action', 'storezz-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'image',
                [
                    'label' => esc_html__( 'Choose Image', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_control(
                'title',
                [
                    'label' => esc_html__( 'Title', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'separator' => 'before',
                    'default' => esc_html__( 'Title', 'storezz-elements' ),
                ]
            );


            $this->add_control(
                'subtitle',
                [
                    'label' => esc_html__( 'Sub Title', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Sub Title', 'storezz-elements' ),
                ]
            );

            $this->add_control(
                'button_text',
                [
                    'label' => esc_html__( 'Button Text', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Discover Now', 'storezz-elements' ),
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'button_link',
                [
                    'label' => esc_html__( 'Button Link', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => esc_html__( '#', 'storezz-elements' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                ]
            );

            $this->add_control(
                'animation_style', [
                'label' => esc_html__('Animation style', 'storezz-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'animation2',
                'options' => [
                  ''      =>esc_html__( 'None', 'storezz-elements' ),
                  'animation1'      =>esc_html__( 'Style 1', 'storezz-elements' ),
                  'animation2'      =>esc_html__( 'Style 2', 'storezz-elements' ),
                  'animation3'      =>esc_html__( 'Style 3', 'storezz-elements' ),
                  'animation4'      =>esc_html__( 'Style 4', 'storezz-elements' ),
                ],
                    ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'cta_additional_section',
            [
                'label' => esc_html__( 'Additional Settings', 'storezz-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'content_position',
                [
                    'label' => esc_html__( 'Content Position', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'center-center',
                    'options' => array(
                        'top-left' => esc_html__( 'Top Left', 'storezz-elements' ),
                        'top-center' => esc_html__( 'Top Center', 'storezz-elements' ),
                        'top-right' => esc_html__( 'Top Right', 'storezz-elements' ),
                        'center-left' => esc_html__( 'Center Left', 'storezz-elements' ),
                        'center-center' => esc_html__( 'Center Center', 'storezz-elements' ),
                        'center-right' => esc_html__( 'Center Right', 'storezz-elements' ),
                        'bottom-left' => esc_html__( 'Bottom Left', 'storezz-elements' ),
                        'bottom-center' => esc_html__( 'Bottom Center', 'storezz-elements' ),
                        'bottom-right' => esc_html__( 'Bottom Right', 'storezz-elements' ),
                    ),
                ]
            );

            $this->add_control(
                'box_height',
                [
                    'label' => esc_html__( 'Box Height', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 550,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .se-call-to-action .content' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'image',
                    'exclude' => [ 'custom' ],
                    'include' => [],
                    'default' => 'large',
                ]
            );

            $this->add_control(
                'hover_effect',
                [
                    'label' => esc_html__( 'Hover Effect', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'hover1',
                    'options' => array(
                        'hover1' => esc_html__( 'Expansion', 'storezz-elements' ),
                        'hover2' => esc_html__( 'Slice', 'storezz-elements' ),
                    ),
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'storezz-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .storezz-cta .content .title' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__( 'Typography', 'storezz-elements' ),
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .storezz-cta .content .title',
                ]
            );

            $this->add_control(
                'title_spacing',
                [
                    'label' => esc_html__( 'Spacing', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'allowed_dimensions' => 'vertical',
                    'selectors' => [
                        '{{WRAPPER}} .storezz-cta .content .title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => esc_html__( 'Sub-Title', 'storezz-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'subtitle_color',
                [
                    'label' => esc_html__( 'Color', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .storezz-cta .content .subtitle' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'subtitle_typography',
                    'label' => esc_html__( 'Typography', 'storezz-elements' ),
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .storezz-cta .content .subtitle',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__( 'Button', 'storezz-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'button_padding',
                [
                    'label' => esc_html__( 'Padding', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .storezz-cta .content .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'label' => esc_html__( 'Typography', 'storezz-elements' ),
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .storezz-cta .content .btn',
                ]
            );

            $this->start_controls_tabs(
                'button_tabs'
            );

                $this->start_controls_tab(
                    'buttons_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'storezz-elements' ),
                    ]
                );


                    $this->add_control(
                        'button_color_normal',
                        [
                            'label' => esc_html__( 'Color', 'storezz-elements' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Scheme_Color::get_type(),
                                'value' => \Elementor\Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .storezz-cta .content .btn' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_bgcolor_normal',
                        [
                            'label' => esc_html__( 'Background Color', 'storezz-elements' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Scheme_Color::get_type(),
                                'value' => \Elementor\Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .storezz-cta .content .btn' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'normal_border',
                            'label' => esc_html__( 'Border', 'storezz-elements' ),
                            'selector' => '{{WRAPPER}} .storezz-cta .content .btn',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'buttons_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'storezz-elements' ),
                    ]
                );


                    $this->add_control(
                        'button_color_hover',
                        [
                            'label' => esc_html__( 'Color', 'storezz-elements' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Scheme_Color::get_type(),
                                'value' => \Elementor\Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .storezz-cta .content .btn:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_bgcolor_hover',
                        [
                            'label' => esc_html__( 'Background Color', 'storezz-elements' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Scheme_Color::get_type(),
                                'value' => \Elementor\Scheme_Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .storezz-cta .content .btn:hover' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'hover_border',
                            'label' => esc_html__( 'Border', 'storezz-elements' ),
                            'selector' => '{{WRAPPER}} .storezz-cta .content .btn:hover',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /** Render Layout **/
    protected function render() {
        $settings = $this->get_settings_for_display();
        $image = $this->get_image_url();
        $animation_style =  $settings['animation_style'];
        $content_postition = $settings['content_position'] ? $settings['content_position'] : 'center-center';
        $hover_effect  = isset( $settings['hover_effect'] ) ? $settings['hover_effect'] : 'hover1';


        $target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';
        ?>
            <?php echo '<div id="storezz-cta-' . esc_attr( $this->get_id() ) . '" class="se-call-to-action ' .  esc_attr( $content_postition ) . ' '. esc_attr($hover_effect) . '">'; ?>

                <?php
                if( $image['url'] ) :
                  $image_url = $image['url'];
                else :
                  $image_url = '';
                endif;
                echo '<div class="content ' . esc_attr( $animation_style ) . '" style="background:url(' . esc_url( $image_url ) . ')">'

                 ?>
                    <?php
                        if( $settings['subtitle'] ) {
                            echo '<span class="subtitle">' . esc_html( $settings['subtitle'] ) . '</span>';
                        }

                        if( $settings['title'] ) {
                            esc_html_e( $settings['title'] );
                        }

                        if( $settings['button_link']['url'] && $settings['button_text'] ) {
                            echo '<a class="btn victoria-one" href="' . esc_url( $settings['button_link']['url'] ) . '"' . $target . $nofollow . '>' . esc_html( $settings['button_text'] ) .'</a>';
                        }



                    ?>
                </div>
            </div>
        <?php
    }

    protected function get_image_url() {
        $settings = $this->get_settings_for_display();

        $image = $settings['image'] ? $settings['image'] : '';
        $image_size = $settings['image_size'] ? $settings['image_size'] : 'large';
        $imggg = array(
            'url' => '',
            'alt' => ''
        );
        if( !empty( $image ) ) {
            if( isset( $image['id'] ) && $image['id'] ) {
                $img = wp_get_attachment_image_src( $image['id'], $image_size );
                if($img) {
                    $imggg['url'] = $img[0];
                }
                $imggg['alt'] = get_post_meta( $image['id'], '_wp_attachment_image_alt', TRUE);
            } else {
                $imggg['url'] = isset( $image['url'] ) ? $image['url'] : '';
                $imggg['alt'] = '';
            }
        }

        return $imggg;
    }
}
