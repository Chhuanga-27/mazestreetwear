<?php
/**
 * Simple product add to cart template override
 *
 * Minimalist rectangular size boxes & full-width "ADD TO BAG" CTA button.
 *
 * @package MazeStreetwear
 * @version 1.1.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
    return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

    <?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

    <form class="cart space-y-6 my-6" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
        <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

        <!-- Sizing Selector: Clean rectangular size boxes with 1px black borders -->
        <div class="size-selector-wrap">
            <div class="flex items-center justify-between mb-2.5">
                <span class="text-xs font-mono uppercase tracking-wider text-black font-bold">
                    <?php esc_html_e( 'SIZE', 'mazestreetwear' ); ?>
                    <span class="selected-size-label ml-2 text-black font-normal">// S</span>
                </span>
            </div>
            <div class="maze-size-pills flex flex-wrap gap-2.5">
                <button type="button" class="maze-size-pill is-active selected px-5 py-3 text-xs font-mono uppercase border border-black bg-black text-white cursor-pointer transition-colors" data-value="S">S</button>
                <button type="button" class="maze-size-pill px-5 py-3 text-xs font-mono uppercase border border-black bg-white text-black hover:bg-neutral-100 cursor-pointer transition-colors" data-value="M">M</button>
                <button type="button" class="maze-size-pill px-5 py-3 text-xs font-mono uppercase border border-black bg-white text-black hover:bg-neutral-100 cursor-pointer transition-colors" data-value="L">L</button>
                <button type="button" class="maze-size-pill px-5 py-3 text-xs font-mono uppercase border border-black bg-white text-black hover:bg-neutral-100 cursor-pointer transition-colors" data-value="XL">XL</button>
            </div>
        </div>

        <?php
        // Hidden quantity set to 1 by default, or render minimal input
        if ( ! $product->is_sold_individually() ) {
            woocommerce_quantity_input(
                array(
                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                    'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                    'classes'     => array( 'hidden' ),
                )
            );
        }
        ?>

        <!-- Solid Black Full-Width "ADD TO BAG" Button -->
        <div class="pt-2">
            <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt bg-black text-white hover:bg-neutral-800 text-xs uppercase tracking-widest py-4 w-full border border-black rounded-none font-mono transition-colors duration-150 cursor-pointer block text-center">
                <?php esc_html_e( 'ADD TO BAG', 'mazestreetwear' ); ?>
            </button>
        </div>

        <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
    </form>

    <?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
