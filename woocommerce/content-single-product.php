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

/**
 * Hook: woocommerce_before_single_product.
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'maze-single-product-editorial bg-white text-black', $product ); ?>>

    <!-- 2-Column Garment Detail Frame with Thin Black Dividers -->
    <div class="w-full border-b border-black">
        <div class="max-w-7xl mx-auto border-x border-black grid grid-cols-1 lg:grid-cols-12 min-h-[700px]">

            <!-- Left Column: High-Resolution Clean Garment Image Against Pure White (Col Span 7) -->
            <div class="lg:col-span-7 border-b lg:border-b-0 lg:border-r border-black p-6 sm:p-10 lg:p-16 flex flex-col items-center justify-center bg-white relative">
                <?php
                if ( has_post_thumbnail() ) {
                    $image_id = get_post_thumbnail_id();
                    $full_image_url = wp_get_attachment_image_url( $image_id, 'full' );
                    ?>
                    <div class="w-full aspect-[3/4] max-w-lg mx-auto flex items-center justify-center overflow-hidden">
                        <img 
                            src="<?php echo esc_url( $full_image_url ); ?>" 
                            alt="<?php echo esc_attr( get_the_title() ); ?>" 
                            class="w-full h-full object-contain object-center"
                            id="maze-main-product-image"
                        />
                    </div>

                    <?php
                    // Gallery thumbnails if multiple images exist
                    $attachment_ids = $product->get_gallery_image_ids();
                    if ( ! empty( $attachment_ids ) ) :
                        ?>
                        <div class="flex flex-wrap gap-2.5 mt-8 justify-center">
                            <button type="button" class="maze-gallery-thumb border border-black p-1 w-14 h-18 sm:w-16 sm:h-20 bg-white cursor-pointer transition-all" data-img-src="<?php echo esc_url( $full_image_url ); ?>" aria-label="<?php esc_attr_e( 'Main image', 'mazestreetwear' ); ?>">
                                <img src="<?php echo esc_url( $full_image_url ); ?>" class="w-full h-full object-contain" alt="" />
                            </button>
                            <?php foreach ( $attachment_ids as $attachment_id ) : 
                                $thumb_url = wp_get_attachment_image_url( $attachment_id, 'woocommerce_thumbnail' );
                                $large_url = wp_get_attachment_image_url( $attachment_id, 'full' );
                            ?>
                                <button type="button" class="maze-gallery-thumb border border-neutral-300 hover:border-black p-1 w-14 h-18 sm:w-16 sm:h-20 bg-white cursor-pointer transition-all" data-img-src="<?php echo esc_url( $large_url ); ?>" aria-label="<?php esc_attr_e( 'Gallery thumbnail', 'mazestreetwear' ); ?>">
                                    <img src="<?php echo esc_url( $thumb_url ); ?>" class="w-full h-full object-contain" alt="" />
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                <?php } else { ?>
                    <div class="w-full aspect-[3/4] max-w-lg mx-auto flex flex-col items-center justify-center text-neutral-300">
                        <span class="text-4xl font-light font-sans tracking-widest text-neutral-400">MAZE</span>
                        <span class="text-xs font-mono uppercase tracking-widest text-neutral-600 font-bold mt-2">[ product cutout ]</span>
                    </div>
                <?php } ?>
            </div>

            <!-- Right Column: Minimalist Details Column (Col Span 5) -->
            <div class="lg:col-span-5 p-6 sm:p-10 lg:p-12 flex flex-col justify-start bg-white">

                <!-- Product Title in clean sans-serif -->
                <h1 class="text-2xl sm:text-4xl font-bold font-sans tracking-tight text-black">
                    <?php the_title(); ?>
                </h1>

                <!-- Price in bold minimal typography -->
                <div class="text-2xl sm:text-3xl font-black font-sans text-black tracking-tight mt-3 mb-6">
                    <?php echo $product->get_price_html(); ?>
                </div>

                <!-- Product Short Description / Lead Spec (if exists) -->
                <?php if ( $product->get_short_description() ) : ?>
                    <div class="text-sm sm:text-base font-sans text-neutral-800 leading-relaxed font-medium mb-6">
                        <?php echo apply_filters( 'woocommerce_short_description', $product->get_short_description() ); ?>
                    </div>
                <?php endif; ?>

                <!-- Add to Bag / Sizing Form -->
                <div class="product-actions-area">
                    <?php
                    // Check if variable product
                    if ( $product->is_type( 'variable' ) ) {
                        woocommerce_variable_add_to_cart();
                    } elseif ( $product->is_type( 'simple' ) ) {
                        // For simple products, provide the Sizing selector & solid black full-width button
                        ?>
                        <form class="cart space-y-6" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
                            
                            <!-- Sizing Selector: Clean rectangular size boxes with 1px black borders -->
                            <div class="size-selector-wrap">
                                <div class="flex items-center justify-between mb-2.5">
                                    <span class="text-sm font-mono uppercase tracking-wider text-black font-bold">
                                        <?php esc_html_e( 'SIZE', 'mazestreetwear' ); ?>
                                        <span class="selected-size-label ml-2 text-black font-bold">// S</span>
                                    </span>
                                </div>
                                <div class="maze-size-pills flex flex-wrap gap-2.5">
                                    <button type="button" class="maze-size-pill is-active selected px-5 py-3 text-sm sm:text-base font-bold font-mono uppercase border border-black bg-black text-white cursor-pointer transition-colors" data-value="S">S</button>
                                    <button type="button" class="maze-size-pill px-5 py-3 text-sm sm:text-base font-bold font-mono uppercase border border-black bg-white text-black hover:bg-neutral-100 cursor-pointer transition-colors" data-value="M">M</button>
                                    <button type="button" class="maze-size-pill px-5 py-3 text-sm sm:text-base font-bold font-mono uppercase border border-black bg-white text-black hover:bg-neutral-100 cursor-pointer transition-colors" data-value="L">L</button>
                                    <button type="button" class="maze-size-pill px-5 py-3 text-sm sm:text-base font-bold font-mono uppercase border border-black bg-white text-black hover:bg-neutral-100 cursor-pointer transition-colors" data-value="XL">XL</button>
                                </div>
                            </div>

                            <!-- "ADD TO BAG" Button: Solid black rectangular button full width -->
                            <div class="pt-2">
                                <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt bg-black text-white hover:bg-neutral-800 text-sm sm:text-base font-bold uppercase tracking-wider py-4 w-full border border-black rounded-none font-mono transition-colors duration-150 cursor-pointer block text-center">
                                    <?php esc_html_e( 'ADD TO BAG', 'mazestreetwear' ); ?>
                                </button>
                            </div>
                        </form>
                        <?php
                    } else {
                        // Any other product type (grouped, external, etc.)
                        woocommerce_template_single_add_to_cart();
                    }
                    ?>
                </div>

                <!-- Minimalist Accordions with Thin Black Top/Bottom Borders -->
                <div class="mt-10 border-t border-black">
                    <!-- 1. Fabric & Fit -->
                    <details class="group border-b border-black" open>
                        <summary class="flex justify-between items-center py-4 sm:py-5 cursor-pointer list-none text-sm sm:text-base font-mono font-bold uppercase tracking-wider text-black select-none">
                            <span><?php esc_html_e( 'FABRIC & FIT', 'mazestreetwear' ); ?></span>
                            <span class="text-base sm:text-lg font-mono font-bold group-open:hidden">+</span>
                            <span class="text-base sm:text-lg font-mono font-bold hidden group-open:inline">&minus;</span>
                        </summary>
                        <div class="pb-5 text-sm sm:text-base font-sans text-neutral-900 leading-relaxed space-y-2">
                            <p><?php esc_html_e( '100% custom-milled 450GSM loopback French terry cotton. Engineered for substantial drape and enduring structural silhouette.', 'mazestreetwear' ); ?></p>
                            <p><?php esc_html_e( 'Boxy archival proportions with dropped shoulder seams and relaxed body cut. Pre-shrunk fabric to prevent deformation.', 'mazestreetwear' ); ?></p>
                        </div>
                    </details>

                    <!-- 2. Shipping & Delivery -->
                    <details class="group border-b border-black">
                        <summary class="flex justify-between items-center py-4 sm:py-5 cursor-pointer list-none text-sm sm:text-base font-mono font-bold uppercase tracking-wider text-black select-none">
                            <span><?php esc_html_e( 'SHIPPING & DELIVERY', 'mazestreetwear' ); ?></span>
                            <span class="text-base sm:text-lg font-mono font-bold group-open:hidden">+</span>
                            <span class="text-base sm:text-lg font-mono font-bold hidden group-open:inline">&minus;</span>
                        </summary>
                        <div class="pb-5 text-sm sm:text-base font-sans text-neutral-900 leading-relaxed space-y-2">
                            <p><?php esc_html_e( 'Dispatched within 24 to 48 hours worldwide. Tracked express shipping provided with delivery confirmation.', 'mazestreetwear' ); ?></p>
                            <p><?php esc_html_e( 'Complimentary shipping on orders exceeding specified minimum threshold. Customs and duties handled seamlessly.', 'mazestreetwear' ); ?></p>
                        </div>
                    </details>

                    <!-- 3. Care -->
                    <details class="group border-b border-black">
                        <summary class="flex justify-between items-center py-4 sm:py-5 cursor-pointer list-none text-sm sm:text-base font-mono font-bold uppercase tracking-wider text-black select-none">
                            <span><?php esc_html_e( 'CARE', 'mazestreetwear' ); ?></span>
                            <span class="text-base sm:text-lg font-mono font-bold group-open:hidden">+</span>
                            <span class="text-base sm:text-lg font-mono font-bold hidden group-open:inline">&minus;</span>
                        </summary>
                        <div class="pb-5 text-sm sm:text-base font-sans text-neutral-900 leading-relaxed space-y-2">
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
                    <h2 class="text-base sm:text-lg font-bold font-sans uppercase tracking-wider text-black">
                        <?php esc_html_e( 'YOU MAY ALSO LIKE', 'mazestreetwear' ); ?>
                    </h2>
                    <a href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>" class="text-sm sm:text-base font-bold font-sans text-black hover:opacity-60 transition-opacity">
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
