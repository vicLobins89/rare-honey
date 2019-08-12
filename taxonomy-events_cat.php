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
								
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf upcoming' ); ?> role="article">
										
										<section>
											
											<div class="vc_row wpb_row body_copy">
												<div class="vc_col-sm-8">
													<div class="wpb_text_column">
														<h1><?php single_cat_title(  ); ?></h1><br>
														<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
														<div style="font-size: .7rem;"><?php the_excerpt(); ?></div>
														<a href="<?php the_permalink() ?>"><strong>Click here to read more</strong></a>
													</div>
												</div>
											</div>

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

							if ( $query2->have_posts() ) : $postCount = 0; ?>
							
							<div class="vc_row wpb_row body_copy">
								<div class="vc_col-sm-8">
									<div class="wpb_text_column">
										<h1>Past Events</h1>
									</div>
								</div>
							</div>
							
							<?php while ( $query2->have_posts() ) : $query2->the_post(); $postCount ++; ?>
								
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf vc_col-sm-4 news-post' ); ?> role="article">

										<section class="entry-content cf">

											<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
												<?php the_post_thumbnail( 'post-thumb' ); ?>
											</a>

											<div class="project-details">
												<a href="<?php the_permalink() ?>" class="clickthrough" title="<?php the_title(); ?>"></a>
												<div class="project-inner">
													<h3 class="h3">
														<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
													</h3>
													<?php //the_excerpt(); ?>
													<?php //echo get_the_term_list( $post->ID, 'events_cat', '<div class="cats">', ', ', '</div>' ); ?>
												</div>
											</div>

										</section>

									</article>
									
							<?php endwhile; ?>
								
								<div class="cf"></div>
								<?php if ($postcount > 9) { bones_page_navi(); } ?>
								
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
