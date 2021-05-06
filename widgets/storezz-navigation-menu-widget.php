<?php
/**
 * Widget API: WP_Nav_Menu_Widget class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement the Navigation Menu widget.
 *
 * @since 3.0.0
 *
 * @see WP_Widget
 */
 class Storezz_Navigation_Menu extends \Elementor\Widget_Base {

   public function __construct( $data = array(), $args = null ) {
     parent::__construct( $data, $args );
     wp_register_style( 'storezz-elements', STOREZZ_ELEMENTS_ASSETS_URI . '/css/storezz-elements.css', array(), STOREZZ_ELEMENTS_VERSION );
     wp_register_style( 'se-image', STOREZZ_ELEMENTS_ASSETS_URI . '/css/se-image.css', array(), STOREZZ_ELEMENTS_VERSION );
   }

   /** Widget Name */
   public function get_name() {
     return 'storezz-navigation-menu-widget';
   }

   /** Widget Title */
   public function get_title() {
     return __('Navigation Menu', 'storezz-elements');
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

   public function se_menu_items(){
     $menu = wp_get_nav_menu_items('24');
     foreach($menu as $item) {
       echo '<li><a href="'. $item->url .'">'. $item->title .'</a></li>';
       // $data_array[] = array(
       //             $item->title,
       //             $item->url,
       //             $item->ID,
       // );
       $data_array[] = array(
                   '<li><a href="'. $item->url .'">'. $item->title .'</a></li>',
       );
     }
     // echo $data_array;
     return $data_array;
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
       'menu_items', [
         'label' => __('Item', 'storezz-elements'),
         'type' => \Elementor\Controls_Manager::SELECT,
         'default' => 'title',
         'options'   => $this->se_menu_items(),
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
         // 'default' => [
         //   [
         //     'menu_items' => __( 'Item 1', 'storezz-elements' ),
         //     'link_badge' => __( 'New!', 'storezz-elements' ),
         //     'badge_color' => __( '#0069E8', 'storezz-elements' ),
         //     'show_badge' => __( 'yes', 'storezz-elements' ),
         //   ],
         //   [
         //     'menu_items' => __( 'Item 2', 'storezz-elements' ),
         //     'link_badge' => __( 'Hot!', 'storezz-elements' ),
         //     'badge_color' => __( '#FF7E00', 'storezz-elements' ),
         //     'show_badge' => __( 'yes', 'storezz-elements' ),
         //   ],
         //
         // ],
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



   /** Render Layout */
   protected function render() {
     $settings = $this->get_settings_for_display();
     // $menu = wp_get_nav_menu_items('24');
     $links = $settings['links'];
     // echo wp_get_nav_menu_items('24');
     echo '<pre>' . var_export($menu, true) . '</pre>';

     ?>
     <ul>
     <?php
     // echo 'ffsds' . $menu_items;
     // foreach($menu as $item) {
     //   echo '<li><a href="'. $item->url .'">'. $item->title .'</a></li>';
     // }
     ?>
     <?php
     foreach ( $links as $item ) {
       echo '<pre>' . var_export($item['menu_items'], true) . '</pre>';
       echo $item['menu_items'];
     // if ($item['show_badge'] === "yes") {
     //   echo '<li><a href="'. $item['url'] .'">'. $item['title'] .'</a><span class="se-link-badge elementor-repeater-item-' . $item['_id'].'">'.  $item['link_badge'] .'</span></li>';
     // } else {
     //   echo '<li><a href="'. $item['url'] .'">'. $item['title'] .'</a></li>';
     // }

     }
     ?>
   </ul>
      <?php }
 }?>
