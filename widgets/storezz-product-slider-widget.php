<?php
class Storezz_Product_Slider_Widget extends \Elementor\Widget_Base {
  /** Widget Name **/
  public function get_name() {
    return 'storezz-product-slider';
  }

  /** Widget Title **/
  public function get_title() {
    return esc_html__( 'Product Slider Widget', 'storezz-elements' );
  }

  /** Widget Icon **/
  public function get_icon() {
    return 'eicon-post-list';
  }

  /** Categories **/
  public function get_categories() {
    return [ 'storezz-elements' ];
  }

  /** Dependencies */
  public function get_script_depends() {
    return [ 'owl-carousel' ];
  }

  /** Widget Controls **/
  protected function _register_controls() {

    $this->start_controls_section(
      'header', [
        'label' => esc_html__('Header', 'storezz-elements'),
      ]
    );

    $this->add_group_control(
      Group_Control_Header::get_type(), [
        'name' => 'header',
        'label' => esc_html__('Header', 'storezz-elements'),
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'product_query', [
        'label' => esc_html__('Content', 'storezz-elements'),
      ]
    );

    $this->add_control(
      'choose_categories', [
        'label' => __('Choose Categories', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'default' => '',
        'label_block' => true,
        'multiple' => true,
        'options'   => storezz_elements_get_woo_categories_list(),
      ]
    );

    $this->add_control(
      'show', [
        'label' => __('Show', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => '',
        'options' => [
          ''         => __( 'All products', 'storezz-elements' ),
          'featured' => __( 'Featured products', 'storezz-elements' ),
          'onsale'   => __( 'On-sale products', 'storezz-elements' ),
        ],
      ]
    );

    $this->add_control(
      'nav',
      [
        'label' => esc_html__( 'Show Arrow Navigation', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__( 'Yes', 'storezz-elements' ),
        'label_off' => esc_html__( 'No', 'storezz-elements' ),
        'return_value' => 'true',
        'default' => 'true'
      ]
    );

    $this->add_control(
      'dot_nav_show',
      [
        'label' => esc_html__( 'Show Dot Navigation', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__( 'Yes', 'storezz-elements' ),
        'label_off' => esc_html__( 'No', 'storezz-elements' ),
        'return_value' => 'true',
        'default' => 'true'
      ]
    );

    $this->add_control(
      'autoplay',
      [
        'label' => esc_html__( 'Autoplay', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__( 'Yes', 'storezz-elements' ),
        'label_off' => esc_html__( 'No', 'storezz-elements' ),
        'return_value' => 'true',
        'default' => 'true'
      ]
    );

    $this->add_control(
      'center',
      [
        'label' => esc_html__( 'Center slides', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__( 'Yes', 'storezz-elements' ),
        'label_off' => esc_html__( 'No', 'storezz-elements' ),
        'return_value' => 'true',
        'default' => 'true'
      ]
    );

    $this->add_control(
      'number_of_products',
      [
        'label' => __( 'Number of products', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => __( 4, 'storezz-elements' ),
        'min' => 2,
        'step' => 1,
      ]
    );

    $this->add_control(
      'number_of_products_mobile', [
        'label' => __('No. of products mobile ', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => '2',
        'options' => [
          '2' => __( '2', 'storezz-elements' ),
          '3' => __( '3', 'storezz-elements' ),
          '4' => __( '4', 'storezz-elements' ),
        ],
      ]
    );

    $this->add_control(
      'number_of_products_tablet', [
        'label' => __('No. of products tablet ', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => '3',
        'options' => [
          '2' => __( '2', 'storezz-elements' ),
          '3' => __( '3', 'storezz-elements' ),
          '4' => __( '4', 'storezz-elements' ),
        ],
      ]
    );

    $this->add_control(
      'number_of_products_desktop', [
        'label' => __('No. of products desktop ', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => '4',
        'options' => [
          '2' => __( '2', 'storezz-elements' ),
          '3' => __( '3', 'storezz-elements' ),
          '4' => __( '4', 'storezz-elements' ),
        ],
      ]
    );
    //
    // $this->add_responsive_control(
    //   'number_of_products',
    //   [
    //     'label' => __( 'Number of products', 'plugin-name' ),
    //     'type' => \Elementor\Controls_Manager::NUMBER,
    //     'devices' => [ 'desktop', 'tablet', 'mobile' ],
    //     'min' => 1,
    //     'step' => 1,
    //     'desktop_default' => '4',
    //     'tablet_default' => '3',
    //     'mobile_default' => '2',
    //   ]
    // );


    $this->add_control(
      'hide_out_of_stock',
      [
        'label' => esc_html__('Hide out-of-stock items', 'menheer-plugin'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'menheer-plugin'),
        'label_off' => esc_html__('No', 'menheer-plugin'),
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'image_size_label', [
        'label' => __('Image Size', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::HEADING,
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Image_Size::get_type(), [
        'name' => 'image_size',
        'exclude' => ['custom'],
        'include' => [],
        'default' => '',
      ]
    );

    $this->end_controls_section();
  }

  /** Render Layout **/
  protected function render() {
    $settings = $this->get_settings_for_display();
    $image_size                  = $settings['image_size_size'];
    $show                        = $settings['show'];
    $categories                  = $settings['choose_categories'];
    $number_of_products          = $settings['number_of_products'];
    $number_of_products_mobile   = $settings['number_of_products_mobile'];
    $number_of_products_tablet   = $settings['number_of_products_tablet'];
    $number_of_products_desktop   = $settings['number_of_products_desktop'];
    $autoplay                    = $settings['autoplay'];
    $center                      = $settings['center'];
    $nav                         = $settings['nav'];
    $nav_dot                     = $settings['nav_dot'];
    $hide_out_of_stock           = $settings['hide_out_of_stock'];
    $navArrows                   = ["<i class='nav-button owl-prev fas fa-angle-left'>‹</i>", "<i class='nav-button owl-next fas fa-angle-right'>›</i>"];
    $product_visibility_term_ids = wc_get_product_visibility_term_ids();

    $args = array(
      'post_status'    => 'publish',
      'post_type'      => 'product',
      'no_found_rows'  => 1,
      'orderby'        => $orderby,
      'order'          => $order,
      'meta_query'     => array(),
      'tax_query'      => array(
        'relation' => 'AND',
      ),
    );

    if (!empty($categories) ) {
      $args['tax_query'][] = array(
        array(
            'taxonomy'      => 'product_cat',
            'field'         => 'term_id', //This is optional, as it defaults to 'term_id'
            'terms'         => $categories,
            'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
        ),
      );
    };

    if ( 'yes' === $hide_out_of_stock ) {
      $args['tax_query'][] = array(
        array(
          'taxonomy' => 'product_visibility',
          'field'    => 'term_taxonomy_id',
          'terms'    => $product_visibility_term_ids['outofstock'],
          'operator' => 'NOT IN',
        ),
      ); // WPCS: slow query ok.
    }

    switch ( $show ) {
      case 'featured':
      $args['tax_query'][] = array(
        'taxonomy' => 'product_visibility',
        'field'    => 'term_taxonomy_id',
        'terms'    => $product_visibility_term_ids['featured'],
      );
      break;
      case 'onsale':
      $product_ids_on_sale    = wc_get_product_ids_on_sale();
      $product_ids_on_sale[]  = 0;
      $args['post__in'] = $product_ids_on_sale;
      break;
    }

    $slide_controls  = [
      "autoplay"  => $autoplay,
      "center"  => $center,
      "dots"  => $nav_dot,
      // "items"  => $number_of_products,
      "nav" => $nav,
      "loop"  => "true",
      "responsive" => [
        "0" => [
            "items" => $number_of_products_mobile,
        ],
        "480" => [
            "items" => $number_of_products_tablet,
        ],
        "768" => [
            "items" => $number_of_products_desktop,
        ],
      ],
    ];

    $slide_controls = \json_encode($slide_controls);


    $products = new WP_Query( $args );
    ?>
    <?php if( $products->have_posts() ) : ?>
      <h1><?php echo $number_of_products ?></h1>
      <ul data-carousel-options='<?php echo $slide_controls ?>' class="se-product-slider owl-carousel">
        <?php
        $template_args = array(
          'widget_id'   => isset( $args['widget_id'] ) ? $args['widget_id'] : $this->widget_id,
          'show_rating' => true,
          'image_size'  => $image_size,
        );

        while ( $products->have_posts() ) {
          $products->the_post();
          wc_get_template( 'content-widget-product.php', $template_args );
        }?>
      </ul>
      <?php wp_reset_postdata();
    endif; ?>
      <?php
    }
  }
