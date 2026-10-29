<?php
/**
 * Login & Register Form - Custom Modern Brutalist UI for MAZE
 *
 * This template overrides woocommerce/templates/myaccount/form-login.php.
 *
 * @package MazeStreetwear
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit;

$enable_registration = ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) );

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="maze-account-auth-portal max-w-5xl mx-auto py-4 sm:py-8 font-outfit text-black">

    <div class="grid grid-cols-1 <?php echo $enable_registration ? 'lg:grid-cols-2' : 'max-w-md mx-auto'; ?> gap-8 sm:gap-12 items-stretch">

        <!-- Column 1: Sign In -->
        <div class="border border-black p-6 sm:p-10 bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 mb-6 border-b border-black">
                    <div>
                        <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                            <?php esc_html_e( 'Returning Member', 'mazestreetwear' ); ?>
                        </span>
                        <h2 class="text-3xl sm:text-4xl font-bebas uppercase tracking-wide text-black">
                            <?php esc_html_e( 'Sign In', 'mazestreetwear' ); ?>
                        </h2>
                    </div>
                    <span class="w-3 h-3 bg-black"></span>
                </div>

                <form class="woocommerce-form woocommerce-form-login login space-y-5" method="post">

                    <?php do_action( 'woocommerce_login_form_start' ); ?>

                    <div>
                        <label for="username" class="block font-mono text-xs uppercase tracking-wider text-neutral-700 mb-2">
                            <?php esc_html_e( 'Username or email address', 'woocommerce' ); ?> <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               class="w-full border border-black px-4 py-3 font-outfit text-sm text-black focus:outline-none focus:ring-1 focus:ring-black bg-white"
                               name="username"
                               id="username"
                               autocomplete="username"
                               value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block font-mono text-xs uppercase tracking-wider text-neutral-700">
                                <?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="text-red-500">*</span>
                            </label>
                            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="font-mono text-xs text-neutral-500 hover:text-black hover:underline uppercase">
                                <?php esc_html_e( 'Forgot password?', 'mazestreetwear' ); ?>
                            </a>
                        </div>
                        <input class="w-full border border-black px-4 py-3 font-outfit text-sm text-black focus:outline-none focus:ring-1 focus:ring-black bg-white"
                               type="password"
                               name="password"
                               id="password"
                               autocomplete="current-password" />
                    </div>

                    <?php do_action( 'woocommerce_login_form' ); ?>

                    <div class="flex items-center justify-between pt-2">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input class="w-4 h-4 rounded-none border border-black text-black focus:ring-0 focus:ring-offset-0 cursor-pointer accent-black"
                                   name="rememberme"
                                   type="checkbox"
                                   id="rememberme"
                                   value="forever" />
                            <span class="font-mono text-xs text-neutral-700 uppercase tracking-wider">
                                <?php esc_html_e( 'Remember me', 'woocommerce' ); ?>
                            </span>
                        </label>
                    </div>

                    <div class="pt-4">
                        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center bg-black text-white px-8 py-3.5 font-bebas text-lg tracking-wider uppercase hover:bg-neutral-800 transition-colors"
                                name="login"
                                value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">
                            <?php esc_html_e( 'Authenticate & Enter', 'mazestreetwear' ); ?> &rarr;
                        </button>
                    </div>

                    <?php do_action( 'woocommerce_login_form_end' ); ?>

                </form>
            </div>

            <div class="pt-6 mt-6 border-t border-neutral-200">
                <span class="block font-mono text-[10px] uppercase tracking-widest text-neutral-400">
                    <?php esc_html_e( 'Protected by 256-Bit SSL Encryption', 'mazestreetwear' ); ?>
                </span>
            </div>
        </div>

        <?php if ( $enable_registration ) : ?>

            <!-- Column 2: Create Account -->
            <div class="border border-black p-6 sm:p-10 bg-neutral-50 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-4 mb-6 border-b border-black">
                        <div>
                            <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                                <?php esc_html_e( 'New Client', 'mazestreetwear' ); ?>
                            </span>
                            <h2 class="text-3xl sm:text-4xl font-bebas uppercase tracking-wide text-black">
                                <?php esc_html_e( 'Create Account', 'mazestreetwear' ); ?>
                            </h2>
                        </div>
                        <span class="w-3 h-3 border border-black bg-white"></span>
                    </div>

                    <form method="post" class="woocommerce-form woocommerce-form-register register space-y-5" <?php do_action( 'woocommerce_register_form_tag' ); ?>>

                        <?php do_action( 'woocommerce_register_form_start' ); ?>

                        <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                            <div>
                                <label for="reg_username" class="block font-mono text-xs uppercase tracking-wider text-neutral-700 mb-2">
                                    <?php esc_html_e( 'Username', 'woocommerce' ); ?> <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       class="w-full border border-black px-4 py-3 font-outfit text-sm text-black focus:outline-none focus:ring-1 focus:ring-black bg-white"
                                       name="username"
                                       id="reg_username"
                                       autocomplete="username"
                                       value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
                            </div>
                        <?php endif; ?>

                        <div>
                            <label for="reg_email" class="block font-mono text-xs uppercase tracking-wider text-neutral-700 mb-2">
                                <?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="text-red-500">*</span>
                            </label>
                            <input type="email"
                                   class="w-full border border-black px-4 py-3 font-outfit text-sm text-black focus:outline-none focus:ring-1 focus:ring-black bg-white"
                                   name="email"
                                   id="reg_email"
                                   autocomplete="email"
                                   value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" />
                        </div>

                        <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                            <div>
                                <label for="reg_password" class="block font-mono text-xs uppercase tracking-wider text-neutral-700 mb-2">
                                    <?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="text-red-500">*</span>
                                </label>
                                <input type="password"
                                       class="w-full border border-black px-4 py-3 font-outfit text-sm text-black focus:outline-none focus:ring-1 focus:ring-black bg-white"
                                       name="password"
                                       id="reg_password"
                                       autocomplete="new-password" />
                            </div>
                        <?php else : ?>
                            <p class="font-mono text-xs text-neutral-600 leading-relaxed">
                                <?php esc_html_e( 'A secure 1-click password setup link will be transmitted directly to your email address.', 'mazestreetwear' ); ?>
                            </p>
                        <?php endif; ?>

                        <?php do_action( 'woocommerce_register_form' ); ?>

                        <div class="pt-4">
                            <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                            <button type="submit"
                                    class="w-full inline-flex items-center justify-center border border-black bg-white text-black px-8 py-3.5 font-bebas text-lg tracking-wider uppercase hover:bg-black hover:text-white transition-colors"
                                    name="register"
                                    value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">
                                <?php esc_html_e( 'Join Garment Club', 'mazestreetwear' ); ?> &rarr;
                            </button>
                        </div>

                        <?php do_action( 'woocommerce_register_form_end' ); ?>

                    </form>
                </div>

                <div class="pt-6 mt-6 border-t border-neutral-300">
                    <p class="text-xs text-neutral-600 leading-relaxed font-normal">
                        <?php esc_html_e( 'Your personal data will be utilized to facilitate your seamless order fulfillment and manage your account privileges according to our privacy policy.', 'mazestreetwear' ); ?>
                    </p>
                </div>
            </div>

        <?php endif; ?>

    </div>

</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
