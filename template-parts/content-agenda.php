<?php
/**
 *  * Template part for displaying posts agenda.
 *   *
 *    * @package Dyad
 *     */
?>


	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'dyad-thumbnails' ); ?>
						<div class="entry-media" <?php if (has_post_thumbnail()) { echo 'style="background-image: url(' . esc_url( $thumb[ '0'] ) . ')"'; } ?>>
				<?php
				$tickets = get_field( "tickets" );
				$status = get_field( "status" );
				$post_review = get_field("review");
				$venue = get_field( "venue" );
				$festival_venue = get_field("festival_venue");
				$concert_type = get_field("concert_type");
				$preview_url = get_field("soundcloud");
				$date = get_field('date',false,false);

				$today = date('Ymd'); ?>


				<?php if ($date < $today) {
							if ($post_review) { ?>
							<div class=" a link-more"><a class="btn_review" href="<?php echo $post_review ?>">Review</a></div>
							<?php };?>
				<?php } else { ;?>
						<?php if ($status && in_array('SoldOut', $status)) { ?>
							<div class="link-more"><a class="disabled" disabled>Sold Out</a></div>
						<?php  }  else if ($tickets) { ;?>
							<div class="link-more"><a href="<?php echo $tickets ?>"> Billets</a></div>
						<?php };?>
				<?php } ;?>
			</div>

			<div class="entry-inner">
				<div class="entry-inner-content">
					<header class="entry-header">
						<h2 class="entry-title">
<!--						<a href="<?php echo get_site_url(); ?>/tag/<?php the_title();?>">-->
						<?php the_title();?><?php if (get_field('sound')) : ?><span class=" toggle-video genericon genericon-audio"></span><?php endif;?>
<!--						</a>-->
						</h2>
					</header>
					<!-- .entry-header -->

					<div class="entry-content">
						<?php $date = new DateTime($date);?>
						<?php if (get_field("opening_act")) : ;?>
						<p>+ <?php echo get_field("opening_act");?> </p>
						<?php endif ;?>
							<p class="concert-date"><?php echo $date->format('j M Y'); ?></p>
							<p class="concert-venue"><?php echo $venue; ?></p>
							<?php
						//if ($concert_type == 'festival') : ?>
							<p class="concert-venue"><?php echo $festival_venue ; ?></p>
							<?php //endif ;?>

<!--
							<?php
						//$album_url = "https://soundcloud.com/bornsmusic/borns-american-money-preview";
						$params = ' params="color=00aabb&auto_play=false&hide_related=false&show_comments=false&show_user=true&show_reposts=false" width="100%" height="100" iframe="true"';
						if ($preview_url)
						echo do_shortcode('[soundcloud'.$params.']'.$preview_url.'[/soundcloud]'); ?>
-->
					</div>
					<!-- .entry-content -->
				</div>
				<!-- .entry-inner-content -->

			</div>
			<!-- .entry-inner -->
			<?php if (get_field('video')) : ?>
				<div class="embed-container" style="display:none;">
					<span class="toggle-video genericon genericon-close"></span>
						<?php the_field('video'); ?>
				</div>
							<?php endif;?>
	</article>
	<!-- #post-## -->
