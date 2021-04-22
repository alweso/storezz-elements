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
        'return_value' => 'yes',
        'default' => 'yes'
      ]
    );

    $this->add_control(
      'dot_nav_show',
      [
        'label' => esc_html__( 'Show Dot Navigation', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__( 'Yes', 'storezz-elements' ),
        'label_off' => esc_html__( 'No', 'storezz-elements' ),
        'return_value' => 'yes',
        'default' => 'yes'
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
        'default' => 'yes'
      ]
    );

    $this->add_control(
      'center',
      [
        'label' => esc_html__( 'Center slides', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__( 'Yes', 'storezz-elements' ),
        'label_off' => esc_html__( 'No', 'storezz-elements' ),
        'return_value' => 'yes',
        'default' => 'no'
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
    $autoplay                    = $settings['autoplay'];
    $center                      = $settings['center'];
    $nav                         = $settings['nav'];
    $nav_dot                     = $settings['nav_dot'];
    $hide_out_of_stock           = $settings['hide_out_of_stock'];
    $navArrows                   = ["<i class='nav-button owl-prev fas fa-angle-left'>‹</i>", "<i class='nav-button owl-next fas fa-angle-right'>›</i>"];
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


    $products = new WP_Query( $args );
    ?>
    <?php if( $products->have_posts() ) : ?>
      <ul data-carousel-options='{"autoplay":"<?php echo $autoplay ?>", "center":"<?php echo $center ?>", "dots":"<?php echo $nav_dot ?>", "items":"<?php echo $number_of_products ?>","loop":"true"}' class="se-product-slider owl-carousel">
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
