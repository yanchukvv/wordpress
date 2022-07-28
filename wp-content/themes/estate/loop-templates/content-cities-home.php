<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'container' ); ?> id="post-<?php the_ID(); ?>">
	<div class="row">
		<div class="col-sm text-center">
			<?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'img-fluid' ) ); ?>
		</div>
		<div class="entry-content col-sm">
			<h5> <a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
			<?php echo  wp_trim_words( get_the_content(), 15, ' ...' ) ;?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
