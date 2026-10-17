<?php
/**
 * The template for displaying all pages (policies, terms, about, contact)
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<?php
$is_wc_cart     = function_exists( 'is_cart' ) && is_cart();
$is_wc_checkout = function_exists( 'is_checkout' ) && is_checkout();
$is_wc_account  = function_exists( 'is_account_page' ) && is_account_page();
$is_commerce    = $is_wc_cart || $is_wc_checkout || $is_wc_account;

$container_classes = $is_commerce ? 'max-w-6xl mx-auto px-4 sm:px-6 lg:px-8' : 'max-w-4xl mx-auto px-4 sm:px-6 lg:px-8';
$content_classes   = $is_commerce ? 'entry-content max-w-none font-sans text-base text-neutral-900 leading-relaxed font-normal' : 'entry-content prose prose-neutral max-w-none font-sans text-base sm:text-lg text-neutral-900 leading-relaxed space-y-6 font-normal';

$protocol_badge = $is_wc_cart 
    ? __( 'MAZE PROTOCOL // SHOPPING BAG', 'mazestreetwear' ) 
    : ( $is_wc_checkout 
        ? __( 'MAZE PROTOCOL // SECURE CHECKOUT', 'mazestreetwear' ) 
        : ( $is_wc_account 
            ? __( 'MAZE PROTOCOL // ACCOUNT ACCESS', 'mazestreetwear' ) 
            : __( 'MAZE PROTOCOL // OFFICIAL DOCS', 'mazestreetwear' ) ) );
?>

<main id="primary" class="site-main min-h-screen bg-[#FEFEF3] text-black py-10 sm:py-16">
    <div class="<?php echo esc_attr( $container_classes ); ?>">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header mb-8 sm:mb-12 pb-5 border-b border-black">
                    <div class="inline-flex items-center space-x-2 text-xs sm:text-sm font-mono font-bold tracking-widest text-black uppercase mb-3 border border-black px-3 py-1 bg-[#FEFEF3]">
                        <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                        <span><?php echo esc_html( $protocol_badge ); ?></span>
                    </div>
                    <h1 class="entry-title text-3xl sm:text-5xl font-normal font-bebas uppercase tracking-wide text-black">
                        <?php the_title(); ?>
                    </h1>
                </header>

                <div class="<?php echo esc_attr( $content_classes ); ?>">
                    <?php
                    the_content();

                    wp_link_pages( array(
                        'before' => '<div class="page-links font-mono text-sm font-bold pt-6 border-t border-black">' . esc_html__( 'Pages:', 'mazestreetwear' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                </div>
            </article>

        <?php endwhile; ?>

    </div>
</main>

<?php
get_footer();
