<?php
class Storezz_Testimonial_Slider_Widget extends \Elementor\Widget_Base {

  public function __construct( $data = array(), $args = null ) {
    parent::__construct( $data, $args );
    wp_register_script( 'owl-carousel', STOREZZ_ELEMENTS_VENDOR_URI . 'owl-carousel/js/owl.carousel.min.js', array(), STOREZZ_ELEMENTS_VERSION );
    wp_register_style( 'storezz-elements', STOREZZ_ELEMENTS_ASSETS_URI . '/css/storezz-elements.css', array(), STOREZZ_ELEMENTS_VERSION );
    wp_register_style( 'se-testimonial-slider', STOREZZ_ELEMENTS_ASSETS_URI . '/css/se-testimonial-slider.css', array(), STOREZZ_ELEMENTS_VERSION );
  }

  public function get_name() {
    return 'storezz-testimonial-slider';
  }

  public function get_title() {
    return esc_html__( 'Testimonial Slider', 'storezz-elements' );
  }

  public function get_icon() {
    return 'eicon-post-slider';
  }

  public function get_categories() {
    return [ 'storezz-elements' ];
  }

  /** Dependencies */
  public function get_script_depends() {
      return [ 'owl-carousel' ];
  }

  public function get_style_depends() {
    return array(  'owl-carousel', 'storezz-elements', 'se-testimonial-slider' );
  }

