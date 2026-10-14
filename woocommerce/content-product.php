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
<article <?php wc_product_class( 'maze-product-card bg-white border border-black -ml-px -mt-px relative group flex flex-col justify-between rounded-none', $product ); ?>>
    <a href="<?php the_permalink(); ?>" class="flex flex-col h-full w-full group focus:outline-none" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
        <!-- Image Area: Tall aspect ratio (aspect-[3/4]), product cutout with generous padding and object-contain -->
        <div class="relative w-full aspect-[3/4] bg-white p-6 sm:p-8 flex items-center justify-center overflow-hidden">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php
                echo get_the_post_thumbnail(
                    $product->get_id(),
                    'woocommerce_thumbnail',
                    array(
                        'class' => 'w-full h-full object-contain object-center group-hover:scale-105 transition-transform duration-300',
                        'alt'   => esc_attr( get_the_title() ),
                    )
                );
                ?>
            <?php else : ?>
                <div class="w-full h-full flex flex-col items-center justify-center text-neutral-300 select-none">
                    <span class="text-3xl font-light font-sans tracking-widest text-neutral-300 group-hover:text-black transition-colors">MAZE</span>
                    <span class="text-[10px] font-mono uppercase tracking-widest text-neutral-400 mt-2">[ archive ]</span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Bottom Metadata Bar: thin top black border, title lowercase on left, price on right -->
        <div class="border-t border-black px-3 py-2.5 flex justify-between items-baseline text-xs font-sans bg-white mt-auto">
            <span class="text-black font-normal lowercase tracking-tight line-clamp-1 mr-2 group-hover:opacity-60 transition-opacity">
                <?php the_title(); ?>
            </span>
            <span class="text-black font-normal whitespace-nowrap font-sans text-right">
                <?php echo $product->get_price_html(); ?>
            </span>
        </div>
    </a>
</article>
