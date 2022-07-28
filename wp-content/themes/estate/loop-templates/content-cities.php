<?php
/**
 * Single buidings partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'container' ); ?> id="post-<?php the_ID(); ?>">
    <header class="entry-header">

		<?php the_title( '<h1 class="entry-title h2">', '</h1>' ); ?>

    </header><!-- .entry-header -->
    <div class="row mt-4">
        <div class="col-sm text-center">
			<?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'img-fluid' ) ); ?>
        </div>
        <div class="entry-content col-sm">

            <h3>Описание города</h3>
			<?php
			the_content();
			?>
        </div><!-- .entry-content -->
    </div>
    <div class="container mt-4">
		<?php
		$buildings = get_posts( array(
			'numberposts'      => - 1,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'buildings',
			'meta_query'       => [
				[
					'key'   => '_gorod',
					'value' => $post->ID,
				]
			],
			'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
		) );
		if ( $buildings ) {
			?>
            <ul class="list-group">
				<?php
				foreach ( $buildings as $post ) {
					setup_postdata( $post ); ?>
                    <li class="list-group-item">

						<?php get_template_part( 'loop-templates/content', 'buildings-city' ); ?>
                    </li>

				<?php }
				wp_reset_postdata(); ?>
            </ul>
		<?php } ?>
    </div>

    <footer class="entry-footer">

		<?php

		understrap_post_nav(); ?>

    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
