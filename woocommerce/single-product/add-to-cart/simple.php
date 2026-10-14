<?php
/**
 * Simple product add to cart template override
 *
 * Streetwear Add to Bag CTA button & quantity selector.
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
    return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

    <?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

    <form class="cart flex flex-col sm:flex-row items-stretch sm:items-center gap-4 my-6" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
        <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

        <?php
        do_action( 'woocommerce_before_add_to_cart_quantity' );

        woocommerce_quantity_input(
            array(
                'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                'classes'     => array( 'maze-qty-input', 'w-20', 'bg-white', 'border', 'border-black', 'text-black', 'text-center', 'font-mono', 'text-sm', 'font-bold', 'py-3.5', 'focus:outline-none', 'focus:ring-1', 'focus:ring-black' ),
            )
        );

        do_action( 'woocommerce_after_add_to_cart_quantity' );
        ?>

        <!-- Streetwear Add to Bag CTA Button: Solid Black with White Text -->
        <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt flex-1 bg-black hover:bg-neutral-800 text-white hover:text-white font-mono font-bold text-xs uppercase tracking-widest py-4 px-8 transition-colors duration-200 border border-black flex items-center justify-center space-x-2">
            <span><?php echo esc_html( $product->single_add_to_cart_text() ); ?></span>
            <svg class="w-4 h-4 ml-1 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </button>

        <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
    </form>

    <?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
