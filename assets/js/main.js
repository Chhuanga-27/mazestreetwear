/**
 * Maze Streetwear Theme Main JavaScript
 *
 * Handles:
 * - Responsive mobile navigation toggle
 * - Search bar toggle
 * - Interactive streetwear size pills connected to WooCommerce variation form
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

        // --- 3. Interactive Streetwear Size Pills Variation Sync ---
        const $variationsForm = $('.variations_form');

        if ($variationsForm.length) {
            // Pill Click Handler
            $(document).on('click', '.maze-size-pill', function (e) {
                e.preventDefault();
                const $pill = $(this);
                const $container = $pill.closest('.maze-size-pills');
                const targetSelectName = $container.data('target-select');
                const selectedVal = $pill.data('value');

                // Find corresponding WooCommerce select
                let $select = $('select#' + targetSelectName);
                if (!$select.length) {
                    $select = $container.closest('.variation-row').find('select');
                }

                if ($pill.hasClass('is-active')) {
                    // Deselect
                    $pill.removeClass('is-active');
                    if ($select.length) {
                        $select.val('').trigger('change');
                    }
                    $container.closest('.variation-row').find('.selected-variation-value').text('');
                } else {
                    // Select new
                    $container.find('.maze-size-pill').removeClass('is-active');
                    $pill.addClass('is-active');

                    if ($select.length) {
                        $select.val(selectedVal).trigger('change');
                    }

                    // Update visual label
                    $container.closest('.variation-row').find('.selected-variation-value').text('// ' + $pill.text().trim());
                }
            });

            // Sync when WooCommerce resets or changes variations
            $variationsForm.on('reset_data', function () {
                $('.maze-size-pill').removeClass('is-active');
                $('.selected-variation-value').text('');
            });

            // Sync pills when select changes externally
            $variationsForm.on('change', '.variations select', function () {
                const $sel = $(this);
                const val = $sel.val();
                const selId = $sel.attr('id') || $sel.attr('name');
                const $row = $sel.closest('.variation-row');
                const $pills = $row.find('.maze-size-pills');

                if ($pills.length) {
                    $pills.find('.maze-size-pill').removeClass('is-active');
                    if (val) {
                        $pills.find('.maze-size-pill[data-value="' + val + '"]').addClass('is-active');
                        $row.find('.selected-variation-value').text('// ' + val.toUpperCase());
                    }
                }
            });
        }

        // --- 4. Dynamic Bag Counter Pulse on Add To Cart ---
        $(document.body).on('added_to_cart', function (event, fragments, cart_hash, $button) {
            const $counter = $('.maze-cart-count');
            $counter.addClass('scale-125 bg-white text-black');
            setTimeout(function () {
                $counter.removeClass('scale-125 bg-white text-black');
            }, 600);
        });

    });

})(jQuery);
