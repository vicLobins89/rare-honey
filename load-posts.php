<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf vc_col-sm-4 news-post post' ); ?> role="article">

	<section class="entry-content cf">

		<?php the_post_thumbnail( array(640, 360) ); ?>

		<div class="project-details">
			<a href="<?php the_permalink() ?>" class="clickthrough" title="<?php the_title(); ?>"></a>
			<div class="project-inner">
				<h3 class="h3"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<?php //the_excerpt(); ?>
				<?php printf( __( '<div class="cats">', '</div>', 'bonestheme' ).'%1$s', get_the_category_list(', '), '%2$s' ); ?>
			</div>
		</div>

	</section>

</article>