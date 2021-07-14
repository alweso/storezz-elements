<div class="description">
  <div class="description-inner">
    <?php if($show_cat_small) { ?>
      <div class="category">

      </div>
    <?php }  ?>
    <h4 class="news-title">
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
      <?php if (has_post_format('video')) { ?>
                <i class="fa fa-video"></i>
      <?php  } elseif (has_post_format('gallery')) { ?>
        <i class="fa fa-images"></i>
      <?php  } ?>
      <?php esc_html_e(wp_trim_words(get_the_title(), $crop_small),'storezz-elements'); ?>
    </a>
    </h4>
    <?php if(isset($show_exerpt_small) && $show_exerpt_small == "yes") {?>
      <p><?php esc_html_e( wp_trim_words(get_the_excerpt(),$post_content_crop_small,'...'), 'storezz-elements' );?></p>
    <?php } ?>
    <span class="comments-views-date">
      <?php if( $show_comments_small ) { ?>
        <span class="comments">
          <i class="fa fa-comment"></i><?php esc_html_e( get_comments_number(), 'storezz-elements' ); ?>
        </span>
      <?php }  ?>
      <?php if($show_author_small == "yes") {?>
        <span class="author">
          <i class="fa fa-user-edit"></i><a href="<?php esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ), 'storezz-elements' ); ?>"><?php the_author(); ?></a>
        </span>
      <?php } ?>
      <?php if($show_date_small) { ?>
        <span class="date">
          <i class="fa fa-calendar"></i><?php  esc_html_e( get_the_date('Y-m-d'), 'storezz-elements' ); ?>
        </span>
      <?php }  ?>
    </span>
  </div>
</div>
