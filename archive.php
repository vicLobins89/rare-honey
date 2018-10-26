<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<div id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
							
<!--
							<header class="entry-header article-header">
								<?php //the_archive_title( '<h3 class="archive-title">', '</h3>'); ?>
								<?php //the_archive_description( '<p>', '</p>' ); ?>
							</header>
-->
							
							<div class="vc_row grey-panel">
								<?php the_archive_title( '<h1 class="archive-title">', '</h1>'); ?>
							</div>
							
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf vc_col-sm-4 news-post' ); ?> role="article">

								<section class="entry-content cf">
									
									<?php the_post_thumbnail( 'full' ); ?>
								
									<div class="project-details">
										<a href="<?php the_permalink() ?>" class="clickthrough" title="<?php the_title(); ?>"></a>
										<div class="project-inner">
											<h3 class="h3"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
											<?php //the_excerpt(); ?>
											<?php printf( __( '<div class="cats">', 'bonestheme' ).'%1$s', get_the_category_list(', ') ); ?>
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
												<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
