<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package _s
 */

get_header(); ?>

	<div class="wrap">
		<div class="primary column column-two-thirds content-area">
			<main id="main" class="site-main" role="main">

				<section class="error-404 row not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', '_s' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', '_s' ); ?></p>

						<?php get_search_form(); ?>

						<div class="widget column column-one-third widget_recent_posts">
							<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
						</div><!-- .widget -->


						<div class="widget column column-one-third widget_categories">
							<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', '_s' ); ?></h2>
							<ul>
							<?php
								wp_list_categories( array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								) );
							?>
							</ul>
						</div><!-- .widget -->

						<div class="widget column column-one-third">
							<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
						</div><!-- .widget -->

					</div><!-- .page-content -->
				</section><!-- .error-404 -->

			</main><!-- #main -->
		</div><!-- .primary -->
	</div><!-- .wrap -->

<?php
get_footer();