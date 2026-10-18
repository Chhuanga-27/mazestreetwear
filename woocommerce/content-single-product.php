<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Stark Luxury Minimalist Editorial Single Product View for mazestw.in.
 * 2-column layout framed by thin black dividers:
 * - Left: High-res clean garment image against pure white.
 * - Right: Details column with clean sans-serif title, bold minimal price, rectangular size boxes,
 *   solid black "ADD TO BAG" button, and accordions for Fabric & Fit, Shipping & Delivery, and Care.
 *
 * @package MazeStreetwear
 * @version 1.1.0
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

// Collect all gallery images: featured image first, followed by gallery attachments
$gallery_images = array();
if ( has_post_thumbnail() ) {
    $featured_id = get_post_thumbnail_id();
    $gallery_images[] = array(
        'id'  => $featured_id,
        'url' => wp_get_attachment_image_url( $featured_id, 'full' ),
        'alt' => get_post_meta( $featured_id, '_wp_attachment_image_alt', true ) ?: get_the_title(),
    );
}
$attachment_ids = $product->get_gallery_image_ids();
if ( ! empty( $attachment_ids ) ) {
    foreach ( $attachment_ids as $attachment_id ) {
        if ( has_post_thumbnail() && $attachment_id == get_post_thumbnail_id() ) {
            continue;
        }
        $gallery_images[] = array(
            'id'  => $attachment_id,
            'url' => wp_get_attachment_image_url( $attachment_id, 'full' ),
            'alt' => get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ?: ( get_the_title() . ' - Alternate View' ),
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
                    <div class="maze-gallery-wrapper relative w-full overflow-hidden group">
                        <!-- Horizontal Swipeable Track (Edge-to-edge on mobile with snap scrolling) -->
                        <div id="maze-gallery-slider" class="maze-gallery-track flex w-full overflow-x-auto snap-x snap-mandatory scrollbar-none select-none">
                            <?php foreach ( $gallery_images as $idx => $g_img ) : ?>
                                <div class="maze-gallery-slide min-w-full w-full flex-shrink-0 snap-center flex items-center justify-center bg-white" data-slide-index="<?php echo esc_attr( $idx ); ?>">
                                    <div class="w-full aspect-square sm:aspect-[4/5] lg:aspect-[4/5] max-w-full lg:max-w-xl mx-auto flex items-center justify-center overflow-hidden bg-white">
                                        <img 
                                            src="<?php echo esc_url( $g_img['url'] ); ?>" 
                                            alt="<?php echo esc_attr( $g_img['alt'] ); ?>" 
                                            class="w-full h-full object-contain object-center block"
                                            <?php if ( 0 === $idx ) : ?>id="maze-main-product-image"<?php endif; ?>
                                            loading="<?php echo 0 === $idx ? 'eager' : 'lazy'; ?>"
                                            draggable="false"
                                        />
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <?php if ( $image_count > 1 ) : ?>
                            <!-- Desktop Navigation Arrows (hidden on phone, visible on hover on desktop) -->
                            <button type="button" onclick="window.mazeGalleryPrev && window.mazeGalleryPrev(event)" class="maze-gallery-nav maze-gallery-prev hidden lg:flex absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 items-center justify-center bg-white/95 hover:bg-black hover:text-white text-black border border-black transition-all opacity-80 group-hover:opacity-100 cursor-pointer shadow-md z-20 select-none" aria-label="<?php esc_attr_e( 'Previous image', 'mazestreetwear' ); ?>">
                                <svg class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                            </button>
                            <button type="button" onclick="window.mazeGalleryNext && window.mazeGalleryNext(event)" class="maze-gallery-nav maze-gallery-next hidden lg:flex absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 items-center justify-center bg-white/95 hover:bg-black hover:text-white text-black border border-black transition-all opacity-80 group-hover:opacity-100 cursor-pointer shadow-md z-20 select-none" aria-label="<?php esc_attr_e( 'Next image', 'mazestreetwear' ); ?>">
                                <svg class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                            </button>
                        <?php endif; ?>
                    </div>

                    <?php if ( $image_count > 1 ) : ?>
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
                    <div class="w-full aspect-[4/5] sm:aspect-[3/4] max-w-lg mx-auto flex flex-col items-center justify-center text-neutral-300 py-16">
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

                <!-- Product Short Description in readable Outfit -->
                <?php if ( $product->get_short_description() ) : ?>
                    <div class="text-sm sm:text-base font-outfit text-neutral-800 leading-relaxed font-normal mb-6">
                        <?php echo apply_filters( 'woocommerce_short_description', $product->get_short_description() ); ?>
                    </div>
                <?php endif; ?>

                <!-- Add to Bag / Sizing Form -->
                <div class="product-actions-area">
                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>

                <!-- Minimalist Accordions with Thin Black Top/Bottom Borders -->
                <div class="mt-10 border-t border-black">
                    <!-- 1. Fabric & Fit -->
                    <details class="group border-b border-black" open>
                        <summary class="flex justify-between items-center py-4 sm:py-5 cursor-pointer list-none text-base sm:text-lg font-bebas font-normal uppercase tracking-wider text-black select-none">
                            <span><?php esc_html_e( 'FABRIC & FIT', 'mazestreetwear' ); ?></span>
                            <span class="text-base sm:text-lg font-outfit font-semibold group-open:hidden">+</span>
                            <span class="text-base sm:text-lg font-outfit font-semibold hidden group-open:inline">&minus;</span>
                        </summary>
                        <div class="pb-5 text-sm sm:text-base font-outfit text-neutral-800 leading-relaxed space-y-2">
                            <p><?php esc_html_e( '100% custom-milled 450GSM loopback French terry cotton. Engineered for substantial drape and enduring structural silhouette.', 'mazestreetwear' ); ?></p>
                            <p><?php esc_html_e( 'Boxy archival proportions with dropped shoulder seams and relaxed body cut. Pre-shrunk fabric to prevent deformation.', 'mazestreetwear' ); ?></p>
                        </div>
                    </details>

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

                    <!-- 3. Care -->
                    <details class="group border-b border-black">
                        <summary class="flex justify-between items-center py-4 sm:py-5 cursor-pointer list-none text-base sm:text-lg font-bebas font-normal uppercase tracking-wider text-black select-none">
                            <span><?php esc_html_e( 'CARE', 'mazestreetwear' ); ?></span>
                            <span class="text-base sm:text-lg font-outfit font-semibold group-open:hidden">+</span>
                            <span class="text-base sm:text-lg font-outfit font-semibold hidden group-open:inline">&minus;</span>
                        </summary>
                        <div class="pb-5 text-sm sm:text-base font-outfit text-neutral-800 leading-relaxed space-y-2">
                            <p><?php esc_html_e( 'Cold machine wash (30°C / 86°F) inside out with mild detergent.', 'mazestreetwear' ); ?></p>
                            <p><?php esc_html_e( 'Hang dry in shade. Do not tumble dry. Cool iron on reverse side avoiding prints or rubberized branding.', 'mazestreetwear' ); ?></p>
                        </div>
                    </details>
                </div>

            </div><!-- .lg:col-span-5 -->

        </div><!-- .grid -->
    </div><!-- .border-b -->

    <!-- Related Products in Connected Hairline Grid -->
    <?php
    $related_limit = 4;
    $related_ids = wc_get_related_products( $product->get_id(), $related_limit );

    if ( ! empty( $related_ids ) ) :
        ?>
        <div class="w-full bg-white border-b border-black">
            <div class="max-w-7xl mx-auto border-x border-black">
                <div class="px-4 sm:px-6 lg:px-8 py-5 border-b border-black flex justify-between items-center">
                    <h2 class="text-xl sm:text-2xl font-normal font-bebas uppercase tracking-wider text-black">
                        <?php esc_html_e( 'YOU MAY ALSO LIKE', 'mazestreetwear' ); ?>
                    </h2>
                    <a href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>" class="text-sm sm:text-base font-semibold font-outfit text-black hover:underline underline-offset-4 transition-all">
                        <?php esc_html_e( 'see more →', 'mazestreetwear' ); ?>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 bg-white overflow-hidden">
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
