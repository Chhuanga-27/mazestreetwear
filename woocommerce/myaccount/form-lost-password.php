<?php
/**
 * Lost password form - Custom Modern Brutalist UI for MAZE Streetwear
 *
 * This template overrides woocommerce/templates/myaccount/form-lost-password.php.
 *
 * @package MazeStreetwear
 * @version 9.0.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<div class="maze-lost-password-wrapper max-w-lg mx-auto py-6 sm:py-10 font-outfit text-black">

    <div class="border border-black p-6 sm:p-10 bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">

        <div class="pb-4 mb-6 border-b border-black">
            <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                <?php esc_html_e( 'Access Recovery', 'mazestreetwear' ); ?>
            </span>
            <h2 class="text-3xl sm:text-4xl font-bebas uppercase tracking-wide text-black">
                <?php esc_html_e( 'Reset Password', 'mazestreetwear' ); ?>
            </h2>
        </div>

        <p class="text-sm text-neutral-700 leading-relaxed font-normal mb-6">
            <?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?>
        </p>

        <form method="post" class="woocommerce-ResetPassword lost_reset_password space-y-5">

            <div>
                <label for="user_login" class="block font-mono text-xs uppercase tracking-wider text-neutral-700 mb-2">
                    <?php esc_html_e( 'Username or email', 'woocommerce' ); ?> <span class="text-red-500">*</span>
                </label>
                <input class="w-full border border-black px-4 py-3 font-outfit text-sm text-black focus:outline-none focus:ring-1 focus:ring-black bg-white"
                       type="text"
                       name="user_login"
                       id="user_login"
                       autocomplete="username" />
            </div>

            <?php do_action( 'woocommerce_lostpassword_form' ); ?>

            <div class="pt-4">
                <input type="hidden" name="wc_reset_password" value="true" />
                <button type="submit"
                        class="w-full inline-flex items-center justify-center bg-black text-white px-8 py-3.5 font-bebas text-lg tracking-wider uppercase hover:bg-neutral-800 transition-colors"
                        value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>">
                    <?php esc_html_e( 'Transmit Password Reset Link', 'mazestreetwear' ); ?> &rarr;
                </button>
            </div>

            <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

        </form>

        <div class="pt-6 mt-6 border-t border-neutral-200 text-center">
            <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="font-mono text-xs uppercase tracking-wider text-neutral-600 hover:text-black hover:underline">
                &larr; <?php esc_html_e( 'Return to Member Sign In', 'mazestreetwear' ); ?>
            </a>
        </div>

    </div>

</div>

<?php do_action( 'woocommerce_after_lost_password_form' ); ?>
