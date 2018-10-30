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
						
						<div class="vc_row grey-panel">
							<h1 class="archive-title"><?php post_type_archive_title(); ?></h1>
						</div>
						
						<!--<div class="slider">
							<?php// echo do_shortcode('[metaslider id="7596"]'); ?>
						</div>-->
							
						<header class="entry-header article-header">
							<?php 
							/*if ( is_active_sidebar( 'work_desc' ) ) {
								dynamic_sidebar( 'work_desc' );
							} else { ?>
								<h3 class="archive-title"><?php post_type_archive_title(); ?></h3>
							<?php } */?>
							
							<div class="cat-nav">
								<div class="cat-position"></div>
								<p class="filter-txt">Filter by:</p>
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
								<a href="#" class="work-cat-button cat-active" data-cat="all">All</a>
							</div>
							
							<!--<div class="work-desc-wrap">
								<?php /*
									foreach( $terms as $term ) {
										if($term->description) {
											echo '<div class="work-desc work_cat-'.$term->slug.'">' . $term->description . '</div>';
										}
									}
								*/?>
							</div>-->
						</header>

						<?php
						$args = array(
							'nopaging'				=> true,
							'posts_per_page'		=> '-1',
							'post_type'				=> 'work_post'
						);
						$the_query = new WP_Query( $args );
						
						if ($the_query->have_posts()) : 
						echo '<div class="flex flex-wrap">';
						while ($the_query->have_posts()) : $the_query->the_post(); 
						?>
						
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf show vc_col-sm-4 work-post' ); ?> role="article" data-layout="<?php echo get_post_meta(get_the_ID(), 'new_project', true); ?>">

							<section class="entry-content cf">

								<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
									<?php the_post_thumbnail( 'post-thumb' ); ?>
								</a>
								
								<div class="project-details">
									<a href="<?php the_permalink() ?>" class="clickthrough" title="<?php the_title(); ?>"></a>
									<div class="project-inner">
										<?php the_excerpt(); ?>
										<p>
											<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
										</p>
										<?php // echo get_the_term_list( $post->ID, 'work_cat', '<div class="cats">', ', ', '</div>' ); ?>
									</div>
								</div>

							</section>

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
