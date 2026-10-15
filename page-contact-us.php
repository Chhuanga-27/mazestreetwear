<?php
/**
 * Template Name: Contact Us
 *
 * Official Concierge Desk & Studio Communications template for Maze Streetwear (mazestw.in).
 * Stark Luxury Minimalist Editorial layout matching Helmut Lang / Maison Margiela / Stüssy aesthetics.
 *
 * @package MazeStreetwear
 * @version 1.0.0
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
$ajax_url     = admin_url( 'admin-ajax.php' );
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
      "name": "Contact Maze Streetwear // Studio Concierge Desk",
      "description": "Official customer concierge and communications portal for Maze Streetwear (mazestw.in). Direct assistance via WhatsApp (+918787324795), email (enquiries@mazestw.in), and studio headquarters in Aizawl, Mizoram.",
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
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 23.7271,
        "longitude": 92.7176
      },
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          "opens": "10:00",
          "closes": "18:00"
        }
      ],
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+918787324795",
        "contactType": "Customer Concierge & Support Desk",
        "email": "enquiries@mazestw.in",
        "availableLanguage": ["English", "Hindi", "Mizo"]
      },
      "sameAs": [
        "https://instagram.com/mazestw.in",
        "https://x.com/mazestw",
        "https://tiktok.com/@mazestw",
        "https://youtube.com/@mazestw"
      ]
    }
  ]
}
</script>

<main id="primary" class="site-main min-h-screen bg-white text-black py-8 sm:py-14 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Top Breadcrumbs & Utility Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 mb-8 border-b border-neutral-200 text-xs font-mono gap-4 no-print">
            <nav aria-label="<?php esc_attr_e( 'Breadcrumb', 'mazestreetwear' ); ?>" class="flex items-center space-x-2 text-neutral-500">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-black transition-colors uppercase">
                    <?php esc_html_e( 'Home', 'mazestreetwear' ); ?>
                </a>
                <span class="text-neutral-300">/</span>
                <span class="text-neutral-400 uppercase"><?php esc_html_e( 'Concierge & Studio', 'mazestreetwear' ); ?></span>
                <span class="text-neutral-300">/</span>
                <span class="text-black font-bold uppercase tracking-wider"><?php esc_html_e( 'Contact Us', 'mazestreetwear' ); ?></span>
            </nav>

            <div class="flex items-center space-x-3 text-neutral-600">
                <button type="button" onclick="window.print()" class="inline-flex items-center space-x-1.5 hover:text-black transition-colors px-2.5 py-1 border border-neutral-200 hover:border-black bg-white rounded-none">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75V4.5a2.25 2.25 0 012.25-2.25h6a2.25 2.25 0 012.25 2.25v2.25m-10.5 0h10.5m-10.5 0H4.5A2.25 2.25 0 002.25 9v6a2.25 2.25 0 002.25 2.25h2.25m10.5-10.5H19.5A2.25 2.25 0 0121.75 9v6a2.25 2.25 0 01-2.25 2.25h-2.25m-10.5 0v3.75A2.25 2.25 0 008.25 21h7.5a2.25 2.25 0 002.25-2.25V17.25m-12 0h12" />
                    </svg>
                    <span><?php esc_html_e( 'PRINT / PDF', 'mazestreetwear' ); ?></span>
                </button>

                <button type="button" id="maze-copy-contact-url-btn" class="inline-flex items-center space-x-1.5 hover:text-black transition-colors px-2.5 py-1 border border-neutral-200 hover:border-black bg-white rounded-none">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-3.35l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                    </svg>
                    <span id="maze-copy-contact-url-text"><?php esc_html_e( 'SHARE LINK', 'mazestreetwear' ); ?></span>
                </button>
            </div>
        </div>

        <!-- Editorial Document Header -->
        <header class="mb-12 pb-8 border-b-2 border-black">
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <span class="inline-flex items-center space-x-2 text-[10px] sm:text-xs font-mono font-bold tracking-widest text-black uppercase border border-black px-3 py-1 bg-white">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span><?php esc_html_e( 'MAZE PROTOCOL // CONCIERGE & STUDIO DESK REF: CTX-2026-V1', 'mazestreetwear' ); ?></span>
                </span>
                <span class="inline-block text-[10px] sm:text-xs font-mono font-bold tracking-widest text-white uppercase border border-black px-3 py-1 bg-black">
                    <?php esc_html_e( 'OFFICIAL COMMUNICATIONS // AIZAWL ARCHIVE', 'mazestreetwear' ); ?>
                </span>
            </div>

            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
                <div>
                    <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black font-sans uppercase tracking-tight text-black mb-3">
                        <?php esc_html_e( 'Get In Touch', 'mazestreetwear' ); ?>
                    </h1>
                    <p class="text-base sm:text-lg font-sans text-neutral-600 max-w-2xl leading-relaxed">
                        <?php esc_html_e( 'Contemporary streetwear designed with architectural precision. Whether you need sizing advice, dispatch tracking, exchange processing, or press access, our studio desk in Aizawl, Mizoram is at your service.', 'mazestreetwear' ); ?>
                    </p>
                </div>

                <!-- Live Desk Status Pill -->
                <div class="flex-shrink-0 bg-neutral-50 border border-black p-4 font-mono text-xs max-w-xs">
                    <div class="flex items-center space-x-2 mb-1.5">
                        <span id="maze-status-beacon" class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <strong id="maze-status-text" class="font-bold uppercase tracking-wider text-black">
                            <?php esc_html_e( 'STUDIO DESK ACTIVE', 'mazestreetwear' ); ?>
                        </strong>
                    </div>
                    <div class="text-[11px] text-neutral-500 space-y-0.5">
                        <p><span class="text-neutral-400"><?php esc_html_e( 'Local Time:', 'mazestreetwear' ); ?></span> <span id="maze-contact-live-time" class="font-bold text-neutral-900"><?php echo esc_html( wp_date( 'g:i:s A' ) ); ?></span> (IST)</p>
                        <p><span class="text-neutral-400"><?php esc_html_e( 'Hours:', 'mazestreetwear' ); ?></span> Mon–Sat 10:00 AM – 6:00 PM</p>
                        <p><span class="text-neutral-400"><?php esc_html_e( 'Target SLA:', 'mazestreetwear' ); ?></span> <?php esc_html_e( 'Under 24 Hours Response', 'mazestreetwear' ); ?></p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 pt-6 mt-8 border-t border-neutral-200 font-mono text-xs text-neutral-700">
                <div>
                    <span class="block text-[10px] uppercase tracking-wider text-neutral-400"><?php esc_html_e( 'Official Email Desk', 'mazestreetwear' ); ?></span>
                    <a href="mailto:enquiries@mazestw.in" class="font-bold text-black hover:underline text-sm truncate block">
                        enquiries@mazestw.in
                    </a>
                </div>
                <div>
                    <span class="block text-[10px] uppercase tracking-wider text-neutral-400"><?php esc_html_e( 'Voice / WhatsApp', 'mazestreetwear' ); ?></span>
                    <a href="https://wa.me/918787324795" target="_blank" rel="noopener noreferrer" class="font-bold text-black hover:underline text-sm">
                        +91 8787324795
                    </a>
                </div>
                <div>
                    <span class="block text-[10px] uppercase tracking-wider text-neutral-400"><?php esc_html_e( 'Studio Headquarters', 'mazestreetwear' ); ?></span>
                    <strong class="font-bold text-black text-sm"><?php esc_html_e( 'Aizawl, Mizoram, 796005', 'mazestreetwear' ); ?></strong>
                </div>
                <div>
                    <span class="block text-[10px] uppercase tracking-wider text-neutral-400"><?php esc_html_e( 'Social Archive', 'mazestreetwear' ); ?></span>
                    <a href="https://instagram.com/mazestw.in" target="_blank" rel="noopener noreferrer" class="font-bold text-black hover:underline text-sm">
                        @mazestw.in &nearr;
                    </a>
                </div>
            </div>
        </header>

        <!-- 4 Fast-Action Channel Cards (Hairline Grid) -->
        <section class="mb-14 border border-black bg-neutral-50" aria-label="<?php esc_attr_e( 'Direct Communication Channels', 'mazestreetwear' ); ?>">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-black">

                <!-- Channel 1: WhatsApp Direct Concierge -->
                <div class="p-6 bg-white flex flex-col justify-between group hover:bg-neutral-50/70 transition-colors">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[11px] font-mono font-bold tracking-widest text-neutral-400">01 // INSTANT CHAT</span>
                            <span class="w-7 h-7 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-200">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.071.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.086s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z"/>
                                </svg>
                            </span>
                        </div>
                        <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-1.5">
                            <?php esc_html_e( 'WhatsApp Direct', 'mazestreetwear' ); ?>
                        </h2>
                        <p class="text-xs text-neutral-600 leading-relaxed font-sans mb-4">
                            <?php esc_html_e( 'Direct real-time concierge for urgent order tracking, garment measurements, and immediate drop questions.', 'mazestreetwear' ); ?>
                        </p>
                        <span class="block font-mono text-xs font-bold text-black mb-4">
                            +91 8787324795
                        </span>
                    </div>
                    <a href="https://wa.me/918787324795?text=Hello%20MAZE%20team%2C%20I%20have%20an%20inquiry%20regarding%20an%20order%20%2F%20garment." target="_blank" rel="noopener noreferrer" class="w-full inline-flex items-center justify-center space-x-2 px-4 py-2.5 bg-black text-white hover:bg-neutral-800 transition-colors text-xs font-mono font-bold uppercase tracking-wider">
                        <span><?php esc_html_e( 'OPEN CHAT', 'mazestreetwear' ); ?></span>
                        <span>&nearr;</span>
                    </a>
                </div>

                <!-- Channel 2: Official Support Email -->
                <div class="p-6 bg-white flex flex-col justify-between group hover:bg-neutral-50/70 transition-colors">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[11px] font-mono font-bold tracking-widest text-neutral-400">02 // OFFICIAL DESK</span>
                            <span class="w-7 h-7 rounded-full bg-neutral-100 text-black flex items-center justify-center border border-neutral-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </span>
                        </div>
                        <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-1.5">
                            <?php esc_html_e( 'Official Email Desk', 'mazestreetwear' ); ?>
                        </h2>
                        <p class="text-xs text-neutral-600 leading-relaxed font-sans mb-4">
                            <?php esc_html_e( 'For detailed order queries, exchange documentation, invoices, editorial press, or legal compliance matters.', 'mazestreetwear' ); ?>
                        </p>
                        <span class="block font-mono text-xs font-bold text-black truncate mb-4 select-all">
                            enquiries@mazestw.in
                        </span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="mailto:enquiries@mazestw.in" class="flex-1 text-center px-3 py-2.5 bg-black text-white hover:bg-neutral-800 transition-colors text-xs font-mono font-bold uppercase tracking-wider">
                            <?php esc_html_e( 'SEND EMAIL', 'mazestreetwear' ); ?>
                        </a>
                        <button type="button" id="maze-copy-email-btn" class="px-3 py-2.5 border border-black hover:bg-neutral-100 transition-colors text-xs font-mono font-bold uppercase tracking-wider" title="<?php esc_attr_e( 'Copy email address', 'mazestreetwear' ); ?>">
                            <span id="maze-copy-email-text"><?php esc_html_e( 'COPY', 'mazestreetwear' ); ?></span>
                        </button>
                    </div>
                </div>

                <!-- Channel 3: Direct Phone Line -->
                <div class="p-6 bg-white flex flex-col justify-between group hover:bg-neutral-50/70 transition-colors">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[11px] font-mono font-bold tracking-widest text-neutral-400">03 // VOICE LINE</span>
                            <span class="w-7 h-7 rounded-full bg-neutral-100 text-black flex items-center justify-center border border-neutral-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                            </span>
                        </div>
                        <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-1.5">
                            <?php esc_html_e( 'Direct Voice Line', 'mazestreetwear' ); ?>
                        </h2>
                        <p class="text-xs text-neutral-600 leading-relaxed font-sans mb-4">
                            <?php esc_html_e( 'Live telephone support with our studio coordinators during operating hours. Carrier transit and urgent dispatch updates.', 'mazestreetwear' ); ?>
                        </p>
                        <span class="block font-mono text-xs font-bold text-black mb-4">
                            +91 8787324795
                        </span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="tel:+918787324795" class="flex-1 text-center px-3 py-2.5 bg-black text-white hover:bg-neutral-800 transition-colors text-xs font-mono font-bold uppercase tracking-wider">
                            <?php esc_html_e( 'CALL STUDIO', 'mazestreetwear' ); ?>
                        </a>
                        <button type="button" id="maze-copy-phone-btn" class="px-3 py-2.5 border border-black hover:bg-neutral-100 transition-colors text-xs font-mono font-bold uppercase tracking-wider" title="<?php esc_attr_e( 'Copy telephone number', 'mazestreetwear' ); ?>">
                            <span id="maze-copy-phone-text"><?php esc_html_e( 'COPY', 'mazestreetwear' ); ?></span>
                        </button>
                    </div>
                </div>

                <!-- Channel 4: Design Studio & Archive Headquarters -->
                <div class="p-6 bg-white flex flex-col justify-between group hover:bg-neutral-50/70 transition-colors">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[11px] font-mono font-bold tracking-widest text-neutral-400">04 // LOCATION</span>
                            <span class="w-7 h-7 rounded-full bg-neutral-100 text-black flex items-center justify-center border border-neutral-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </span>
                        </div>
                        <h2 class="text-base font-bold uppercase font-sans tracking-tight text-black mb-1.5">
                            <?php esc_html_e( 'Studio Headquarters', 'mazestreetwear' ); ?>
                        </h2>
                        <address class="not-italic text-xs text-neutral-600 leading-relaxed font-sans mb-4">
                            <strong>Maze Streetwear</strong><br>
                            Bungkawn Vengthar, A-25<br>
                            Aizawl, Mizoram, 796005, India
                        </address>
                        <span class="block font-mono text-[11px] text-neutral-400 mb-4 uppercase">
                            <?php esc_html_e( 'Dispatches & Archival Hub', 'mazestreetwear' ); ?>
                        </span>
                    </div>
                    <a href="https://maps.google.com/?q=Bungkawn+Vengthar+Aizawl+Mizoram+796005" target="_blank" rel="noopener noreferrer" class="w-full inline-flex items-center justify-center space-x-2 px-4 py-2.5 border border-black hover:bg-black hover:text-white transition-colors text-xs font-mono font-bold uppercase tracking-wider">
                        <span><?php esc_html_e( 'GOOGLE MAPS', 'mazestreetwear' ); ?></span>
                        <span>&nearr;</span>
                    </a>
                </div>

            </div>
        </section>

        <!-- Main Split Section: Transmission Form & Studio Operations Center -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 mb-16 items-start">

            <!-- Left Column: The Interactive Transmission Form (7 cols) -->
            <div class="lg:col-span-7 border border-black p-6 sm:p-8 lg:p-10 bg-white">
                
                <div class="flex items-center justify-between pb-4 mb-6 border-b border-black">
                    <div>
                        <span class="text-[10px] font-mono font-bold tracking-widest text-neutral-400 uppercase block mb-1">
                            <?php esc_html_e( 'TRANSMISSION PROTOCOL // INQUIRY DESK', 'mazestreetwear' ); ?>
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-black font-sans uppercase tracking-tight text-black">
                            <?php esc_html_e( 'Dispatch a Message', 'mazestreetwear' ); ?>
                        </h2>
                    </div>
                    <span class="hidden sm:inline-block px-2.5 py-1 text-[10px] font-mono uppercase bg-neutral-100 border border-neutral-300 font-bold">
                        <?php esc_html_e( 'SSL ENCRYPTED', 'mazestreetwear' ); ?>
                    </span>
                </div>

                <!-- Quick Category Presets (Changes department and pre-fills message template) -->
                <div class="mb-6">
                    <label class="block text-[11px] font-mono font-bold uppercase tracking-wider text-neutral-500 mb-2">
                        <?php esc_html_e( 'Quick Department Selector:', 'mazestreetwear' ); ?>
                    </label>
                    <div class="flex flex-wrap gap-1.5" id="maze-department-pills">
                        <button type="button" data-dept="General Concierge" class="maze-dept-pill px-2.5 py-1 border border-black text-[11px] font-mono uppercase transition-colors bg-black text-white font-bold">
                            <?php esc_html_e( 'General', 'mazestreetwear' ); ?>
                        </button>
                        <button type="button" data-dept="Order Tracking & Dispatch" class="maze-dept-pill px-2.5 py-1 border border-neutral-300 hover:border-black text-[11px] font-mono uppercase transition-colors bg-white text-black">
                            <?php esc_html_e( 'Order Tracking', 'mazestreetwear' ); ?>
                        </button>
                        <button type="button" data-dept="Size Exchange & Return" class="maze-dept-pill px-2.5 py-1 border border-neutral-300 hover:border-black text-[11px] font-mono uppercase transition-colors bg-white text-black">
                            <?php esc_html_e( 'Size Exchange', 'mazestreetwear' ); ?>
                        </button>
                        <button type="button" data-dept="Garment Sizing Advice" class="maze-dept-pill px-2.5 py-1 border border-neutral-300 hover:border-black text-[11px] font-mono uppercase transition-colors bg-white text-black">
                            <?php esc_html_e( 'Sizing & Fit', 'mazestreetwear' ); ?>
                        </button>
                        <button type="button" data-dept="Press & Collaborations" class="maze-dept-pill px-2.5 py-1 border border-neutral-300 hover:border-black text-[11px] font-mono uppercase transition-colors bg-white text-black">
                            <?php esc_html_e( 'Press / Wholesale', 'mazestreetwear' ); ?>
                        </button>
                    </div>
                </div>

                <!-- Live Alert / Toast Box -->
                <div id="maze-form-feedback" class="hidden mb-6 p-4 border text-xs font-mono transition-all"></div>

                <form id="maze-contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="space-y-5">
                    <?php wp_nonce_field( 'maze_contact_action', 'maze_contact_nonce' ); ?>
                    <input type="hidden" name="action" value="maze_contact_submission">
                    
                    <!-- Anti-spam honeypot (hidden from humans) -->
                    <div class="hidden" aria-hidden="true">
                        <label for="maze_website_url">Leave empty</label>
                        <input type="text" name="maze_website_url" id="maze_website_url" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Full Name -->
                        <div>
                            <label for="maze_name" class="block text-xs font-mono font-bold uppercase tracking-wider text-black mb-1.5">
                                <?php esc_html_e( 'Your Name *', 'mazestreetwear' ); ?>
                            </label>
                            <input 
                                type="text" 
                                id="maze_name" 
                                name="maze_name" 
                                required 
                                placeholder="<?php echo esc_attr_x( 'e.g. Liam Ralte', 'placeholder', 'mazestreetwear' ); ?>"
                                class="w-full px-3.5 py-2.5 border border-black bg-white focus:bg-neutral-50 focus:outline-none focus:ring-1 focus:ring-black text-sm font-sans"
                            >
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label for="maze_email" class="block text-xs font-mono font-bold uppercase tracking-wider text-black mb-1.5">
                                <?php esc_html_e( 'Email Address *', 'mazestreetwear' ); ?>
                            </label>
                            <input 
                                type="email" 
                                id="maze_email" 
                                name="maze_email" 
                                required 
                                placeholder="<?php echo esc_attr_x( 'name@domain.com', 'placeholder', 'mazestreetwear' ); ?>"
                                class="w-full px-3.5 py-2.5 border border-black bg-white focus:bg-neutral-50 focus:outline-none focus:ring-1 focus:ring-black text-sm font-sans"
                            >
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Phone / WhatsApp -->
                        <div>
                            <label for="maze_phone" class="block text-xs font-mono font-bold uppercase tracking-wider text-black mb-1.5">
                                <?php esc_html_e( 'Contact Phone / WhatsApp', 'mazestreetwear' ); ?>
                            </label>
                            <div class="flex items-center border border-black">
                                <span class="bg-neutral-100 px-3 py-2.5 text-xs font-mono border-r border-black text-neutral-600 select-none">
                                    +91
                                </span>
                                <input 
                                    type="tel" 
                                    id="maze_phone" 
                                    name="maze_phone" 
                                    placeholder="<?php echo esc_attr_x( '10-digit number', 'placeholder', 'mazestreetwear' ); ?>"
                                    class="w-full px-3 py-2.5 bg-white focus:bg-neutral-50 focus:outline-none text-sm font-sans border-0"
                                >
                            </div>
                        </div>

                        <!-- Department Selection -->
                        <div>
                            <label for="maze_department" class="block text-xs font-mono font-bold uppercase tracking-wider text-black mb-1.5">
                                <?php esc_html_e( 'Department *', 'mazestreetwear' ); ?>
                            </label>
                            <select 
                                id="maze_department" 
                                name="maze_department" 
                                required 
                                class="w-full px-3.5 py-2.5 border border-black bg-white focus:bg-neutral-50 focus:outline-none focus:ring-1 focus:ring-black text-xs font-mono uppercase"
                            >
                                <option value="General Concierge"><?php esc_html_e( 'General Concierge', 'mazestreetwear' ); ?></option>
                                <option value="Order Tracking & Dispatch"><?php esc_html_e( 'Order Tracking & Dispatch', 'mazestreetwear' ); ?></option>
                                <option value="Size Exchange & Return"><?php esc_html_e( 'Size Exchange & Return', 'mazestreetwear' ); ?></option>
                                <option value="Garment Sizing Advice"><?php esc_html_e( 'Garment Sizing Advice', 'mazestreetwear' ); ?></option>
                                <option value="Press & Collaborations"><?php esc_html_e( 'Press & Collaborations', 'mazestreetwear' ); ?></option>
                                <option value="Grievance Redressal"><?php esc_html_e( 'Grievance Redressal', 'mazestreetwear' ); ?></option>
                            </select>
                        </div>
                    </div>

                    <!-- Order Reference (Optional / Conditional) -->
                    <div id="maze_order_wrap">
                        <label for="maze_order" class="block text-xs font-mono font-bold uppercase tracking-wider text-black mb-1.5 flex items-center justify-between">
                            <span><?php esc_html_e( 'Order Number / AWB Tracking (If applicable)', 'mazestreetwear' ); ?></span>
                            <span class="text-[10px] text-neutral-400 font-normal"><?php esc_html_e( 'Optional', 'mazestreetwear' ); ?></span>
                        </label>
                        <input 
                            type="text" 
                            id="maze_order" 
                            name="maze_order" 
                            placeholder="<?php echo esc_attr_x( 'e.g. #MAZE-1084 / DELHIVERY-129482', 'placeholder', 'mazestreetwear' ); ?>"
                            class="w-full px-3.5 py-2.5 border border-black bg-white focus:bg-neutral-50 focus:outline-none focus:ring-1 focus:ring-black text-sm font-sans font-mono"
                        >
                    </div>

                    <!-- Subject Line -->
                    <div>
                        <label for="maze_subject" class="block text-xs font-mono font-bold uppercase tracking-wider text-black mb-1.5">
                            <?php esc_html_e( 'Subject *', 'mazestreetwear' ); ?>
                        </label>
                        <input 
                            type="text" 
                            id="maze_subject" 
                            name="maze_subject" 
                            required 
                            placeholder="<?php echo esc_attr_x( 'Brief summary of your inquiry', 'placeholder', 'mazestreetwear' ); ?>"
                            class="w-full px-3.5 py-2.5 border border-black bg-white focus:bg-neutral-50 focus:outline-none focus:ring-1 focus:ring-black text-sm font-sans"
                        >
                    </div>

                    <!-- Detailed Message -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="maze_message" class="block text-xs font-mono font-bold uppercase tracking-wider text-black">
                                <?php esc_html_e( 'Detailed Inquiry *', 'mazestreetwear' ); ?>
                            </label>
                            <span id="maze_char_counter" class="text-[10px] font-mono text-neutral-400">0 / 2000</span>
                        </div>
                        <textarea 
                            id="maze_message" 
                            name="maze_message" 
                            rows="6" 
                            maxlength="2000"
                            required 
                            placeholder="<?php echo esc_attr_x( 'Please detail your requirements, order specifics, garment sizing questions, or feedback...', 'placeholder', 'mazestreetwear' ); ?>"
                            class="w-full p-3.5 border border-black bg-white focus:bg-neutral-50 focus:outline-none focus:ring-1 focus:ring-black text-sm font-sans leading-relaxed"
                        ></textarea>
                    </div>

                    <!-- Submission Button -->
                    <div class="pt-2">
                        <button 
                            type="submit" 
                            id="maze_submit_btn" 
                            class="w-full sm:w-auto inline-flex items-center justify-center space-x-3 px-8 py-3.5 bg-black text-white hover:bg-neutral-800 transition-all font-mono text-xs font-bold uppercase tracking-widest border border-black shadow-brutal hover:shadow-none translate-x-0 hover:translate-x-1 hover:translate-y-1"
                        >
                            <span id="maze_submit_text"><?php esc_html_e( 'TRANSMIT INQUIRY // [ SEND MESSAGE ]', 'mazestreetwear' ); ?></span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                            </svg>
                        </button>
                    </div>

                    <div class="pt-2 flex items-center space-x-2 text-[11px] font-mono text-neutral-500">
                        <svg class="w-3.5 h-3.5 text-neutral-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                        <span>
                            <?php esc_html_e( 'Your privacy is protected. Inquiries are strictly handled in compliance with our Privacy Policy.', 'mazestreetwear' ); ?>
                        </span>
                    </div>

                </form>

            </div>

            <!-- Right Column: Studio Operations Center, Coordinates & SLAs (5 cols) -->
            <div class="lg:col-span-5 space-y-6">

                <!-- Live Studio Architecture Card -->
                <div class="border border-black p-6 bg-neutral-50 font-mono text-xs">
                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-black">
                        <span class="font-bold uppercase tracking-wider text-black">
                            <?php esc_html_e( 'OPERATIONS DESK // AIZAWL', 'mazestreetwear' ); ?>
                        </span>
                        <span class="text-[10px] bg-black text-white px-2 py-0.5 font-bold uppercase">
                            <?php esc_html_e( 'ACTIVE NODE', 'mazestreetwear' ); ?>
                        </span>
                    </div>

                    <div class="space-y-3.5 text-neutral-700">
                        <div class="flex items-center justify-between pb-2 border-b border-neutral-200">
                            <span class="text-neutral-500 uppercase"><?php esc_html_e( 'Timezone', 'mazestreetwear' ); ?></span>
                            <span class="font-bold text-black">Asia/Kolkata (IST, UTC+5:30)</span>
                        </div>
                        <div class="flex items-center justify-between pb-2 border-b border-neutral-200">
                            <span class="text-neutral-500 uppercase"><?php esc_html_e( 'Coordinates', 'mazestreetwear' ); ?></span>
                            <span class="font-bold text-black">23.7271&deg; N, 92.7176&deg; E</span>
                        </div>
                        <div class="flex items-center justify-between pb-2 border-b border-neutral-200">
                            <span class="text-neutral-500 uppercase"><?php esc_html_e( 'Elevation', 'mazestreetwear' ); ?></span>
                            <span class="font-bold text-black">1,132 MASL (Metres)</span>
                        </div>
                        <div class="flex items-center justify-between pb-2 border-b border-neutral-200">
                            <span class="text-neutral-500 uppercase"><?php esc_html_e( 'Operating Days', 'mazestreetwear' ); ?></span>
                            <span class="font-bold text-black">Monday &ndash; Saturday</span>
                        </div>
                        <div class="flex items-center justify-between pb-2 border-b border-neutral-200">
                            <span class="text-neutral-500 uppercase"><?php esc_html_e( 'Studio Hours', 'mazestreetwear' ); ?></span>
                            <span class="font-bold text-black">10:00 AM &ndash; 6:00 PM IST</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-neutral-500 uppercase"><?php esc_html_e( 'National Holidays', 'mazestreetwear' ); ?></span>
                            <span class="text-neutral-600 font-sans italic"><?php esc_html_e( 'Email monitored, voice closed', 'mazestreetwear' ); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Fast-Track Guides Strip -->
                <div class="border border-black p-6 bg-white space-y-5">
                    <h3 class="text-sm font-black font-sans uppercase tracking-tight text-black border-b border-neutral-200 pb-2">
                        <?php esc_html_e( 'Fast-Track Inquiries', 'mazestreetwear' ); ?>
                    </h3>

                    <!-- Order Tracking Guide -->
                    <div class="space-y-1.5">
                        <div class="flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 bg-black rounded-full"></span>
                            <h4 class="text-xs font-bold font-sans uppercase text-black"><?php esc_html_e( 'Tracking an Existing Order?', 'mazestreetwear' ); ?></h4>
                        </div>
                        <p class="text-xs text-neutral-600 font-sans leading-relaxed pl-3.5">
                            <?php esc_html_e( 'Orders are dispatched within 24–48 hours. Once manifested, tracking numbers are sent via SMS/Email and trackable on Delhivery, Blue Dart, or India Post.', 'mazestreetwear' ); ?>
                        </p>
                        <div class="pl-3.5 pt-1">
                            <a href="<?php echo esc_url( $shipping_url ); ?>" class="text-[11px] font-mono font-bold text-black underline hover:text-neutral-600 uppercase">
                                <?php esc_html_e( 'Read Shipping & Dispatch Policy &rarr;', 'mazestreetwear' ); ?>
                            </a>
                        </div>
                    </div>

                    <!-- Size Exchange Guide -->
                    <div class="space-y-1.5 pt-3 border-t border-neutral-100">
                        <div class="flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 bg-black rounded-full"></span>
                            <h4 class="text-xs font-bold font-sans uppercase text-black"><?php esc_html_e( 'Size Exchange or Store Credit?', 'mazestreetwear' ); ?></h4>
                        </div>
                        <p class="text-xs text-neutral-600 font-sans leading-relaxed pl-3.5">
                            <?php esc_html_e( 'We offer a 7-day post-delivery window for size replacements or digital store credit on pristine, unworn garments. No cash reversals.', 'mazestreetwear' ); ?>
                        </p>
                        <div class="pl-3.5 pt-1">
                            <a href="<?php echo esc_url( $refund_url ); ?>" class="text-[11px] font-mono font-bold text-black underline hover:text-neutral-600 uppercase">
                                <?php esc_html_e( 'Read Exchange & Credit Policy &rarr;', 'mazestreetwear' ); ?>
                            </a>
                        </div>
                    </div>

                    <!-- Urgent Assistance Direct -->
                    <div class="pt-3 border-t border-neutral-100">
                        <div class="p-3.5 bg-neutral-100 border border-neutral-300 flex items-center justify-between">
                            <div class="pr-2">
                                <span class="block text-[11px] font-bold font-sans uppercase text-black"><?php esc_html_e( 'Need Immediate Assistance?', 'mazestreetwear' ); ?></span>
                                <span class="block text-[10px] font-mono text-neutral-600"><?php esc_html_e( 'WhatsApp concierge is fastest.', 'mazestreetwear' ); ?></span>
                            </div>
                            <a href="https://wa.me/918787324795" target="_blank" rel="noopener noreferrer" class="px-3 py-1.5 bg-black text-white hover:bg-neutral-800 text-[10px] font-mono uppercase font-bold flex-shrink-0">
                                <?php esc_html_e( 'CHAT NOW &nearr;', 'mazestreetwear' ); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Grievance & Compliance Cell -->
                <div class="border border-neutral-300 p-5 bg-white font-sans text-xs space-y-2">
                    <span class="block text-[10px] font-mono font-bold uppercase tracking-wider text-neutral-400">
                        <?php esc_html_e( 'STATUTORY GRIEVANCE REDRESSAL', 'mazestreetwear' ); ?>
                    </span>
                    <p class="text-neutral-800 font-medium">
                        <?php esc_html_e( 'Designated Grievance Officer: Customer Care Lead, Maze Streetwear', 'mazestreetwear' ); ?>
                    </p>
                    <p class="text-neutral-600 text-[11px] leading-relaxed">
                        <?php esc_html_e( 'In accordance with Information Technology (Intermediary Guidelines and Digital Media Ethics Code) Rules, consumer disputes may be marked Attention: Grievance Officer at enquiries@mazestw.in.', 'mazestreetwear' ); ?>
                    </p>
                </div>

            </div>

        </div>

        <!-- Frequently Asked Inquiries (Concierge FAQ Accordion) -->
        <section class="mb-16 border-t-2 border-black pt-12" aria-label="<?php esc_attr_e( 'Concierge Frequently Asked Questions', 'mazestreetwear' ); ?>">
            <div class="max-w-3xl mb-8">
                <span class="text-[10px] font-mono font-bold tracking-widest text-neutral-400 uppercase block mb-1">
                    <?php esc_html_e( 'COMMON PROTOCOLS // SELF-SERVICE FAQ', 'mazestreetwear' ); ?>
                </span>
                <h2 class="text-3xl sm:text-4xl font-black font-sans uppercase tracking-tight text-black mb-2">
                    <?php esc_html_e( 'Frequently Asked Inquiries', 'mazestreetwear' ); ?>
                </h2>
                <p class="text-sm font-sans text-neutral-600">
                    <?php esc_html_e( 'Quick answers to the most common questions received at our communications desk.', 'mazestreetwear' ); ?>
                </p>
            </div>

            <div class="space-y-3 max-w-4xl">

                <!-- FAQ 1 -->
                <details class="group border border-black bg-white transition-all open:bg-neutral-50">
                    <summary class="flex items-center justify-between p-5 cursor-pointer font-sans font-bold text-sm sm:text-base uppercase tracking-tight text-black select-none">
                        <span><?php esc_html_e( '01 // How fast will the concierge desk reply to my message?', 'mazestreetwear' ); ?></span>
                        <span class="w-6 h-6 border border-black flex items-center justify-center font-mono text-sm transition-transform duration-200 group-open:rotate-45">
                            +
                        </span>
                    </summary>
                    <div class="px-5 pb-5 pt-1 text-xs sm:text-sm font-sans text-neutral-700 leading-relaxed border-t border-neutral-200">
                        <?php esc_html_e( 'Our concierge desk answers inquiries within 24 business hours (Monday to Saturday, 10:00 AM to 6:00 PM IST). Inquiries submitted on Sundays or national holidays are addressed first thing on the following business morning. For urgent inquiries regarding order dispatch, WhatsApp direct support (+91 8787324795) provides real-time response during operating hours.', 'mazestreetwear' ); ?>
                    </div>
                </details>

                <!-- FAQ 2 -->
                <details class="group border border-black bg-white transition-all open:bg-neutral-50">
                    <summary class="flex items-center justify-between p-5 cursor-pointer font-sans font-bold text-sm sm:text-base uppercase tracking-tight text-black select-none">
                        <span><?php esc_html_e( '02 // Where is my order dispatching from and how do I track it?', 'mazestreetwear' ); ?></span>
                        <span class="w-6 h-6 border border-black flex items-center justify-center font-mono text-sm transition-transform duration-200 group-open:rotate-45">
                            +
                        </span>
                    </summary>
                    <div class="px-5 pb-5 pt-1 text-xs sm:text-sm font-sans text-neutral-700 leading-relaxed border-t border-neutral-200">
                        <?php esc_html_e( 'All MAZE garments are inspected, packaged, and dispatched directly from our central fulfillment facility in Aizawl, Mizoram. Dispatches occur within 24 to 48 hours of payment settlement. Once handed over to our national courier partners (Delhivery, Blue Dart, DTDC, or India Post Speed Post), you will receive an automated dispatch notification with your AWB tracking link via email and WhatsApp.', 'mazestreetwear' ); ?>
                    </div>
                </details>

                <!-- FAQ 3 -->
                <details class="group border border-black bg-white transition-all open:bg-neutral-50">
                    <summary class="flex items-center justify-between p-5 cursor-pointer font-sans font-bold text-sm sm:text-base uppercase tracking-tight text-black select-none">
                        <span><?php esc_html_e( '03 // Can I exchange my garment for another size if it does not fit?', 'mazestreetwear' ); ?></span>
                        <span class="w-6 h-6 border border-black flex items-center justify-center font-mono text-sm transition-transform duration-200 group-open:rotate-45">
                            +
                        </span>
                    </summary>
                    <div class="px-5 pb-5 pt-1 text-xs sm:text-sm font-sans text-neutral-700 leading-relaxed border-t border-neutral-200">
                        <?php esc_html_e( 'Yes. We offer size exchanges within 7 calendar days of courier delivery confirmation. The garment must be completely unworn, unwashed, unaltered, and returned with all original neck tags, care labels, and packaging intact. If your desired replacement size is out of stock in the archive, you will be issued digital store credit vouchers with 1-year validity.', 'mazestreetwear' ); ?>
                    </div>
                </details>

                <!-- FAQ 4 -->
                <details class="group border border-black bg-white transition-all open:bg-neutral-50">
                    <summary class="flex items-center justify-between p-5 cursor-pointer font-sans font-bold text-sm sm:text-base uppercase tracking-tight text-black select-none">
                        <span><?php esc_html_e( '04 // Can I update my delivery address or phone number after placing an order?', 'mazestreetwear' ); ?></span>
                        <span class="w-6 h-6 border border-black flex items-center justify-center font-mono text-sm transition-transform duration-200 group-open:rotate-45">
                            +
                        </span>
                    </summary>
                    <div class="px-5 pb-5 pt-1 text-xs sm:text-sm font-sans text-neutral-700 leading-relaxed border-t border-neutral-200">
                        <?php esc_html_e( 'Address modifications can be accommodated only if requested within 2 hours of placing your order, before our warehouse team generates the courier shipping label. Please message our WhatsApp desk immediately with your Order Number and corrected address details.', 'mazestreetwear' ); ?>
                    </div>
                </details>

                <!-- FAQ 5 -->
                <details class="group border border-black bg-white transition-all open:bg-neutral-50">
                    <summary class="flex items-center justify-between p-5 cursor-pointer font-sans font-bold text-sm sm:text-base uppercase tracking-tight text-black select-none">
                        <span><?php esc_html_e( '05 // What payment methods are authorized on mazestw.in?', 'mazestreetwear' ); ?></span>
                        <span class="w-6 h-6 border border-black flex items-center justify-center font-mono text-sm transition-transform duration-200 group-open:rotate-45">
                            +
                        </span>
                    </summary>
                    <div class="px-5 pb-5 pt-1 text-xs sm:text-sm font-sans text-neutral-700 leading-relaxed border-t border-neutral-200">
                        <?php esc_html_e( 'We accept 100% secure prepaid digital settlements powered by PayU India, including UPI (Google Pay, PhonePe, Paytm, BHIM), major credit & debit cards (Visa, MasterCard, RuPay), and Net Banking across all premier Indian banks. To maintain streamlined dispatch precision, Cash on Delivery (COD) is not offered.', 'mazestreetwear' ); ?>
                    </div>
                </details>

                <!-- FAQ 6 -->
                <details class="group border border-black bg-white transition-all open:bg-neutral-50">
                    <summary class="flex items-center justify-between p-5 cursor-pointer font-sans font-bold text-sm sm:text-base uppercase tracking-tight text-black select-none">
                        <span><?php esc_html_e( '06 // Can I visit the Aizawl design studio in person?', 'mazestreetwear' ); ?></span>
                        <span class="w-6 h-6 border border-black flex items-center justify-center font-mono text-sm transition-transform duration-200 group-open:rotate-45">
                            +
                        </span>
                    </summary>
                    <div class="px-5 pb-5 pt-1 text-xs sm:text-sm font-sans text-neutral-700 leading-relaxed border-t border-neutral-200">
                        <?php esc_html_e( 'Our facility at Bungkawn Vengthar operates primarily as our central design studio, archives vault, and fulfillment warehouse. While we love meeting members of our community, studio visits and editorial pull appointments must be requested at least 48 hours in advance via enquiries@mazestw.in.', 'mazestreetwear' ); ?>
                    </div>
                </details>

            </div>
        </section>

        <!-- Bottom Policy Navigation Bar -->
        <section class="border border-black p-6 sm:p-8 bg-neutral-50 flex flex-col md:flex-row items-center justify-between gap-4 font-mono text-xs no-print">
            <div>
                <span class="font-bold uppercase tracking-wider text-black block mb-0.5">
                    <?php esc_html_e( 'MAZE STOREFRONT POLICIES', 'mazestreetwear' ); ?>
                </span>
                <span class="text-neutral-500">
                    <?php esc_html_e( 'Review our complete operating guidelines, legal standards, and terms.', 'mazestreetwear' ); ?>
                </span>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="<?php echo esc_url( $shipping_url ); ?>" class="px-3 py-1.5 border border-black bg-white hover:bg-black hover:text-white transition-colors uppercase font-bold">
                    <?php esc_html_e( 'Shipping Policy', 'mazestreetwear' ); ?>
                </a>
                <a href="<?php echo esc_url( $refund_url ); ?>" class="px-3 py-1.5 border border-black bg-white hover:bg-black hover:text-white transition-colors uppercase font-bold">
                    <?php esc_html_e( 'Refund & Exchange', 'mazestreetwear' ); ?>
                </a>
                <a href="<?php echo esc_url( $terms_url ); ?>" class="px-3 py-1.5 border border-black bg-white hover:bg-black hover:text-white transition-colors uppercase font-bold">
                    <?php esc_html_e( 'Terms & Conditions', 'mazestreetwear' ); ?>
                </a>
                <a href="<?php echo esc_url( $privacy_url ); ?>" class="px-3 py-1.5 border border-black bg-white hover:bg-black hover:text-white transition-colors uppercase font-bold">
                    <?php esc_html_e( 'Privacy Policy', 'mazestreetwear' ); ?>
                </a>
            </div>
        </section>

    </div>
</main>

<script>
/**
 * Interactive Client-Side Logic for Contact Page:
 * - Live Indian Standard Time (IST) Studio Clock & Operational Indicator
 * - Fast Department Pill Pre-fill Selectors
 * - Dynamic Character Counter
 * - One-click Copy Actions for Email, Phone & Page URL
 * - Asynchronous AJAX Form Submission with graceful fallback
 */
