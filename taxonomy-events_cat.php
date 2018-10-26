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
						
							<!--<header class="entry-header article-header">
								<div class="archive-description">
									<h3 class="archive-title h3"><?php single_cat_title(  ); ?></h3>
									<?php
									//$cat_desc = category_description();
									//if( $cat_desc != null ) echo $cat_desc;
									?>
								</div>
							</header>-->
							
							<div class="vc_row grey-panel">
								<h1 class="archive-title"><?php single_cat_title(  ); ?></h1>
							</div>
							
							<?php
							$catSlug = str_replace(' ', '-', strtolower(single_cat_title('', false)));
							
							// Upcoming Events
							$args = array(
								'post_type'			=> 'events_post',
								'posts_per_page'	=> 1,
								'tax_query'			=> array(
															'relation' => 'AND',
															array(
																'taxonomy'	=> 'events_cat',
																'field'		=> 'slug',
																'terms'		=> array( 'upcoming-buzz', 'upcoming-toast' ),
															),
															array(
																'taxonomy'	=> 'events_cat',
																'field'		=> 'slug',
																'terms'		=> $catSlug,
															),
														),
							);
							$query1 = new WP_Query( $args );

							if ( $query1->have_posts() ) : while ( $query1->have_posts() ) : $query1->the_post(); ?>
								
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf vc_col-sm-12 upcoming' ); ?> role="article">

										<section class="entry-content vc_col-sm-6 cf">

											<?php the_post_thumbnail( 'full' ); ?>

										</section>
										
										<section class="entry-content vc_col-sm-6 cf">

											<h3 class="h3"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
											<?php the_content(); ?>

										</section>

									</article>
									
									<div class="cf"></div>
									
									
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
							<?php endif; ?>

							<?php
							// Past Events
							$args2 = array(
								'post_type'			=> 'events_post',
								'posts_per_page'	=> 9,
								'tax_query'			=> array(
															'relation' => 'AND',
															array(
																'taxonomy'	=> 'events_cat',
																'field'		=> 'slug',
																'terms'		=> array( 'upcoming-buzz', 'upcoming-toast' ),
																'operator'	=> 'NOT IN',
															),
															array(
																'taxonomy'	=> 'events_cat',
																'field'		=> 'slug',
																'terms'		=> $catSlug,
															),
														),
							);
							$query2 = new WP_Query( $args2 );

							if ( $query2->have_posts() ) : ?>
							
							<div class="vc_row grey-panel grey-panel">
								<h1 class="archive-title">Past Events</h1>
							</div>
							
							<?php while ( $query2->have_posts() ) : $query2->the_post(); ?>
								
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf vc_col-sm-4 news-post' ); ?> role="article">

										<section class="entry-content cf">

											<?php the_post_thumbnail( array(640, 360) ); ?>

											<div class="project-details">
												<a href="<?php the_permalink() ?>" class="clickthrough" title="<?php the_title(); ?>"></a>
												<div class="project-inner">
													<h3 class="h3">
														<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
														<?php //echo '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>'; ?>
													</h3>
													<?php //the_excerpt(); ?>
													<?php //echo get_the_term_list( $post->ID, 'events_cat', '<div class="cats">', ', ', '</div>' ); ?>
												</div>
											</div>

										</section>

									</article>
									
							<?php endwhile; ?>
								
								<div class="cf"></div>
								<?php bones_page_navi(); ?>
								
							<?php wp_reset_postdata(); ?>
							<?php else : ?>
							
<!--
								<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php// _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php //_e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php //_e( 'This is the error message in the taxonomy-custom_cat.php template.', 'bonestheme' ); ?></p>
									</footer>
								</article>
-->
							
							<?php endif; ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
