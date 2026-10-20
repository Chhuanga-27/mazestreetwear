<?php
/**
 * Template Name: Shipping & Delivery Policy
 *
 * Official Shipping, Delivery & Dispatch Policy page template for Maze Streetwear (mazestw.in).
 * Formatted under Indian E-Commerce consumer guidelines, logistics aggregator protocols, and brand standards.
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$shipping_url = function_exists( 'mazestreetwear_get_shipping_policy_url' ) ? mazestreetwear_get_shipping_policy_url() : home_url( '/shipping-policy/' );
$account_url  = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : home_url( '/my-account/' );
?>

<!-- Schema.org JSON-LD for Shipping Policy SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Shipping & Delivery Policy - Maze Streetwear",
  "url": "<?php echo esc_url( $shipping_url ); ?>",
  "description": "Official Shipping & Delivery Policy of Maze Streetwear (mazestw.in) outlining serviceable areas across India, 24-48h dispatch timelines, courier tracking via Delhivery/Blue Dart/DTDC/India Post, transit fees, and support protocols.",
  "datePublished": "2026-10-15",
  "dateModified": "2026-10-15",
  "publisher": {
    "@type": "Organization",
    "name": "Maze Streetwear",
    "legalName": "LALHRUAIZELA SAILO",
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
      "contactType": "Fulfillment & Logistics Support",
      "email": "enquiries@mazestw.in",
      "availableLanguage": ["English", "Hindi", "Mizo"]
    }
  }
}
</script>

<main id="primary" class="site-main min-h-screen bg-white text-black py-8 sm:py-14 lg:py-16">
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

                <button type="button" id="maze-copy-shipping-url-btn" class="inline-flex items-center space-x-1.5 hover:text-black transition-colors px-3 py-1.5 border border-black hover:bg-neutral-100 bg-white rounded-none text-xs uppercase tracking-wider">
                    <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-3.35l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                    </svg>
                    <span id="maze-copy-shipping-url-text"><?php esc_html_e( 'SHARE LINK', 'mazestreetwear' ); ?></span>
                </button>
            </div>
        </div>

        <!-- Editorial Document Header -->
        <header class="mb-12 pb-8 border-b-2 border-black">
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <span class="inline-flex items-center space-x-2 text-xs sm:text-sm font-mono font-bold tracking-widest text-black uppercase border border-black px-3.5 py-1.5 bg-white">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span><?php esc_html_e( 'MAZE PROTOCOL // SHIPPING & DISPATCH REF: SHIP-2026-V1', 'mazestreetwear' ); ?></span>
                </span>
                <span class="inline-block text-xs sm:text-sm font-mono font-bold tracking-widest text-white uppercase border border-black px-3.5 py-1.5 bg-black">
                    <?php esc_html_e( 'DOMESTIC INDIA FULFILLMENT // EXPRESS COURIER TRACKED', 'mazestreetwear' ); ?>
                </span>
            </div>

            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black font-sans uppercase tracking-tight text-black mb-6">
                <?php esc_html_e( 'Shipping & Delivery Policy', 'mazestreetwear' ); ?>
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
                    <span class="block text-xs uppercase tracking-wider text-neutral-700 font-bold mb-1"><?php esc_html_e( 'Fulfillment Window', 'mazestreetwear' ); ?></span>
                    <strong class="font-black text-black text-sm sm:text-base"><?php esc_html_e( '24 to 48 Business Hours', 'mazestreetwear' ); ?></strong>
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
        <section class="mb-14 border border-black bg-neutral-50 no-print" aria-label="<?php esc_attr_e( 'Shipping Policy Highlights', 'mazestreetwear' ); ?>">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-black">
                
                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">01 // COVERAGE</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( 'All India Pincodes', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( 'Nationwide domestic fulfillment supported by Delhivery, Blue Dart, DTDC, and India Post.', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">02 // DISPATCH SPEED</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( '24 – 48 Business Hours', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( 'Prepaid orders undergo strict quality inspection and are handed to carriers within 1 to 2 business days.', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">03 // TRANSIT TIME</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( '2 – 7 Business Days', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( '2 to 4 days for Tier 1 metros; 4 to 7 days for Tier 2/3 cities; 6 to 9 days for remote regional areas.', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">04 // PARCEL SECURITY</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( 'Tamper-Evident Polybags', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( 'High-security sealed packaging. Inspect before receiving and reject immediately if torn or compromised.', 'mazestreetwear' ); ?>
                    </p>
                </div>

            </div>
        </section>

        <!-- Two-Column Editorial Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

            <!-- Left Sticky Sidebar: Navigation, Tracking Hub & Support Card -->
            <aside class="lg:col-span-4 lg:sticky lg:top-28 space-y-6 no-print order-2 lg:order-1">
                
                <!-- Table of Contents -->
                <div class="border border-black p-5 sm:p-6 bg-white">
                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-black">
                        <span class="text-sm font-mono font-bold uppercase tracking-wider text-black">
                            <?php esc_html_e( 'DOCUMENT INDEX', 'mazestreetwear' ); ?>
                        </span>
                        <span class="text-xs font-mono font-bold text-neutral-700">8 SECTIONS</span>
                    </div>

                    <nav class="space-y-1 font-mono text-xs sm:text-sm">
                        <a href="#section-1" class="maze-shipping-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>01. Serviceable Areas & Coverage</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-2" class="maze-shipping-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>02. Processing & Dispatch Timelines</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-3" class="maze-shipping-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>03. Estimated Delivery Timelines</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-4" class="maze-shipping-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>04. Shipping Charges & Thresholds</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-5" class="maze-shipping-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>05. Tracking Your Shipment</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-6" class="maze-shipping-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>06. Failed Delivery & Address Errors</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-7" class="maze-shipping-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>07. Package Tampering & Verification</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-8" class="maze-shipping-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>08. Shipping Support Desk</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                    </nav>
                </div>

                <!-- Carrier Tracking Hub Capsule -->
                <div class="border border-black p-5 sm:p-6 bg-neutral-50 text-black">
                    <span class="text-xs font-mono font-bold uppercase tracking-widest text-neutral-700 block mb-1">
                        <?php esc_html_e( 'CONSIGNMENT LOOKUP', 'mazestreetwear' ); ?>
                    </span>
                    <h3 class="text-base font-bold font-sans uppercase tracking-tight mb-2">
                        <?php esc_html_e( 'Official Courier Portals', 'mazestreetwear' ); ?>
                    </h3>
                    <p class="text-sm text-neutral-800 font-sans leading-relaxed mb-4 font-normal">
                        <?php esc_html_e( 'Track your unique Air Waybill (AWB) directly on our carrier partner portals or access live updates from your account dashboard.', 'mazestreetwear' ); ?>
                    </p>

                    <div class="grid grid-cols-2 gap-2.5 font-mono text-xs sm:text-sm mb-3">
                        <a href="https://www.delhivery.com/tracking" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-2.5 bg-white border border-black hover:bg-black hover:text-white transition-colors group">
                            <span class="font-bold text-xs sm:text-sm">Delhivery</span>
                            <span class="text-xs group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                        </a>
                        <a href="https://www.bluedart.com/tracking" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-2.5 bg-white border border-black hover:bg-black hover:text-white transition-colors group">
                            <span class="font-bold text-xs sm:text-sm">Blue Dart</span>
                            <span class="text-xs group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                        </a>
                        <a href="https://www.dtdc.in/tracking.asp" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-2.5 bg-white border border-black hover:bg-black hover:text-white transition-colors group">
                            <span class="font-bold text-xs sm:text-sm">DTDC</span>
                            <span class="text-xs group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                        </a>
                        <a href="https://www.indiapost.gov.in/_layouts/15/dpt.cpt.content/tracking.aspx" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-2.5 bg-white border border-black hover:bg-black hover:text-white transition-colors group">
                            <span class="font-bold text-xs sm:text-sm">India Post</span>
                            <span class="text-xs group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                        </a>
                    </div>

                    <a href="<?php echo esc_url( $account_url ); ?>" class="block w-full text-center py-3 bg-black text-white hover:bg-neutral-800 font-mono text-xs sm:text-sm font-bold uppercase tracking-wider transition-colors">
                        <?php esc_html_e( 'MY ACCOUNT ORDERS →', 'mazestreetwear' ); ?>
                    </a>
                </div>

                <!-- Quick Help / Logistics Desk Capsule -->
                <div class="border border-black p-5 sm:p-6 bg-white text-black">
                    <span class="text-[10px] font-mono font-bold uppercase tracking-widest text-neutral-500 block mb-1">
                        <?php esc_html_e( 'NEED ASSISTANCE?', 'mazestreetwear' ); ?>
                    </span>
                    <h3 class="text-base font-bold font-sans uppercase tracking-tight mb-2">
                        <?php esc_html_e( 'Shipping & Dispatch Desk', 'mazestreetwear' ); ?>
                    </h3>
                    <p class="text-xs text-neutral-600 font-sans leading-relaxed mb-4">
                        <?php esc_html_e( 'For delayed packages, pre-dispatch address changes, or consignment questions, our operations team is available Monday to Saturday.', 'mazestreetwear' ); ?>
                    </p>

                    <div class="space-y-2 font-mono text-xs">
                        <a href="mailto:enquiries@mazestw.in?subject=Shipping%20Inquiry%20-%20Order%20%23[Your%20Order%20Number]&body=Registered%20Customer%20Name:%0D%0AContact%20Number:%0D%0AOrder%20Number:%0D%0AAWB%20Tracking%20Number%20(if%20received):%0D%0AInquiry%20Details:" class="flex items-center justify-between p-2.5 bg-black text-white hover:bg-neutral-800 transition-colors group">
                            <span class="font-medium"><?php esc_html_e( 'EMAIL SHIPPING DESK', 'mazestreetwear' ); ?></span>
                            <span class="text-[11px] uppercase tracking-wider group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                        </a>
                        <div class="flex items-center justify-between p-2.5 bg-neutral-50 border border-black text-black">
                            <span class="font-medium truncate mr-2">enquiries@mazestw.in</span>
                            <button type="button" id="maze-copy-support-email-btn" class="text-[10px] uppercase font-bold tracking-wider hover:underline flex-shrink-0">
                                <span id="maze-copy-support-email-text"><?php esc_html_e( 'COPY', 'mazestreetwear' ); ?></span>
                            </button>
                        </div>
                        <a href="https://wa.me/918787324795" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-2.5 bg-white border border-black hover:bg-black hover:text-white transition-colors group">
                            <span class="font-medium">+91 8787324795</span>
                            <span class="text-[11px] uppercase tracking-wider group-hover:translate-x-0.5 transition-transform">WhatsApp &rarr;</span>
                        </a>
                    </div>

                    <div class="pt-3 mt-4 border-t border-neutral-200 text-[11px] font-mono text-neutral-500">
                        <?php esc_html_e( 'Mon – Sat: 10:00 AM – 6:00 PM IST', 'mazestreetwear' ); ?>
                    </div>
                </div>

                <!-- Related Legal Protocols -->
                <div class="p-5 border border-neutral-200 bg-white">
                    <span class="text-[10px] font-mono font-bold uppercase tracking-widest text-neutral-400 block mb-3">
                        <?php esc_html_e( 'RELATED PROTOCOLS', 'mazestreetwear' ); ?>
                    </span>
                    <ul class="space-y-2 text-xs font-sans">
                        <li>
                            <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_refund_policy_url' ) ? mazestreetwear_get_refund_policy_url() : home_url( '/refund-policy/' ) ); ?>" class="text-neutral-700 hover:text-black underline-offset-4 hover:underline flex items-center justify-between">
                                <span><?php esc_html_e( 'Refund & Exchange Policy', 'mazestreetwear' ); ?></span>
                                <span class="text-neutral-400 font-mono text-[11px]">&rarr;</span>
                            </a>
                        </li>
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
                    </ul>
                </div>

            </aside>

            <!-- Right Column: Document Content -->
            <article class="lg:col-span-8 space-y-12 order-1 lg:order-2">

                <!-- Preamble / Introduction Card -->
                <section class="border-l-4 border-black pl-5 sm:pl-7 py-2 bg-white">
                    <p class="text-base sm:text-lg font-sans text-neutral-900 leading-relaxed font-normal">
                        At <strong>Maze Streetwear</strong> (<a href="https://mazestw.in" target="_blank" rel="noopener noreferrer" class="underline hover:text-neutral-600 transition-colors font-medium">https://mazestw.in</a>), operated by registered legal entity <strong>LALHRUAIZELA SAILO</strong>, we ensure every garment is handled, inspected, and dispatched with precision. This Shipping & Delivery Policy outlines the terms, timelines, transit fees, and procedures governing all orders placed on our website.
                    </p>
                </section>

                <!-- SECTION 1 -->
                <section id="section-1" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">01</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '1. Serviceable Areas & Coverage', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <div class="p-6 border-2 border-black bg-neutral-50">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-3">
                                <span class="w-2 h-2 bg-black"></span>
                                <h3><?php esc_html_e( 'Domestic Indian Network Coverage', 'mazestreetwear' ); ?></h3>
                            </div>
                            <p class="text-base text-neutral-900 font-sans leading-relaxed font-medium mb-4">
                                <?php esc_html_e( 'We currently process and ship orders across the Republic of India to all domestic pincodes supported by our logistics aggregators and national courier partners (including Delhivery, Blue Dart, DTDC, and India Post).', 'mazestreetwear' ); ?>
                            </p>

                            <!-- Logistics Carrier Badges Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-3 border-t border-neutral-300 font-mono text-xs">
                                <div class="bg-white p-3 border border-neutral-300 text-center">
                                    <span class="font-bold text-black block mb-0.5"><?php esc_html_e( 'DELHIVERY', 'mazestreetwear' ); ?></span>
                                    <span class="text-[10px] text-neutral-500 uppercase"><?php esc_html_e( 'Surface & Air Express', 'mazestreetwear' ); ?></span>
                                </div>
                                <div class="bg-white p-3 border border-neutral-300 text-center">
                                    <span class="font-bold text-black block mb-0.5"><?php esc_html_e( 'BLUE DART', 'mazestreetwear' ); ?></span>
                                    <span class="text-[10px] text-neutral-500 uppercase"><?php esc_html_e( 'Express Cargo & Metro', 'mazestreetwear' ); ?></span>
                                </div>
                                <div class="bg-white p-3 border border-neutral-300 text-center">
                                    <span class="font-bold text-black block mb-0.5"><?php esc_html_e( 'DTDC', 'mazestreetwear' ); ?></span>
                                    <span class="text-[10px] text-neutral-500 uppercase"><?php esc_html_e( 'National Priority', 'mazestreetwear' ); ?></span>
                                </div>
                                <div class="bg-white p-3 border border-neutral-300 text-center">
                                    <span class="font-bold text-black block mb-0.5"><?php esc_html_e( 'INDIA POST', 'mazestreetwear' ); ?></span>
                                    <span class="text-[10px] text-neutral-500 uppercase"><?php esc_html_e( 'Speed Post Remote Pincodes', 'mazestreetwear' ); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- International Notice Callout -->
                        <div class="p-5 border border-neutral-300 bg-white flex items-start space-x-3">
                            <span class="text-neutral-500 font-mono font-bold text-sm select-none">ℹ</span>
                            <div>
                                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-black mb-1">
                                    <?php esc_html_e( 'INTERNATIONAL SHIPMENTS ADVISORY', 'mazestreetwear' ); ?>
                                </h4>
                                <p class="text-sm text-neutral-700 font-sans leading-relaxed">
                                    <strong><?php esc_html_e( 'Note:', 'mazestreetwear' ); ?></strong> <?php esc_html_e( 'We do not process international shipments at this time. All orders must be bound for a verifiable Indian domestic pincode. Orders with international delivery coordinates will not be authorized for dispatch.', 'mazestreetwear' ); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SECTION 2 -->
                <section id="section-2" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">02</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '2. Order Processing & Dispatch Timelines', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <div class="p-5 border border-neutral-300 hover:border-black transition-colors bg-white">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-2">
                                <span class="w-1.5 h-1.5 bg-black"></span>
                                <h3><?php esc_html_e( '24 to 48 Hours Dispatch Window', 'mazestreetwear' ); ?></h3>
                            </div>
                            <p class="text-sm text-neutral-800 font-sans leading-relaxed mb-4">
                                <strong><?php esc_html_e( 'Dispatch Window:', 'mazestreetwear' ); ?></strong> <?php esc_html_e( 'Verified prepaid orders are processed, packed, and handed over to courier carriers within 24 to 48 business hours following successful payment authorization.', 'mazestreetwear' ); ?>
                            </p>

                            <!-- Operational Hours & Weekend Queue -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-3 border-t border-neutral-200 font-mono text-xs">
                                <div class="bg-neutral-50 p-3.5 border border-neutral-200">
                                    <span class="text-black font-bold block mb-1 uppercase tracking-wider"><?php esc_html_e( 'OPERATING SCHEDULE', 'mazestreetwear' ); ?></span>
                                    <p class="text-neutral-600 font-sans leading-relaxed text-xs">
                                        <?php esc_html_e( 'Our fulfillment and warehousing team operates Monday to Saturday (10:00 AM – 6:00 PM IST).', 'mazestreetwear' ); ?>
                                    </p>
                                </div>
                                <div class="bg-neutral-50 p-3.5 border border-neutral-200">
                                    <span class="text-black font-bold block mb-1 uppercase tracking-wider"><?php esc_html_e( 'WEEKEND & HOLIDAY QUEUE', 'mazestreetwear' ); ?></span>
                                    <p class="text-neutral-600 font-sans leading-relaxed text-xs">
                                        <?php esc_html_e( 'Orders placed on Saturday afternoon, Sunday, or public/gazetted holidays are queued and processed on the following business day.', 'mazestreetwear' ); ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Step-by-Step Fulfillment Pipeline Visualization -->
                        <div class="p-5 border border-black bg-white">
                            <span class="text-[10px] font-mono font-bold tracking-widest text-neutral-500 block mb-3 uppercase">
                                <?php esc_html_e( 'THE MAZE DISPATCH PIPELINE', 'mazestreetwear' ); ?>
                            </span>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 font-mono text-xs">
                                <div class="p-3 border border-neutral-200 bg-neutral-50">
                                    <span class="text-[10px] text-neutral-400 block mb-1">STAGE 01</span>
                                    <strong class="text-black block mb-1 uppercase text-xs"><?php esc_html_e( 'Payment & Verification', 'mazestreetwear' ); ?></strong>
                                    <span class="text-[11px] text-neutral-600 font-sans block"><?php esc_html_e( 'Automated gateway verification and inventory allocation.', 'mazestreetwear' ); ?></span>
                                </div>
                                <div class="p-3 border border-neutral-200 bg-neutral-50">
                                    <span class="text-[10px] text-neutral-400 block mb-1">STAGE 02</span>
                                    <strong class="text-black block mb-1 uppercase text-xs"><?php esc_html_e( 'Garment QC & Sealing', 'mazestreetwear' ); ?></strong>
                                    <span class="text-[11px] text-neutral-600 font-sans block"><?php esc_html_e( 'Individual fabric inspection and tamper-evident polybag sealing.', 'mazestreetwear' ); ?></span>
                                </div>
                                <div class="p-3 border border-neutral-200 bg-neutral-50">
                                    <span class="text-[10px] text-neutral-400 block mb-1">STAGE 03</span>
                                    <strong class="text-black block mb-1 uppercase text-xs"><?php esc_html_e( 'Handover & AWB Live', 'mazestreetwear' ); ?></strong>
                                    <span class="text-[11px] text-neutral-600 font-sans block"><?php esc_html_e( 'Carrier custody scan, AWB generated, tracking sent via SMS/WhatsApp.', 'mazestreetwear' ); ?></span>
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
                            <?php esc_html_e( '3. Estimated Delivery Timelines', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <p class="text-sm text-neutral-800 font-sans leading-relaxed">
                            <?php esc_html_e( 'Once your order has been dispatched from our fulfillment facility, estimated delivery transit windows across Indian regions are as follows:', 'mazestreetwear' ); ?>
                        </p>

                        <!-- Delivery Windows Matrix -->
                        <div class="border border-black overflow-hidden bg-white">
                            <table class="w-full text-left font-sans text-xs sm:text-sm">
                                <thead class="bg-black text-white font-mono uppercase text-[10px] sm:text-xs">
                                    <tr>
                                        <th class="py-3 px-4 sm:px-6"><?php esc_html_e( 'Destination Region & Tier', 'mazestreetwear' ); ?></th>
                                        <th class="py-3 px-4 sm:px-6"><?php esc_html_e( 'Coverage Examples', 'mazestreetwear' ); ?></th>
                                        <th class="py-3 px-4 sm:px-6 whitespace-nowrap"><?php esc_html_e( 'Transit Window', 'mazestreetwear' ); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200">
                                    <tr class="hover:bg-neutral-50 transition-colors">
                                        <td class="py-3.5 px-4 sm:px-6 font-bold text-black">
                                            <?php esc_html_e( 'Tier 1 & Metro Cities', 'mazestreetwear' ); ?>
                                        </td>
                                        <td class="py-3.5 px-4 sm:px-6 text-neutral-600">
                                            <?php esc_html_e( 'Delhi NCR, Mumbai, Bengaluru, Kolkata, Chennai, Hyderabad', 'mazestreetwear' ); ?>
                                        </td>
                                        <td class="py-3.5 px-4 sm:px-6 font-mono font-bold text-black whitespace-nowrap">
                                            <span class="inline-block px-2 py-0.5 bg-neutral-100 border border-neutral-300">
                                                <?php esc_html_e( '2 to 4 Business Days', 'mazestreetwear' ); ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-neutral-50 transition-colors">
                                        <td class="py-3.5 px-4 sm:px-6 font-bold text-black">
                                            <?php esc_html_e( 'Tier 2 & Tier 3 Regional Cities', 'mazestreetwear' ); ?>
                                        </td>
                                        <td class="py-3.5 px-4 sm:px-6 text-neutral-600">
                                            <?php esc_html_e( 'State capitals, major commercial districts, and urban regional centres', 'mazestreetwear' ); ?>
                                        </td>
                                        <td class="py-3.5 px-4 sm:px-6 font-mono font-bold text-black whitespace-nowrap">
                                            <span class="inline-block px-2 py-0.5 bg-neutral-100 border border-neutral-300">
                                                <?php esc_html_e( '4 to 7 Business Days', 'mazestreetwear' ); ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-neutral-50 transition-colors">
                                        <td class="py-3.5 px-4 sm:px-6 font-bold text-black">
                                            <?php esc_html_e( 'Northeast, J&K & Remote Regional Pincodes', 'mazestreetwear' ); ?>
                                        </td>
                                        <td class="py-3.5 px-4 sm:px-6 text-neutral-600">
                                            <?php esc_html_e( 'Northeastern states, Jammu & Kashmir, Ladakh, island union territories, and rural interior pin codes', 'mazestreetwear' ); ?>
                                        </td>
                                        <td class="py-3.5 px-4 sm:px-6 font-mono font-bold text-black whitespace-nowrap">
                                            <span class="inline-block px-2 py-0.5 bg-neutral-100 border border-neutral-300">
                                                <?php esc_html_e( '6 to 9 Business Days', 'mazestreetwear' ); ?>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Transit Disclaimer Notice -->
                        <div class="p-5 border border-neutral-300 bg-neutral-50">
                            <span class="text-xs font-mono font-bold uppercase tracking-wider text-black block mb-2">
                                <?php esc_html_e( 'LOGISTICS PARTNER ESTIMATES DISCLAIMER', 'mazestreetwear' ); ?>
                            </span>
                            <p class="text-sm text-neutral-700 font-sans leading-relaxed">
                                <strong><?php esc_html_e( 'Disclaimer:', 'mazestreetwear' ); ?></strong> <?php esc_html_e( 'Delivery timeframes are logistics partner estimates. Unforeseen courier disruptions, adverse weather conditions, local holidays, or high-volume festive rushes may cause minor transit variations beyond our direct control. Our support team actively assists in monitoring and resolving delayed consignments.', 'mazestreetwear' ); ?>
                            </p>
                        </div>
                    </div>
                </section>

                <!-- SECTION 4 -->
                <section id="section-4" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">04</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '4. Shipping Charges & Thresholds', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <div class="p-6 border-2 border-black bg-white">
                            <div class="flex items-center justify-between mb-3 border-b border-neutral-200 pb-3">
                                <span class="text-xs font-mono font-bold uppercase tracking-wider text-black">
                                    <?php esc_html_e( 'STANDARD DOMESTIC SHIPPING RULE', 'mazestreetwear' ); ?>
                                </span>
                                <span class="inline-block px-2.5 py-0.5 bg-black text-white font-mono text-[11px] font-bold uppercase">
                                    <?php esc_html_e( 'FREE SHIPPING APPLIED', 'mazestreetwear' ); ?>
                                </span>
                            </div>

                            <p class="text-base text-neutral-900 font-sans leading-relaxed font-medium mb-4">
                                <?php esc_html_e( 'We offer Complimentary Free Standard Shipping across India on all prepaid orders placed on mazestw.in.', 'mazestreetwear' ); ?>
                            </p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 font-sans text-xs text-neutral-700">
                                <div class="p-3.5 bg-neutral-50 border border-neutral-200">
                                    <strong class="text-black font-mono block mb-1 uppercase text-xs"><?php esc_html_e( 'Transparent Checkout Calculation', 'mazestreetwear' ); ?></strong>
                                    <p class="leading-relaxed">
                                        <?php esc_html_e( 'All applicable shipping charges and promotions are clearly displayed and calculated in the order summary on the checkout page prior to final payment completion.', 'mazestreetwear' ); ?>
                                    </p>
                                </div>
                                <div class="p-3.5 bg-neutral-50 border border-neutral-200">
                                    <strong class="text-black font-mono block mb-1 uppercase text-xs"><?php esc_html_e( 'Zero Hidden Fees', 'mazestreetwear' ); ?></strong>
                                    <p class="leading-relaxed">
                                        <?php esc_html_e( 'The price displayed at final checkout is all-inclusive. You will never be asked to pay additional transit levies or courier cash surcharges at your doorstep.', 'mazestreetwear' ); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SECTION 5 -->
                <section id="section-5" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">05</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '5. Tracking Your Shipment', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <div class="p-5 border border-neutral-300 hover:border-black transition-colors bg-white">
                            <p class="text-sm text-neutral-800 font-sans leading-relaxed mb-4">
                                <?php esc_html_e( 'Upon parcel handover to the carrier, an automated dispatch notification is sent to your registered email address and contact number via SMS/WhatsApp.', 'mazestreetwear' ); ?>
                            </p>

                            <div class="space-y-3 font-sans text-xs text-neutral-700">
                                <div class="flex items-start space-x-2">
                                    <span class="font-mono text-black font-bold">&bull;</span>
                                    <span>
                                        <strong><?php esc_html_e( 'AWB / Tracking Number:', 'mazestreetwear' ); ?></strong> 
                                        <?php esc_html_e( 'The dispatch notification contains the assigned courier service name (e.g. Delhivery, Blue Dart, DTDC, India Post) and your unique Air Waybill (AWB) tracking reference.', 'mazestreetwear' ); ?>
                                    </span>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="font-mono text-black font-bold">&bull;</span>
                                    <span>
                                        <strong><?php esc_html_e( 'Real-Time Courier Tracking Link:', 'mazestreetwear' ); ?></strong> 
                                        <?php esc_html_e( 'Customers can track their consignment journey in real time via the courier portal link embedded in the dispatch SMS/email notification.', 'mazestreetwear' ); ?>
                                    </span>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="font-mono text-black font-bold">&bull;</span>
                                    <span>
                                        <strong><?php esc_html_e( 'Account Order History:', 'mazestreetwear' ); ?></strong> 
                                        <?php esc_html_e( 'You can also check shipment progress at any time by logging into your account dashboard at', 'mazestreetwear' ); ?>
                                        <a href="<?php echo esc_url( $account_url ); ?>" class="underline font-bold text-black hover:text-neutral-600 transition-colors">https://mazestw.in/my-account</a>.
                                    </span>
                                </div>
                            </div>

                            <!-- Tracking Quick Jump Form UI -->
                            <div class="mt-6 pt-5 border-t border-neutral-200 bg-neutral-50 p-4 border">
                                <label for="maze-user-awb-input" class="block text-xs font-mono font-bold uppercase tracking-wider text-black mb-1">
                                    <?php esc_html_e( 'HAVE AN AIR WAYBILL (AWB) NUMBER?', 'mazestreetwear' ); ?>
                                </label>
                                <p class="text-[11px] text-neutral-500 font-sans mb-3">
                                    <?php esc_html_e( 'Paste your tracking code below and jump directly to your carrier’s live tracker.', 'mazestreetwear' ); ?>
                                </p>
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <input 
                                        type="text" 
                                        id="maze-user-awb-input" 
                                        placeholder="e.g. DELH123456789 or 77889900" 
                                        class="flex-1 px-3 py-2 border border-black font-mono text-xs focus:outline-none focus:ring-1 focus:ring-black bg-white"
                                    />
                                    <div class="flex gap-2">
                                        <button 
                                            type="button" 
                                            id="maze-track-delhivery-btn" 
                                            class="px-3 py-2 bg-black text-white hover:bg-neutral-800 font-mono text-xs uppercase tracking-wider transition-colors"
                                        >
                                            <?php esc_html_e( 'DELHIVERY', 'mazestreetwear' ); ?>
                                        </button>
                                        <button 
                                            type="button" 
                                            id="maze-track-bluedart-btn" 
                                            class="px-3 py-2 bg-white text-black border border-black hover:bg-neutral-100 font-mono text-xs uppercase tracking-wider transition-colors"
                                        >
                                            <?php esc_html_e( 'BLUE DART', 'mazestreetwear' ); ?>
                                        </button>
                                    </div>
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
                            <?php esc_html_e( '6. Incomplete / Incorrect Addresses & Failed Delivery Attempts', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <div class="p-5 border border-neutral-300 hover:border-black transition-colors bg-white">
                            <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-black mb-2">
                                <?php esc_html_e( 'Customer Information Accuracy Obligation', 'mazestreetwear' ); ?>
                            </h3>
                            <p class="text-sm text-neutral-800 font-sans leading-relaxed mb-4">
                                <?php esc_html_e( 'Customers are responsible for providing complete, accurate delivery information—including recipient name, flat/building number, street landmark, correct 6-digit postal pincode, and an active mobile number.', 'mazestreetwear' ); ?>
                            </p>

                            <!-- Mandatory Checklist -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4 font-mono text-xs">
                                <div class="bg-neutral-50 p-3 border border-neutral-200">
                                    <span class="font-bold text-black block mb-1">✓ MANDATORY DETAILS</span>
                                    <ul class="text-neutral-600 space-y-1 list-disc list-inside">
                                        <li><?php esc_html_e( 'Full Recipient Legal Name', 'mazestreetwear' ); ?></li>
                                        <li><?php esc_html_e( 'Flat, Floor & Building Name', 'mazestreetwear' ); ?></li>
                                        <li><?php esc_html_e( 'Prominent Landmark', 'mazestreetwear' ); ?></li>
                                        <li><?php esc_html_e( 'Active 10-Digit Mobile Phone', 'mazestreetwear' ); ?></li>
                                        <li><?php esc_html_e( 'Accurate 6-Digit Indian Pincode', 'mazestreetwear' ); ?></li>
                                    </ul>
                                </div>

                                <div class="bg-neutral-50 p-3 border border-neutral-200">
                                    <span class="font-bold text-black block mb-1">✕ COMMON ERRORS TO AVOID</span>
                                    <ul class="text-neutral-600 space-y-1 list-disc list-inside">
                                        <li><?php esc_html_e( 'Mismatched city vs pincode', 'mazestreetwear' ); ?></li>
                                        <li><?php esc_html_e( 'Unreachable or switched-off phone', 'mazestreetwear' ); ?></li>
                                        <li><?php esc_html_e( 'Missing door/apartment number', 'mazestreetwear' ); ?></li>
                                        <li><?php esc_html_e( 'Unattended gated society delivery', 'mazestreetwear' ); ?></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Carrier Attempts & RTO Rule -->
                            <div class="p-4 border border-black bg-neutral-50 font-sans text-xs text-neutral-800 space-y-2">
                                <p>
                                    <strong><?php esc_html_e( 'Courier Delivery Attempts Protocol:', 'mazestreetwear' ); ?></strong>
                                    <?php esc_html_e( 'Couriers will make up to 2 to 3 delivery attempts and attempt telephone contact before initiating a Return to Origin (RTO) back to our facility.', 'mazestreetwear' ); ?>
                                </p>
                                <p>
                                    <strong><?php esc_html_e( 'Re-Dispatch Charges:', 'mazestreetwear' ); ?></strong>
                                    <?php esc_html_e( 'If a package is returned due to incorrect address entry, unreachable contact details, or package refusal, re-dispatch charges must be cleared by the customer before the order can be re-shipped.', 'mazestreetwear' ); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SECTION 7 -->
                <section id="section-7" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">07</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '7. Package Tampering & Delivery Verification', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <div class="p-6 border-2 border-black bg-neutral-50">
                            <span class="text-xs font-mono font-bold uppercase tracking-wider text-black block mb-2">
                                <?php esc_html_e( 'DELIVERY VERIFICATION & MANDATORY INSPECTION', 'mazestreetwear' ); ?>
                            </span>
                            <p class="text-base text-neutral-900 font-sans leading-relaxed font-medium mb-4">
                                <?php esc_html_e( 'If the external tamper-evident polybag or branded packaging appears opened, damaged, or severely torn at the time of delivery: DO NOT accept or sign for the package.', 'mazestreetwear' ); ?>
                            </p>

                            <!-- Actionable Steps -->
                            <div class="space-y-3 font-sans text-xs text-neutral-700 bg-white p-4 border border-neutral-300">
                                <div class="flex items-start space-x-2">
                                    <span class="font-mono text-black font-bold">1.</span>
                                    <span>
                                        <strong><?php esc_html_e( 'Refuse Acceptance Immediately:', 'mazestreetwear' ); ?></strong>
                                        <?php esc_html_e( 'Instruct the courier personnel to mark the consignment as "Refused Due to Damaged/Tampered Packaging". Do not sign or provide OTP.', 'mazestreetwear' ); ?>
                                    </span>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="font-mono text-black font-bold">2.</span>
                                    <span>
                                        <strong><?php esc_html_e( 'Capture Clear Photographic Proof:', 'mazestreetwear' ); ?></strong>
                                        <?php esc_html_e( 'Photograph the damaged exterior, visible tears, and the shipping label displaying the AWB clearly.', 'mazestreetwear' ); ?>
                                    </span>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="font-mono text-black font-bold">3.</span>
                                    <span>
                                        <strong><?php esc_html_e( 'Notify Customer Support Within 48 Hours:', 'mazestreetwear' ); ?></strong>
                                        <?php esc_html_e( 'Report the incident immediately to our customer desk at enquiries@mazestw.in with clear photographs of the compromised parcel.', 'mazestreetwear' ); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-t border-neutral-300 text-xs font-mono text-neutral-800">
                                <strong><?php esc_html_e( 'GUARANTEE:', 'mazestreetwear' ); ?></strong>
                                <?php esc_html_e( ' We will coordinate directly with the logistics carrier and arrange an expedited replacement consignment without unnecessary delay.', 'mazestreetwear' ); ?>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SECTION 8 -->
                <section id="section-8" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">08</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '8. Shipping Support Desk', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <p class="text-sm text-neutral-800 font-sans leading-relaxed">
                            <?php esc_html_e( 'For any questions regarding order dispatch status, delayed shipments, or address amendments prior to handover, contact our dedicated operations team:', 'mazestreetwear' ); ?>
                        </p>

                        <!-- Support Details Card -->
                        <div class="border border-black p-6 bg-white space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 font-mono text-xs">
                                <div>
                                    <span class="block text-[10px] uppercase tracking-wider text-neutral-400 mb-0.5"><?php esc_html_e( 'Brand Entity', 'mazestreetwear' ); ?></span>
                                    <strong class="text-black text-sm"><?php esc_html_e( 'Maze Streetwear', 'mazestreetwear' ); ?></strong>
                                </div>
                                <div>
                                    <span class="block text-[10px] uppercase tracking-wider text-neutral-400 mb-0.5"><?php esc_html_e( 'Support Email', 'mazestreetwear' ); ?></span>
                                    <a href="mailto:enquiries@mazestw.in" class="text-black font-bold hover:underline text-sm">enquiries@mazestw.in</a>
                                </div>
                                <div>
                                    <span class="block text-[10px] uppercase tracking-wider text-neutral-400 mb-0.5"><?php esc_html_e( 'Operating Hours', 'mazestreetwear' ); ?></span>
                                    <span class="text-neutral-800 font-medium"><?php esc_html_e( 'Monday to Saturday, 10:00 AM – 6:00 PM IST', 'mazestreetwear' ); ?></span>
                                </div>
                                <div>
                                    <span class="block text-[10px] uppercase tracking-wider text-neutral-400 mb-0.5"><?php esc_html_e( 'Official Website', 'mazestreetwear' ); ?></span>
                                    <a href="https://mazestw.in" target="_blank" rel="noopener noreferrer" class="text-black font-bold hover:underline">https://mazestw.in</a>
                                </div>
                            </div>
                        </div>

                        <!-- 1-Click Copyable Shipping Inquiry Email Templates -->
                        <div class="p-6 border border-neutral-300 bg-neutral-50 space-y-6">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-black">
                                        <?php esc_html_e( 'TEMPLATE 01 // DELAYED SHIPMENT INQUIRY', 'mazestreetwear' ); ?>
                                    </span>
                                    <button type="button" id="maze-copy-template-delayed-btn" class="text-[11px] font-mono uppercase font-bold tracking-wider hover:underline text-black">
                                        <span id="maze-copy-template-delayed-text"><?php esc_html_e( 'COPY TEMPLATE', 'mazestreetwear' ); ?></span>
                                    </button>
                                </div>
                                <pre id="maze-template-delayed-content" class="bg-white p-3.5 border border-neutral-300 font-mono text-[11px] leading-relaxed text-neutral-800 whitespace-pre-wrap select-all">To: enquiries@mazestw.in
Subject: Delayed Shipment Inquiry - Order #[Order Number]

Hi Maze Support Team,

My order #[Order Number] was confirmed on [Date of Order].
The AWB Tracking Number provided is: [AWB Number] ([Courier Partner Name]).
According to the tracking portal, the shipment status has not updated since [Date/Time].

Could you please coordinate with the logistics carrier to expedite this consignment?

Customer Name: [Your Full Name]
Phone Number: [Your Active Contact Number]
Delivery Pincode: [6-Digit Pincode]

Thank you!</pre>
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-black">
                                        <?php esc_html_e( 'TEMPLATE 02 // ADDRESS AMENDMENT (PRE-DISPATCH ONLY)', 'mazestreetwear' ); ?>
                                    </span>
                                    <button type="button" id="maze-copy-template-address-btn" class="text-[11px] font-mono uppercase font-bold tracking-wider hover:underline text-black">
                                        <span id="maze-copy-template-address-text"><?php esc_html_e( 'COPY TEMPLATE', 'mazestreetwear' ); ?></span>
                                    </button>
                                </div>
                                <pre id="maze-template-address-content" class="bg-white p-3.5 border border-neutral-300 font-mono text-[11px] leading-relaxed text-neutral-800 whitespace-pre-wrap select-all">To: enquiries@mazestw.in
Subject: URGENT: Address Correction - Order #[Order Number]

Hi Maze Fulfillment Team,

I recently placed order #[Order Number] and need to update the delivery address before it is handed over to the courier:

Updated Delivery Address:
Recipient Name: [Full Name]
Flat/Door/Building: [Flat No, Building Name]
Street Landmark: [Landmark / Area]
City & State: [City, State]
Postal Pincode: [6-Digit Pincode]
Contact Phone: [Active 10-Digit Phone Number]

Please confirm once the shipping label has been updated.

Thank you!</pre>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- Frequently Asked Questions (FAQ) Section -->
                <section class="border-t border-black pt-8 space-y-4 no-print">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( 'Frequently Asked Shipping Questions', 'mazestreetwear' ); ?>
                        </h2>
                        <span class="text-xs font-mono text-neutral-500 uppercase"><?php esc_html_e( 'SHIPPING FAQ', 'mazestreetwear' ); ?></span>
                    </div>

                    <div class="divide-y divide-neutral-200 border border-neutral-300 bg-white">
                        
                        <details class="group p-4 [&_summary::-webkit-details-marker]:hidden">
                            <summary class="flex cursor-pointer items-center justify-between text-xs sm:text-sm font-bold font-sans uppercase text-black">
                                <span><?php esc_html_e( 'Can I change my delivery address after my order is dispatched?', 'mazestreetwear' ); ?></span>
                                <span class="ml-1.5 flex-shrink-0 transition duration-300 group-open:-rotate-180 font-mono text-xs">▼</span>
                            </summary>
                            <p class="mt-3 text-xs sm:text-[13px] text-neutral-600 font-sans leading-relaxed">
                                <?php esc_html_e( 'Once a parcel has been manifested and handed to our national courier partner, in-transit address re-routing is generally not permitted by courier carriers for security reasons. If you notice an error immediately after ordering, email us at enquiries@mazestw.in within 2 hours of payment authorization so our warehouse team can update the label before courier handover.', 'mazestreetwear' ); ?>
                            </p>
                        </details>

                        <details class="group p-4 [&_summary::-webkit-details-marker]:hidden">
                            <summary class="flex cursor-pointer items-center justify-between text-xs sm:text-sm font-bold font-sans uppercase text-black">
                                <span><?php esc_html_e( 'What should I do if tracking says "Delivered" but I haven\'t received it?', 'mazestreetwear' ); ?></span>
                                <span class="ml-1.5 flex-shrink-0 transition duration-300 group-open:-rotate-180 font-mono text-xs">▼</span>
                            </summary>
                            <p class="mt-3 text-xs sm:text-[13px] text-neutral-600 font-sans leading-relaxed">
                                <?php esc_html_e( 'First, check with household members, building security desks, or apartment reception who may have accepted the consignment on your behalf. If the parcel cannot be located, contact us at enquiries@mazestw.in within 24 hours so we can initiate an immediate POD (Proof of Delivery) investigation with the carrier manager.', 'mazestreetwear' ); ?>
                            </p>
                        </details>

                        <details class="group p-4 [&_summary::-webkit-details-marker]:hidden">
                            <summary class="flex cursor-pointer items-center justify-between text-xs sm:text-sm font-bold font-sans uppercase text-black">
                                <span><?php esc_html_e( 'Do you deliver on Sundays and National Holidays?', 'mazestreetwear' ); ?></span>
                                <span class="ml-1.5 flex-shrink-0 transition duration-300 group-open:-rotate-180 font-mono text-xs">▼</span>
                            </summary>
                            <p class="mt-3 text-xs sm:text-[13px] text-neutral-600 font-sans leading-relaxed">
                                <?php esc_html_e( 'While our warehouse fulfillment operations take place Monday through Saturday, national courier networks (Delhivery, Blue Dart) occasionally make deliveries on Sundays in Tier 1 metro regions depending on local hub scheduling. However, Sunday delivery cannot be guaranteed.', 'mazestreetwear' ); ?>
                            </p>
                        </details>

                        <details class="group p-4 [&_summary::-webkit-details-marker]:hidden">
                            <summary class="flex cursor-pointer items-center justify-between text-xs sm:text-sm font-bold font-sans uppercase text-black">
                                <span><?php esc_html_e( 'Are remote pincodes in Northeast and J&K eligible for express shipping?', 'mazestreetwear' ); ?></span>
                                <span class="ml-1.5 flex-shrink-0 transition duration-300 group-open:-rotate-180 font-mono text-xs">▼</span>
                            </summary>
                            <p class="mt-3 text-xs sm:text-[13px] text-neutral-600 font-sans leading-relaxed">
                                <?php esc_html_e( 'Yes. We utilize national air-courier hubs and India Speed Post to service remote northeastern states, Jammu & Kashmir, and island territories. Average delivery windows are 6 to 9 business days.', 'mazestreetwear' ); ?>
                            </p>
                        </details>

                    </div>
                </section>

                <!-- Document Stamp / Footer Note -->
                <div class="pt-8 border-t border-neutral-200 flex flex-col sm:flex-row sm:items-center justify-between text-xs font-mono text-neutral-500 gap-4">
                    <div>
                        <span><?php esc_html_e( 'DOCUMENT REF: MAZE-LOGISTICS-POLICY-2026', 'mazestreetwear' ); ?></span>
                        <span class="block text-[11px] text-neutral-600 mt-1"><?php esc_html_e( 'Legal Entity: ', 'mazestreetwear' ); ?><strong class="text-black uppercase">LALHRUAIZELA SAILO</strong> (Maze Streetwear)</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="text-black font-bold uppercase"><?php esc_html_e( 'ACTIVE & VERIFIED POLICY', 'mazestreetwear' ); ?></span>
                    </div>
                </div>

            </article>

        </div>

    </div>
</main>

<!-- Interactive Scripts for Copying, TOC Highlighting & Live Tracking Jump -->
<script>
(function () {
    // 1. Share Link Copy
    var copyUrlBtn = document.getElementById('maze-copy-shipping-url-btn');
    var copyUrlText = document.getElementById('maze-copy-shipping-url-text');
    if (copyUrlBtn && copyUrlText) {
        copyUrlBtn.addEventListener('click', function () {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(window.location.href).then(function () {
                    copyUrlText.textContent = 'COPIED LINK!';
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

    // 3. Copy Delayed Shipment Template
    var copyDelayedBtn = document.getElementById('maze-copy-template-delayed-btn');
    var copyDelayedText = document.getElementById('maze-copy-template-delayed-text');
    var delayedContent = document.getElementById('maze-template-delayed-content');
    if (copyDelayedBtn && copyDelayedText && delayedContent) {
        copyDelayedBtn.addEventListener('click', function () {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(delayedContent.textContent).then(function () {
                    copyDelayedText.textContent = 'COPIED TEMPLATE!';
                    setTimeout(function () {
                        copyDelayedText.textContent = 'COPY TEMPLATE';
                    }, 2000);
                });
            }
        });
    }

    // 4. Copy Address Amendment Template
    var copyAddressBtn = document.getElementById('maze-copy-template-address-btn');
    var copyAddressText = document.getElementById('maze-copy-template-address-text');
    var addressContent = document.getElementById('maze-template-address-content');
    if (copyAddressBtn && copyAddressText && addressContent) {
        copyAddressBtn.addEventListener('click', function () {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(addressContent.textContent).then(function () {
                    copyAddressText.textContent = 'COPIED TEMPLATE!';
                    setTimeout(function () {
                        copyAddressText.textContent = 'COPY TEMPLATE';
                    }, 2000);
                });
            }
        });
    }

    // 5. Quick AWB Tracking Jump
    var awbInput = document.getElementById('maze-user-awb-input');
    var delhiveryBtn = document.getElementById('maze-track-delhivery-btn');
    var bluedartBtn = document.getElementById('maze-track-bluedart-btn');

    if (delhiveryBtn && awbInput) {
        delhiveryBtn.addEventListener('click', function () {
            var val = (awbInput.value || '').trim();
            if (val) {
                window.open('https://www.delhivery.com/track/package/' + encodeURIComponent(val), '_blank');
            } else {
                window.open('https://www.delhivery.com/tracking', '_blank');
            }
        });
    }

    if (bluedartBtn && awbInput) {
        bluedartBtn.addEventListener('click', function () {
            var val = (awbInput.value || '').trim();
            if (val) {
                window.open('https://www.bluedart.com/tracking?numbers=' + encodeURIComponent(val), '_blank');
            } else {
                window.open('https://www.bluedart.com/tracking', '_blank');
            }
        });
    }

    // 6. Smooth active state for TOC
    var tocLinks = document.querySelectorAll('.maze-shipping-toc-link');
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
