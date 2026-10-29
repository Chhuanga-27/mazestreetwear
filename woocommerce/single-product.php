<?php
/**
 * The Template for displaying all single products
 *
 * Stark Luxury Minimalist Editorial Single Product template for mazestw.in.
 * Delegates to content-single-product.php for the 2-column layout framed by thin black dividers.
 *
 * @package MazeStreetwear
 * @version 1.6.4
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 */
do_action( 'woocommerce_before_main_content' );

while ( have_posts() ) :
    the_post();
    wc_get_template_part( 'content', 'single-product' );
endwhile;

/**
 * Hook: woocommerce_after_main_content.
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
