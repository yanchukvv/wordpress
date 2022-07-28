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
            <ul class="list-unstyled">
                <li><b>Стоимость:</b> <?php the_field( 'stoimost' ); ?> ₽</li>
                <li><b>Адрес:</b> <?php the_field( 'adres' ); ?></li>
                <li><b>Жилая площадь:</b> <?php the_field( 'zhilaya_ploshhad' ); ?> м²</li>
                <li><b>Этаж:</b> <?php the_field( 'etazh' ); ?></li>
            </ul>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
