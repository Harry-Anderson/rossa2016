<?php
/**
 * Template Name: Front Page
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	<div class="front-page-wrapper">
		<div class="showcase-wrapper">
			<?php if ( get_header_image() ) : ?>
			<a href="#primary" class="showcase-item showcase-book-header">
				<h1>The Scenic Route: A Way through Madness</h1>
				<h2>New Book Out Now</h2>
			</a>
			<?php endif; // End header image check. ?>

			<a href="./book/" class="showcase-item showcase-book">
				<h1>Upcoming Book: The Scenic Route</h1>
				<h2>A Way through Madness</h2>
				<span class="icon"></span>
			</a>

			<a href="https://www.psychologytoday.com/blog/rethinking-mental-health/201612/way-through-madness" target="_blank" class="showcase-item showcase-interview">
				<h1>Interview</h1>
				<h2>Psychology Today: A Way Through Madness</h2>
				<span class="icon"></span>
			</a>

			<?php
				$args = array( 'numberposts' => '1' );
				$recent_posts = wp_get_recent_posts( $args );
				foreach( $recent_posts as $recent ) {
					echo '<a href="' . get_permalink($recent["ID"]) . '" class="showcase-item showcase-blog">
						  <h1>Latest Blog Post</h1>
						  <h2>' .   $recent["post_title"].'</h2>
						  <span class="icon"></span>
						  </a>';
				}
				wp_reset_query();
			?>
		</div>

		<div id="primary" class="content-area">
			<main id="main" class="site-main content-block image-is-left" role="main">

			<?php if ( have_posts() ) : ?>

				<?php if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
				<?php endif; ?>

				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				// End the loop.
				endwhile;

				// Previous/next page navigation.
				the_posts_pagination( array(
					'prev_text'          => __( 'Previous page', 'twentysixteen' ),
					'next_text'          => __( 'Next page', 'twentysixteen' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
				) );

			// If no content, include the "No posts found" template.
			else :
				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

			</main><!-- .site-main -->

			<?php 
				$additionalHeader = get_field('additional_header');
				$additionalText = get_field('additional_text');
				$additionalImage = get_field('additional_image');

				if( !empty($additionalHeader) || !empty($additionalText) || !empty($additionalImage) ): ?>

				<div class="content-block image-is-right">
					<?php
						if( !empty($additionalHeader) ): ?>

						<header class="entry-header">
							<h2 class="entry-title"><?php echo $additionalHeader; ?></h2>
						</header>
					<?php endif; ?>

					<?php
						if( !empty($additionalText) ): ?>

						<div class="entry-content">
							<p><?php the_field('additional_text'); ?></p>
						</div>
					<?php endif; ?>

					<?php
						if( !empty($additionalImage) ): ?>

						<div class="post-thumbnail">
							<img src="<?php echo $additionalImage['url']; ?>" alt="<?php echo $additionalImage['alt']; ?>" />
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div><!-- .content-area -->
		
		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>
