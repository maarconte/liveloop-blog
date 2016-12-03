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

		<div class="posts posts-agenda">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						echo '<h1 class="page-title">Agenda</h1>' ;
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header>
				<!-- .page-header -->
				<div class="posts posts-agenda next-concerts">
				<div class="header-posts">
					<span class="banner">Nos prochains concerts</span>
					<p><?php dynamic_sidebar( 'agenda-description' ); ?> </p>
				</div>


					<?php	$today = date('Ymd');
							$args = array(
    								'post_type' => 'agenda',
    								'meta_key' => 'date',
    								'meta_query' =>
										array(
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
						<?php	get_template_part( 'template-parts/content', 'agenda' ); ?>
						<?php endwhile; ?>
				</div>

				<div class="posts posts-agenda previous-concerts">
					<div class="header-posts">
						<span class="banner">Concerts précédents</span>
						<?php $count_posts = wp_count_posts('agenda'); ?>
						<ul class="stats-agenda">
									<li class="stats-item">
									<span class="genericon genericon-day"></span>
									<p>Concerts vus : <span class="counter"><?php echo $count_posts->publish ; ?></span></p>
									</li>
									<li class="stats-item">
									<span class="genericon genericon-user"></span>
									<p>Artistes vus : <span class="counter"><?php get_artists(); ?></span></p>
									</li>
									<li class="stats-item">
									<span class="genericon genericon-star"></span>
									<p>Grosse groupie : <?php get_most_viewed_artist(); ?> (<span class="counter"><?php get_most_viewed_artist_count(); ?></span>)</p>
									</li>
								</ul>
					</div>


					<?php
							$args2 = array(
    								'post_type' => 'agenda',
    								'meta_key' => 'date',
									'posts_per_page' => 1000,
    								'meta_query' =>
										array(
											array(
            								'key' => 'date'
        									),
        									array(
            								'key' => 'date',
											'value' => $today,
            								'compare' => '<'
											)
    									),
    								'orderby' => 'meta_value_num',
    								'order' => 'DESC'
									);

						$loop2 = new WP_Query($args2);?>
						<?php while ($loop2->have_posts() ) : $loop2->the_post(); ?>
						<?php	get_template_part( 'template-parts/content', 'agenda' ); ?>
						<?php endwhile; ?>
				</div>
									<?php else : ?>
							<?php get_template_part( 'template-parts/content', 'none' ); ?>
					<?php endif; ?>
		</div>
		<!-- .posts -->
	</main>
	<!-- #main -->
	<?php get_footer(); ?>
