<?php
/**
 * Single variation cart button override
 *
 * Full-width brutalist black button for Maze Streetwear variable products.
 *
 * @package MazeStreetwear
 * @version 1.2.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
/** @var \WC_Product $product */
?>
<div class="woocommerce-variation-add-to-cart variations_button woocommerce-variation-add-to-cart-disabled pt-2 w-full">
    <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

    <?php
    do_action( 'woocommerce_before_add_to_cart_quantity' );

    // Standard hidden quantity for single item drop checkout
    woocommerce_quantity_input(
        array(
            'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
            'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
            'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(),
            'classes'     => array( 'hidden' ),
        )
    );

    do_action( 'woocommerce_after_add_to_cart_quantity' );
    ?>

    <button type="submit" class="single_add_to_cart_button button alt disabled bg-black text-white hover:bg-neutral-800 text-lg sm:text-xl font-normal uppercase tracking-wider py-4 w-full border border-black rounded-none font-bebas transition-colors duration-150 cursor-pointer block text-center" disabled>
        <?php echo esc_html( $product->single_add_to_cart_text() ? $product->single_add_to_cart_text() : __( 'ADD TO BAG', 'mazestreetwear' ) ); ?>
    </button>

    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

    <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
    <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
    <input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
