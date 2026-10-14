<?php
/**
 * The Template for displaying product archives, including the main shop page
 * and product category/tag archives.
 *
 * Streetwear responsive product catalog grid for mazestw.in.
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked mazestreetwear_wrapper_start - 10 (outputs site-main container)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
?>

<div class="maze-archive-wrapper max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 bg-white text-black">

    <!-- Header Section / Editorial Streetwear Title -->
    <header class="woocommerce-products-header mb-8 pb-6 border-b border-black">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <div class="inline-flex items-center space-x-2 text-[11px] font-mono font-bold tracking-widest text-black uppercase mb-2 border border-black px-2.5 py-0.5 bg-white">
                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-black"></span>
                    <span><?php esc_html_e( 'ARCHIVE CATALOG // 2026', 'mazestreetwear' ); ?></span>
                </div>
                <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                    <h1 class="woocommerce-products-header__title page-title text-3xl sm:text-5xl font-black font-sans tracking-tight uppercase text-black">
                        <?php woocommerce_page_title(); ?>
                    </h1>
                <?php endif; ?>
            </div>

            <!-- Shop Description -->
            <div class="text-xs font-mono text-neutral-600 max-w-md">
                <?php
                /**
                 * Hook: woocommerce_archive_description.
                 *
                 * @hooked woocommerce_taxonomy_archive_description - 10
                 * @hooked woocommerce_product_archive_description - 10
                 */
                do_action( 'woocommerce_archive_description' );
                ?>
            </div>
        </div>
    </header>

    <?php
    if ( woocommerce_product_loop() ) {

        /**
         * Hook: woocommerce_before_shop_loop.
         *
         * @hooked woocommerce_output_all_notices - 10
         * @hooked woocommerce_result_count - 20
         * @hooked woocommerce_catalog_ordering - 30
         */
        ?>
        <div class="maze-shop-controls mb-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-4 border-b border-neutral-200 font-mono text-xs uppercase tracking-wider text-neutral-600">
            <?php do_action( 'woocommerce_before_shop_loop' ); ?>
        </div>

        <!-- Responsive Apparel Product Catalog Grid -->
        <div class="maze-product-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
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

        <?php
        /**
         * Hook: woocommerce_after_shop_loop.
         *
         * @hooked woocommerce_pagination - 10
         */
        ?>
        <div class="maze-pagination-wrap mt-16 pt-8 border-t border-black flex justify-center font-mono">
            <?php do_action( 'woocommerce_after_shop_loop' ); ?>
        </div>
        <?php
    } else {
        /**
         * Hook: woocommerce_no_products_found.
         *
         * @hooked wc_no_products_found - 10
         */
        ?>
        <div class="maze-no-products py-20 text-center border border-black bg-neutral-50 p-8">
            <span class="text-4xl mb-4 block font-mono font-bold text-neutral-400">[ 00 ]</span>
            <h3 class="text-lg font-mono uppercase font-bold tracking-widest text-black mb-2"><?php esc_html_e( 'NO APPAREL FOUND', 'mazestreetwear' ); ?></h3>
            <p class="text-xs font-mono text-neutral-600 mb-6"><?php esc_html_e( 'The requested garment archive or drop is currently unavailable.', 'mazestreetwear' ); ?></p>
            <?php do_action( 'woocommerce_no_products_found' ); ?>
        </div>
        <?php
    }
    ?>

</div><!-- .maze-archive-wrapper -->

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked mazestreetwear_wrapper_end - 10 (closes site-main)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
