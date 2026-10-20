<?php
/**
 * Template Name: Terms & Conditions
 *
 * Official Terms & Conditions page template for Maze Streetwear (mazestw.in).
 * Formatted under Indian Commercial Law, IT Act 2000, and Consumer Protection regulations.
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$terms_url = function_exists( 'mazestreetwear_get_terms_url' ) ? mazestreetwear_get_terms_url() : home_url( '/terms-and-conditions/' );
?>

<!-- Schema.org JSON-LD for Terms & Conditions SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Terms & Conditions - Maze Streetwear",
  "url": "<?php echo esc_url( $terms_url ); ?>",
  "description": "Official Terms and Conditions of Maze Streetwear (mazestw.in) detailing store terms, product representation, PayU payment settlement, intellectual property, and governing law.",
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
      "contactType": "Customer Support",
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

                <button type="button" id="maze-copy-terms-url-btn" class="inline-flex items-center space-x-1.5 hover:text-black transition-colors px-3 py-1.5 border border-black hover:bg-neutral-100 bg-white rounded-none text-xs uppercase tracking-wider">
                    <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-3.35l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                    </svg>
                    <span id="maze-copy-terms-url-text"><?php esc_html_e( 'SHARE LINK', 'mazestreetwear' ); ?></span>
                </button>
            </div>
        </div>

        <!-- Editorial Document Header -->
        <header class="mb-12 pb-8 border-b-2 border-black">
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <span class="inline-flex items-center space-x-2 text-xs sm:text-sm font-mono font-bold tracking-widest text-black uppercase border border-black px-3.5 py-1.5 bg-white">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span><?php esc_html_e( 'MAZE PROTOCOL // COMMERCIAL TERMS REF: TC-2026-V1', 'mazestreetwear' ); ?></span>
                </span>
                <span class="inline-block text-xs sm:text-sm font-mono font-bold tracking-widest text-black uppercase border border-black px-3.5 py-1.5 bg-neutral-100">
                    <?php esc_html_e( 'GOVERNING LAW: REPUBLIC OF INDIA', 'mazestreetwear' ); ?>
                </span>
            </div>

            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black font-sans uppercase tracking-tight text-black mb-6">
                <?php esc_html_e( 'Terms & Conditions', 'mazestreetwear' ); ?>
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
                    <span class="block text-xs uppercase tracking-wider text-neutral-700 font-bold mb-1"><?php esc_html_e( 'Legal Business Name', 'mazestreetwear' ); ?></span>
                    <strong class="font-black text-black text-sm sm:text-base">
                        LALHRUAIZELA SAILO
                    </strong>
                    <span class="block text-[11px] font-mono text-neutral-600 font-bold">Trade Name: Maze Streetwear</span>
                </div>
                <div>
                    <span class="block text-xs uppercase tracking-wider text-neutral-700 font-bold mb-1"><?php esc_html_e( 'Exclusive Jurisdiction', 'mazestreetwear' ); ?></span>
                    <strong class="font-black text-black text-sm sm:text-base"><?php esc_html_e( 'Aizawl, Mizoram, India', 'mazestreetwear' ); ?></strong>
                </div>
            </div>
        </header>

        <!-- Commercial Highlights Banner (4-column hairline grid) -->
        <section class="mb-14 border border-black bg-neutral-50 no-print" aria-label="<?php esc_attr_e( 'Commercial Highlights', 'mazestreetwear' ); ?>">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-black">
                
                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">01 // STORE ELIGIBILITY</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( '18+ Legal Majority', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( 'You represent that you are at least 18 years old or legal majority to execute binding purchase agreements on mazestw.in.', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">02 // TRANSPARENT PRICING</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( 'GST Included (₹ INR)', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( 'All garment prices are listed in Indian Rupees (₹) and include applicable statutory Goods & Services Tax (GST).', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">03 // SECURE CHECKOUT</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( 'PayU India Gateway', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( 'Authorized settlements via UPI (GPay, PhonePe, Paytm), Visa, MasterCard, RuPay, and Net Banking.', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <div class="p-5 bg-white">
                    <span class="text-xs font-mono font-bold tracking-widest text-neutral-700 block mb-1">04 // LEGAL VENUE</span>
                    <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-2"><?php esc_html_e( 'Aizawl Jurisdiction', 'mazestreetwear' ); ?></h2>
                    <p class="text-sm text-neutral-800 leading-relaxed font-sans font-normal">
                        <?php esc_html_e( 'All agreements governed by laws of Republic of India under exclusive jurisdiction of competent courts in Aizawl, Mizoram.', 'mazestreetwear' ); ?>
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
                        <span class="text-xs font-mono font-bold text-neutral-700">7 SECTIONS</span>
                    </div>

                    <nav class="space-y-1 font-mono text-xs sm:text-sm">
                        <a href="#section-1" class="maze-terms-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>01. General Store Terms</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-2" class="maze-terms-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>02. Products & Sizing</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-3" class="maze-terms-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>03. Orders & Billing</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-4" class="maze-terms-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>04. Intellectual Property</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-5" class="maze-terms-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>05. Limitation of Liability</span>
                            <span class="text-neutral-500 font-bold">&rarr;</span>
                        </a>
                        <a href="#section-6" class="maze-terms-toc-link flex items-center justify-between py-2.5 px-3 hover:bg-neutral-100 transition-colors text-black font-bold border-l-2 border-transparent hover:border-black">
                            <span>06. Governing Law & Dispute</span>
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
                        <?php esc_html_e( 'Legal & Support Inquiries', 'mazestreetwear' ); ?>
                    </h3>
                    <p class="text-sm text-neutral-800 font-sans leading-relaxed mb-4 font-normal">
                        <?php esc_html_e( 'For clarifications on our terms, transactions, or garment warranties, get in touch with our team.', 'mazestreetwear' ); ?>
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
                            <a href="<?php echo esc_url( function_exists( 'mazestreetwear_get_privacy_policy_url' ) ? mazestreetwear_get_privacy_policy_url() : home_url( '/privacy-policy/' ) ); ?>" class="text-neutral-900 font-bold hover:text-black underline-offset-4 hover:underline flex items-center justify-between">
                                <span><?php esc_html_e( 'Privacy Policy', 'mazestreetwear' ); ?></span>
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
                        Welcome to <a href="https://mazestw.in" class="underline hover:text-neutral-600 transition-colors font-medium">mazestw.in</a>. This Website is owned and operated by <strong>LALHRUAIZELA SAILO</strong> (trading as <strong>Maze Streetwear</strong>). By browsing our catalog, creating an account, or completing a transaction on this Website, you agree to be bound by the following Terms and Conditions (&ldquo;Terms of Service&rdquo;). If you do not agree with any part of these terms, please discontinue using this Website immediately.
                    </p>
                </section>

                <!-- SECTION 1 -->
                <section id="section-1" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">01</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '1. General Store Terms', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        
                        <div class="p-5 border-2 border-black bg-neutral-50">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-3">
                                <span class="w-2 h-2 bg-black"></span>
                                <h3><?php esc_html_e( 'Merchant Identification & Operating Details', 'mazestreetwear' ); ?></h3>
                            </div>
                            <div class="text-sm text-neutral-800 font-sans leading-relaxed space-y-1.5">
                                <p><strong><?php esc_html_e( 'Brand / Trade Name:', 'mazestreetwear' ); ?></strong> Maze Streetwear</p>
                                <p><strong><?php esc_html_e( 'Platform / Domain:', 'mazestreetwear' ); ?></strong> <a href="https://mazestw.in" class="underline hover:text-black font-medium">https://mazestw.in</a></p>
                                <p><strong><?php esc_html_e( 'Registered Office & Operating Address:', 'mazestreetwear' ); ?></strong> Bungkawn Vengthar, A-25, Aizawl, Mizoram - 796005, India</p>
                                <p><strong><?php esc_html_e( 'Official Email:', 'mazestreetwear' ); ?></strong> <a href="mailto:enquiries@mazestw.in" class="underline hover:text-black font-medium">enquiries@mazestw.in</a></p>
                                <p><strong><?php esc_html_e( 'Phone / WhatsApp Helpline:', 'mazestreetwear' ); ?></strong> +91 8787324795</p>
                            </div>
                        </div>

                        <div class="p-5 border border-neutral-300 hover:border-black transition-colors bg-white">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-2">
                                <span class="w-1.5 h-1.5 bg-black"></span>
                                <h3><?php esc_html_e( 'Age of Majority & Eligibility', 'mazestreetwear' ); ?></h3>
                            </div>
                            <p class="text-sm text-neutral-700 font-sans leading-relaxed">
                                <?php esc_html_e( 'By agreeing to these Terms, you represent that you are at least 18 years of age or the age of legal majority in your state/jurisdiction of residence.', 'mazestreetwear' ); ?>
                            </p>
                        </div>

                        <div class="p-5 border border-neutral-300 hover:border-black transition-colors bg-white">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-2">
                                <span class="w-1.5 h-1.5 bg-black"></span>
                                <h3><?php esc_html_e( 'Authorized Platform Use', 'mazestreetwear' ); ?></h3>
                            </div>
                            <p class="text-sm text-neutral-700 font-sans leading-relaxed">
                                <?php esc_html_e( 'You agree not to use our garments, media assets, or platform for any unlawful, fraudulent, or unauthorized purpose.', 'mazestreetwear' ); ?>
                            </p>
                        </div>

                        <div class="p-5 border border-black bg-neutral-50">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-2">
                                <span class="w-1.5 h-1.5 bg-black"></span>
                                <h3><?php esc_html_e( 'Strict Breach & Enforcement Protocol', 'mazestreetwear' ); ?></h3>
                            </div>
                            <p class="text-sm text-neutral-800 font-sans leading-relaxed">
                                <?php esc_html_e( 'A breach or violation of any of these Terms will result in an immediate cessation of services, order cancellation, and account termination.', 'mazestreetwear' ); ?>
                            </p>
                        </div>

                    </div>
                </section>

                <!-- SECTION 2 -->
                <section id="section-2" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">02</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '2. Products, Sizing, and Apparel Representation', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="space-y-4">
                        
                        <div class="p-5 border border-neutral-300 hover:border-black transition-colors bg-white">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-2">
                                <span class="w-1.5 h-1.5 bg-black"></span>
                                <h3><?php esc_html_e( 'Garment Representation & Sizing', 'mazestreetwear' ); ?></h3>
                            </div>
                            <p class="text-sm text-neutral-700 font-sans leading-relaxed">
                                <strong>Garment Representation:</strong> <?php esc_html_e( 'We make every effort to display garment colors, washes, textures, and oversized silhouettes accurately. However, actual colors may vary slightly depending on monitor calibrations, device display profiles, and textile wash lots.', 'mazestreetwear' ); ?>
                            </p>
                        </div>

                        <div class="p-5 border border-neutral-300 hover:border-black transition-colors bg-white">
                            <div class="flex items-center space-x-2 text-xs font-mono font-bold uppercase tracking-wider text-black mb-2">
                                <span class="w-1.5 h-1.5 bg-black"></span>
                                <h3><?php esc_html_e( 'Pricing & Availability', 'mazestreetwear' ); ?></h3>
                            </div>
                            <p class="text-sm text-neutral-700 font-sans leading-relaxed">
                                <strong>Pricing &amp; Availability:</strong> <?php esc_html_e( 'All product prices are listed in Indian Rupees (₹ / INR) and include applicable Goods and Services Tax (GST) unless indicated otherwise. We reserve the right to limit sales quantities per customer or order, modify product pricing, or discontinue items without prior notice.', 'mazestreetwear' ); ?>
                            </p>
                        </div>

                    </div>
                </section>

                <!-- SECTION 3 -->
                <section id="section-3" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">03</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '3. Orders, Billing, and Payment Authorization', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="border border-black divide-y divide-neutral-200 bg-white">
                        
                        <div class="p-5 flex items-start space-x-4">
                            <span class="font-mono text-xs font-bold text-black mt-0.5 flex-shrink-0">[01]</span>
                            <div class="text-sm text-neutral-800 font-sans leading-relaxed">
                                <strong>Accuracy of Information:</strong> <?php esc_html_e( 'When you place an order, you agree to provide complete, current, and accurate billing and delivery information.', 'mazestreetwear' ); ?>
                            </div>
                        </div>

                        <div class="p-5 flex items-start space-x-4 bg-neutral-50">
                            <span class="font-mono text-xs font-bold text-black mt-0.5 flex-shrink-0">[02]</span>
                            <div class="text-sm text-neutral-800 font-sans leading-relaxed space-y-2">
                                <div>
                                    <strong>Payment Settlement:</strong> <?php esc_html_e( 'We accept payments via authorized digital payment gateways through PayU India, including Unified Payments Interface (UPI - GPay, PhonePe, Paytm, BHIM), major Credit and Debit Cards (Visa, MasterCard, RuPay), and Net Banking. All online payment settlements are processed securely for Maze Streetwear.', 'mazestreetwear' ); ?>
                                </div>
                                <div class="flex flex-wrap gap-2 pt-1 font-mono text-[10px] uppercase text-neutral-600">
                                    <span class="px-2 py-0.5 bg-white border border-neutral-300">UPI / QR</span>
                                    <span class="px-2 py-0.5 bg-white border border-neutral-300">VISA / MASTERCARD / RUPAY</span>
                                    <span class="px-2 py-0.5 bg-white border border-neutral-300">NET BANKING</span>
                                    <span class="px-2 py-0.5 bg-black text-white">PAYU AUTHORIZED</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-5 flex items-start space-x-4">
                            <span class="font-mono text-xs font-bold text-black mt-0.5 flex-shrink-0">[03]</span>
                            <div class="text-sm text-neutral-800 font-sans leading-relaxed">
                                <strong>Order Refusal:</strong> <?php esc_html_e( 'We reserve the right to accept, reject, or cancel any order placed on the Website. Reasons for cancellation may include inaccuracies in pricing or stock numbers, suspected fraud or unauthorized commercial resale, or logistics service unavailability to your pincode.', 'mazestreetwear' ); ?>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- SECTION 4 -->
                <section id="section-4" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">04</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '4. Intellectual Property', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="p-6 border border-black bg-white space-y-4">
                        <p class="text-sm sm:text-base text-neutral-800 font-sans leading-relaxed">
                            <?php esc_html_e( 'All content on this Website—including the brand name "Maze Streetwear," custom logos, apparel graphic prints, lookbook imagery, product descriptions, website code, and user interface styling—is the exclusive intellectual property of Maze Streetwear. You may not copy, reproduce, modify, publish, distribute, or exploit any content without express written authorization.', 'mazestreetwear' ); ?>
                        </p>

                        <div class="p-3 bg-neutral-100 border-l-2 border-black font-mono text-xs text-neutral-700">
                            <?php esc_html_e( 'Unauthorized commercial reproduction or garment design replication is strictly prohibited and subject to legal prosecution under Indian Intellectual Property laws.', 'mazestreetwear' ); ?>
                        </div>
                    </div>
                </section>

                <!-- SECTION 5 -->
                <section id="section-5" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">05</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '5. Limitation of Liability', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="p-6 border border-neutral-300 bg-white space-y-4">
                        <p class="text-sm sm:text-base text-neutral-800 font-sans leading-relaxed">
                            <?php esc_html_e( 'Maze Streetwear and its affiliates, employees, and logistics partners shall not be liable for any indirect, incidental, punitive, or consequential damages resulting from the use of, or inability to use, this Website, garment defects beyond the replacement value of the purchased item, or shipment delays caused by third-party courier handling or force majeure circumstances.', 'mazestreetwear' ); ?>
                        </p>
                    </div>
                </section>

                <!-- SECTION 6 -->
                <section id="section-6" class="scroll-mt-32 pt-4">
                    <div class="flex items-center space-x-3 mb-4 pb-2 border-b border-black">
                        <span class="text-xs font-mono font-bold bg-black text-white px-2 py-0.5">06</span>
                        <h2 class="text-xl sm:text-2xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( '6. Governing Law & Dispute Resolution', 'mazestreetwear' ); ?>
                        </h2>
                    </div>

                    <div class="p-6 border border-black bg-neutral-50 space-y-4">
                        <p class="text-sm sm:text-base text-neutral-800 font-sans leading-relaxed">
                            <?php esc_html_e( 'These Terms and any individual agreements under which we provide products or services to you shall be governed by and construed in accordance with the laws of the Republic of India. Any legal action or dispute arising out of or related to these Terms shall be subject to the exclusive jurisdiction of the competent courts in Aizawl, Mizoram, India.', 'mazestreetwear' ); ?>
                        </p>
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
// Lightweight interactions for Terms & Conditions template
(function () {
    // 1. Copy URL
    var copyUrlBtn = document.getElementById('maze-copy-terms-url-btn');
    var copyUrlText = document.getElementById('maze-copy-terms-url-text');
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


    // 3. Smooth active state for TOC
    var tocLinks = document.querySelectorAll('.maze-terms-toc-link');
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
