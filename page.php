<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<div id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<!--<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php //the_title(); ?></h1>

								</header>--> <?php // end article header ?>

								<section class="cf" itemprop="articleBody">
									<?php
										the_content();
									?>
								</section> <?php // end article section ?>

								<?php // comments_template(); ?>

							</article>

							<?php endwhile; endif; ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
