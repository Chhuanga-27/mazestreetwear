<?php
/**
 * Template Name: Homepage Minimalist
 *
 * Stark Luxury Minimalist Editorial Homepage for Maze (mazestw.in).
 * Features:
 * - Full-width hero banner with centered CTA button
 * - 3 Featured editorial split garment showcases (alternating layout)
 * - Pure white canvas, pitch black typography, crisp typography, zero radius, zero clutter.
 *
 * @package MazeStreetwear
 * @version 1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
?>

<main id="primary" class="site-main bg-white text-black min-h-screen">

    <!-- High-Priority Brand Heading for Google Indexing (mazestw) -->
    <h1 class="sr-only"><?php esc_html_e( 'MAZE (MAZESTW) | Contemporary Luxury & Brutalist Streetwear India — Official Online Store', 'mazestreetwear' ); ?></h1>

    <!-- 1. Editorial Hero Banner (Full-Width, No Border, No Radius, HD) -->
    <section class="w-full bg-white pt-0 pb-10 sm:pb-16">
        <div class="maze-hero-bento relative w-full aspect-[4/3] sm:aspect-[16/10] lg:aspect-[16/9] rounded-none border-0 overflow-hidden bg-[#e8e8e8] group">
            <?php
            $hero_mobile_ver  = file_exists(get_template_directory() . '/assets/images/hero-mobile.jpg') ? filemtime(get_template_directory() . '/assets/images/hero-mobile.jpg') : '1';
            $hero_desktop_ver = file_exists(get_template_directory() . '/assets/images/hero-desktop.jpg') ? filemtime(get_template_directory() . '/assets/images/hero-desktop.jpg') : '1';
            ?>
            <picture class="w-full h-full block">
                <source media="(max-width: 639px)" srcset="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-mobile.jpg?v=' . $hero_mobile_ver ); ?>" width="2560" height="1920">
                <source media="(min-width: 640px)" srcset="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-desktop.jpg?v=' . $hero_desktop_ver ); ?>" width="5765" height="3614">
                <img 
                    src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-desktop.jpg?v=' . $hero_desktop_ver ); ?>" 
                    alt="<?php esc_attr_e( 'MAZE (MAZESTW) Editorial Brutalist Streetwear Collection', 'mazestreetwear' ); ?>" 
                    width="5765"
                    height="3614"
                    loading="eager"
                    fetchpriority="high"
                    decoding="async"
                    class="w-full h-full object-cover object-center select-none transition-transform duration-700 ease-out group-hover:scale-[1.01]"
                />
            </picture>

            <!-- Centered Hero CTA Button (Perspective Oval Style with Transparent Background) -->
            <div class="absolute left-1/2 -translate-x-1/2 bottom-3 sm:bottom-8 md:bottom-12 z-10 flex items-center justify-center">
                <a href="<?php echo esc_url( $shop_url ); ?>" class="maze-hero-cta group relative inline-flex items-center justify-center text-white no-underline select-none transition-transform duration-300 ease-out hover:scale-[1.04] focus:outline-none" aria-label="<?php esc_attr_e( 'Shop All Products', 'mazestreetwear' ); ?>">
                    <span class="maze-hero-cta-text relative z-10 font-bebas uppercase tracking-wider text-white select-none">
                        <?php esc_html_e( 'SHOP ALL', 'mazestreetwear' ); ?>
                    </span>
                    <svg 
                        viewBox="0 0 270 104" 
                        fill="none" 
                        preserveAspectRatio="none" 
                        xmlns="http://www.w3.org/2000/svg" 
                        aria-hidden="true" 
                        class="maze-hero-oval absolute inset-0 w-full h-full pointer-events-none select-none transition-transform duration-300 ease-out group-hover:scale-105"
                    >
                        <ellipse cx="135" cy="52" rx="133" ry="50" stroke="#ffffff" stroke-width="2" vector-effect="non-scaling-stroke" />
                    </svg>
                </a>
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

    $showcase_item_3 = array(
        'title'     => 'DOUBLE LAYER HOODIE',
        'price'     => 'INR 4555',
        'image'     => get_template_directory_uri() . '/assets/images/product-archive-hoodie.jpg',
        'permalink' => $shop_url,
    );

    if ( class_exists( 'WooCommerce' ) ) {
        $populate_showcase_item = static function ( &$item, $post_id ) {
            $wc_product = wc_get_product( $post_id );
            if ( ! $wc_product ) {
                return false;
            }
            $item['title']     = $wc_product->get_name();
            $item['price']     = $wc_product->get_price_html();
            $item['permalink'] = $wc_product->get_permalink();
            if ( has_post_thumbnail( $post_id ) ) {
                $item['image'] = get_the_post_thumbnail_url( $post_id, 'full' );
            }
            return true;
        };

        $excluded_ids = array();

        // Look for puffer-gilet first or query latest published garments
        $puffer_post = get_page_by_path( 'puffer-gilet', OBJECT, 'product' );
        if ( $puffer_post && 'publish' !== get_post_status( $puffer_post ) ) {
            $puffer_post = null;
        }
        if ( ! $puffer_post ) {
            $puffer_q = new WP_Query( array(
                'post_type'           => 'product',
                'post_status'         => 'publish',
                'posts_per_page'      => 1,
                's'                   => 'Puffer Gilet',
                'ignore_sticky_posts' => true,
            ) );
            if ( $puffer_q->have_posts() ) {
                $puffer_q->the_post();
                $puffer_post = get_post();
                wp_reset_postdata();
            }
        }

        if ( $puffer_post && $populate_showcase_item( $showcase_item_1, $puffer_post->ID ) ) {
            $excluded_ids[] = (int) $puffer_post->ID;
        } else {
            // Use 1st published WooCommerce product if available
            $first_q = new WP_Query( array(
                'post_type'           => 'product',
                'post_status'         => 'publish',
                'posts_per_page'      => 1,
                'ignore_sticky_posts' => true,
            ) );
            if ( $first_q->have_posts() ) {
                $first_q->the_post();
                $first_id = get_the_ID();
                if ( $populate_showcase_item( $showcase_item_1, $first_id ) ) {
                    $excluded_ids[] = (int) $first_id;
                }
                wp_reset_postdata();
            }
        }

        // 2nd & 3rd showcase products (exclude already-selected product IDs to prevent duplicates)
        $remaining_q = new WP_Query( array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'posts_per_page'      => 2,
            'post__not_in'        => $excluded_ids,
            'ignore_sticky_posts' => true,
        ) );
        if ( $remaining_q->have_posts() ) {
            $slot_index = 2;
            while ( $remaining_q->have_posts() ) {
                $remaining_q->the_post();
                $pid = get_the_ID();
                if ( 2 === $slot_index && $populate_showcase_item( $showcase_item_2, $pid ) ) {
                    $slot_index++;
                } elseif ( 3 === $slot_index && $populate_showcase_item( $showcase_item_3, $pid ) ) {
                    $slot_index++;
                }
            }
            wp_reset_postdata();
        }
    }
    ?>

    <!-- 2. Featured Editorial Showcase - Product 1 (Product Image on Left, Title & Price on Right) -->
    <section class="maze-showcase-section w-full bg-white pb-6 sm:pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="<?php echo esc_url( $showcase_item_1['permalink'] ); ?>" class="maze-showcase-card group grid grid-cols-2 bg-white overflow-hidden focus:outline-none" aria-label="<?php echo esc_attr( $showcase_item_1['title'] ); ?>">
                <!-- Left: Product Image -->
                <div class="maze-showcase-media relative w-full aspect-[3/4] bg-white p-3 sm:p-5 flex items-center justify-center overflow-hidden">
                    <img 
                        src="<?php echo esc_url( $showcase_item_1['image'] ); ?>" 
                        alt="<?php echo esc_attr( $showcase_item_1['title'] ); ?>" 
                        loading="lazy"
                        decoding="async"
                        class="w-full h-full object-contain object-center select-none transition-transform duration-700 ease-out group-hover:scale-105"
                    />
                </div>

                <!-- Right: Product Information -->
                <div class="maze-showcase-info flex flex-col justify-center px-4 sm:px-8 md:px-12 lg:px-20 py-6 sm:py-10 bg-white select-none">
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
    <section class="maze-showcase-section w-full bg-white pb-6 sm:pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="<?php echo esc_url( $showcase_item_2['permalink'] ); ?>" class="maze-showcase-card group grid grid-cols-2 bg-white overflow-hidden focus:outline-none" aria-label="<?php echo esc_attr( $showcase_item_2['title'] ); ?>">
                <!-- Left: Product Information -->
                <div class="maze-showcase-info flex flex-col justify-center px-4 sm:px-8 md:px-12 lg:px-20 py-6 sm:py-10 bg-white select-none">
                    <h2 class="maze-showcase-title text-xl sm:text-3xl md:text-4xl lg:text-5xl font-normal font-bebas uppercase tracking-wide text-black group-hover:opacity-60 transition-opacity">
                        <?php echo esc_html( $showcase_item_2['title'] ); ?>
                    </h2>
                    <div class="maze-showcase-price text-sm sm:text-lg md:text-xl lg:text-2xl font-bold font-outfit uppercase tracking-normal text-black mt-1.5 sm:mt-3 md:mt-4">
                        <?php echo wp_kses_post( $showcase_item_2['price'] ); ?>
                    </div>
                </div>

                <!-- Right: Product Image -->
                <div class="maze-showcase-media relative w-full aspect-[3/4] bg-white p-3 sm:p-5 flex items-center justify-center overflow-hidden">
                    <img 
                        src="<?php echo esc_url( $showcase_item_2['image'] ); ?>" 
                        alt="<?php echo esc_attr( $showcase_item_2['title'] ); ?>" 
                        loading="lazy"
                        decoding="async"
                        class="w-full h-full object-contain object-center select-none transition-transform duration-700 ease-out group-hover:scale-105"
                    />
                </div>
            </a>
        </div>
    </section>

    <!-- 4. Featured Editorial Showcase - Product 3 (Product Image on Left, Title & Price on Right) -->
    <section class="maze-showcase-section w-full bg-white pb-6 sm:pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="<?php echo esc_url( $showcase_item_3['permalink'] ); ?>" class="maze-showcase-card group grid grid-cols-2 bg-white overflow-hidden focus:outline-none" aria-label="<?php echo esc_attr( $showcase_item_3['title'] ); ?>">
                <!-- Left: Product Image -->
                <div class="maze-showcase-media relative w-full aspect-[3/4] bg-white p-3 sm:p-5 flex items-center justify-center overflow-hidden">
                    <img 
                        src="<?php echo esc_url( $showcase_item_3['image'] ); ?>" 
                        alt="<?php echo esc_attr( $showcase_item_3['title'] ); ?>" 
                        loading="lazy"
                        decoding="async"
                        class="w-full h-full object-contain object-center select-none transition-transform duration-700 ease-out group-hover:scale-105"
                    />
                </div>

                <!-- Right: Product Information -->
                <div class="maze-showcase-info flex flex-col justify-center px-4 sm:px-8 md:px-12 lg:px-20 py-6 sm:py-10 bg-white select-none">
                    <h2 class="maze-showcase-title text-xl sm:text-3xl md:text-4xl lg:text-5xl font-normal font-bebas uppercase tracking-wide text-black group-hover:opacity-60 transition-opacity">
                        <?php echo esc_html( $showcase_item_3['title'] ); ?>
                    </h2>
                    <div class="maze-showcase-price text-sm sm:text-lg md:text-xl lg:text-2xl font-bold font-outfit uppercase tracking-normal text-black mt-1.5 sm:mt-3 md:mt-4">
                        <?php echo wp_kses_post( $showcase_item_3['price'] ); ?>
                    </div>
                </div>
            </a>
        </div>
    </section>

    <!-- 5. View All Products CTA (Minimalist Text + Line) -->
    <section class="maze-view-all-section w-full bg-white pt-4 sm:pt-6 pb-16 sm:pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <a href="<?php echo esc_url( $shop_url ); ?>" class="maze-view-all-btn group inline-flex items-center justify-center border-0 bg-transparent text-black hover:opacity-60 transition-opacity text-xl sm:text-2xl md:text-3xl uppercase tracking-wider font-normal font-bebas text-center focus:outline-none" aria-label="<?php esc_attr_e( 'View All Products', 'mazestreetwear' ); ?>">
                <span class="maze-view-all-line maze-view-all-line-left inline-block w-7 sm:w-10 h-[1.5px] sm:h-[2px] bg-black mr-2.5 sm:mr-3.5 transition-transform duration-300 ease-out group-hover:-translate-x-1.5" aria-hidden="true"></span>
                <span><?php esc_html_e( 'VIEW ALL', 'mazestreetwear' ); ?></span>
                <span class="maze-view-all-line maze-view-all-line-right inline-block w-7 sm:w-10 h-[1.5px] sm:h-[2px] bg-black ml-2.5 sm:ml-3.5 transition-transform duration-300 ease-out group-hover:translate-x-1.5" aria-hidden="true"></span>
            </a>
        </div>
    </section>

</main>

<?php
get_footer();
