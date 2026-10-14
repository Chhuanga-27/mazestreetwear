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

<main id="primary" class="site-main min-h-screen bg-[#09090b] text-[#f4f4f5] py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <?php if ( have_posts() ) : ?>

            <?php if ( is_home() && ! is_front_page() ) : ?>
                <header class="mb-10 pb-6 border-b border-white/10">
                    <h1 class="page-title text-4xl sm:text-5xl font-black uppercase tracking-tight text-white">
                        <?php single_post_title(); ?>
                    </h1>
                </header>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-[#111113] border border-white/10 p-6 flex flex-col justify-between' ); ?>>
                        <div>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="mb-4 aspect-video overflow-hidden bg-[#18181b]">
                                    <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover' ) ); ?>
                                </div>
                            <?php endif; ?>

                            <div class="text-[11px] font-mono tracking-widest uppercase text-[#71717a] mb-2">
                                <?php echo get_the_date( 'd.m.Y' ); ?>
                            </div>

                            <h2 class="text-xl font-bold uppercase tracking-tight text-white hover:text-[#ccff00] transition-colors mb-3">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>

                            <div class="text-xs font-mono text-[#a1a1aa] leading-relaxed mb-4">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-white/5">
                            <a href="<?php the_permalink(); ?>" class="text-xs font-mono uppercase tracking-widest text-white hover:text-[#ccff00] transition-colors inline-flex items-center space-x-1">
                                <span><?php esc_html_e( 'READ ARCHIVE', 'mazestreetwear' ); ?></span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </article>
                    <?php
                endwhile;
                ?>
            </div>

            <div class="mt-12 pt-6 border-t border-white/10 flex justify-center font-mono text-xs">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( '&larr; PREVIOUS', 'mazestreetwear' ),
                    'next_text' => __( 'NEXT &rarr;', 'mazestreetwear' ),
                ) );
                ?>
            </div>

        <?php else : ?>

            <div class="py-20 text-center border border-dashed border-white/10 bg-[#111113] p-8 max-w-xl mx-auto">
                <span class="text-4xl mb-4 block text-[#71717a]">[ 404 ]</span>
                <h2 class="text-lg font-mono uppercase tracking-widest text-white mb-2"><?php esc_html_e( 'NOTHING FOUND', 'mazestreetwear' ); ?></h2>
                <p class="text-xs font-mono text-[#a1a1aa] mb-6"><?php esc_html_e( 'No posts or archive drops match your query.', 'mazestreetwear' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block bg-white text-black font-mono font-bold text-xs uppercase tracking-widest py-3 px-6 hover:bg-[#ccff00] transition-colors">
                    <?php esc_html_e( 'RETURN TO MAZE', 'mazestreetwear' ); ?>
                </a>
            </div>

        <?php endif; ?>

    </div>
</main>

<?php
get_footer();
