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

<main id="site-content wpe-events">

    <header class="entry-header has-text-align-center header-footer-group">
        <div class="entry-header-inner section-inner medium">
            <h1 class="entry-title">Events</h1>
        </div>
    </header>

	<?php

    $args = [
        'paged'             => $paged,
        'orderby'           => 'meta_value',
        'meta_key'          => 'wpe_date',
        'post_type'         => 'event',
        'order'             => 'asc',
        'posts_per_page'    => 3
    ];

    query_posts($args);

	if ( have_posts() ) {

		while ( have_posts() ) {

			the_post();

            // Get Post Meta
            $wpe_date = get_post_meta( get_the_ID(), 'wpe_date', true );
            $wpe_location = get_post_meta( get_the_ID(), 'wpe_location', true );
            $wpe_url = get_post_meta( get_the_ID(), 'wpe_url', true );

            // Google Calendar
            $cal_title = urlencode(get_the_title());
            $cal_dates = date('Ymd', strtotime($wpe_date));
            $cal_datee = date('Ymd', strtotime($wpe_date)+86400);
            $cal_location = urlencode($wpe_location);
            $cal_url_href = urlencode('href="' . $wpe_url . '"');
            $cal_url_name = urlencode($wpe_url);
            $cal_details = 'Link to event: <br><a '.$cal_url_href.'>'.$cal_url_name.'</a>';

            ?>

            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

                <div class="section-inner medium">
                    
                    <header class="has-text-align-center">
                        <div class="entry-header-inner">
                            <h3 class="entry-title heading-size-3"><?php the_title(); ?></h3>
                        </div>
                    </header>



                    <div class="entry-content">
                        <div class="wpe-map">
                            <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo urlencode($wpe_location); ?>&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                        </div>
                        <div class="wpe-event-des">
                            <p>Event date: <span><?php echo date('d F Y', strtotime($wpe_date)); ?></span></p>
                            <p>Location: <span><?php echo $wpe_location; ?></span></p>
                            <div>
                                <a class="wpe-button" href="<?php echo $wpe_url ?>" target="blank">Link to Event</a>
                                <a class="wpe-button" href="http://www.google.com/calendar/render?action=TEMPLATE&text=<?php echo $cal_title ?>&dates=<?php echo $cal_dates ?>/<?php echo $cal_datee ?>&location=<?php echo $cal_location ?>&details=<?php echo $cal_details ?>&trp=false&sprop=&sprop=name:" target="blank" rel="nofollow">Add to Calendar</a>
                            </div>
                        </div>
                    </div>

                </div>

            </article>
            <?php
		}
	}
    ?>

    <div class="section-inner medium wpe-nav">
        <?php echo paginate_links(); ?>
    </div>

    <?php wp_reset_query(); ?>

</main>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
