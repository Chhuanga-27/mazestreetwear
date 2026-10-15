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

<main id="primary" class="site-main bg-white text-black min-h-screen">

    <!-- 1. Editorial Bento Box Hero Banner (Contained, Rounded Corners, HD) -->
    <section class="w-full bg-white pt-2 sm:pt-2.5 md:pt-3 pb-8 sm:pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="maze-hero-bento relative w-full aspect-[16/10] rounded-2xl sm:rounded-3xl lg:rounded-[32px] border border-black overflow-hidden bg-[#e8e8e8] shadow-sm group">
                <img 
                    src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero.jpg' ); ?>" 
                    alt="<?php esc_attr_e( 'MAZE Editorial SS26', 'mazestreetwear' ); ?>" 
                    width="5765"
                    height="3614"
                    loading="eager"
                    fetchpriority="high"
                    decoding="async"
                    class="w-full h-full object-cover object-center select-none transition-transform duration-700 ease-out group-hover:scale-[1.01]"
                />

                <!-- Centered CTA Button with Radius on Each Corner -->
                <div class="absolute left-1/2 -translate-x-1/2 bottom-5 sm:bottom-8 md:bottom-12 z-10">
                    <a href="<?php echo esc_url( $shop_url ); ?>" class="maze-hero-cta inline-block border border-black bg-white text-black hover:bg-black hover:text-white transition-all px-8 sm:px-10 py-3 sm:py-3.5 text-xs sm:text-sm md:text-base uppercase tracking-wider font-bold font-mono text-center shadow-sm rounded-xl sm:rounded-2xl hover:shadow-md">
                        <?php esc_html_e( 'SHOP ALL', 'mazestreetwear' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Architectural Product Card Grid -->
    <section class="w-full bg-white border-b border-black">
        
        <!-- Section Header -->
        <div class="max-w-7xl mx-auto border-x border-t border-black">
            <div class="px-4 sm:px-6 lg:px-8 py-5 sm:py-6 border-b border-black flex items-center justify-between bg-white">
                <h2 class="text-base sm:text-lg lg:text-xl font-black font-sans uppercase tracking-wider text-black">
                    <?php esc_html_e( 'READY-TO-WEAR', 'mazestreetwear' ); ?>
                </h2>

                <a href="<?php echo esc_url( $shop_url ); ?>" class="text-sm sm:text-base font-bold font-sans text-black hover:underline underline-offset-4 transition-all">
                    <?php esc_html_e( 'see more →', 'mazestreetwear' ); ?>
                </a>
            </div>

            <!-- Connected Hairline Border Grid: 4 columns on desktop -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 bg-white overflow-hidden">
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
                        <article class="maze-product-card bg-white border border-black -ml-px -mt-px relative group flex flex-col justify-between rounded-none">
                            <a href="<?php echo esc_url( $shop_url ); ?>" class="flex flex-col h-full w-full group focus:outline-none">
                                <!-- Image Area: Tall aspect ratio (aspect-[3/4]) with generous padding and clean cutout -->
                                <div class="relative w-full aspect-[3/4] bg-white p-6 sm:p-8 flex items-center justify-center overflow-hidden">
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
                                <div class="border-t border-black px-4 py-3 flex justify-between items-baseline text-sm sm:text-base font-sans bg-white mt-auto">
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
    <section class="w-full bg-white py-16 sm:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <span class="inline-block text-xs sm:text-sm font-mono uppercase tracking-wider font-bold text-neutral-800">
                <?php esc_html_e( 'MAZE ARCHIVE SPECIFICATION // 2026', 'mazestreetwear' ); ?>
            </span>
            <p class="text-xl sm:text-2xl lg:text-3xl font-sans font-normal tracking-tight text-black leading-relaxed max-w-3xl mx-auto">
                <?php esc_html_e( 'Architectural garments engineered with uncompromising precision. Pure pitch black on optic white canvas, stripped of all transient distraction.', 'mazestreetwear' ); ?>
            </p>
            <div class="pt-4">
                <a href="<?php echo esc_url( $shop_url ); ?>" class="inline-block border border-black bg-white text-black hover:bg-black hover:text-white transition-all px-9 py-3.5 text-sm sm:text-base font-bold uppercase tracking-wider font-mono shadow-sm">
                    <?php esc_html_e( 'EXPLORE CATALOG', 'mazestreetwear' ); ?>
                </a>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
