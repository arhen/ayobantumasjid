<?php


function awaken_socialmedia() {
global $awaken_options;

if ($awaken_options['social_media_switch'] == '1' ) : ?>

	<div class="asocial-area">
	<?php if ($awaken_options['facebook-url']) : ?>
		<span class="asocial-icon facebook"><a href="<?php echo esc_url ( $awaken_options['facebook-url'] ) ?>" target="_blank"><i class="fa fa-facebook"></i></a></span>
	<?php endif; ?>
	<?php if ($awaken_options['twitter-url']) : ?>
		<span class="asocial-icon twitter"><a href="<?php echo esc_url ( $awaken_options['twitter-url'] ) ?>" target="_blank"><i class="fa fa-twitter"></i></a></span>
	<?php endif; ?>
	<?php if ($awaken_options['googleplus-url']) : ?>
		<span class="asocial-icon googleplus"><a href="<?php echo esc_url ( $awaken_options['googleplus-url'] ) ?>" target="_blank"><i class="fa fa-google-plus"></i></a></span>
	<?php endif; ?>
	<?php if ($awaken_options['linkedin-url']) : ?>
		<span class="asocial-icon linkedin"><a href="<?php echo esc_url ( $awaken_options['linkedin-url'] ) ?>" target="_blank"><i class="fa fa-linkedin"></i></a></span>
	<?php endif; ?>
	<?php if ($awaken_options['youtube-url']) : ?>
		<span class="asocial-icon youtube"><a href="<?php echo esc_url ( $awaken_options['youtube-url'] ) ?>" target="_blank"><i class="fa fa-youtube"></i></a></span>
	<?php endif; ?>
	<?php if ($awaken_options['rss-url']) : ?>
		<span class="asocial-icon rss"><a href="<?php echo esc_url ( $awaken_options['rss-url'] ) ?>" target="_blank"><i class="fa fa-rss"></i></a></span>
	<?php endif; ?>
	<?php if ($awaken_options['instagram-url']) : ?>
		<span class="asocial-icon instagram"><a href="<?php echo esc_url ( $awaken_options['instagram-url'] ) ?>" target="_blank"><i class="fa fa-instagram"></i></a></span>
	<?php endif; ?>
	<?php if ($awaken_options['flickr-url']) : ?>
		<span class="asocial-icon flickr"><a href="<?php echo esc_url ( $awaken_options['flickr-url'] ) ?>" target="_blank"><i class="fa fa-flickr"></i></a></span>
	<?php endif; ?>
	</div>
	
<?php endif;

}