<?php

class Storezz_Countdown_Widget extends \Elementor\Widget_Base {

    public function __construct( $data = array(), $args = null ) {
      parent::__construct( $data, $args );
      wp_enqueue_script( 'jquery-countdown', STOREZZ_ELEMENTS_VENDOR_URI . 'jquery-countdown/jquery.countdown.min.js', array('jquery'), STOREZZ_ELEMENTS_VERSION );
      wp_register_style( 'storezz-elements', STOREZZ_ELEMENTS_ASSETS_URI . '/css/storezz-elements.css', array(), STOREZZ_ELEMENTS_VERSION );
      wp_register_style( 'se-countdown', STOREZZ_ELEMENTS_ASSETS_URI . '/css/se-countdown.css', array(), STOREZZ_ELEMENTS_VERSION );
    }

    /** Widget Name **/
    public function get_name() {
        return 'storezz-countdown';
    }

    /** Widget Title **/
    public function get_title() {
        return esc_html__( 'Countdown', 'storezz-elements' );
    }

    /** Widget Icon **/
    public function get_icon() {
        return 'eicon-countdown';
    }

    /** Categories **/
    public function get_categories() {
        return [ 'storezz-elements' ];
    }

    /**
     * Enqueue styles.
     */

     /** Dependencies */
     public function get_script_depends() {
         return [ 'jquery-countdown' ];
     }

    public function get_style_depends() {
      return array( 'storezz-elements', 'se-countdown' );
    }

    /** Widget Controls **/
    protected function _register_controls() {

        $this->start_controls_section(
            'countdown_content_section',
            [
                'label' => esc_html__( 'Countdown', 'storezz-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'layout',
                [
                    'label' => esc_html__( 'Layout', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'calender',
                    'options' => [
                        'calender'  => esc_html__( 'Calender', 'storezz-elements' ),
                        'boxer'  => esc_html__( 'Boxer', 'storezz-elements' ),
                        'circle'  => esc_html__( 'Circular', 'storezz-elements' ),
                        'simple' => esc_html__( 'Simple', 'storezz-elements' ),
                    ],
                ]
            );

            $this->add_control(
                'countdown_date',
                [
                    'label' => esc_html__( 'Countdown Date', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::DATE_TIME,
                    'placeholder' => '2020-11-21 12:00'
                ]
            );

            $this->add_control(
                'year_text',
                [
                    'label' => esc_html__( 'Year Text', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Years', 'storezz-elements' ),
                    'separator' => 'before'
                ]
            );

            $this->add_control(
                'month_text',
                [
                    'label' => esc_html__( 'Month Text', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Months', 'storezz-elements' ),
                ]
            );

            $this->add_control(
                'week_text',
                [
                    'label' => esc_html__( 'Week Text', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Weeks', 'storezz-elements' ),
                ]
            );

            $this->add_control(
                'day_text',
                [
                    'label' => esc_html__( 'Day Text', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Days', 'storezz-elements' ),
                ]
            );

            $this->add_control(
                'hour_text',
                [
                    'label' => esc_html__( 'Hour Text', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Hours', 'storezz-elements' ),
                ]
            );

            $this->add_control(
                'minute_text',
                [
                    'label' => esc_html__( 'Minute Text', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Minutes', 'storezz-elements' ),
                ]
            );

            $this->add_control(
                'second_text',
                [
                    'label' => esc_html__( 'Seconds Text', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Seconds', 'storezz-elements' ),
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'label_style',
            [
                'label' => esc_html__( 'Label', 'storezz-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'label_color',
                [
                    'label' => esc_html__( 'Color', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .storezz-countdown.calender ul li .label,{{WRAPPER}} .storezz-countdown.boxer ul li .label' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'label_bgcolor',
                [
                    'label' => esc_html__( 'Background Color', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .storezz-countdown.calender ul li .label,{{WRAPPER}} .storezz-countdown.boxer ul li .label' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'label_typography',
                    'label' => esc_html__( 'Typography', 'storezz-elements' ),
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .storezz-countdown.calender ul li .label,{{WRAPPER}} .storezz-countdown.boxer ul li .label',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'counter_style',
            [
                'label' => esc_html__( 'Counter', 'storezz-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'counter_color',
                [
                    'label' => esc_html__( 'Color', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .storezz-countdown.calender ul li .value,{{WRAPPER}} .storezz-countdown.boxer ul li .value' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'counter_bgcolor',
                [
                    'label' => esc_html__( 'Background Color', 'storezz-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .storezz-countdown.calender ul li .value,{{WRAPPER}} .storezz-countdown.boxer ul li .value' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'counter_typography',
                    'label' => esc_html__( 'Typography', 'storezz-elements' ),
                    'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .storezz-countdown.calender ul li .value,{{WRAPPER}} .storezz-countdown.boxer ul li .value',
                ]
            );

        $this->end_controls_section();
    }

    /** Render Layout **/
    protected function render() {
        $settings = $this->get_settings_for_display();

        $countdown_date = $settings['countdown_date'] ? $settings['countdown_date'] : '';
        $layout = $settings['layout'] ? $settings['layout'] : 'calender';
        $year_text = $settings['year_text'] ? $settings['year_text'] : esc_html__( 'Years', 'storezz-elements' );
        $month_text = $settings['month_text'] ? $settings['month_text'] : esc_html__( 'Years', 'storezz-elements' );
        $week_text = $settings['week_text'] ? $settings['week_text'] : esc_html__( 'Years', 'storezz-elements' );
        $day_text = $settings['day_text'] ? $settings['day_text'] : esc_html__( 'Years', 'storezz-elements' );
        $hour_text = $settings['hour_text'] ? $settings['hour_text'] : esc_html__( 'Years', 'storezz-elements' );
        $minute_text = $settings['minute_text'] ? $settings['minute_text'] : esc_html__( 'Years', 'storezz-elements' );
        $second_text = $settings['second_text'] ? $settings['second_text'] : esc_html__( 'Years', 'storezz-elements' );

        $countdown_data = json_encode( array(
            'date' => $countdown_date,
            'layout' => esc_attr( $layout ),
            'text' => array(
                'year' => $year_text,
                'month' => $year_text,
                'week' => $year_text,
                'day' => $year_text,
                'hour' => $year_text,
                'minute' => $year_text,
                'second' => $year_text
            )
        ) );
        // echo Storezz_Elements::STORREZ_ELEMENTS_VERSION;
        if( !$countdown_date ) {
            ?>
            <div class="storezz-error"><?php esc_html__( 'Set the valid countdown date', 'storezz-elements' ); ?></div>
            <?php
        }
        ?>
            <div class="storezz-countdown <?php echo esc_attr( $layout ); ?>" id="storezz-countdown-<?php echo esc_attr( $this->get_id() ); ?>" data-countdown="<?php echo esc_attr( $countdown_data ); ?>">Countdown</div>
        <?php
    }
}
