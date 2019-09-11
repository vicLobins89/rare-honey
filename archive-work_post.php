<?php
/*
 * CUSTOM POST TYPE ARCHIVE TEMPLATE
 *
 * This is the custom post type archive template. If you edit the custom post type name,
 * you've got to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is called "register_post_type( 'bookmarks')",
 * then your template name should be archive-bookmarks.php
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

					<div id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						
						<div class="vc_row wpb_row body_copy">
							<div class="vc_col-sm-8">
								<div class="wpb_text_column">
									<h1><?php post_type_archive_title(); ?></h1>
									<?php echo do_shortcode('[do_widget id=text-6]'); ?>
								</div>
								
								<div class="cat-nav">
									<div class="cat-position"></div>
									<p class="filter-txt"><strong>Filter</strong></p>
									<a href="#" class="work-cat-button cat-active" data-cat="all">All</a>
									<?php
										$terms = get_terms( array(
											'taxonomy' => 'work_cat',
											'hide_empty' => false,
											'orderby' => 'name',
											'order' => 'ASC',
										) );
										foreach( $terms as $term ) {
											echo '<a href="#" class="work-cat-button" data-cat="work_cat-' . $term->slug . '">' . $term->name . '</a> ';
										}
									?>
								</div>
							</div>
						</div>

						<?php
						$args = array(
							'nopaging'				=> true,
							'posts_per_page'		=> '-1',
							'post_type'				=> 'work_post'
						);
						$the_query = new WP_Query( $args );
						
						if ($the_query->have_posts()) : 
						echo '<div class="flex flex-wrap grid-thumbs">';
						while ($the_query->have_posts()) : $the_query->the_post(); 
						?>
						
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf show vc_col-sm-4 work-post' ); ?> role="article" data-layout="<?php echo get_post_meta(get_the_ID(), 'new_project', true); ?>">

							<div class="entry-content wpb_wrapper cf">

								<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="thumb">
									<?php the_post_thumbnail( 'square' ); ?>
								</a>
								
								<div class="project-details wpb_text_column">
									<?php /* <a href="<?php the_permalink() ?>" class="clickthrough" title="<?php the_title(); ?>"></a> */ ?>
									<div class="project-inner">
										<h3>
											<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
										</h3>
										<?php the_excerpt(); ?>
										<p><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">Read case study</a></p>
									</div>
								</div>

							</div>

						</article>
						
						<?php endwhile; echo '</div>';?>
						
							<div class="cf"></div>
							<button class="load-more">Load More</button>

							<?php bones_page_navi(); ?>

						<?php else : ?>

								<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( '', 'bonestheme' ); ?></p>
									</footer>
								</article>

						<?php endif; ?>

					</div>

					<?php // get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
