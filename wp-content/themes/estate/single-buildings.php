<?php
/**
 * The template for displaying all single-buidings posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
acf_form_head();
get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

	<div class="wrapper" id="single-wrapper">

		<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

			<div class="row">

				<!-- Do the left sidebar check -->
				<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

				<main class="site-main" id="main">

					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'loop-templates/content', 'single' );
						understrap_post_nav();
						?>
						<p>Площадь: <?php the_field('ploshhad'); ?></p>
						<p>Стоимость: <?php the_field('stoimost'); ?></p>
						<p>Адрес: <?php the_field('adres'); ?></p>
						<p>Жилая площадь: <?php the_field('zhilaya_ploshhad'); ?></p>
						<p>Этаж: <?php the_field('etazh'); ?></p>
						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
						echo do_shortcode('[estate_form]');
					}
					?>

				</main><!-- #main -->

				<!-- Do the right sidebar check -->
				<?php // get_template_part( 'global-templates/right-sidebar-check' ); ?>

			</div><!-- .row -->

		</div><!-- #content -->

	</div><!-- #single-wrapper -->

<?php
get_footer();
