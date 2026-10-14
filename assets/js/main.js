/**
 * Maze Streetwear Theme Main JavaScript
 *
 * Handles:
 * - Responsive mobile navigation toggle
 * - Search modal toggle
 * - Single product gallery thumbnail switching
 * - Interactive rectangular size boxes (filled black when selected)
 * - Dynamic cart counter animation feedback
 */

(function ($) {
    'use strict';

    $(document).ready(function () {

        // --- 1. Mobile Menu Toggle ---
        const $mobileMenuBtn = $('#maze-mobile-menu-btn');
        const $mobileMenu = $('#maze-mobile-menu');
        const $hamburgerIcon = $('#maze-hamburger-icon');
        const $closeIcon = $('#maze-close-icon');

        if ($mobileMenuBtn.length && $mobileMenu.length) {
            $mobileMenuBtn.on('click', function () {
                const isExpanded = $(this).attr('aria-expanded') === 'true';
                $(this).attr('aria-expanded', !isExpanded);
                $mobileMenu.toggleClass('hidden');
                $hamburgerIcon.toggleClass('hidden');
                $closeIcon.toggleClass('hidden');
            });
        }

        // --- 2. Search Modal Toggle ---
        const $searchToggle = $('#maze-search-toggle');
        const $searchModal = $('#maze-search-modal');

        if ($searchToggle.length && $searchModal.length) {
            $searchToggle.on('click', function () {
                $searchModal.toggleClass('hidden');
                if (!$searchModal.hasClass('hidden')) {
                    $searchModal.find('input[type="search"]').focus();
                }
            });
        }

        // --- 3. Single Product Gallery Thumbnail Switching ---
        $(document).on('click', '.maze-gallery-thumb', function (e) {
            e.preventDefault();
            const $thumb = $(this);
            const newSrc = $thumb.data('img-src');
            const $mainImg = $('#maze-main-product-image');

            if (newSrc && $mainImg.length) {
                $mainImg.attr('src', newSrc);
                $('.maze-gallery-thumb').removeClass('border-black').addClass('border-neutral-300');
                $thumb.removeClass('border-neutral-300').addClass('border-black');
            }
        });

        // --- 4. Interactive Rectangular Size Boxes (Filled Black When Selected) ---
        $(document).on('click', '.maze-size-pill', function (e) {
            e.preventDefault();
            const $pill = $(this);
            const $container = $pill.closest('.maze-size-pills');
            const targetSelectName = $container.data('target-select');
            const selectedVal = $pill.data('value') || $pill.text().trim();

            // Set active state on pill
            $container.find('.maze-size-pill').removeClass('is-active selected');
            $pill.addClass('is-active selected');

            // Update visible label
            const $sizeLabel = $container.closest('.variation-row, .size-selector-wrap').find('.selected-variation-value, .selected-size-label');
            if ($sizeLabel.length) {
                $sizeLabel.text('// ' + selectedVal.toUpperCase());
            }

            // Sync with native select if variable product
            if (targetSelectName) {
                let $select = $('select#' + targetSelectName);
                if (!$select.length) {
                    $select = $container.closest('.variation-row').find('select');
                }
                if ($select.length) {
                    $select.val(selectedVal).trigger('change');
                }
            }
        });

        // Sync when WooCommerce resets or changes variations
        const $variationsForm = $('.variations_form');
        if ($variationsForm.length) {
            $variationsForm.on('reset_data', function () {
                $('.maze-size-pill').removeClass('is-active selected');
                $('.selected-variation-value').text('');
            });

            $variationsForm.on('change', '.variations select', function () {
                const $sel = $(this);
                const val = $sel.val();
                const $row = $sel.closest('.variation-row');
                const $pills = $row.find('.maze-size-pills');

                if ($pills.length && val) {
                    $pills.find('.maze-size-pill').removeClass('is-active selected');
                    $pills.find('.maze-size-pill[data-value="' + val + '"]').addClass('is-active selected');
                    $row.find('.selected-variation-value').text('// ' + val.toUpperCase());
                }
            });
        }

        // --- 5. Dynamic Bag Counter Pulse on Add To Cart ---
        $(document.body).on('added_to_cart', function (event, fragments, cart_hash, $button) {
            const $counter = $('.maze-cart-count');
            if ($counter.length) {
                $counter.addClass('scale-125 ring-2 ring-black');
                setTimeout(function () {
                    $counter.removeClass('scale-125 ring-2 ring-black');
                }, 600);
            }
        });

    });

})(jQuery);
