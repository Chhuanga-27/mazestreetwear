<?php
/**
 * Single variation cart button override
 *
 * Full-width brutalist black button for Maze variable products.
 *
 * @package MazeStreetwear
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;
/** @var \WC_Product_Variable|\WC_Product $product */
?>
<div class="woocommerce-variation-add-to-cart variations_button pt-2 w-full">
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

<?php
$default_var_id = 0;
if ( $product instanceof \WC_Product_Variable ) {
    $avail = $product->get_available_variations();
    if ( ! empty( $avail ) ) {
        foreach ( $avail as $var_opt ) {
            if ( ! empty( $var_opt['is_in_stock'] ) && ! empty( $var_opt['is_purchasable'] ) && ! empty( $var_opt['variation_id'] ) ) {
                $default_var_id = $var_opt['variation_id'];
                break;
            }
        }
    }
} elseif ( is_object( $product ) && method_exists( $product, 'get_available_variations' ) ) {
    $avail = $product->get_available_variations();
    if ( ! empty( $avail ) ) {
        foreach ( $avail as $var_opt ) {
            if ( ! empty( $var_opt['is_in_stock'] ) && ! empty( $var_opt['is_purchasable'] ) && ! empty( $var_opt['variation_id'] ) ) {
                $default_var_id = $var_opt['variation_id'];
                break;
            }
        }
    }
}
?>
    <div class="product-actions-buttons flex flex-col gap-3 w-full">
        <button type="submit" class="single_add_to_cart_button maze-btn-animated button alt bg-black text-white hover:bg-neutral-800 text-lg sm:text-xl font-normal uppercase tracking-wider py-4 w-full border border-black rounded-none font-bebas transition-all duration-200 cursor-pointer block text-center select-none active:scale-[0.98]" data-default-text="<?php echo esc_attr( $product->single_add_to_cart_text() ? $product->single_add_to_cart_text() : __( 'ADD TO BAG', 'mazestreetwear' ) ); ?>">
            <span class="btn-text"><?php echo esc_html( $product->single_add_to_cart_text() ? $product->single_add_to_cart_text() : __( 'ADD TO BAG', 'mazestreetwear' ) ); ?></span>
        </button>

        <button type="submit" name="maze_buy_now" value="1" class="maze_buy_now_button maze-btn-animated button bg-white text-black hover:bg-black hover:text-white text-lg sm:text-xl font-normal uppercase tracking-wider py-4 w-full border-2 border-black rounded-none font-bebas transition-all duration-200 cursor-pointer block text-center select-none active:scale-[0.98]" data-default-text="<?php esc_attr_e( 'BUY NOW', 'mazestreetwear' ); ?>">
            <span class="btn-text"><?php esc_html_e( 'BUY NOW', 'mazestreetwear' ); ?></span>
        </button>
    </div>

    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

    <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
    <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
    <input type="hidden" name="variation_id" class="variation_id" value="<?php echo absint( $default_var_id ); ?>" />
    <input type="hidden" name="maze_buy_now" class="maze-buy-now-input" value="0" />
</div>

