/**
 * Maze Theme Main JavaScript
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
                $mobileMenuBtn.addClass('is-active').attr('aria-expanded', 'true');
                $('body').addClass('mobile-menu-open');
                $hamburgerIcon.hide().addClass('hidden');
                $closeIcon.show().removeClass('hidden');
            } else {
                $mobileMenu.addClass('hidden');
                $mobileMenuBtn.removeClass('is-active').attr('aria-expanded', 'false');
                $('body').removeClass('mobile-menu-open');
                $hamburgerIcon.show().removeClass('hidden');
                $closeIcon.hide().addClass('hidden');
            }

            // Immediately blur button to remove mobile touch sticky hover/focus
            if ($mobileMenuBtn.length && $mobileMenuBtn[0].blur) {
                $mobileMenuBtn[0].blur();
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
                e.preventDefault();
                e.stopPropagation();
                toggleMobileMenu();
            });
        }

        // Close menu when a link inside the mobile menu is tapped
        $mobileMenu.on('click', 'a', function () {
            toggleMobileMenu(false);
        });

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

        // --- 3. Single Product Slidable Gallery & Tab Indicator Navigation ---
        let mazeGalleryAnimId = null;

        function updateTabsUI(index) {
            const tabs = document.querySelectorAll('.maze-gallery-tab-item');
            tabs.forEach(function (tab, i) {
                const bar = tab.querySelector('.maze-tab-bar');
                const isActive = (i === index);
                tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
                if (bar) {
                    if (isActive) {
                        bar.classList.remove('w-6', 'bg-neutral-300', 'hover:bg-neutral-500');
                        bar.classList.add('w-10', 'bg-black');
                    } else {
                        bar.classList.remove('w-10', 'bg-black');
                        bar.classList.add('w-6', 'bg-neutral-300', 'hover:bg-neutral-500');
                    }
                }
            });
        }

        window.mazeGalleryGoTo = function (targetIdx, event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            const sliderEl = document.getElementById('maze-gallery-slider');
            if (!sliderEl) return;

            const slides = sliderEl.querySelectorAll('.maze-gallery-slide');
            const total = slides.length;
            if (total <= 1) return;

            if (targetIdx < 0) targetIdx = 0;
            if (targetIdx >= total) targetIdx = total - 1;

            const slideWidth = sliderEl.clientWidth;
            const targetScroll = targetIdx * slideWidth;
            const startScroll = sliderEl.scrollLeft;
            const distance = targetScroll - startScroll;

            if (Math.abs(distance) < 2) {
                sliderEl.scrollLeft = targetScroll;
                updateTabsUI(targetIdx);
                return;
            }

            // Temporarily turn off CSS scroll snap so it doesn't fight rAF
            sliderEl.style.scrollSnapType = 'none';

            if (mazeGalleryAnimId) {
                cancelAnimationFrame(mazeGalleryAnimId);
            }

            const duration = 260;
            let startTime = null;

            function animateStep(timestamp) {
                if (!startTime) startTime = timestamp;
                const progress = Math.min((timestamp - startTime) / duration, 1);
                // easeOutQuad
                const ease = 1 - (1 - progress) * (1 - progress);
                sliderEl.scrollLeft = Math.round(startScroll + distance * ease);

                if (progress < 1) {
                    mazeGalleryAnimId = requestAnimationFrame(animateStep);
                } else {
                    sliderEl.scrollLeft = targetScroll;
                    sliderEl.style.scrollSnapType = 'x mandatory';
                    mazeGalleryAnimId = null;
                    updateTabsUI(targetIdx);
                }
            }

            mazeGalleryAnimId = requestAnimationFrame(animateStep);
            updateTabsUI(targetIdx);
        };

        window.mazeGalleryPrev = function (event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            const sliderEl = document.getElementById('maze-gallery-slider');
            if (!sliderEl) return;
            const slides = sliderEl.querySelectorAll('.maze-gallery-slide');
            const total = slides.length;
            if (total <= 1) return;

            const slideWidth = sliderEl.clientWidth || 1;
            const currentIdx = Math.round(sliderEl.scrollLeft / slideWidth);
            const prevIdx = currentIdx > 0 ? (currentIdx - 1) : (total - 1);
            window.mazeGalleryGoTo(prevIdx);
        };

        window.mazeGalleryNext = function (event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            const sliderEl = document.getElementById('maze-gallery-slider');
            if (!sliderEl) return;
            const slides = sliderEl.querySelectorAll('.maze-gallery-slide');
            const total = slides.length;
            if (total <= 1) return;

            const slideWidth = sliderEl.clientWidth || 1;
            const currentIdx = Math.round(sliderEl.scrollLeft / slideWidth);
            const nextIdx = (currentIdx < total - 1) ? (currentIdx + 1) : 0;
            window.mazeGalleryGoTo(nextIdx);
        };

        function initProductGallerySlider() {
            const sliderEl = document.getElementById('maze-gallery-slider');
            if (!sliderEl) return;

            const slides = sliderEl.querySelectorAll('.maze-gallery-slide');
            const totalSlides = slides.length;
            if (totalSlides <= 1) return;

            // Direct event listeners on DOM elements
            const prevBtns = document.querySelectorAll('.maze-gallery-prev');
            prevBtns.forEach(function (btn) {
                btn.onclick = function (e) { window.mazeGalleryPrev(e); };
            });

            const nextBtns = document.querySelectorAll('.maze-gallery-next');
            nextBtns.forEach(function (btn) {
                btn.onclick = function (e) { window.mazeGalleryNext(e); };
            });

            const tabBtns = document.querySelectorAll('.maze-gallery-tab-item');
            tabBtns.forEach(function (btn) {
                btn.onclick = function (e) {
                    const target = this.getAttribute('data-slide-target');
                    const idx = parseInt(target, 10);
                    if (!isNaN(idx)) {
                        window.mazeGalleryGoTo(idx, e);
                    }
                };
            });

            // Desktop Mouse Drag Support
            let isDown = false;
            let startX = 0;
            let scrollStart = 0;
            let hasDragged = false;

            sliderEl.addEventListener('mousedown', function (e) {
                if (e.button !== 0) return;
                isDown = true;
                hasDragged = false;
                sliderEl.style.scrollSnapType = 'none';
                sliderEl.style.cursor = 'grabbing';
                startX = e.pageX - sliderEl.offsetLeft;
                scrollStart = sliderEl.scrollLeft;
            });

            window.addEventListener('mouseup', function () {
                if (!isDown) return;
                isDown = false;
                sliderEl.style.cursor = '';
                sliderEl.style.scrollSnapType = 'x mandatory';
                if (hasDragged) {
                    const slideWidth = sliderEl.clientWidth || 1;
                    const activeIdx = Math.max(0, Math.min(Math.round(sliderEl.scrollLeft / slideWidth), totalSlides - 1));
                    window.mazeGalleryGoTo(activeIdx);
                }
            });

            sliderEl.addEventListener('mousemove', function (e) {
                if (!isDown) return;
                const x = e.pageX - sliderEl.offsetLeft;
                const walk = (x - startX) * 1.3;
                if (Math.abs(walk) > 6) {
                    hasDragged = true;
                    e.preventDefault();
                }
                sliderEl.scrollLeft = scrollStart - walk;
            });

            // Touch Swipe & Native Scroll listener on mobile
            let scrollTimer = null;
            sliderEl.addEventListener('scroll', function () {
                if (mazeGalleryAnimId) return;
                if (scrollTimer) clearTimeout(scrollTimer);
                scrollTimer = setTimeout(function () {
                    const slideWidth = sliderEl.clientWidth || 1;
                    const activeIdx = Math.max(0, Math.min(Math.round(sliderEl.scrollLeft / slideWidth), totalSlides - 1));
                    updateTabsUI(activeIdx);
                }, 40);
            }, { passive: true });
        }

        initProductGallerySlider();

        // --- 4. Interactive Rectangular Size Boxes (Filled Black When Selected) ---
        window.mazeSelectSize = function (btn, event) {
            if (event) {
                event.preventDefault();
            }
            if (!btn) return;

            const $pill = $(btn);
            const $container = $pill.closest('.maze-size-pills');
            if (!$container.length) return;

            const targetSelectName = $container.data('target-select');
            const selectedVal = String($pill.data('value') || $pill.text().trim());
            if (!selectedVal) return;

            // 1. Immediately toggle classes & styles on all pills
            $container.find('.maze-size-pill').each(function () {
                $(this).removeClass('is-active selected bg-black text-white').addClass('bg-white text-black');
                this.style.setProperty('background-color', '#ffffff', 'important');
                this.style.setProperty('color', '#000000', 'important');
            });

            $pill.addClass('is-active selected bg-black text-white').removeClass('bg-white text-black');
            btn.style.setProperty('background-color', '#000000', 'important');
            btn.style.setProperty('color', '#ffffff', 'important');

            // 2. Update visible text label (e.g. "// M")
            const $sizeLabel = $container.closest('.variation-row, .size-selector-wrap').find('.selected-variation-value, .selected-size-label');
            if ($sizeLabel.length) {
                $sizeLabel.text('// ' + selectedVal.toUpperCase());
            }

            // 3. Simple Product: update hidden input value
            const $hiddenInput = $container.closest('form').find('.maze-selected-size-input, input[name="selected_size"]');
            if ($hiddenInput.length) {
                $hiddenInput.val(selectedVal);
            }

            // 4. Variable Product: sync with native WooCommerce select
            let $select = $container.closest('.variation-row').find('select');
            if (!$select.length && targetSelectName) {
                $select = $('select[name="attribute_' + targetSelectName + '"], select[data-attribute_name="attribute_' + targetSelectName + '"]');
            }
            if (!$select.length && targetSelectName) {
                const el = document.getElementById(targetSelectName);
                if (el) $select = $(el);
            }
            if (!$select.length) {
                $select = $container.closest('form').find('select');
            }

            if ($select.length) {
                let matchedVal = selectedVal;
                $select.find('option').each(function () {
                    const optVal = String($(this).val() || '').trim();
                    const optText = String($(this).text() || '').trim();
                    if (optVal && (optVal.toLowerCase() === selectedVal.toLowerCase() || optText.toLowerCase() === selectedVal.toLowerCase())) {
                        matchedVal = optVal;
                        return false;
                    }
                });
                $select.val(matchedVal).trigger('change');
            }

            // Immediately enable add to cart and buy now buttons
            const $form = $container.closest('form');
            if ($form.length) {
                $form.find('.single_add_to_cart_button, .maze_buy_now_button')
                    .removeClass('disabled opacity-60 cursor-not-allowed')
                    .prop('disabled', false);
            }
        };

        // Delegate click on size pills
        $(document).on('click', '.maze-size-pill', function (e) {
            window.mazeSelectSize(this, e);
        });

        // Sync pills when native WooCommerce select changes (e.g. programmatically or via browser)
        $(document).on('change', 'form.variations_form select', function () {
            const $sel = $(this);
            const val = String($sel.val() || '').trim();
            const $row = $sel.closest('.variation-row');
            const $pills = $row.find('.maze-size-pills');

            if ($pills.length) {
                if (!val) {
                    $pills.find('.maze-size-pill').each(function () {
                        $(this).removeClass('is-active selected bg-black text-white').addClass('bg-white text-black');
                        this.style.setProperty('background-color', '#ffffff', 'important');
                        this.style.setProperty('color', '#000000', 'important');
                    });
                    $row.find('.selected-variation-value').text('');
                } else {
                    $pills.find('.maze-size-pill').each(function () {
                        const pillVal = String($(this).data('value') || $(this).text().trim()).toLowerCase();
                        if (pillVal === val.toLowerCase()) {
                            $(this).addClass('is-active selected bg-black text-white').removeClass('bg-white text-black');
                            this.style.setProperty('background-color', '#000000', 'important');
                            this.style.setProperty('color', '#ffffff', 'important');
                        } else {
                            $(this).removeClass('is-active selected bg-black text-white').addClass('bg-white text-black');
                            this.style.setProperty('background-color', '#ffffff', 'important');
                            this.style.setProperty('color', '#000000', 'important');
                        }
                    });
                    $row.find('.selected-variation-value').text('// ' + val.toUpperCase());
                }
            }
        });

        // Clear button listener: unselect all pills when user explicitly clicks "CLEAR SELECTION"
        $(document).on('click', '.reset_variations', function () {
            const $form = $(this).closest('form.variations_form');
            $form.find('.maze-size-pill').each(function () {
                $(this).removeClass('is-active selected bg-black text-white').addClass('bg-white text-black');
                this.style.setProperty('background-color', '#ffffff', 'important');
                this.style.setProperty('color', '#000000', 'important');
            });
            $form.find('.selected-variation-value').text('');
        });

        // Sync variation image and handle out-of-stock feedback when a variation is matched
        $(document).on('found_variation', 'form.variations_form', function (event, variation) {
            if (variation && variation.image && variation.image.src) {
                const $mainImg = $('#maze-main-product-image');
                if ($mainImg.length) {
                    $mainImg.attr('src', variation.image.full_src || variation.image.src);
                    const sliderEl = document.getElementById('maze-gallery-slider');
                    if (sliderEl) {
                        sliderEl.scrollTo({ left: 0, behavior: 'smooth' });
                    }
                }
            }

            const $form = $(this);
            const $btn = $form.find('.single_add_to_cart_button');
            const $buyNowBtn = $form.find('.maze_buy_now_button');
            const defaultBtnText = $btn.data('default-text') || $btn.text().trim() || 'ADD TO BAG';
            if (!$btn.data('default-text')) {
                $btn.data('default-text', defaultBtnText);
            }
            const defaultBuyNowText = $buyNowBtn.data('default-text') || $buyNowBtn.text().trim() || 'BUY NOW';
            if (!$buyNowBtn.data('default-text')) {
                $buyNowBtn.data('default-text', defaultBuyNowText);
            }

            if (variation && variation.is_in_stock === false) {
                const $avail = $form.find('.woocommerce-variation-availability');
                if ($avail.length && !$avail.find('.stock.out-of-stock').length) {
                    $avail.html('<p class="stock out-of-stock">Out of stock</p>');
                }
                $btn.text('OUT OF STOCK').addClass('disabled opacity-60 cursor-not-allowed').prop('disabled', true);
                $buyNowBtn.addClass('disabled opacity-60 cursor-not-allowed').prop('disabled', true);
            } else if (variation && variation.is_purchasable && variation.is_in_stock) {
                $btn.html('<span class="btn-text">' + defaultBtnText + '</span>').removeClass('disabled opacity-60 cursor-not-allowed').prop('disabled', false);
                $buyNowBtn.html('<span class="btn-text">' + defaultBuyNowText + '</span>').removeClass('disabled opacity-60 cursor-not-allowed').prop('disabled', false);
            }
        });

        $(document).on('reset_data', 'form.variations_form', function () {
            const $form = $(this);
            const $btn = $form.find('.single_add_to_cart_button');
            const $buyNowBtn = $form.find('.maze_buy_now_button');
            const defaultBtnText = $btn.data('default-text') || 'ADD TO BAG';
            const defaultBuyNowText = $buyNowBtn.data('default-text') || 'BUY NOW';
            $btn.html('<span class="btn-text">' + defaultBtnText + '</span>').removeClass('opacity-60 cursor-not-allowed');
            $buyNowBtn.html('<span class="btn-text">' + defaultBuyNowText + '</span>').removeClass('opacity-60 cursor-not-allowed');
        });

        // Initialize variation pills on page ready
        function initVariationPills() {
            $('form.variations_form').each(function () {
                const $form = $(this);
                $form.find('.variation-row').each(function () {
                    const $row = $(this);
                    const $select = $row.find('select');
                    let $activePill = $row.find('.maze-size-pill.is-active');

                    if ($activePill.length) {
                        const val = String($activePill.data('value') || $activePill.text().trim());
                        if ($select.length && (!$select.val() || $select.val().toLowerCase() !== val.toLowerCase())) {
                            let matchedVal = val;
                            $select.find('option').each(function () {
                                const optVal = String($(this).val() || '').trim();
                                const optText = String($(this).text() || '').trim();
                                if (optVal && (optVal.toLowerCase() === val.toLowerCase() || optText.toLowerCase() === val.toLowerCase())) {
                                    matchedVal = optVal;
                                    return false;
                                }
                            });
                            $select.val(matchedVal).trigger('change');
                        }
                    } else if ($select.length && $select.val()) {
                        const curVal = String($select.val()).toLowerCase();
                        $row.find('.maze-size-pill').each(function () {
                            const pVal = String($(this).data('value') || $(this).text().trim()).toLowerCase();
                            if (pVal === curVal) {
                                $(this).addClass('is-active selected bg-black text-white').removeClass('bg-white text-black');
                                $row.find('.selected-variation-value').text('// ' + curVal.toUpperCase());
                            }
                        });
                    } else {
                        // Pre-select first in-stock or available size box
                        let $firstInStock = null;
                        $row.find('.maze-size-pill').each(function () {
                            const $p = $(this);
                            if (!$p.hasClass('disabled') && !$p.hasClass('is-disabled') && !$p.hasClass('opacity-30') && !$p.prop('disabled')) {
                                if (!$firstInStock) $firstInStock = $p;
                            }
                        });
                        const $targetPill = $firstInStock || $row.find('.maze-size-pill').first();
                        if ($targetPill && $targetPill.length) {
                            if (window.mazeSelectSize) {
                                window.mazeSelectSize($targetPill[0]);
                            } else {
                                $targetPill.trigger('click');
                            }
                        }
                    }
                });
            });
        }
        initVariationPills();
        setTimeout(initVariationPills, 120);

        // --- Size Guide / Sizing Chart Modal Handlers ---
        // Ensure legacy tabs from cached HTML are purged immediately
        $('.maze-size-chart-tabs, .maze-size-chart-tab').remove();

        // If currently viewing an accessory product, purge any size chart triggers and modal
        if ($('body').hasClass('is-accessory-product') || $('body').hasClass('product_cat-accessories') || $('body').hasClass('term-accessories')) {
            $('.maze-size-chart-trigger, .maze-size-chart-trigger-wrap, #maze-size-chart-modal').remove();
        }

        $(document).on('click', '.maze-size-chart-trigger', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $('.maze-size-chart-tabs, .maze-size-chart-tab').remove();
            if (window.mazeOpenSizeChart) {
                window.mazeOpenSizeChart(e, this);
            }
        });

        $(document).on('click', '.maze-size-chart-close', function (e) {
            e.preventDefault();
            if (window.mazeCloseSizeChart) {
                window.mazeCloseSizeChart(e);
            }
        });

        $(document).on('click', '.maze-size-chart-tab', function (e) {
            e.preventDefault();
            const target = $(this).data('chart-target') || $(this).attr('data-chart-target');
            if (window.mazeSwitchSizeChartTab) {
                window.mazeSwitchSizeChartTab(target, e);
            }
        });

        $(document).on('click', '#maze-size-chart-modal', function (e) {
            if ($(e.target).is('#maze-size-chart-modal')) {
                if (window.mazeCloseSizeChart) {
                    window.mazeCloseSizeChart(e);
                }
            }
        });

        // --- 5. Comprehensive Cart Synchronization (Store API + Cart Blocks + Classic Cart) ---

        // Extract total items count from Store API response, Cart data, or WooCommerce fragments
        function extractMazeCartCount(data) {
            if (!data || typeof data !== 'object') return null;

            if (typeof data.items_count === 'number') return data.items_count;
            if (typeof data.itemsCount === 'number') return data.itemsCount;
            if (typeof data.cart_count === 'number') return data.cart_count;
            if (typeof data.count === 'number') return data.count;

            if (data.totals && typeof data.totals.total_items !== 'undefined') {
                const t = parseInt(data.totals.total_items, 10);
                if (!isNaN(t)) return t;
            }

            if (Array.isArray(data.items)) {
                return data.items.reduce(function (sum, item) {
                    const q = parseInt(item.quantity, 10);
                    return sum + (!isNaN(q) && q > 0 ? q : 1);
                }, 0);
            }

            if (data.fragments && data.fragments['span.maze-cart-count']) {
                const $temp = $('<div>').html(data.fragments['span.maze-cart-count']);
                const c = parseInt($temp.find('.maze-cart-count').text().trim(), 10);
                if (!isNaN(c)) return c;
            }

            return null;
        }

        // Keep WooCommerce sessionStorage fragments aligned so navigating pages never restores stale count
        function updateWcFragmentsInSessionStorage(count) {
            try {
                if (!window.sessionStorage) return;
                const isHidden = (count <= 0);
                const countStr = String(count);
                const newHtml = '<span class="maze-cart-count absolute -top-1.5 -right-2.5 inline-flex items-center justify-center min-w-[18px] h-[18px] px-1 text-[10px] font-mono font-bold tracking-tight text-white bg-black border border-white rounded-full transition-all duration-200 ' + (isHidden ? 'hidden' : 'scale-100') + '" data-count="' + countStr + '"' + (isHidden ? ' style="display:none;"' : '') + '>' + countStr + '</span>';

                for (let i = 0; i < sessionStorage.length; i++) {
                    const key = sessionStorage.key(i);
                    if (key && (key.indexOf('wc_fragments') !== -1 || key.indexOf('wc_cart_hash') !== -1)) {
                        const item = sessionStorage.getItem(key);
                        if (item && item.indexOf('{') !== -1) {
                            try {
                                const parsed = JSON.parse(item);
                                if (parsed && typeof parsed === 'object') {
                                    parsed['span.maze-cart-count'] = newHtml;
                                    sessionStorage.setItem(key, JSON.stringify(parsed));
                                }
                            } catch (e) { }
                        }
                    }
                }
            } catch (e) { }
        }

        // Clear stale fragments cache when explicit desync is detected
        function clearWcFragmentsCache() {
            try {
                if (!window.sessionStorage) return;
                for (let i = sessionStorage.length - 1; i >= 0; i--) {
                    const key = sessionStorage.key(i);
                    if (key && (key.indexOf('wc_fragments') !== -1 || key.indexOf('wc_cart_hash') !== -1)) {
                        sessionStorage.removeItem(key);
                    }
                }
            } catch (e) { }
        }

        // Live visual update of the shopping bag counter badge in the header
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
                updateWcFragmentsInSessionStorage(0);
            } else {
                $counter.text(num).attr('data-count', String(num)).removeClass('hidden').css('display', 'inline-flex');
                updateWcFragmentsInSessionStorage(num);
            }
        }

        // Bag Counter Pulse Animation
        function pulseMazeCartBadge() {
            const $counter = $('.maze-cart-count');
            if ($counter.length && !$counter.hasClass('hidden')) {
                $counter.addClass('scale-125 ring-2 ring-black');
                setTimeout(function () {
                    $counter.removeClass('scale-125 ring-2 ring-black');
                }, 400);
            }
        }

        // Calculate quantity directly from rendered DOM items (supports both Cart Block and Classic Cart)
        function calculateCartQuantityFromDOM(excludeElement) {
            const $cartBlock = $('.wp-block-woocommerce-cart, .wc-block-cart');
            const $classicForm = $('.woocommerce-cart-form');

            if (!$cartBlock.length && !$classicForm.length) {
                return null;
            }

            // Check if cart is in empty state
            if ($('.wc-block-cart__empty-cart-wrapper, .cart-empty, .wc-block-cart--is-empty').length) {
                return 0;
            }

            let total = 0;
            let rowsFound = false;

            // 1. Check WooCommerce Cart Block rows
            const $blockRows = $('.wc-block-cart-items__row, .wc-block-cart-item, [class*="wc-block-cart-items__row"]');
            if ($blockRows.length) {
                rowsFound = true;
                $blockRows.each(function () {
                    if (excludeElement && (this === excludeElement || $.contains(this, excludeElement) || $.contains(excludeElement, this))) {
                        return; // Skip item currently being deleted
                    }
                    const $input = $(this).find('input.wc-block-components-quantity-selector__input, input[type="number"]');
                    if ($input.length) {
                        const q = parseInt($input.val(), 10);
                        total += (!isNaN(q) && q > 0) ? q : 1;
                    } else {
                        total += 1;
                    }
                });
                return total;
            }

            // 2. Check Classic WooCommerce Cart rows
            const $classicRows = $classicForm.find('.cart_item');
            if ($classicRows.length) {
                rowsFound = true;
                $classicRows.each(function () {
                    if (excludeElement && (this === excludeElement || $.contains(this, excludeElement) || $.contains(excludeElement, this))) {
                        return; // Skip item currently being deleted
                    }
                    const $input = $(this).find('input.qty');
                    if ($input.length) {
                        const q = parseInt($input.val(), 10);
                        total += (!isNaN(q) && q > 0) ? q : 1;
                    } else {
                        total += 1;
                    }
                });
                return total;
            }

            if (!rowsFound && ($cartBlock.length || $classicForm.length)) {
                return 0;
            }

            return null;
        }

        // Fallback: Fetch refreshed fragments from server endpoint
        function refreshMazeCartFragments() {
            const endpointUrl = (window.wc_cart_fragments_params && window.wc_cart_fragments_params.wc_ajax_url)
                ? window.wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments')
                : ((typeof mazeData !== 'undefined' && mazeData.ajaxUrl)
                    ? mazeData.ajaxUrl + '?action=maze_get_cart_fragments'
                    : '/?wc-ajax=get_refreshed_fragments');

            $.ajax({
                url: endpointUrl,
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    const count = extractMazeCartCount(data);
                    if (count !== null) {
                        syncMazeCartBadge(count);
                    }
                    if (data && data.fragments) {
                        $.each(data.fragments, function (key, val) {
                            $(key).replaceWith(val);
                        });
                        syncMazeCartBadge(count);
                    }
                }
            });
        }

        // Intercept Store API via window.fetch (captures Gutenberg/React Cart Block API requests)
        if (window.fetch) {
            const originalFetch = window.fetch;
            window.fetch = function () {
                const url = (arguments[0] && typeof arguments[0] === 'string')
                    ? arguments[0]
                    : (arguments[0] && arguments[0].url ? arguments[0].url : '');

                const promise = originalFetch.apply(this, arguments);

                if (url && (url.indexOf('/wc/store/') !== -1 || url.indexOf('wc-ajax=') !== -1 || url.indexOf('maze_get_cart_fragments') !== -1)) {
                    promise.then(function (res) {
                        try {
                            const clone = res.clone();
                            clone.json().then(function (data) {
                                const count = extractMazeCartCount(data);
                                if (count !== null) {
                                    syncMazeCartBadge(count);
                                    pulseMazeCartBadge();
                                }
                            }).catch(function () { });
                        } catch (e) { }
                    }).catch(function () { });
                }

                return promise;
            };
        }

        // Intercept Store API via XMLHttpRequest
        (function interceptXhr() {
            const originalOpen = XMLHttpRequest.prototype.open;
            const originalSend = XMLHttpRequest.prototype.send;

            XMLHttpRequest.prototype.open = function (method, url) {
                this._mazeRequestUrl = url;
                return originalOpen.apply(this, arguments);
            };

            XMLHttpRequest.prototype.send = function () {
                this.addEventListener('load', function () {
                    try {
                        if (this._mazeRequestUrl && (this._mazeRequestUrl.indexOf('/wc/store/') !== -1 || this._mazeRequestUrl.indexOf('wc-ajax=') !== -1)) {
                            const data = JSON.parse(this.responseText);
                            const count = extractMazeCartCount(data);
                            if (count !== null) {
                                syncMazeCartBadge(count);
                                pulseMazeCartBadge();
                            }
                        }
                    } catch (e) { }
                });
                return originalSend.apply(this, arguments);
            };
        })();

        // Intercept Store API via WordPress apiFetch middleware if available
        if (window.wp && window.wp.apiFetch && typeof window.wp.apiFetch.use === 'function') {
            try {
                window.wp.apiFetch.use(function (options, next) {
                    return next(options).then(function (response) {
                        try {
                            const count = extractMazeCartCount(response);
                            if (count !== null) {
                                syncMazeCartBadge(count);
                                pulseMazeCartBadge();
                            }
                        } catch (e) { }
                        return response;
                    });
                });
            } catch (e) { }
        }

        // Subscribe to WordPress Gutenberg Data Store (`wc/store/cart`)
        function initWpCartDataSubscription() {
            if (!window.wp || !window.wp.data || typeof window.wp.data.subscribe !== 'function') return false;

            const cartStore = (window.wc && window.wc.wcBlocksData && window.wc.wcBlocksData.cartStore)
                ? window.wc.wcBlocksData.cartStore
                : 'wc/store/cart';

            try {
                const store = window.wp.data.select(cartStore); 
                if (!store || typeof store.getCartData !== 'function') return false;
            } catch (e) {
                return false;
            }

            let lastSeenCount = null;
            try {
                window.wp.data.subscribe(function () {
                    try {
                        const store = window.wp.data.select(cartStore);
                        if (!store || typeof store.getCartData !== 'function') return;
                        const cartData = store.getCartData();
                        const count = extractMazeCartCount(cartData);
                        if (count !== null && count !== lastSeenCount) {
                            lastSeenCount = count;
                            syncMazeCartBadge(count);
                        }
                    } catch (err) { }
                });
                return true;
            } catch (e) {
                return false;
            }
        }

        // Retry subscription setup to account for asynchronous Gutenberg script loading
        let wpSubTries = 0;
        const wpSubInterval = setInterval(function () {
            wpSubTries++;
            if (initWpCartDataSubscription() || wpSubTries > 30) {
                clearInterval(wpSubInterval);
            }
        }, 150);

        // 1. Instant 0ms Optimistic Update on clicking Delete / Trash / Remove button (Cart Block & Classic Cart)
        $(document).on('click', [
            '.wc-block-cart-item__remove-link',
            '.wc-block-cart__remove-item',
            'button.wc-block-cart-item__remove-link',
            'button[class*="remove-link"]',
            'button[class*="remove_link"]',
            'button[class*="remove-item"]',
            'button[class*="remove_item"]',
            'button[aria-label*="Remove" i]',
            'button[aria-label*="Delete" i]',
            '.woocommerce-cart-form a.remove',
            'a.remove_from_cart_button',
            'a.remove'
        ].join(', '), function () {
            const $btn = $(this);
            const $row = $btn.closest('.wc-block-cart-items__row, .wc-block-cart-item, tr.cart_item, tr, li.wc-block-cart-item, [class*="cart-item"]');
            const targetEl = $row.length ? $row[0] : this;

            // Recalculate remaining count excluding the item being removed
            const remainingCount = calculateCartQuantityFromDOM(targetEl);
            if (remainingCount !== null) {
                syncMazeCartBadge(remainingCount);
            } else {
                let removedQty = 1;
                if ($row.length) {
                    const $qty = $row.find('input.wc-block-components-quantity-selector__input, input.qty, input[type="number"]');
                    if ($qty.length) {
                        const q = parseInt($qty.val(), 10);
                        if (!isNaN(q) && q > 0) removedQty = q;
                    }
                }
                const current = parseInt($('.maze-cart-count').first().attr('data-count') || $('.maze-cart-count').first().text().trim(), 10) || 0;
                syncMazeCartBadge(Math.max(0, current - removedQty));
            }
            clearWcFragmentsCache();
        });

        // 2. Quantity adjustment buttons (+ / -) & input listeners
        $(document).on('click', '.wc-block-components-quantity-selector__button--plus, button[class*="quantity-selector__button--plus"]', function () {
            setTimeout(function () {
                const count = calculateCartQuantityFromDOM();
                if (count !== null) syncMazeCartBadge(count);
            }, 50);
        });

        $(document).on('click', '.wc-block-components-quantity-selector__button--minus, button[class*="quantity-selector__button--minus"]', function () {
            setTimeout(function () {
                const count = calculateCartQuantityFromDOM();
                if (count !== null) syncMazeCartBadge(count);
            }, 50);
        });

        $(document).on('change input blur', 'input.wc-block-components-quantity-selector__input, input.qty', function () {
            setTimeout(function () {
                const count = calculateCartQuantityFromDOM();
                if (count !== null) syncMazeCartBadge(count);
            }, 60);
        });

        // 3. MutationObserver on Cart Block container to catch DOM mutations automatically
        function initCartBlockObserver() {
            const target = document.querySelector('.wp-block-woocommerce-cart, .wc-block-cart, .woocommerce-cart-form, main#primary');
            if (!target) return;

            let debounceTimer = null;
            const observer = new MutationObserver(function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function () {
                    const count = calculateCartQuantityFromDOM();
                    if (count !== null) {
                        syncMazeCartBadge(count);
                    }
                }, 80);
            });

            observer.observe(target, { childList: true, subtree: true });
        }
        initCartBlockObserver();

        // 4. Native WooCommerce Blocks CustomEvents & Classic jQuery Cart Mutation Events
        const cartEvents = [
            'wc_fragments_refreshed',
            'wc_fragments_loaded',
            'added_to_cart',
            'removed_from_cart',
            'updated_wc_div',
            'updated_cart_totals',
            'wc-blocks_added_to_cart',
            'wc-blocks_cart_item_removed',
            'wc-blocks_cart_item_quantity_changed'
        ].join(' ');

        $(document.body).on(cartEvents, function (event, fragments) {
            if (fragments && fragments['span.maze-cart-count']) {
                const $temp = $('<div>').html(fragments['span.maze-cart-count']);
                const count = parseInt($temp.find('.maze-cart-count').text().trim(), 10);
                syncMazeCartBadge(count);
            } else {
                const pageQty = calculateCartQuantityFromDOM();
                if (pageQty !== null) {
                    syncMazeCartBadge(pageQty);
                } else {
                    refreshMazeCartFragments();
                }
            }
        });

        // Bag Counter Pulse & View Cart display on Add To Cart
        $(document.body).on('added_to_cart wc-blocks_added_to_cart', function (event, fragments, cart_hash, $button) {
            pulseMazeCartBadge();
            // Strictly remove any View Cart link under the Buy Now button or outside the buttons container
            $('.maze-view-cart-wrap').remove();
            $('.maze_buy_now_button').next('.added_to_cart, .maze-view-cart-link').remove();
            $('.product-actions-buttons').next('.added_to_cart, .maze-view-cart-link').remove();

            // Style and dedup any link placed right after Add To Bag button
            if ($button && $button.length) {
                $button.removeClass('added');
                const $form = $button.closest('form.cart');
                if ($form.length) {
                    setTimeout(function () {
                        $('.maze-view-cart-wrap').remove();
                        $('.maze_buy_now_button').next('.added_to_cart, .maze-view-cart-link').remove();
                        $('.product-actions-buttons').next('.added_to_cart, .maze-view-cart-link').remove();
                        const $allCartLinks = $form.find('.added_to_cart, .maze-view-cart-link');
                        if ($allCartLinks.length > 1) {
                            $allCartLinks.slice(1).remove();
                        }
                    }, 40);
                }
            }
        });

        // Initial sync on DOM ready (if on Cart page with items already rendered, sync with actual items)
        const initialCartPageQty = calculateCartQuantityFromDOM();
        if (initialCartPageQty !== null) {
            syncMazeCartBadge(initialCartPageQty);
        } else {
            syncMazeCartBadge();
        }

        // Cleanup any stray WooCommerce added-to-cart banners on page load
        $('.woocommerce-message').filter(function () {
            return $(this).find('.wc-forward, a[href*="cart"]').length > 0 || $(this).text().toLowerCase().indexOf('added to your cart') !== -1;
        }).remove();

        // Dynamic ripple effect & click pop micro-animation on streetwear action buttons
        $(document).on('click', '.maze-btn-animated', function (e) {
            const $btn = $(this);
            if ($btn.prop('disabled') || $btn.hasClass('disabled')) return;

            $btn.removeClass('maze-btn-pop');
            void $btn[0].offsetWidth; // trigger reflow
            $btn.addClass('maze-btn-pop');

            // Dynamic micro-ripple wave
            const rect = this.getBoundingClientRect();
            const x = (e.clientX !== undefined && e.clientX > 0) ? (e.clientX - rect.left) : (rect.width / 2);
            const y = (e.clientY !== undefined && e.clientY > 0) ? (e.clientY - rect.top) : (rect.height / 2);
            const size = Math.max(rect.width, rect.height) * 1.5;
            const isDark = $btn.hasClass('bg-black') || $btn.css('background-color') === 'rgb(0, 0, 0)';

            const $ripple = $('<span class="maze-ripple-effect"></span>');
            $ripple.css({
                width: size + 'px',
                height: size + 'px',
                left: (x - size / 2) + 'px',
                top: (y - size / 2) + 'px',
                backgroundColor: isDark ? 'rgba(255, 255, 255, 0.35)' : 'rgba(0, 0, 0, 0.2)'
            });

            $btn.append($ripple);
            setTimeout(function () {
                $ripple.remove();
            }, 600);
        });

        // =====================================================================
        // BUY NOW — Unified, Bulletproof handler
        // 1. Immediately shows visual spinner on button
        // 2. Ensures selected size / variation is resolved
        // 3. Sends AJAX add-to-cart request keeping all existing items in cart
        // 4. Redirects to /checkout/ immediately
        // 5. If AJAX hangs or fails, uses native HTML form submit to checkout
        // =====================================================================
        window.mazeBuyNow = function (btn, event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            if (!btn) return false;
            const $buyBtn = $(btn);
            if ($buyBtn.hasClass('is-loading')) return false;

            const $form = $buyBtn.closest('form');
            const checkoutUrl = (typeof mazeData !== 'undefined' && mazeData.checkoutUrl) ? mazeData.checkoutUrl : '/checkout/';
            const defaultBtnText = $buyBtn.data('default-text') || 'BUY NOW';

            if (!$form.length) {
                window.location.href = checkoutUrl;
                return false;
            }

            // --- 1. Immediate visual feedback ---
            $buyBtn.addClass('is-loading opacity-80').prop('disabled', true);
            $buyBtn.html('<span class="inline-flex items-center justify-center gap-2 font-mono tracking-widest uppercase"><svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg> CHECKING OUT...</span>');

            const $submitBtn = $form.find('.single_add_to_cart_button');
            if ($submitBtn.length) $submitBtn.prop('disabled', true);

            // --- 2. Ensure size/variation pill is active ---
            const $pills = $form.find('.maze-size-pills');
            if ($pills.length && !$pills.find('.maze-size-pill.is-active, .maze-size-pill.selected').length) {
                const $firstPill = $pills.find('.maze-size-pill:not(.is-disabled, .disabled, [disabled], .opacity-30)').first();
                const $targetPill = $firstPill.length ? $firstPill : $pills.find('.maze-size-pill').first();
                if ($targetPill.length) {
                    if (window.mazeSelectSize) {
                        window.mazeSelectSize($targetPill[0]);
                    } else {
                        $targetPill.trigger('click');
                    }
                }
            }

            // --- 3. Sync select values from active pills for variable products ---
            $form.find('.variation-row').each(function () {
                const $row = $(this);
                const $activePill = $row.find('.maze-size-pill.is-active, .maze-size-pill.selected');
                const $select = $row.find('select');
                if ($activePill.length && $select.length) {
                    const val = String($activePill.data('value') || $activePill.text().trim());
                    $select.find('option').each(function () {
                        const optVal = String($(this).val() || '').trim();
                        const optText = String($(this).text() || '').trim();
                        if (optVal && (optVal.toLowerCase() === val.toLowerCase() || optText.toLowerCase() === val.toLowerCase())) {
                            $select.val(optVal).trigger('change');
                            return false;
                        }
                    });
                }
            });

            // --- 4. Resolve variation_id if not yet populated ---
            let $varIdInput = $form.find('input[name="variation_id"]');
            let resolvedVarId = parseInt($varIdInput.val(), 10) || 0;
            if (!resolvedVarId || resolvedVarId <= 0) {
                const variations = $form.data('product_variations');
                if (Array.isArray(variations) && variations.length > 0) {
                    const selectedAttrs = {};
                    $form.find('.variation-row').each(function () {
                        const $row = $(this);
                        const $select = $row.find('select');
                        const $activePill = $row.find('.maze-size-pill.is-active, .maze-size-pill.selected');
                        let attrName = $select.length ? ($select.attr('data-attribute_name') || $select.attr('name') || '') : '';
                        if (!attrName) {
                            const rowAttr = $row.data('attribute') || '';
                            if (rowAttr) attrName = 'attribute_' + rowAttr;
                        }
                        let attrVal = '';
                        if ($select.length && $select.val()) {
                            attrVal = String($select.val()).toLowerCase();
                        } else if ($activePill.length) {
                            attrVal = String($activePill.data('value') || $activePill.text().trim() || '').toLowerCase();
                        }
                        if (attrName && attrVal) {
                            selectedAttrs[attrName] = attrVal;
                        }
                    });

                    const selectedKeys = Object.keys(selectedAttrs);
                    if (selectedKeys.length > 0) {
                        for (let v = 0; v < variations.length; v++) {
                            const variation = variations[v];
                            if (!variation || !variation.attributes) continue;
                            let allMatch = true;
                            for (let k = 0; k < selectedKeys.length; k++) {
                                const key = selectedKeys[k];
                                const varAttrVal = String(variation.attributes[key] || '').toLowerCase();
                                if (varAttrVal !== '' && varAttrVal !== selectedAttrs[key]) {
                                    allMatch = false;
                                    break;
                                }
                            }
                            if (allMatch) {
                                resolvedVarId = variation.variation_id;
                                if ($varIdInput.length) {
                                    $varIdInput.val(resolvedVarId);
                                }
                                break;
                            }
                        }
                    }
                    if (!resolvedVarId && variations[0] && variations[0].variation_id) {
                        resolvedVarId = variations[0].variation_id;
                        if ($varIdInput.length) $varIdInput.val(resolvedVarId);
                    }
                }
            }

            // --- 5. Resolve product_id ---
            let productId = '';
            const $pId = $form.find('input[name="product_id"]');
            if ($pId.length && $pId.val()) {
                productId = $pId.val();
            } else if ($form.data('product_id')) {
                productId = $form.data('product_id');
            } else if ($submitBtn.length && $submitBtn.val()) {
                productId = $submitBtn.val();
            } else {
                const btnVal = $form.find('button[name="add-to-cart"]').val();
                if (btnVal) productId = btnVal;
            }

            // Sync hidden maze_buy_now input
            let $buyNowInput = $form.find('input[name="maze_buy_now"]');
            if (!$buyNowInput.length) {
                $buyNowInput = $('<input type="hidden" name="maze_buy_now" value="1" />');
                $form.append($buyNowInput);
            } else {
                $buyNowInput.val('1');
            }

            // Mark form with data attribute so submit handler doesn't hijack it
            $form.attr('data-maze-buy-now', 'true');

            // Native submit fallback function
            function doNativeSubmit() {
                if (productId) {
                    let $addInput = $form.find('input[name="add-to-cart"]');
                    if (!$addInput.length) {
                        $form.append('<input type="hidden" name="add-to-cart" value="' + productId + '" />');
                    } else if (!$addInput.val()) {
                        $addInput.val(productId);
                    }
                    let $prodInput = $form.find('input[name="product_id"]');
                    if (!$prodInput.length) {
                        $form.append('<input type="hidden" name="product_id" value="' + productId + '" />');
                    } else if (!$prodInput.val()) {
                        $prodInput.val(productId);
                    }
                }
                if (resolvedVarId > 0) {
                    let $varInput = $form.find('input[name="variation_id"]');
                    if (!$varInput.length) {
                        $form.append('<input type="hidden" name="variation_id" value="' + resolvedVarId + '" />');
                    } else {
                        $varInput.val(resolvedVarId);
                    }
                }
                $buyNowInput.val('1');
                if ($form[0]) {
                    HTMLFormElement.prototype.submit.call($form[0]);
                } else {
                    window.location.href = checkoutUrl;
                }
            }

            // Safety timeout: fallback to native submit if network hangs after 3.5s
            const safetyTimer = setTimeout(doNativeSubmit, 3500);

            // --- 6. Collect form data for AJAX ---
            const serialized = $form.serializeArray();
            const formData = [];

            for (let i = 0; i < serialized.length; i++) {
                const item = serialized[i];
                if (item.name === 'action' || item.name === 'maze_buy_now' || item.name === 'is_buy_now') continue;
                if (item.name === 'variation_id' && resolvedVarId > 0) {
                    item.value = String(resolvedVarId);
                }
                formData.push(item);
            }

            if (productId && !formData.some(function (d) { return d.name === 'product_id'; })) {
                formData.push({ name: 'product_id', value: productId });
            }
            if (productId && !formData.some(function (d) { return d.name === 'add-to-cart'; })) {
                formData.push({ name: 'add-to-cart', value: productId });
            }
            if (resolvedVarId > 0 && !formData.some(function (d) { return d.name === 'variation_id'; })) {
                formData.push({ name: 'variation_id', value: String(resolvedVarId) });
            }

            // Ensure variation attributes from pills are included
            $form.find('.variation-row').each(function () {
                const $row = $(this);
                const $select = $row.find('select');
                const $activePill = $row.find('.maze-size-pill.is-active, .maze-size-pill.selected');
                let attrName = $select.length ? ($select.attr('data-attribute_name') || $select.attr('name') || '') : '';
                if (!attrName) {
                    const rowAttr = $row.data('attribute') || '';
                    if (rowAttr) attrName = 'attribute_' + rowAttr;
                }
                let attrVal = '';
                if ($select.length && $select.val()) {
                    attrVal = $select.val();
                } else if ($activePill.length) {
                    attrVal = String($activePill.data('value') || $activePill.text().trim());
                }
                if (attrName && attrVal) {
                    let exists = false;
                    for (let j = 0; j < formData.length; j++) {
                        if (formData[j].name === attrName) { formData[j].value = attrVal; exists = true; break; }
                    }
                    if (!exists) formData.push({ name: attrName, value: attrVal });
                }
            });

            // Ensure selected_size is included if present
            const $sizeInput = $form.find('input[name="selected_size"]');
            if ($sizeInput.length && !formData.some(function (d) { return d.name === 'selected_size'; })) {
                formData.push({ name: 'selected_size', value: $sizeInput.val() });
            } else {
                const $activePill = $form.find('.maze-size-pill.is-active, .maze-size-pill.selected');
                if ($activePill.length && !formData.some(function (d) { return d.name === 'selected_size'; })) {
                    formData.push({ name: 'selected_size', value: String($activePill.data('value') || $activePill.text().trim()) });
                }
            }

            formData.push({ name: 'action', value: 'maze_ajax_add_to_cart' });
            formData.push({ name: 'is_buy_now', value: '1' });
            formData.push({ name: 'maze_buy_now', value: '1' });

            if (!formData.some(function (d) { return d.name === 'quantity'; })) {
                formData.push({ name: 'quantity', value: $form.find('input[name="quantity"]').val() || '1' });
            }
            if (typeof mazeData !== 'undefined' && mazeData.nonce) {
                formData.push({ name: 'maze_nonce', value: mazeData.nonce });
            }

            const ajaxUrl = (typeof mazeData !== 'undefined' && mazeData.ajaxUrl) ? mazeData.ajaxUrl : '/wp-admin/admin-ajax.php';

            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: $.param(formData),
                dataType: 'json',
                timeout: 5000,
                success: function (res) {
                    clearTimeout(safetyTimer);
                    if (res && res.success && res.data && res.data.checkout_url) {
                        window.location.href = res.data.checkout_url;
                        return;
                    }
                    if (res && res.data && res.data.checkout_url) {
                        window.location.href = res.data.checkout_url;
                        return;
                    }
                    doNativeSubmit();
                    return;


                },
                error: function () {
                    clearTimeout(safetyTimer);
                    doNativeSubmit();
                }
            });

            return false;
        };

        $(document).on('click', '.maze_buy_now_button', function (e) {
            return window.mazeBuyNow(this, e);
        });

        // AJAX Add to Bag on Single Product Pages (Simple & Variable)
        // Buy Now is handled by the separate click handler above
        $(document).on('submit', 'form.cart', function (e) {
            const $form = $(this);
            // CRITICAL: If Buy Now is being processed, DO NOT intercept as add-to-bag!
            if ($form.attr('data-maze-buy-now') === 'true' || $form.find('input[name="maze_buy_now"]').val() === '1') {
                return;
            }

            const $submitBtn = $form.find('.single_add_to_cart_button');
            const $buyBtn = $form.find('.maze_buy_now_button');
            const $pills = $form.find('.maze-size-pills');

            // 1. Check if size selection is required and made
            if ($pills.length && !$pills.find('.maze-size-pill.is-active').length) {
                e.preventDefault();
                $pills.addClass('ring-2 ring-black');
                setTimeout(function () {
                    $pills.removeClass('ring-2 ring-black');
                }, 1000);
                return false;
            }

            // 2. Sync select values from active pills for variable products
            $form.find('.variation-row').each(function () {
                const $row = $(this);
                const $activePill = $row.find('.maze-size-pill.is-active');
                const $select = $row.find('select');
                if ($activePill.length && $select.length && !$select.val()) {
                    const val = String($activePill.data('value') || $activePill.text().trim());
                    $select.find('option').each(function () {
                        const optVal = String($(this).val() || '').trim();
                        const optText = String($(this).text() || '').trim();
                        if (optVal && (optVal.toLowerCase() === val.toLowerCase() || optText.toLowerCase() === val.toLowerCase())) {
                            $select.val(optVal).trigger('change');
                            return false;
                        }
                    });
                }
            });

            // 3. For variable products, try resolving variation_id if not yet populated
            const $varIdInput = $form.find('input[name="variation_id"]');
            if ($varIdInput.length && (!parseInt($varIdInput.val(), 10) || parseInt($varIdInput.val(), 10) <= 0)) {
                const variations = $form.data('product_variations');
                if (Array.isArray(variations)) {
                    const selectedAttrs = {};
                    $form.find('.variation-row').each(function () {
                        const $row = $(this);
                        const $select = $row.find('select');
                        const $activePill = $row.find('.maze-size-pill.is-active');
                        let attrName = '';
                        if ($select.length) {
                            attrName = $select.attr('data-attribute_name') || $select.attr('name') || '';
                        }
                        if (!attrName) {
                            const rowAttr = $row.data('attribute') || '';
                            if (rowAttr) attrName = 'attribute_' + rowAttr;
                        }
                        let attrVal = '';
                        if ($select.length && $select.val()) {
                            attrVal = String($select.val()).toLowerCase();
                        } else if ($activePill.length) {
                            attrVal = String($activePill.data('value') || $activePill.text().trim() || '').toLowerCase();
                        }
                        if (attrName && attrVal) {
                            selectedAttrs[attrName] = attrVal;
                        }
                    });

                    const selectedKeys = Object.keys(selectedAttrs);
                    if (selectedKeys.length > 0) {
                        for (let v = 0; v < variations.length; v++) {
                            const variation = variations[v];
                            if (!variation || !variation.attributes) continue;
                            let allMatch = true;
                            for (let k = 0; k < selectedKeys.length; k++) {
                                const key = selectedKeys[k];
                                const varAttrVal = String(variation.attributes[key] || '').toLowerCase();
                                if (varAttrVal !== '' && varAttrVal !== selectedAttrs[key]) {
                                    allMatch = false;
                                    break;
                                }
                            }
                            if (allMatch) {
                                $varIdInput.val(variation.variation_id);
                                break;
                            }
                        }
                    }
                }
            }

            // 4. Intercept submission for AJAX processing
            e.preventDefault();

            if ($submitBtn.hasClass('is-loading') || $submitBtn.prop('disabled')) {
                return false;
            }

            const originalSubmitBtnHtml = $submitBtn.html();

            $submitBtn.addClass('is-loading opacity-80').prop('disabled', true);
            if ($buyBtn.length) $buyBtn.prop('disabled', true);
            $submitBtn.html('<span class="inline-flex items-center justify-center gap-2 font-mono tracking-widest uppercase"><svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg> ADDING TO BAG...</span>');

            const serialized = $form.serializeArray();
            const formData = [];
            let resolvedProductId = '';

            const $pIdInput = $form.find('input[name="product_id"]');
            if ($pIdInput.length && $pIdInput.val()) {
                resolvedProductId = $pIdInput.val();
            } else if ($submitBtn.val()) {
                resolvedProductId = $submitBtn.val();
            } else if ($form.data('product_id')) {
                resolvedProductId = $form.data('product_id');
            } else {
                const btnVal = $form.find('button[name="add-to-cart"]').val();
                if (btnVal) resolvedProductId = btnVal;
            }

            for (let i = 0; i < serialized.length; i++) {
                const item = serialized[i];
                if (item.name === 'add-to-cart') {
                    if (!resolvedProductId) resolvedProductId = item.value;
                } else if (item.name === 'product_id') {
                    if (!resolvedProductId) resolvedProductId = item.value;
                } else if (item.name !== 'action' && item.name !== 'maze_buy_now') {
                    formData.push(item);
                }
            }

            if (resolvedProductId) {
                formData.push({ name: 'product_id', value: resolvedProductId });
            }

            formData.push({ name: 'action', value: 'maze_ajax_add_to_cart' });

            const $sizeInput = $form.find('input[name="selected_size"]');
            if ($sizeInput.length && !formData.some(item => item.name === 'selected_size')) {
                formData.push({ name: 'selected_size', value: $sizeInput.val() });
            }

            if (!formData.some(item => item.name === 'quantity')) {
                const qVal = $form.find('input[name="quantity"]').val() || '1';
                formData.push({ name: 'quantity', value: qVal });
            }

            if (typeof mazeData !== 'undefined' && mazeData.nonce) {
                formData.push({ name: 'maze_nonce', value: mazeData.nonce });
            }

            const ajaxEndpoint = (typeof mazeData !== 'undefined' && mazeData.ajaxUrl) ? mazeData.ajaxUrl : '/wp-admin/admin-ajax.php';

            $.ajax({
                url: ajaxEndpoint,
                type: 'POST',
                data: $.param(formData),
                dataType: 'json',
                timeout: 10000,
                success: function (res) {
                    if (res && res.success) {
                        $submitBtn.removeClass('is-loading opacity-80 added');
                        $submitBtn.html('<span class="inline-flex items-center justify-center gap-1.5 font-mono tracking-widest uppercase">ADDED TO BAG ✓</span>');
                        if ($buyBtn.length) $buyBtn.prop('disabled', false);

                        const count = (res.data && res.data.cart_count !== undefined) ? res.data.cart_count : null;
                        if (count !== null) {
                            syncMazeCartBadge(count);
                            pulseMazeCartBadge();
                        }

                        if (res.data && res.data.fragments) {
                            $.each(res.data.fragments, function (key, val) {
                                $(key).replaceWith(val);
                            });
                            if (count !== null) syncMazeCartBadge(count);
                        }

                        // Clean up stray View Cart links
                        $form.find('.maze-view-cart-wrap').remove();
                        $form.find('.maze_buy_now_button').next('.added_to_cart, .maze-view-cart-link').remove();
                        $form.find('.product-actions-buttons').next('.added_to_cart, .maze-view-cart-link').remove();

                        const cartUrl = (res.data && res.data.cart_url) ? res.data.cart_url : ((typeof mazeData !== 'undefined' && mazeData.cartUrl) ? mazeData.cartUrl : '/cart/');
                        let $cartLink = $submitBtn.next('.added_to_cart, .maze-view-cart-link');
                        if (!$cartLink.length) {
                            $cartLink = $('<a href="' + cartUrl + '" class="maze-view-cart-link added_to_cart wc-forward font-bebas text-xl sm:text-2xl uppercase tracking-wider text-black underline underline-offset-4 hover:opacity-75 transition-all block text-center my-2">VIEW CART</a>');
                            $submitBtn.after($cartLink);
                        } else {
                            $cartLink.show();
                        }

                        $(document.body).trigger('added_to_cart', [res.data.fragments, res.data.cart_hash, $submitBtn]);
                        $submitBtn.removeClass('added');

                        setTimeout(function () {
                            $submitBtn.removeClass('added');
                            $form.find('.maze-view-cart-wrap').remove();
                            $form.find('.maze_buy_now_button').next('.added_to_cart, .maze-view-cart-link').remove();
                            $form.find('.product-actions-buttons').next('.added_to_cart, .maze-view-cart-link').remove();
                            const $allCartLinks = $form.find('.added_to_cart, .maze-view-cart-link');
                            if ($allCartLinks.length > 1) {
                                $allCartLinks.slice(1).remove();
                            }
                        }, 50);

                        setTimeout(function () {
                            $submitBtn.removeClass('added').prop('disabled', false).html(originalSubmitBtnHtml);
                        }, 1800);
                    } else {
                        const errorMsg = (res && res.data && res.data.message) ? res.data.message : 'Could not add garment to bag. Please try again.';
                        alert(errorMsg);
                        $submitBtn.removeClass('is-loading opacity-80').prop('disabled', false).html(originalSubmitBtnHtml);
                        if ($buyBtn.length) {
                            $buyBtn.removeClass('is-loading opacity-80').prop('disabled', false);
                        }
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error('Submission error:', textStatus, errorThrown);
                    var userMsg = 'Could not add garment to bag. Please check your connection and try again.';
                    if (textStatus === 'timeout') {
                        userMsg = 'Request timed out. Please try adding to bag again.';
                    }
                    alert(userMsg);
                    $submitBtn.removeClass('is-loading opacity-80').prop('disabled', false).html(originalSubmitBtnHtml);
                    if ($buyBtn.length) {
                        $buyBtn.removeClass('is-loading opacity-80').prop('disabled', false);
                    }
                    refreshMazeCartFragments();
                }
            });

            return false;
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

        // --- 7. Modern Minimalist WooCommerce Catalog Ordering Dropdown ---
        function initMazeModernOrdering() {
            $('.woocommerce-ordering').each(function () {
                var $form = $(this);
                var $select = $form.find('select.orderby');
                if (!$select.length || $form.find('.maze-custom-orderby-wrap').length) return;

                $form.addClass('maze-custom-active');

                var currentVal = $select.val();
                var $selectedOption = $select.find('option:selected');
                var currentText = $selectedOption.length ? $selectedOption.text().trim() : 'Default sorting';

                var optionsHtml = '';
                $select.find('option').each(function () {
                    var val = $(this).val();
                    var text = $(this).text().trim();
                    var isSelected = (val === currentVal);
                    optionsHtml += '<li class="maze-custom-orderby-item' + (isSelected ? ' is-active' : '') + '" data-value="' + val + '" role="option" aria-selected="' + (isSelected ? 'true' : 'false') + '">' +
                        '<span class="maze-orderby-item-text">' + text + '</span>' +
                        '<span class="maze-orderby-indicator">' +
                        (isSelected ? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>' : '') +
                        '</span>' +
                        '</li>';
                });

                var customDropdownHtml =
                    '<div class="maze-custom-orderby-wrap">' +
                    '<button type="button" class="maze-custom-orderby-trigger" aria-haspopup="listbox" aria-expanded="false">' +
                    '<span class="maze-custom-orderby-current">' + currentText + '</span>' +
                    '<span class="maze-custom-orderby-arrow">' +
                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' +
                    '<path d="M6 9l6 6 6-6"/>' +
                    '</svg>' +
                    '</span>' +
                    '</button>' +
                    '<div class="maze-custom-orderby-menu" role="listbox">' +
                    '<ul class="maze-custom-orderby-list">' +
                    optionsHtml +
                    '</ul>' +
                    '</div>' +
                    '</div>';

                $form.append(customDropdownHtml);

                var $customWrap = $form.find('.maze-custom-orderby-wrap');
                var $trigger = $customWrap.find('.maze-custom-orderby-trigger');
                var $menu = $customWrap.find('.maze-custom-orderby-menu');
                var $label = $customWrap.find('.maze-custom-orderby-current');

                function adjustMenuPosition() {
                    $menu.removeClass('maze-menu-align-left maze-menu-align-right');
                    var menuEl = $menu[0];
                    if (!menuEl) return;
                    var rect = menuEl.getBoundingClientRect();
                    var vpWidth = window.innerWidth || document.documentElement.clientWidth;

                    if (rect.left < 8) {
                        $menu.addClass('maze-menu-align-left');
                    } else if (rect.right > vpWidth - 8) {
                        $menu.addClass('maze-menu-align-right');
                    }
                }

                $trigger.on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var isOpen = $customWrap.hasClass('is-open');
                    $('.maze-custom-orderby-wrap').not($customWrap).removeClass('is-open').find('.maze-custom-orderby-trigger').attr('aria-expanded', 'false');
                    if (isOpen) {
                        $customWrap.removeClass('is-open');
                        $trigger.attr('aria-expanded', 'false');
                    } else {
                        $customWrap.addClass('is-open');
                        $trigger.attr('aria-expanded', 'true');
                        adjustMenuPosition();
                    }
                });

                $(window).on('resize.mazeOrdering', function () {
                    if ($customWrap.hasClass('is-open')) {
                        adjustMenuPosition();
                    }
                });

                $menu.on('click', '.maze-custom-orderby-item', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var selectedVal = $(this).data('value');
                    var newText = $(this).find('.maze-orderby-item-text').text().trim();

                    $menu.find('.maze-custom-orderby-item').removeClass('is-active').attr('aria-selected', 'false').find('.maze-orderby-indicator').empty();
                    $(this).addClass('is-active').attr('aria-selected', 'true').find('.maze-orderby-indicator').html('<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>');
                    $label.text(newText);
                    $customWrap.removeClass('is-open');
                    $trigger.attr('aria-expanded', 'false');

                    if (selectedVal !== currentVal) {
                        $select.val(selectedVal).trigger('change');
                        $form.trigger('submit');
                        if ($form[0] && typeof $form[0].submit === 'function') {
                            $form[0].submit();
                        }
                    }
                });
            });

            // Close on click outside
            $(document).on('click.mazeOrdering', function (e) {
                if (!$(e.target).closest('.maze-custom-orderby-wrap').length) {
                    $('.maze-custom-orderby-wrap').removeClass('is-open').find('.maze-custom-orderby-trigger').attr('aria-expanded', 'false');
                }
            });

            // Close on escape
            $(document).on('keydown.mazeOrdering', function (e) {
                if (e.key === 'Escape') {
                    $('.maze-custom-orderby-wrap.is-open').removeClass('is-open').find('.maze-custom-orderby-trigger').attr('aria-expanded', 'false').focus();
                }
            });
        }
        initMazeModernOrdering();

        // --- 8. Modern Minimalist Pagination Enhancements ---
        function initMazeModernPagination() {
            $('.woocommerce-pagination').each(function () {
                var $nav = $(this);
                $nav.find('a.prev').each(function () {
                    var text = $(this).text().trim();
                    if (text === '←' || text === '&larr;' || text === '«' || text.indexOf('←') !== -1 || text === '') {
                        $(this).html('&#8592;');
                    }
                });
                $nav.find('a.next').each(function () {
                    var text = $(this).text().trim();
                    if (text === '→' || text === '&rarr;' || text === '»' || text.indexOf('→') !== -1 || text === '->' || text === '') {
                        $(this).html('&#8594;');
                    }
                });
            });
        }
        initMazeModernPagination();

    });

})(jQuery);

