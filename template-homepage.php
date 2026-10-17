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

    <!-- 1. Editorial Hero Banner (Full-Width, No Border, No Radius, HD) -->
    <section class="w-full bg-white pt-0 pb-10 sm:pb-16">
        <div class="maze-hero-bento relative w-full aspect-[4/3] sm:aspect-[16/10] lg:aspect-[16/9] rounded-none border-0 overflow-hidden bg-[#e8e8e8] group">
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
                <a href="<?php echo esc_url( $shop_url ); ?>" class="maze-hero-cta inline-block border border-black bg-white text-black hover:bg-black hover:text-white transition-all px-6 sm:px-10 py-2.5 sm:py-3.5 text-base sm:text-lg md:text-xl uppercase tracking-wider font-normal font-bebas text-center shadow-sm rounded-lg sm:rounded-2xl hover:shadow-md">
                    <?php esc_html_e( 'SHOP ALL', 'mazestreetwear' ); ?>
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

        // 3rd showcase product
        $third_q = new WP_Query( array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'offset'         => 2,
        ) );
        if ( $third_q->have_posts() ) {
            $third_q->the_post();
            $wc_third = wc_get_product( get_the_ID() );
            if ( $wc_third ) {
                $showcase_item_3['title']     = $wc_third->get_name();
                $showcase_item_3['price']     = $wc_third->get_price_html();
                $showcase_item_3['permalink'] = $wc_third->get_permalink();
                if ( has_post_thumbnail( get_the_ID() ) ) {
                    $showcase_item_3['image'] = get_the_post_thumbnail_url( get_the_ID(), 'full' );
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

    <!-- 4. Featured Editorial Showcase - Product 3 (Product Image on Left, Title & Price on Right) -->
    <section class="maze-showcase-section w-full bg-white pb-6 sm:pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="<?php echo esc_url( $showcase_item_3['permalink'] ); ?>" class="maze-showcase-card group grid grid-cols-2 bg-white overflow-hidden focus:outline-none" aria-label="<?php echo esc_attr( $showcase_item_3['title'] ); ?>">
                <!-- Left: Product Image -->
                <div class="maze-showcase-media relative w-full aspect-[4/5] bg-[#eae7e1] overflow-hidden">
                    <img 
                        src="<?php echo esc_url( $showcase_item_3['image'] ); ?>" 
                        alt="<?php echo esc_attr( $showcase_item_3['title'] ); ?>" 
                        loading="lazy"
                        decoding="async"
                        class="w-full h-full object-cover object-center select-none transition-transform duration-700 ease-out group-hover:scale-105"
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

    <!-- 5. View All Products CTA Button -->
    <section class="maze-view-all-section w-full bg-white pt-2 sm:pt-4 pb-16 sm:pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <a href="<?php echo esc_url( $shop_url ); ?>" class="maze-view-all-btn group inline-flex items-center justify-center border border-black bg-white text-black hover:bg-black hover:text-white transition-all px-7 sm:px-11 py-2.5 sm:py-3.5 text-base sm:text-lg md:text-xl uppercase tracking-wider font-normal font-bebas text-center shadow-sm rounded-lg sm:rounded-2xl hover:shadow-md" aria-label="<?php esc_attr_e( 'View All Products', 'mazestreetwear' ); ?>">
                <span><?php esc_html_e( 'VIEW ALL', 'mazestreetwear' ); ?></span>
                <span class="maze-view-all-line inline-block w-5 sm:w-7 h-[1.5px] sm:h-[2px] bg-current ml-2.5 sm:ml-3 transition-transform duration-300 ease-out group-hover:translate-x-1.5" aria-hidden="true"></span>
            </a>
        </div>
    </section>

</main>

<?php
get_footer();
