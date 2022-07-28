<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'container' ); ?> id="post-<?php the_ID(); ?>">
	<div class="row mt-4">
		<div class="col-sm text-center">
			<?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'img-fluid' ) ); ?>
		</div>
		<div class="entry-content col-sm">
			<h5> <a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
			<?php the_content();?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
