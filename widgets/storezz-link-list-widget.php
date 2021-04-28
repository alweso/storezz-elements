<?php
/**
* @since 1.1.0
*/
class Storezz_Link_List_Widget extends \Elementor\Widget_Base {

  // public function __construct( $data = array(), $args = null ) {
  //   parent::__construct( $data, $args );
  //   wp_register_style( 'general', plugins_url( '/assets/css/general.css', ELEMENTOR_AWESOMESAUCE ), array(), '1.0.0' );
  //   wp_register_style( 'post-list', plugins_url( '/assets/css/post-list.css', ELEMENTOR_AWESOMESAUCE ), array(), '1.0.0' );
  // }

  /**
  * Retrieve the widget name.
  *
  * @since 1.1.0
  *
  * @access public
  *
  * @return string Widget name.
  */
  public function get_name() {
    return 'storezz-link-list-widget';
  }

  /**
  * Retrieve the widget title.
  *
  * @since 1.1.0
  *
  * @access public
  *
  * @return string Widget title.
  */
  public function get_title() {
    return __( 'Storezz Link List Widget', 'storezz-elements' );
  }

  /**
  * Retrieve the widget icon.
  *
  * @since 1.1.0
  *
  * @access public
  *
  * @return string Widget icon.
  */
  public function get_icon() {
    return 'fa fa-pencil';
  }

  /**
  * Retrieve the list of categories the widget belongs to.
  *
  * Used to determine where to display the widget in the editor.
  *
  * Note that currently Elementor supports only one category.
  * When multiple categories passed, Elementor uses the first one.
  *
  * @since 1.1.0
  *
  * @access public
  *
  * @return array Widget categories.
  */
  public function get_categories() {
    return ['storezz-elements'];
  }

  /**
  * Enqueue styles.
  */
  // public function get_style_depends() {
  //   return array( 'general', 'post-list' );
  // }

  /**
  * Register the widget controls.
  *
  * Adds different input fields to allow the user to change and customize the widget settings.
  *
  * @since 1.1.0
  *
  * @access protected
  */
  protected function _register_controls() {
    $this->start_controls_section(
      'section_content',
      [
        'label' => __( 'Content', 'storezz-elements' ),
      ]
    );

    $this->add_control(
      'show_title',
      [
        'label' => esc_html__('Show title', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'storezz-elements'),
        'label_off' => esc_html__('No', 'storezz-elements'),
        'default' => 'no',
      ]
    );

    $this->add_control(
      'title',
      [
        'label' => __( 'Title', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __( 'Link list', 'storezz-elements' ),
        'condition' => [ 'show_title' => ['yes'] ]
      ]
    );

    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
      'link_address', [
        'label' => __( 'Add link address', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        // 'default'       => 'Add link',
      ]
    );

    $repeater->add_control(
      'link_name', [
        'label' => __( 'Add link name', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        // 'default'       => 'Add link',
      ]
    );

    $repeater->add_control(
      'show_badge',
      [
        'label' => esc_html__('Show badge', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'storezz-elements'),
        'label_off' => esc_html__('No', 'storezz-elements'),
      ]
    );

    $repeater->add_control(
      'link_badge', [
        'label'         => esc_html__( 'Link badge', 'storezz-elements' ),
        'type'          => \Elementor\Controls_Manager::TEXT,
        // 'default'       => 'New!',
      ]
    );

    $repeater->add_control(
      'badge_color', [
        'label' => __( 'Badge color', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => "#393939",
        'selectors' => [
          '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
        ]
      ]
    );

    $this->add_control(
      'links',
      [
        'label' => __( 'Repeater List', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
          [
            'link_address' => __( '', 'storezz-elements' ),
            'link_name' => __( 'Example name 1', 'storezz-elements' ),
            'link_badge' => __( 'New!', 'storezz-elements' ),
            'badge_color' => __( '#0069E8', 'storezz-elements' ),
            'show_badge' => __( 'yes', 'storezz-elements' ),
          ],
          [
            'link_address' => __( '', 'storezz-elements' ),
            'link_name' => __( 'Example name 1', 'storezz-elements' ),
            'link_badge' => __( 'Hot!', 'storezz-elements' ),
            'badge_color' => __( '#FF7E00', 'storezz-elements' ),
            'show_badge' => __( 'yes', 'storezz-elements' ),
          ],

        ],
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'general_style_settings',
      [
        'label' => __( 'General settings', 'storezz-elements' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );





    $this->end_controls_section();

  }

  /**
  * Render the widget output on the frontend.
  *
  * Written in PHP and used to generate the final HTML.
  *
  * @since 1.1.0
  *
  * @access protected
  */
  protected function render() {
    $settings = $this->get_settings_for_display();
    $show_title        = $settings['show_title'];
    $links             = $settings['links'];

    $this->add_inline_editing_attributes( 'title', 'none' );
    ?>

    <div class="se-post-list">
      <?php if($show_title) { ?>
        <h2 class="menheer-block-title" <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
      <?php }  ?>
        <ul>
          <?php
          foreach ( $links as $item ) {
          if ($item['show_badge'] === "yes") {
            echo '<li><a href="'. $item['link_address'] .'">'. $item['link_name'] .'</a><span class="se-link-badge elementor-repeater-item-' . $item['_id'].'">'.  $item['link_badge'] .'</span></li>';
          } else {
            echo '<li><a href="'. $item['link_address'] .'">'. $item['link_name'] .'</a></li>';
          }

          }
          ?>
        </ul>
    </div>
  <?php }

  protected function _content_template() {
    ?>
    <# if ( settings.show_title) { #>
    <h2 class="menheer-block-title">{{{ settings.title }}}</h2>
      <# }; #>
    <# if ( settings.links.length ) { #>
      <ul>
        <# _.each( settings.links, function( item ) { #>
          <li><a href="#">{{{ item.link_name }}}</a>
              <# if ( item.show_badge ) { #>
                            <span class="se-link-badge elementor-repeater-item-{{ item._id }}">
                {{{ item.link_badge }}}
                              </span>
                <# }; #>
            </li>
            <# }); #>
          </ul>
          <# } #>
          <?php
        }


      }
