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

<main id="primary" class="site-main min-h-screen bg-[#09090b] text-[#f4f4f5] py-12 sm:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header mb-10 pb-6 border-b border-white/10">
                    <div class="inline-flex items-center space-x-2 text-[11px] font-mono tracking-widest text-[#ccff00] uppercase mb-2">
                        <span class="inline-block w-2 h-2 rounded-full bg-[#ccff00]"></span>
                        <span><?php esc_html_e( 'MAZE PROTOCOL // OFFICIAL DOCS', 'mazestreetwear' ); ?></span>
                    </div>
                    <h1 class="entry-title text-3xl sm:text-5xl font-black font-sans uppercase tracking-tight text-white">
                        <?php the_title(); ?>
                    </h1>
                </header>

                <div class="entry-content prose prose-invert prose-neutral max-w-none font-sans text-sm sm:text-base text-[#d4d4d8] leading-relaxed space-y-6">
                    <?php
                    the_content();

                    wp_link_pages( array(
                        'before' => '<div class="page-links font-mono text-xs pt-6">' . esc_html__( 'Pages:', 'mazestreetwear' ),
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
