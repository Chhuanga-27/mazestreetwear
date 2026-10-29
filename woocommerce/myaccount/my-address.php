<?php
/**
 * My Addresses - Custom Modern Brutalist UI for MAZE
 *
 * This template overrides woocommerce/templates/myaccount/my-address.php.
 *
 * @package MazeStreetwear
 * @version 8.7.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
    $get_addresses = apply_filters(
        'woocommerce_my_account_get_addresses',
        array(
            'billing'  => __( 'Billing address', 'woocommerce' ),
            'shipping' => __( 'Shipping address', 'woocommerce' ),
        ),
        $customer_id
    );
} else {
    $get_addresses = apply_filters(
        'woocommerce_my_account_get_addresses',
        array(
            'billing' => __( 'Billing address', 'woocommerce' ),
        ),
        $customer_id
    );
}
?>

<div class="maze-account-addresses space-y-6">

    <!-- Header Section -->
    <div class="pb-6 border-b border-black">
        <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
            <?php esc_html_e( 'Saved Destinations', 'mazestreetwear' ); ?>
        </span>
        <h2 class="text-3xl sm:text-4xl font-bebas uppercase tracking-wide text-black">
            <?php esc_html_e( 'Address Directory', 'mazestreetwear' ); ?>
        </h2>
        <p class="text-sm text-neutral-700 font-normal mt-1">
            <?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following coordinates will be utilized on the checkout page by default.', 'woocommerce' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </p>
    </div>

    <!-- 2-Column Responsive Brutalist Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php
        $counter = 1;
        foreach ( $get_addresses as $name => $address_title ) :
            $address = wc_get_account_formatted_address( $name );
            $is_billing = ( 'billing' === $name );
            ?>
            <div class="border border-black p-6 bg-white flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-neutral-200">
                        <span class="font-mono text-xs uppercase tracking-widest text-neutral-500">
                            0<?php echo esc_html( $counter ); ?> // <?php echo esc_html( $is_billing ? 'BILLING COORDINATES' : 'SHIPPING DESTINATION' ); ?>
                        </span>
                        <span class="w-2 h-2 rounded-full bg-black"></span>
                    </div>

                    <h3 class="font-bebas text-2xl uppercase tracking-wide text-black mb-3">
                        <?php echo esc_html( $address_title ); ?>
                    </h3>

                    <address class="not-italic text-sm text-neutral-800 leading-relaxed font-normal mb-6 min-h-[5rem]">
                        <?php
                        if ( $address ) {
                            echo wp_kses_post( $address );
                        } else {
                            echo '<span class="text-neutral-400 font-mono text-xs uppercase tracking-wider block pt-2">' . esc_html__( 'No address coordinates configured yet.', 'mazestreetwear' ) . '</span>';
                        }
                        ?>
                    </address>
                </div>

                <div class="pt-4 border-t border-neutral-200">
                    <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>"
                       class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-2.5 border border-black bg-white text-black font-bebas text-base uppercase tracking-wider hover:bg-black hover:text-white transition-colors">
                        <?php
                        /* translators: %s: address title */
                        printf( esc_html__( 'Edit %s', 'mazestreetwear' ), esc_html( $address_title ) );
                        ?> &rarr;
                    </a>
                </div>
            </div>
            <?php
            $counter++;
        endforeach;
        ?>
    </div>

</div>
