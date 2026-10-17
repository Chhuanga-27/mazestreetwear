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

<?php
$is_maze_home = is_front_page() || is_page_template( 'template-homepage.php' );
$footer_card_border = $is_maze_home ? 'border-0' : 'border border-black/15 shadow-sm';
?>
<footer id="colophon" class="site-footer bg-white text-black font-sans px-3 sm:px-6 lg:px-8 py-5 sm:py-8 lg:py-10 mt-auto">
    <div class="max-w-[1400px] mx-auto bg-white rounded-[2rem] sm:rounded-[2.5rem] lg:rounded-[3rem] p-6 sm:p-10 lg:p-14 <?php echo esc_attr( $footer_card_border ); ?> flex flex-col justify-between overflow-hidden">

        <!-- Top Section: Realigned Explore & Connect -->
        <div class="flex flex-col sm:flex-row justify-between items-start gap-8 sm:gap-12 lg:gap-16 pb-8 sm:pb-12">

            <!-- Left: Explore Navigation Links -->
            <div class="space-y-3">
                <span class="block text-sm sm:text-base font-normal uppercase tracking-wider font-bebas text-black">
                    <?php esc_html_e( 'Explore', 'mazestreetwear' ); ?>
                </span>
                <?php $shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ); ?>
                <div class="flex flex-row gap-8 sm:gap-12 lg:gap-16">
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
                    </ul>
                    <ul class="space-y-2.5 text-sm sm:text-[15px] font-outfit font-medium text-black">
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
            </div>

            <!-- Right: Connect (Instagram & Email) -->
            <div class="space-y-3">
                <span class="block text-sm sm:text-base font-normal uppercase tracking-wider font-bebas text-black">
                    <?php esc_html_e( 'Connect', 'mazestreetwear' ); ?>
                </span>
                <div class="flex flex-col gap-2.5 max-w-xs">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/maze.stw?utm_source=ig_web_button_share_sheet&exln=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" class="maze-social-pill inline-flex items-center space-x-2.5 px-3.5 py-2 rounded-full bg-neutral-100 hover:bg-neutral-200 border border-neutral-300 text-xs sm:text-sm font-bold text-black transition-all w-fit" aria-label="<?php esc_attr_e( 'MAZE on Instagram', 'mazestreetwear' ); ?>">
                        <svg class="w-4 h-4 text-[#E4405F] flex-shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                        <span class="truncate">@maze.stw</span>
                    </a>

                    <!-- Email Desk -->
                    <a href="mailto:enquiries@mazestw.in" class="maze-social-pill inline-flex items-center space-x-2.5 px-3.5 py-2 rounded-full bg-neutral-100 hover:bg-neutral-200 border border-neutral-300 text-xs sm:text-sm font-bold text-black transition-all w-fit" aria-label="<?php esc_attr_e( 'Email enquiries@mazestw.in', 'mazestreetwear' ); ?>">
                        <svg class="w-4 h-4 text-black flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        <span class="truncate">enquiries@mazestw.in</span>
                    </a>
                </div>
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
