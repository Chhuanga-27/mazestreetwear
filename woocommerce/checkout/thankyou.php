<?php
/**
 * Thankyou Page - Custom Minimalist Editorial Order Confirmation for MAZE
 *
 * This template overrides woocommerce/templates/checkout/thankyou.php.
 * Features:
 * - High-contrast brutalist streetwear receipt layout
 * - Explicit payment details, ordered garments with thumbnails and variation pills
 * - Customer shipping & billing breakdown
 * - Seamless account creation notification with password setup explanation
 * - Preserved WooCommerce action hooks for PayU, analytics, and conversion tracking
 *
 * @package MazeStreetwear
 * @version 8.1.0
 *
 * @var WC_Order|false $order
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="maze-order-confirmation-wrapper bg-white text-black py-4 sm:py-8 font-outfit">
    <div class="max-w-4xl mx-auto">

        <?php if ( $order ) : ?>

            <?php
            // Trigger pre-thankyou action hook for payment gateways / analytics
            do_action( 'woocommerce_before_thankyou', $order->get_id() );
            ?>

            <?php if ( $order->has_status( 'failed' ) ) : ?>

                <!-- Order Failed State -->
                <div class="border border-black p-6 sm:p-10 mb-8 bg-white">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="inline-block w-3 h-3 bg-red-600 rounded-full"></span>
                        <span class="font-bebas text-2xl sm:text-3xl tracking-wide uppercase text-black">
                            <?php esc_html_e( 'Payment Unsuccessful', 'mazestreetwear' ); ?>
                        </span>
                    </div>

                    <p class="text-base text-neutral-800 leading-relaxed mb-6 font-normal">
                        <?php
                        $default_failed_text = esc_html__( 'Your transaction could not be processed by the payment provider. No funds were debited, or the transaction was declined. Please try again or use another payment method.', 'mazestreetwear' );
                        echo wp_kses_post( apply_filters( 'woocommerce_thankyou_order_failed_text', $default_failed_text, $order ) );
                        ?>
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 pt-4 border-t border-black">
                        <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="inline-flex items-center justify-center bg-black text-white px-8 py-3.5 font-bebas text-lg tracking-wider uppercase hover:bg-neutral-800 transition-colors">
                            <?php esc_html_e( 'Retry Payment with PayU', 'mazestreetwear' ); ?>
                        </a>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="inline-flex items-center justify-center border border-black bg-white text-black px-8 py-3.5 font-bebas text-lg tracking-wider uppercase hover:bg-neutral-100 transition-colors">
                            <?php esc_html_e( 'Return to Shop', 'mazestreetwear' ); ?>
                        </a>
                    </div>
                </div>

            <?php else : ?>

                <!-- Order Success State -->
                <div class="maze-order-confirmed-container space-y-8 sm:space-y-12">

                    <!-- Header Banner -->
                    <div class="border border-black p-6 sm:p-8 bg-white">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-black">
                            <div>
                                <span class="inline-block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                                    <?php esc_html_e( 'Official Order Receipt', 'mazestreetwear' ); ?>
                                </span>
                                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bebas tracking-wide uppercase text-black">
                                    <?php esc_html_e( 'Payment Confirmed // Order Received', 'mazestreetwear' ); ?>
                                </h2>
                            </div>
                            <div class="inline-flex items-center gap-2 self-start sm:self-auto px-3.5 py-1.5 border border-black text-xs font-mono uppercase tracking-widest bg-black text-white">
                                <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                                <?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
                            </div>
                        </div>

                        <p class="text-sm sm:text-base text-neutral-800 pt-6 leading-relaxed font-normal">
                            <?php
                            $billing_first_name = $order->get_billing_first_name();
                            $billing_email      = $order->get_billing_email();
                            if ( ! empty( $billing_first_name ) ) {
                                printf(
                                    /* translators: 1: First name, 2: Order email */
                                    esc_html__( 'Thank you, %1$s. Your order has been placed and confirmed. A full summary receipt has been dispatched to %2$s.', 'mazestreetwear' ),
                                    '<strong>' . esc_html( $billing_first_name ) . '</strong>',
                                    '<strong>' . esc_html( $billing_email ) . '</strong>'
                                );
                            } else {
                                printf(
                                    /* translators: %s: Order email */
                                    esc_html__( 'Thank you. Your order has been placed and confirmed. A full summary receipt has been dispatched to %s.', 'mazestreetwear' ),
                                    '<strong>' . esc_html( $billing_email ) . '</strong>'
                                );
                            }
                            ?>
                        </p>
                    </div>

                    <!-- Key Metadata Grid (4 Columns) -->
                    <div class="grid grid-cols-2 md:grid-cols-4 border-t border-l border-black text-black">
                        <!-- Order Number -->
                        <div class="border-b border-r border-black p-4 sm:p-5">
                            <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                                <?php esc_html_e( 'Order Number', 'mazestreetwear' ); ?>
                            </span>
                            <span class="font-bebas text-xl sm:text-2xl tracking-wide text-black">
                                #<?php echo esc_html( $order->get_order_number() ); ?>
                            </span>
                        </div>

                        <!-- Date -->
                        <div class="border-b border-r border-black p-4 sm:p-5">
                            <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                                <?php esc_html_e( 'Date', 'mazestreetwear' ); ?>
                            </span>
                            <span class="font-bebas text-xl sm:text-2xl tracking-wide text-black">
                                <?php echo esc_html( wc_format_datetime( $order->get_date_created(), 'M d, Y' ) ); ?>
                            </span>
                        </div>

                        <!-- Payment Method -->
                        <div class="border-b border-r border-black p-4 sm:p-5">
                            <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                                <?php esc_html_e( 'Payment Method', 'mazestreetwear' ); ?>
                            </span>
                            <span class="font-bebas text-xl sm:text-2xl tracking-wide text-black truncate block" title="<?php echo esc_attr( $order->get_payment_method_title() ); ?>">
                                <?php echo esc_html( $order->get_payment_method_title() ? $order->get_payment_method_title() : 'PayU' ); ?>
                            </span>
                        </div>

                        <!-- Total -->
                        <div class="border-b border-r border-black p-4 sm:p-5 bg-neutral-50">
                            <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                                <?php esc_html_e( 'Total Paid', 'mazestreetwear' ); ?>
                            </span>
                            <span class="font-bebas text-xl sm:text-2xl tracking-wide text-black">
                                <?php echo wp_kses_post( $order->get_formatted_order_total() ); ?>
                            </span>
                        </div>
                    </div>

                    <!-- Ordered Garments / Products List -->
                    <div class="border border-black bg-white">
                        <div class="p-4 sm:p-6 border-b border-black flex items-center justify-between">
                            <h3 class="font-bebas text-2xl sm:text-3xl tracking-wide uppercase text-black">
                                <?php esc_html_e( 'Ordered Items', 'mazestreetwear' ); ?>
                                <span class="text-sm font-mono text-neutral-500 ml-2">(<?php echo esc_html( $order->get_item_count() ); ?>)</span>
                            </h3>
                            <span class="font-mono text-xs uppercase tracking-widest text-neutral-500 hidden sm:inline-block">
                                <?php esc_html_e( 'MAZE Garment Catalog', 'mazestreetwear' ); ?>
                            </span>
                        </div>

                        <div class="divide-y divide-black">
                            <?php
                            /** @var WC_Order_Item_Product[] $order_items */
                            $order_items = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
                            foreach ( $order_items as $item_id => $item ) :
                                /** @var WC_Order_Item_Product $item */
                                $product       = is_callable( array( $item, 'get_product' ) ) ? $item->get_product() : null;
                                $item_name     = $item->get_name();
                                $item_qty      = $item->get_quantity();
                                $item_subtotal = $order->get_formatted_line_subtotal( $item );
                                $thumbnail     = ( $product && is_callable( array( $product, 'get_image' ) ) ) ? $product->get_image( array( 120, 150 ), array( 'class' => 'w-full h-full object-cover object-top' ) ) : '';
                                ?>
                                <div class="p-4 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                    <div class="flex items-center gap-4 sm:gap-6 min-w-0">
                                        <!-- Garment Thumbnail -->
                                        <div class="w-16 h-20 sm:w-20 sm:h-24 flex-shrink-0 border border-black bg-neutral-100 overflow-hidden">
                                            <?php if ( ! empty( $thumbnail ) ) : ?>
                                                <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                            <?php else : ?>
                                                <div class="w-full h-full flex items-center justify-center font-mono text-xs text-neutral-400">
                                                    MAZE
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Garment Details -->
                                        <div class="min-w-0">
                                            <h4 class="font-bebas text-lg sm:text-xl tracking-wide uppercase text-black truncate mb-1">
                                                <?php if ( $product && $product->get_permalink() ) : ?>
                                                    <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="hover:underline">
                                                        <?php echo esc_html( $item_name ); ?>
                                                    </a>
                                                <?php else : ?>
                                                    <?php echo esc_html( $item_name ); ?>
                                                <?php endif; ?>
                                            </h4>

                                            <!-- Variation Meta (Size, Color pills) -->
                                            <div class="flex flex-wrap items-center gap-2 text-xs font-mono text-neutral-600">
                                                <?php
                                                $formatted_meta = $item->get_formatted_meta_data( '' );
                                                if ( ! empty( $formatted_meta ) ) :
                                                    foreach ( $formatted_meta as $meta_id => $meta ) :
                                                        ?>
                                                        <span class="inline-block px-2 py-0.5 border border-black text-black uppercase font-medium bg-white">
                                                            <?php echo esc_html( $meta->display_key ); ?>: <?php echo wp_kses_post( force_balance_tags( $meta->display_value ) ); ?>
                                                        </span>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                                <span class="inline-block text-neutral-500 font-sans">
                                                    <?php esc_html_e( 'Qty:', 'mazestreetwear' ); ?> <?php echo esc_html( $item_qty ); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Garment Subtotal -->
                                    <div class="sm:text-right self-end sm:self-auto font-bebas text-xl sm:text-2xl text-black">
                                        <?php echo wp_kses_post( $item_subtotal ); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Financial Totals Summary -->
                        <div class="p-4 sm:p-6 bg-neutral-50 border-t border-black">
                            <div class="max-w-md ml-auto space-y-2 text-sm font-outfit">
                                <?php
                                $item_totals = $order->get_order_item_totals();
                                if ( $item_totals ) :
                                    foreach ( $item_totals as $key => $total ) :
                                        $is_grand_total = ( 'order_total' === $key );
                                        if ( $is_grand_total ) :
                                            ?>
                                            <div class="flex items-center justify-between pt-3 border-t border-black text-base sm:text-lg font-bold text-black">
                                                <span class="font-bebas text-xl uppercase tracking-wide">
                                                    <?php echo esc_html( $total['label'] ); ?>
                                                </span>
                                                <span class="font-bebas text-2xl sm:text-3xl text-black">
                                                    <?php echo wp_kses_post( $total['value'] ); ?>
                                                </span>
                                            </div>
                                        <?php else : ?>
                                            <div class="flex items-center justify-between text-neutral-700">
                                                <span class="font-mono text-xs uppercase tracking-wider">
                                                    <?php echo esc_html( $total['label'] ); ?>
                                                </span>
                                                <span class="font-medium">
                                                    <?php echo wp_kses_post( $total['value'] ); ?>
                                                </span>
                                            </div>
                                        <?php
                                        endif;
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Customer & Address Information Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                        <!-- Shipping Address -->
                        <div class="border border-black p-6 bg-white">
                            <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-2">
                                <?php esc_html_e( 'Delivery Destination', 'mazestreetwear' ); ?>
                            </span>
                            <h4 class="font-bebas text-2xl tracking-wide uppercase text-black mb-4">
                                <?php esc_html_e( 'Shipping Address', 'mazestreetwear' ); ?>
                            </h4>

                            <address class="not-italic text-sm text-neutral-800 leading-relaxed font-normal">
                                <?php
                                $shipping_address = $order->get_formatted_shipping_address();
                                echo $shipping_address ? wp_kses_post( $shipping_address ) : wp_kses_post( $order->get_formatted_billing_address() );
                                ?>
                            </address>

                            <?php if ( $order->get_billing_phone() ) : ?>
                                <div class="mt-4 pt-3 border-t border-neutral-200 text-xs font-mono text-neutral-600">
                                    <span class="text-neutral-400"><?php esc_html_e( 'Contact Phone:', 'mazestreetwear' ); ?></span>
                                    <span class="text-black font-medium ml-1"><?php echo esc_html( $order->get_billing_phone() ); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Billing & Payment Information -->
                        <div class="border border-black p-6 bg-white">
                            <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-2">
                                <?php esc_html_e( 'Billing & Verification', 'mazestreetwear' ); ?>
                            </span>
                            <h4 class="font-bebas text-2xl tracking-wide uppercase text-black mb-4">
                                <?php esc_html_e( 'Payment & Contact', 'mazestreetwear' ); ?>
                            </h4>

                            <div class="space-y-3 text-sm text-neutral-800 font-normal">
                                <div>
                                    <span class="block font-mono text-xs text-neutral-500 uppercase tracking-wider mb-0.5">
                                        <?php esc_html_e( 'Registered Email', 'mazestreetwear' ); ?>
                                    </span>
                                    <span class="font-medium text-black"><?php echo esc_html( $order->get_billing_email() ); ?></span>
                                </div>

                                <div>
                                    <span class="block font-mono text-xs text-neutral-500 uppercase tracking-wider mb-0.5">
                                        <?php esc_html_e( 'Payment Method', 'mazestreetwear' ); ?>
                                    </span>
                                    <span class="font-medium text-black">
                                        <?php echo esc_html( $order->get_payment_method_title() ? $order->get_payment_method_title() : 'PayU' ); ?>
                                    </span>
                                </div>

                                <div class="pt-2">
                                    <span class="block font-mono text-xs text-neutral-500 uppercase tracking-wider mb-0.5">
                                        <?php esc_html_e( 'Billing Address', 'mazestreetwear' ); ?>
                                    </span>
                                    <address class="not-italic text-sm text-neutral-800 leading-relaxed font-normal">
                                        <?php echo wp_kses_post( $order->get_formatted_billing_address() ); ?>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Seamless Account Creation Notice (Answers "How do I know my password?") -->
                    <div class="border border-black p-6 sm:p-8 bg-white">
                        <div class="flex items-start gap-4">
                            <div class="hidden sm:flex w-10 h-10 border border-black bg-black text-white items-center justify-center font-bebas text-lg flex-shrink-0">
                                M
                            </div>
                            <div class="flex-1">
                                <span class="font-mono text-xs uppercase tracking-widest text-neutral-500 block mb-1">
                                    <?php esc_html_e( 'Seamless Customer Access', 'mazestreetwear' ); ?>
                                </span>
                                <h4 class="font-bebas text-2xl tracking-wide uppercase text-black mb-2">
                                    <?php esc_html_e( 'MAZE Account Created For You', 'mazestreetwear' ); ?>
                                </h4>
                                <p class="text-sm text-neutral-700 leading-relaxed font-normal">
                                    <?php
                                    printf(
                                        /* translators: %s: Customer billing email */
                                        esc_html__( 'To ensure you can track your order history and manage your shipping information seamlessly, a MAZE account has been created for %s. A welcome email containing your 1-click password setup link has been sent to your inbox. You can set a password whenever you choose, or sign in anytime using your email.', 'mazestreetwear' ),
                                        '<strong>' . esc_html( $order->get_billing_email() ) . '</strong>'
                                    );
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Action Controls -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-black">
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="w-full sm:w-auto inline-flex items-center justify-center bg-black text-white px-8 py-4 font-bebas text-lg tracking-wider uppercase hover:bg-neutral-800 transition-colors">
                            <?php esc_html_e( 'Continue Shopping', 'mazestreetwear' ); ?>
                        </a>

                        <div class="flex items-center gap-3 w-full sm:w-auto">
                            <a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>" class="w-full sm:w-auto inline-flex items-center justify-center border border-black bg-white text-black px-6 py-4 font-bebas text-base tracking-wider uppercase hover:bg-neutral-100 transition-colors">
                                <?php esc_html_e( 'Need Assistance? Contact Us', 'mazestreetwear' ); ?>
                            </a>
                        </div>
                    </div>

                </div>

            <?php endif; ?>

            <?php
            // Trigger payment gateway specific thankyou hooks (PayU, etc.)
            do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() );

            // Trigger general thankyou hook (analytics, Facebook Pixel, conversion scripts)
            do_action( 'woocommerce_thankyou', $order->get_id() );
            ?>

        <?php else : ?>

            <!-- Fallback if order ID is missing or invalid -->
            <div class="border border-black p-8 sm:p-12 text-center bg-white">
                <h2 class="text-3xl sm:text-4xl font-bebas uppercase tracking-wide text-black mb-4">
                    <?php esc_html_e( 'Order Received', 'mazestreetwear' ); ?>
                </h2>
                <p class="text-neutral-700 text-base mb-8 max-w-md mx-auto font-normal leading-relaxed">
                    <?php esc_html_e( 'Thank you. Your order has been placed successfully. A full confirmation email has been dispatched to your email address.', 'mazestreetwear' ); ?>
                </p>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="inline-flex items-center justify-center bg-black text-white px-8 py-3.5 font-bebas text-lg tracking-wider uppercase hover:bg-neutral-800 transition-colors">
                    <?php esc_html_e( 'Explore Catalog', 'mazestreetwear' ); ?>
                </a>
            </div>

        <?php endif; ?>

    </div>
</div>
