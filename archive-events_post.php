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
							
						<header class="entry-header article-header">
							<h3 class="archive-title"><?php post_type_archive_title(); ?></h3>
						</header>

						<?php 
						if (have_posts()) : 
						echo '<div class="flex flex-wrap">';
						while (have_posts()) : the_post(); 
						?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf show vc_col-sm-6' ); ?> role="article">

							<section class="entry-content cf">

								<?php the_post_thumbnail( 'full' ); ?>
								
								<div class="project-details">
									<div class="project-inner">
										<h3 class="h3">
											<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
											<br>
											<time class="updated entry-time" datetime="<?php echo get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')); ?></time>
										</h3>
										<?php //the_excerpt(); ?>
										<?php //echo get_the_term_list( $post->ID, 'work_cat', '<div class="cats">', ', ', '</div>' ); ?>
									</div>
								</div>

							</section>

						</article>

						<?php endwhile; echo '</div>'; ?>

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
