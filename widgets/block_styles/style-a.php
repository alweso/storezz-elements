<?php if($show_title) { ?>
  <h2 class="menheer-block-title" <?php esc_html__( $this->get_render_attribute_string( 'title' )); ?>><?php esc_html__( $settings['title'] ); ?></h2>
<?php }  ?>
<div class="big-wrapper <?php echo $cssClass; ?>">
  <?php $i = 0; ?>
  <?php while ($queryd->have_posts()) : $queryd->the_post();
  if ( $i == 0 ) : ?>
  <div class="wrapper wrapper--big">
    <?php $category_display = $big_category_display ?>
    <?php include (STOREZZ_ELEMENTS_PATH . 'widgets/content/content-3.php'); ?>
  </div>
<?php endif;
if ( $i > 0 ) : ?>
<div class="wrapper wrapper--small">
  <?php $category_display = $small_category_display ?>
  <?php include (STOREZZ_ELEMENTS_PATH . 'widgets/content/content-2.php'); ?>
</div>
<?php endif; ?>
<?php $i++; ?>
<?php endwhile; ?>
</div>
