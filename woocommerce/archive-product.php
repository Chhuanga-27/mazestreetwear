<?php
/**
 * The Template for displaying product archives, including the main shop page
 * and product category/tag archives.
 *
 * Stark Luxury Minimalist Editorial Catalog for mazestw.in.
 * Features:
 * - Clean category header with a 1px bottom border
 * - Minimalist 1px hairline sorting trigger & lowercase result count
 * - Connected 4-column hairline product grid
 *
 * @package MazeStreetwear
 * @version 1.1.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 */
do_action( 'woocommerce_before_main_content' );
?>

<div class="maze-archive-page bg-white text-black min-h-screen">

    <!-- Clean Category Header with a 1px Bottom Border -->
    <header class="woocommerce-products-header border-b border-black py-8 sm:py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-baseline justify-between gap-4">
                <div>
                    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                        <h1 class="woocommerce-products-header__title page-title text-2xl sm:text-3xl font-bold font-sans uppercase tracking-tight text-black">
                            <?php woocommerce_page_title(); ?>
                        </h1>
                    <?php endif; ?>
                </div>

                <?php
                /**
                 * Hook: woocommerce_archive_description.
                 */
                do_action( 'woocommerce_archive_description' );
                ?>
            </div>
        </div>
    </header>

    <?php if ( woocommerce_product_loop() ) : ?>

        <!-- Minimalist Controls Bar: Lowercase Result Count & Minimalist Sorting Trigger -->
        <div class="border-b border-black bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs font-sans">
                <div class="text-neutral-500 lowercase tracking-normal">
                    <?php woocommerce_result_count(); ?>
                </div>

                <div class="maze-ordering-trigger-wrap">
                    <?php woocommerce_catalog_ordering(); ?>
                </div>
            </div>
        </div>

        <!-- Connected Hairline Border Grid: 4 Columns on Desktop -->
        <div class="w-full bg-white border-b border-black overflow-hidden">
            <div class="max-w-7xl mx-auto border-x border-black">
                <div class="maze-product-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 bg-white">
                    <?php
                    if ( wc_get_loop_prop( 'total' ) ) {
                        while ( have_posts() ) {
                            the_post();

                            /**
                             * Hook: woocommerce_shop_loop.
                             */
                            do_action( 'woocommerce_shop_loop' );

                            wc_get_template_part( 'content', 'product' );
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Minimalist Pagination -->
        <div class="maze-pagination-wrap py-12 flex justify-center text-xs font-mono">
            <?php
            /**
             * Hook: woocommerce_after_shop_loop.
             */
            do_action( 'woocommerce_after_shop_loop' );
            ?>
        </div>

    <?php else : ?>

        <div class="max-w-xl mx-auto my-20 p-8 text-center border border-black bg-white">
            <h2 class="text-xs font-mono uppercase font-bold tracking-widest text-black mb-2">
                <?php esc_html_e( 'NO PRODUCTS FOUND', 'mazestreetwear' ); ?>
            </h2>
            <p class="text-xs font-sans text-neutral-600 mb-6">
                <?php esc_html_e( 'The requested garment drop or category is currently empty.', 'mazestreetwear' ); ?>
            </p>
            <a href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>" class="inline-block border border-black bg-white text-black hover:bg-black hover:text-white transition-colors px-6 py-2.5 text-xs uppercase tracking-widest font-mono">
                <?php esc_html_e( 'VIEW ALL GARMENTS', 'mazestreetwear' ); ?>
            </a>
            <?php do_action( 'woocommerce_no_products_found' ); ?>
        </div>

    <?php endif; ?>

</div><!-- .maze-archive-page -->

<?php
/**
 * Hook: woocommerce_after_main_content.
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
