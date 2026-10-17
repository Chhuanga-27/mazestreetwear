<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main min-h-screen bg-[#FEFEF3] text-black py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <?php if ( have_posts() ) : ?>

            <?php if ( is_home() && ! is_front_page() ) : ?>
                <header class="mb-10 pb-6 border-b-2 border-black">
                    <div class="text-xs sm:text-sm font-outfit font-semibold tracking-widest text-neutral-800 uppercase mb-1">
                        [ ARCHIVE JOURNAL // 2026 ]
                    </div>
                    <h1 class="page-title text-4xl sm:text-6xl font-normal font-bebas uppercase tracking-wide text-black">
                        <?php single_post_title(); ?>
                    </h1>
                </header>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white border-2 border-black p-6 flex flex-col justify-between hover:shadow-[4px_4px_0px_0px_#000000] transition-all duration-200' ); ?>>
                        <div>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="mb-4 aspect-video overflow-hidden bg-neutral-100 border border-black">
                                    <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-200' ) ); ?>
                                </div>
                            <?php endif; ?>

                            <div class="text-xs sm:text-sm font-outfit font-medium tracking-wider uppercase text-neutral-700 mb-2">
                                <?php echo get_the_date( 'd.m.Y' ); ?>
                            </div>

                            <h2 class="text-2xl sm:text-3xl font-normal font-bebas uppercase tracking-wide text-black hover:text-neutral-700 transition-colors mb-3">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>

                            <div class="text-sm sm:text-base font-outfit text-neutral-800 leading-relaxed mb-4">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-black">
                            <a href="<?php the_permalink(); ?>" class="text-base font-bebas font-normal uppercase tracking-wider text-black hover:text-neutral-700 transition-colors inline-flex items-center space-x-2">
                                <span><?php esc_html_e( 'READ ARCHIVE', 'mazestreetwear' ); ?></span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </article>
                    <?php
                endwhile;
                ?>
            </div>

            <div class="mt-12 pt-6 border-t-2 border-black flex justify-center font-mono text-sm sm:text-base font-bold">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( '&larr; PREVIOUS', 'mazestreetwear' ),
                    'next_text' => __( 'NEXT &rarr;', 'mazestreetwear' ),
                ) );
                ?>
            </div>

        <?php else : ?>

            <div class="py-20 text-center border-2 border-black bg-neutral-50 p-8 max-w-xl mx-auto">
                <span class="text-4xl mb-4 block font-bebas font-normal text-neutral-600">[ 404 ]</span>
                <h2 class="text-2xl font-bebas uppercase font-normal tracking-wide text-black mb-2"><?php esc_html_e( 'NOTHING FOUND', 'mazestreetwear' ); ?></h2>
                <p class="text-sm sm:text-base font-outfit text-neutral-800 mb-6"><?php esc_html_e( 'No posts or archive drops match your query.', 'mazestreetwear' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block bg-black text-white font-bebas font-normal text-lg uppercase tracking-wider py-3.5 px-8 hover:bg-neutral-800 transition-colors border-2 border-black">
                    <?php esc_html_e( 'RETURN TO MAZE', 'mazestreetwear' ); ?>
                </a>
            </div>

        <?php endif; ?>

    </div>
</main>

<?php
get_footer();
