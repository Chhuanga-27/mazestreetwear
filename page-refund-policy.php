<?php
/**
 * Template Name: Refund & Returns Policy
 *
 * Official Refund, Exchange & Store Credit Policy page template for Maze Streetwear (mazestw.in).
 * Formatted under Indian E-Commerce consumer guidelines, IT regulations, and brand quality standards.
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$refund_url = function_exists( 'mazestreetwear_get_refund_policy_url' ) ? mazestreetwear_get_refund_policy_url() : home_url( '/refund-policy/' );
?>

<!-- Schema.org JSON-LD for Refund Policy SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Refund & Exchange Policy - Maze Streetwear",
  "url": "<?php echo esc_url( $refund_url ); ?>",
  "description": "Official Return, Size Exchange, and Store Credit Policy of Maze Streetwear (mazestw.in) detailing our 7-day return window, store credit policy, eligibility conditions, and support protocol.",
  "datePublished": "2026-10-15",
  "dateModified": "2026-10-15",
  "publisher": {
    "@type": "Organization",
    "name": "Maze Streetwear",
    "url": "https://mazestw.in",
    "logo": "<?php echo esc_url( get_template_directory_uri() . '/assets/images/maze_logo.png' ); ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Bungkawn Vengthar, A-25",
      "addressLocality": "Aizawl",
      "addressRegion": "Mizoram",
      "postalCode": "796005",
      "addressCountry": "IN"
    },
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "+918787324795",
      "contactType": "Customer Support Desk",
      "email": "enquiries@mazestw.in",
      "availableLanguage": ["English", "Hindi", "Mizo"]
    }
  }
}
</script>

<main id="primary" class="site-main min-h-screen bg-[#FEFEF3] text-black py-8 sm:py-14 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Top Utility Bar -->
        <div class="flex items-center justify-end pb-6 mb-8 border-b border-black text-sm font-mono gap-4 no-print">
            <div class="flex items-center space-x-3 text-neutral-800 font-bold">
                <button type="button" onclick="window.print()" class="inline-flex items-center space-x-1.5 hover:text-black transition-colors px-3 py-1.5 border border-black hover:bg-neutral-100 bg-white rounded-none text-xs uppercase tracking-wider">
                    <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75V4.5a2.25 2.25 0 012.25-2.25h6a2.25 2.25 0 012.25 2.25v2.25m-10.5 0h10.5m-10.5 0H4.5A2.25 2.25 0 002.25 9v6a2.25 2.25 0 002.25 2.25h2.25m10.5-10.5H19.5A2.25 2.25 0 0121.75 9v6a2.25 2.25 0 01-2.25 2.25h-2.25m-10.5 0v3.75A2.25 2.25 0 008.25 21h7.5a2.25 2.25 0 002.25-2.25V17.25m-12 0h12" />
                    </svg>
                    <span><?php esc_html_e( 'PRINT / PDF', 'mazestreetwear' ); ?></span>
                </button>

                <button type="button" id="maze-copy-refund-url-btn" class="inline-flex items-center space-x-1.5 hover:text-black transition-colors px-3 py-1.5 border border-black hover:bg-neutral-100 bg-white rounded-none text-xs uppercase tracking-wider">
                    <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-3.35l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                    </svg>
                    <span id="maze-copy-refund-url-text"><?php esc_html_e( 'SHARE LINK', 'mazestreetwear' ); ?></span>
                </button>
            </div>
        </div>

        <!-- Editorial Document Header -->
        <header class="mb-12 pb-8 border-b-2 border-black">
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <span class="inline-flex items-center space-x-2 text-xs sm:text-sm font-mono font-bold tracking-widest text-black uppercase border border-black px-3.5 py-1.5 bg-white">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span><?php esc_html_e( 'MAZE PROTOCOL // RETURN & EXCHANGE POLICY REF: RET-2026-V1', 'mazestreetwear' ); ?></span>
                </span>
                <span class="inline-block text-xs sm:text-sm font-mono font-bold tracking-widest text-white uppercase border border-black px-3.5 py-1.5 bg-black">
                    <?php esc_html_e( 'STORE CREDIT & EXCHANGES ONLY // NO CASH REFUNDS', 'mazestreetwear' ); ?>
                </span>
            </div>

            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black font-sans uppercase tracking-tight text-black mb-6">
                <?php esc_html_e( 'Refund & Exchange Policy', 'mazestreetwear' ); ?>
            </h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 pt-6 border-t border-black font-mono text-xs sm:text-sm text-neutral-800">
                <div>
                    <span class="block text-xs uppercase tracking-wider text-neutral-700 font-bold mb-1"><?php esc_html_e( 'Effective Date', 'mazestreetwear' ); ?></span>
                    <strong class="font-black text-black text-sm sm:text-base"><?php esc_html_e( 'October 15, 2026', 'mazestreetwear' ); ?></strong>
                </div>
                <div>
                    <span class="block text-xs uppercase tracking-wider text-neutral-700 font-bold mb-1"><?php esc_html_e( 'Last Updated', 'mazestreetwear' ); ?></span>
                    <strong class="font-black text-black text-sm sm:text-base"><?php esc_html_e( 'October 15, 2026', 'mazestreetwear' ); ?></strong>
                </div>
                <div>
                    <span class="block text-xs uppercase tracking-wider text-neutral-700 font-bold mb-1"><?php esc_html_e( 'Return Window', 'mazestreetwear' ); ?></span>
                    <strong class="font-black text-black text-sm sm:text-base"><?php esc_html_e( '7 Calendar Days Post-Delivery', 'mazestreetwear' ); ?></strong>
                </div>
                <div>
                    <span class="block text-xs uppercase tracking-wider text-neutral-700 font-bold mb-1"><?php esc_html_e( 'Support Desk', 'mazestreetwear' ); ?></span>
                    <a href="mailto:enquiries@mazestw.in" class="font-black text-black hover:underline text-sm sm:text-base">
                        enquiries@mazestw.in
                    </a>
                </div>
            </div>
        </header>

        <!-- Policy Highlights Banner (4-column hairline grid) -->
        <section class="mb-14 border border-black bg-neutral-50 no-print" aria-label="<?php esc_attr_e( 'Refund Policy Highlights', 'mazestreetwear' ); ?>">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-black">
                
                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">01 // COMPENSATION</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( 'Store Credit Only', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( 'No cash, bank, or UPI reversals. Approved returns are compensated via digital store credit vouchers or direct size exchanges.', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">02 // INITIATION TIMEFRAME</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( '7 Calendar Days', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( 'Requests must be logged within 7 days from courier delivery confirmation. Submissions after 7 days will not be reviewed.', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">03 // GARMENT INTEGRITY</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( 'Pristine & Unworn', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( 'Must be unworn, unwashed, and unaltered with all woven neck labels, care tags, stickers, and original polybags intact.', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">04 // DAMAGE / DEFECTS</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( '48-Hour Report Window', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( 'Transit damage or incorrect deliveries must be reported within 48 hours of delivery with photo or unboxing video proof.', 'mazestreetwear' ); ?>
                    </p>
                </div>

            </div>
        </section>

        <!-- Two-Column Editorial Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

            <!-- Left Sticky Sidebar: Navigation & Support Card -->
            <aside class="lg:col-span-4 lg:sticky lg:top-28 space-y-6 no-print order-2 lg:order-1">
                
                <!-- Table of Contents -->
                <div class="border border-black p-5 sm:p-6 bg-white">
                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-black">
                        <span class="text-sm font-mono font-bold uppercase tracking-wider text-black">
                            <?php esc_html_e( 'DOCUMENT INDEX', 'mazestreetwear' ); ?>
                        </span>
                        <span class="text-xs font-mono font-bold text-neutral-700">9 SECTIONS</span>
                    </div>

                    <nav class="space-y-1 font-mono text-xs sm:text-sm">
                        <a href="#section-1" class="maze-refund-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>01. Store Credit Only</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-2" class="maze-refund-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>02. Return & Exchange Window</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-3" class="maze-refund-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>03. Eligible Return Conditions</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-4" class="maze-refund-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>04. Quality Rejection Criteria</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-5" class="maze-refund-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>05. Shipping, Taxes & Deductions</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-6" class="maze-refund-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>06. Transit Responsibility</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-7" class="maze-refund-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>07. Damaged / Defective Pieces</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-8" class="maze-refund-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>08. How to Request an Exchange</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-9" class="maze-refund-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>09. Customer Support Desk</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                    </nav>
                </div>

                <!-- Quick Help / Support Capsule -->
                <div class="border border-black p-5 sm:p-6 bg-neutral-50 text-black">
                    <span class="text-xs font-mono font-bold uppercase tracking-widest text-neutral-700 block mb-1">
                        <?php esc_html_e( 'NEED ASSISTANCE?', 'mazestreetwear' ); ?>
                    </span>
                    <h3 class="text-base font-bold font-sans uppercase tracking-tight mb-2">
                        <?php esc_html_e( 'Returns & Operations Desk', 'mazestreetwear' ); ?>
                    </h3>
                    <p class="text-sm text-neutral-800 font-sans leading-relaxed mb-4 font-normal">
                        <?php esc_html_e( 'To initiate a size exchange or store credit request, email our team with your order number.', 'mazestreetwear' ); ?>
                    </p>

                    <div class="space-y-2.5 font-mono text-xs sm:text-sm">
                        <a href="mailto:enquiries@mazestw.in?subject=Return%20Request%20-%20Order%20%23[Your%20Order%20Number]&body=Registered%20Customer%20Name:%0D%0APhone%20Number:%0D%0AOrder%20Number:%0D%0AGarment%20Item:%0D%0ARequest%20Type%20(Exchange%20Size%20/%20Store%20Credit):%0D%0AReason%20for%20Return:" class="flex items-center justify-between p-3 bg-black text-white hover:bg-neutral-800 transition-colors group font-bold">
                            <span><?php esc_html_e( 'START RETURN EMAIL', 'mazestreetwear' ); ?></span>
                            <span class="text-xs uppercase tracking-wider group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                        </a>
                        <div class="flex items-center justify-between p-2.5 bg-white border border-black text-black">
                            <span class="font-bold truncate mr-2">enquiries@mazestw.in</span>
                            <button type="button" id="maze-copy-support-email-btn" class="text-xs uppercase font-bold tracking-wider hover:underline flex-shrink-0">
                                <span id="maze-copy-support-email-text"><?php esc_html_e( 'COPY', 'mazestreetwear' ); ?></span>
                            </button>
                        </div>
                        <a href="https://wa.me/918787324795" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-2.5 bg-white border border-black hover:bg-black hover:text-white transition-colors group">
                            <span class="font-bold">+91 8787324795</span>
                            <span class="text-xs uppercase tracking-wider group-hover:translate-x-0.5 transition-transform font-bold">WhatsApp &rarr;</span>
                        </a>
                    </div>

                    <div class="pt-3 mt-4 border-t border-black text-xs font-mono font-bold text-neutral-700">
                        <?php esc_html_e( 'Mon – Sat: 10:00 AM – 6:00 PM IST', 'mazestreetwear' ); ?>
                    </div>
                </div>

                <!-- Related Legal Policies -->
                <div class="p-5 border border-neutral-200 bg-white">
                    <span class="text-[10px] font-mono font-bold uppercase tracking-widest text-neutral-400 block mb-3">
                        <?php esc_html_e( 'RELATED PROTOCOLS', 'mazestreetwear' ); ?>
                    </span>
                    <ul class="space-y-2 text-xs font-sans">
                        <li>
                            <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_terms_url' ) ? mazestreetwear_get_terms_url() : home_url( '/terms-and-conditions/' ) ); ?>" class="text-neutral-700 hover:text-black underline-offset-4 hover:underline flex items-center justify-between">
                                <span><?php esc_html_e( 'Terms & Conditions', 'mazestreetwear' ); ?></span>
                                <span class="text-neutral-400 font-mono text-[11px]">&rarr;</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_privacy_policy_url' ) ? mazestreetwear_get_privacy_policy_url() : home_url( '/privacy-policy/' ) ); ?>" class="text-neutral-700 hover:text-black underline-offset-4 hover:underline flex items-center justify-between">
                                <span><?php esc_html_e( 'Privacy Policy', 'mazestreetwear' ); ?></span>
                                <span class="text-neutral-400 font-mono text-[11px]">&rarr;</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_shipping_policy_url' ) ? mazestreetwear_get_shipping_policy_url() : home_url( '/shipping-policy/' ) ); ?>" class="text-neutral-700 hover:text-black underline-offset-4 hover:underline flex items-center justify-between">
                                <span><?php esc_html_e( 'Shipping & Dispatch Policy', 'mazestreetwear' ); ?></span>
                                <span class="text-neutral-400 font-mono text-[11px]">&rarr;</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </aside>

            <!-- Right Column: Document Content -->
            <article class="lg:col-span-8 space-y-12 order-1 lg:order-2">

                <!-- Preamble / Introduction Card -->
                <section class="border-l-4 border-black pl-5 sm:pl-7 py-2 bg-white">
                    <p class="text-base sm:text-lg font-sans text-neutral-900 leading-relaxed font-normal">
                        At <strong>Maze Streetwear</strong> (<a href="https://mazestw.in" target="_blank" rel="noopener noreferrer" class="underline hover:text-neutral-600 transition-colors font-medium">https://mazestw.in</a>), we prioritize precision craftsmanship and premium streetwear standards. If you are not satisfied with your purchase, please review our comprehensive policy regarding returns, size exchanges, and store credit.
                    </p>
                </section>

                <!-- SECTION 1 -->
                <section id="section-1" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">01</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '1. Store Credit Only (No Cash Refunds)', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <div class="p-6 border-2 border-black bg-neutral-50">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-3">
                                <span class="w-2 h-2 bg-black"></span>
                                <h3><?php esc_html_e( 'Non-Monetary Compensation Protocol', 'mazestreetwear' ); ?></h3>
                            </div>
                            <p class="text-base text-neutral-900 font-sans leading-relaxed font-medium mb-4">
                                <?php esc_html_e( 'We do not issue monetary refunds to original payment methods, bank accounts, UPI IDs, or cash. All approved returns are compensated exclusively via Store Credit (issued as a digital gift voucher or store credit code) or an Exchange for an alternate size/garment of equivalent value.', 'mazestreetwear' ); ?>
                            </p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-3 border-t border-neutral-300 font-mono text-xs">
                                <div class="bg-white p-3 border border-neutral-300">
                                    <span class="text-emerald-700 font-bold block mb-1"><?php esc_html_e( '✓ APPROVED REMEDIES', 'mazestreetwear' ); ?></span>
                                    <ul class="text-neutral-700 space-y-1 list-disc list-inside">
                                        <li><?php esc_html_e( 'Digital Store Credit Code', 'mazestreetwear' ); ?></li>
                                        <li><?php esc_html_e( 'Size or Garment Exchange', 'mazestreetwear' ); ?></li>
                                        <li><?php esc_html_e( 'No expiration on Store Credit', 'mazestreetwear' ); ?></li>
                                    </ul>
                                </div>
                                <div class="bg-white p-3 border border-neutral-300">
                                    <span class="text-red-600 font-bold block mb-1"><?php esc_html_e( '✕ NON-ISSUABLE PAYOUTS', 'mazestreetwear' ); ?></span>
                                    <ul class="text-neutral-700 space-y-1 list-disc list-inside">
                                        <li><?php esc_html_e( 'No Cash Refunds', 'mazestreetwear' ); ?></li>
                                        <li><?php esc_html_e( 'No Bank Account Reversals', 'mazestreetwear' ); ?></li>
                                        <li><?php esc_html_e( 'No UPI ID Reversals', 'mazestreetwear' ); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SECTION 2 -->
                <section id="section-2" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">02</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '2. Return & Exchange Window', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <div class="p-5 border border-neutral-300 hover:border-black transition-colors bg-white">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-2">
                                <span class="w-1.5 h-1.5 bg-black"></span>
                                <h3><?php esc_html_e( '7 Calendar Days Window Rule', 'mazestreetwear' ); ?></h3>
                            </div>
                            <p class="text-sm text-neutral-800 font-sans leading-relaxed mb-4">
                                <?php esc_html_e( 'Return and exchange requests must be initiated within 7 calendar days of the date the package is marked as delivered by the courier partner. Requests submitted after 7 days will not be reviewed.', 'mazestreetwear' ); ?>
                            </p>

                            <!-- Visual Timeline -->
                            <div class="border border-black bg-neutral-50 p-4 font-mono text-xs">
                                <span class="text-[10px] uppercase font-bold tracking-widest text-neutral-500 block mb-3">
                                    <?php esc_html_e( 'LIFECYCLE TIMELINE', 'mazestreetwear' ); ?>
                                </span>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                    <div class="p-3 bg-white border border-neutral-300">
                                        <div class="font-bold text-black uppercase mb-1"><?php esc_html_e( 'Day 0 // Delivery', 'mazestreetwear' ); ?></div>
                                        <div class="text-[11px] text-neutral-600 font-sans"><?php esc_html_e( 'Shipment marked delivered by courier tracking timestamp.', 'mazestreetwear' ); ?></div>
                                    </div>
                                    <div class="p-3 bg-white border-2 border-black">
                                        <div class="font-bold text-black uppercase mb-1"><?php esc_html_e( 'Days 1–7 // Eligible', 'mazestreetwear' ); ?></div>
                                        <div class="text-[11px] text-neutral-600 font-sans"><?php esc_html_e( 'Submit email request to enquiries@mazestw.in for review.', 'mazestreetwear' ); ?></div>
                                    </div>
                                    <div class="p-3 bg-neutral-200/60 border border-neutral-300 text-neutral-500">
                                        <div class="font-bold uppercase mb-1"><?php esc_html_e( 'Day 8+ // Ineligible', 'mazestreetwear' ); ?></div>
                                        <div class="text-[11px] font-sans"><?php esc_html_e( 'Return requests will not be reviewed or processed.', 'mazestreetwear' ); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SECTION 3 -->
                <section id="section-3" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">03</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '3. Eligible Return & Exchange Conditions', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <p class="text-sm text-neutral-700 font-sans leading-relaxed">
                            <?php esc_html_e( 'To qualify for store credit or an exchange, garments must satisfy all of the following requirements:', 'mazestreetwear' ); ?>
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            
                            <div class="p-5 border border-black bg-white flex flex-col justify-between">
                                <div>
                                    <span class="text-xs font-mono font-bold text-neutral-400 block mb-2">[01] UNWORN CONDITION</span>
                                    <h3 class="text-sm font-bold uppercase font-sans text-black mb-2"><?php esc_html_e( 'Completely Unused & Unwashed', 'mazestreetwear' ); ?></h3>
                                    <p class="text-xs text-neutral-600 font-sans leading-relaxed">
                                        <?php esc_html_e( 'The item must be completely unused, unwashed, unaltered, and undamaged in any manner.', 'mazestreetwear' ); ?>
                                    </p>
                                </div>
                                <div class="pt-4 mt-4 border-t border-neutral-200 text-[11px] font-mono text-black font-semibold">
                                    <?php esc_html_e( '✓ ZERO SIGNS OF WEAR', 'mazestreetwear' ); ?>
                                </div>
                            </div>

                            <div class="p-5 border border-black bg-white flex flex-col justify-between">
                                <div>
                                    <span class="text-xs font-mono font-bold text-neutral-400 block mb-2">[02] BRANDING INTEGRITY</span>
                                    <h3 class="text-sm font-bold uppercase font-sans text-black mb-2"><?php esc_html_e( 'All Original Tags Attached', 'mazestreetwear' ); ?></h3>
                                    <p class="text-xs text-neutral-600 font-sans leading-relaxed">
                                        <?php esc_html_e( 'The product must retain all original branding, including woven neck labels, care tags, aesthetic hangtags, stickers, and polybags intact.', 'mazestreetwear' ); ?>
                                    </p>
                                </div>
                                <div class="pt-4 mt-4 border-t border-neutral-200 text-[11px] font-mono text-black font-semibold">
                                    <?php esc_html_e( '✓ LABELS & STICKERS INTACT', 'mazestreetwear' ); ?>
                                </div>
                            </div>

                            <div class="p-5 border border-black bg-white flex flex-col justify-between">
                                <div>
                                    <span class="text-xs font-mono font-bold text-neutral-400 block mb-2">[03] PACKAGING COMPLIANCE</span>
                                    <h3 class="text-sm font-bold uppercase font-sans text-black mb-2"><?php esc_html_e( 'Original Protective Wrapping', 'mazestreetwear' ); ?></h3>
                                    <p class="text-xs text-neutral-600 font-sans leading-relaxed">
                                        <?php esc_html_e( 'The garment must be folded and packaged in its original protective wrapping and protective polybag.', 'mazestreetwear' ); ?>
                                    </p>
                                </div>
                                <div class="pt-4 mt-4 border-t border-neutral-200 text-[11px] font-mono text-black font-semibold">
                                    <?php esc_html_e( '✓ FOLDED & SHIELDED', 'mazestreetwear' ); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                <!-- SECTION 4 -->
                <section id="section-4" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">04</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '4. Rejection Criteria', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <p class="text-sm text-neutral-700 font-sans leading-relaxed">
                            <?php esc_html_e( 'Items returned that fail our quality inspection will be rejected immediately. Common reasons for rejection include:', 'mazestreetwear' ); ?>
                        </p>

                        <div class="border border-neutral-300 divide-y divide-neutral-200 bg-white">
                            
                            <div class="p-4 sm:p-5 flex items-start space-x-3">
                                <span class="font-mono text-xs font-bold text-red-600 mt-0.5 flex-shrink-0">[01]</span>
                                <div class="text-sm text-neutral-800 font-sans leading-relaxed">
                                    <strong>Cosmetic &amp; Staining Traces:</strong> <?php esc_html_e( 'Visible traces of makeup, cosmetics, fake tan, food, or oil stains.', 'mazestreetwear' ); ?>
                                </div>
                            </div>

                            <div class="p-4 sm:p-5 flex items-start space-x-3">
                                <span class="font-mono text-xs font-bold text-red-600 mt-0.5 flex-shrink-0">[02]</span>
                                <div class="text-sm text-neutral-800 font-sans leading-relaxed">
                                    <strong>Scent Alterations:</strong> <?php esc_html_e( 'Scent alterations, including perfume, cologne, body odor, smoke, or detergent wash fragrance.', 'mazestreetwear' ); ?>
                                </div>
                            </div>

                            <div class="p-4 sm:p-5 flex items-start space-x-3">
                                <span class="font-mono text-xs font-bold text-red-600 mt-0.5 flex-shrink-0">[03]</span>
                                <div class="text-sm text-neutral-800 font-sans leading-relaxed">
                                    <strong>Missing Labels &amp; Tags:</strong> <?php esc_html_e( 'Missing labels, torn packaging, or detached swing tags.', 'mazestreetwear' ); ?>
                                </div>
                            </div>

                            <div class="p-4 sm:p-5 flex items-start space-x-3">
                                <span class="font-mono text-xs font-bold text-red-600 mt-0.5 flex-shrink-0">[04]</span>
                                <div class="text-sm text-neutral-800 font-sans leading-relaxed">
                                    <strong>Late Damage Notification:</strong> <?php esc_html_e( 'Failure to report damage or defective pieces within the mandatory 48-hour post-delivery window.', 'mazestreetwear' ); ?>
                                </div>
                            </div>

                            <div class="p-4 sm:p-5 flex items-start space-x-3">
                                <span class="font-mono text-xs font-bold text-red-600 mt-0.5 flex-shrink-0">[05]</span>
                                <div class="text-sm text-neutral-800 font-sans leading-relaxed">
                                    <strong>Delayed Transit:</strong> <?php esc_html_e( 'Return packages received or processed after 30 days from the initial request approval date.', 'mazestreetwear' ); ?>
                                </div>
                            </div>

                        </div>

                        <!-- Crucial Notice Box on Non-Compliant Returns -->
                        <div class="p-5 border-2 border-black bg-neutral-900 text-white">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-neutral-300 mb-2">
                                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                                <span><?php esc_html_e( 'NOTE ON NON-COMPLIANT RETURNS', 'mazestreetwear' ); ?></span>
                            </div>
                            <p class="text-sm text-neutral-100 font-sans leading-relaxed">
                                <?php esc_html_e( 'Any package received that violates our condition or hygiene guidelines will be rejected. The item will be returned to the customer at their sole expense, and no store credit will be issued.', 'mazestreetwear' ); ?>
                            </p>
                        </div>
                    </div>
                </section>

                <!-- SECTION 5 -->
                <section id="section-5" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">05</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '5. Shipping Costs, Taxes & Deductions', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            
                            <div class="p-5 border border-black bg-white flex flex-col justify-between">
                                <div>
                                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-black block mb-2">
                                        <?php esc_html_e( 'DEDUCTIONS FROM STORE CREDIT', 'mazestreetwear' ); ?>
                                    </span>
                                    <p class="text-sm text-neutral-800 font-sans leading-relaxed">
                                        <?php esc_html_e( 'For standard returns, the store credit value issued will exclude the original outbound shipping fee, reverse return shipping charges, and applicable courier freight taxes.', 'mazestreetwear' ); ?>
                                    </p>
                                </div>
                                <div class="mt-4 pt-3 border-t border-neutral-200 text-xs font-mono text-neutral-500">
                                    <?php esc_html_e( 'Calculated on Net Garment Value', 'mazestreetwear' ); ?>
                                </div>
                            </div>

                            <div class="p-5 border border-black bg-white flex flex-col justify-between">
                                <div>
                                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-black block mb-2">
                                        <?php esc_html_e( 'EXCHANGE SHIPMENTS', 'mazestreetwear' ); ?>
                                    </span>
                                    <p class="text-sm text-neutral-800 font-sans leading-relaxed">
                                        <?php esc_html_e( 'When exchanging an item for another size or style, the customer is responsible for covering the shipping cost for dispatching the replacement garment prior to shipment.', 'mazestreetwear' ); ?>
                                    </p>
                                </div>
                                <div class="mt-4 pt-3 border-t border-neutral-200 text-xs font-mono text-neutral-500">
                                    <?php esc_html_e( 'Prepaid Replacement Dispatch', 'mazestreetwear' ); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                <!-- SECTION 6 -->
                <section id="section-6" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">06</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '6. Transit Responsibility & Customer Obligations', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <div class="p-5 border border-neutral-300 hover:border-black transition-colors bg-white">
                            <p class="text-sm text-neutral-800 font-sans leading-relaxed mb-4">
                                <?php esc_html_e( 'We are not liable for parcels that are lost, damaged, or delayed during return transit back to our fulfillment facility.', 'mazestreetwear' ); ?>
                            </p>

                            <div class="space-y-3 font-sans text-xs text-neutral-700">
                                <div class="flex items-start space-x-2">
                                    <span class="font-mono text-black font-bold">&bull;</span>
                                    <span><?php esc_html_e( 'Customers returning items must ensure the product is packed securely in tamper-evident packaging.', 'mazestreetwear' ); ?></span>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="font-mono text-black font-bold">&bull;</span>
                                    <span><?php esc_html_e( 'Customers must use a recognized, traceable courier service (e.g., Delhivery, Blue Dart, Speed Post) and provide valid tracking details upon handover.', 'mazestreetwear' ); ?></span>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="font-mono text-black font-bold">&bull;</span>
                                    <span><?php esc_html_e( 'We strongly recommend purchasing transit insurance for high-value apparel shipments.', 'mazestreetwear' ); ?></span>
                                </div>
                            </div>

                            <div class="mt-5 pt-4 border-t border-neutral-200 flex flex-wrap gap-2 text-[10px] font-mono uppercase text-neutral-600">
                                <span class="px-2 py-1 bg-neutral-100 border border-neutral-300"><?php esc_html_e( 'DELHIVERY', 'mazestreetwear' ); ?></span>
                                <span class="px-2 py-1 bg-neutral-100 border border-neutral-300"><?php esc_html_e( 'BLUE DART', 'mazestreetwear' ); ?></span>
                                <span class="px-2 py-1 bg-neutral-100 border border-neutral-300"><?php esc_html_e( 'INDIA SPEED POST', 'mazestreetwear' ); ?></span>
                                <span class="px-2 py-1 bg-black text-white font-bold"><?php esc_html_e( 'TRACKABLE AWB MANDATORY', 'mazestreetwear' ); ?></span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SECTION 7 -->
                <section id="section-7" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">07</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '7. Damaged, Defective, or Incorrect Deliveries', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <div class="p-6 border-2 border-black bg-neutral-50">
                            <span class="text-xs font-mono font-bold uppercase tracking-wider text-black block mb-2">
                                <?php esc_html_e( 'RAPID RESOLUTION PROTOCOL', 'mazestreetwear' ); ?>
                            </span>
                            <p class="text-sm text-neutral-900 font-sans leading-relaxed mb-4">
                                <?php esc_html_e( 'In the rare event that your order arrives damaged, defective, or incorrect:', 'mazestreetwear' ); ?>
                            </p>

                            <ol class="space-y-3 font-sans text-xs text-neutral-800 list-decimal list-inside">
                                <li class="leading-relaxed">
                                    <strong><?php esc_html_e( 'Inspect immediately:', 'mazestreetwear' ); ?></strong> <?php esc_html_e( 'Inspect your parcel immediately upon arrival.', 'mazestreetwear' ); ?>
                                </li>
                                <li class="leading-relaxed">
                                    <strong><?php esc_html_e( 'Contact within 48 Hours:', 'mazestreetwear' ); ?></strong> <?php esc_html_e( 'Contact our support desk at', 'mazestreetwear' ); ?> <a href="mailto:enquiries@mazestw.in" class="underline font-bold text-black">enquiries@mazestw.in</a> <?php esc_html_e( 'within 48 hours of delivery.', 'mazestreetwear' ); ?>
                                </li>
                                <li class="leading-relaxed">
                                    <strong><?php esc_html_e( 'Visual Evidence:', 'mazestreetwear' ); ?></strong> <?php esc_html_e( 'Attach clear, high-resolution photographs or an unboxing video showing the damage, tags, and shipping label.', 'mazestreetwear' ); ?>
                                </li>
                                <li class="leading-relaxed">
                                    <strong><?php esc_html_e( 'Written Authorization:', 'mazestreetwear' ); ?></strong> <?php esc_html_e( 'Do not ship any items back before receiving written return authorization from our team.', 'mazestreetwear' ); ?>
                                </li>
                            </ol>

                            <div class="mt-5 p-4 bg-white border border-black text-xs font-sans text-neutral-800 leading-relaxed">
                                <strong><?php esc_html_e( '100% Brand Logistics Coverage:', 'mazestreetwear' ); ?></strong> <?php esc_html_e( 'Once verified, we will cover all return shipping and replacement dispatch costs for damaged or incorrect garments. The defective piece must still be returned in its original condition with all tags attached to qualify for exchange or store credit.', 'mazestreetwear' ); ?>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SECTION 8 -->
                <section id="section-8" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">08</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '8. How to Request an Exchange or Return', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-6">
                        <!-- Step-by-Step Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            
                            <div class="p-5 border border-black bg-white">
                                <span class="text-xs font-mono font-bold text-neutral-400 block mb-1">STEP 01</span>
                                <h3 class="text-sm font-bold uppercase font-sans text-black mb-2"><?php esc_html_e( 'Email Support Desk', 'mazestreetwear' ); ?></h3>
                                <p class="text-xs text-neutral-600 font-sans leading-relaxed">
                                    <?php esc_html_e( 'Email enquiries@mazestw.in with the subject line: Return Request - Order #[Your Order Number].', 'mazestreetwear' ); ?>
                                </p>
                            </div>

                            <div class="p-5 border border-black bg-white">
                                <span class="text-xs font-mono font-bold text-neutral-400 block mb-1">STEP 02</span>
                                <h3 class="text-sm font-bold uppercase font-sans text-black mb-2"><?php esc_html_e( 'State Order Specifications', 'mazestreetwear' ); ?></h3>
                                <p class="text-xs text-neutral-600 font-sans leading-relaxed">
                                    <?php esc_html_e( 'State your registered customer name, phone number, the specific garment, and whether you are requesting an exchange (specify replacement size) or store credit.', 'mazestreetwear' ); ?>
                                </p>
                            </div>

                            <div class="p-5 border border-black bg-white">
                                <span class="text-xs font-mono font-bold text-neutral-400 block mb-1">STEP 03</span>
                                <h3 class="text-sm font-bold uppercase font-sans text-black mb-2"><?php esc_html_e( 'Await Written Authorization', 'mazestreetwear' ); ?></h3>
                                <p class="text-xs text-neutral-600 font-sans leading-relaxed">
                                    <?php esc_html_e( 'Await approval and shipping instructions from our operations desk before sending any merchandise.', 'mazestreetwear' ); ?>
                                </p>
                            </div>

                            <div class="p-5 border border-black bg-white">
                                <span class="text-xs font-mono font-bold text-neutral-400 block mb-1">STEP 04</span>
                                <h3 class="text-sm font-bold uppercase font-sans text-black mb-2"><?php esc_html_e( 'Courier Dispatch & AWB Notification', 'mazestreetwear' ); ?></h3>
                                <p class="text-xs text-neutral-600 font-sans leading-relaxed">
                                    <?php esc_html_e( 'Once your shipment is handed over to the courier, email us the courier name and valid Air Waybill (AWB) tracking number.', 'mazestreetwear' ); ?>
                                </p>
                            </div>

                        </div>

                        <!-- Copyable Email Template Box -->
                        <div class="border border-black bg-neutral-50 p-5 font-mono text-xs">
                            <div class="flex items-center justify-between pb-3 mb-3 border-b border-neutral-300">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-black">
                                    <?php esc_html_e( 'QUICK EMAIL TEMPLATE', 'mazestreetwear' ); ?>
                                </span>
                                <button type="button" id="maze-copy-template-btn" class="px-2.5 py-1 bg-black text-white hover:bg-neutral-800 transition-colors text-[10px] uppercase font-bold tracking-wider">
                                    <span id="maze-copy-template-text"><?php esc_html_e( 'COPY TEMPLATE', 'mazestreetwear' ); ?></span>
                                </button>
                            </div>
                            <pre id="maze-email-template-content" class="bg-white p-4 border border-neutral-200 text-neutral-800 font-mono text-xs whitespace-pre-wrap leading-relaxed select-all">To: enquiries@mazestw.in
Subject: Return Request - Order #[Your Order Number]

Registered Customer Name: [Your Name]
Registered Phone Number: [Your Phone]
Order Number: [e.g. #1042]
Garment Item(s): [e.g. Maze Heavyweight Oversized Tee - Vintage Black]
Request Type: [Exchange for Size M / Store Credit]
Reason for Request: [e.g. Size Exchange / Fit Adjustment]</pre>
                        </div>
                    </div>
                </section>

                <!-- SECTION 9 -->
                <section id="section-9" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">09</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '9. Customer Support Desk', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="border border-black bg-white">
                        <div class="p-6 border-b border-black bg-neutral-50">
                            <h3 class="text-lg font-bold font-sans uppercase tracking-tight text-black mb-1">
                                <?php esc_html_e( 'Maze Streetwear Concierge Desk', 'mazestreetwear' ); ?>
                            </h3>
                            <p class="text-xs text-neutral-600 font-sans">
                                <?php esc_html_e( 'Our dedicated support team handles return authorizations, sizing guidance, and store credit dispatches.', 'mazestreetwear' ); ?>
                            </p>
                        </div>

                        <div class="divide-y divide-neutral-200 font-mono text-xs">
                            <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <span class="text-neutral-400 uppercase tracking-wider"><?php esc_html_e( 'Brand / Entity', 'mazestreetwear' ); ?></span>
                                <strong class="text-black font-bold"><?php esc_html_e( 'Maze Streetwear', 'mazestreetwear' ); ?></strong>
                            </div>

                            <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <span class="text-neutral-400 uppercase tracking-wider"><?php esc_html_e( 'Official Email', 'mazestreetwear' ); ?></span>
                                <a href="mailto:enquiries@mazestw.in" class="text-black font-bold hover:underline">
                                    enquiries@mazestw.in
                                </a>
                            </div>

                            <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <span class="text-neutral-400 uppercase tracking-wider"><?php esc_html_e( 'Operating Hours', 'mazestreetwear' ); ?></span>
                                <span class="text-black font-medium"><?php esc_html_e( 'Monday to Saturday, 10:00 AM – 6:00 PM IST', 'mazestreetwear' ); ?></span>
                            </div>

                            <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <span class="text-neutral-400 uppercase tracking-wider"><?php esc_html_e( 'Fulfillment Facility', 'mazestreetwear' ); ?></span>
                                <span class="text-black font-medium"><?php esc_html_e( 'Bungkawn Vengthar, A-25, Aizawl, Mizoram - 796005, India', 'mazestreetwear' ); ?></span>
                            </div>

                            <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <span class="text-neutral-400 uppercase tracking-wider"><?php esc_html_e( 'WhatsApp Concierge', 'mazestreetwear' ); ?></span>
                                <a href="https://wa.me/918787324795" target="_blank" rel="noopener noreferrer" class="text-black font-bold hover:underline">
                                    +91 8787324795
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
                // Display any additional dynamic post content if added via the WordPress Editor
                if ( have_posts() ) :
                    while ( have_posts() ) :
                        the_post();
                        $content = get_the_content();
                        if ( ! empty( trim( $content ) ) ) :
                            ?>
                            <div class="pt-8 mt-12 border-t border-neutral-200">
                                <span class="text-xs font-mono font-bold tracking-widest uppercase text-neutral-400 block mb-4">
                                    <?php esc_html_e( 'ADDITIONAL SPECIFIC NOTICES', 'mazestreetwear' ); ?>
                                </span>
                                <div class="entry-content font-sans text-sm text-neutral-800 leading-relaxed space-y-4">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                            <?php
                        endif;
                    endwhile;
                endif;
                ?>

            </article>

        </div>

    </div>
</main>

<script>
// Lightweight interactions for Refund Policy template
(function () {
    // 1. Copy URL
    var copyUrlBtn = document.getElementById('maze-copy-refund-url-btn');
    var copyUrlText = document.getElementById('maze-copy-refund-url-text');
    if (copyUrlBtn && copyUrlText) {
        copyUrlBtn.addEventListener('click', function () {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(window.location.href).then(function () {
                    copyUrlText.textContent = 'COPIED!';
                    setTimeout(function () {
                        copyUrlText.textContent = 'SHARE LINK';
                    }, 2000);
                });
            }
        });
    }

    // 2. Copy Support Email
    var copyEmailBtn = document.getElementById('maze-copy-support-email-btn');
    var copyEmailText = document.getElementById('maze-copy-support-email-text');
    if (copyEmailBtn && copyEmailText) {
        copyEmailBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (navigator.clipboard) {
                navigator.clipboard.writeText('enquiries@mazestw.in').then(function () {
                    copyEmailText.textContent = 'COPIED!';
                    setTimeout(function () {
                        copyEmailText.textContent = 'COPY';
                    }, 2000);
                });
            }
        });
    }

    // 3. Copy Email Template
    var copyTplBtn = document.getElementById('maze-copy-template-btn');
    var copyTplText = document.getElementById('maze-copy-template-text');
    var templateEl = document.getElementById('maze-email-template-content');
    if (copyTplBtn && copyTplText && templateEl) {
        copyTplBtn.addEventListener('click', function () {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(templateEl.textContent).then(function () {
                    copyTplText.textContent = 'COPIED TEMPLATE!';
                    setTimeout(function () {
                        copyTplText.textContent = 'COPY TEMPLATE';
                    }, 2000);
                });
            }
        });
    }

    // 4. Smooth active state for TOC
    var tocLinks = document.querySelectorAll('.maze-refund-toc-link');
    var sections = document.querySelectorAll('article section[id]');

    function updateActiveToc() {
        var scrollY = window.pageYOffset || document.documentElement.scrollTop;
        sections.forEach(function (sec) {
            var top = sec.offsetTop - 180;
            var height = sec.offsetHeight;
            var id = sec.getAttribute('id');
            if (scrollY >= top && scrollY < top + height) {
                tocLinks.forEach(function (link) {
                    if (link.getAttribute('href') === '#' + id) {
                        link.classList.add('bg-neutral-100', 'border-black');
                        link.classList.remove('border-transparent');
                    } else {
                        link.classList.remove('bg-neutral-100', 'border-black');
                        link.classList.add('border-transparent');
                    }
                });
            }
        });
    }

    window.addEventListener('scroll', updateActiveToc, { passive: true });
})();
</script>

<?php
get_footer();
