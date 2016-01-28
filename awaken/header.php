<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Awaken
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'awaken' ); ?></a>
	<header id="masthead" class="site-header" role="banner">
		<div class="top-nav">
			<div class="container">
		<div class="row">
			<?php is_rtl() ? $rtl = 'awaken-rtl' : $rtl = ''; ?>
			<div class="col-xs-12 col-sm-6 col-md-8 <?php echo $rtl; ?>">
				<nav id="top-navigation" class="top-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'top_navigation' ) ); ?>
				</nav><!-- #site-navigation -->	
				<a href="#" class="navbutton" id="top-nav-button"><?php _e( 'Top Menu', 'awaken' ); ?></a>
				<div class="responsive-topnav"></div>			
			</div><!-- col-xs-12 col-sm-6 col-md-8 -->
			<div class="col-xs-12 col-sm-6 col-md-4">
				<?php awaken_socialmedia(); ?>
			</div><!-- col-xs-12 col-sm-6 col-md-4 -->
		</div><!-- row -->
	</div>
</div>

	<div class="site-branding">
		<div class="container">
			<div class="site-brand-container">
				<?php  
					global $awaken_options;
					$logo = $awaken_options['logo-uploader']['url'];
					$title_option = $awaken_options['site-title-option'];

					if ( $title_option == 'logo-only' && isset($logo) ) { ?>
						<div class="site-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logo ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
						</div>
					<?php } 

					if ( $title_option == 'text-logo' && isset($logo) ) { ?>
						<div class="site-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logo ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
						</div>
						<div class="site-title-text">
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
						</div>
					<?php } 

					if ( !isset($title_option) || $title_option == 'text-only' ) { ?>
						<div class="site-title-text">
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
						</div>
				<?php } ?>
			</div><!-- .site-brand-container -->
		</div>
	</div>

	<div class="container">
		<div class="awaken-navigation-container">
			<nav id="site-navigation" class="main-navigation cl-effect-10" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'main_navigation' ) ); ?>
			</nav><!-- #site-navigation -->
			<a href="#" class="navbutton" id="main-nav-button"><?php _e( 'Main Menu', 'awaken' ); ?></a>
			<div class="responsive-mainnav"></div>

			<div class="awaken-search-button-icon"></div>
			<div class="awaken-search-box-container">
				<div class="awaken-search-box">
					<form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="awaken-search-form" method="get">
						<input type="text" value="" name="s" id="s" />
						<input type="submit" value="<?php esc_attr_e( 'Search', 'awaken' ); ?>" />
					</form>
				</div><!-- th-search-box -->
			</div><!-- .th-search-box-container -->
		</div><!-- .awaken-navigation-container-->
	</div><!-- .container -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="container">

	<?php 
		if ( is_front_page() ) {
			if ( $awaken_options['home-slider-activate'] == '1' ) {
				awaken_featured_posts(); 
			}
		}
	?>