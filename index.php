<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dyad
 */

get_header(); ?>

	<main id="primary" class="content-area" role="main">
		<div class="header-posts">
			<span class="banner">Liveloop</span>
			<p><?php dynamic_sidebar( 'site-description' ); ?></p>
		</div>
		<?php if ( have_posts() ) : ?>
			<div id="posts" class="posts">
				<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'blocks' );
					?>
							<?php endwhile; ?>
			</div>
			<!-- .posts -->
			<?php else : ?>
				<div id="posts" class="posts">
					<?php get_template_part( 'template-parts/content', 'none' ); ?>
				</div>
				<?php endif; ?>
				<?php if ( have_posts() ) : ?>
					<div id="agenda" class="posts posts-agenda">
						<div class="header-posts">
							<span class="banner">Nos prochains concerts</span>
							<?php $count_posts = wp_count_posts('agenda'); ?>
								<p><?php dynamic_sidebar( 'agenda-description' ); ?> </p>
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
								<div class=" a link-more"><a class="btn_review" href="<?php echo site_url('/agenda'); ?>">Agenda</a></div>
						</div>

						<?php
						$today = date('Ymd');
$args = array(
    'post_type' => 'agenda',
    'posts_per_page' => '6',
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

						$loop = new WP_Query($args);
							while ( $loop->have_posts() ) : $loop->the_post();
									get_template_part( 'template-parts/content', 'agenda' );
							endwhile;?>
						</div>
					 	<?php else : ?>
							<div class="posts">
								<?php get_template_part( 'template-parts/content', 'none' ); ?>
							</div>
				<?php endif; ?>
<!--
					<div class="more-agenda">
						<span>
						<button href="<?php echo esc_url( home_url( '/agenda' ) ); ?>">Concerts et festivals précédents</button>
					</span>
					</div>
-->
	</main>
	<!-- #main -->
	<?php get_footer(); ?>
