<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Stark Luxury Minimalist Editorial Single Product View for mazestw.in.
 * 2-column layout framed by thin black dividers:
 * - Left: High-res clean garment image against pure white.
 * - Right: Details column with clean sans-serif title, bold minimal price, rectangular size boxes,
 *   solid black "ADD TO BAG" button, and accordions for Description and Shipping & Delivery.
 *
 * @package MazeStreetwear
 * @version 1.1.2
 */

defined( 'ABSPATH' ) || exit;

global $product;

?>
<?php
// Only output notice container if notices are present
ob_start();
do_action( 'woocommerce_before_single_product' );
$before_sp_notices = trim( ob_get_clean() );
if ( ! empty( $before_sp_notices ) ) :
?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-2">
    <?php echo $before_sp_notices; // WPCS: XSS ok. ?>
</div>
<?php endif; ?>

<?php
if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}

// Collect all gallery images: featured image first, followed by gallery attachments in native 'full' resolution
$gallery_images = array();
if ( has_post_thumbnail() ) {
    $featured_id = get_post_thumbnail_id();
    $feat_img    = wp_get_attachment_image_src( $featured_id, 'full' );
    $gallery_images[] = array(
        'id'     => $featured_id,
        'url'    => $feat_img ? $feat_img[0] : wp_get_attachment_image_url( $featured_id, 'full' ),
        'width'  => $feat_img ? $feat_img[1] : '',
        'height' => $feat_img ? $feat_img[2] : '',
        'alt'    => get_post_meta( $featured_id, '_wp_attachment_image_alt', true ) ?: get_the_title(),
    );
}
$attachment_ids = $product->get_gallery_image_ids();
if ( ! empty( $attachment_ids ) ) {
    foreach ( $attachment_ids as $attachment_id ) {
        if ( has_post_thumbnail() && $attachment_id == get_post_thumbnail_id() ) {
            continue;
        }
        $att_img = wp_get_attachment_image_src( $attachment_id, 'full' );
        $gallery_images[] = array(
            'id'     => $attachment_id,
            'url'    => $att_img ? $att_img[0] : wp_get_attachment_image_url( $attachment_id, 'full' ),
            'width'  => $att_img ? $att_img[1] : '',
            'height' => $att_img ? $att_img[2] : '',
            'alt'    => get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ?: ( get_the_title() . ' - Alternate View' ),
        );
    }
}
$image_count = count( $gallery_images );
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'maze-single-product-editorial bg-white text-black', $product ); ?>>

    <!-- 2-Column Garment Detail Frame with Thin Black Dividers -->
    <div class="w-full border-b border-black">
        <div class="max-w-7xl mx-auto border-x-0 lg:border-x border-black grid grid-cols-1 lg:grid-cols-12 min-h-[700px]">

            <!-- Left Column: Edge-to-Edge Slidable / Swipeable Garment Images (Col Span 7) -->
            <div class="lg:col-span-7 border-b lg:border-b-0 lg:border-r border-black p-0 lg:p-10 xl:p-14 flex flex-col items-center justify-center bg-white relative overflow-hidden">
                <?php if ( $image_count > 0 ) : ?>
                    <div class="maze-gallery-wrapper relative w-full overflow-hidden">
                        <!-- Horizontal Swipeable Track (Edge-to-edge on mobile with snap scrolling) -->
                        <div id="maze-gallery-slider" class="maze-gallery-track flex w-full overflow-x-auto snap-x snap-mandatory scrollbar-none select-none">
                            <?php foreach ( $gallery_images as $idx => $g_img ) : ?>
                                <div class="maze-gallery-slide min-w-full w-full flex-shrink-0 snap-center flex items-center justify-center bg-white" data-slide-index="<?php echo esc_attr( $idx ); ?>">
                                    <div class="w-full max-w-full lg:max-w-xl mx-auto flex items-center justify-center bg-white">
                                        <img 
                                            src="<?php echo esc_url( $g_img['url'] ); ?>" 
                                            alt="<?php echo esc_attr( $g_img['alt'] ); ?>" 
                                            class="w-full h-auto block"
                                            <?php if ( ! empty( $g_img['width'] ) ) : ?>width="<?php echo esc_attr( $g_img['width'] ); ?>"<?php endif; ?>
                                            <?php if ( ! empty( $g_img['height'] ) ) : ?>height="<?php echo esc_attr( $g_img['height'] ); ?>"<?php endif; ?>
                                            <?php if ( 0 === $idx ) : ?>id="maze-main-product-image"<?php endif; ?>
                                            loading="<?php echo 0 === $idx ? 'eager' : 'lazy'; ?>"
                                            draggable="false"
                                        />
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php if ( $image_count > 1 ) : ?>
                        <!-- Modern Sleek Floating Navigation Arrows (moved far from the product image) -->
                        <button type="button" 
                                onclick="window.mazeGalleryPrev && window.mazeGalleryPrev(event)" 
                                class="maze-gallery-nav maze-gallery-prev group/arrow hidden md:flex absolute left-3 sm:left-5 lg:left-8 top-1/2 -translate-y-1/2 w-11 h-11 sm:w-12 sm:h-12 rounded-full items-center justify-center bg-white/95 hover:bg-black text-black hover:text-white border border-black/15 hover:border-black transition-all duration-300 shadow-[0_4px_16px_rgba(0,0,0,0.08)] hover:shadow-[0_8px_24px_rgba(0,0,0,0.2)] hover:scale-105 active:scale-95 cursor-pointer z-30 select-none backdrop-blur-sm" 
                                aria-label="<?php esc_attr_e( 'Previous image', 'mazestreetwear' ); ?>">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 pointer-events-none transition-transform duration-200 group-hover/arrow:-translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                        <button type="button" 
                                onclick="window.mazeGalleryNext && window.mazeGalleryNext(event)" 
                                class="maze-gallery-nav maze-gallery-next group/arrow hidden md:flex absolute right-3 sm:right-5 lg:right-8 top-1/2 -translate-y-1/2 w-11 h-11 sm:w-12 sm:h-12 rounded-full items-center justify-center bg-white/95 hover:bg-black text-black hover:text-white border border-black/15 hover:border-black transition-all duration-300 shadow-[0_4px_16px_rgba(0,0,0,0.08)] hover:shadow-[0_8px_24px_rgba(0,0,0,0.2)] hover:scale-105 active:scale-95 cursor-pointer z-30 select-none backdrop-blur-sm" 
                                aria-label="<?php esc_attr_e( 'Next image', 'mazestreetwear' ); ?>">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 pointer-events-none transition-transform duration-200 group-hover/arrow:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                        <!-- TAB Under the Image to Navigate Slides -->
                        <div class="maze-gallery-tabs-wrap w-full flex items-center justify-center py-2 sm:py-3 bg-white border-b lg:border-b-0 border-neutral-200">
                            <div id="maze-gallery-tabs" class="maze-gallery-tabs inline-flex items-center gap-1.5 sm:gap-2 px-2 py-1" role="tablist" aria-label="<?php esc_attr_e( 'Product image slides', 'mazestreetwear' ); ?>">
                                <?php for ( $i = 0; $i < $image_count; $i++ ) : ?>
                                    <button 
                                        type="button" 
                                        role="tab"
                                        onclick="window.mazeGalleryGoTo && window.mazeGalleryGoTo(<?php echo $i; ?>, event)"
                                        class="maze-gallery-tab-item py-2 px-1 focus:outline-none cursor-pointer border-none bg-transparent transition-all"
                                        data-slide-target="<?php echo esc_attr( $i ); ?>"
                                        aria-label="<?php echo esc_attr( sprintf( __( 'Image %d of %d', 'mazestreetwear' ), $i + 1, $image_count ) ); ?>"
                                        aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>"
                                    >
                                        <span class="maze-tab-bar block h-1 sm:h-1.5 rounded-full transition-all duration-300 pointer-events-none <?php echo 0 === $i ? 'w-10 bg-black' : 'w-6 bg-neutral-300 hover:bg-neutral-500'; ?>"></span>
                                        <span class="sr-only"><?php echo esc_html( sprintf( __( 'Slide %d', 'mazestreetwear' ), $i + 1 ) ); ?></span>
                                    </button>
                                <?php endfor; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php else : ?>
                    <div class="w-full max-w-lg mx-auto flex flex-col items-center justify-center text-neutral-300 py-16">
                        <span class="text-4xl font-normal font-bebas tracking-widest text-neutral-400">MAZE</span>
                        <span class="text-xs font-outfit font-semibold uppercase tracking-widest text-neutral-600 mt-2">[ product cutout ]</span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right Column: Minimalist Details Column (Col Span 5) -->
            <div class="lg:col-span-5 p-6 sm:p-10 lg:p-12 flex flex-col justify-start bg-white">

                <!-- Product Title in bold architectural Bebas Neue -->
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-normal font-bebas tracking-wide uppercase text-black leading-tight">
                    <?php the_title(); ?>
                </h1>

                <!-- Price in clean bold Outfit -->
                <div class="text-2xl sm:text-3xl font-bold font-outfit text-black tracking-tight mt-3 mb-6">
                    <?php echo $product->get_price_html(); ?>
                </div>

                <!-- Add to Bag / Sizing Form -->
                <div class="product-actions-area">
                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>

                <!-- Minimalist Accordions with Thin Black Top/Bottom Borders -->
                <div class="mt-10 border-t border-black">

                    <!-- 1. Description -->
                    <?php
                    $maze_short_desc = $product->get_short_description();
                    $maze_full_desc  = get_the_content();
                    $has_short_desc  = ! empty( trim( (string) $maze_short_desc ) );
                    $has_full_desc   = ! empty( trim( (string) $maze_full_desc ) );

                    if ( $has_short_desc || $has_full_desc ) :
                    ?>
                        <details class="group border-b border-black" open>
                            <summary class="flex justify-between items-center py-4 sm:py-5 cursor-pointer list-none text-base sm:text-lg font-bebas font-normal uppercase tracking-wider text-black select-none">
                                <span><?php esc_html_e( 'DESCRIPTION', 'mazestreetwear' ); ?></span>
                                <span class="text-base sm:text-lg font-outfit font-semibold group-open:hidden">+</span>
                                <span class="text-base sm:text-lg font-outfit font-semibold hidden group-open:inline">&minus;</span>
                            </summary>
                            <div class="pb-5 text-sm sm:text-base font-outfit text-neutral-800 leading-relaxed space-y-2">
                                <?php
                                if ( $has_short_desc && $has_full_desc ) {
                                    if ( trim( wp_strip_all_tags( $maze_short_desc ) ) === trim( wp_strip_all_tags( $maze_full_desc ) ) ) {
                                        echo apply_filters( 'the_content', $maze_full_desc );
                                    } else {
                                        echo '<div class="maze-short-desc mb-2">' . apply_filters( 'woocommerce_short_description', $maze_short_desc ) . '</div>';
                                        echo '<div class="maze-full-desc">' . apply_filters( 'the_content', $maze_full_desc ) . '</div>';
                                    }
                                } elseif ( $has_full_desc ) {
                                    echo apply_filters( 'the_content', $maze_full_desc );
                                } else {
                                    echo apply_filters( 'woocommerce_short_description', $maze_short_desc );
                                }
                                ?>
                            </div>
                        </details>
                    <?php endif; ?>

                    <!-- 2. Shipping & Delivery -->
                    <details class="group border-b border-black">
                        <summary class="flex justify-between items-center py-4 sm:py-5 cursor-pointer list-none text-base sm:text-lg font-bebas font-normal uppercase tracking-wider text-black select-none">
                            <span><?php esc_html_e( 'SHIPPING & DELIVERY', 'mazestreetwear' ); ?></span>
                            <span class="text-base sm:text-lg font-outfit font-semibold group-open:hidden">+</span>
                            <span class="text-base sm:text-lg font-outfit font-semibold hidden group-open:inline">&minus;</span>
                        </summary>
                        <div class="pb-5 text-sm sm:text-base font-outfit text-neutral-800 leading-relaxed space-y-2">
                            <p><?php esc_html_e( 'Dispatched within 24 to 48 hours worldwide. Tracked express shipping provided with delivery confirmation.', 'mazestreetwear' ); ?></p>
                            <p><?php esc_html_e( 'Complimentary shipping on orders exceeding specified minimum threshold. Customs and duties handled seamlessly.', 'mazestreetwear' ); ?></p>
                        </div>
                    </details>
                </div>

            </div><!-- .lg:col-span-5 -->

        </div><!-- .grid -->
    </div><!-- .border-b -->

    <!-- Related Products: Minimalist Borderless Grid -->
    <?php
    $related_limit = 4;
    $related_ids = wc_get_related_products( $product->get_id(), $related_limit );

    if ( ! empty( $related_ids ) ) :
        ?>
        <div class="w-full bg-white pt-10 sm:pt-14 pb-12 sm:pb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="pb-6 sm:pb-8 flex justify-between items-center">
                    <h2 class="text-xl sm:text-2xl font-normal font-bebas uppercase tracking-wider text-black">
                        <?php esc_html_e( 'YOU MAY ALSO LIKE', 'mazestreetwear' ); ?>
                    </h2>
                    <a href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>" class="text-sm sm:text-base font-semibold font-outfit text-black hover:underline underline-offset-4 transition-all">
                        <?php esc_html_e( 'see more →', 'mazestreetwear' ); ?>
                    </a>
                </div>

                <div class="maze-product-grid grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-4 sm:gap-x-6 lg:gap-x-8 gap-y-8 sm:gap-y-12 bg-white">
                    <?php
                    foreach ( $related_ids as $rel_id ) :
                        $post_object = get_post( $rel_id );
                        setup_postdata( $GLOBALS['post'] =& $post_object );
                        wc_get_template_part( 'content', 'product' );
                    endforeach;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
