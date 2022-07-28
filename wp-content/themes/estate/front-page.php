<?php
/**
 * The front-page template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>

	<div class="container">
        <h2 class="align-content-end mt-4">Города</h2>
		<div class="row">
			<div class="container mt-4">
				<?php
				$cities = get_posts( array(
					'numberposts'      => - 1,
					'orderby'          => 'date',
					'order'            => 'DESC',
					'post_type'        => 'cities',
					'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
				) );
				if ( $cities ) {
					?>
					<ul class="list-group">
						<?php
						foreach ( $cities as $post ) {
							setup_postdata( $post ); ?>
							<li class="list-group-item">

								<?php get_template_part( 'loop-templates/content', 'cities-home' ); ?>
							</li>

						<?php }
						wp_reset_postdata(); ?>
					</ul>
				<?php } ?>
			</div>

		</div>
	</div>
	<div class="container">
        <h2 class="align-content-end mt-4">Объекты недвижемости</h2>
		<div class="row">
			<div class="container mt-4">
				<?php
				$buildings = get_posts( array(
					'numberposts'      => - 1,
					'orderby'          => 'date',
					'order'            => 'DESC',
					'post_type'        => 'buildings',
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

		</div>
	</div>

<?php
get_footer();
