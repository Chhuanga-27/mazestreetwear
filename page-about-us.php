<?php
/**
 * Template Name: About Us
 *
 * Minimalist Editorial About Us template for Maze Streetwear (mazestw.in).
 * Features an optic white background, pitch-black Outfit & Bebas Neue typography, and responsive layout.
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$about_url = function_exists( 'mazestreetwear_get_about_url' ) ? mazestreetwear_get_about_url() : home_url( '/about-us/' );
?>

<!-- Schema.org JSON-LD Structured Data for About Us Page & Brand Entity -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "AboutPage",
      "@id": "<?php echo esc_url( $about_url ); ?>#webpage",
      "url": "<?php echo esc_url( $about_url ); ?>",
      "name": "About Us - Maze Streetwear",
      "description": "Started running since 2019, MAZE is a High-End streetwear brand founded by Zela Sailo. The term \"MAZE\" refers to the world we live in. MAZE is you and me redefining streetwear, inspired to create.",
      "publisher": {
        "@id": "https://mazestw.in/#organization"
      }
    },
    {
      "@type": "ClothingStore",
      "@id": "https://mazestw.in/#organization",
      "name": "Maze Streetwear",
      "alternateName": ["MAZE", "mazestw.in"],
      "url": "https://mazestw.in",
      "founder": {
        "@type": "Person",
        "name": "Zela Sailo"
      },
      "foundingDate": "2019"
    }
  ]
}
</script>

<main id="primary" class="site-main min-h-[75vh] flex items-center justify-center bg-white text-black py-16 sm:py-24 md:py-32 lg:py-40 px-5 sm:px-8 lg:px-12">
    <div class="w-full max-w-4xl mx-auto">
        <article class="text-left">
            <h1 class="sr-only"><?php esc_html_e( 'About Maze Streetwear', 'mazestreetwear' ); ?></h1>

            <div class="font-outfit text-lg sm:text-xl md:text-2xl lg:text-[1.85rem] leading-[1.65] sm:leading-[1.7] md:leading-[1.75] text-black font-normal tracking-tight">
                <p class="mb-6 sm:mb-8 md:mb-10">
                    <?php esc_html_e( 'Started running since 2019, MAZE is a High-End streetwear brand founded by Zela Sailo,', 'mazestreetwear' ); ?><br class="hidden sm:inline" />
                    <?php esc_html_e( 'The term "MAZE" refers to the world we live in.', 'mazestreetwear' ); ?><br class="hidden sm:inline" />
                    <?php esc_html_e( 'MAZE is you and me redefining streetwear,', 'mazestreetwear' ); ?><br class="hidden sm:inline" />
                    <?php esc_html_e( 'inspired to create.', 'mazestreetwear' ); ?>
                </p>

                <p>
                    <?php esc_html_e( 'At MAZE we are changing the way streetwear is perceived, and we aim to evolve and move the Indian fashion culture by bringing to you revolutionizing designs.', 'mazestreetwear' ); ?>
                </p>
            </div>
        </article>
    </div>
</main>

<?php
get_footer();