(function() {
    'use strict';

    // 1. Live Studio Clock & Open/Closed Status
    function updateLiveStudioClock() {
        var clockEl = document.getElementById('maze-contact-live-time');
        var beaconEl = document.getElementById('maze-status-beacon');
        var statusEl = document.getElementById('maze-status-text');

        try {
            var now = new Date();
            // Get IST hours, minutes, seconds
            var options = {
                timeZone: 'Asia/Kolkata',
                hour: 'numeric',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            var istString = now.toLocaleTimeString('en-US', options);
            if (clockEl) {
                clockEl.textContent = istString;
            }

            // Check IST day and hour
            // Format hour in 24-hour style for range check
            var istHourStr = now.toLocaleTimeString('en-US', { timeZone: 'Asia/Kolkata', hour: 'numeric', hour12: false });
            var istDayStr = now.toLocaleDateString('en-US', { timeZone: 'Asia/Kolkata', weekday: 'short' });
            var istHour = parseInt(istHourStr, 10);
            var isSunday = (istDayStr === 'Sun');
            var isOpen = (!isSunday && istHour >= 10 && istHour < 18);

            if (beaconEl && statusEl) {
                if (isOpen) {
                    beaconEl.className = 'w-2 h-2 rounded-full bg-emerald-500 animate-pulse';
                    statusEl.textContent = 'STUDIO DESK ACTIVE';
                } else {
                    beaconEl.className = 'w-2 h-2 rounded-full bg-amber-500';
                    statusEl.textContent = 'AFTER HOURS // QUEUED';
                }
            }
        } catch(e) {}
    }
    updateLiveStudioClock();
    setInterval(updateLiveStudioClock, 1000);

    // 2. Department Pill Selector & Message Template Pre-population
    var deptPills = document.querySelectorAll('.maze-dept-pill');
    var deptSelect = document.getElementById('maze-department');
    var subjectInput = document.getElementById('maze_subject');
    var messageTextarea = document.getElementById('maze_message');

    var templates = {
        'General Concierge': '',
        'Order Tracking & Dispatch': 'Hello MAZE Concierge Desk,\n\nI am inquiring about the dispatch status for my order.\nOrder Number: [Your Order #]\nCourier Tracking (if known): \n\nThank you.',
        'Size Exchange & Return': 'Hello MAZE Concierge Desk,\n\nI received my garment and would like to request a size exchange under your 7-day policy.\nOrder Number: [Your Order #]\nGarment Item: \nCurrent Size: \nRequested Replacement Size: \n\nThank you.',
        'Garment Sizing Advice': 'Hello MAZE Studio,\n\nI am seeking sizing and fit advice before placing an order.\nGarment / Collection: \nMy Height / Weight / Usual Size: \nFit Preference (Cropped, Boxy, Oversized): \n\nThank you.',
        'Press & Collaborations': 'Hello MAZE Press & Design Archive,\n\nI am reaching out regarding an editorial feature / styling pull / stockist inquiry.\nPublication / Organization: \nProject Timeline: \nDetails: \n\nThank you.'
    };

    deptPills.forEach(function(pill) {
        pill.addEventListener('click', function() {
            var dept = this.getAttribute('data-dept');
            
            // Highlight pill
            deptPills.forEach(function(p) {
                p.classList.remove('bg-black', 'text-white', 'font-bold');
                p.classList.add('bg-white', 'text-black');
            });
            this.classList.remove('bg-white', 'text-black');
            this.classList.add('bg-black', 'text-white', 'font-bold');

            // Set dropdown
            if (deptSelect) {
                deptSelect.value = dept;
            }

            // If message is empty or starts with a template, apply preset template
            if (messageTextarea && templates[dept]) {
                if (!messageTextarea.value || messageTextarea.value.indexOf('Hello MAZE') === 0) {
                    messageTextarea.value = templates[dept];
                    triggerCharCount();
                }
            }

            // Set suggestive subject
            if (subjectInput && !subjectInput.value) {
                subjectInput.value = dept + ' Inquiry';
            }
        });
    });

    if (deptSelect) {
        deptSelect.addEventListener('change', function() {
            var selectedVal = this.value;
            deptPills.forEach(function(p) {
                if (p.getAttribute('data-dept') === selectedVal) {
                    p.classList.remove('bg-white', 'text-black');
                    p.classList.add('bg-black', 'text-white', 'font-bold');
                } else {
                    p.classList.remove('bg-black', 'text-white', 'font-bold');
                    p.classList.add('bg-white', 'text-black');
                }
            });
        });
    }

    // 3. Live Character Counter
    function triggerCharCount() {
        var counter = document.getElementById('maze_char_counter');
        if (counter && messageTextarea) {
            counter.textContent = messageTextarea.value.length + ' / 2000';
        }
    }
    if (messageTextarea) {
        messageTextarea.addEventListener('input', triggerCharCount);
    }

    // 4. One-Click Copy Buttons (Email, Phone, Share Link)
    function setupCopyButton(btnId, textElId, valueToCopy, originalText) {
        var btn = document.getElementById(btnId);
        var textEl = document.getElementById(textElId);
        if (!btn || !textEl) return;

        btn.addEventListener('click', function(e) {
            e.preventDefault();
            navigator.clipboard.writeText(valueToCopy).then(function() {
                var prev = textEl.textContent;
                textEl.textContent = 'COPIED ✓';
                setTimeout(function() {
                    textEl.textContent = originalText || prev;
                }, 2000);
            }).catch(function() {
                // Fallback for older browsers
                var ta = document.createElement('textarea');
                ta.value = valueToCopy;
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
                textEl.textContent = 'COPIED ✓';
                setTimeout(function() {
                    textEl.textContent = originalText || 'COPY';
                }, 2000);
            });
        });
    }

    setupCopyButton('maze-copy-email-btn', 'maze-copy-email-text', 'enquiries@mazestw.in', 'COPY');
    setupCopyButton('maze-copy-phone-btn', 'maze-copy-phone-text', '+918787324795', 'COPY');
    setupCopyButton('maze-copy-contact-url-btn', 'maze-copy-contact-url-text', window.location.href, 'SHARE LINK');

    // 5. Asynchronous AJAX Transmission Handler
    var contactForm = document.getElementById('maze-contact-form');
    var feedbackBox = document.getElementById('maze-form-feedback');
    var submitBtn = document.getElementById('maze_submit_btn');
    var submitText = document.getElementById('maze_submit_text');
    var ajaxEndpoint = (typeof mazeData !== 'undefined' && mazeData.ajaxUrl) ? mazeData.ajaxUrl : '<?php echo esc_url( $ajax_url ); ?>';

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            // Check HTML5 validity
            if (!contactForm.checkValidity()) {
                return;
            }

            e.preventDefault();

            // Loading state
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            }
            if (submitText) {
                submitText.textContent = 'TRANSMITTING INQUIRY...';
            }

            var formData = new FormData(contactForm);

            fetch(ajaxEndpoint, {
                method: 'POST',
                body: formData
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                if (data.success) {
                    if (feedbackBox) {
                        feedbackBox.className = 'mb-6 p-4 border border-emerald-500 bg-emerald-50 text-emerald-950 font-mono text-xs leading-relaxed';
                        feedbackBox.innerHTML = '<strong class="block uppercase font-bold text-emerald-900 mb-1">✓ ' + (data.data.name ? 'Thank you, ' + data.data.name + '!' : 'TRANSMISSION CONFIRMED') + '</strong>' + data.data.message;
                        feedbackBox.classList.remove('hidden');
                        feedbackBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    contactForm.reset();
                    triggerCharCount();
                } else {
                    if (feedbackBox) {
                        feedbackBox.className = 'mb-6 p-4 border border-rose-500 bg-rose-50 text-rose-950 font-mono text-xs leading-relaxed';
                        feedbackBox.innerHTML = '<strong class="block uppercase font-bold text-rose-900 mb-1">⚠ TRANSMISSION ERROR</strong>' + (data.data && data.data.message ? data.data.message : 'Unable to log inquiry. Please email us directly at enquiries@mazestw.in.');
                        feedbackBox.classList.remove('hidden');
                    }
                }
            })
            .catch(function(err) {
                // If network/AJAX fails, fallback to normal POST
                contactForm.submit();
            })
            .finally(function() {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                }
                if (submitText) {
                    submitText.textContent = 'TRANSMIT INQUIRY // [ SEND MESSAGE ]';
                }
            });
        });
    }

})();
</script>

<?php
get_footer();
