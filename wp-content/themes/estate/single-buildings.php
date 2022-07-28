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


                <main class="site-main mb-4" id="main">

					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'loop-templates/content', 'buildings' );
						understrap_post_nav();
						?>
						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}

					}
					?>

                </main><!-- #main -->
                <div class="container"><?php echo do_shortcode( '[estate_form]' ); ?></div>
                <!-- Do the right sidebar check -->


            </div><!-- .row -->

        </div><!-- #content -->

    </div><!-- #single-wrapper -->

<?php
get_footer();
