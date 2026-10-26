<?php
/**
 * Lost password confirmation text - Custom Modern Brutalist UI for MAZE Streetwear
 *
 * This template overrides woocommerce/templates/myaccount/lost-password-confirmation.php.
 *
 * @package MazeStreetwear
 * @version 3.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_confirmation_message' );
?>

<div class="maze-lost-password-confirmation max-w-lg mx-auto py-8 sm:py-12 font-outfit text-black">

    <div class="border border-black p-6 sm:p-10 bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-center space-y-6">

        <div class="w-14 h-14 border border-black bg-black text-white mx-auto flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>

        <div>
            <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                <?php esc_html_e( 'Dispatch Confirmed', 'mazestreetwear' ); ?>
            </span>
            <h2 class="text-3xl sm:text-4xl font-bebas uppercase tracking-wide text-black">
                <?php esc_html_e( 'Reset Link Transmitted', 'mazestreetwear' ); ?>
            </h2>
        </div>

        <p class="text-sm text-neutral-700 leading-relaxed font-normal">
            <?php echo esc_html( apply_filters( 'woocommerce_lost_password_confirmation_message', esc_html__( 'A password reset email has been sent to the email address on file for your account, but may take several minutes to appear in your inbox. Please wait at least 10 minutes before attempting another reset.', 'woocommerce' ) ) ); ?>
        </p>

        <div class="pt-4 border-t border-black">
            <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"
               class="inline-flex items-center justify-center bg-black text-white px-8 py-3.5 font-bebas text-lg tracking-wider uppercase hover:bg-neutral-800 transition-colors">
                <?php esc_html_e( 'Return to Sign In', 'mazestreetwear' ); ?> &rarr;
            </a>
        </div>

    </div>

</div>

<?php do_action( 'woocommerce_after_lost_password_confirmation_message' ); ?>
