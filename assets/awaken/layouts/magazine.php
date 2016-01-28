<?php
/**
 * Template Name: Magazine Template
 *
 * Displays the Business Template of the theme.
 *
 * @package awaken
 */

get_header(); ?>
	
	
	<div class="amt-area">
	<?php 
		if( is_active_sidebar( 'magazine-1' ) ) {
			// Calling the business page left section sidebar if it exists.
			if ( !dynamic_sidebar( 'magazine-1' ) ):

			endif;
		} 
	?>
	</div><!-- .amt-area -->		
	<div class="row">
		<?php is_rtl() ? $rtl = 'awaken-rtl' : $rtl = ''; ?>
		<div class="col-xs-12 col-sm-12 col-md-8 <?php echo $rtl ?>">
			<?php 
				if( is_active_sidebar( 'magazine-2' ) ) {
					// Calling the business page left section sidebar if it exists.
					if ( !dynamic_sidebar( 'magazine-2' ) ):
						
					endif;
				} 
			?>			
		</div><!-- .bootstrap-cols -->

		<div class="col-xs-12 col-sm-6 col-md-4">
			<?php get_sidebar(); ?>
		</div><!-- .bootstrap-cols -->		
	</div><!-- .row -->
<?php get_footer(); ?>