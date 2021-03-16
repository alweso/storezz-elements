<?php

/**
* Magazine Post Carousel Widget.
*/
class Storezz_Product_Grid_Widget extends \Elementor\Widget_Base {

  /** Widget Name */
  public function get_name() {
    return 'storezz-product-grid-widget';
  }

  /** Widget Title */
  public function get_title() {
    return __('Product Grid', 'storezz-elements');
  }

  /** Icon */
  public function get_icon() {
    return 'eicon-inner-section';
  }

  /** Category */
  public function get_categories() {
    return ['storezz-elements'];
  }

  /** Controls */
  protected function _register_controls() {
    $this->start_controls_section(
      'content_section', [
        'label' => __('Content', 'storezz-elements'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'choose_categories', [
        'label' => __('Choose Categories', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'default' => '',
        'multiple' => true,
        'options'   => storezz_elements_get_woo_categories_list(),
      ]
    );

    // featured product - // todDo


    $this->add_control(
      'orderby', [
        'label' => __('Order Products By', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'title',
        'options'   => [
          ''      =>esc_html__( '', 'menheer-plugin' ),
          'date'      =>esc_html__( 'Date', 'menheer-plugin' ),
          'id'      =>esc_html__( 'ID', 'menheer-plugin' ),
          'menu_order'      =>esc_html__( 'Menu Order', 'menheer-plugin' ),
          'popularity'      =>esc_html__( 'Best selling', 'menheer-plugin' ),
          'rating'      =>esc_html__( 'Rating', 'menheer-plugin' ),
          'title'      =>esc_html__( 'Name', 'menheer-plugin' ),
          'rand'      =>esc_html__( 'Random', 'menheer-plugin' ),
        ],
      ]
    );

    $this->add_control(
      'order', [
        'label' => __('Order (ASC/DESC)', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => '',
        'options'   => [
          'ASC'      =>esc_html__( 'Ascending', 'menheer-plugin' ),
          'DESC'      =>esc_html__( 'Descending', 'menheer-plugin' ),
        ],
      ]
    );

    $this->add_control(
      'show', [
        'label' => __('Show', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => '',
        'options' => [
          ''         => __( 'All products', 'woocommerce' ),
          'featured' => __( 'Featured products', 'woocommerce' ),
          'onsale'   => __( 'On-sale products', 'woocommerce' ),
        ],
      ]
    );




    $this->add_control(
      'number_of_products',
      [
        'label' => __( 'Number of products', 'menheer-plugin' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => __( 4, 'menheer-plugin' ),
        'min' => 1,
        'step' => 1,
      ]
    );

    $this->add_control(
      'number_of_columns',
      [
        'label' => __( 'Number of columns', 'menheer-plugin' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => '4',
        'options'   => [
          '1'      =>esc_html__( '1', 'menheer-plugin' ),
          '2'      =>esc_html__( '2', 'menheer-plugin' ),
          '3'      =>esc_html__( '3', 'menheer-plugin' ),
          '4'      =>esc_html__( '4', 'menheer-plugin' ),
          '5'      =>esc_html__( '5', 'menheer-plugin' ),
          '6'      =>esc_html__( '6', 'menheer-plugin' ),
        ],
      ]
    );


    $this->add_control(
      'column_gap',
      [
        'label' => __( 'Column Gap', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => __( 4, 'menheer-plugin' ),
        'min' => 0,
        'max' => 40,
        'step' => 1,
      ]
    );


    $this->end_controls_section();

    $this->start_controls_section(
      'additional_settings', [
        'label' => __('Additional Settings', 'storezz-elements'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
        'default' => 'large',
      ]
    );

    $this->add_control(
      'color_scheme', [
        'label' => __('Color Scheme', 'storezz-elements'),
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
        'label' => __('Category Button', 'storezz-elements'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'cat_btn_bgcolor', [
        'label' => __('Background', 'storezz-elements'),
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
        'label' => __('Text Color', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .storezz-product-category-block1 .cat-btn' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(), [
        'name' => 'cat_btn_typography',
        'label' => __('Typography', 'storezz-elements'),
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
    $orderby                     = $settings['orderby'];
    $order                       = $settings['order'];
    $categories                     = $settings['choose_categories'];
    $product_visibility_term_ids = wc_get_product_visibility_term_ids();
    $query_args = array(
      'posts_per_page' => $number_of_products,
      'post_status'    => 'publish',
      'post_type'      => 'product',
      'no_found_rows'  => 1,
      'order'          => $order,
      'meta_query'     => array(),
      'tax_query'      => array(
        array(
            'taxonomy'      => 'product_cat',
            'field' => 'term_id', //This is optional, as it defaults to 'term_id'
            'terms'         => $categories,
            'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
        ),
        'relation' => 'AND',
      ),
    ); // WPCS: slow query ok.

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
      case 'price':
      $query_args['meta_key'] = '_price'; // WPCS: slow query ok.
      $query_args['orderby']  = 'meta_value_num';
      break;
      case 'rand':
      $query_args['orderby'] = 'rand';
      break;
      case 'sales':
      $query_args['meta_key'] = 'total_sales'; // WPCS: slow query ok.
      $query_args['orderby']  = 'meta_value_num';
      break;
      default:
      $query_args['orderby'] = 'date';
    }
    ob_start();

    $products =  new WP_Query( $query_args);
    if ( $products && $products->have_posts() ) { ?>
      <ul style="display:grid; grid-template-columns:1fr 1fr 1fr 1fr">
        <?php
        $template_args = array(
          'widget_id'   => isset( $args['widget_id'] ) ? $args['widget_id'] : $this->widget_id,
          'show_rating' => true,
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
