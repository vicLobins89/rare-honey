<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<article id="post-not-found" class="hentry cf">

							<header class="article-header">
								
								<?php echo '<img src="' . get_stylesheet_directory_uri() . '/library/images/404.png" alt="Error 404" class="image404" />' ; ?>
								<h1><?php _e( "<b>Ooops there doesn't seem to <i>bee</i> any honey here</b>", 'bonestheme' ); ?></h1>
								<?php _e( '<a href="'.home_url().'" class="home-btn">Try our Home Page</a>', 'bonestheme' ); ?>
								<div class="search-box"><?php get_search_form(); ?></div>

							</header>

						</article>

					</main>

				</div>

			</div>

<?php get_footer(); ?>
