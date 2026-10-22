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

        <button type="submit" name="maze_buy_now" value="1" class="maze_buy_now_button maze-btn-animated button bg-white text-black hover:bg-black hover:text-white text-lg sm:text-xl font-normal uppercase tracking-wider py-4 w-full border-2 border-black rounded-none font-bebas transition-all duration-200 cursor-pointer block text-center select-none active:scale-[0.98]" data-default-text="<?php esc_attr_e( 'BUY NOW', 'mazestreetwear' ); ?>" onclick="return window.mazeBuyNow ? window.mazeBuyNow(this, event) : true;">
            <span class="btn-text"><?php esc_html_e( 'BUY NOW', 'mazestreetwear' ); ?></span>
        </button>
    </div>

    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

    <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
    <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
    <input type="hidden" name="variation_id" class="variation_id" value="<?php echo absint( $default_var_id ); ?>" />
    <input type="hidden" name="maze_buy_now" class="maze-buy-now-input" value="0" />
</div>

<script>
window.mazeBuyNow = window.mazeBuyNow || function(btn, event) {
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }
    if (!btn) return false;
    if (btn.classList.contains('is-loading')) return false;

    var form = btn.closest('form') || document.querySelector('form.cart');
    var checkoutUrl = (window.mazeData && window.mazeData.checkoutUrl) ? window.mazeData.checkoutUrl : '/checkout/';
    if (!form) {
        window.location.href = checkoutUrl;
        return false;
    }

    btn.classList.add('is-loading', 'opacity-80');
    btn.innerHTML = '<span class="inline-flex items-center justify-center gap-2 font-mono tracking-widest uppercase"><svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg> CHECKING OUT...</span>';

    // Auto-select size pill if none active
    var pills = form.querySelectorAll('.maze-size-pill');
    if (pills && pills.length) {
        var activePill = form.querySelector('.maze-size-pill.is-active, .maze-size-pill.selected');
        if (!activePill) {
            for (var p = 0; p < pills.length; p++) {
                if (!pills[p].classList.contains('disabled') && !pills[p].disabled) {
                    activePill = pills[p];
                    break;
                }
            }
            if (!activePill && pills.length > 0) activePill = pills[0];
            if (activePill && window.mazeSelectSize) {
                window.mazeSelectSize(activePill);
            }
        }
    }

    // Resolve variation_id
    var varIdInput = form.querySelector('input[name="variation_id"]');
    var rawVarId = varIdInput ? parseInt(varIdInput.value, 10) : 0;
    if (!rawVarId || rawVarId <= 0) {
        var rawVars = form.getAttribute('data-product_variations');
        if (rawVars) {
            try {
                var varsList = JSON.parse(rawVars);
                if (Array.isArray(varsList) && varsList.length > 0) {
                    var actPill = form.querySelector('.maze-size-pill.is-active, .maze-size-pill.selected');
                    var actVal = actPill ? (actPill.getAttribute('data-value') || actPill.textContent || '').trim().toLowerCase() : '';
                    var resolvedId = 0;
                    if (actVal) {
                        for (var vi = 0; vi < varsList.length; vi++) {
                            var vObj = varsList[vi];
                            if (vObj && vObj.attributes) {
                                for (var k in vObj.attributes) {
                                    if (String(vObj.attributes[k] || '').toLowerCase() === actVal) {
                                        resolvedId = vObj.variation_id;
                                        break;
                                    }
                                }
                            }
                            if (resolvedId) break;
                        }
                    }
                    if (!resolvedId && varsList[0] && varsList[0].variation_id) {
                        resolvedId = varsList[0].variation_id;
                    }
                    if (resolvedId && varIdInput) {
                        varIdInput.value = resolvedId;
                    }
                }
            } catch (err) {}
        }
    }

    var buyNowInput = form.querySelector('input[name="maze_buy_now"], input.maze-buy-now-input');
    if (buyNowInput) {
        buyNowInput.value = '1';
    }
    form.setAttribute('data-maze-buy-now', 'true');

    if (window.fetch && window.FormData) {
        var formData = new FormData(form);
        formData.set('action', 'maze_ajax_add_to_cart');
        formData.set('is_buy_now', '1');
        formData.set('maze_buy_now', '1');
        if (window.mazeData && window.mazeData.nonce) {
            formData.set('maze_nonce', window.mazeData.nonce);
        }
        if (!formData.get('quantity')) {
            formData.set('quantity', '1');
        }

        var ajaxUrl = (window.mazeData && window.mazeData.ajaxUrl) ? window.mazeData.ajaxUrl : '/wp-admin/admin-ajax.php';
        var fallbackTimer = setTimeout(function() {
            HTMLFormElement.prototype.submit.call(form);
        }, 3500);

        fetch(ajaxUrl, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            clearTimeout(fallbackTimer);
            var target = (data && data.data && data.data.checkout_url) ? data.data.checkout_url : checkoutUrl;
            window.location.href = target;
        })
        .catch(function() {
            clearTimeout(fallbackTimer);
            HTMLFormElement.prototype.submit.call(form);
        });

        return false;
    } else {
        HTMLFormElement.prototype.submit.call(form);
        return false;
    }
};
</script>
