<?php

/**
* Magazine Post Carousel Widget.
*/
class Storezz_Product_List_Widget extends \Elementor\Widget_Base {

  public function __construct( $data = array(), $args = null ) {
    parent::__construct( $data, $args );
    wp_register_style( 'storezz-elements', STOREZZ_ELEMENTS_ASSETS_URI . '/css/storezz-elements.css', array(), STOREZZ_ELEMENTS_VERSION );
    wp_register_style( 'se-product-list', STOREZZ_ELEMENTS_ASSETS_URI . '/css/se-product-list.css', array(), STOREZZ_ELEMENTS_VERSION );
  }

  /** Widget Name */
  public function get_name() {
    return 'storezz-product-list-widget';
  }

  /** Widget Title */
  public function get_title() {
    return esc_html__('Product List', 'storezz-elements');
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
    return array( 'storezz-elements', 'se-product-list' );
  }

  /** Controls */
  protected function _register_controls() {
    $this->start_controls_section(
      'content_section', [
        'label' => esc_html__('Content', 'storezz-elements'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'choose_categories', [
        'label' => esc_html__('Choose Categories', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'default' => '',
        'label_block' => true,
        'multiple' => true,
        'options'   => storezz_elements_get_woo_categories_list(),
      ]
    );

    // featured product - // todDo


    $this->add_control(
      'order_by', [
        'label' => esc_html__('Order Products By', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'title',
        'options'   => [
          ''      =>esc_html__( '', 'storezz-elements' ),
          'date'      =>esc_html__( 'Date', 'storezz-elements' ),
          'id'      =>esc_html__( 'ID', 'storezz-elements' ),
          'menu_order'      =>esc_html__( 'Menu Order', 'storezz-elements' ),
          'popularity'      =>esc_html__( 'Best selling', 'storezz-elements' ),
          'rating'      =>esc_html__( 'Rating', 'storezz-elements' ),
          'title'      =>esc_html__( 'Name', 'storezz-elements' ),
          'rand'      =>esc_html__( 'Random', 'storezz-elements' ),
        ],
      ]
    );

    $this->add_control(
      'order', [
        'label' => esc_html__('Order (ASC/DESC)', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'ASC',
        'options'   => [
          'ASC'      =>esc_html__( 'Ascending', 'storezz-elements' ),
          'DESC'      =>esc_html__( 'Descending', 'storezz-elements' ),
        ],
      ]
    );

    $this->add_control(
      'show', [
        'label' => esc_html__('Show', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => '',
        'options' => [
          ''         => esc_html__( 'All products', 'storezz-elements' ),
          'featured' => esc_html__( 'Featured products', 'storezz-elements' ),
          'onsale'   => esc_html__( 'On-sale products', 'storezz-elements' ),
        ],
      ]
    );




    $this->add_control(
      'number_of_products',
      [
        'label' => esc_html__( 'Number of products', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => esc_html__( 4, 'storezz-elements' ),
        'min' => 1,
        'step' => 1,
      ]
    );

    $this->add_control(
      'hide_out_of_stock',
      [
        'label' => esc_html__('Hide out-of-stock items', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'storezz-elements'),
        'label_off' => esc_html__('No', 'storezz-elements'),
        'default' => 'yes',
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'additional_settings', [
        'label' => esc_html__('Additional Settings', 'storezz-elements'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'image_size_label', [
        'label' => esc_html__('Image Size', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::HEADING,
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Image_Size::get_type(), [
        'name' => 'image_size',
        'exclude' => ['custom'],
        'include' => [],
        'default' => 'large',
      ]
    );

    $this->add_control(
      'color_scheme', [
        'label' => esc_html__('Color Scheme', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .storezz-product-category-block1 .cat-btn:hover' => 'color: {{VALUE}}',
        ],
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
      'cat_btn_bgcolor', [
        'label' => esc_html__('Background', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .storezz-product-category-block1 .cat-btn:hover' => 'background-color: {{VALUE}}',
        ],
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
    $number_of_products          = $settings['number_of_products'];
    $show                        = $settings['show'];
    $orderby                     = $settings['order_by'];
    $order                       = $settings['order'];
    $categories                  = $settings['choose_categories'];
    $image_size                  = $settings['image_size_size'];
    $hide_out_of_stock           = $settings['hide_out_of_stock'];
    $product_visibility_term_ids = wc_get_product_visibility_term_ids();
    $query_args = array(
      'posts_per_page' => $number_of_products,
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
      $query_args['tax_query'][] = array(
        array(
            'taxonomy'      => 'product_cat',
            'field'         => 'term_id', //This is optional, as it defaults to 'term_id'
            'terms'         => $categories,
            'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
        ),
      );
    };

    if ( 'yes' === $hide_out_of_stock ) {
      $query_args['tax_query'][] = array(
        array(
          'taxonomy' => 'product_visibility',
          'field'    => 'term_taxonomy_id',
          'terms'    => $product_visibility_term_ids['outofstock'],
          'operator' => 'NOT IN',
        ),
      ); // WPCS: slow query ok.
    }

    if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
      $query_args['tax_query'][] = array(
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
      $query_args['tax_query'][] = array(
        'taxonomy' => 'product_visibility',
        'field'    => 'term_taxonomy_id',
        'terms'    => $product_visibility_term_ids['featured'],
      );
      break;
      case 'onsale':
      $product_ids_on_sale    = wc_get_product_ids_on_sale();
      $product_ids_on_sale[]  = 0;
      $query_args['post__in'] = $product_ids_on_sale;
      break;
    }

    switch ( $orderby ) {
      // case 'price':
      // $query_args['meta_key'] = '_price'; // WPCS: slow query ok.
      // $query_args['orderby']  = 'meta_value_num';
      // break;
      case 'rand':
      $query_args['orderby'] = 'rand';
      break;
      case 'popularity':
      $query_args['meta_key'] = 'total_sales'; // WPCS: slow query ok.
      $query_args['orderby']  = 'meta_value_num';
      break;
      case 'title':
      $query_args['orderby'] = 'title'; // WPCS: slow query ok.
      break;
      case 'id':
      $query_args['orderby'] = 'id'; // WPCS: slow query ok.
      break;
      case 'rating':
      $query_args['orderby'] = 'rating'; // WPCS: slow query ok.
      break;
      default:
      $query_args['orderby'] = 'date';
    }
    ob_start();

    $products =  new WP_Query( $query_args);
    if ( $products && $products->have_posts() ) { ?>
      <ul class="se-product-list">
        <?php
        $template_args = array(
          'show_rating' => true,
          'image_size' => $image_size,
        );

        while ( $products->have_posts() ) {
          $products->the_post();
          wc_get_template( 'content-widget-product.php', $template_args );
        }?>

      </ul><?php
    }

    wp_reset_postdata();

  }
}?>
