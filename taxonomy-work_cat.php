<?php
/*
 * CUSTOM POST TYPE TAXONOMY TEMPLATE
 *
 * This is the custom post type taxonomy template. If you edit the custom taxonomy name,
 * you've got to change the name of this template to reflect that name change.
 *
 * For Example, if your custom taxonomy is called "register_taxonomy('shoes')",
 * then your template name should be taxonomy-shoes.php
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates#Displaying_Custom_Taxonomies
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<div id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
														
							<div class="vc_row grey-panel">
								<h1 class="archive-title"><?php single_cat_title(); ?></h1>
							</div>
							
							<?php
							$cat_desc = category_description();
							if( $cat_desc != null ) : ?>
								<header class="entry-header article-header">
									<div class="work-desc-wrap">
										<?php
											echo '<div class="work-desc active">' . $cat_desc . '</div>';
										?>
									</div>
								</header>
							<?php endif; ?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf vc_col-sm-4 work-post' ); ?> role="article">

								<section class="entry-content cf">
									<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
										<?php the_post_thumbnail( 'post-thumb' ); ?>
									</a>
								
									<div class="project-details">
										<a href="<?php the_permalink() ?>" class="clickthrough" title="<?php the_title(); ?>"></a>
										<div class="project-inner">
											<h3 class="h3"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
											<?php the_excerpt(); ?>
											<?php echo get_the_term_list( $post->ID, 'work_cat', '<div class="cats">', ', ', '</div>' ); ?>
										</div>
									</div>

								</section>

							</article>

							<?php endwhile; ?>

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
												<p><?php _e( 'This is the error message in the taxonomy-custom_cat.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

						<?php // get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
