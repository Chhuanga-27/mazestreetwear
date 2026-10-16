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

        // Sync variation image when a valid variation is matched
        $(document).on('found_variation', 'form.variations_form', function (event, variation) {
            if (variation && variation.image && variation.image.src) {
                const $mainImg = $('#maze-main-product-image');
                if ($mainImg.length) {
                    $mainImg.attr('src', variation.image.full_src || variation.image.src);
                }
            }
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
                        // Pre-select first available size box
                        const $first = $row.find('.maze-size-pill:not(.is-disabled, .disabled, [disabled], .opacity-30)').first();
                        if ($first.length) {
                            $first.trigger('click');
                        }
                    }
                });
            });
        }
        initVariationPills();
        setTimeout(initVariationPills, 120);

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
                            } catch (e) {}
                        }
                    }
                }
            } catch (e) {}
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
            } catch (e) {}
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
                            }).catch(function () {});
                        } catch (e) {}
                    }).catch(function () {});
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
                    } catch (e) {}
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
                        } catch (e) {}
                        return response;
                    });
                });
            } catch (e) {}
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
                    } catch (err) {}
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

        // Bag Counter Pulse on Add To Cart
        $(document.body).on('added_to_cart wc-blocks_added_to_cart', function () {
            pulseMazeCartBadge();
        });

        // Initial sync on DOM ready (if on Cart page with items already rendered, sync with actual items)
        const initialCartPageQty = calculateCartQuantityFromDOM();
        if (initialCartPageQty !== null) {
            syncMazeCartBadge(initialCartPageQty);
        } else {
            syncMazeCartBadge();
        }

        // Ensure variation size is chosen before submitting variable products
        $(document).on('submit', 'form.variations_form', function (e) {
            const $form = $(this);
            const $pills = $form.find('.maze-size-pills');

            // If size pills exist and none is active
            if ($pills.length && !$pills.find('.maze-size-pill.is-active').length) {
                e.preventDefault();
                $pills.addClass('ring-2 ring-black');
                setTimeout(function () {
                    $pills.removeClass('ring-2 ring-black');
                }, 1000);
                return false;
            }

            // Sync select values from active pills before submission
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
                            $select.val(optVal);
                            return false;
                        }
                    });
                }
            });
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
