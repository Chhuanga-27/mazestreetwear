<?php
/**
 * The template for displaying product content within loops
 *
 * Minimalist luxury editorial product card for mazestw.in.
 * Pure white background, zero radius, hairline black border.
 * Tall aspect ratio with generous padding, clean lowercase title, right-aligned price.
 * Zero ratings, zero sale badges, zero bulky buttons.
 *
 * @package MazeStreetwear
 * @version 1.1.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>
<article <?php wc_product_class( 'maze-product-card bg-white relative group flex flex-col justify-between rounded-none border-0', $product ); ?>>
    <a href="<?php the_permalink(); ?>" class="flex flex-col h-full w-full group focus:outline-none" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
        <!-- Image Area: Adaptive container with pure white background and uncropped object-contain -->
        <div class="relative w-full aspect-square sm:aspect-[3/4] overflow-hidden bg-white p-2 sm:p-3.5 flex items-center justify-center">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php
                echo get_the_post_thumbnail(
                    $product->get_id(),
                    'full',
                    array(
                        'class' => 'w-full h-full object-contain object-center group-hover:scale-105 transition-transform duration-500 ease-out block',
                        'alt'   => esc_attr( get_the_title() ),
                    )
                );
                ?>
            <?php else : ?>
                <div class="w-full h-full flex flex-col items-center justify-center text-neutral-300 select-none p-4 sm:p-6">
                    <span class="text-2xl sm:text-3xl font-normal font-bebas tracking-widest text-neutral-300 group-hover:text-black transition-colors">MAZE</span>
                    <span class="text-[10px] sm:text-xs font-outfit font-semibold uppercase tracking-widest text-neutral-600 mt-1 sm:mt-2">[ archive ]</span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Bottom Metadata Bar: clean borderless metadata, title lowercase on left, price on right -->
        <div class="pt-3 px-1 sm:px-1.5 pb-1 flex justify-between items-baseline text-xs sm:text-sm md:text-base font-outfit bg-white mt-auto">
            <span class="text-black font-medium font-outfit lowercase tracking-tight line-clamp-1 mr-1.5 sm:mr-2 group-hover:opacity-60 transition-opacity">
                <?php the_title(); ?>
            </span>
            <span class="text-black font-bold whitespace-nowrap font-outfit text-right text-xs sm:text-sm md:text-base">
                <?php echo $product->get_price_html(); ?>
            </span>
        </div>
    </a>
</article>
