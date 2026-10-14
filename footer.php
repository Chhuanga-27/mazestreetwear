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

<footer id="colophon" class="site-footer bg-[#050507] border-t border-white/10 text-[#a1a1aa] font-sans pt-16 pb-12 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Top Footer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 pb-16 border-b border-white/10">

            <!-- Brand Column -->
            <div class="md:col-span-4 space-y-4">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block">
                    <span class="text-3xl font-black tracking-tighter uppercase font-sans text-white">
                        MAZE<span class="text-[#ccff00]">.</span>
                    </span>
                </a>
                <p class="text-xs font-mono tracking-wider leading-relaxed text-[#71717a] max-w-sm">
                    ENGINEERED MINIMALIST STREETWEAR // DESIGNED FOR THE UNDERGROUND AND CRAFTED WITH ARCHIVAL PRECISION. BASED AT <span class="text-white">MAZESTW.IN</span>.
                </p>
                <div class="pt-2 flex items-center space-x-3 text-xs font-mono">
                    <span class="inline-block w-2 h-2 rounded-full bg-[#ccff00]"></span>
                    <span class="text-white/80 uppercase tracking-widest text-[11px]"><?php esc_html_e( 'SYSTEM: OPERATIONAL', 'mazestreetwear' ); ?></span>
                </div>
            </div>

            <!-- Shop & Collections -->
            <div class="md:col-span-2 space-y-4">
                <h4 class="text-xs font-mono font-bold uppercase tracking-widest text-white border-b border-white/10 pb-2">
                    <?php esc_html_e( 'ARCHIVE', 'mazestreetwear' ); ?>
                </h4>
                <ul class="space-y-2.5 text-xs font-mono tracking-wider">
                    <?php $shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ); ?>
                    <li>
                        <a href="<?php echo esc_url( $shop_url ); ?>" class="hover:text-[#ccff00] transition-colors">
                            <?php esc_html_e( 'ALL APPAREL', 'mazestreetwear' ); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( add_query_arg( 'filter_cat', 'hoodies', $shop_url ) ); ?>" class="hover:text-[#ccff00] transition-colors">
                            <?php esc_html_e( 'OVERSIZED HOODIES', 'mazestreetwear' ); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( add_query_arg( 'filter_cat', 'tees', $shop_url ) ); ?>" class="hover:text-[#ccff00] transition-colors">
                            <?php esc_html_e( 'HEAVYWEIGHT TEES', 'mazestreetwear' ); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( add_query_arg( 'filter_cat', 'outerwear', $shop_url ) ); ?>" class="hover:text-[#ccff00] transition-colors">
                            <?php esc_html_e( 'CARGO & PANTS', 'mazestreetwear' ); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( add_query_arg( 'filter_cat', 'caps', $shop_url ) ); ?>" class="hover:text-[#ccff00] transition-colors">
                            <?php esc_html_e( 'HEADWEAR / OBJECTS', 'mazestreetwear' ); ?>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Customer Care & Required Policies Links -->
            <div class="md:col-span-3 space-y-4">
                <h4 class="text-xs font-mono font-bold uppercase tracking-widest text-white border-b border-white/10 pb-2">
                    <?php esc_html_e( 'PROTOCOL & POLICIES', 'mazestreetwear' ); ?>
                </h4>
                <ul class="space-y-2.5 text-xs font-mono tracking-wider">
                    <li>
                        <a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="hover:text-[#ccff00] transition-colors inline-flex items-center space-x-1.5">
                            <span>/contact-us</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( home_url( '/shipping-policy' ) ); ?>" class="hover:text-[#ccff00] transition-colors inline-flex items-center space-x-1.5">
                            <span>/shipping-policy</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( home_url( '/refund-policy' ) ); ?>" class="hover:text-[#ccff00] transition-colors inline-flex items-center space-x-1.5">
                            <span>/refund-policy</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( home_url( '/terms' ) ); ?>" class="hover:text-[#ccff00] transition-colors inline-flex items-center space-x-1.5">
                            <span>/terms</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>" class="hover:text-[#ccff00] transition-colors inline-flex items-center space-x-1.5">
                            <span>/privacy-policy</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Drop Notification Teaser -->
            <div class="md:col-span-3 space-y-4">
                <h4 class="text-xs font-mono font-bold uppercase tracking-widest text-white border-b border-white/10 pb-2">
                    <?php esc_html_e( 'DROP DISPATCH', 'mazestreetwear' ); ?>
                </h4>
                <p class="text-xs font-mono text-[#71717a] leading-relaxed">
                    <?php esc_html_e( 'SUBSCRIBE FOR RESTOCK CODES AND EXCLUSIVE DROP ACCESS BEFORE THE PUBLIC RELEASE.', 'mazestreetwear' ); ?>
                </p>
                <form class="space-y-2" onsubmit="event.preventDefault(); alert('Subscribed to drop alerts.');">
                    <div class="relative">
                        <input type="email" required placeholder="ENTER EMAIL..." class="w-full bg-[#111113] border border-white/10 text-white placeholder-[#71717a] font-mono text-xs px-3 py-2.5 focus:outline-none focus:border-[#ccff00] transition-colors" />
                    </div>
                    <button type="submit" class="w-full bg-white text-black font-mono font-bold text-xs uppercase tracking-widest py-2.5 px-4 hover:bg-[#ccff00] hover:text-black transition-colors duration-150">
                        <?php esc_html_e( 'GET DROP ACCESS', 'mazestreetwear' ); ?>
                    </button>
                </form>
            </div>

        </div>

        <!-- Bottom Footer Meta & Legal -->
        <div class="pt-8 flex flex-col md:flex-row items-center justify-between text-[11px] font-mono text-[#71717a] space-y-4 md:space-y-0">
            <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                <span>&copy; <?php echo esc_html( date( 'Y' ) ); ?> MAZE (MAZESTW.IN). ALL RIGHTS RESERVED.</span>
                <span class="hidden sm:inline text-white/20">|</span>
                <span>GLOBAL STREETWEAR INVENTORY</span>
            </div>
            <div class="flex items-center space-x-6">
                <a href="<?php echo esc_url( home_url( '/terms' ) ); ?>" class="hover:text-[#ccff00] transition-colors">TERMS</a>
                <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>" class="hover:text-[#ccff00] transition-colors">PRIVACY</a>
                <a href="<?php echo esc_url( home_url( '/shipping-policy' ) ); ?>" class="hover:text-[#ccff00] transition-colors">SHIPPING</a>
                <a href="<?php echo esc_url( home_url( '/refund-policy' ) ); ?>" class="hover:text-[#ccff00] transition-colors">REFUNDS</a>
                <a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="hover:text-[#ccff00] transition-colors">CONTACT</a>
            </div>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
