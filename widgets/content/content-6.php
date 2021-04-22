<?php if ( has_post_thumbnail() ) : ?>
<div class="thumbnail w-100 h-100">
  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="w-100 h-100 d-block" style="background:url('<?php the_post_thumbnail_url('large-horizontal') ?>');">
  </a>
  </div>
<?php endif; ?>
<?php include (MTSE_PLUGIN_PATH . 'widgets/content/description.php'); ?>
