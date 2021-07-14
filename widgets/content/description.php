<div class="description">
  <div class="description-inner">
    <?php if($show_cat) { ?>
      <div class="category">
        <?php
        $categories = get_the_category();
        foreach ( $categories as $category ) {
          if ($category_display == "background_color") {
            echo '<span class="category-background-color">'.$category->name.'</span>';
          } else {
            echo '<span class="category-color">'.$category->name.'</span>';
          }
        }
        ?>
      </div>
    <?php }  ?>
    <h4 class="news-title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
      <?php if (has_post_format('video')) { ?>
                <i class="fa fa-video"></i>
    <?php  } elseif (has_post_format('gallery')) { ?>
        <i class="fa fa-images"></i>
  <?php  } ?>
       <?php esc_html_e(wp_trim_words(get_the_title(), $crop,''), 'storezz-elements'); ?>
     </a>
    </h4>
    <?php if(isset($show_exerpt) && $show_exerpt == "yes") : ?>
      <p><?php esc_html_e( wp_trim_words(get_the_excerpt(),$post_content_crop,'...'), 'storezz-elements' );?></p>
    <?php endif ?>
    <?php if(isset($show_exerpt_2) && $show_exerpt_2 == "yes") : ?>
      <p><?php esc_html_e( wp_trim_words(get_the_excerpt(),$post_content_crop_2,'...'), 'storezz-elements' );?></p>
    <?php endif ?>
    <span class="comments-views-date">
      <?php if($show_comments) { ?>
        <span class="comments">
          <i class="fa fa-comment"></i><?php esc_html_e( get_comments_number(), 'storezz-elements' ); ?>
        </span>
      <?php }  ?>
      <?php if($show_date) { ?>
        <span class="date">
          <i class="fa fa-calendar"></i><?php esc_html_e( get_the_date('Y-m-d'), 'storezz-elements' ); ?>
        </span>
      <?php }  ?>
      <?php if($show_author == "yes") {?>
        <span class="author">
          <i class="fa fa-user-edit"></i><a href="<?php esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ), 'storezz-elements' ); ?>"><?php the_author(); ?></a>
        </span>
      <?php } ?>
    </span>
  </div>
</div>
