<?php if ( has_post_thumbnail() ) : ?>
  <div>
    <div class="thumbnail thumbnail--small">
      <?php echo '<span class="post-number">' . esc_html( $i + 1 ) . '</span>'; ?>
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="widget-image d-block">
        <?php the_post_thumbnail('medium-thumbnail', ['class' => 'img-fluid', 'title' => 'Feature image']); ?>
      </a>
    </div>
  </div>
<?php endif; ?>
<?php include (STOREZZ_ELEMENTS_PATH . 'widgets/content/description_with_number.php'); ?>
