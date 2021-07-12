<?php

class Storezz_News_Block_Widget extends \Elementor\Widget_Base {

  public function __construct( $data = array(), $args = null ) {
    parent::__construct( $data, $args );
    wp_register_style( 'storezz-elements', STOREZZ_ELEMENTS_ASSETS_URI . '/css/storezz-elements.css', array(), STOREZZ_ELEMENTS_VERSION );
    wp_register_style( 'se-news-block', STOREZZ_ELEMENTS_ASSETS_URI . '/css/se-news-block.css', array(), STOREZZ_ELEMENTS_VERSION );
  }

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
    return 'storezz-news-block-widget';
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
    return esc_html__( 'Storezz News Block Widget', 'storezz-elements' );
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
  public function get_style_depends() {
    return array( 'storezz-elements', 'se-news-block' );
  }

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
        'label' => esc_html__( 'General settings', 'storezz-elements' ),
      ]
    );

    $this->add_control(
      'block_style',
      [
        'label' => esc_html__( 'Choose block style', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => esc_html__( 'style-1', 'storezz-elements' ),
        'options' => [
          'style-1'  => esc_html__( 'Style 1', 'storezz-elements' ),
          'style-2' => esc_html__( 'Style 2', 'storezz-elements' ),
          'style-3' => esc_html__( 'Style 3', 'storezz-elements' ),
          'style-4' => esc_html__( 'Style 4', 'storezz-elements' ),
        ],
      ]
    );

    $this->add_control(
      'show_title',
      [
        'label' => esc_html__('Show block title', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'storezz-elements'),
        'label_off' => esc_html__('No', 'storezz-elements'),
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'title',
      [
        'label' => esc_html__( 'Title', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__( 'Post block', 'storezz-elements' ),
        'condition' => [ 'show_title' => ['yes'] ]
      ]
    );

    $this->add_control(
      'order',
      [
        'label' => esc_html__( 'Order ASC/DESC', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => esc_html__( 'DESC', 'storezz-elements' ),
        'options' => [
          'DESC'  => esc_html__( 'Descending', 'storezz-elements' ),
          'ASC' => esc_html__( 'Ascending', 'storezz-elements' ),
        ],
      ]
    );
    //
    // $this->add_control(
    //   'order_by',
    //   [
    //     'label' => esc_html__( 'Show', 'storezz-elements' ),
    //     'type' => \Elementor\Controls_Manager::SELECT,
    //     'default' => esc_html__( 'date', 'storezz-elements' ),
    //     'options' => [
    //       'date'  => esc_html__( 'Latest posts', 'storezz-elements' ),
    //       'comment_count'  => esc_html__( 'Most commented', 'storezz-elements' ),
    //       'meta_value_num'  => esc_html__( 'Most read', 'storezz-elements' ),
    //     ],
    //   ]
    // );

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

    $this->add_control(
      'post_categories',
      [
        'label' => esc_html__( 'Choose categories', 'storezz-elements' ),
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
        'label' => esc_html__( 'Post count', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => esc_html__( 5, 'storezz-elements' ),
        'min' => 5,
        'max' => 13,
        'step' => 1,
        'condition' => [ 'block_style' => ['style-1'] ]
      ]
    );

    $this->add_control(
      'post_count_2',
      [
        'label' => esc_html__( 'Post count', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => esc_html__( 6, 'storezz-elements' ),
        'condition' => [ 'block_style' => ['style-4'] ]
      ]
    );

    $this->add_control(
      'post_count_3',
      [
        'label' => esc_html__( 'Post count', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => esc_html__( 5, 'storezz-elements' ),
        'min' => 2,
        'max' => 5,
        'step' => 1,
        'condition' => [ 'block_style' => ['style-2', 'style-3'] ]
      ]
    );


    $this->add_control(
      'skip_post',
      [
        'label' => esc_html__('Post skip', 'digiqole'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'digiqole'),
        'label_off' => esc_html__('No', 'digiqole'),
        'default' => 'no',

      ]
    );

    $this->add_control(
      'skip_post_num',
      [
        'label'         => esc_html__( 'Skip post count', 'digiqole' ),
        'type'          => \Elementor\Controls_Manager::NUMBER,
        'default'       => '1',
        'condition' => [ 'skip_post' => 'yes' ]

      ]
    );


    $this->end_controls_section();

    $this->start_controls_section(
      'big_item_features',
      [
        'label' => esc_html__( 'Big item features', 'storezz-elements' ),
      ]
    );

    $this->add_control(
      'post_title_crop',
      [
        'label'         => esc_html__( 'Post Title limit (words)', 'storezz-elements' ),
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
        'condition' => [ 'block_style' => ['style-1', 'style-2', 'style-2', 'style-4'] ]
      ]
    );


    $this->add_control(
      'post_content_crop',
      [
        'label'         => esc_html__( 'Post Exerpt limit', 'storezz-elements' ),
        'type'          => \Elementor\Controls_Manager::NUMBER,
        'default' => '30',
        'condition' => [
          'block_style' => ['style-1', 'style-2', 'style-2', 'style-4'],
          'show_exerpt' => ['yes']
        ]
      ]
    );


    $this->add_control(
      'show_date',
      [
        'label' => esc_html__('Show Date', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'storezz-elements'),
        'label_off' => esc_html__('No', 'storezz-elements'),
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'show_cat',
      [
        'label' => esc_html__('Show Category', 'storezz-elements'),
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
    // $this->add_control(
    //   'show_comments',
    //   [
    //     'label' => esc_html__('Show comments', 'storezz-elements'),
    //     'type' => \Elementor\Controls_Manager::SWITCHER,
    //     'label_on' => esc_html__('Yes', 'storezz-elements'),
    //     'label_off' => esc_html__('No', 'storezz-elements'),
    //     'default' => 'yes',
    //   ]
    // );

    $this->end_controls_section();

    $this->start_controls_section(
      'small_item_features',
      [
        'label' => esc_html__( 'Small item features', 'storezz-elements' ),
      ]
    );


    $this->add_control(
      'post_title_crop_small',
      [
        'label'         => esc_html__( 'Post title limit (words)', 'storezz-elements' ),
        'type'          => \Elementor\Controls_Manager::NUMBER,
        'default' => '35',

      ]
    );

    $this->add_control(
      'show_exerpt_small',
      [
        'label' => esc_html__('Show excerpt', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'storezz-elements'),
        'label_off' => esc_html__('No', 'storezz-elements'),
        'default' => 'no',
      ]
    );

    $this->add_control(
      'post_content_crop_small',
      [
        'label'         => esc_html__( 'Post Exerpt limit', 'storezz-elements' ),
        'type'          => \Elementor\Controls_Manager::NUMBER,
        'default' => '30',
        'condition' => [ 'show_exerpt_small' => ['yes'] ]
      ]
    );

    $this->add_control(
      'show_date_small',
      [
        'label' => esc_html__('Show Date', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'storezz-elements'),
        'label_off' => esc_html__('No', 'storezz-elements'),
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'show_cat_small',
      [
        'label' => esc_html__('Show Category', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'storezz-elements'),
        'label_off' => esc_html__('No', 'storezz-elements'),
        'default' => 'yes',
      ]
    );
    $this->add_control(
      'show_author_small',
      [
        'label' => esc_html__('Show author', 'storezz-elements'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'storezz-elements'),
        'label_off' => esc_html__('No', 'storezz-elements'),
        'default' => 'no',
      ]
    );
    // $this->add_control(
    //   'show_views_small',
    //   [
    //     'label' => esc_html__('Show views', 'storezz-elements'),
    //     'type' => \Elementor\Controls_Manager::SWITCHER,
    //     'label_on' => esc_html__('Yes', 'storezz-elements'),
    //     'label_off' => esc_html__('No', 'storezz-elements'),
    //     'default' => 'yes',
    //   ]
    // );
    // $this->add_control(
    //   'show_comments_small',
    //   [
    //     'label' => esc_html__('Show comments', 'storezz-elements'),
    //     'type' => \Elementor\Controls_Manager::SWITCHER,
    //     'label_on' => esc_html__('Yes', 'storezz-elements'),
    //     'label_off' => esc_html__('No', 'storezz-elements'),
    //     'default' => 'yes',
    //   ]
    // );

    $this->end_controls_section();


    $this->start_controls_section(
      'general_style_settings',
      [
        'label' => esc_html__( 'General settings', 'storezz-elements' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Widget title typography', '' ),
        'name' => 'big_title_typography',
        'selector' => '{{WRAPPER}} .menheer-block-title',
      ]
    );

    $this->add_control(
      'widget_title_color',
      [
        'label' => esc_html__( 'Widget title color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#393939',
        'selectors' => [
          '{{WRAPPER}} .menheer-block-title' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_control(
      'big_thumbnail_border',
      [
        'label' => esc_html__( 'Thumbnail border', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::HEADING,
      ]
    );


    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'big_thumb_border',
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
        'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper .thumbnail',
      ]
    );

    $this->add_control(
      'item_border',
      [
        'label' => esc_html__( 'Item border', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before'
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'big_itemborder',
        'fields_options' => [
          'border' => ['default' => 'none'],
          'width' => [
            'default' => [
              'top' => 0,
              'right' => 0,
              'bottom' => 0,
              'left' => 0,
              'unit'=> 'px',
              'isLinked' => true,
            ],
          ],
          'color' => ['default' => '#dee2e6'],
        ],
        'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper',
      ]
    );

    $this->add_control(
      'columns_rows',
      [
        'label' => esc_html__( 'Columns and rows', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before'
      ]
    );


    $this->add_responsive_control(
      'big_grid_item_column_gap',
      [
        'label' =>esc_html__( 'Grid item column gap (css grid)', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 15,
        'selectors' => [
          '{{WRAPPER}} .awesomesauce-post-block .big-wrapper' => 'column-gap: {{VALUE}}px;',
        ],
      ]
    );

    $this->add_responsive_control(
      'big_grid_item_row_gap',
      [
        'label' =>esc_html__( 'Grid item row gap (css grid)', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 15,
        'selectors' => [
          '{{WRAPPER}} .awesomesauce-post-block .big-wrapper' => 'row-gap: {{VALUE}}px;',
        ],
      ]
    );


    $this->add_control(
      'column_width',
      [
        'label' => esc_html__( 'Column width', 'storezz-elements' ),
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
        'label' => esc_html__( 'Background', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before'
      ]
    );

    $this->add_control(
      'grid_item_color',
      [
        'label' => esc_html__( 'Grid item background color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => 'rgba(255,255,255,0)',
        'selectors' => [
          '{{WRAPPER}} .awesomesauce-post-block .wrapper' => 'background-color: {{VALUE}}',
        ],
      ]
    );




    $this->end_controls_section();

    $this->start_controls_section(
      'big_items_section',
      [
        'label' => esc_html__( 'Big item features', 'storezz-elements' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );


    $this->add_control(
      'big_typo_section',
      [
        'label' => esc_html__( 'Typography', 'plugin-name' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Headline typography', '' ),
        'name' => 'big_title_typography',
        'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .news-title',
      ]
    );

    $this->add_control(
      'big_title_color_1',
      [
        'label' => esc_html__( 'Headline color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .news-title' => 'color: {{VALUE}}',
        ],
        'condition' => [ 'block_style' => ['style-1', 'style-2', 'style-3'] ]
      ]
    );


    $this->add_control(
      'big_title_color_2',
      [
        'label' => esc_html__( 'Headline Color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#3e3e3e',
        'selectors' => [
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .news-title' => 'color: {{VALUE}}',
        ],
        'condition' => [ 'block_style' => ['style-4'] ]
      ]
    );



    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Description typography', '' ),
        'name' => 'big_desc_typography',
        'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description',
      ]
    );


    $this->add_control(
      'big_description_color_1',
      [
        'label' => esc_html__( 'Big Description color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#ffffff',
        'selectors' => [
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description-inner p' => 'color: {{VALUE}}',
        ],
        'condition' => [ 'block_style' => ['style-1', 'style-2', 'style-3'] ]
      ]
    );

    $this->add_control(
      'big_description_color_2',
      [
        'label' => esc_html__( 'Description color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#3e3e3e',
        'selectors' => [
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description-inner p' => 'color: {{VALUE}}',
        ],
        'condition' => [ 'block_style' => ['style-4'] ]
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Big details typography', '' ),
        'name' => 'big_details_typography',
        'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description-inner .comments-views-date span',
      ]
    );

    $this->add_control(
      'big_details_color_1',
      [
        'label' => esc_html__( 'Big details color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#c9c9c9',
        'selectors' => [
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description-inner .comments-views-date span' => 'color: {{VALUE}}',
        ],
        'condition' => [ 'block_style' => ['style-1', 'style-2', 'style-3'] ]
      ]
    );

    $this->add_control(
      'big_details_color_2',
      [
        'label' => esc_html__( 'Details color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#989898',
        'selectors' => [
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description-inner .comments-views-date span' => 'color: {{VALUE}}',
        ],
        'condition' => [ 'block_style' => ['style-4'] ]
      ]
    );

    $this->add_control(
      'big_category_display',
      [
        'label' => esc_html__( 'Category display', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => esc_html__( 'background_color', 'storezz-elements' ),
        'options' => [
          'background_color'  => esc_html__( 'Color background', 'storezz-elements' ),
          'color' => esc_html__( 'Color text', 'storezz-elements' ),
        ],
      ]
    );

    $this->add_responsive_control(
      'thumbnail_centering',
      [
        'label' => esc_html__( 'Thumbnail centering', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'devices' => [ 'desktop', 'tablet', 'mobile' ],
        'desktop_default' => [
          'size' => 50,
          'unit' => '%',
        ],
        'tablet_default' => [
          'size' => 50,
          'unit' => '%',
        ],
        'mobile_default' => [
          'size' => 50,
          'unit' => '%',
        ],
        'selectors' => [
          '{{WRAPPER}} .wrapper--big .thumbnail a' => 'background-position-x: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [ 'block_style' => ['style-1', 'style-2', 'style-3'] ]
      ]
    );

    $this->add_control(
      'paddings',
      [
        'label' => esc_html__( 'Paddings', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );


    $this->add_responsive_control(
      'big_grid_item_padding',
      [
        'label' =>esc_html__( 'Grid item padding', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px'],
        'placeholder' => '0',
        'default' => [
          'top' => '15',
          'right' => '15',
          'bottom' => '15',
          'left' => '15',
          'unit' => 'px',
          'isLinked' => true,
        ],
        'selectors' => [
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'condition' => [ 'block_style' => ['style-1', 'style-2', 'style-3'] ],
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

    $this->add_responsive_control(
      'big_grid_item_padding_2',
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
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'condition' => [ 'block_style' => ['style-4'] ],
      ]
    );


    $this->add_control(
      'big_margins_section',
      [
        'label' => esc_html__( 'Margins', 'plugin-name' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );



    $this->add_responsive_control(
      'big_thumbnail_margin_bottom',
      [
        'label' => esc_html__( 'Thumbnail margin bottom', 'storezz-elements' ),
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
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .thumbnail' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [ 'block_style' => ['style-4'] ],
      ]
    );



    $this->add_responsive_control(
      'big_category_margin_bottom',
      [
        'label' => esc_html__( 'Big category margin bottom', 'storezz-elements' ),
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
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'big_title_margin_bottom',
      [
        'label' => esc_html__( 'Big title margin bottom', 'storezz-elements' ),
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
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .news-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'big_excerpt_margin_bottom',
      [
        'label' => esc_html__( 'Big excerpt margin bottom', 'storezz-elements' ),
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
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
      ]
    );



    $this->end_controls_section();

    $this->start_controls_section(
      'small_items_section',
      [
        'label' => esc_html__( 'Small item features', 'storezz-elements' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );


    $this->add_control(
      'small_typo_section',
      [
        'label' => esc_html__( 'Small item typography', 'plugin-name' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Headline typography', '' ),
        'name' => 'small_title_typography',
        'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper--small .news-title',
      ]
    );


    $this->add_control(
      'small_title_color',
      [
        'label' => esc_html__( 'Headline Color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#3e3e3e',
        'selectors' => [
          '{{WRAPPER}}  .awesomesauce-post-block .wrapper--small .news-title' => 'color: {{VALUE}}',
        ],
      ]
    );


    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Description typography', '' ),
        'name' => 'small_desc_typography',
        'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper--small .description',
      ]
    );

    $this->add_control(
      'small_description_color',
      [
        'label' => esc_html__( 'Description color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#3e3e3e',
        'selectors' => [
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--big p' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => esc_html__( 'Details typography', '' ),
        'name' => 'small_details_typography',
        'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper--small .description-inner .comments-views-date span',
      ]
    );

    $this->add_control(
      'small_details_color',
      [
        'label' => esc_html__( 'Details color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#989898',
        'selectors' => [
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--small .description-inner .comments-views-date span' => 'color: {{VALUE}}',
        ],
      ]
    );

    $this->add_control(
      'small_paddings',
      [
        'label' => esc_html__( 'Paddings', 'storezz-elements' ),
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
          'isLinked' => 'false',
        ],
        'selectors' => [
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--small .description-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_control(
      'small_margins_section',
      [
        'label' => esc_html__( 'Margins', 'plugin-name' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_responsive_control(
      'thumbnail_margin_bottom',
      [
        'label' => esc_html__( 'Thumbnail margin bottom', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 100,
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
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--small .thumbnail' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [ 'block_style' => ['style-2', 'style-3', 'style-4'] ],
      ]
    );


    $this->add_responsive_control(
      'small_category_margin_bottom',
      [
        'label' => esc_html__( 'Category margin bottom', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 100,
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
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--small .category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'small_title_margin_bottom',
      [
        'label' => esc_html__( 'Title margin bottom', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 100,
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
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--small .news-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_responsive_control(
      'small_excerpt_margin_bottom',
      [
        'label' => esc_html__( 'Excerpt margin bottom', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 100,
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
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--small .description p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_control(
      'small_thumbnail_width_section',
      [
        'label' => esc_html__( 'Thumbnail width', 'plugin-name' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [ 'block_style' => ['style-1'] ]
      ]
    );


    $this->add_control(
      'thumbnail_width',
      [
        'label' => esc_html__( 'Small thumbnail width', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => [ 'px'],
        'range' => [
          'px' => [
            'min' => 120,
            'max' => 230,
            'step' => 1,
          ],
        ],
        'default' => [
          'unit' => 'px',
          'size' => 145,
        ],
        'selectors' => [
          '{{WRAPPER}} .wrapper--small .thumbnail' => 'width: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [ 'block_style' => ['style-1'] ]
      ]
    );

    $this->add_control(
      'small_category_display',
      [
        'label' => esc_html__( 'Category display', 'storezz-elements' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => esc_html__( 'color', 'storezz-elements' ),
        'options' => [
          'background_color'  => esc_html__( 'Color background', 'storezz-elements' ),
          'color' => esc_html__( 'Color text', 'storezz-elements' ),
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
    $block_style = $settings['block_style'];
    $show_title         = $settings['show_title'];

    /* Big item*/
    $show_cat           = $settings['show_cat'];
    $show_date          = $settings['show_date'];
    $show_author         = $settings['show_author'];
    // $show_views         = $settings['show_views'];
    // $show_comments         = $settings['show_comments'];
    $post_count      = $settings['post_count'];
    $post_count_2      = $settings['post_count_2'];
    $post_count_3      = $settings['post_count_3'];
    $show_exerpt = $settings['show_exerpt'];
    $show_exerpt_2 = $settings['show_exerpt_2'];
    $crop	= (isset($settings['post_title_crop'])) ? $settings['post_title_crop'] : 20;
    $post_content_crop	= (isset($settings['post_content_crop'])) ? $settings['post_content_crop'] : 20;
    $post_content_crop_2	= (isset($settings['post_content_crop_2'])) ? $settings['post_content_crop_2'] : 50;

    /* Small item*/
    $show_cat_small           = $settings['show_cat_small'];
    $show_date_small          = $settings['show_date_small'];
    $show_author_small         = $settings['show_author_small'];
    // $show_views_small         = $settings['show_views_small'];
    // $show_comments_small         = $settings['show_comments_small'];
    $show_exerpt_small = $settings['show_exerpt_small'];
    $crop_small	= (isset($settings['post_title_crop_small'])) ? $settings['post_title_crop_small'] : 20;
    $post_content_crop_small	= (isset($settings['post_content_crop_small'])) ? $settings['post_content_crop_small'] : 50;
    $big_category_display = $settings['big_category_display'];
    $small_category_display = $settings['small_category_display'];


    $this->add_inline_editing_attributes( 'title', 'none' );
    ?>
    <?php
    $arg = [
      'post_type'   =>  'post',
      'post_status' => 'publish',
      // 'orderby' => $settings['order_by'],
      'posts_per_page' => $settings['post_count'],
      'order' => $settings['order'],
    ];

    if($settings['post_pick_by']=='stickypost'){
      $arg['post__in'] = get_option( 'sticky_posts' );
      $arg['ignore_sticky_posts'] = 1;
    } else {
      $arg['ignore_sticky_posts'] = 1;
    }

    if($settings['order_by']== 'meta_value_num'){
      $arg['meta_key'] ='post_views_count';
    }

    if($settings['block_style']=='style-4') {
      $arg['posts_per_page'] = $settings['post_count_2'];
    }

    if($settings['block_style']=='style-2' || $settings['block_style']=='style-3') {
      $arg['posts_per_page'] = $settings['post_count_3'];
    }

    if($settings['block_style']=='style-1') {
      $arg['posts_per_page'] = $settings['post_count'];
    }

    if($settings['post_pick_by']=='category') {
      $arg['category__in'] = $settings['post_categories'];
    }

    if($settings['post_pick_by']=='tags') {
      $arg['tag__in'] = $settings['post_tags'];
    }

    if($settings['post_pick_by']=='post') {
      $se_plugin_posts = explode(',',$settings['post_id']);
      $arg['post__in'] = $se_plugin_posts;
      $arg['posts_per_page'] = count($se_plugin_posts);
    }

    if($settings['post_pick_by']=='author') {
      $se_plugin_authors = explode(',',$settings['author_id']);
      $arg['author__in'] = $se_plugin_authors;
    }

    if($settings['skip_post']=='yes'){
      $arg['offset'] = $settings['skip_post_num'];
    }

    $queryd = new \WP_Query( $arg );
    if ( $queryd->have_posts() ) : ?>
    <div class="awesomesauce-post-block <?php echo $block_style ?>">
      <?php if($settings['block_style']=="style-1"): ?>
        <?php  require 'block_styles/style-a.php'; ?>
      <?php endif; ?>
      <?php if($settings['block_style']=="style-2") : ?>
        <?php  require 'block_styles/style-a.php'; ?>
      <?php endif; ?>
      <?php if($settings['block_style']=="style-3") : ?>
        <?php  require 'block_styles/style-a.php'; ?>
      <?php endif; ?>
      <?php if($settings['block_style']=="style-4") : ?>
        <?php  require 'block_styles/style-d.php'; ?>
      <?php endif; ?>
      <?php wp_reset_postdata(); ?>
    </div>
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
