<?php
/**
* Magazine Post Carfdsousel Widget.
*/

class Storezz_News_Grid_Widget extends \Elementor\Widget_Base {


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
    return 'storezz-news-grid-widget';
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
    return __( 'Storezz News Grid Widget', 'storezz-elements' );
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
  //   return array( 'general', 'post-grid' );
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
        'label' => __( 'General settings', 'storezz-elements' ),
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
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'title',
      [
        'label' => __( 'Title', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __( 'Post grid', 'storezz-elements' ),
        'condition' => [ 'show_title' => ['yes'] ]
      ]
    );

    $this->add_control(
      'order',
      [
        'label' => __( 'Order ASC/DESC', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => __( 'DESC', 'storezz-elements' ),
        'options' => [
          'DESC'  => __( 'Descending', 'storezz-elements' ),
          'ASC' => __( 'Ascending', 'storezz-elements' ),
        ],
      ]
    );

    $this->add_control(
      'order_by',
      [
        'label' => __( 'Show', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => __( 'date', 'storezz-elements' ),
        'options' => [
          'date'  => __( 'Latest posts', 'storezz-elements' ),
          'comment_count'  => __( 'Most commented', 'storezz-elements' ),
          'meta_value_num'  => __( 'Most read', 'storezz-elements' ),
        ],
      ]
    );

    $this->add_control(
      'post_pick_by',
      [
        'label'     => esc_html__( 'Post pick by', 'storezz-elements' ),
        'type'      => \Elementor\Controls_Manager::SELECT,
        'default'   => '',
        'options'   => [
          'all'      =>esc_html__( 'All', 'storezz-elements' ),
          'category'      =>esc_html__( 'Category', 'storezz-elements' ),
          'tags'      =>esc_html__( 'Tags', 'storezz-elements' ),
          'stickypost'    =>esc_html__( 'Sticky posts', 'storezz-elements' ),
          'post'    =>esc_html__( 'Post id', 'storezz-elements' ),
          'author'    =>esc_html__( 'Author', 'storezz-elements' ),
        ],
      ]
    );

    $this->add_responsive_control(
      'number_of_columns',
      [
        'label' => __( 'Number of columns', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          '1fr'  => __( '1', 'storezz-elements' ),
          '1fr 1fr'  => __( '2', 'storezz-elements' ),
          '1fr 1fr 1fr'  => __( '3', 'storezz-elements' ),
          '1fr 1fr 1fr 1fr'  => __( '4', 'storezz-elements' ),
        ],
        'default' => '1fr 1fr 1fr',
        'devices' => [ 'desktop', 'tablet', 'mobile' ],
        'selectors' => [
          '{{WRAPPER}} .big-wrapper' => 'grid-template-columns: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'post_categories',
      [
        'label' => __( 'Choose categories', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'default' => '',
        'options' => $this->post_category(),
        'label_block' => true,
        'multiple' => true,
        'condition' => [ 'post_pick_by' => ['category'] ]
      ]
    );

    $this->add_control(
      'post_tags',
      [
        'label' => esc_html__('Select tags', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'options' => $this->se_plugin_post_tags(),
        'label_block' => true,
        'multiple' => true,
        'condition' => [ 'post_pick_by' => ['tags'] ]
      ]
    );

    $this->add_control(
      'author_id',
      [
        'label' => esc_html__( 'Author id', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => esc_html__( '1,2,3', 'storezz-elements' ),
        'condition' => [ 'post_pick_by' => ['author'] ]
      ]
    );
    $this->add_control(
      'post_id',
      [
        'label' => esc_html__( 'Post id', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => esc_html__( '1,2,3', 'storezz-elements' ),
        'condition' => [ 'post_pick_by' => ['post'] ]
      ]
    );

    $this->add_control(
      'post_count',
      [
        'label' => __( 'Post count', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => __( 4, 'storezz-elements' ),
        'min' => 2,
        'max' => 12,
        'step' => 1,
      ]
    );


    $this->add_control(
      'skip_post',
      [
        'label' => esc_html__('Post skip', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'storezz-elements'),
        'label_off' => esc_html__('No', 'storezz-elements'),
        'default' => 'no',

      ]
    );

    $this->add_control(
      'skip_post_num',
      [
        'label'         => esc_html__( 'Skip post count', 'storezz-elements' ),
        'type'          => \Elementor\Controls_Manager::NUMBER,
        'default'       => '1',
        'condition' => [ 'skip_post' => 'yes' ]

      ]
    );




    $this->add_control(
      'post_title_crop',
      [
        'label'         => esc_html__( 'Post title limit (words)', 'storezz-elements' ),
        'type'          => \Elementor\Controls_Manager::NUMBER,
        'default' => '15',

      ]
    );


    $this->add_control(
      'show_exerpt',
      [
        'label' => esc_html__('Show excerpt', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'storezz-elements'),
        'label_off' => esc_html__('No', 'storezz-elements'),
        'default' => 'no',
      ]
    );

    $this->add_control(
      'post_content_crop',
      [
        'label'         => esc_html__( 'Post exerpt limit', 'storezz-elements' ),
        'type'          => \Elementor\Controls_Manager::NUMBER,
        'default' => '30',
        'condition' => [
          'show_exerpt' => ['yes']
        ]
      ]
    );


    $this->add_control(
      'show_date',
      [
        'label' => esc_html__('Show date', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'storezz-elements'),
        'label_off' => esc_html__('No', 'storezz-elements'),
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'show_cat',
      [
        'label' => esc_html__('Show category', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'storezz-elements'),
        'label_off' => esc_html__('No', 'storezz-elements'),
        'default' => 'yes',
      ]
    );
    $this->add_control(
      'show_author',
      [
        'label' => esc_html__('Show author', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'storezz-elements'),
        'label_off' => esc_html__('No', 'storezz-elements'),
        'default' => 'no',
      ]
    );
    // $this->add_control(
    //   'show_views',
    //   [
    //     'label' => esc_html__('Show views', 'storezz-elements'),
    //     'type' => \Elementor\Controls_Manager::SWITCHER,
    //     'label_on' => esc_html__('Yes', 'storezz-elements'),
    //     'label_off' => esc_html__('No', 'storezz-elements'),
    //     'default' => 'yes',
    //   ]
    // );
    $this->add_control(
      'show_comments',
      [
        'label' => esc_html__('Show comments', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'storezz-elements'),
        'label_off' => esc_html__('No', 'storezz-elements'),
        'default' => 'yes',
      ]
    );

    $this->end_controls_section();

////////////////////////////////////////////////////////////////
    $this->start_controls_section(
      'general_style_settings',
      [
        'label' => __( 'General settings', 'storezz-elements' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );



    $this->add_control(
      'big_typo_section',
      [
        'label' => __( 'Typography', 'plugin-name' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => __( 'Widget title typography', '' ),
        'name' => 'big_title_typography',
        'selector' => '{{WRAPPER}} .se-block-title',
      ]
    );

    $this->add_control(
      'widget_title_color',
      [
        'label' => __( 'Widget title color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#393939',
        'selectors' => [
          '{{WRAPPER}} .se-block-title' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => __( 'Headline typography', '' ),
        'name' => 'big_title_typography',
        'selector' => '{{WRAPPER}} .se-post-grid .wrapper--big .news-title',
      ]
    );

    $this->add_control(
      'big_title_color_1',
      [
        'label' => __( 'Headline color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#212529',
        'selectors' => [
          '{{WRAPPER}} .se-post-grid .wrapper--big .news-title' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => __( 'Description typography', '' ),
        'name' => 'big_desc_typography',
        'selector' => '{{WRAPPER}} .se-post-grid .wrapper--big .description',
      ]
    );


    $this->add_control(
      'big_description_color_2',
      [
        'label' => __( 'Description color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#212529',
        'selectors' => [
          '{{WRAPPER}} .se-post-grid .wrapper--big .description-inner p' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => __( 'Details typography', '' ),
        'name' => 'details_typography',
        'selector' => '{{WRAPPER}} .se-post-grid .wrapper--big .description-inner .comments-views-date span',
      ]
    );

    $this->add_control(
      'details_color',
      [
        'label' => __( 'Details color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#989898',
        'selectors' => [
          '{{WRAPPER}} .se-post-grid .wrapper--big .description-inner .comments-views-date span' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_control(
      'big_category_display',
      [
        'label' => __( 'Category display', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => __( 'background_color', 'storezz-elements' ),
        'options' => [
          'background_color'  => __( 'Color background', 'storezz-elements' ),
          'color' => __( 'Color text', 'storezz-elements' ),
        ],
      ]
    );

    $this->add_control(
      'thumbnail_border',
      [
        'label' => __( 'Thumbnail border', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::HEADING,
      ]
    );


    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'thumb_border',
        'fields_options' => [
          'border' => ['default' => 'solid'],
          'width' => [
            'default' => [
              'top' => 1,
              'right' => 1,
              'bottom' => 1,
              'left' => 1,
              'unit'=> 'px',
              'isLinked' => true,
            ],
          ],
          'color' => ['default' => '#dee2e6'],
        ],
        'selector' => '{{WRAPPER}} .se-post-grid .wrapper .thumbnail',
      ]
    );

    $this->add_control(
      'item_border',
      [
        'label' => __( 'Item border', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before'
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'itemborder',
        'fields_options' => [
          'width' => [
            'default' => [
              'top' => 1,
              'right' => 1,
              'bottom' => 1,
              'left' => 1,
              'unit'=> 'px',
              'isLinked' => true,
            ],
          ],
          'color' => ['default' => '#dee2e6'],
        ],
        'selector' => '{{WRAPPER}} .se-post-grid .wrapper',
      ]
    );

    $this->add_control(
      'columns_rows',
      [
        'label' => __( 'Columns and rows', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before'
      ]
    );


    $this->add_responsive_control(
      'grid_item_column_gap',
      [
        'label' =>esc_html__( 'Column gap', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 15,
        'selectors' => [
          '{{WRAPPER}} .se-post-grid .big-wrapper' => 'column-gap: {{VALUE}}px;',
        ],
      ]
    );

    $this->add_responsive_control(
      'grid_item_row_gap',
      [
        'label' =>esc_html__( 'Row gap', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 15,
        'selectors' => [
          '{{WRAPPER}} .se-post-grid .big-wrapper' => 'row-gap: {{VALUE}}px;',
        ],
      ]
    );


    $this->add_control(
      'column_width',
      [
        'label' => __( 'Column width', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => [ 'fr'],
        'range' => [
          'fr' => [
            'min' => 4,
            'max' => 10,
            'step' => 1,
          ],
        ],
        'default' => [
          'unit' => 'fr',
          'size' => 5,
        ],
        'selectors' => [
          '{{WRAPPER}} .big-wrapper--style-a' => 'grid-template-columns: {{SIZE}}{{UNIT}} 4fr;',
        ],
        'condition' => [ 'block_style' => ['style-1'] ],
      ]
    );

    $this->add_control(
      'background',
      [
        'label' => __( 'Item background', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before'
      ]
    );


    $this->add_control(
      'grid_item_color',
      [
        'label' => __( 'Grid item background color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => 'rgba(255,255,255,0)',
        'selectors' => [
          '{{WRAPPER}} .se-post-grid .wrapper' => 'background-color: {{VALUE}}',
        ],
      ]
    );




    $this->add_control(
      'paddings',
      [
        'label' => __( 'Paddings', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );


    $this->add_responsive_control(
      'grid_item_padding',
      [
        'label' =>esc_html__( 'Grid item padding', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px'],
        'placeholder' => '0',
        'default' => [
          'top' => '0',
          'right' => '0',
          'bottom' => '0',
          'left' => '0',
          'unit' => 'px',
          'isLinked' => true,
        ],
        'selectors' => [
          '{{WRAPPER}} .se-post-grid .wrapper--big .description-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'thumbnail_padding',
      [
        'label' =>esc_html__( 'Thumbnail padding', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px'],
        'placeholder' => '0',
        'default' => [
          'top' => '7',
          'right' => '7',
          'bottom' => '7',
          'left' => '7',
          'unit' => 'px',
          'isLinked' => true,
        ],
        'selectors' => [
          '{{WRAPPER}} .thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );


    $this->add_control(
      'margins_section',
      [
        'label' => __( 'Margins', 'plugin-name' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );



    $this->add_responsive_control(
      'thumbnail_margin_bottom',
      [
        'label' => __( 'Thumbnail margin bottom', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 20,
          ],
        ],
        'devices' => [ 'desktop', 'tablet', 'mobile' ],
        'desktop_default' => [
          'size' => 5,
          'unit' => 'px',
        ],
        'tablet_default' => [
          'size' => 5,
          'unit' => 'px',
        ],
        'mobile_default' => [
          'size' => 5,
          'unit' => 'px',
        ],
        'selectors' => [
          '{{WRAPPER}} .se-post-grid .wrapper--big .thumbnail' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
      ]
    );



    $this->add_responsive_control(
      'category_margin_bottom',
      [
        'label' => __( 'Category margin bottom', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 20,
          ],
        ],
        'devices' => [ 'desktop', 'tablet', 'mobile' ],
        'desktop_default' => [
          'size' => 2,
          'unit' => 'px',
        ],
        'tablet_default' => [
          'size' => 2,
          'unit' => 'px',
        ],
        'mobile_default' => [
          'size' => 2,
          'unit' => 'px',
        ],
        'selectors' => [
          '{{WRAPPER}} .se-post-grid .wrapper--big .category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'Title_margin_bottom',
      [
        'label' => __( 'Title margin bottom', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 20,
          ],
        ],
        'devices' => [ 'desktop', 'tablet', 'mobile' ],
        'desktop_default' => [
          'size' => 5,
          'unit' => 'px',
        ],
        'tablet_default' => [
          'size' => 5,
          'unit' => 'px',
        ],
        'mobile_default' => [
          'size' => 5,
          'unit' => 'px',
        ],
        'selectors' => [
          '{{WRAPPER}} .se-post-grid .wrapper--big .news-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'Excerpt_margin_bottom',
      [
        'label' => __( 'Excerpt margin bottom', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 20,
          ],
        ],
        'devices' => [ 'desktop', 'tablet', 'mobile' ],
        'desktop_default' => [
          'size' => 5,
          'unit' => 'px',
        ],
        'tablet_default' => [
          'size' => 5,
          'unit' => 'px',
        ],
        'mobile_default' => [
          'size' => 5,
          'unit' => 'px',
        ],
        'selectors' => [
          '{{WRAPPER}} .se-post-grid .wrapper--big .description p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
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
    $show_title         = $settings['show_title'];
    $show_cat           = $settings['show_cat'];
    $show_date          = $settings['show_date'];
    $show_author         = $settings['show_author'];
    $show_views         = $settings['show_views'];
    $show_comments         = $settings['show_comments'];
    $show_tags        = $settings['show_tags'];
    $post_count      = $settings['post_count'];
    $show_exerpt = $settings['show_exerpt'];
    $crop	= (isset($settings['post_title_crop'])) ? $settings['post_title_crop'] : 20;
    $post_content_crop	= (isset($settings['post_content_crop'])) ? $settings['post_content_crop'] : 50;
    $big_category_display = $settings['big_category_display'];

    $this->add_inline_editing_attributes( 'title', 'none' );
    ?>
    <?php
    $arg = [
      'post_type'   =>  'post',
      'post_status' => 'publish',
      'orderby' => $settings['order_by'],
      'posts_per_page' => $post_count,
      'order' => $settings['order'],
    ];

    if($settings['post_pick_by']=='stickypost'){
      $arg['post__in'] = get_option( 'sticky_posts' );
      $arg['ignore_sticky_posts'] = 1;
    } else {
      $arg['ignore_sticky_posts'] = 1;
    }

    if($settings['post_pick_by']=='category') {
      $arg['category__in'] = $settings['post_categories'];
    }

    if($settings['post_pick_by']=='tags') {
      $arg['tag__in'] = $settings['post_tags'];
    }

    if($settings['post_pick_by']=='post') {
      $se_plugin_posts = explode(',',$settings['post_id']);
      $arg['post__in'] = $storezz-elements_posts;
      $arg['posts_per_page'] = count($storezz-elements_posts);
    }

    if($settings['post_pick_by']=='author') {
      $se_plugin_authors = explode(',',$settings['author_id']);
      $arg['author__in'] = $storezz-elements_authors;
    }

    if($settings['skip_post']=='yes'){
      $arg['offset'] = $settings['skip_post_num'];
    }

    if($settings['order_by']== 'meta_value_num'){
      $arg['meta_key'] ='post_views_count';
    }

    $queryd = new \WP_Query( $arg );
    if ( $queryd->have_posts() ) : ?>
    <div class="se-post-grid">
      <?php if($show_title) { ?>
        <h2 class="se-block-title" <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
      <?php }  ?>
      <?php  require 'block_styles/post-grid.php'; ?>
      <?php wp_reset_postdata(); ?>
    </div>
  <?php else: ?>
  <p>There are no posts matching your criteria.</p>
  <?php endif; ?>
<?php }

protected function _content_template() {

}

public function post_category() {

  $terms = get_terms( array(
    'taxonomy'    => 'category',
    'hide_empty'  => false,
    'posts_per_page' => -1,
    'suppress_filters' => false,
  ) );

  $cat_list = [];
  foreach($terms as $post) {
    $cat_list[$post->term_id]  = [$post->name];
  }
  return $cat_list;
}

function se_plugin_post_tags(){
  $terms = get_terms( array(
    'taxonomy'    => 'post_tag',
    'hide_empty'  => false,
    'posts_per_page' => -1,
  ) );

  $cat_list = [];
  foreach($terms as $post) {
    $cat_list[$post->term_id]  = [$post->name];
  }
  return $cat_list;
}

function se_plugin_post_authors(){
  $terms = wp_list_authors( array(
    'show_fullname' => 1,
    'optioncount'   => 1,
    'html'          => false,
    'orderby'       => 'post_count',
    'order'         => 'DESC',
  ) );

  $cat_list = [];
  foreach($terms as $post) {
    $cat_list[$post->term_id]  = [$post->name];
  }
  return $cat_list;
}

}
