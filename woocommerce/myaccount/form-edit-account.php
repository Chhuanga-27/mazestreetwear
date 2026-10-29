<?php
/**
 * Edit account form - Custom Modern Brutalist UI for MAZE
 *
 * This template overrides woocommerce/templates/myaccount/form-edit-account.php.
 *
 * @package MazeStreetwear
 * @version 8.7.0
 */

defined( 'ABSPATH' ) || exit;

/** @var WP_User|WC_Customer $user */
$user = ! empty( $user ) ? $user : wp_get_current_user();

do_action( 'woocommerce_before_edit_account_form' ); ?>

<div class="maze-account-edit-profile space-y-6">

    <!-- Header Section -->
    <div class="pb-6 border-b border-black">
        <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
            <?php esc_html_e( 'Access & Security', 'mazestreetwear' ); ?>
        </span>
        <h2 class="text-3xl sm:text-4xl font-bebas uppercase tracking-wide text-black">
            <?php esc_html_e( 'Account Details', 'mazestreetwear' ); ?>
        </h2>
        <p class="text-sm text-neutral-700 font-normal mt-1">
            <?php esc_html_e( 'Manage your personal identification, verified email address, and security credentials.', 'mazestreetwear' ); ?>
        </p>
    </div>

    <form class="woocommerce-EditAccountForm edit-account space-y-8" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?>>

        <?php do_action( 'woocommerce_edit_account_form_start' ); ?>

        <!-- Section 1: Personal Identification -->
        <div class="border border-black p-6 bg-white space-y-6">
            <div class="flex items-center justify-between pb-3 border-b border-neutral-200">
                <span class="font-mono text-xs uppercase tracking-widest text-neutral-500">
                    01 // PERSONAL IDENTIFICATION
                </span>
                <span class="w-2 h-2 rounded-full bg-black"></span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="account_first_name" class="block font-mono text-xs uppercase tracking-wider text-neutral-700 mb-2">
                        <?php esc_html_e( 'First name', 'woocommerce' ); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           class="w-full border border-black px-4 py-3 font-outfit text-sm text-black focus:outline-none focus:ring-1 focus:ring-black bg-white"
                           name="account_first_name"
                           id="account_first_name"
                           autocomplete="given-name"
                           value="<?php echo esc_attr( $user->first_name ); ?>" />
                </div>

                <div>
                    <label for="account_last_name" class="block font-mono text-xs uppercase tracking-wider text-neutral-700 mb-2">
                        <?php esc_html_e( 'Last name', 'woocommerce' ); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           class="w-full border border-black px-4 py-3 font-outfit text-sm text-black focus:outline-none focus:ring-1 focus:ring-black bg-white"
                           name="account_last_name"
                           id="account_last_name"
                           autocomplete="family-name"
                           value="<?php echo esc_attr( $user->last_name ); ?>" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="account_display_name" class="block font-mono text-xs uppercase tracking-wider text-neutral-700 mb-2">
                        <?php esc_html_e( 'Display name', 'woocommerce' ); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           class="w-full border border-black px-4 py-3 font-outfit text-sm text-black focus:outline-none focus:ring-1 focus:ring-black bg-white"
                           name="account_display_name"
                           id="account_display_name"
                           value="<?php echo esc_attr( $user->display_name ); ?>" />
                    <span class="block font-mono text-[11px] text-neutral-500 mt-1">
                        <?php esc_html_e( 'Displayed in the client header and order receipts.', 'mazestreetwear' ); ?>
                    </span>
                </div>

                <div>
                    <label for="account_email" class="block font-mono text-xs uppercase tracking-wider text-neutral-700 mb-2">
                        <?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="email"
                           class="w-full border border-black px-4 py-3 font-outfit text-sm text-black focus:outline-none focus:ring-1 focus:ring-black bg-white"
                           name="account_email"
                           id="account_email"
                           autocomplete="email"
                           value="<?php echo esc_attr( $user->user_email ); ?>" />
                </div>
            </div>
        </div>

        <?php
        /**
         * Hook where additional user fields can be injected.
         */
        do_action( 'woocommerce_edit_account_form_fields' );
        ?>

        <!-- Section 2: Password Authentication -->
        <div class="border border-black p-6 bg-white space-y-6">
            <div class="flex items-center justify-between pb-3 border-b border-neutral-200">
                <span class="font-mono text-xs uppercase tracking-widest text-neutral-500">
                    02 // SECURITY & PASSWORD CHANGE
                </span>
                <span class="font-mono text-xs text-neutral-400">
                    <?php esc_html_e( 'Leave blank to keep unchanged', 'mazestreetwear' ); ?>
                </span>
            </div>

            <div>
                <label for="password_current" class="block font-mono text-xs uppercase tracking-wider text-neutral-700 mb-2">
                    <?php esc_html_e( 'Current password', 'woocommerce' ); ?>
                </label>
                <input type="password"
                       class="w-full border border-black px-4 py-3 font-outfit text-sm text-black focus:outline-none focus:ring-1 focus:ring-black bg-white"
                       name="password_current"
                       id="password_current"
                       autocomplete="current-password" />
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="password_1" class="block font-mono text-xs uppercase tracking-wider text-neutral-700 mb-2">
                        <?php esc_html_e( 'New password', 'woocommerce' ); ?>
                    </label>
                    <input type="password"
                           class="w-full border border-black px-4 py-3 font-outfit text-sm text-black focus:outline-none focus:ring-1 focus:ring-black bg-white"
                           name="password_1"
                           id="password_1"
                           autocomplete="new-password" />
                </div>

                <div>
                    <label for="password_2" class="block font-mono text-xs uppercase tracking-wider text-neutral-700 mb-2">
                        <?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?>
                    </label>
                    <input type="password"
                           class="w-full border border-black px-4 py-3 font-outfit text-sm text-black focus:outline-none focus:ring-1 focus:ring-black bg-white"
                           name="password_2"
                           id="password_2"
                           autocomplete="new-password" />
                </div>
            </div>
        </div>

        <?php do_action( 'woocommerce_edit_account_form' ); ?>

        <!-- Action Submit Strip -->
        <div class="pt-4 border-t border-black flex flex-col sm:flex-row items-center justify-between gap-4">
            <button type="submit"
                    class="w-full sm:w-auto inline-flex items-center justify-center bg-black text-white px-8 py-3.5 font-bebas text-lg tracking-wider uppercase hover:bg-neutral-800 transition-colors"
                    name="save_account_details"
                    value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>">
                <?php esc_html_e( 'Save Account Changes', 'mazestreetwear' ); ?> &rarr;
            </button>
            <?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
            <input type="hidden" name="action" value="save_account_details" />
        </div>

        <?php do_action( 'woocommerce_edit_account_form_end' ); ?>

    </form>

</div>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
