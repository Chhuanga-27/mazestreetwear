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
<article <?php wc_product_class( 'maze-product-card group flex flex-col relative bg-white border border-black hover:shadow-[4px_4px_0px_0px_#000000] transition-all duration-200', $product ); ?>>

    <?php
    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    do_action( 'woocommerce_before_shop_loop_item' );
    ?>

    <!-- Garment Image Wrapper -->
    <div class="relative w-full aspect-[3/4] bg-neutral-100 overflow-hidden border-b border-black">
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
        <div class="absolute top-3 left-3 z-10 pointer-events-none">
            <span class="text-[10px] font-mono font-bold tracking-widest uppercase text-white bg-black px-2 py-0.5 border border-black">
                <?php echo $product->is_in_stock() ? esc_html__( 'IN STOCK', 'mazestreetwear' ) : esc_html__( 'SOLD OUT', 'mazestreetwear' ); ?>
            </span>
        </div>
    </div>

    <!-- Garment Info & Title -->
    <div class="flex-grow p-4 flex flex-col justify-between bg-white">
        <div>
            <!-- Categories -->
            <div class="text-[10px] font-mono font-bold tracking-widest uppercase text-neutral-500 mb-1">
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
            <h2 class="woocommerce-loop-product__title text-sm font-sans font-bold uppercase tracking-tight text-black group-hover:text-neutral-600 transition-colors line-clamp-1">
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
        <div class="mt-3 pt-3 border-t border-neutral-200 flex items-center justify-between text-xs font-mono font-bold text-black">
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

    <!-- Action / Minimal Black Quick-View / View Garment Button -->
    <div class="px-4 pb-4 pt-1 bg-white">
        <a href="<?php the_permalink(); ?>" class="w-full inline-flex items-center justify-center bg-black hover:bg-neutral-800 text-white font-mono font-bold text-xs uppercase tracking-widest py-3 px-4 border border-black transition-colors duration-150">
            <span><?php esc_html_e( 'VIEW GARMENT', 'mazestreetwear' ); ?></span>
            <span class="ml-1.5">&rarr;</span>
        </a>
    </div>

</article>
