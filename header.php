<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Dyad
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.counterup/1.0/jquery.counterup.min.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-72062536-1', 'auto');
  ga('send', 'pageview');

</script>
    <script>
        jQuery(document).ready(function ($) {
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });
        });
    </script>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_PI/sdk.js#xfbml=1&version=v2.5&appId=1506494756332119";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'dyad' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'dyad' ); ?></button>
			<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id' => 'primary-menu',
				'container' => 'div',
				'container_class' => 'primary-menu',
			) ); ?>
		</nav>
		<div class="site-branding">
			<?php
			if ( function_exists( 'jetpack_the_site_logo' ) ) {
				jetpack_the_site_logo();
			}
			?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div><!-- .site-branding -->
		<nav class="main-navigation menu-social">
		    <ul class="menu nav-menu">
		        <li class="menu-item"><a href="http://www.facebook.com/liveloopparis"><img src="http://liveloop.fr/wp-content/themes/dyad_child/img/facebook.svg" alt=""></a></li>
		        <li class="menu-item"><a href="http://www.twitter.com/liveloop_"><img src="http://liveloop.fr/wp-content/themes/dyad_child/img/twitter.svg" alt=""></a></li>
		        <li class="menu-item"><a href="http://www.instagram.com/liveloop_"><img src="http://liveloop.fr/wp-content/themes/dyad_child/img/instagram.svg" alt=""></a></li>
		    </ul>
		</nav>

	</header><!-- #masthead -->

	<div class="site-inner">

		<?php if ( is_home() || is_front_page() || ( is_single() && 'image' == get_post_format() ) ) : ?>
			<div class="featured-content">
				<?php get_template_part( 'template-parts/loop', 'banner' ); ?>
			</div>
		<?php endif; ?>

		<div id="content" class="site-content">
