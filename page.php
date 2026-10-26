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
?>

<main id="primary" class="site-main min-h-screen bg-white text-black py-10 sm:py-16">
    <div class="<?php echo esc_attr( $container_classes ); ?>">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header mb-8 sm:mb-12 pb-5 border-b border-black">
                    <?php if ( $is_wc_account ) : ?>
                        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                            <div>
                                <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                                    <?php esc_html_e( 'Client Sanctuary // Member Dashboard', 'mazestreetwear' ); ?>
                                </span>
                                <h1 class="entry-title text-4xl sm:text-6xl font-normal font-bebas uppercase tracking-wide text-black">
                                    <?php the_title(); ?>
                                </h1>
                            </div>
                            <?php if ( is_user_logged_in() ) : 
                                $header_current_user = wp_get_current_user();
                            ?>
                                <div class="inline-flex items-center gap-3 border border-black px-4 py-2 bg-neutral-50 self-start sm:self-auto">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span class="font-mono text-xs uppercase tracking-wider text-black">
                                        <?php echo esc_html( $header_current_user->display_name ); ?> // <?php esc_html_e( 'Active Member', 'mazestreetwear' ); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php else : ?>
                        <h1 class="entry-title text-3xl sm:text-5xl font-normal font-bebas uppercase tracking-wide text-black">
                            <?php the_title(); ?>
                        </h1>
                    <?php endif; ?>
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
