<?php
/**
 * Template Name: Events
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main class="wpe-list">

    <div class="wpe-head">
        <h1><?php _e('Events'); ?></h1>
    </div>

    <?php 

    $args = [
        'paged'             => $paged,
        'orderby'           => 'meta_value',
        'meta_key'          => 'wpe_date',
        'post_type'         => 'event',
        'order'             => 'asc',
        'posts_per_page'    => 0
    ];

    query_posts($args);

    ?>

    <?php if ( have_posts() ): ?>

    <div class="wpe-events">
    
        <?php while ( have_posts() ): ?>

        <?php

            the_post();

            // Get Post Meta
            $wpe_date = get_post_meta( get_the_ID(), 'wpe_date', true );
            $wpe_location = get_post_meta( get_the_ID(), 'wpe_location', true );
        ?>

        <article class="wpe-events-item" id="post-<?php the_ID(); ?>">
            <h5 class="entry-title heading-size-5">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h5>
            <div>
                <p>Date: <span><?php echo date('F d, Y', strtotime($wpe_date)); ?></span></p>
                <p>Location: <span><?php echo $wpe_location; ?></span></p>
                <p><a href="<?php the_permalink(); ?>">Read more</a></p>
            </div>
        </article>

        <?php endwhile; ?>
    
    </div>

    <?php endif; ?>

    <?php wp_reset_query(); ?>

</main>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
