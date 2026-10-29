<?php
/**
 * Variable product add to cart template override
 *
 * Minimalist rectangular size boxes & full-width "ADD TO BAG" CTA button.
 * Preserves all native WooCommerce hooks and variation scripts.
 *
 * @package MazeStreetwear
 * @version 1.1.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * @var \WC_Product_Variable $product
 * @var array $attributes
 * @var array $available_variations
 */
$attributes           = isset( $attributes ) ? $attributes : ( ( $product && method_exists( $product, 'get_variation_attributes' ) ) ? $product->get_variation_attributes() : array() );
$available_variations = isset( $available_variations ) ? $available_variations : ( ( $product && method_exists( $product, 'get_available_variations' ) ) ? $product->get_available_variations() : array() );

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart space-y-6" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
    <?php do_action( 'woocommerce_before_variations_form' ); ?>
    <input type="hidden" name="selected_size" class="maze-selected-size-input" value="" />

    <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
        <p class="stock out-of-stock font-bebas text-base sm:text-lg font-normal uppercase tracking-wider text-black bg-neutral-100 p-3 border border-black">
            <?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This garment drop is currently out of stock and unavailable.', 'mazestreetwear' ) ) ); ?>
        </p>
    <?php else : ?>
        <div class="variations space-y-5">
            <?php do_action( 'woocommerce_before_variations_table' ); ?>

            <?php foreach ( $attributes as $attribute_name => $options ) : 
                $selected_attr = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( wp_unslash( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name );
                if ( empty( $selected_attr ) && ! empty( $available_variations ) ) {
                    $attr_field_key = 'attribute_' . sanitize_title( $attribute_name );
                    foreach ( $available_variations as $var_item ) {
                        if ( ! empty( $var_item['is_in_stock'] ) && ! empty( $var_item['is_purchasable'] ) && isset( $var_item['attributes'][$attr_field_key] ) && '' !== $var_item['attributes'][$attr_field_key] ) {
                            $selected_attr = $var_item['attributes'][$attr_field_key];
                            break;
                        }
                    }
                }
                if ( empty( $selected_attr ) && ! empty( $options ) ) {
                    if ( taxonomy_is_product_attribute( $attribute_name ) ) {
                        $terms = wc_get_product_terms( $product->get_id(), $attribute_name, array( 'fields' => 'all' ) );
                        foreach ( $terms as $term ) {
                            if ( in_array( $term->slug, $options, true ) ) {
                                $selected_attr = $term->slug;
                                break;
                            }
                        }
                    } else {
                        $selected_attr = reset( $options );
                    }
                }
            ?>
                <div class="variation-row" data-attribute="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
                    <div class="flex items-center justify-between mb-2">
                        <label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>" class="text-base font-bebas font-normal tracking-wider uppercase text-black">
                            <?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?>
                            <span class="selected-variation-value text-black font-bold font-outfit text-sm ml-2">
                                <?php if ( ! empty( $selected_attr ) ) echo '// ' . esc_html( strtoupper( $selected_attr ) ); ?>
                            </span>
                        </label>
                    </div>

                    <!-- Clean rectangular size boxes with 1px black borders, filled black when selected -->
                    <div class="maze-size-pills flex flex-wrap gap-2.5 my-2" data-target-select="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
                        <?php
                        if ( ! empty( $options ) ) {
                            if ( taxonomy_is_product_attribute( $attribute_name ) ) {
                                $terms = wc_get_product_terms( $product->get_id(), $attribute_name, array( 'fields' => 'all' ) );
                                foreach ( $terms as $term ) {
                                    if ( in_array( $term->slug, $options, true ) ) {
                                        $is_active = ( $selected_attr === $term->slug );
                                        ?>
                                        <button type="button"
                                                class="maze-size-pill px-5 py-3 text-base sm:text-lg font-normal font-bebas uppercase border border-black transition-colors rounded-none cursor-pointer <?php echo $is_active ? 'is-active selected bg-black text-white' : 'bg-white text-black hover:bg-neutral-100'; ?>"
                                                style="<?php echo $is_active ? 'background-color:#000000 !important; color:#ffffff !important;' : 'background-color:#ffffff !important; color:#000000 !important;'; ?>"
                                                data-value="<?php echo esc_attr( $term->slug ); ?>"
                                                onclick="window.mazeSelectSize ? window.mazeSelectSize(this, event) : null">
                                            <?php echo esc_html( $term->name ); ?>
                                        </button>
                                        <?php
                                    }
                                }
                            } else {
                                foreach ( $options as $option ) {
                                    $is_active = ( $selected_attr === $option );
                                    ?>
                                    <button type="button"
                                            class="maze-size-pill px-5 py-3 text-base sm:text-lg font-normal font-bebas uppercase border border-black transition-colors rounded-none cursor-pointer <?php echo $is_active ? 'is-active selected bg-black text-white' : 'bg-white text-black hover:bg-neutral-100'; ?>"
                                            style="<?php echo $is_active ? 'background-color:#000000 !important; color:#ffffff !important;' : 'background-color:#ffffff !important; color:#000000 !important;'; ?>"
                                            data-value="<?php echo esc_attr( $option ); ?>"
                                            onclick="window.mazeSelectSize ? window.mazeSelectSize(this, event) : null">
                                        <?php echo esc_html( $option ); ?>
                                    </button>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>

                    <!-- Native WooCommerce Dropdown (kept hidden for WooCommerce variation script) -->
                    <div class="sr-only">
                        <?php
                        wc_dropdown_variation_attribute_options( array(
                            'options'   => $options,
                            'attribute' => $attribute_name,
                            'product'   => $product,
                            'selected'  => $selected_attr,
                        ) );
                        ?>
                    </div>

                    <?php if ( end( $attribute_keys ) === $attribute_name ) : ?>
                        <?php
                        $show_size_chart = true;
                        if ( function_exists( 'mazestreetwear_is_accessory_product' ) && mazestreetwear_is_accessory_product( $product ) ) {
                            $show_size_chart = false;
                        } elseif ( function_exists( 'mazestreetwear_product_has_size_chart' ) && ! mazestreetwear_product_has_size_chart( $product ) ) {
                            $show_size_chart = false;
                        }
                        ?>
                        <div class="maze-variation-actions mt-3 flex flex-wrap items-center gap-3">
                            <?php if ( $show_size_chart ) : ?>
                                <button type="button" 
                                        class="maze-size-chart-trigger inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-black text-white hover:bg-neutral-800 border border-black text-xs font-outfit font-semibold tracking-wider uppercase transition-colors cursor-pointer select-none"
                                        data-active-chart="<?php echo esc_attr( function_exists( 'mazestreetwear_get_current_product_size_chart_key' ) ? mazestreetwear_get_current_product_size_chart_key( $product ) : 'lightning-t-shirt' ); ?>"
                                        onclick="window.mazeOpenSizeChart && window.mazeOpenSizeChart(event, this)"
                                        aria-haspopup="dialog"
                                        aria-controls="maze-size-chart-modal">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 17h18M7 7v4M12 7v3M17 7v4M7 17v-4M12 17v-3M17 17v-4" />
                                    </svg>
                                    <span><?php esc_html_e( 'SIZE CHART', 'mazestreetwear' ); ?></span>
                                </button>
                            <?php endif; ?>
                            <?php
                            echo wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations text-xs font-outfit font-semibold tracking-wider uppercase text-neutral-600 hover:text-black inline-block ml-1" href="#">' . esc_html__( 'CLEAR SELECTION', 'mazestreetwear' ) . '</a>' ) );
                            ?>
                        </div>
                    <?php endif; ?>
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
             * Hook: woocommerce_single_variation.
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

        // 4. Variable Product: find native select and update value
        var targetSelectName = container.getAttribute('data-target-select');
        var select = null;
        if (row) {
            select = row.querySelector('select');
        }
        if (!select && targetSelectName) {
            select = document.getElementById(targetSelectName) || form.querySelector('select[name="attribute_' + targetSelectName + '"]');
        }
        if (!select) {
            select = form.querySelector('select');
        }

        if (select) {
            var matchedVal = selectedVal;
            var options = select.options;
            for (var j = 0; j < options.length; j++) {
                var opt = options[j];
                var optVal = (opt.value || '').trim().toLowerCase();
                var optText = (opt.text || '').trim().toLowerCase();
                var sLower = selectedVal.toLowerCase();
                if (optVal === sLower || optText === sLower) {
                    matchedVal = opt.value;
                    break;
                }
            }
            select.value = matchedVal;

            try {
                select.dispatchEvent(new Event('change', { bubbles: true }));
            } catch (err) {
                var evt = document.createEvent('HTMLEvents');
                evt.initEvent('change', true, true);
                select.dispatchEvent(evt);
            }

            if (window.jQuery) {
                window.jQuery(select).trigger('change');
            }
        }

        var varIdInput = form.querySelector('input[name="variation_id"]');
        var rawVars = form.getAttribute('data-product_variations');
        if (varIdInput && rawVars) {
            try {
                var varsList = JSON.parse(rawVars);
                if (Array.isArray(varsList)) {
                    var sLower = selectedVal.toLowerCase();
                    for (var vi = 0; vi < varsList.length; vi++) {
                        var vObj = varsList[vi];
                        if (vObj && vObj.attributes) {
                            for (var attrK in vObj.attributes) {
                                if (String(vObj.attributes[attrK] || '').toLowerCase() === sLower) {
                                    varIdInput.value = vObj.variation_id;
                                    break;
                                }
                            }
                        }
                    }
                }
            } catch (err) {}
        }

        var addBtn = form.querySelector('.single_add_to_cart_button');
        var buyBtn = form.querySelector('.maze_buy_now_button');
        if (addBtn) {
            addBtn.removeAttribute('disabled');
            addBtn.classList.remove('disabled', 'opacity-60', 'cursor-not-allowed');
        }
        if (buyBtn) {
            buyBtn.removeAttribute('disabled');
            buyBtn.classList.remove('disabled', 'opacity-60', 'cursor-not-allowed');
        }
        var varWrap = form.querySelector('.woocommerce-variation-add-to-cart');
        if (varWrap) {
            varWrap.classList.remove('woocommerce-variation-add-to-cart-disabled');
        }
    }
};
</script>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
