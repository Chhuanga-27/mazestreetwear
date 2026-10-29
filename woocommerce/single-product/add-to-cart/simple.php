<?php

/**
 * Simple product add to cart template override
 *
 * Minimalist rectangular size boxes & full-width "ADD TO BAG" CTA button.
 *
 * @package MazeStreetwear
 * @version 1.1.0
 */

defined('ABSPATH') || exit;

global $product;

if (! $product->is_purchasable()) {
    return;
}

echo wc_get_stock_html($product); // WPCS: XSS ok.

if ($product->is_in_stock()) : ?>

    <?php do_action('woocommerce_before_add_to_cart_form'); ?>

    <form class="cart space-y-6 my-6" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>">
        <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
        <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
        <?php do_action('woocommerce_before_add_to_cart_button'); ?>

        <!-- Sizing Selector: Clean rectangular size boxes with 1px black borders -->
        <?php
        $attributes = $product->get_attributes();
        $has_size_options = false;
        $size_options = array();

        if (! empty($attributes)) {
            foreach ($attributes as $attr_name => $attr) {
                if (false !== stripos($attr_name, 'size') || (is_object($attr) && false !== stripos($attr->get_name(), 'size'))) {
                    $has_size_options = true;
                    if (is_object($attr) && $attr->is_taxonomy()) {
                        $terms = $attr->get_terms();
                        foreach ($terms as $term) {
                            $size_options[] = $term->name;
                        }
                    } elseif (is_object($attr)) {
                        $raw = $attr->get_options();
                        if (! empty($raw) && is_array($raw)) {
                            $size_options = $raw;
                        }
                    }
                    break;
                }
            }
        }

        if (! $has_size_options) {
            $is_sized_cat = true;
            if (function_exists('mazestreetwear_is_accessory_product') && mazestreetwear_is_accessory_product($product)) {
                $is_sized_cat = false;
            } else {
                $cat_ids = $product->get_category_ids();
                if (! empty($cat_ids)) {
                    foreach ($cat_ids as $cid) {
                        $term = get_term($cid, 'product_cat');
                        if ($term && ('accessories' === $term->slug || 'accessory' === $term->slug || false !== stripos($term->name, 'accessory') || false !== stripos($term->name, 'bag') || false !== stripos($term->name, 'cap') || false !== stripos($term->name, 'hat'))) {
                            $is_sized_cat = false;
                            break;
                        }
                    }
                }
            }
            if ($is_sized_cat) {
                $has_size_options = true;
                $size_options = array('S', 'M', 'L', 'XL');
            }
        }

        if ($has_size_options && ! empty($size_options)) :
            $first_size = $size_options[0];
            $show_size_chart = true;
            if (function_exists('mazestreetwear_is_accessory_product') && mazestreetwear_is_accessory_product($product)) {
                $show_size_chart = false;
            } elseif (function_exists('mazestreetwear_product_has_size_chart') && ! mazestreetwear_product_has_size_chart($product)) {
                $show_size_chart = false;
            }
        ?>
            <div class="size-selector-wrap">
                <div class="flex items-center justify-between mb-2.5">
                    <span class="text-base font-bebas uppercase tracking-wider text-black font-normal">
                        <?php esc_html_e('SIZE', 'mazestreetwear'); ?>
                        <span class="selected-size-label ml-2 text-black font-bold font-outfit text-sm">// <?php echo esc_html(strtoupper($first_size)); ?></span>
                    </span>
                </div>
                <input type="hidden" name="selected_size" class="maze-selected-size-input" value="<?php echo esc_attr($first_size); ?>" />
                <div class="maze-size-pills flex flex-wrap gap-2.5">
                    <?php foreach ($size_options as $idx => $s_opt) :
                        $is_s_active = (0 === $idx);
                    ?>
                        <button type="button"
                            class="maze-size-pill px-5 py-3 text-base sm:text-lg font-normal font-bebas uppercase border border-black cursor-pointer transition-colors rounded-none <?php echo $is_s_active ? 'is-active selected bg-black text-white' : 'bg-white text-black hover:bg-neutral-100'; ?>"
                            style="<?php echo $is_s_active ? 'background-color:#000000 !important; color:#ffffff !important;' : 'background-color:#ffffff !important; color:#000000 !important;'; ?>"
                            data-value="<?php echo esc_attr($s_opt); ?>"
                            onclick="window.mazeSelectSize ? window.mazeSelectSize(this, event) : null">
                            <?php echo esc_html($s_opt); ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <?php if ($show_size_chart) : ?>
                    <div class="maze-size-chart-trigger-wrap mt-3">
                        <button type="button"
                            class="maze-size-chart-trigger inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-black text-white hover:bg-neutral-800 border border-black text-xs font-outfit font-semibold tracking-wider uppercase transition-colors cursor-pointer select-none"
                            data-active-chart="<?php echo esc_attr(function_exists('mazestreetwear_get_current_product_size_chart_key') ? mazestreetwear_get_current_product_size_chart_key($product) : 'lightning-t-shirt'); ?>"
                            onclick="window.mazeOpenSizeChart && window.mazeOpenSizeChart(event, this)"
                            aria-haspopup="dialog"
                            aria-controls="maze-size-chart-modal">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 17h18M7 7v4M12 7v3M17 7v4M7 17v-4M12 17v-3M17 17v-4" />
                            </svg>
                            <span><?php esc_html_e('SIZE CHART', 'mazestreetwear'); ?></span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php
        // Hidden quantity set to 1 by default, or render minimal input
        if (! $product->is_sold_individually()) {
            woocommerce_quantity_input(
                array(
                    'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                    'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                    'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                    'classes'     => array('hidden'),
                )
            );
        } else {
        ?>
            <input type="hidden" name="quantity" value="1" />
        <?php
        }
        ?>

        <!-- Action Buttons: ADD TO BAG & BUY NOW -->
        <div class="product-actions-buttons flex flex-col gap-3 pt-2 w-full">
            <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button maze-btn-animated button alt bg-black text-white hover:bg-neutral-800 text-lg sm:text-xl font-normal uppercase tracking-wider py-4 w-full border border-black rounded-none font-bebas transition-all duration-200 cursor-pointer block text-center select-none active:scale-[0.98]" data-default-text="<?php echo esc_attr($product->single_add_to_cart_text() ? $product->single_add_to_cart_text() : __('ADD TO BAG', 'mazestreetwear')); ?>">
                <span class="btn-text"><?php echo esc_html($product->single_add_to_cart_text() ? $product->single_add_to_cart_text() : __('ADD TO BAG', 'mazestreetwear')); ?></span>
            </button>

            <button type="submit" name="maze_buy_now" value="1" class="maze_buy_now_button maze-btn-animated button bg-white text-black hover:bg-black hover:text-white text-lg sm:text-xl font-normal uppercase tracking-wider py-4 w-full border-2 border-black rounded-none font-bebas transition-all duration-200 cursor-pointer block text-center select-none active:scale-[0.98]" data-default-text="<?php esc_attr_e('BUY NOW', 'mazestreetwear'); ?>" onclick="return window.mazeBuyNow ? window.mazeBuyNow(this, event) : true;">
                <span class="btn-text"><?php esc_html_e('BUY NOW', 'mazestreetwear'); ?></span>
            </button>
        </div>

        <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
        <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
        <input type="hidden" name="maze_buy_now" class="maze-buy-now-input" value="0" />

        <?php do_action('woocommerce_after_add_to_cart_button'); ?>
    </form>

    <script>
        window.mazeSelectSize = window.mazeSelectSize || function(btn, event) {
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
            }
        };

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
                formData.set('product_id', '<?php echo absint($product->get_id()); ?>');
                formData.set('add-to-cart', '<?php echo absint($product->get_id()); ?>');
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
                    if (data && data.success === false && !data.data.checkout_url) { HTMLFormElement.prototype.submit.call(form); return; }
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

    <?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>