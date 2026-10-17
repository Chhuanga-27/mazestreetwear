<?php
/**
 * Template Name: Homepage Minimalist
 *
 * Stark Luxury Minimalist Editorial Homepage for Maze (mazestw.in).
 * Features:
 * - Full-width hero banner with centered CTA button
 * - Architectural connected hairline product grid (4 columns)
 * - Section header: READY-TO-WEAR & see more →
 * - Pure white canvas, pitch black typography, crisp 1px borders, zero radius, zero clutter.
 *
 * @package MazeStreetwear
 * @version 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
?>

<main id="primary" class="site-main bg-[#FEFEF3] text-black min-h-screen">

    <!-- 1. Editorial Bento Box Hero Banner (Contained, Rounded Corners, HD) -->
    <section class="w-full bg-[#FEFEF3] pt-2 sm:pt-2.5 md:pt-3 pb-8 sm:pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="maze-hero-bento relative w-full aspect-[4/3] sm:aspect-[16/10] rounded-2xl sm:rounded-3xl lg:rounded-[32px] border border-black overflow-hidden bg-[#e8e8e8] shadow-sm group">
                <img 
                    src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero.jpg' ); ?>" 
                    alt="<?php esc_attr_e( 'MAZE Editorial SS26', 'mazestreetwear' ); ?>" 
                    width="5765"
                    height="3614"
                    loading="eager"
                    fetchpriority="high"
                    decoding="async"
                    class="w-full h-full object-cover object-[48%_center] sm:object-center select-none transition-transform duration-700 ease-out group-hover:scale-[1.01]"
                />

                <!-- Centered CTA Button with Radius on Each Corner -->
                <div class="absolute left-1/2 -translate-x-1/2 bottom-4 sm:bottom-8 md:bottom-12 z-10">
                    <a href="<?php echo esc_url( $shop_url ); ?>" class="maze-hero-cta inline-block border border-black bg-[#FEFEF3] text-black hover:bg-black hover:text-white transition-all px-6 sm:px-10 py-2.5 sm:py-3.5 text-base sm:text-lg md:text-xl uppercase tracking-wider font-normal font-bebas text-center shadow-sm rounded-lg sm:rounded-2xl hover:shadow-md">
                        <?php esc_html_e( 'SHOP ALL', 'mazestreetwear' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php
    // Editorial Showcase Garments (Dynamic WooCommerce integration with pristine high-res defaults)
    $showcase_item_1 = array(
        'title'     => 'PUFFER GILET',
        'price'     => 'INR 1999',
        'image'     => get_template_directory_uri() . '/assets/images/product-puffer-gilet.jpg',
        'permalink' => $shop_url,
    );

    $showcase_item_2 = array(
        'title'     => 'ARCHIVE HOODIE',
        'price'     => 'INR 2499',
        'image'     => get_template_directory_uri() . '/assets/images/product-archive-hoodie.jpg',
        'permalink' => $shop_url,
    );

    if ( class_exists( 'WooCommerce' ) ) {
        // Look for puffer-gilet first or query latest published garments
        $puffer_post = get_page_by_path( 'puffer-gilet', OBJECT, 'product' );
        if ( ! $puffer_post ) {
            $puffer_q = new WP_Query( array(
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'posts_per_page' => 1,
                's'              => 'Puffer Gilet',
            ) );
            if ( $puffer_q->have_posts() ) {
                $puffer_q->the_post();
                $puffer_post = get_post();
                wp_reset_postdata();
            }
        }

        if ( $puffer_post ) {
            $wc_p1 = wc_get_product( $puffer_post->ID );
            if ( $wc_p1 ) {
                $showcase_item_1['title']     = $wc_p1->get_name();
                $showcase_item_1['price']     = $wc_p1->get_price_html();
                $showcase_item_1['permalink'] = $wc_p1->get_permalink();
                if ( has_post_thumbnail( $puffer_post->ID ) ) {
                    $showcase_item_1['image'] = get_the_post_thumbnail_url( $puffer_post->ID, 'full' );
                }
            }
        } else {
            // Use 1st published WooCommerce product if available
            $first_q = new WP_Query( array(
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'posts_per_page' => 1,
            ) );
            if ( $first_q->have_posts() ) {
                $first_q->the_post();
                $wc_first = wc_get_product( get_the_ID() );
                if ( $wc_first ) {
                    $showcase_item_1['title']     = $wc_first->get_name();
                    $showcase_item_1['price']     = $wc_first->get_price_html();
                    $showcase_item_1['permalink'] = $wc_first->get_permalink();
                    if ( has_post_thumbnail( get_the_ID() ) ) {
                        $showcase_item_1['image'] = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    }
                }
                wp_reset_postdata();
            }
        }

        // 2nd showcase product
        $second_q = new WP_Query( array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'offset'         => 1,
        ) );
        if ( $second_q->have_posts() ) {
            $second_q->the_post();
            $wc_sec = wc_get_product( get_the_ID() );
            if ( $wc_sec ) {
                $showcase_item_2['title']     = $wc_sec->get_name();
                $showcase_item_2['price']     = $wc_sec->get_price_html();
                $showcase_item_2['permalink'] = $wc_sec->get_permalink();
                if ( has_post_thumbnail( get_the_ID() ) ) {
                    $showcase_item_2['image'] = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                }
            }
            wp_reset_postdata();
        }
    }
    ?>

    <!-- 2. Featured Editorial Showcase - Product 1 (Product Image on Left, Title & Price on Right) -->
    <section class="maze-showcase-section w-full bg-[#FEFEF3] border-b border-black">
        <div class="max-w-7xl mx-auto border-x border-t border-black">
            <a href="<?php echo esc_url( $showcase_item_1['permalink'] ); ?>" class="maze-showcase-card group grid grid-cols-2 bg-[#FEFEF3] overflow-hidden focus:outline-none" aria-label="<?php echo esc_attr( $showcase_item_1['title'] ); ?>">
                <!-- Left: Product Image -->
                <div class="maze-showcase-media relative w-full aspect-[4/5] bg-[#eae7e1] overflow-hidden">
                    <img 
                        src="<?php echo esc_url( $showcase_item_1['image'] ); ?>" 
                        alt="<?php echo esc_attr( $showcase_item_1['title'] ); ?>" 
                        loading="lazy"
                        decoding="async"
                        class="w-full h-full object-cover object-center select-none transition-transform duration-700 ease-out group-hover:scale-105"
                    />
                </div>

                <!-- Right: Product Information -->
                <div class="maze-showcase-info flex flex-col justify-center px-4 sm:px-8 md:px-12 lg:px-20 py-6 sm:py-10 bg-[#FEFEF3] select-none">
                    <h2 class="maze-showcase-title text-xl sm:text-3xl md:text-4xl lg:text-5xl font-normal font-bebas uppercase tracking-wide text-black group-hover:opacity-60 transition-opacity">
                        <?php echo esc_html( $showcase_item_1['title'] ); ?>
                    </h2>
                    <div class="maze-showcase-price text-sm sm:text-lg md:text-xl lg:text-2xl font-bold font-outfit uppercase tracking-normal text-black mt-1.5 sm:mt-3 md:mt-4">
                        <?php echo wp_kses_post( $showcase_item_1['price'] ); ?>
                    </div>
                </div>
            </a>
        </div>
    </section>

    <!-- 3. Featured Editorial Showcase - Product 2 (Title & Price on Left, Product Image on Right) -->
    <section class="maze-showcase-section w-full bg-[#FEFEF3] border-b border-black">
        <div class="max-w-7xl mx-auto border-x border-black">
            <a href="<?php echo esc_url( $showcase_item_2['permalink'] ); ?>" class="maze-showcase-card group grid grid-cols-2 bg-[#FEFEF3] overflow-hidden focus:outline-none" aria-label="<?php echo esc_attr( $showcase_item_2['title'] ); ?>">
                <!-- Left: Product Information -->
                <div class="maze-showcase-info flex flex-col justify-center px-4 sm:px-8 md:px-12 lg:px-20 py-6 sm:py-10 bg-[#FEFEF3] select-none">
                    <h2 class="maze-showcase-title text-xl sm:text-3xl md:text-4xl lg:text-5xl font-normal font-bebas uppercase tracking-wide text-black group-hover:opacity-60 transition-opacity">
                        <?php echo esc_html( $showcase_item_2['title'] ); ?>
                    </h2>
                    <div class="maze-showcase-price text-sm sm:text-lg md:text-xl lg:text-2xl font-bold font-outfit uppercase tracking-normal text-black mt-1.5 sm:mt-3 md:mt-4">
                        <?php echo wp_kses_post( $showcase_item_2['price'] ); ?>
                    </div>
                </div>

                <!-- Right: Product Image -->
                <div class="maze-showcase-media relative w-full aspect-[4/5] bg-[#eae7e1] overflow-hidden">
                    <img 
                        src="<?php echo esc_url( $showcase_item_2['image'] ); ?>" 
                        alt="<?php echo esc_attr( $showcase_item_2['title'] ); ?>" 
                        loading="lazy"
                        decoding="async"
                        class="w-full h-full object-cover object-center select-none transition-transform duration-700 ease-out group-hover:scale-105"
                    />
                </div>
            </a>
        </div>
    </section>

    <!-- 4. Architectural Product Card Grid -->
    <section class="w-full bg-[#FEFEF3] border-b border-black">
        
        <!-- Section Header -->
        <div class="max-w-7xl mx-auto border-x border-black">
            <div class="px-4 sm:px-6 lg:px-8 py-5 sm:py-6 border-b border-black flex items-center justify-between bg-[#FEFEF3]">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-normal font-bebas uppercase tracking-wider text-black">
                    <?php esc_html_e( 'READY-TO-WEAR', 'mazestreetwear' ); ?>
                </h2>

                <a href="<?php echo esc_url( $shop_url ); ?>" class="text-sm sm:text-base font-semibold font-outfit text-black hover:underline underline-offset-4 transition-all">
                    <?php esc_html_e( 'see more →', 'mazestreetwear' ); ?>
                </a>
            </div>

            <!-- Connected Hairline Border Grid: 4 columns on desktop -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 bg-[#FEFEF3] overflow-hidden">
                <?php
                $has_wc_products = false;

                if ( class_exists( 'WooCommerce' ) ) {
                    $featured_query = new WP_Query( array(
                        'post_type'      => 'product',
                        'posts_per_page' => 8,
                        'post_status'    => 'publish',
                    ) );

                    if ( $featured_query->have_posts() ) {
                        $has_wc_products = true;
                        while ( $featured_query->have_posts() ) {
                            $featured_query->the_post();
                            wc_get_template_part( 'content', 'product' );
                        }
                        wp_reset_postdata();
                    }
                }

                // Curated Fallback Demo Products matching exact reference architectural design
                if ( ! $has_wc_products ) :
                    $demo_items = array(
                        array(
                            'title' => 'twisted kleid',
                            'price' => '₹ 1,499',
                            'svg'   => 'dress',
                        ),
                        array(
                            'title' => 'boxy fleece crewneck',
                            'price' => '₹ 3,499',
                            'svg'   => 'crewneck',
                        ),
                        array(
                            'title' => 'raw-cut oversized tee',
                            'price' => '₹ 1,899',
                            'svg'   => 'tee',
                        ),
                        array(
                            'title' => 'structured wide pant',
                            'price' => '₹ 4,299',
                            'svg'   => 'pant',
                        ),
                        array(
                            'title' => 'heavyweight archive hoodie',
                            'price' => '₹ 4,999',
                            'svg'   => 'hoodie',
                        ),
                        array(
                            'title' => 'minimalist zip blouson',
                            'price' => '₹ 5,899',
                            'svg'   => 'jacket',
                        ),
                        array(
                            'title' => 'draped tactical overcoat',
                            'price' => '₹ 7,499',
                            'svg'   => 'coat',
                        ),
                        array(
                            'title' => 'relaxed cargo trouser',
                            'price' => '₹ 4,599',
                            'svg'   => 'cargo',
                        ),
                    );

                    foreach ( $demo_items as $item ) :
                        ?>
                        <article class="maze-product-card bg-[#FEFEF3] border border-black -ml-px -mt-px relative group flex flex-col justify-between rounded-none">
                            <a href="<?php echo esc_url( $shop_url ); ?>" class="flex flex-col h-full w-full group focus:outline-none">
                                <!-- Image Area: Tall aspect ratio (aspect-[3/4]) with generous padding and clean cutout -->
                                <div class="relative w-full aspect-[3/4] bg-[#FEFEF3] p-6 sm:p-8 flex items-center justify-center overflow-hidden">
                                    <div class="w-full h-full flex flex-col items-center justify-center transition-transform duration-300 group-hover:scale-105">
                                        <svg class="w-28 h-36 text-black stroke-[1.2] fill-none stroke-current opacity-90 group-hover:opacity-100 transition-opacity" viewBox="0 0 100 130">
                                            <?php if ( $item['svg'] === 'dress' ) : ?>
                                                <!-- Minimalist Dress Cutout Silhouette -->
                                                <path d="M35 15 L45 25 L55 25 L65 15 L72 32 L60 38 L65 115 L35 115 L40 38 L28 32 Z" />
                                                <path d="M45 25 Q50 32 55 25" />
                                                <path d="M40 70 Q50 78 60 70" stroke-dasharray="2 2" />
                                            <?php elseif ( $item['svg'] === 'crewneck' || $item['svg'] === 'hoodie' ) : ?>
                                                <!-- Minimalist Sweatshirt Cutout Silhouette -->
                                                <path d="M32 20 L44 26 L56 26 L68 20 L86 42 L74 50 L68 40 L68 110 L32 110 L32 40 L26 50 L14 42 Z" />
                                                <path d="M44 26 Q50 32 56 26" />
                                                <line x1="32" y1="104" x2="68" y2="104" />
                                            <?php elseif ( $item['svg'] === 'pant' || $item['svg'] === 'cargo' ) : ?>
                                                <!-- Minimalist Trouser Cutout Silhouette -->
                                                <path d="M28 20 L72 20 L75 115 L53 115 L50 55 L47 115 L25 115 Z" />
                                                <line x1="28" y1="26" x2="72" y2="26" />
                                            <?php else : ?>
                                                <!-- Minimalist Boxy Tee Silhouette -->
                                                <path d="M30 20 L43 25 L57 25 L70 20 L88 38 L76 48 L68 42 L68 112 L32 112 L32 42 L24 48 L12 38 Z" />
                                                <path d="M43 25 Q50 30 57 25" />
                                            <?php endif; ?>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Bottom Metadata Bar: thin top black border, title lowercase on left, price on right -->
                                <div class="border-t border-black px-4 py-3 flex justify-between items-baseline text-sm sm:text-base font-sans bg-[#FEFEF3] mt-auto">
                                    <span class="text-black font-semibold lowercase tracking-tight line-clamp-1 mr-2 group-hover:opacity-60 transition-opacity">
                                        <?php echo esc_html( $item['title'] ); ?>
                                    </span>
                                    <span class="text-black font-bold whitespace-nowrap font-sans text-right">
                                        <?php echo esc_html( $item['price'] ); ?>
                                    </span>
                                </div>
                            </a>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- 3. Minimalist Architectural Statement -->
    <section class="w-full bg-[#FEFEF3] py-16 sm:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <span class="inline-block text-xs sm:text-sm font-outfit uppercase tracking-wider font-semibold text-neutral-800">
                <?php esc_html_e( 'MAZE ARCHIVE SPECIFICATION // 2026', 'mazestreetwear' ); ?>
            </span>
            <p class="text-xl sm:text-2xl lg:text-3xl font-outfit font-normal tracking-tight text-black leading-relaxed max-w-3xl mx-auto">
                <?php esc_html_e( 'Architectural garments engineered with uncompromising precision. Pure pitch black on optic white canvas, stripped of all transient distraction.', 'mazestreetwear' ); ?>
            </p>
            <div class="pt-4">
                <a href="<?php echo esc_url( $shop_url ); ?>" class="inline-block border border-black bg-[#FEFEF3] text-black hover:bg-black hover:text-white transition-all px-9 py-3.5 text-base sm:text-lg font-normal uppercase tracking-wider font-bebas shadow-sm">
                    <?php esc_html_e( 'EXPLORE CATALOG', 'mazestreetwear' ); ?>
                </a>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
