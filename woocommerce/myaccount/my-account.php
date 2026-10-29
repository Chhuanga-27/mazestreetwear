<?php
/**
 * My Account page - Custom Modern Brutalist UI for MAZE
 *
 * This template overrides woocommerce/templates/myaccount/my-account.php.
 * Features:
 * - High-contrast brutalist streetwear layout
 * - Responsive navigation rail and dynamic viewport panel
 * - Seamless integration with WooCommerce account endpoints
 *
 * @package MazeStreetwear
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

$current_user = wp_get_current_user();
?>

<div class="maze-account-wrapper font-outfit text-black">
    <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-start">

        <!-- Sidebar Navigation Rail -->
        <aside class="w-full lg:w-72 flex-shrink-0">
            <?php
            /**
             * My Account navigation.
             *
             * @since 2.6.0
             */
            do_action( 'woocommerce_account_navigation' );
            ?>
        </aside>

        <!-- Main Account Viewport -->
        <main class="flex-1 min-w-0 w-full">
            <div class="woocommerce-MyAccount-content border border-black bg-white p-6 sm:p-10 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <?php
                /**
                 * My Account content.
                 *
                 * @since 2.6.0
                 */
                do_action( 'woocommerce_account_content' );
                ?>
            </div>
        </main>

    </div>
</div>
