<?php
/**
 * Template Name: Homepage Minimalist
 *
 * Brutalist Minimalist Streetwear Homepage for Maze (mazestw.in).
 * Pure white background, bold black headlines, black marquee ticker,
 * stark white product cards with sharp black borders, and solid black CTA buttons.
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
?>

<main id="primary" class="site-main bg-white text-black min-h-screen">

    <!-- 1. Hero Section: Editorial Brutalist Streetwear -->
    <section class="relative border-b border-black pt-12 pb-16 sm:pt-20 sm:pb-24 overflow-hidden bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">

                <!-- Left Column: Big Brutalist Headlines & Direct CTAs -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center space-x-2.5 text-xs font-mono font-bold tracking-widest uppercase border border-black px-3 py-1 bg-white">
                        <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                        <span><?php esc_html_e( 'STRICT MONOCHROME SPECIFICATION // SS26', 'mazestreetwear' ); ?></span>
                    </div>

                    <h1 class="text-4xl sm:text-6xl md:text-7xl font-black font-sans uppercase tracking-tighter leading-[0.95] text-black">
                        MAZE ARCHIVE<br>
                        <span class="underline decoration-black decoration-4 underline-offset-8">// 2026</span>
                    </h1>

                    <p class="text-sm sm:text-base font-mono text-neutral-600 max-w-xl leading-relaxed">
                        <?php esc_html_e( 'Engineered minimalist streetwear crafted with archival precision. Zero neon distractions. Pure pitch black on crisp white canvas, cut from bespoke 450GSM heavyweight cotton.', 'mazestreetwear' ); ?>
                    </p>

                    <!-- High-Impact CTA Buttons -->
                    <div class="pt-4 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                        <a href="<?php echo esc_url( $shop_url ); ?>" class="inline-flex items-center justify-center bg-black hover:bg-neutral-800 text-white font-mono font-bold text-xs uppercase tracking-widest px-8 py-4 border border-black transition-colors duration-150">
                            <span><?php esc_html_e( 'SHOP THE COLLECTION', 'mazestreetwear' ); ?></span>
                            <span class="ml-2">&rarr;</span>
                        </a>

                        <a href="<?php echo esc_url( home_url( '/archive/' ) ); ?>" class="inline-flex items-center justify-center bg-white hover:bg-black hover:text-white text-black font-mono font-bold text-xs uppercase tracking-widest px-8 py-4 border border-black transition-all duration-150">
                            <span><?php esc_html_e( 'VIEW ARCHIVE SPEC', 'mazestreetwear' ); ?></span>
                            <span class="ml-2">&nearr;</span>
                        </a>
                    </div>

                    <!-- Spec Badges -->
                    <div class="pt-6 border-t border-neutral-200 grid grid-cols-3 gap-4 text-[11px] font-mono font-bold uppercase tracking-wider text-neutral-500">
                        <div>
                            <span class="block text-black">[ 01 ] 450GSM</span>
                            <span>HEAVY FLEECE</span>
                        </div>
                        <div>
                            <span class="block text-black">[ 02 ] BOXY CUT</span>
                            <span>ARCHIVAL FIT</span>
                        </div>
                        <div>
                            <span class="block text-black">[ 03 ] ZERO DYES</span>
                            <span>MONOCHROME</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Editorial Lookbook Minimal Frame -->
                <div class="lg:col-span-5">
                    <div class="border border-black p-3 bg-white shadow-[8px_8px_0px_0px_#000000]">
                        <div class="relative aspect-[4/5] bg-neutral-100 border border-black overflow-hidden flex flex-col justify-between p-6">
                            <div class="flex items-center justify-between text-xs font-mono font-bold tracking-widest uppercase">
                                <span class="bg-black text-white px-2 py-0.5"><?php esc_html_e( 'LOOK 01', 'mazestreetwear' ); ?></span>
                                <span class="text-neutral-500"><?php esc_html_e( 'PARIS / TOKYO', 'mazestreetwear' ); ?></span>
                            </div>

                            <div class="text-center my-auto py-12 space-y-3">
                                <div class="text-6xl sm:text-7xl font-black font-sans tracking-tighter text-black select-none">
                                    MAZE.
                                </div>
                                <div class="text-[11px] font-mono tracking-widest text-neutral-500 uppercase">
                                    // 100% UNCOMPROMISED ARCHIVAL FABRIC
                                </div>
                            </div>

                            <div class="border-t border-black pt-3 flex items-center justify-between text-[11px] font-mono font-bold tracking-widest uppercase text-neutral-600">
                                <span>REF: MZ-SS26-001</span>
                                <span class="text-black underline underline-offset-2"><?php esc_html_e( 'MAZESTW.IN', 'mazestreetwear' ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 2. Black Marquee Ticker: Continuous Minimalist Brutalist Stream -->
    <div class="w-full bg-black text-white py-3.5 border-b border-black overflow-hidden whitespace-nowrap select-none" aria-hidden="true">
        <div class="animate-marquee flex items-center space-x-8 text-xs font-mono font-bold tracking-widest uppercase">
            <span>MAZE ARCHIVE // 2026</span>
            <span class="text-neutral-500">&bull;</span>
            <span>STRICT HIGH-CONTRAST MONOCHROME</span>
            <span class="text-neutral-500">&bull;</span>
            <span>450GSM CUSTOM WEIGHT COTTON</span>
            <span class="text-neutral-500">&bull;</span>
            <span>BOXY PROPORTIONS &amp; RAW EDGES</span>
            <span class="text-neutral-500">&bull;</span>
            <span>NO RESTOCKS &amp; STRICT ARCHIVAL SPEC</span>
            <span class="text-neutral-500">&bull;</span>
            <span>DISPATCH WORLDWIDE VIA MAZESTW.IN</span>
            <span class="text-neutral-500">&bull;</span>
            <span>MAZE ARCHIVE // 2026</span>
            <span class="text-neutral-500">&bull;</span>
            <span>STRICT HIGH-CONTRAST MONOCHROME</span>
            <span class="text-neutral-500">&bull;</span>
            <span>450GSM CUSTOM WEIGHT COTTON</span>
            <span class="text-neutral-500">&bull;</span>
            <span>BOXY PROPORTIONS &amp; RAW EDGES</span>
            <span class="text-neutral-500">&bull;</span>
            <span>NO RESTOCKS &amp; STRICT ARCHIVAL SPEC</span>
            <span class="text-neutral-500">&bull;</span>
            <span>DISPATCH WORLDWIDE VIA MAZESTW.IN</span>
            <span class="text-neutral-500">&bull;</span>
        </div>
    </div>

    <!-- 3. Featured Archival Products Grid: Stark White Cards with Sharp Black Borders -->
    <section class="py-16 sm:py-24 bg-white border-b border-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-8 mb-12 border-b border-black">
                <div>
                    <div class="text-xs font-mono font-bold tracking-widest text-neutral-500 uppercase mb-1">
                        [ 01 // SELECTED ARCHIVE ]
                    </div>
                    <h2 class="text-3xl sm:text-5xl font-black font-sans uppercase tracking-tight text-black">
                        FEATURED DROPS
                    </h2>
                </div>

                <a href="<?php echo esc_url( $shop_url ); ?>" class="text-xs font-mono font-bold uppercase tracking-widest text-black hover:text-neutral-500 inline-flex items-center space-x-1.5 transition-colors">
                    <span>[ <?php esc_html_e( 'VIEW COMPLETE CATALOG', 'mazestreetwear' ); ?> ]</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                $has_wc_products = false;

                if ( class_exists( 'WooCommerce' ) ) {
                    $args = array(
                        'post_type'      => 'product',
                        'posts_per_page' => 4,
                        'post_status'    => 'publish',
                    );
                    $products_query = new WP_Query( $args );

                    if ( $products_query->have_posts() ) {
                        $has_wc_products = true;
                        while ( $products_query->have_posts() ) {
                            $products_query->the_post();
                            global $product;
                            ?>
                            <article <?php wc_product_class( 'maze-product-card group flex flex-col relative bg-white border border-black hover:shadow-[4px_4px_0px_0px_#000000] transition-all duration-200', $product ); ?>>
                                <div class="relative w-full aspect-[3/4] bg-neutral-100 overflow-hidden border-b border-black">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'woocommerce_thumbnail', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300' ) ); ?>
                                    <?php else : ?>
                                        <div class="w-full h-full flex items-center justify-center text-xs font-mono font-bold uppercase text-neutral-400">
                                            [ <?php esc_html_e( 'NO IMAGE', 'mazestreetwear' ); ?> ]
                                        </div>
                                    <?php endif; ?>

                                    <div class="absolute top-3 left-3">
                                        <span class="text-[10px] font-mono font-bold tracking-widest uppercase bg-black text-white px-2 py-0.5 border border-black">
                                            <?php echo $product->is_in_stock() ? esc_html__( 'IN STOCK', 'mazestreetwear' ) : esc_html__( 'SOLD OUT', 'mazestreetwear' ); ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="p-4 flex-grow flex flex-col justify-between">
                                    <div>
                                        <div class="text-[10px] font-mono font-bold tracking-widest uppercase text-neutral-500 mb-1">
                                            <?php
                                            $terms = get_the_terms( $product->get_id(), 'product_cat' );
                                            echo ( $terms && ! is_wp_error( $terms ) ) ? esc_html( $terms[0]->name ) : 'APPAREL';
                                            ?>
                                        </div>
                                        <h3 class="text-sm font-sans font-bold uppercase tracking-tight text-black group-hover:text-neutral-600 transition-colors line-clamp-1">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                    </div>

                                    <div class="mt-3 pt-3 border-t border-neutral-200 flex items-center justify-between text-xs font-mono font-bold text-black">
                                        <span><?php echo $product->get_price_html(); ?></span>
                                    </div>
                                </div>

                                <div class="px-4 pb-4">
                                    <a href="<?php the_permalink(); ?>" class="w-full inline-flex items-center justify-center bg-black hover:bg-neutral-800 text-white font-mono font-bold text-xs uppercase tracking-widest py-3 px-4 border border-black transition-colors duration-150">
                                        <span><?php esc_html_e( 'VIEW GARMENT', 'mazestreetwear' ); ?></span>
                                        <span class="ml-1.5">&rarr;</span>
                                    </a>
                                </div>
                            </article>
                            <?php
                        }
                        wp_reset_postdata();
                    }
                }

                // Fallback Curated Demo Cards if no WooCommerce products are populated yet
                if ( ! $has_wc_products ) :
                    $demo_products = array(
                        array(
                            'title' => 'HEAVYWEIGHT OVERSIZED HOODIE 01',
                            'cat'   => 'HOODIES // 450GSM',
                            'price' => '₹4,499.00',
                            'badge' => 'ARCHIVE SS26',
                        ),
                        array(
                            'title' => 'BOXY MINIMALIST TEE 02',
                            'cat'   => 'TEES // 280GSM',
                            'price' => '₹2,299.00',
                            'badge' => 'NEW DROP',
                        ),
                        array(
                            'title' => 'RAW-HEM TACTICAL CREWNECK',
                            'cat'   => 'FLEECE // 400GSM',
                            'price' => '₹3,899.00',
                            'badge' => 'LIMITED DROP',
                        ),
                        array(
                            'title' => 'ENGINEERED RELAXED PANT',
                            'cat'   => 'PANTS // TWILL',
                            'price' => '₹4,999.00',
                            'badge' => 'RESTOCK',
                        ),
                    );

                    foreach ( $demo_products as $dp ) :
                    ?>
                        <article class="maze-product-card group flex flex-col relative bg-white border border-black hover:shadow-[4px_4px_0px_0px_#000000] transition-all duration-200">
                            <div class="relative w-full aspect-[3/4] bg-neutral-100 overflow-hidden border-b border-black flex flex-col items-center justify-center p-6 text-center">
                                <span class="text-4xl font-black font-sans tracking-tighter text-neutral-300 group-hover:text-black transition-colors">
                                    MAZE.
                                </span>
                                <span class="text-[10px] font-mono font-bold tracking-widest uppercase text-neutral-400 mt-2">
                                    [ ARCHIVAL SAMPLE ]
                                </span>

                                <div class="absolute top-3 left-3">
                                    <span class="text-[10px] font-mono font-bold tracking-widest uppercase bg-black text-white px-2 py-0.5 border border-black">
                                        <?php echo esc_html( $dp['badge'] ); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="p-4 flex-grow flex flex-col justify-between">
                                <div>
                                    <div class="text-[10px] font-mono font-bold tracking-widest uppercase text-neutral-500 mb-1">
                                        <?php echo esc_html( $dp['cat'] ); ?>
                                    </div>
                                    <h3 class="text-sm font-sans font-bold uppercase tracking-tight text-black group-hover:text-neutral-600 transition-colors">
                                        <a href="<?php echo esc_url( $shop_url ); ?>"><?php echo esc_html( $dp['title'] ); ?></a>
                                    </h3>
                                </div>

                                <div class="mt-3 pt-3 border-t border-neutral-200 flex items-center justify-between text-xs font-mono font-bold text-black">
                                    <span><?php echo esc_html( $dp['price'] ); ?></span>
                                </div>
                            </div>

                            <div class="px-4 pb-4">
                                <a href="<?php echo esc_url( $shop_url ); ?>" class="w-full inline-flex items-center justify-center bg-black hover:bg-neutral-800 text-white font-mono font-bold text-xs uppercase tracking-widest py-3 px-4 border border-black transition-colors duration-150">
                                    <span><?php esc_html_e( 'VIEW GARMENT', 'mazestreetwear' ); ?></span>
                                    <span class="ml-1.5">&rarr;</span>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </section>

    <!-- 4. Editorial Manifesto / Brand Architecture (Margiela / Helmut Lang Inspiration) -->
    <section class="py-16 sm:py-24 bg-white border-b border-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="border border-black p-6 sm:p-8 bg-white space-y-4 hover:shadow-[4px_4px_0px_0px_#000000] transition-all duration-200">
                    <div class="text-xs font-mono font-bold tracking-widest text-neutral-500 uppercase">
                        [ SPEC // 01 ]
                    </div>
                    <h3 class="text-xl font-black font-sans uppercase tracking-tight text-black">
                        450GSM HEAVY FLEECE
                    </h3>
                    <p class="text-xs font-mono text-neutral-600 leading-relaxed">
                        Custom milled high-density French terry and loopback cotton. Pre-shrunk, heavyweight drape, built to endure years of wear without deformation.
                    </p>
                </div>

                <div class="border border-black p-6 sm:p-8 bg-white space-y-4 hover:shadow-[4px_4px_0px_0px_#000000] transition-all duration-200">
                    <div class="text-xs font-mono font-bold tracking-widest text-neutral-500 uppercase">
                        [ SPEC // 02 ]
                    </div>
                    <h3 class="text-xl font-black font-sans uppercase tracking-tight text-black">
                        BOXY ARCHIVAL CUT
                    </h3>
                    <p class="text-xs font-mono text-neutral-600 leading-relaxed">
                        Dropped shoulder geometry paired with structured sleeve length and a balanced torso crop. Brutalist silhouettes tailored for modern streetwear aesthetic.
                    </p>
                </div>

                <div class="border border-black p-6 sm:p-8 bg-white space-y-4 hover:shadow-[4px_4px_0px_0px_#000000] transition-all duration-200">
                    <div class="text-xs font-mono font-bold tracking-widest text-neutral-500 uppercase">
                        [ SPEC // 03 ]
                    </div>
                    <h3 class="text-xl font-black font-sans uppercase tracking-tight text-black">
                        PURE MONOCHROME
                    </h3>
                    <p class="text-xs font-mono text-neutral-600 leading-relaxed">
                        Total rejection of transient neon accents and gimmicks. Pitch black carbon graphics set against stark optic white base layers.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- 5. Big Editorial Statement & Final Action -->
    <section class="py-20 sm:py-28 bg-white text-center">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="inline-flex items-center space-x-2 text-xs font-mono font-bold tracking-widest uppercase border border-black px-3 py-1">
                <span>MAZE ARCHIVE SYSTEM // MAZESTW.IN</span>
            </div>

            <h2 class="text-3xl sm:text-5xl md:text-6xl font-black font-sans uppercase tracking-tighter text-black leading-tight">
                ENGINEERED FOR THE UNDERGROUND.<br>
                LIMITED RUNS ONLY.
            </h2>

            <div class="pt-2">
                <a href="<?php echo esc_url( $shop_url ); ?>" class="inline-flex items-center justify-center bg-black hover:bg-neutral-800 text-white font-mono font-bold text-xs uppercase tracking-widest px-10 py-5 border border-black transition-colors duration-150">
                    <span><?php esc_html_e( 'ENTER FULL SHOP', 'mazestreetwear' ); ?></span>
                    <span class="ml-2.5">&rarr;</span>
                </a>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
