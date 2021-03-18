<?php

/**
 * Magazine Post Carousel Widget.
 */
class Storezz_Product_Category_Block_Widget extends \Elementor\Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'storezz-product-category-block-widget';
    }

    /** Widget Title */
    public function get_title() {
        return __('Product Category Block', 'storezz-elements');
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
            'layout_type', [
            'label' => __('Layout type', 'storezz-elements'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'block1',
            'options' => [
              'block1'      =>esc_html__( 'Block 1', 'storezz-elements' ),
              'block2'      =>esc_html__( 'Block 2', 'storezz-elements' ),
              'block3'      =>esc_html__( 'Block 3', 'storezz-elements' ),
              'block4'      =>esc_html__( 'Block 4', 'storezz-elements' ),
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'cat_1_section', [
            'label' => __('Category 1', 'storezz-elements'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
            'product_category1', [
            'label' => __('Category 1', 'storezz-elements'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 0,
            'options' => Storezz_elements_get_woo_categories_list(),
                ]
        );

        $this->add_control(
          'img_x_position_cat1',
          [
            'label' => __( 'Horizontal image position', 'storezz-elements' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%'],
            'range' => [
              '%' => [
                'min' => 0,
                'max' => 100,
                'step' => 1,
              ],
            ],
            'default' => [
              'unit' => '%',
              'size' => 50,
            ],
            'selectors' => [
              '{{WRAPPER}} .se-product-cat1 div' => 'background-position-x: {{SIZE}}{{UNIT}};',
            ],
          ]
        );

        $this->add_control(
          'img_y_position_cat1',
          [
            'label' => __( 'Vertical image position', 'storezz-elements' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%'],
            'range' => [
              '%' => [
                'min' => 0,
                'max' => 100,
                'step' => 1,
              ],
            ],
            'default' => [
              'unit' => '%',
              'size' => 50,
            ],
            'selectors' => [
              '{{WRAPPER}} .se-product-cat1 div' => 'background-position-y: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'after',
          ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'cat_2_section', [
            'label' => __('Category 2', 'storezz-elements'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'product_category2', [
            'label' => __('Category 2', 'storezz-elements'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 0,
            'options' => Storezz_elements_get_woo_categories_list(),
                ]
        );

        $this->add_control(
          'img_x_position_cat2',
          [
            'label' => __( 'Horizontal image position', 'storezz-elements' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%'],
            'range' => [
              '%' => [
                'min' => 0,
                'max' => 100,
                'step' => 1,
              ],
            ],
            'default' => [
              'unit' => '%',
              'size' => 50,
            ],
            'selectors' => [
              '{{WRAPPER}} .se-product-cat2 div' => 'background-position-x: {{SIZE}}{{UNIT}};',
            ],
          ]
        );

        $this->add_control(
          'img_y_position_cat2',
          [
            'label' => __( 'Vertical image position', 'storezz-elements' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%'],
            'range' => [
              '%' => [
                'min' => 0,
                'max' => 100,
                'step' => 1,
              ],
            ],
            'default' => [
              'unit' => '%',
              'size' => 50,
            ],
            'selectors' => [
              '{{WRAPPER}} .se-product-cat2 div' => 'background-position-y: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'after',
          ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'cat_3_section', [
            'label' => __('Category 3', 'storezz-elements'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'product_category3', [
            'label' => __('Category 3', 'storezz-elements'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 0,
            'options' => Storezz_elements_get_woo_categories_list(),
                ]
        );

        $this->add_control(
          'img_x_position_cat3',
          [
            'label' => __( 'Horizontal image position', 'storezz-elements' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%'],
            'range' => [
              '%' => [
                'min' => 0,
                'max' => 100,
                'step' => 1,
              ],
            ],
            'default' => [
              'unit' => '%',
              'size' => 50,
            ],
            'selectors' => [
              '{{WRAPPER}} .se-product-cat3 div' => 'background-position-x: {{SIZE}}{{UNIT}};',
            ],
          ]
        );

        $this->add_control(
          'img_y_position_cat3',
          [
            'label' => __( 'Vertical image position', 'storezz-elements' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%'],
            'range' => [
              '%' => [
                'min' => 0,
                'max' => 100,
                'step' => 1,
              ],
            ],
            'default' => [
              'unit' => '%',
              'size' => 50,
            ],
            'selectors' => [
              '{{WRAPPER}} .se-product-cat3 div' => 'background-position-y: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'after',
          ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'cat_4_section', [
            'label' => __('Category 4', 'storezz-elements'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'product_category4', [
            'label' => __('Category 4', 'storezz-elements'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 0,
            'options' => Storezz_elements_get_woo_categories_list(),
                ]
        );

        $this->add_control(
          'img_x_position_cat4',
          [
            'label' => __( 'Horizontal image position', 'storezz-elements' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%'],
            'range' => [
              '%' => [
                'min' => 0,
                'max' => 100,
                'step' => 1,
              ],
            ],
            'default' => [
              'unit' => '%',
              'size' => 50,
            ],
            'selectors' => [
              '{{WRAPPER}} .se-product-cat4 div' => 'background-position-x: {{SIZE}}{{UNIT}};',
            ],
          ]
        );

        $this->add_control(
          'img_y_position_cat4',
          [
            'label' => __( 'Vertical image position', 'storezz-elements' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%'],
            'range' => [
              '%' => [
                'min' => 0,
                'max' => 100,
                'step' => 1,
              ],
            ],
            'default' => [
              'unit' => '%',
              'size' => 50,
            ],
            'selectors' => [
              '{{WRAPPER}} .se-product-cat4 div' => 'background-position-y: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'after',
          ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'cat_5_section', [
            'label' => __('Category 5', 'storezz-elements'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            'condition' => [ 'layout_type' => ['block1', 'block2'] ]
                ]
        );

        $this->add_control(
            'product_category5', [
            'label' => __('Category 5', 'storezz-elements'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 0,
            'options' => Storezz_elements_get_woo_categories_list(),
                ]
        );

        $this->add_control(
          'img_x_position_cat5',
          [
            'label' => __( 'Horizontal image position', 'storezz-elements' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%'],
            'range' => [
              '%' => [
                'min' => 0,
                'max' => 100,
                'step' => 1,
              ],
            ],
            'default' => [
              'unit' => '%',
              'size' => 50,
            ],
            'selectors' => [
              '{{WRAPPER}} .se-product-cat5 div' => 'background-position-x: {{SIZE}}{{UNIT}};',
            ],
          ]
        );

        $this->add_control(
          'img_y_position_cat5',
          [
            'label' => __( 'Vertical image position', 'storezz-elements' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%'],
            'range' => [
              '%' => [
                'min' => 0,
                'max' => 100,
                'step' => 1,
              ],
            ],
            'default' => [
              'unit' => '%',
              'size' => 50,
            ],
            'selectors' => [
              '{{WRAPPER}} .se-product-cat5 div' => 'background-position-y: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'after',
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
                '{{WRAPPER}} .storezz-product-category-block2 .cat-btn:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'cat_text_style', [
            'label' => __('Category Text', 'storezz-elements'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'cat_text_color', [
            'label' => __('Text Color', 'storezz-elements'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'scheme' => [
                'type' => \Elementor\Scheme_Color::get_type(),
                'value' => \Elementor\Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .storezz-product-category-block2 .cat-btn .ct-name' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'cat_text_typography',
            'label' => __('Typography', 'storezz-elements'),
            'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .storezz-product-category-block2 .cat-btn .ct-name',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'product_count_style', [
            'label' => __('Product Count', 'storezz-elements'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
            'product_count_color', [
            'label' => __('Color', 'storezz-elements'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'scheme' => [
                'type' => \Elementor\Scheme_Color::get_type(),
                'value' => \Elementor\Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .storezz-product-category-block2 .cat-btn .ct-pcount' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'product_count_typography',
            'label' => __('Typography', 'storezz-elements'),
            'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .storezz-product-category-block2 .cat-btn .ct-pcount',
                ]
        );

        $this->add_control(
                'product_count_margin', [
            'label' => __('Margin', 'storezz-elements'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'allowed_dimensions' => 'vertical',
            'selectors' => [
                '{{WRAPPER}} .storezz-product-category-block2 .cat-btn .ct-pcount' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $layout_type =  $settings['layout_type'];
        $category1 = $settings['product_category1'] ? get_term($settings['product_category1']) : 0;
        $category2 = $settings['product_category2'] ? get_term($settings['product_category2']) : 0;
        $category3 = $settings['product_category3'] ? get_term($settings['product_category3']) : 0;
        $category4 = $settings['product_category4'] ? get_term($settings['product_category4']) : 0;
        $category5 = $settings['product_category5'] ? get_term($settings['product_category5']) : 0;
        ?>

        <?php
        switch ( $layout_type ) {
          case 'block1':
          $category_image_1 = 'storezz-large-square';
          $category_image_2 = $category_image_3 = $category_image_4 = $category_image_5  = 'storezz-medium-square';
          break;
          case 'block2':
          $category_image_5 = 'storezz-large-square';
          $category_image_2 = $category_image_3 = $category_image_4 = $category_image_1  = 'storezz-medium-square';
          break;
          case 'block3':
          $category_image_1 = 'storezz-large-square';
          $category_image_2 = 'storezz-large-double-horizontal';
          $category_image_3 = $category_image_4  = 'storezz-medium-square';
          break;
          case 'block4':
          $category_image_1 = 'storezz-large-square';
          $category_image_4 = 'storezz-large-double-horizontal';
          $category_image_2 = $category_image_3  = 'storezz-medium-square';
          break;
        } ?>
        <div class="se-category-block se-category-<?php echo $layout_type?>" id="storezz-product-category-block2-<?php echo esc_attr($this->get_id()); ?>" >
            <?php if ($category1) : ?>
                <div class="se-product-cat se-product-cat1">
                    <?php $this->get_product_category_content($category1, $category_image_1 ); ?>
                </div>
            <?php endif; ?>
            <?php if ($category2) : ?>
                <div class="se-product-cat se-product-cat2">
                    <?php $this->get_product_category_content($category2, $category_image_2); ?>
                </div>
            <?php endif; ?>

            <?php if ($category3) : ?>
                <div class="se-product-cat se-product-cat3">
                    <?php $this->get_product_category_content($category3, $category_image_3); ?>
                </div>
            <?php endif; ?>

            <?php if ($category4) : ?>
                <div class="se-product-cat se-product-cat4">
                    <?php $this->get_product_category_content($category4, $category_image_4); ?>
                </div>
            <?php endif; ?>

            <?php if ($category5) : ?>
                <div class="se-product-cat se-product-cat5">
                    <?php $this->get_product_category_content($category5, $category_image_5); ?>
                </div>
            <?php endif; ?>

        </div>
        <?php
    }

    /** Procut Category Content */
    protected function get_product_category_content($category, $image_size) {
        $settings = $this->get_settings_for_display();
        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
        $image = wp_get_attachment_image_src($thumbnail_id, $image_size);
        ?>
        <div style="background-image: url(<?php echo esc_url($image[0]); ?>); "></div>
        <a href="<?php echo esc_url(get_term_link($category)); ?>" class="cat-btn">
            <span class="ct-name" ><?php echo esc_html($category->name); ?></span>
            <span class="ct-pcount"><?php echo esc_html($category->count); ?> <?php echo esc_html__('Products Inside', 'storezz-elements'); ?></span>
        </a>
        <?php
    }

}
