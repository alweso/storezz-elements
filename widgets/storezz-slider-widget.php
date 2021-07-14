<?php
    /**
     * Storezz Slider Widget.
     */
    class Storezz_Slider_Widget extends \Elementor\Widget_Base {

        public function __construct( $data = array(), $args = null ) {
          parent::__construct( $data, $args );
          wp_register_script( 'owl-carousel', STOREZZ_ELEMENTS_VENDOR_URI . 'owl-carousel/js/owl.carousel.min.js', array(), STOREZZ_ELEMENTS_VERSION );
          wp_register_style( 'storezz-elements', STOREZZ_ELEMENTS_ASSETS_URI . '/css/storezz-elements.css', array(), STOREZZ_ELEMENTS_VERSION);
          wp_register_style( 'se-slider', STOREZZ_ELEMENTS_ASSETS_URI . '/css/se-slider.css', array(), STOREZZ_ELEMENTS_VERSION );
        }

        /** Widget Name */
        public function get_name() {
            return 'storezz-slider-widget';
        }

        /** Widget Title */
        public function get_title() {
            return esc_html__( 'Slider', 'storezz-elements' );
        }

        /** Icon */
        public function get_icon() {
            return 'eicon-slider-full-screen';
        }

        /** Category */
        public function get_categories() {
            return [ 'storezz-elements' ];
        }

        /** Dependencies */
        public function get_script_depends() {
            return [ 'owl-carousel' ];
        }

        public function get_style_depends() {
          return array(  'owl-carousel', 'storezz-elements', 'se-slider' );
        }

        /** Controls */
        protected function _register_controls() {
            $this->start_controls_section(
                'content',
                [
                    'label' => esc_html__( 'Slider', 'storezz-elements' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );

                $repeater = new \Elementor\Repeater();

                $repeater->add_control(
                    'image',
                    [
                        'label' => esc_html__( 'Choose Image', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
                );

                $repeater->add_control(
                    'subtitle', [
                        'label' => esc_html__( 'Sub Title', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Slide Sub 1' , 'storezz-elements' ),
                        'label_block' => true,
                    ]
                );

                $repeater->add_control(
                    'title', [
                        'label' => esc_html__( 'Title', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Slide 1' , 'storezz-elements' ),
                        'label_block' => true,
                    ]
                );

                $repeater->add_control(
                    'content',
                    [
                        'label' => esc_html__( 'Description', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'rows' => 10,
                        'default' => esc_html__( 'Default description', 'storezz-elements' ),
                        'placeholder' => esc_html__( 'Type your description here', 'storezz-elements' ),
                    ]
                );

                $repeater->add_control(
                    'btn_text',
                    [
                        'label' => esc_html__( 'Button Text', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'VIEW MORE', 'storezz-elements' ),
                        'placeholder' => esc_html__( 'Set Button Label text.', 'storezz-elements' ),
                        'label_block' => true
                    ]
                );

                $repeater->add_control(
                    'btn_link',
                    [
                        'label' => esc_html__( 'Link', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::URL,
                        'placeholder' => esc_html__( 'https://your-link.com', 'storezz-elements' ),
                        'show_external' => true,
                        'default' => [
                            'url' => '',
                            'is_external' => true,
                            'nofollow' => true,
                        ],
                    ]
                );

                $this->add_control(
                    'slides',
                    [
                        'label' => esc_html__( 'Slides', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'fields' => $repeater->get_controls(),
                        'default' => [
                            [
                                'title' => esc_html__( 'Slide #1', 'storezz-elements' ),
                                'content' => esc_html__( 'Slide Content.', 'storezz-elements' ),
                            ],
                            [
                                'title' => esc_html__( 'Slide #2', 'storezz-elements' ),
                                'content' => esc_html__( 'Slide Content.', 'storezz-elements' ),
                            ],
                        ],
                        'title_field' => '{{{ title }}}',
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Image_Size::get_type(),
                    [
                        'name' => 'image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                        'exclude' => [ 'custom' ],
                        'include' => [],
                        'default' => 'large',
                    ]
                );

            $this->end_controls_section();

            $this->start_controls_section(
                'slide_style',
                [
                    'label' => esc_html__( 'Slide', 'storezz-elements' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

                $this->add_control(
                    'slide_height',
                    [
                        'label' => esc_html__( 'Height', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 400,
                                'max' => 1000,
                                'step' => 1,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                            'size' => 550,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .storezz-slider .slide' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'slide_padding_left',
                    [
                        'label' => esc_html__( 'Content Left Spacing', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 300,
                                'step' => 1,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                            'size' => 0,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .storezz-slider .slide .slide-content' => 'padding-left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

            $this->end_controls_section();

            $this->start_controls_section(
                'subtitle_style',
                [
                    'label' => esc_html__( 'Subtitle', 'storezz-elements' ),
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
                            '{{WRAPPER}} .storezz-slider .slide-content .slide-subtitle' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Typography::get_type(),
                    [
                        'name' => 'subtitle_typography',
                        'label' => esc_html__( 'Typography', 'storezz-elements' ),
                        'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                        'selector' => '{{WRAPPER}} .storezz-slider .slide-content .slide-subtitle',
                    ]
                );

            $this->end_controls_section();

            $this->start_controls_section(
                'title_style',
                [
                    'label' => esc_html__( 'Slider Title', 'storezz-elements' ),
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
                            '{{WRAPPER}} .storezz-slider .slide-content .slide-title' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Typography::get_type(),
                    [
                        'name' => 'title_typography',
                        'label' => esc_html__( 'Typography', 'storezz-elements' ),
                        'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                        'selector' => '{{WRAPPER}} .storezz-slider .slide-content .slide-title',
                    ]
                );

                $this->add_control(
                    'title_spacing',
                    [
                        'label' => esc_html__( 'Spacing', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 150,
                                'step' => 5,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                            'size' => 0,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .storezz-slider .slide-content .slide-title' => 'margin: {{SIZE}}{{UNIT}} 0;',
                        ],
                    ]
                );

            $this->end_controls_section();

            $this->start_controls_section(
                'content_style',
                [
                    'label' => esc_html__( 'Slider Content', 'storezz-elements' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

                $this->add_control(
                    'content_color',
                    [
                        'label' => esc_html__( 'Color', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => \Elementor\Scheme_Color::get_type(),
                            'value' => \Elementor\Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .storezz-slider .slide-content .slide-description' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Typography::get_type(),
                    [
                        'name' => 'content_typography',
                        'label' => esc_html__( 'Typography', 'storezz-elements' ),
                        'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                        'selector' => '{{WRAPPER}} .storezz-slider .slide-content .slide-description',
                    ]
                );

                $this->add_control(
                    'content_spacing',
                    [
                        'label' => esc_html__( 'Spacing', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 150,
                                'step' => 5,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                            'size' => 0,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .storezz-slider .slide-content .slide-description' => 'margin: {{SIZE}}{{UNIT}} 0;',
                        ],
                    ]
                );

            $this->end_controls_section();

            $this->start_controls_section(
                'readmore_style',
                [
                    'label' => esc_html__( 'Readmore', 'storezz-elements' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

                $this->add_control(
                    'readmore_bgcolor',
                    [
                        'label' => esc_html__( 'Background Color', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => \Elementor\Scheme_Color::get_type(),
                            'value' => \Elementor\Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .storezz-slider .slide-content .slide-btn' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'readmore_color',
                    [
                        'label' => esc_html__( 'Color', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => \Elementor\Scheme_Color::get_type(),
                            'value' => \Elementor\Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .storezz-slider .slide-content .slide-btn' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Typography::get_type(),
                    [
                        'name' => 'readmore_typography',
                        'label' => esc_html__( 'Typography', 'storezz-elements' ),
                        'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                        'selector' => '{{WRAPPER}} .storezz-slider .slide-content .slide-btn',
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Border::get_type(),
                    [
                        'name' => 'readmore_border',
                        'label' => esc_html__( 'Border', 'storezz-elements' ),
                        'selector' => '{{WRAPPER}} .storezz-slider .slide-content .slide-btn',
                    ]
                );

                $this->add_control(
                    'readmore_border_radius',
                    [
                        'label' => esc_html__( 'Border Radius', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .storezz-slider .slide-content .slide-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ]
                    ]
                );

                $this->add_control(
                    'readmore_heading',
                    [
                        'label' => esc_html__( 'Button Hover', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
                );

                $this->add_control(
                    'readmore_bgcolor_hover',
                    [
                        'label' => esc_html__( 'Background Color', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => \Elementor\Scheme_Color::get_type(),
                            'value' => \Elementor\Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .storezz-slider .slide-content .slide-btn:hover' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'readmore_color_hover',
                    [
                        'label' => esc_html__( 'Color', 'storezz-elements' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => \Elementor\Scheme_Color::get_type(),
                            'value' => \Elementor\Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .storezz-slider .slide-content .slide-btn:hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_section();
        }

        /** Render Layout */
        protected function render() {
            $settings = $this->get_settings_for_display();
            $slides = isset( $settings['slides'] ) ? $settings['slides'] : array();
            $image_size = isset( $settings['image_size_size'] ) ? $settings['image_size_size'] : 'large';

            if( !empty( $slides ) ) :
            echo '<div class="storezz-slider owl-carousel" id="storezz-slider-' . esc_attr( $this->get_id() ) . '">';
            foreach( $slides as $slide ) :
                        if( isset( $slide['image']['url'] ) ) :
                                $image_url = $slide['image']['url'];
                                if( $slide['image']['id'] ) {
                                    $image = wp_get_attachment_image_src( $slide['image']['id'], $image_size );
                                    $image_url = $image[0];
                                }
                                echo '<div class="slide" style="background-image: url(' . esc_url( $image_url ) . ')">';
                            ?>
                                <div class="slide-content storezz-container">
                                    <?php if( $slide['subtitle'] ) : ?>
                                        <span class="slide-subtitle"><?php esc_html_e( $slide['subtitle'], 'storezz-elements' ); ?></span>
                                    <?php endif; ?>

                                    <?php if( $slide['title'] ) : ?>
                                      <?php echo '<span class="slide-title">' . wp_kses( $slide['title'], array(
                                          'strong' => array(),
                                          'br' => array()
                                      ) ) . '</span>'; ?>

                                    <?php endif; ?>
                                    <?php echo '<p class="slide-description">' . wp_kses( $slide['content'], array( 'br' => array() ) ) . '</p>'; ?>
                                    <?php if( isset( $slide['btn_text'] ) && isset( $slide['btn_link']['url'] ) ) : ?>
                                    <?php echo '<a class="slide-btn" href="' . esc_url( $slide['btn_link']['url'] ) . '">' . esc_html_e( $slide['btn_text'], 'storezz-elements' ) . '</a>';  ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php
            endif;
        }
    }
