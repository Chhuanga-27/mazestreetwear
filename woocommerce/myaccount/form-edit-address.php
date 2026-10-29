<?php
/**
 * Edit address form - Custom Modern Brutalist UI for MAZE
 *
 * This template overrides woocommerce/templates/myaccount/form-edit-address.php.
 *
 * @package MazeStreetwear
 * @version 9.3.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * @var string $load_address
 * @var array  $address
 */
$load_address = isset( $load_address ) ? $load_address : '';
$address      = isset( $address ) ? $address : array();

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'woocommerce' ) : esc_html__( 'Shipping address', 'woocommerce' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
    <?php wc_get_template( 'myaccount/my-address.php' ); ?>
<?php else : ?>

    <div class="maze-account-edit-address space-y-6">

        <!-- Return Link -->
        <div>
            <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address' ) ); ?>"
               class="inline-flex items-center gap-2 font-mono text-xs uppercase tracking-wider text-neutral-600 hover:text-black transition-colors">
                &larr; <?php esc_html_e( 'Back to Saved Destinations', 'mazestreetwear' ); ?>
            </a>
        </div>

        <!-- Header Section -->
        <div class="pb-6 border-b border-black">
            <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                <?php esc_html_e( 'Address Configuration', 'mazestreetwear' ); ?>
            </span>
            <h2 class="text-3xl sm:text-4xl font-bebas uppercase tracking-wide text-black">
                <?php echo esc_html( $page_title ); ?>
            </h2>
        </div>

        <form method="post" class="space-y-6">

            <div class="woocommerce-address-fields space-y-4">
                <?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

                <div class="woocommerce-address-fields__field-wrapper grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php
                    foreach ( $address as $key => $field ) {
                        woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
                    }
                    ?>
                </div>

                <?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>
            </div>

            <div class="pt-4 border-t border-black flex flex-col sm:flex-row items-center justify-between gap-4">
                <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center bg-black text-white px-8 py-3.5 font-bebas text-lg tracking-wider uppercase hover:bg-neutral-800 transition-colors"
                        name="save_address"
                        value="<?php esc_attr_e( 'Save address', 'woocommerce' ); ?>">
                    <?php esc_html_e( 'Save Address Coordinates', 'mazestreetwear' ); ?> &rarr;
                </button>
                <?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
                <input type="hidden" name="action" value="edit_address" />
            </div>

        </form>

    </div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>