  protected function _register_controls() {

    $this->start_controls_section(
      'testimonial_section',
      [
        'label' => esc_html__( 'Testimonial', 'storezz-elements' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
      'testimony', [
        'label' => esc_html__( 'Testimony', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => esc_html__( 'John Doe has to say something about the co.' , 'storezz-elements' ),
        'show_label' => false,
      ]
    );

    $repeater->add_control(
      'name', [
        'label' => esc_html__( 'Client Name', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__( 'John Doe' , 'storezz-elements' ),
        'label_block' => true,
      ]
    );

    $repeater->add_control(
      'position', [
        'label' => esc_html__( 'Job Position', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__( 'Managing Director' , 'storezz-elements' ),
        'label_block' => true,
      ]
    );

    $repeater->add_control(
      'star_ratings',
      [
        'label' => esc_html__( 'Ratings', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => '0',
        'options' => [
          '0'  => esc_html__( '0 Star', 'storezz-elements' ),
          '1' => esc_html__( '1 Star', 'storezz-elements' ),
          '2' => esc_html__( '2 Star', 'storezz-elements' ),
          '3' => esc_html__( '3 Star', 'storezz-elements' ),
          '4' => esc_html__( '4 Star', 'storezz-elements' ),
          '5' => esc_html__( '5 Star', 'storezz-elements' ),
        ],
      ]
    );

    $this->add_control(
      'testimonials',
      [
        'label' => esc_html__( 'Testimonials', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
          [
            'name' => esc_html__( 'John Doe', 'storezz-elements' ),
            'position' => esc_html__( 'Managing Director', 'storezz-elements' ),
            'testimony' => esc_html__( 'John Doe has to say something about the business.', 'storezz-elements' ),
          ],
          [
            'name' => esc_html__( 'Sarah Doe', 'storezz-elements' ),
            'position' => esc_html__( 'Blogger', 'storezz-elements' ),
            'testimony' => esc_html__( 'Sarah has to say something about the business.', 'storezz-elements' ),
          ],
        ],
        'title_field' => '{{{ name }}}',
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'testimonial_carousel_section',
      [
        'label' => esc_html__( 'Carousel', 'storezz-elements' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'loop',
      [
        'label' => esc_html__( 'Loop Slides', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__( 'Yes', 'storezz-elements' ),
        'label_off' => esc_html__( 'No', 'storezz-elements' ),
        'return_value' => 'yes',
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'autoplay',
      [
        'label' => esc_html__( 'Autoplay', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__( 'Yes', 'storezz-elements' ),
        'label_off' => esc_html__( 'No', 'storezz-elements' ),
        'return_value' => 'yes',
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'pause_on_hover',
      [
        'label' => esc_html__( 'Pause On Hover', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__( 'Yes', 'storezz-elements' ),
        'label_off' => esc_html__( 'No', 'storezz-elements' ),
        'return_value' => 'yes',
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'show_dots',
      [
        'label' => esc_html__( 'Show Dots', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__( 'Yes', 'storezz-elements' ),
        'label_off' => esc_html__( 'No', 'storezz-elements' ),
        'return_value' => 'yes',
        'default' => 'yes',
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
        'label' => esc_html__( 'Title color', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .se-testimonials-wrapper h2' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'title_typography',
        'label' => esc_html__( 'Typography', 'storezz-elements' ),
        'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .se-testimonials-wrapper h2',
      ]
    );

    $this->add_control(
      'title_margin',
      [
        'label' => esc_html__( 'Title margin', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'allowed_dimensions' => 'vertical',
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
          '{{WRAPPER}} .se-testimonials-wrapper h2' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
        ],
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'testimonial_testimony_style',
      [
        'label' => esc_html__( 'Testimony', 'storezz-elements' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'testimony_color',
      [
        'label' => esc_html__( 'Color', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .se-testimonial-slider .testimonial .testimony-text' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'testimony_typography',
        'label' => esc_html__( 'Typography', 'storezz-elements' ),
        'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .se-testimonial-slider .testimonial .testimony-text',
      ]
    );

    $this->add_control(
      'testimony_margin',
      [
        'label' => esc_html__( 'Margin', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'allowed_dimensions' => 'vertical',
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
          '{{WRAPPER}} .se-testimonial-slider .testimonial .testimony-text' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
        ],
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'testimonial_name_style',
      [
        'label' => esc_html__( 'Name', 'storezz-elements' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'design_color',
      [
        'label' => esc_html__( 'Color', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .se-testimonial-slider .name-position .name' => 'color: {{VALUE}}'
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'design_typography',
        'label' => esc_html__( 'Typography', 'storezz-elements' ),
        'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .se-testimonial-slider .name-position .name',
      ]
    );

    $this->add_control(
      'name_margin',
      [
        'label' => esc_html__( 'Margin', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'allowed_dimensions' => 'vertical',
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
          '{{WRAPPER}} .se-testimonial-slider .testimonial .name' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
        ],
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'testimonial_position_style',
      [
        'label' => esc_html__( 'Job Position', 'storezz-elements' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'design_color_job',
      [
        'label' => esc_html__( 'Color', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .se-testimonial-slider .name-position .position' => 'color: {{VALUE}}'
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'design_typography_job',
        'label' => esc_html__( 'Typography', 'storezz-elements' ),
        'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .se-testimonial-slider .name-position .position',
      ]
    );

    $this->add_control(
      'job_margin',
      [
        'label' => esc_html__( 'Margin', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'allowed_dimensions' => 'vertical',
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
          '{{WRAPPER}} .se-testimonial-slider .name-position .position' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
        ],
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'testimonial_navigation_style',
      [
        'label' => esc_html__( 'Navigation', 'storezz-elements' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'dots_color',
      [
        'label' => esc_html__( 'Dots color', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'default' => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} .se-testimonial-slider button.owl-dot' => 'background-color: {{VALUE}}'
        ],
      ]
    );

    $this->add_control(
      'arrow_bg_color',
      [
        'label' => esc_html__( 'Arrows background color', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'default' => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} .se-testimonial-slider button.owl-prev, {{WRAPPER}} .se-testimonial-slider button.owl-next' => 'background-color: {{VALUE}} !important'
        ],
      ]
    );

    $this->add_control(
      'arrow_color',
      [
        'label' => esc_html__( 'Arrows color', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'default' => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} .se-testimonial-slider button.owl-prev i, {{WRAPPER}} .se-testimonial-slider button.owl-next i' => 'color: {{VALUE}} !important'
        ],
      ]
    );

    $this->end_controls_section();
  }

  /** Render Layout **/
  protected function render() {
    $settings = $this->get_settings_for_display();

    $testimonials = $settings['testimonials'];

    if( !empty( $testimonials ) ) :
      ?>
      <div class="se-testimonials-wrapper">
        <h2>Testimonialssss</h2>
        <div data-carousel-options='{"autoplay":"false","items":"1","loop":"true","nav":"true","animateIn":"true"}' class="se-testimonial-slider owl-carousel" id="se-testimonial-slider-<?php echo esc_attr( $this->get_id() ); ?>">

          <?php foreach( $testimonials as $testimonial ) : ?>
            <div class="testimonial">
              <?php if( $testimonial['testimony'] ) : ?>
                <div class="testimony">
                  <?php if( $testimonial['name'] ) : ?>
                  <?php endif; ?>
                  <div class="testimony-text">
                    <?php
                    echo wp_kses( $testimonial['testimony'], array(
                      'br' => array()
                    ) );
                    ?>
                  </div>
                  <div class="name-position">
                    <?php if( $testimonial['name'] ) : ?>
                      <span class="name"><?php echo esc_html( $testimonial['name'] ); ?></span>
                    <?php endif; ?>
                    <?php if( $testimonial['position'] ) : ?>
                      <span class="position"><?php echo esc_html( $testimonial['position'] ); ?></span>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endif; ?>
            </div>

          <?php endforeach; ?>

        </div>
      </div>
      <?php
    endif;
  }

  protected function _content_template() {}
  }
