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

        // --- 1. Mobile Mega Menu & Mobile Search Toggles ---
        const $mobileMenuBtn = $('#maze-mobile-menu-btn');
        const $mobileMenu = $('#maze-mobile-menu');
        const $hamburgerIcon = $('#maze-hamburger-icon');
        const $closeIcon = $('#maze-close-icon');
        const $mobileSearchToggle = $('#maze-mobile-search-toggle');
        const $mobileSearchBar = $('#maze-mobile-search-bar');

        function toggleMobileMenu(open) {
            if (!$mobileMenu.length) return;
            const currentlyOpen = !$mobileMenu.hasClass('hidden');
            const shouldOpen = typeof open === 'boolean' ? open : !currentlyOpen;

            if (shouldOpen) {
                // If mobile search bar is open, close it
                if ($mobileSearchBar.length && !$mobileSearchBar.hasClass('hidden')) {
                    $mobileSearchBar.addClass('hidden');
                }
                $mobileMenu.removeClass('hidden');
                $mobileMenuBtn.attr('aria-expanded', 'true');
                $hamburgerIcon.addClass('hidden');
                $closeIcon.removeClass('hidden');
            } else {
                $mobileMenu.addClass('hidden');
                $mobileMenuBtn.attr('aria-expanded', 'false');
                $hamburgerIcon.removeClass('hidden');
                $closeIcon.addClass('hidden');
            }
        }

        function toggleMobileSearch(open) {
            if (!$mobileSearchBar.length) return;
            const currentlyOpen = !$mobileSearchBar.hasClass('hidden');
            const shouldOpen = typeof open === 'boolean' ? open : !currentlyOpen;

            if (shouldOpen) {
                // If mobile mega menu is open, close it
                toggleMobileMenu(false);
                $mobileSearchBar.removeClass('hidden');
                setTimeout(function () {
                    $mobileSearchBar.find('input[type="search"]').trigger('focus');
                }, 100);
            } else {
                $mobileSearchBar.addClass('hidden');
            }
        }

        if ($mobileMenuBtn.length) {
            $mobileMenuBtn.on('click', function (e) {
                e.stopPropagation();
                toggleMobileMenu();
            });
        }

        if ($mobileSearchToggle.length) {
            $mobileSearchToggle.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                toggleMobileSearch();
            });
        }

        // Close mobile dropdown and search bar when clicking outside
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#masthead').length) {
                if ($mobileMenu.length && !$mobileMenu.hasClass('hidden')) {
                    toggleMobileMenu(false);
                }
                if ($mobileSearchBar.length && !$mobileSearchBar.hasClass('hidden')) {
                    toggleMobileSearch(false);
                }
            }
        });

        // Close mobile dropdown and search bar on ESC key
        $(document).on('keydown', function (e) {
            if (e.key === 'Escape') {
                if ($mobileMenu.length && !$mobileMenu.hasClass('hidden')) {
                    toggleMobileMenu(false);
                }
                if ($mobileSearchBar.length && !$mobileSearchBar.hasClass('hidden')) {
                    toggleMobileSearch(false);
                }
            }
        });

        // --- 2. Floating Header Scroll Handler ---
        // On internal pages, header stays permanently pinned and visible (never collapses).
        // On homepage, smoothly stays visible and accessible without sudden disappearing.
        const $masthead = $('#masthead');
        if ($masthead.length) {
            $masthead.removeClass('header--hidden');
            let lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
            let isTicking = false;
            const threshold = 12; // Minimum scroll delta before reacting
            const topBoundary = 35; // Always show header near page top
            const isHomePage = $('body').hasClass('home') || $('body').hasClass('front-page') || $('#primary .maze-hero-bento').length > 0 || $('#primary .h-\\[85vh\\]').length > 0;

            function updateHeaderOnScroll() {
                const currentScrollY = window.pageYOffset || document.documentElement.scrollTop;

                // Never hide while mobile menu is open
                const isMenuOpen = $mobileMenu.length && !$mobileMenu.hasClass('hidden');
                if (isMenuOpen) {
                    lastScrollY = currentScrollY;
                    isTicking = false;
                    return;
                }

                // Internal pages: Always keep header visible and locked
                if (!isHomePage) {
                    $masthead.removeClass('header--hidden');
                    lastScrollY = currentScrollY <= 0 ? 0 : currentScrollY;
                    isTicking = false;
                    return;
                }

                // Homepage: Smoothly show near top or on scroll up
                if (currentScrollY <= topBoundary) {
                    $masthead.removeClass('header--hidden');
                } else if (Math.abs(currentScrollY - lastScrollY) > threshold) {
                    if (currentScrollY > lastScrollY && currentScrollY > 140) {
                        $masthead.addClass('header--hidden');
                    } else if (currentScrollY < lastScrollY) {
                        $masthead.removeClass('header--hidden');
                    }
                }

                lastScrollY = currentScrollY <= 0 ? 0 : currentScrollY;
                isTicking = false;
            }

            $(window).on('scroll', function () {
                if (!isTicking) {
                    window.requestAnimationFrame(updateHeaderOnScroll);
                    isTicking = true;
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
            if ($pill.hasClass('is-disabled') || $pill.is(':disabled')) {
                return;
            }

            const $container = $pill.closest('.maze-size-pills');
            const targetSelectName = $container.data('target-select');
            const selectedVal = String($pill.data('value') || $pill.text().trim());

            // Set active state on pill
            $container.find('.maze-size-pill').removeClass('is-active selected bg-black text-white').addClass('bg-white text-black');
            $pill.addClass('is-active selected bg-black text-white').removeClass('bg-white text-black');

            // Update visible label
            const $sizeLabel = $container.closest('.variation-row, .size-selector-wrap').find('.selected-variation-value, .selected-size-label');
            if ($sizeLabel.length) {
                $sizeLabel.text('// ' + selectedVal.toUpperCase());
            }

            // Update simple product hidden input if present
            const $hiddenInput = $container.closest('form').find('.maze-selected-size-input');
            if ($hiddenInput.length) {
                $hiddenInput.val(selectedVal);
            }

            // Sync with native select if variable product
            if (targetSelectName) {
                let $select = $('select#' + targetSelectName);
                if (!$select.length) {
                    $select = $container.closest('.variation-row').find('select');
                }
                if ($select.length) {
                    // Match option case-insensitively or by slug
                    let matched = false;
                    $select.find('option').each(function () {
                        const optVal = String($(this).val());
                        if (optVal.toLowerCase() === selectedVal.toLowerCase()) {
                            $select.val(optVal).trigger('change');
                            matched = true;
                            return false;
                        }
                    });
                    if (!matched) {
                        $select.val(selectedVal).trigger('change');
                    }
                }
            }
        });

        // Sync when WooCommerce resets or changes variations
        const $variationsForm = $('.variations_form');
        if ($variationsForm.length) {
            $variationsForm.on('reset_data', function () {
                $('.maze-size-pill').removeClass('is-active selected bg-black text-white').addClass('bg-white text-black');
                $('.selected-variation-value').text('');
            });

            $variationsForm.on('change', '.variations select', function () {
                const $sel = $(this);
                const val = String($sel.val() || '');
                const $row = $sel.closest('.variation-row');
                const $pills = $row.find('.maze-size-pills');

                if ($pills.length && val) {
                    $pills.find('.maze-size-pill').removeClass('is-active selected bg-black text-white').addClass('bg-white text-black');
                    $pills.find('.maze-size-pill').each(function () {
                        if (String($(this).data('value')).toLowerCase() === val.toLowerCase()) {
                            $(this).addClass('is-active selected bg-black text-white').removeClass('bg-white text-black');
                        }
                    });
                    $row.find('.selected-variation-value').text('// ' + val.toUpperCase());
                }
            });

            // On initial load: if no variation attribute is active, auto-select the first pill
            $variationsForm.each(function () {
                const $form = $(this);
                $form.find('.variation-row').each(function () {
                    const $row = $(this);
                    const $activePill = $row.find('.maze-size-pill.is-active');
                    if (!$activePill.length) {
                        const $firstPill = $row.find('.maze-size-pill:not(.is-disabled)').first();
                        if ($firstPill.length) {
                            $firstPill.trigger('click');
                        }
                    } else {
                        // Ensure native select has the active value
                        const val = $activePill.data('value');
                        const $sel = $row.find('select');
                        if ($sel.length && val && !$sel.val()) {
                            $sel.val(val).trigger('change');
                        }
                    }
                });
            });
        }

        // --- 5. Cart Badge Synchronization & Stale Fragment Clearer ---
        function syncMazeCartBadge(count) {
            const $counter = $('.maze-cart-count');
            if (!$counter.length) return;

            let num;
            if (typeof count !== 'undefined' && count !== null) {
                num = parseInt(count, 10);
            } else {
                const textVal = $counter.text().trim();
                const dataVal = $counter.attr('data-count');
                num = dataVal ? parseInt(dataVal, 10) : (textVal ? parseInt(textVal, 10) : 0);
            }

            if (isNaN(num) || num <= 0) {
                $counter.text('0').attr('data-count', '0').addClass('hidden').css('display', 'none');
            } else {
                $counter.text(num).attr('data-count', String(num)).removeClass('hidden').css('display', 'inline-flex');
            }
        }

        // Run sync immediately on DOM ready
        syncMazeCartBadge();

        // Detect if WooCommerce session/cookie indicates an empty cart and clear stale sessionStorage fragments
        try {
            const cookies = document.cookie || '';
            const hasCartItems = cookies.indexOf('woocommerce_items_in_cart') !== -1;
            const match = cookies.match(/woocommerce_items_in_cart=([^;]+)/);
            const cookieCount = match ? parseInt(match[1], 10) : 0;

            if (!hasCartItems || cookieCount === 0) {
                if (typeof window.sessionStorage !== 'undefined') {
                    const keysToRemove = [];
                    for (let i = 0; i < sessionStorage.length; i++) {
                        const key = sessionStorage.key(i);
                        if (key && (key.indexOf('wc_fragments') !== -1 || key.indexOf('wc_cart_hash') !== -1)) {
                            keysToRemove.push(key);
                        }
                    }
                    keysToRemove.forEach(function (k) {
                        try { sessionStorage.removeItem(k); } catch (e) {}
                    });
                }
                syncMazeCartBadge(0);
            }
        } catch (e) {}

        // Listen for all WooCommerce cart fragment events
        $(document.body).on('wc_fragments_refreshed wc_fragments_loaded added_to_cart removed_from_cart', function (event, fragments) {
            if (fragments && fragments['span.maze-cart-count']) {
                const $temp = $('<div>').html(fragments['span.maze-cart-count']);
                const count = parseInt($temp.find('.maze-cart-count').text().trim(), 10);
                syncMazeCartBadge(count);
            } else {
                syncMazeCartBadge();
            }
        });

        // Dynamic Bag Counter Pulse on Add To Cart
        $(document.body).on('added_to_cart', function (event, fragments, cart_hash, $button) {
            const $counter = $('.maze-cart-count');
            if ($counter.length) {
                syncMazeCartBadge();
                $counter.addClass('scale-125 ring-2 ring-black');
                setTimeout(function () {
                    $counter.removeClass('scale-125 ring-2 ring-black');
                }, 600);
            }
        });

        // --- 6. Seamless Single-Product AJAX Add To Bag ---
        $(document).on('submit', 'form.cart', function (e) {
            const $form = $(this);
            const $btn = $form.find('.single_add_to_cart_button');

            // Skip external or grouped products
            if ($form.closest('.product-type-external').length) {
                return;
            }

            // For variable products, ensure variation is selected
            if ($form.hasClass('variations_form')) {
                const variationId = parseInt($form.find('input[name="variation_id"]').val(), 10);
                if (!variationId || variationId <= 0) {
                    e.preventDefault();
                    const $pills = $form.find('.maze-size-pills');
                    $pills.addClass('ring-2 ring-black');
                    setTimeout(function () {
                        $pills.removeClass('ring-2 ring-black');
                    }, 1000);
                    return;
                }
            }

            // AJAX add-to-bag submission
            if (typeof mazeData !== 'undefined' && mazeData.ajaxUrl) {
                e.preventDefault();

                if ($btn.hasClass('is-adding') || $btn.prop('disabled')) {
                    return;
                }

                const originalBtnHtml = $btn.html();
                $btn.addClass('is-adding').prop('disabled', true).text('ADDING TO BAG...');

                const formData = new FormData($form[0]);
                formData.append('action', 'maze_ajax_add_to_cart');
                formData.append('security', mazeData.nonce || '');

                if (!formData.has('add-to-cart')) {
                    const addVal = $btn.val() || $form.find('input[name="add-to-cart"]').val() || $form.data('product_id');
                    if (addVal) {
                        formData.append('add-to-cart', addVal);
                    }
                }

                $.ajax({
                    url: mazeData.ajaxUrl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function (response) {
                        if (response && response.fragments) {
                            // Update fragments
                            $.each(response.fragments, function (key, value) {
                                $(key).replaceWith(value);
                            });

                            syncMazeCartBadge();

                            // Pulse badge
                            const $counter = $('.maze-cart-count');
                            $counter.addClass('scale-125 ring-2 ring-black');
                            setTimeout(function () {
                                $counter.removeClass('scale-125 ring-2 ring-black');
                            }, 600);

                            // Success button state
                            $btn.text('ADDED // IN BAG');
                            setTimeout(function () {
                                $btn.removeClass('is-adding').prop('disabled', false).html(originalBtnHtml);
                            }, 1500);

                            $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $btn]);
                        } else if (response && response.success === false) {
                            alert(response.data && response.data.message ? response.data.message : 'Could not add to bag.');
                            $btn.removeClass('is-adding').prop('disabled', false).html(originalBtnHtml);
                        } else {
                            // Graceful fallback
                            $form.off('submit').submit();
                        }
                    },
                    error: function () {
                        // Fallback to standard form submission on network issue
                        $btn.removeClass('is-adding').prop('disabled', false).html(originalBtnHtml);
                        $form.off('submit').submit();
                    }
                });
            }
        });

        // --- 6. Live Time & Status Clock for Footer (Aizawl / India IST) ---
        const $footerClock = $('#maze-footer-clock');
        if ($footerClock.length) {
            function updateMazeFooterClock() {
                try {
                    const now = new Date();
                    const formatted = now.toLocaleTimeString('en-US', {
                        timeZone: 'Asia/Kolkata',
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: true
                    });
                    $footerClock.text(formatted);
                } catch (e) {
                    const now = new Date();
                    let hours = now.getHours();
                    const minutes = String(now.getMinutes()).padStart(2, '0');
                    const ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12 || 12;
                    $footerClock.text(hours + ':' + minutes + ' ' + ampm);
                }
            }
            updateMazeFooterClock();
            setInterval(updateMazeFooterClock, 1000);
        }

    });

})(jQuery);
