<?php
/**
 * The template for displaying product content within loops
 *
 * Streetwear garment card layout for mazestw.in.
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>
<article <?php wc_product_class( 'maze-product-card group flex flex-col relative bg-[#111113] border border-white/5 hover:border-white/20 transition-all duration-300', $product ); ?>>

    <?php
    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    do_action( 'woocommerce_before_shop_loop_item' );
    ?>

    <!-- Garment Image Wrapper -->
    <div class="relative w-full aspect-[3/4] bg-[#16161a] overflow-hidden">
        <?php
        /**
         * Hook: woocommerce_before_shop_loop_item_title.
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>

        <!-- Hover Overlay Details Badge -->
        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none flex items-end p-3">
            <span class="text-[10px] font-mono tracking-widest uppercase text-white bg-black/80 px-2 py-1 backdrop-blur-sm border border-white/10">
                <?php echo $product->is_in_stock() ? esc_html__( 'IN STOCK // DROP 01', 'mazestreetwear' ) : esc_html__( 'SOLD OUT', 'mazestreetwear' ); ?>
            </span>
        </div>
    </div>

    <!-- Garment Info & Title -->
    <div class="flex-grow p-4 flex flex-col justify-between">
        <div>
            <!-- Categories -->
            <div class="text-[10px] font-mono tracking-widest uppercase text-[#71717a] mb-1">
                <?php
                $terms = get_the_terms( $product->get_id(), 'product_cat' );
                if ( $terms && ! is_wp_error( $terms ) ) {
                    echo esc_html( $terms[0]->name );
                } else {
                    echo esc_html__( 'STREETWEAR', 'mazestreetwear' );
                }
                ?>
            </div>

            <!-- Product Title -->
            <h2 class="woocommerce-loop-product__title text-sm font-sans font-bold uppercase tracking-tight text-white group-hover:text-[#ccff00] transition-colors line-clamp-1">
                <?php
                /**
                 * Hook: woocommerce_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_product_title - 10
                 */
                the_title();
                ?>
            </h2>
        </div>

        <!-- Price & Rating -->
        <div class="mt-3 pt-3 border-t border-white/5 flex items-center justify-between text-xs font-mono">
            <?php
            /**
             * Hook: woocommerce_after_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
        </div>
    </div>

    <!-- Action / Add to Cart Button -->
    <div class="px-4 pb-4">
        <?php
        /**
         * Hook: woocommerce_after_shop_loop_item.
         *
         * @hooked woocommerce_template_loop_product_link_close - 5
         * @hooked woocommerce_template_loop_add_to_cart - 10
         */
        do_action( 'woocommerce_after_shop_loop_item' );
        ?>
    </div>

</article>
