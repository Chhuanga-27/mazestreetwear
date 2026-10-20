<?php
/**
 * Template Name: Privacy Policy
 *
 * Official Privacy Policy page template for Maze Streetwear (mazestw.in).
 * Formatted under Indian Information Technology Act, 2000 and RBI guidelines.
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<!-- Schema.org JSON-LD for Privacy Policy SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Privacy Policy - Maze Streetwear",
  "url": "<?php echo esc_url( function_exists( 'mazestreetwear_get_privacy_policy_url' ) ? mazestreetwear_get_privacy_policy_url() : home_url( '/privacy-policy/' ) ); ?>",
  "description": "Official Privacy Policy of Maze Streetwear detailing data collection, PayU payment security, Indian IT Act 2000 compliance, and Grievance Officer contact details.",
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
      "contactType": "Grievance Officer",
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

                <button type="button" id="maze-copy-url-btn" class="inline-flex items-center space-x-1.5 hover:text-black transition-colors px-3 py-1.5 border border-black hover:bg-neutral-100 bg-white rounded-none text-xs uppercase tracking-wider">
                    <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-3.35l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                    </svg>
                    <span id="maze-copy-url-text"><?php esc_html_e( 'SHARE LINK', 'mazestreetwear' ); ?></span>
                </button>
            </div>
        </div>

        <!-- Editorial Document Header -->
        <header class="mb-12 pb-8 border-b-2 border-black">
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <span class="inline-flex items-center space-x-2 text-xs sm:text-sm font-mono font-bold tracking-widest text-black uppercase border border-black px-3.5 py-1.5 bg-white">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span><?php esc_html_e( 'MAZE COMPLIANCE PROTOCOL // REF: PRIV-2026-V1', 'mazestreetwear' ); ?></span>
                </span>
                <span class="inline-block text-xs sm:text-sm font-mono font-bold tracking-widest text-black uppercase border border-black px-3.5 py-1.5 bg-neutral-100">
                    <?php esc_html_e( 'STATUTORY IT ACT 2000 COMPLIANT', 'mazestreetwear' ); ?>
                </span>
            </div>

            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black font-sans uppercase tracking-tight text-black mb-6">
                <?php esc_html_e( 'Privacy Policy', 'mazestreetwear' ); ?>
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
                    <span class="block text-xs uppercase tracking-wider text-neutral-700 font-bold mb-1"><?php esc_html_e( 'Legal Entity Name', 'mazestreetwear' ); ?></span>
                    <strong class="font-black text-black text-sm sm:text-base">LALHRUAIZELA SAILO</strong>
                    <span class="block text-[11px] font-mono text-neutral-600 font-bold">Trade Name: Maze Streetwear</span>
                </div>
                <div>
                    <span class="block text-xs uppercase tracking-wider text-neutral-700 font-bold mb-1"><?php esc_html_e( 'Grievance Jurisdiction', 'mazestreetwear' ); ?></span>
                    <strong class="font-black text-black text-sm sm:text-base"><?php esc_html_e( 'Aizawl, Mizoram, India', 'mazestreetwear' ); ?></strong>
                </div>
            </div>
        </header>

        <!-- Trust Highlights Banner (4-column hairline grid) -->
        <section class="mb-14 border border-black bg-neutral-50 no-print" aria-label="<?php esc_attr_e( 'Privacy Highlights', 'mazestreetwear' ); ?>">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-black">
                
                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">01 // PAYMENT SECURITY</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( 'Zero Card Storage', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( 'We never collect or store card numbers, CVVs, or UPI PINs. All payments are securely tokenized via RBI-compliant PayU India.', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">02 // DATA ENCRYPTION</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( '256-Bit SSL / TLS', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( 'Industry-standard cryptographic encryption protects all browsing sessions, personal accounts, and checkout data entry points.', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">03 // DATA MONETIZATION</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( 'Strictly No Selling', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( 'We never sell, rent, or trade your personal details with third-party advertisers. Disclosures are strictly operational for fulfillment.', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">04 // STATUTORY DESK</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( 'Grievance Officer', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( 'Direct access to our designated Grievance Officer in Aizawl, Mizoram with official email and WhatsApp support.', 'mazestreetwear' ); ?>
                    </p>
                </div>

            </div>
        </section>

        <!-- Two-Column Editorial Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

            <!-- Left Sticky Sidebar: Navigation & Contact Card -->
            <aside class="lg:col-span-4 lg:sticky lg:top-28 space-y-6 no-print order-2 lg:order-1">
                
                <!-- Table of Contents -->
                <div class="border border-black p-5 sm:p-6 bg-white">
                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-black">
                        <span class="text-sm font-mono font-bold uppercase tracking-wider text-black">
                            <?php esc_html_e( 'DOCUMENT INDEX', 'mazestreetwear' ); ?>
                        </span>
                        <span class="text-xs font-mono font-bold text-neutral-700">6 SECTIONS</span>
                    </div>

                    <nav class="space-y-1 font-mono text-xs sm:text-sm">
                        <a href="#section-1" class="maze-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>01. Information We Collect</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-2" class="maze-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>02. How We Use Information</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-3" class="maze-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>03. Sharing & Disclosure</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-4" class="maze-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>04. Data Security & Retention</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-5" class="maze-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>05. Your Rights</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-6" class="maze-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>06. Grievance Officer & Contact</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                    </nav>
                </div>

                <!-- Quick Help / Support Capsule -->
                <div class="border border-black p-5 sm:p-6 bg-neutral-50 text-black">
                    <span class="text-xs font-mono font-bold uppercase tracking-widest text-neutral-700 block mb-1">
                        <?php esc_html_e( 'PRIVACY CONCERNS?', 'mazestreetwear' ); ?>
                    </span>
                    <h3 class="text-base font-bold font-sans uppercase tracking-tight mb-2">
                        <?php esc_html_e( 'Official Grievance Desk', 'mazestreetwear' ); ?>
                    </h3>
                    <p class="text-sm text-neutral-800 font-sans leading-relaxed mb-4 font-normal">
                        <?php esc_html_e( 'Reach our data protection compliance team directly for data access requests, corrections, or inquiries.', 'mazestreetwear' ); ?>
                    </p>

                    <div class="space-y-2 font-mono text-xs sm:text-sm">
                        <a href="mailto:enquiries@mazestw.in" class="flex items-center justify-between p-3 bg-white border border-black hover:bg-black hover:text-white transition-colors group">
                            <span class="font-bold">enquiries@mazestw.in</span>
                            <span class="text-xs uppercase tracking-wider group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                        </a>
                        <a href="https://wa.me/918787324795" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-3 bg-white border border-black hover:bg-black hover:text-white transition-colors group">
                            <span class="font-bold">+91 8787324795</span>
                            <span class="text-xs uppercase tracking-wider group-hover:translate-x-0.5 transition-transform">WhatsApp &rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Related Legal Policies -->
                <div class="p-5 border border-black bg-white">
                    <span class="text-xs font-mono font-bold uppercase tracking-widest text-neutral-700 block mb-3">
                        <?php esc_html_e( 'RELATED PROTOCOLS', 'mazestreetwear' ); ?>
                    </span>
                    <ul class="space-y-2.5 text-xs sm:text-sm font-sans">
                        <li>
                            <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_terms_url' ) ? mazestreetwear_get_terms_url() : home_url( '/terms-and-conditions/' ) ); ?>" class="text-neutral-900 font-bold hover:text-black underline-offset-4 hover:underline flex items-center justify-between">
                                <span><?php esc_html_e( 'Terms & Conditions', 'mazestreetwear' ); ?></span>
                                <span class="text-neutral-500 font-mono text-xs font-bold">&rarr;</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_shipping_policy_url' ) ? mazestreetwear_get_shipping_policy_url() : home_url( '/shipping-policy/' ) ); ?>" class="text-neutral-700 hover:text-black underline-offset-4 hover:underline flex items-center justify-between">
                                <span><?php esc_html_e( 'Shipping & Dispatch Policy', 'mazestreetwear' ); ?></span>
                                <span class="text-neutral-400 font-mono text-[11px]">&rarr;</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_refund_policy_url' ) ? mazestreetwear_get_refund_policy_url() : home_url( '/refund-policy/' ) ); ?>" class="text-neutral-700 hover:text-black underline-offset-4 hover:underline flex items-center justify-between">
                                <span><?php esc_html_e( 'Refund & Exchange Policy', 'mazestreetwear' ); ?></span>
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
                        This Privacy Policy applies to the website <a href="https://mazestw.in" class="underline hover:text-neutral-600 transition-colors font-medium">https://mazestw.in</a> (&ldquo;Website&rdquo;), owned and operated by <strong>LALHRUAIZELA SAILO</strong> (trading and operating as <strong>Maze Streetwear</strong>, &ldquo;we,&rdquo; &ldquo;our,&rdquo; or &ldquo;us&rdquo;). We are committed to protecting the privacy and personal information of our visitors and customers. This Privacy Policy details how we collect, use, store, disclose, and safeguard your information when you browse our Website or make a purchase from our store.
                    </p>
                </section>

                <!-- SECTION 1 -->
                <section id="section-1" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">01</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '1. Information We Collect', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <p class="text-sm sm:text-base text-neutral-700 font-sans leading-relaxed mb-6">
                        <?php esc_html_e( 'We collect information directly from you when you interact with our Website, create an account, make a purchase, or communicate with our support desk:', 'mazestreetwear' ); ?>
                    </p>

                    <div class="grid grid-cols-1 gap-4">
                        
                        <!-- 1.1 Personal Identifiable Information -->
                        <div class="p-5 border border-neutral-300 hover:border-black transition-colors bg-white">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-2">
                                <span class="w-1.5 h-1.5 bg-black"></span>
                                <h3><?php esc_html_e( 'Personal Identifiable Information', 'mazestreetwear' ); ?></h3>
                            </div>
                            <p class="text-sm text-neutral-700 font-sans leading-relaxed">
                                <?php esc_html_e( 'Full name, billing address, shipping/delivery address, contact phone number, and official email address.', 'mazestreetwear' ); ?>
                            </p>
                        </div>

                        <!-- 1.2 Order & Transaction Data -->
                        <div class="p-5 border border-neutral-300 hover:border-black transition-colors bg-white">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-2">
                                <span class="w-1.5 h-1.5 bg-black"></span>
                                <h3><?php esc_html_e( 'Order & Transaction Data', 'mazestreetwear' ); ?></h3>
                            </div>
                            <p class="text-sm text-neutral-700 font-sans leading-relaxed">
                                <?php esc_html_e( 'Details about the garments purchased, sizing selections, order timestamps, and transaction identification numbers generated by our payment partners.', 'mazestreetwear' ); ?>
                            </p>
                        </div>

                        <!-- 1.3 Payment Information -->
                        <div class="p-5 border border-black bg-neutral-50 relative overflow-hidden">
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black">
                                    <span class="w-1.5 h-1.5 bg-black"></span>
                                    <h3><?php esc_html_e( 'Payment Information', 'mazestreetwear' ); ?></h3>
                                </div>
                                <span class="text-[10px] font-mono font-bold bg-black text-white px-2 py-0.5 uppercase tracking-wider">
                                    <?php esc_html_e( 'NO CARD DATA STORED', 'mazestreetwear' ); ?>
                                </span>
                            </div>
                            <p class="text-sm text-neutral-800 font-sans leading-relaxed">
                                <?php esc_html_e( 'We do not collect, process, or store your debit/credit card numbers, CVVs, UPI PINs, or net-banking credentials on our servers. All transactional payments are redirected to and processed securely by authorized, RBI-compliant payment aggregators (including PayU Payments Private Limited).', 'mazestreetwear' ); ?>
                            </p>
                        </div>

                        <!-- 1.4 Technical & Usage Data -->
                        <div class="p-5 border border-neutral-300 hover:border-black transition-colors bg-white">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-2">
                                <span class="w-1.5 h-1.5 bg-black"></span>
                                <h3><?php esc_html_e( 'Technical & Usage Data', 'mazestreetwear' ); ?></h3>
                            </div>
                            <p class="text-sm text-neutral-700 font-sans leading-relaxed">
                                <?php esc_html_e( 'IP address, browser type, operating system, device specifications, access times, pages viewed, and navigation journeys recorded via standard cookies and server log files.', 'mazestreetwear' ); ?>
                            </p>
                        </div>

                    </div>
                </section>

                <!-- SECTION 2 -->
                <section id="section-2" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">02</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '2. How We Use Your Information', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <p class="text-sm sm:text-base text-neutral-700 font-sans leading-relaxed mb-6">
                        <?php esc_html_e( 'We use the collected information for specific, legitimate operational purposes:', 'mazestreetwear' ); ?>
                    </p>

                    <div class="border border-black divide-y divide-neutral-200 bg-white">
                        
                        <div class="p-4 sm:p-5 flex items-start space-x-4">
                            <span class="font-mono text-xs font-bold text-black mt-0.5 flex-shrink-0">[01]</span>
                            <div class="text-sm text-neutral-800 font-sans leading-relaxed">
                                <?php esc_html_e( 'Processing, validating, packaging, and dispatching your garment orders.', 'mazestreetwear' ); ?>
                            </div>
                        </div>

                        <div class="p-4 sm:p-5 flex items-start space-x-4">
                            <span class="font-mono text-xs font-bold text-black mt-0.5 flex-shrink-0">[02]</span>
                            <div class="text-sm text-neutral-800 font-sans leading-relaxed">
                                <?php esc_html_e( 'Generating invoices, delivery manifests, and automated courier tracking updates.', 'mazestreetwear' ); ?>
                            </div>
                        </div>

                        <div class="p-4 sm:p-5 flex items-start space-x-4">
                            <span class="font-mono text-xs font-bold text-black mt-0.5 flex-shrink-0">[03]</span>
                            <div class="text-sm text-neutral-800 font-sans leading-relaxed">
                                <?php esc_html_e( 'Transmitting transactional notices, order confirmations, and customer support responses to your email or phone.', 'mazestreetwear' ); ?>
                            </div>
                        </div>

                        <div class="p-4 sm:p-5 flex items-start space-x-4">
                            <span class="font-mono text-xs font-bold text-black mt-0.5 flex-shrink-0">[04]</span>
                            <div class="text-sm text-neutral-800 font-sans leading-relaxed">
                                <?php esc_html_e( 'Detecting, investigating, and preventing fraudulent transactions or unauthorized access.', 'mazestreetwear' ); ?>
                            </div>
                        </div>

                        <div class="p-4 sm:p-5 flex items-start space-x-4">
                            <span class="font-mono text-xs font-bold text-black mt-0.5 flex-shrink-0">[05]</span>
                            <div class="text-sm text-neutral-800 font-sans leading-relaxed">
                                <?php esc_html_e( 'Complying with applicable statutory tax, accounting, and legal reporting obligations under Indian law.', 'mazestreetwear' ); ?>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- SECTION 3 -->
                <section id="section-3" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">03</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '3. Information Sharing and Disclosure', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="p-4 bg-neutral-100 border-l-2 border-black mb-6">
                        <p class="text-sm sm:text-base font-bold font-sans text-black">
                            <?php esc_html_e( 'We do not sell, rent, or trade your personal information. We disclose data solely to verified service providers under strict data-protection agreements:', 'mazestreetwear' ); ?>
                        </p>
                    </div>

                    <div class="space-y-4">
                        
                        <!-- 3.1 Payment Processors -->
                        <div class="p-5 border border-neutral-300 hover:border-black transition-colors bg-white">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-2">
                                <span class="w-1.5 h-1.5 bg-black"></span>
                                <h3><?php esc_html_e( 'Payment Processors', 'mazestreetwear' ); ?></h3>
                            </div>
                            <p class="text-sm text-neutral-700 font-sans leading-relaxed">
                                <strong>PayU India</strong> <?php esc_html_e( 'for authenticating, processing, and settling financial transactions.', 'mazestreetwear' ); ?>
                            </p>
                        </div>

                        <!-- 3.2 Logistics & Courier Partners -->
                        <div class="p-5 border border-neutral-300 hover:border-black transition-colors bg-white">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-2">
                                <span class="w-1.5 h-1.5 bg-black"></span>
                                <h3><?php esc_html_e( 'Logistics & Courier Partners', 'mazestreetwear' ); ?></h3>
                            </div>
                            <p class="text-sm text-neutral-700 font-sans leading-relaxed">
                                <?php esc_html_e( 'Integrated courier aggregators, warehouse partners, and national delivery couriers (such as ShipTurtle, Delhivery, Blue Dart, or India Post) strictly to deliver physical parcels to your address.', 'mazestreetwear' ); ?>
                            </p>
                        </div>

                        <!-- 3.3 Statutory Authorities -->
                        <div class="p-5 border border-neutral-300 hover:border-black transition-colors bg-white">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-2">
                                <span class="w-1.5 h-1.5 bg-black"></span>
                                <h3><?php esc_html_e( 'Statutory Authorities', 'mazestreetwear' ); ?></h3>
                            </div>
                            <p class="text-sm text-neutral-700 font-sans leading-relaxed">
                                <?php esc_html_e( 'Law enforcement agencies, regulators, or government bodies when legally mandated under the Information Technology Act, 2000, or judicial orders.', 'mazestreetwear' ); ?>
                            </p>
                        </div>

                    </div>
                </section>

                <!-- SECTION 4 -->
                <section id="section-4" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">04</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '4. Data Security and Retention', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="p-6 border border-black bg-white space-y-4">
                        <p class="text-sm sm:text-base text-neutral-800 font-sans leading-relaxed">
                            <?php esc_html_e( 'We implement industry-standard administrative, physical, and technical safeguards—including SSL/TLS (HTTPS) 256-bit encryption across all data-entry points—to protect your personal information against unauthorized disclosure, loss, alteration, or misuse. We retain your transaction and order history only for as long as necessary to fulfill orders, settle chargebacks, and satisfy statutory tax and commercial record-keeping laws in India.', 'mazestreetwear' ); ?>
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-4 border-t border-neutral-200 font-mono text-xs">
                            <div class="flex items-center space-x-2 text-neutral-700">
                                <svg class="w-4 h-4 text-black flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <span>256-Bit SSL/TLS Encryption</span>
                            </div>
                            <div class="flex items-center space-x-2 text-neutral-700">
                                <svg class="w-4 h-4 text-black flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <span>RBI Tokenized Gateway</span>
                            </div>
                            <div class="flex items-center space-x-2 text-neutral-700">
                                <svg class="w-4 h-4 text-black flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <span>Statutory Audit Logging</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SECTION 5 -->
                <section id="section-5" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">05</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '5. Your Rights', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="p-6 border border-black bg-neutral-50 space-y-4">
                        <p class="text-sm sm:text-base text-neutral-800 font-sans leading-relaxed">
                            <?php esc_html_e( 'Under applicable Indian data protection standards, you have the right to request access to the personal data we hold about you, request corrections to erroneous address or profile records, or request deletion of non-statutory personal data. To exercise these rights, email our Grievance Desk at', 'mazestreetwear' ); ?>
                            <a href="mailto:enquiries@mazestw.in" class="font-bold underline hover:text-neutral-600 transition-colors">enquiries@mazestw.in</a>.
                        </p>

                        <div class="pt-2">
                            <a href="mailto:enquiries@mazestw.in?subject=<?php echo rawurlencode( 'Data Subject Rights Request - Maze Streetwear' ); ?>&body=<?php echo rawurlencode( 'Dear Grievance Officer,%0D%0A%0D%0AI would like to submit a request regarding my personal data under applicable Indian data protection standards:%0D%0A%0D%0A[ ] Request Access to Stored Data%0D%0A[ ] Correction of Personal / Address Records%0D%0A[ ] Deletion of Non-Statutory Records%0D%0A%0D%0AMy Registered Email / Phone:%0D%0AOrder Number (if applicable):%0D%0A%0D%0AThank you.' ); ?>" class="inline-flex items-center space-x-2 border border-black bg-black text-white hover:bg-neutral-800 transition-colors px-5 py-2.5 text-xs font-mono uppercase tracking-widest font-bold">
                                <span><?php esc_html_e( 'SUBMIT RIGHTS REQUEST VIA EMAIL', 'mazestreetwear' ); ?></span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </div>
                </section>

                <!-- SECTION 6 -->
                <section id="section-6" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">06</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '6. Grievance Officer & Contact Details', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <p class="text-sm sm:text-base text-neutral-700 font-sans leading-relaxed mb-6">
                        <?php esc_html_e( 'In accordance with the Information Technology Act, 2000, and rules made thereunder, the contact details of the Grievance Officer are:', 'mazestreetwear' ); ?>
                    </p>

                    <!-- Official Grievance Officer Card -->
                    <div class="border-2 border-black bg-white shadow-brutal p-6 sm:p-8">
                        <div class="flex flex-wrap items-center justify-between gap-3 pb-6 mb-6 border-b border-neutral-200">
                            <div>
                                <span class="text-[10px] font-mono font-bold tracking-widest text-neutral-400 uppercase block mb-1">
                                    <?php esc_html_e( 'STATUTORY APPOINTMENT // IT ACT 2000', 'mazestreetwear' ); ?>
                                </span>
                                <h3 class="text-2xl font-black font-sans uppercase tracking-tight text-black">
                                    LALHRUAIZELA SAILO
                                </h3>
                                <p class="text-xs font-mono text-neutral-600 mt-0.5">
                                    <?php esc_html_e( 'Legal Entity / Brand: Maze Streetwear (mazestw.in)', 'mazestreetwear' ); ?>
                                </p>
                            </div>
                            <span class="inline-flex items-center space-x-1.5 text-xs font-mono bg-neutral-100 border border-neutral-300 px-3 py-1 font-bold text-neutral-800">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span><?php esc_html_e( 'OFFICIALLY REGISTERED', 'mazestreetwear' ); ?></span>
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm font-sans mb-8">
                            
                            <!-- Address -->
                            <div>
                                <span class="block text-xs font-mono font-bold uppercase tracking-wider text-neutral-400 mb-1">
                                    <?php esc_html_e( 'Physical Address', 'mazestreetwear' ); ?>
                                </span>
                                <address class="not-italic text-neutral-900 leading-relaxed font-medium">
                                    Maze Streetwear<br>
                                    Attn: Grievance Officer<br>
                                    Bungkawn Vengthar, A-25<br>
                                    Aizawl, Mizoram, 796005<br>
                                    India
                                </address>
                            </div>

                            <!-- Communication Details -->
                            <div class="space-y-4">
                                <div>
                                    <span class="block text-xs font-mono font-bold uppercase tracking-wider text-neutral-400 mb-1">
                                        <?php esc_html_e( 'Official Email Desk', 'mazestreetwear' ); ?>
                                    </span>
                                    <div class="flex items-center space-x-2">
                                        <a href="mailto:enquiries@mazestw.in" class="text-black font-bold hover:underline font-mono text-sm">
                                            enquiries@mazestw.in
                                        </a>
                                        <button type="button" id="maze-copy-email-btn" title="<?php esc_attr_e( 'Copy Email', 'mazestreetwear' ); ?>" class="px-2 py-0.5 border border-neutral-300 hover:border-black text-[10px] font-mono uppercase bg-neutral-50 hover:bg-black hover:text-white transition-colors">
                                            <span id="maze-copy-email-text"><?php esc_html_e( 'COPY', 'mazestreetwear' ); ?></span>
                                        </button>
                                    </div>
                                </div>

                                <div>
                                    <span class="block text-xs font-mono font-bold uppercase tracking-wider text-neutral-400 mb-1">
                                        <?php esc_html_e( 'Phone / WhatsApp Support', 'mazestreetwear' ); ?>
                                    </span>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <a href="tel:+918787324795" class="text-black font-bold font-mono text-sm hover:underline">
                                            +91 8787324795
                                        </a>
                                        <span class="text-neutral-300">&middot;</span>
                                        <a href="https://wa.me/918787324795" target="_blank" rel="noopener noreferrer" class="text-emerald-700 hover:text-emerald-800 text-xs font-mono font-bold hover:underline inline-flex items-center space-x-1">
                                            <span>WhatsApp Direct</span>
                                            <span>&nearr;</span>
                                        </a>
                                    </div>
                                </div>

                                <div>
                                    <span class="block text-xs font-mono font-bold uppercase tracking-wider text-neutral-400 mb-1">
                                        <?php esc_html_e( 'Operating Hours', 'mazestreetwear' ); ?>
                                    </span>
                                    <span class="text-neutral-900 font-mono text-xs">
                                        Monday to Saturday, 10:00 AM &ndash; 6:00 PM IST
                                    </span>
                                </div>
                            </div>

                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-6 border-t border-neutral-200 flex flex-wrap gap-3">
                            <a href="mailto:enquiries@mazestw.in" class="flex-1 sm:flex-none text-center px-6 py-3 bg-black text-white hover:bg-neutral-800 transition-colors font-mono text-xs font-bold uppercase tracking-widest border border-black">
                                <?php esc_html_e( 'SEND OFFICIAL EMAIL', 'mazestreetwear' ); ?>
                            </a>
                            <a href="https://wa.me/918787324795" target="_blank" rel="noopener noreferrer" class="flex-1 sm:flex-none text-center px-6 py-3 bg-white text-black hover:bg-neutral-100 transition-colors font-mono text-xs font-bold uppercase tracking-widest border border-black">
                                <?php esc_html_e( 'OPEN WHATSAPP CHAT', 'mazestreetwear' ); ?>
                            </a>
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
// Lightweight interactions for Privacy Policy template
(function () {
    // 1. Copy URL
    var copyUrlBtn = document.getElementById('maze-copy-url-btn');
    var copyUrlText = document.getElementById('maze-copy-url-text');
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

    // 2. Copy Email
    var copyEmailBtn = document.getElementById('maze-copy-email-btn');
    var copyEmailText = document.getElementById('maze-copy-email-text');
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

    // 3. Smooth active state for TOC
    var tocLinks = document.querySelectorAll('.maze-toc-link');
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
