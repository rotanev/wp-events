<?php
/**
 * @package WP_Events
 */
/*
    Plugin Name: Wordpress Events
    Plugin URI: https://wordpress.org/
    Version: 1.0.0
    Author: Sergey Rotanev
    Author URI: https://www.upwork.com/freelancers/~017137a28be6398091
    Description: Suffering with a complicated and feature-bloated event management plugin is not a situation you need to be in. You’ll want an intuitive, snappy way to create events fast. What’s more, you’ll need a quick way to set events up regardless of whether they are in-person, virtual, or everything in between.
    Text Domain: wp-events
*/

add_action( 'init', 'wpe_init' );
add_action( 'init', 'wpe_rewrite' );
add_action( 'wp_enqueue_scripts', 'wpe_theme_asset' );
add_action( 'template_include', 'wpe_template_include' );
add_filter( 'query_vars', 'wpe_query_vars' );


if ( is_admin() ) {
    add_action( 'admin_head', 'wpe_post_meta_css' );
    add_action( 'save_post', 'wpe_post_meta_save' );
    add_action( 'edit_form_after_title', 'wpe_post_meta_form' );
}

function wpe_init() {
    
    $labels = [
        'name'          => __( 'Events' ),
        'singular_name' => __( 'Event' ),
        'menu_name'     => __( 'Events' ),
        'add_new_item'  => __( 'Add New Event' ),
        'edit_item'     => __( 'Edit Event' ),
    ];

    $args = [
        'labels'            => $labels,
        'public'            => true,    
        'show_in_menu'      => true,
        'capability_type'   => 'post',
        'supports'          => array( 'title' ),
        'menu_position'     => 5,
    ];

    register_post_type( 'event', $args );
}

function wpe_theme_asset() {
    wp_enqueue_style( 'wpe-style', plugins_url('/style.css', __FILE__) );
}

function wpe_rewrite() {
    add_rewrite_rule( 'events[/]?$', 'index.php?events=1', 'top' );
}

function wpe_query_vars( $query_vars ) {
    $query_vars[] = 'events';
    return $query_vars;
}

function wpe_template_include( $template ) {
    if ( get_query_var( 'events' ) ) {
        return dirname(__FILE__) . '/archive-event.php';
    }
    if ( is_single() && get_post_type() == 'event' ) {
        return dirname(__FILE__) . '/single-event.php';
    }
    return $template;
}

function wpe_post_meta_css() {

    ?>
    <style type='text/css'>
        .wpe-meta-item {
            margin: 15px 0;
        }
        .wpe-label {
            margin-bottom: 5px;
            display: block;
        }
        .wpe-input {
            width: 100%;
        }
    </style>
    <?php
}

function wpe_post_meta_save( $post_id ) {

    if ( get_post_type() !== 'event' ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }

    update_post_meta( $post_id, 'wpe_date', sanitize_text_field($_POST['wpe_date']) );
    update_post_meta( $post_id, 'wpe_location', sanitize_text_field($_POST['wpe_location']) );
    update_post_meta( $post_id, 'wpe_url', sanitize_text_field($_POST['wpe_url']) );
}

function wpe_post_meta_form( ) {

    if ( get_post_type() !== 'event' ) {
        return;
    }

    $post = func_get_arg(0);

    $wpe_date = get_post_meta( $post->ID, 'wpe_date', true );
    $wpe_location = get_post_meta( $post->ID, 'wpe_location', true );
    $wpe_url = get_post_meta( $post->ID, 'wpe_url', true );

    ?>
    <div class="wpe-meta-item">
        <label class="wpe-label" for="wpe_date">Event date</label>
        <input class="wpe-input" type="date" id="wpe_date" name="wpe_date" 
            value="<?= $wpe_date ?>" 
            required>
    </div>
    <div class="wpe-meta-item">
        <label class="wpe-label" for="wpe_location">Event location</label>
        <input class="wpe-input" type="text" id="wpe_location" name="wpe_location" 
            value="<?= $wpe_location ?>"
            required>
    </div>
    <div class="wpe-meta-item">
        <label class="wpe-label" for="wpe_url">Event URL</label>
        <input class="wpe-input" type="text" id="wpe_url" name="wpe_url" 
            value="<?= $wpe_url ?>" 
            required>
    </div>
    <?php
}