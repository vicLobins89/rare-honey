<?php
/*
 Template Name: Scrolling Page
*/
?>
<?php get_header('scrolling_page'); ?>

<div id="content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

        <section class="cf" itemprop="articleBody">
            <?php
                the_content();
            ?>
        </section> <?php // end article section ?>

    </article>

    <?php endwhile; endif; ?>

</div>

<?php get_footer('scrolling_page'); ?>