<?php

/**
* Magazine Post Carousel Widget.
*/
class Storezz_Image_Widget extends \Elementor\Widget_Base {

  public function __construct( $data = array(), $args = null ) {
    parent::__construct( $data, $args );
    wp_register_style( 'storezz-elements', STOREZZ_ELEMENTS_ASSETS_URI . '/css/storezz-elements.css', array(), STOREZZ_ELEMENTS_VERSION );
    wp_register_style( 'se-image', STOREZZ_ELEMENTS_ASSETS_URI . '/css/se-image.css', array(), STOREZZ_ELEMENTS_VERSION );
  }

  /** Widget Name */
  public function get_name() {
    return 'storezz-image-widget';
  }

  /** Widget Title */
  public function get_title() {
    return esc_html__('Image Widget', 'storezz-elements');
  }

  /** Icon */
  public function get_icon() {
    return 'eicon-inner-section';
  }

  /** Category */
  public function get_categories() {
    return ['storezz-elements'];
  }

  public function get_style_depends() {
    return array( 'storezz-elements', 'se-image' );
  }
  /** Controls */
  protected function _register_controls() {
    $this->start_controls_section(
      'content_section', [
        'label' => esc_html__('Content', 'storezz-elements'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );


    // featured product - // todDo

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

    $this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'large', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'Woocommerce Thumbnail' ],
				'include' => [],
				'default' => 'large',
			]
		);

    $this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'plugin-domain' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'plugin-domain' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'plugin-domain' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
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

    $this->add_control(
      'overlay', [
        'label' => esc_html__('Overlay', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .storezz-image::after' => 'background-color: {{VALUE}}',
        ],
      ]
    );

    $this->add_control(
      'image_width',
      [
        'label' => esc_html__( 'Image width', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => [ '%'],
        'range' => [
          'px' => [
            'min' => 10,
            'max' => 100,
            'step' => 1,
          ],
        ],
        'default' => [
          'unit' => '%',
          'size' => 100,
        ],
        'selectors' => [
          '{{WRAPPER}} .storezz-image img' => 'width: {{SIZE}}{{UNIT}};height:auto;',
        ],
      ]
    );

    $this->add_control(
      'image_max_width',
      [
        'label' => esc_html__( 'Image max width', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => [ '%'],
        'range' => [
          'px' => [
            'min' => 10,
            'max' => 100,
            'step' => 1,
          ],
        ],
        'default' => [
          'unit' => '%',
          'size' => 100,
        ],
        'selectors' => [
          '{{WRAPPER}} .storezz-image img' => 'max-width: {{SIZE}}{{UNIT}};height:auto;',
        ],
      ]
    );

    $this->add_control(
      'image_height',
      [
        'label' => esc_html__( 'Image height', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => [ 'px'],
        'range' => [
          'px' => [
            'min' => 120,
            'max' => 3000,
            'step' => 1,
          ],
        ],
        'default' => [
          'unit' => 'px',
          'size' => 400,
        ],
        'selectors' => [
          '{{WRAPPER}} .storezz-image img' => 'height: {{SIZE}}{{UNIT}};width:auto;',
        ],
      ]
    );


    $this->end_controls_section();

    $this->start_controls_section(
      'additional_settings', [
        'label' => esc_html__('Additional Settings', 'storezz-elements'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );




    $this->end_controls_section();

    $this->start_controls_section(
      'cat_btn_style', [
        'label' => esc_html__('Category Button', 'storezz-elements'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );



    $this->add_control(
      'cat_btn_color', [
        'label' => esc_html__('Text Color', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .storezz-product-list' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(), [
        'name' => 'cat_btn_typography',
        'label' => esc_html__('Typography', 'storezz-elements'),
        'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .storezz-product-category-block1 .cat-btn',
      ]
    );

    $this->end_controls_section();
  }


  /** Render Layout */
  protected function render() {
    $settings = $this->get_settings_for_display();
    $animation_style =  $settings['animation_style'];
    $text_align = $settings['text_align']; ?>

    <div class="" style="text-align:<?php echo $text_align ?>;position:relative;width:100%;">
    <div class="storezz-image animation <?php echo $animation_style ?>" style="display:inline-block;position:relative;">

    <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'large', 'image' ); ?>
</div>
  </div>

  <?php }
}?>
