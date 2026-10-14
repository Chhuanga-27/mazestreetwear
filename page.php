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

<main id="primary" class="site-main min-h-screen bg-white text-black py-12 sm:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header mb-10 pb-6 border-b border-black">
                    <div class="inline-flex items-center space-x-2 text-[11px] font-mono font-bold tracking-widest text-black uppercase mb-2 border border-black px-2.5 py-0.5 bg-white">
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-black"></span>
                        <span><?php esc_html_e( 'MAZE PROTOCOL // OFFICIAL DOCS', 'mazestreetwear' ); ?></span>
                    </div>
                    <h1 class="entry-title text-3xl sm:text-5xl font-black font-sans uppercase tracking-tight text-black">
                        <?php the_title(); ?>
                    </h1>
                </header>

                <div class="entry-content prose prose-neutral max-w-none font-sans text-sm sm:text-base text-neutral-800 leading-relaxed space-y-6">
                    <?php
                    the_content();

                    wp_link_pages( array(
                        'before' => '<div class="page-links font-mono text-xs pt-6 border-t border-neutral-200">' . esc_html__( 'Pages:', 'mazestreetwear' ),
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
