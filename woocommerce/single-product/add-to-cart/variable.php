<?php
/**
 * Variable product add to cart template override
 *
 * Streetwear size pills selector & Add to Bag CTA button.
 * Preserves all native WooCommerce hooks and variation scripts.
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart space-y-6" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
    <?php do_action( 'woocommerce_before_variations_form' ); ?>

    <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
        <p class="stock out-of-stock font-mono text-xs uppercase tracking-widest text-black bg-neutral-100 p-3 border border-black">
            <?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This garment drop is currently out of stock and unavailable.', 'mazestreetwear' ) ) ); ?>
        </p>
    <?php else : ?>
        <div class="variations space-y-5">
            <?php do_action( 'woocommerce_before_variations_table' ); ?>

            <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                <div class="variation-row" data-attribute="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
                    <div class="flex items-center justify-between mb-2">
                        <label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>" class="text-xs font-mono font-bold tracking-widest uppercase text-black">
                            <?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?>
                            <span class="selected-variation-value text-black font-bold ml-2"></span>
                        </label>

                        <?php if ( stripos( $attribute_name, 'size' ) !== false ) : ?>
                            <button type="button" class="maze-size-guide-trigger text-[11px] font-mono font-bold tracking-widest uppercase text-neutral-600 hover:text-black underline underline-offset-4 transition-colors">
                                <?php esc_html_e( 'SIZE GUIDE', 'mazestreetwear' ); ?>
                            </button>
                        <?php endif; ?>
                    </div>

                    <!-- Streetwear Size Pills Interactive Container: Crisp Black Outline, Solid Black Fill when Active -->
                    <div class="maze-size-pills flex flex-wrap gap-2.5 my-2" data-target-select="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
                        <?php
                        if ( ! empty( $options ) ) {
                            if ( taxonomy_is_product_attribute( $attribute_name ) ) {
                                $terms = wc_get_product_terms( $product->get_id(), $attribute_name, array( 'fields' => 'all' ) );
                                foreach ( $terms as $term ) {
                                    if ( in_array( $term->slug, $options, true ) ) {
                                        ?>
                                        <button type="button"
                                                class="maze-size-pill px-4 py-2.5 text-xs font-mono font-bold tracking-wider uppercase border border-black bg-white text-black hover:bg-neutral-100 transition-all duration-150 cursor-pointer"
                                                data-value="<?php echo esc_attr( $term->slug ); ?>">
                                            <?php echo esc_html( $term->name ); ?>
                                        </button>
                                        <?php
                                    }
                                }
                            } else {
                                foreach ( $options as $option ) {
                                    ?>
                                    <button type="button"
                                            class="maze-size-pill px-4 py-2.5 text-xs font-mono font-bold tracking-wider uppercase border border-black bg-white text-black hover:bg-neutral-100 transition-all duration-150 cursor-pointer"
                                            data-value="<?php echo esc_attr( $option ); ?>">
                                        <?php echo esc_html( $option ); ?>
                                    </button>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>

                    <!-- Native WooCommerce Dropdown (Kept fully functional for WooCommerce scripts) -->
                    <div class="sr-only">
                        <?php
                        wc_dropdown_variation_attribute_options( array(
                            'options'   => $options,
                            'attribute' => $attribute_name,
                            'product'   => $product,
                        ) );
                        ?>
                    </div>

                    <?php
                    echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations text-[10px] font-mono font-bold tracking-widest uppercase text-neutral-500 hover:text-black mt-1 inline-block" href="#">' . esc_html__( 'CLEAR SELECTION', 'mazestreetwear' ) . '</a>' ) ) : '';
                    ?>
                </div>
            <?php endforeach; ?>

            <?php do_action( 'woocommerce_after_variations_table' ); ?>
        </div>

        <div class="single_variation_wrap pt-2">
            <?php
            /**
             * Hook: woocommerce_before_single_variation.
             */
            do_action( 'woocommerce_before_single_variation' );

            /**
             * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
             *
             * @hooked woocommerce_single_variation - 10 Empty div for variation data.
             * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
             */
            do_action( 'woocommerce_single_variation' );

            /**
             * Hook: woocommerce_after_single_variation.
             */
            do_action( 'woocommerce_after_single_variation' );
            ?>
        </div>
    <?php endif; ?>

    <?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
