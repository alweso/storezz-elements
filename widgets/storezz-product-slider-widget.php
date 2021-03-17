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
          ''         => __( 'All products', 'woocommerce' ),
          'featured' => __( 'Featured products', 'woocommerce' ),
          'onsale'   => __( 'On-sale products', 'woocommerce' ),
        ],
      ]
    );

    $this->add_control(
      'dot_nav_show',
      [
        'label' => esc_html__( 'Show Dot Navigation', 'menheer-plugin' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__( 'Yes', 'menheer-plugin' ),
        'label_off' => esc_html__( 'No', 'menheer-plugin' ),
        'return_value' => 'yes',
        'default' => 'yes'
      ]
    );

    $this->add_control(
      'product_type',
      [
        'label' => __( 'Product Type', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'latest',
        'options' => [
          'latest'  => __( 'Latest', 'storezz-elements' ),
          'featured'  => __( 'Featured', 'storezz-elements' ),
          'best-selling' => __( 'Best Selling', 'storezz-elements' ),
          'sale' => __( 'Sale', 'storezz-elements' ),
          'top-rated' => __( 'Top Rated', 'storezz-elements' ),
        ],
      ]
    );

    $this->add_control(
      'no_of_products',
      [
        'label' => __( 'No. of products', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => [ 'no' ],
        'range' => [
          'no' => [
            'min' => 1,
            'max' => 10,
            'step' => 1,
          ],
        ],
        'default' => [
          'unit' => 'no',
          'size' => 3,
        ],
      ]
    );

    $this->add_control(
      'orderby',
      [
        'label' => __( 'Order By', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'none',
        'options' => [
          'none' => __( 'None', 'storezz-elements' ),
          'ID' => __( 'ID', 'storezz-elements' ),
          'date' => __( 'Date', 'storezz-elements' ),
          'name' => __( 'Name', 'storezz-elements' ),
          'title' => __( 'Title', 'storezz-elements' ),
          'rand' => __( 'Random', 'storezz-elements' ),
          'comment_count' => __( 'Comment Count', 'storezz-elements' ),
        ],
      ]
    );

    $this->add_control(
      'order',
      [
        'label' => __( 'Order By', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'DESC',
        'options' => [
          'ASC' => __( 'Ascending', 'storezz-elements' ),
          'DESC' => __( 'Descending', 'storezz-elements' ),
        ],
      ]
    );

    $this->add_control(
      'image_size',
      [
        'label' => __( 'Image size', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'woocommerce_thumbnail',
        'options' => [
          'woocommerce_thumbnail' => __( 'woocommerce thumbnail', 'storezz-elements' ),
          'landscape-post-image' => __( 'another', 'storezz-elements' ),
        ],
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'additional_settings', [
        'label' => esc_html__('Additional Settings', 'storezz-elements'),
      ]
    );


    $this->add_control(
      'color_scheme',
      [
        'label' => __( 'Color Scheme', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .storezz-product-list .storezz-header a:hover,{{WRAPPER}} .storezz-product-list .product-list .content h3 a:hover,{{WRAPPER}} .storezz-product-list .star-rating span:before,{{WRAPPER}} .storezz-product-list .product-list .content h3 a:hover' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'header_style', [
        'label' => esc_html__('Header', 'storezz-elements'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'header_color',
      [
        'label' => __( 'Color', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .storezz-product-list .storezz-header,{{WRAPPER}} .storezz-product-list .storezz-header a' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_control(
      'header_padding',
      [
        'label' => __( 'Padding', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'allowed_dimensions' => 'vertical',
        'selectors' => [
          '{{WRAPPER}} .storezz-product-list .storezz-header' => 'padding: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'header_typography',
        'label' => __( 'Typography', 'storezz-elements' ),
        'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .storezz-product-list .storezz-header',
      ]
    );

    $this->add_control(
      'separator_color',
      [
        'label' => __( 'Separator Color', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .storezz-product-list .storezz-header' => 'border-bottom-color: {{VALUE}}',
        ],
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'rating_style', [
        'label' => esc_html__('Rating', 'storezz-elements'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'rating_color',
      [
        'label' => __( 'Color', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .storezz-product-list .star-rating' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_control(
      'rating_margin',
      [
        'label' => __( 'Margin', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'allowed_dimensions' => 'vertical',
        'selectors' => [
          '{{WRAPPER}} .storezz-product-list .star-rating' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
        ],
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'title_style', [
        'label' => esc_html__('Product Title', 'storezz-elements'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'title_color',
      [
        'label' => __( 'Color', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .storezz-product-list .product-list .content h3 a' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'title_typography',
        'label' => __( 'Typography', 'storezz-elements' ),
        'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .storezz-product-list .product-list .content h3',
      ]
    );

    $this->add_control(
      'title_margin',
      [
        'label' => __( 'Margin', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'allowed_dimensions' => 'vertical',
        'selectors' => [
          '{{WRAPPER}} .storezz-product-list .product-list .content h3' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
        ],
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'price_style', [
        'label' => esc_html__('Price', 'storezz-elements'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'price_color',
      [
        'label' => __( 'Color', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Scheme_Color::get_type(),
          'value' => \Elementor\Scheme_Color::COLOR_1,
        ],
        'selectors' => [
          '{{WRAPPER}} .storezz-product-list .product-list .price' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'price_typography',
        'label' => __( 'Typography', 'storezz-elements' ),
        'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .storezz-product-list .product-list .price',
      ]
    );

    $this->add_control(
      'price_margin',
      [
        'label' => __( 'Margin', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'allowed_dimensions' => 'vertical',
        'selectors' => [
          '{{WRAPPER}} .storezz-product-list .product-list .price' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
        ],
      ]
    );

    $this->end_controls_section();
  }

  /** Render Layout **/
  protected function render() {
    $settings = $this->get_settings_for_display();
    // $product_type = isset( $settings['product_type'] ) ? $settings['product_type'] : 'latest';
    $image_size = $settings['image_size'];
    $show                        = $settings['show'];
    $categories                  = $settings['choose_categories'];
    $product_visibility_term_ids = wc_get_product_visibility_term_ids();

    $args = array(
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
      $args['tax_query'][] = array(
        array(
            'taxonomy'      => 'product_cat',
            'field'         => 'term_id', //This is optional, as it defaults to 'term_id'
            'terms'         => $categories,
            'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
        ),
      );
    };

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


    $products = new WP_Query( $args );
    ?>
    <?php if( $products->have_posts() ) : ?>
      <ul data-carousel-options='{"autoplay":"true","items":"3","loop":"true","nav":"true"}'class="se-product-slider owl-carousel">
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
      <?php wp_reset_postdata(); endif; ?>
      <?php
    }
  }
