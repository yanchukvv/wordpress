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
            <ul class="list-group">
                <li class="list-group-item"><b>Стоимость:</b> <?php the_field( 'stoimost' ); ?></li>
                <li class="list-group-item"><b>Адрес:</b> <?php the_field( 'adres' ); ?></li>
                <li class="list-group-item"><b>Жилая площадь:</b> <?php the_field( 'zhilaya_ploshhad' ); ?></li>
                <li class="list-group-item"><b>Этаж:</b> <?php the_field( 'etazh' ); ?></li>
            </ul>
        </div><!-- .entry-content -->
    </div>
    <div class="container mt-4">
        <h3>Описание объекта</h3>
        <div class="row">
				<?php
				the_content();
				understrap_link_pages();
				?>
        </div>
    </div>

    <footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
