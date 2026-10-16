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
        <?php
        $attributes = $product->get_attributes();
        $has_size_options = false;
        $size_options = array();

        if ( ! empty( $attributes ) ) {
            foreach ( $attributes as $attr_name => $attr ) {
                if ( false !== stripos( $attr_name, 'size' ) || ( is_object( $attr ) && false !== stripos( $attr->get_name(), 'size' ) ) ) {
                    $has_size_options = true;
                    if ( is_object( $attr ) && $attr->is_taxonomy() ) {
                        $terms = $attr->get_terms();
                        foreach ( $terms as $term ) {
                            $size_options[] = $term->name;
                        }
                    } elseif ( is_object( $attr ) ) {
                        $raw = $attr->get_options();
                        if ( ! empty( $raw ) && is_array( $raw ) ) {
                            $size_options = $raw;
                        }
                    }
                    break;
                }
            }
        }

        if ( ! $has_size_options ) {
            $cat_ids = $product->get_category_ids();
            $is_sized_cat = true;
            if ( ! empty( $cat_ids ) ) {
                foreach ( $cat_ids as $cid ) {
                    $term = get_term( $cid, 'product_cat' );
                    if ( $term && ( 'accessories' === $term->slug || 'accessory' === $term->slug || false !== stripos( $term->name, 'accessory' ) || false !== stripos( $term->name, 'bag' ) || false !== stripos( $term->name, 'cap' ) || false !== stripos( $term->name, 'hat' ) ) ) {
                        $is_sized_cat = false;
                        break;
                    }
                }
            }
            if ( $is_sized_cat ) {
                $has_size_options = true;
                $size_options = array( 'S', 'M', 'L', 'XL' );
            }
        }

        if ( $has_size_options && ! empty( $size_options ) ) :
            $first_size = $size_options[0];
        ?>
            <div class="size-selector-wrap">
                <div class="flex items-center justify-between mb-2.5">
                    <span class="text-sm font-mono uppercase tracking-wider text-black font-bold">
                        <?php esc_html_e( 'SIZE', 'mazestreetwear' ); ?>
                        <span class="selected-size-label ml-2 text-black font-bold">// <?php echo esc_html( strtoupper( $first_size ) ); ?></span>
                    </span>
                </div>
                <input type="hidden" name="selected_size" class="maze-selected-size-input" value="<?php echo esc_attr( $first_size ); ?>" />
                <div class="maze-size-pills flex flex-wrap gap-2.5">
                    <?php foreach ( $size_options as $idx => $s_opt ) : 
                        $is_s_active = ( 0 === $idx );
                    ?>
                        <button type="button" 
                                class="maze-size-pill px-5 py-3 text-sm sm:text-base font-bold font-mono uppercase border border-black cursor-pointer transition-colors rounded-none <?php echo $is_s_active ? 'is-active selected bg-black text-white' : 'bg-white text-black hover:bg-neutral-100'; ?>"
                                style="<?php echo $is_s_active ? 'background-color:#000000 !important; color:#ffffff !important;' : 'background-color:#ffffff !important; color:#000000 !important;'; ?>"
                                data-value="<?php echo esc_attr( $s_opt ); ?>"
                                onclick="window.mazeSelectSize ? window.mazeSelectSize(this, event) : null">
                            <?php echo esc_html( $s_opt ); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php
        // Hidden quantity set to 1 by default, or render minimal input
        if ( ! $product->is_sold_individually() ) {
            woocommerce_quantity_input(
                array(
                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                    'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(),
                    'classes'     => array( 'hidden' ),
                )
            );
        } else {
            ?>
            <input type="hidden" name="quantity" value="1" />
            <?php
        }
        ?>

        <!-- Solid Black Full-Width "ADD TO BAG" Button -->
        <div class="pt-2">
            <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt bg-black text-white hover:bg-neutral-800 text-sm sm:text-base font-bold uppercase tracking-wider py-4 w-full border border-black rounded-none font-mono transition-colors duration-150 cursor-pointer block text-center">
                <?php echo esc_html( $product->single_add_to_cart_text() ? $product->single_add_to_cart_text() : __( 'ADD TO BAG', 'mazestreetwear' ) ); ?>
            </button>
        </div>

        <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
    </form>

    <script>
    window.mazeSelectSize = window.mazeSelectSize || function (btn, event) {
        if (event) {
            event.preventDefault();
        }
        if (!btn) return;

        var container = btn.closest('.maze-size-pills');
        if (!container) return;

        var selectedVal = (btn.getAttribute('data-value') || btn.textContent || '').trim();
        if (!selectedVal) return;

        // 1. Immediately toggle classes and styles on all pills
        var allPills = container.querySelectorAll('.maze-size-pill');
        for (var i = 0; i < allPills.length; i++) {
            var p = allPills[i];
            p.classList.remove('is-active', 'selected', 'bg-black', 'text-white');
            p.classList.add('bg-white', 'text-black');
            p.style.setProperty('background-color', '#ffffff', 'important');
            p.style.setProperty('color', '#000000', 'important');
        }

        btn.classList.add('is-active', 'selected', 'bg-black', 'text-white');
        btn.classList.remove('bg-white', 'text-black');
        btn.style.setProperty('background-color', '#000000', 'important');
        btn.style.setProperty('color', '#ffffff', 'important');

        // 2. Update visible text label (e.g. "// M")
        var row = btn.closest('.variation-row') || btn.closest('.size-selector-wrap') || container.parentElement;
        if (row) {
            var label = row.querySelector('.selected-variation-value, .selected-size-label');
            if (label) {
                label.textContent = '// ' + selectedVal.toUpperCase();
            }
        }

        // 3. Simple Product: update hidden input
        var form = btn.closest('form');
        if (form) {
            var hiddenInput = form.querySelector('.maze-selected-size-input, input[name="selected_size"]');
            if (hiddenInput) {
                hiddenInput.value = selectedVal;
            }
        }
    };
    </script>

    <?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
