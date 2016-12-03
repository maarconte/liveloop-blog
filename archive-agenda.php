<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dyad
 */

get_header(); ?>

	<main id="primary" class="content-area" role="main">

		<div id="posts" class="posts posts-agenda">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						echo '<h1 class="page-title">Agenda</h1>' ;
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->


				<?php /* Start the Loop */ ?>
				<?php
									$today = date('Ymd');
$args = array(
    'post_type' => 'agenda',
    'meta_key' => 'date',
    'meta_query' => array(
        array(
            'key' => 'date'
        ),
        array(
            'key' => 'date',
            'value' => $today,
            'compare' => '>='
        )
    ),
    'orderby' => 'meta_value_num',
    'order' => 'ASC'
);

						$loop = new WP_Query($args);?>
				<?php while ($loop->have_posts() ) : $loop->the_post(); ?>

					<?php

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						 get_template_part( 'template-parts/content', 'agenda' );
					?>

				<?php endwhile; ?>

				<?php the_posts_navigation(); ?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>

		</div><!-- .posts -->

	</main><!-- #main -->


<?php get_footer(); ?>
