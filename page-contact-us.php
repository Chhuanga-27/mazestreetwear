<?php
/**
 * Template Name: Contact Us
 *
 * Minimalist Editorial Contact Us template for Maze Streetwear (mazestw.in).
 * Features store details, studio address, email, Instagram, and storefront policies.
 *
 * @package MazeStreetwear
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$contact_url  = function_exists( 'mazestreetwear_get_contact_url' ) ? mazestreetwear_get_contact_url() : home_url( '/contact-us/' );
$shipping_url = function_exists( 'mazestreetwear_get_shipping_policy_url' ) ? mazestreetwear_get_shipping_policy_url() : home_url( '/shipping-policy/' );
$refund_url   = function_exists( 'mazestreetwear_get_refund_policy_url' ) ? mazestreetwear_get_refund_policy_url() : home_url( '/refund-policy/' );
$terms_url    = function_exists( 'mazestreetwear_get_terms_url' ) ? mazestreetwear_get_terms_url() : home_url( '/terms-and-conditions/' );
$privacy_url  = function_exists( 'mazestreetwear_get_privacy_policy_url' ) ? mazestreetwear_get_privacy_policy_url() : home_url( '/privacy-policy/' );
?>

<!-- Schema.org JSON-LD Structured Data for Contact Page & Brand Entity -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "ContactPage",
      "@id": "<?php echo esc_url( $contact_url ); ?>#webpage",
      "url": "<?php echo esc_url( $contact_url ); ?>",
      "name": "Contact Us - Maze Streetwear",
      "description": "Official contact directory for Maze Streetwear. Studio headquarters in Aizawl, Mizoram, direct email at enquiries@mazestw.in, and official Instagram @maze.stw.",
      "publisher": {
        "@id": "https://mazestw.in/#organization"
      }
    },
    {
      "@type": "ClothingStore",
      "@id": "https://mazestw.in/#organization",
      "name": "Maze Streetwear",
      "alternateName": ["MAZE", "mazestw.in"],
      "url": "https://mazestw.in",
      "logo": "<?php echo esc_url( get_template_directory_uri() . '/assets/images/maze_logo.png' ); ?>",
      "telephone": "+918787324795",
      "email": "enquiries@mazestw.in",
      "priceRange": "₹₹",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Bungkawn Vengthar, A-25",
        "addressLocality": "Aizawl",
        "addressRegion": "Mizoram",
        "postalCode": "796005",
        "addressCountry": "IN"
      },
      "sameAs": [
        "https://www.instagram.com/maze.stw?utm_source=ig_web_button_share_sheet&exln=ZDNlZDc0MzIxNw=="
      ]
    }
  ]
}
</script>

<main id="primary" class="site-main min-h-[75vh] bg-[#FEFEF3] text-black py-12 sm:py-20 lg:py-24">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Minimal Header -->
        <header class="mb-12 sm:mb-16">
            <h1 class="text-5xl sm:text-7xl lg:text-8xl font-normal font-bebas uppercase tracking-tight text-black mb-3">
                <?php esc_html_e( 'Contact Us', 'mazestreetwear' ); ?>
            </h1>
            <p class="text-base sm:text-lg font-outfit text-neutral-800 font-normal max-w-xl leading-relaxed">
                <?php esc_html_e( 'Direct access to the MAZE studio desk. For customer care, orders, archive inquiries, or studio appointments.', 'mazestreetwear' ); ?>
            </p>
        </header>

        <!-- 3-Pillar Minimal Contact Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 mb-16 sm:mb-20">

            <!-- 1. Store & Studio Address -->
            <div class="flex flex-col justify-between p-6 sm:p-8 bg-white border border-black/15 rounded-2xl hover:border-black/40 transition-colors">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-mono font-bold tracking-widest text-neutral-500 uppercase">
                            01 // <?php esc_html_e( 'Location', 'mazestreetwear' ); ?>
                        </span>
                        <span class="w-8 h-8 rounded-full bg-neutral-100 flex items-center justify-center text-black">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-bebas uppercase tracking-wide text-black mb-3">
                        <?php esc_html_e( 'Store & Studio', 'mazestreetwear' ); ?>
                    </h2>

                    <address class="not-italic text-sm sm:text-base font-outfit text-neutral-800 leading-relaxed mb-4">
                        <strong class="font-bold text-black block">Maze Streetwear</strong>
                        <span>Bungkawn Vengthar, A-25</span><br>
                        <span>Aizawl, Mizoram — 796005</span><br>
                        <span>India</span>
                    </address>

                    <p class="text-xs font-outfit text-neutral-600 mb-6">
                        <?php esc_html_e( 'Hours: Mon–Sat, 10:00 AM – 6:00 PM IST', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <div class="pt-4 border-t border-neutral-200">
                    <a href="https://maps.google.com/?q=Bungkawn+Vengthar+Aizawl+Mizoram+796005" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 text-xs sm:text-sm font-outfit font-semibold uppercase tracking-wider text-black hover:underline underline-offset-4">
                        <span><?php esc_html_e( 'View on Google Maps', 'mazestreetwear' ); ?></span>
                        <span aria-hidden="true">&nearr;</span>
                    </a>
                </div>
            </div>

            <!-- 2. Email Desk -->
            <div class="flex flex-col justify-between p-6 sm:p-8 bg-white border border-black/15 rounded-2xl hover:border-black/40 transition-colors">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-mono font-bold tracking-widest text-neutral-500 uppercase">
                            02 // <?php esc_html_e( 'Email Desk', 'mazestreetwear' ); ?>
                        </span>
                        <span class="w-8 h-8 rounded-full bg-neutral-100 flex items-center justify-center text-black">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-bebas uppercase tracking-wide text-black mb-3">
                        <?php esc_html_e( 'Official Email', 'mazestreetwear' ); ?>
                    </h2>

                    <div class="mb-4">
                        <a href="mailto:enquiries@mazestw.in" class="text-base sm:text-lg font-outfit font-bold text-black hover:underline underline-offset-4 break-all block">
                            enquiries@mazestw.in
                        </a>
                        <p class="text-xs sm:text-sm font-outfit text-neutral-700 mt-2 leading-relaxed">
                            <?php esc_html_e( 'For customer care, order dispatch tracking, size exchanges, and collaborations.', 'mazestreetwear' ); ?>
                        </p>
                    </div>

                    <p class="text-xs font-outfit text-neutral-600 mb-6">
                        <?php esc_html_e( 'Response time: Within 24 business hours', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <div class="pt-4 border-t border-neutral-200 flex items-center justify-between">
                    <a href="mailto:enquiries@mazestw.in" class="inline-flex items-center space-x-1.5 text-xs sm:text-sm font-outfit font-semibold uppercase tracking-wider text-black hover:underline underline-offset-4">
                        <span><?php esc_html_e( 'Compose Email', 'mazestreetwear' ); ?></span>
                        <span aria-hidden="true">&nearr;</span>
                    </a>
                    <button type="button" id="maze-copy-email-btn" class="text-xs font-mono font-bold uppercase tracking-wider text-neutral-600 hover:text-black transition-colors px-2 py-1 border border-neutral-300 rounded hover:border-black">
                        <span id="maze-copy-email-text"><?php esc_html_e( 'Copy', 'mazestreetwear' ); ?></span>
                    </button>
                </div>
            </div>

            <!-- 3. Instagram -->
            <div class="flex flex-col justify-between p-6 sm:p-8 bg-white border border-black/15 rounded-2xl hover:border-black/40 transition-colors">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-mono font-bold tracking-widest text-neutral-500 uppercase">
                            03 // <?php esc_html_e( 'Instagram', 'mazestreetwear' ); ?>
                        </span>
                        <span class="w-8 h-8 rounded-full bg-neutral-100 flex items-center justify-center text-black">
                            <svg class="w-4 h-4 text-[#E4405F]" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-bebas uppercase tracking-wide text-black mb-3">
                        <?php esc_html_e( 'Instagram', 'mazestreetwear' ); ?>
                    </h2>

                    <div class="mb-4">
                        <a href="https://www.instagram.com/maze.stw?utm_source=ig_web_button_share_sheet&exln=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" class="text-base sm:text-lg font-outfit font-bold text-black hover:underline underline-offset-4 block">
                            @maze.stw
                        </a>
                        <p class="text-xs sm:text-sm font-outfit text-neutral-700 mt-2 leading-relaxed">
                            <?php esc_html_e( 'Direct messages, upcoming drop reveals, styling editorials, and community archive.', 'mazestreetwear' ); ?>
                        </p>
                    </div>

                    <p class="text-xs font-outfit text-neutral-600 mb-6">
                        <?php esc_html_e( 'Daily stories & release updates', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <div class="pt-4 border-t border-neutral-200">
                    <a href="https://www.instagram.com/maze.stw?utm_source=ig_web_button_share_sheet&exln=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 text-xs sm:text-sm font-outfit font-semibold uppercase tracking-wider text-black hover:underline underline-offset-4">
                        <span><?php esc_html_e( 'Follow @maze.stw', 'mazestreetwear' ); ?></span>
                        <span aria-hidden="true">&nearr;</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- MAZE Storefront Policies Section -->
        <section class="border border-black p-6 sm:p-8 bg-neutral-50 flex flex-col md:flex-row items-center justify-between gap-4 font-mono text-xs sm:text-sm no-print" aria-label="<?php esc_attr_e( 'Storefront Policies', 'mazestreetwear' ); ?>">
            <div>
                <span class="font-bold uppercase tracking-wider text-black block mb-0.5 text-sm sm:text-base">
                    <?php esc_html_e( 'MAZE STOREFRONT POLICIES', 'mazestreetwear' ); ?>
                </span>
                <span class="text-neutral-800 font-medium">
                    <?php esc_html_e( 'Review our complete operating guidelines, legal standards, and terms.', 'mazestreetwear' ); ?>
                </span>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="<?php echo esc_url( $shipping_url ); ?>" class="px-4 py-2 border border-black bg-white hover:bg-black hover:text-white transition-colors uppercase font-bold text-xs sm:text-sm">
                    <?php esc_html_e( 'Shipping Policy', 'mazestreetwear' ); ?>
                </a>
                <a href="<?php echo esc_url( $refund_url ); ?>" class="px-4 py-2 border border-black bg-white hover:bg-black hover:text-white transition-colors uppercase font-bold text-xs sm:text-sm">
                    <?php esc_html_e( 'Refund & Exchange', 'mazestreetwear' ); ?>
                </a>
                <a href="<?php echo esc_url( $terms_url ); ?>" class="px-4 py-2 border border-black bg-white hover:bg-black hover:text-white transition-colors uppercase font-bold text-xs sm:text-sm">
                    <?php esc_html_e( 'Terms & Conditions', 'mazestreetwear' ); ?>
                </a>
                <a href="<?php echo esc_url( $privacy_url ); ?>" class="px-4 py-2 border border-black bg-white hover:bg-black hover:text-white transition-colors uppercase font-bold text-xs sm:text-sm">
                    <?php esc_html_e( 'Privacy Policy', 'mazestreetwear' ); ?>
                </a>
            </div>
        </section>

    </div>
</main>

<script>
(function() {
    'use strict';
    var copyBtn = document.getElementById('maze-copy-email-btn');
    var copyText = document.getElementById('maze-copy-email-text');
    if (copyBtn && copyText) {
        copyBtn.addEventListener('click', function(e) {
            e.preventDefault();
            navigator.clipboard.writeText('enquiries@mazestw.in').then(function() {
                copyText.textContent = 'Copied!';
                setTimeout(function() {
                    copyText.textContent = 'Copy';
                }, 2000);
            }).catch(function() {
                copyText.textContent = 'Copied!';
                setTimeout(function() {
                    copyText.textContent = 'Copy';
                }, 2000);
            });
        });
    }
})();
</script>

<?php
get_footer();
