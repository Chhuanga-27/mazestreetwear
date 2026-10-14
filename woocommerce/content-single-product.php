<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'maze-product-detail-layout bg-white text-black', $product ); ?>>

    <!-- 2-Column Garment Detail Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-start">

        <!-- Left Column: Garment Image Gallery (Col span 7) -->
        <div class="lg:col-span-7">
            <div class="sticky top-28 space-y-4">
                <div class="hidden lg:flex items-center justify-between text-[11px] font-mono tracking-widest text-neutral-600 uppercase border-b border-black pb-2">
                    <span>[ ARCHIVE REF // #<?php echo esc_html( $product->get_sku() ? $product->get_sku() : get_the_ID() ); ?> ]</span>
                    <span class="text-black font-bold">[ <?php echo $product->is_in_stock() ? esc_html__( 'IN STOCK', 'mazestreetwear' ) : esc_html__( 'SOLD OUT', 'mazestreetwear' ); ?> ]</span>
                </div>

                <div class="maze-gallery-wrapper relative bg-white border border-black p-2 sm:p-4 overflow-hidden">
                    <?php
                    /**
                     * Hook: woocommerce_before_single_product_summary.
                     *
                     * @hooked woocommerce_show_product_sale_flash - 10
                     * @hooked woocommerce_show_product_images - 20
                     */
                    do_action( 'woocommerce_before_single_product_summary' );
                    ?>
                </div>

                <p class="text-[10px] font-mono tracking-widest text-neutral-500 uppercase text-center sm:text-left">
                    <?php esc_html_e( 'CLICK IMAGE TO EXPAND LIGHTBOX // HOVER FOR ZOOM', 'mazestreetwear' ); ?>
                </p>
            </div>
        </div>

        <!-- Right Column: Garment Info, Size Pills + Add to Bag (Col span 5) -->
        <div class="lg:col-span-5">
            <div class="maze-product-summary-panel bg-white border border-black p-6 sm:p-8">

                <div class="flex items-center justify-between text-xs font-mono font-bold tracking-widest uppercase text-neutral-500 mb-3">
                    <div>
                        <?php
                        $categories = wc_get_product_category_list( $product->get_id(), ', ' );
                        if ( $categories ) {
                            echo wp_kses_post( $categories );
                        } else {
                            echo esc_html__( 'MAZE APPAREL', 'mazestreetwear' );
                        }
                        ?>
                    </div>
                    <span class="text-black font-bold border border-black px-2 py-0.5">SS26 // DROP</span>
                </div>

                <!-- Native WooCommerce Single Product Summary -->
                <div class="summary entry-summary space-y-6">
                    <?php
                    /**
                     * Hook: woocommerce_single_product_summary.
                     *
                     * @hooked woocommerce_template_single_title - 5
                     * @hooked woocommerce_template_single_rating - 10
                     * @hooked woocommerce_template_single_price - 10
                     * @hooked woocommerce_template_single_excerpt - 20
                     * @hooked woocommerce_template_single_add_to_cart - 30
                     * @hooked woocommerce_template_single_meta - 40
                     * @hooked woocommerce_template_single_sharing - 50
                     */
                    do_action( 'woocommerce_single_product_summary' );
                    ?>
                </div>

                <!-- Garment Technical Specifications Streetwear Accordion / Banner -->
                <div class="mt-8 pt-6 border-t border-black space-y-3 font-mono text-xs">
                    <div class="flex items-center justify-between text-black py-1">
                        <span class="tracking-widest uppercase text-neutral-500"><?php esc_html_e( 'MATERIAL', 'mazestreetwear' ); ?></span>
                        <span class="text-right font-bold"><?php esc_html_e( '100% 450GSM FRENCH TERRY', 'mazestreetwear' ); ?></span>
                    </div>
                    <div class="flex items-center justify-between text-black py-1 border-t border-neutral-200">
                        <span class="tracking-widest uppercase text-neutral-500"><?php esc_html_e( 'FIT PROFILE', 'mazestreetwear' ); ?></span>
                        <span class="text-right text-black font-bold"><?php esc_html_e( 'BOXY / OVERSIZED CUT', 'mazestreetwear' ); ?></span>
                    </div>
                    <div class="flex items-center justify-between text-black py-1 border-t border-neutral-200">
                        <span class="tracking-widest uppercase text-neutral-500"><?php esc_html_e( 'SHIPPING', 'mazestreetwear' ); ?></span>
                        <span class="text-right font-bold"><?php esc_html_e( 'DISPATCH WITHIN 24 HOURS', 'mazestreetwear' ); ?></span>
                    </div>
                    <div class="flex items-center justify-between text-black py-1 border-t border-neutral-200">
                        <span class="tracking-widest uppercase text-neutral-500"><?php esc_html_e( 'AUTHENTICITY', 'mazestreetwear' ); ?></span>
                        <span class="text-right font-bold"><?php esc_html_e( 'VERIFIED MAZESTW.IN PROTOCOL', 'mazestreetwear' ); ?></span>
                    </div>
                </div>

                <!-- Quick Policy Help Links -->
                <div class="mt-6 pt-4 border-t border-black flex items-center justify-between text-[11px] font-mono text-neutral-600">
                    <a href="<?php echo esc_url( home_url( '/shipping-policy' ) ); ?>" class="hover:text-black transition-colors underline decoration-black/30">
                        <?php esc_html_e( 'Shipping Terms', 'mazestreetwear' ); ?>
                    </a>
                    <span class="text-neutral-300">/</span>
                    <a href="<?php echo esc_url( home_url( '/refund-policy' ) ); ?>" class="hover:text-black transition-colors underline decoration-black/30">
                        <?php esc_html_e( 'Return Policy', 'mazestreetwear' ); ?>
                    </a>
                    <span class="text-neutral-300">/</span>
                    <a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="hover:text-black transition-colors underline decoration-black/30">
                        <?php esc_html_e( 'Help Desk', 'mazestreetwear' ); ?>
                    </a>
                </div>

            </div>
        </div>

    </div><!-- .grid -->

    <!-- Bottom Section: Garment Details Tabs, Reviews & Related Streetwear -->
    <div class="mt-16 pt-12 border-t border-black">
        <?php
        /**
         * Hook: woocommerce_after_single_product_summary.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        do_action( 'woocommerce_after_single_product_summary' );
        ?>
    </div>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
