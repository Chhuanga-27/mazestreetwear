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

        // --- 1. Mobile Menu & Search Toggles ---
        const $mobileMenuBtn = $('#maze-mobile-menu-btn');
        const $mobileMenu = $('#maze-mobile-menu');
        const $hamburgerIcon = $('#maze-hamburger-icon');
        const $closeIcon = $('#maze-close-icon');
        const $mobileSearchToggle = $('#maze-mobile-search-toggle');

        function toggleMobileMenu(open) {
            if (!$mobileMenu.length) return;
            const currentlyOpen = !$mobileMenu.hasClass('hidden');
            const shouldOpen = typeof open === 'boolean' ? open : !currentlyOpen;

            if (shouldOpen) {
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
                toggleMobileMenu(true);
                setTimeout(function () {
                    $mobileMenu.find('input[type="search"]').focus();
                }, 100);
            });
        }

        // Close mobile dropdown when clicking outside
        $(document).on('click', function (e) {
            if ($mobileMenu.length && !$mobileMenu.hasClass('hidden')) {
                if (!$(e.target).closest('#masthead').length) {
                    toggleMobileMenu(false);
                }
            }
        });

        // Close mobile dropdown on ESC key
        $(document).on('keydown', function (e) {
            if (e.key === 'Escape' && $mobileMenu.length && !$mobileMenu.hasClass('hidden')) {
                toggleMobileMenu(false);
            }
        });

        // --- 2. Floating Header Scroll Hide/Reveal ---
        // Disappears when scrolling down and appears when scrolling up
        const $masthead = $('#masthead');
        if ($masthead.length) {
            let lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
            let isTicking = false;
            const threshold = 8; // Minimum scroll delta before reacting
            const topBoundary = 25; // Always show header near page top

            function updateHeaderOnScroll() {
                const currentScrollY = window.pageYOffset || document.documentElement.scrollTop;

                // Never hide while mobile menu is open
                const isMenuOpen = $mobileMenu.length && !$mobileMenu.hasClass('hidden');
                if (isMenuOpen) {
                    lastScrollY = currentScrollY;
                    isTicking = false;
                    return;
                }

                // If at the very top, always show header
                if (currentScrollY <= topBoundary) {
                    $masthead.removeClass('header--hidden');
                } else if (Math.abs(currentScrollY - lastScrollY) > threshold) {
                    if (currentScrollY > lastScrollY && currentScrollY > 70) {
                        // Scrolling DOWN -> Header disappears
                        $masthead.addClass('header--hidden');
                    } else if (currentScrollY < lastScrollY) {
                        // Scrolling UP -> Header appears
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
