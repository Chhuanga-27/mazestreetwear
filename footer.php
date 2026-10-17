<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content up until </html>
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
</div><!-- #content -->

<footer id="colophon" class="site-footer bg-[#FEFEF3] text-black font-sans px-3 sm:px-6 lg:px-8 py-5 sm:py-8 lg:py-10 mt-auto">
    <div class="max-w-[1400px] mx-auto bg-[#FEFEF3] rounded-[2rem] sm:rounded-[2.5rem] lg:rounded-[3rem] p-6 sm:p-10 lg:p-14 border border-black/15 shadow-sm flex flex-col justify-between overflow-hidden">

        <!-- Top Section: 4-Column Editorial Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-12 pb-8 sm:pb-12">

            <!-- Col 1: Brand Statement / Bio -->
            <div class="lg:col-span-4 space-y-3">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block group mb-1">
                    <span class="text-2xl sm:text-3xl font-normal tracking-wide uppercase font-bebas text-black">
                        MAZE<span class="text-neutral-400">.</span>
                    </span>
                </a>
                <p class="text-sm sm:text-base font-normal font-outfit tracking-normal leading-relaxed text-neutral-800 max-w-sm">
                    <?php esc_html_e( 'MAZE is an independent contemporary streetwear brand and design archive.', 'mazestreetwear' ); ?>
                </p>
                <div class="pt-2 flex items-center space-x-2 text-xs sm:text-sm font-outfit text-neutral-800 font-semibold uppercase tracking-wider">
                    <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                    <span><?php esc_html_e( 'ARCHIVAL PRECISION // MAZESTW.IN', 'mazestreetwear' ); ?></span>
                </div>
            </div>

            <!-- Col 2: Explore Navigation Links -->
            <div class="lg:col-span-2 space-y-3">
                <span class="block text-sm sm:text-base font-normal uppercase tracking-wider font-bebas text-black">
                    <?php esc_html_e( 'Explore', 'mazestreetwear' ); ?>
                </span>
                <?php $shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ); ?>
                <ul class="space-y-2.5 text-sm sm:text-[15px] font-outfit font-medium text-black">
                    <li>
                        <a href="<?php echo esc_url( $shop_url ); ?>" class="hover:underline underline-offset-4 transition-colors block">
                            <?php esc_html_e( 'Shop All', 'mazestreetwear' ); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_product_cat_url' ) ? mazestreetwear_get_product_cat_url( 'tops' ) : home_url( '/product-category/tops/' ) ); ?>" class="hover:text-black hover:underline underline-offset-4 transition-colors block">
                            <?php esc_html_e( 'Tops', 'mazestreetwear' ); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_product_cat_url' ) ? mazestreetwear_get_product_cat_url( 'bottoms' ) : home_url( '/product-category/bottoms/' ) ); ?>" class="hover:text-black hover:underline underline-offset-4 transition-colors block">
                            <?php esc_html_e( 'Bottoms', 'mazestreetwear' ); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_product_cat_url' ) ? mazestreetwear_get_product_cat_url( 'accessories' ) : home_url( '/product-category/accessories/' ) ); ?>" class="hover:text-black hover:underline underline-offset-4 transition-colors block">
                            <?php esc_html_e( 'Accessories', 'mazestreetwear' ); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( home_url( '/archive/' ) ); ?>" class="hover:text-black hover:underline underline-offset-4 transition-colors block">
                            <?php esc_html_e( 'Lookbook & Archive', 'mazestreetwear' ); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_about_url' ) ? mazestreetwear_get_about_url() : home_url( '/about-us/' ) ); ?>" class="hover:text-black hover:underline underline-offset-4 transition-colors block">
                            <?php esc_html_e( 'About Us', 'mazestreetwear' ); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_contact_url' ) ? mazestreetwear_get_contact_url() : home_url( '/contact-us/' ) ); ?>" class="hover:text-black hover:underline underline-offset-4 transition-colors block">
                            <?php esc_html_e( 'Contact', 'mazestreetwear' ); ?>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 3: Follow us (Social Pills with Brand Icons) -->
            <div class="lg:col-span-3 space-y-3">
                <span class="block text-sm sm:text-base font-normal uppercase tracking-wider font-bebas text-black">
                    <?php esc_html_e( 'Follow us', 'mazestreetwear' ); ?>
                </span>
                <div class="grid grid-cols-2 gap-2.5 max-w-xs">
                    <!-- X / Twitter -->
                    <a href="https://x.com/mazestw" target="_blank" rel="noopener noreferrer" class="maze-social-pill inline-flex items-center space-x-2 px-3.5 py-2 rounded-full bg-neutral-100 hover:bg-neutral-200 border border-neutral-300 text-xs sm:text-sm font-bold text-black transition-all" aria-label="MAZE on X">
                        <svg class="w-4 h-4 text-black flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                        <span class="truncate">@mazestw.in</span>
                    </a>

                    <!-- Instagram -->
                    <a href="https://instagram.com/mazestw.in" target="_blank" rel="noopener noreferrer" class="maze-social-pill inline-flex items-center space-x-2 px-3.5 py-2 rounded-full bg-neutral-100 hover:bg-neutral-200 border border-neutral-300 text-xs sm:text-sm font-bold text-black transition-all" aria-label="MAZE on Instagram">
                        <svg class="w-4 h-4 text-[#E4405F] flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                        <span class="truncate">@mazestw.in</span>
                    </a>

                    <!-- TikTok -->
                    <a href="https://tiktok.com/@mazestw" target="_blank" rel="noopener noreferrer" class="maze-social-pill inline-flex items-center space-x-2 px-3.5 py-2 rounded-full bg-neutral-100 hover:bg-neutral-200 border border-neutral-300 text-xs sm:text-sm font-bold text-black transition-all" aria-label="MAZE on TikTok">
                        <svg class="w-4 h-4 text-black flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                        </svg>
                        <span class="truncate">@mazestw.in</span>
                    </a>

                    <!-- YouTube -->
                    <a href="https://youtube.com/@mazestw" target="_blank" rel="noopener noreferrer" class="maze-social-pill inline-flex items-center space-x-2 px-3.5 py-2 rounded-full bg-neutral-100 hover:bg-neutral-200 border border-neutral-300 text-xs sm:text-sm font-bold text-black transition-all" aria-label="MAZE on YouTube">
                        <svg class="w-4 h-4 text-[#FF0000] flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                        <span class="truncate">@mazestw.in</span>
                    </a>

                    <!-- Spotify / Sound Archive -->
                    <a href="https://open.spotify.com" target="_blank" rel="noopener noreferrer" class="col-span-2 maze-social-pill inline-flex items-center space-x-2 px-3.5 py-2 rounded-full bg-neutral-100 hover:bg-neutral-200 border border-neutral-300 text-xs sm:text-sm font-bold text-black transition-all" aria-label="MAZE Sound Archive on Spotify">
                        <svg class="w-4 h-4 text-[#1DB954] flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/>
                        </svg>
                        <span class="truncate">Sound Archive @mazestw</span>
                    </a>
                </div>
            </div>

            <!-- Col 4: Action CTAs with Circle Arrows -->
            <div class="lg:col-span-3 space-y-6 flex flex-col justify-start">

                <!-- Action 1: Call MAZE / Direct Concierge (Coral-Orange circle arrow accent) -->
                <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_contact_url' ) ? mazestreetwear_get_contact_url() : home_url( '/contact-us/' ) ); ?>" class="maze-action-cta group block">
                    <div class="flex items-center space-x-2.5">
                        <span class="text-xl sm:text-2xl font-normal font-bebas tracking-wide text-[#ff3e18] group-hover:underline">
                            <?php esc_html_e( 'Call MAZE', 'mazestreetwear' ); ?>
                        </span>
                        <span class="maze-action-arrow w-6 h-6 rounded-full bg-[#ff3e18] text-white flex items-center justify-center transition-transform duration-200 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path>
                            </svg>
                        </span>
                    </div>
                    <span class="block text-sm font-outfit font-normal text-neutral-800 mt-0.5">
                        <?php esc_html_e( "Let's work together", 'mazestreetwear' ); ?>
                    </span>
                </a>

                <!-- Action 2: Archive & Drops (Black circle arrow) -->
                <a href="<?php echo esc_url( $shop_url ); ?>" class="maze-action-cta group block">
                    <div class="flex items-center space-x-2.5">
                        <span class="text-xl sm:text-2xl font-normal font-bebas tracking-wide text-black group-hover:underline">
                            <?php esc_html_e( 'Archive & Drops', 'mazestreetwear' ); ?>
                        </span>
                        <span class="maze-action-arrow w-6 h-6 rounded-full bg-black text-white flex items-center justify-center transition-transform duration-200 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path>
                            </svg>
                        </span>
                    </div>
                    <span class="block text-sm font-outfit font-normal text-neutral-800 mt-0.5">
                        <?php esc_html_e( 'Ready-to-wear catalog', 'mazestreetwear' ); ?>
                    </span>
                </a>

            </div>

        </div>

        <!-- Centerpiece: Giant Brand Typography -->
        <div class="w-full my-6 sm:my-10 lg:my-12 select-none overflow-hidden text-center flex items-center justify-center" aria-label="MAZE">
            <span class="maze-footer-brand-title block text-center font-black uppercase text-black tracking-tighter select-none pointer-events-none w-full">
                MAZE
            </span>
        </div>

        <!-- Bottom Meta & Legal Bar -->
        <div class="pt-5 sm:pt-6 border-t border-neutral-300 flex flex-col md:flex-row items-center justify-between text-xs sm:text-sm font-outfit gap-4">
            <!-- Left: Legal Links -->
            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-x-3 sm:gap-x-4 gap-y-2 text-black font-medium">
                <span class="font-normal font-bebas text-base text-black tracking-wider">MAZE &copy;<?php echo esc_html( date( 'Y' ) ); ?></span>
                <span class="text-neutral-500 font-black select-none" aria-hidden="true">&middot;</span>
                <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_privacy_policy_url' ) ? mazestreetwear_get_privacy_policy_url() : home_url( '/privacy-policy/' ) ); ?>" class="maze-legal-link text-black hover:underline underline-offset-4 transition-colors">
                    <?php esc_html_e( 'Privacy Policy', 'mazestreetwear' ); ?>
                </a>
                <span class="text-neutral-500 font-black select-none" aria-hidden="true">&middot;</span>
                <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_terms_url' ) ? mazestreetwear_get_terms_url() : home_url( '/terms-and-conditions/' ) ); ?>" class="maze-legal-link text-black hover:underline underline-offset-4 transition-colors">
                    <?php esc_html_e( 'Terms & Conditions', 'mazestreetwear' ); ?>
                </a>
                <span class="text-neutral-500 font-black select-none" aria-hidden="true">&middot;</span>
                <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_shipping_policy_url' ) ? mazestreetwear_get_shipping_policy_url() : home_url( '/shipping-policy/' ) ); ?>" class="maze-legal-link text-black hover:underline underline-offset-4 transition-colors">
                    <?php esc_html_e( 'Shipping Policy', 'mazestreetwear' ); ?>
                </a>
                <span class="text-neutral-500 font-black select-none" aria-hidden="true">&middot;</span>
                <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_refund_policy_url' ) ? mazestreetwear_get_refund_policy_url() : home_url( '/refund-policy/' ) ); ?>" class="maze-legal-link text-black hover:underline underline-offset-4 transition-colors">
                    <?php esc_html_e( 'Refunds', 'mazestreetwear' ); ?>
                </a>
                <span class="text-neutral-500 font-black select-none" aria-hidden="true">&middot;</span>
                <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_about_url' ) ? mazestreetwear_get_about_url() : home_url( '/about-us/' ) ); ?>" class="maze-legal-link text-black hover:underline underline-offset-4 transition-colors">
                    <?php esc_html_e( 'About', 'mazestreetwear' ); ?>
                </a>
                <span class="text-neutral-500 font-black select-none" aria-hidden="true">&middot;</span>
                <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_contact_url' ) ? mazestreetwear_get_contact_url() : home_url( '/contact-us/' ) ); ?>" class="maze-legal-link text-black hover:underline underline-offset-4 transition-colors">
                    <?php esc_html_e( 'Contact', 'mazestreetwear' ); ?>
                </a>
            </div>

            <!-- Right: Location, Local Live Time Clock & Weather Status -->
            <div class="flex items-center space-x-2.5 text-xs sm:text-sm font-mono font-bold text-black">
                <span class="text-black font-black">India</span>
                <span class="text-neutral-400 select-none font-bold" aria-hidden="true">&bull;</span>
                <span id="maze-footer-clock" class="text-black font-black tracking-tight"><?php echo esc_html( wp_date( 'g:i A' ) ); ?></span>
                <span class="text-neutral-400 select-none font-bold" aria-hidden="true">&bull;</span>
                <span class="text-black font-black">24&deg;C</span>
                <svg class="w-4 h-4 text-black inline ml-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                </svg>
            </div>
        </div>

    </div>
</footer>

<script>
// Immediate initialization for footer clock before DOM ready
(function(){
    var clock = document.getElementById('maze-footer-clock');
    if (!clock) return;
    function update() {
        try {
            var now = new Date();
            clock.textContent = now.toLocaleTimeString('en-US', {
                timeZone: 'Asia/Kolkata',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });
        } catch(e) {}
    }
    update();
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
