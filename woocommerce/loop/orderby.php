<?php
/**
 * Show options for ordering - Modern Minimalist Editorial
 *
 *
 * @package MazeStreetwear
 * @version 1.0.0
 * @var array<string, string> $catalog_orderby_options
 * @var string $orderby
 * @var bool $show_default_orderby
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$catalog_orderby_options = isset( $catalog_orderby_options ) ? $catalog_orderby_options : array();
$orderby                 = isset( $orderby ) ? $orderby : '';
?>
<form class="woocommerce-ordering maze-modern-ordering" method="get">
	<select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php endforeach; ?>
	</select>
	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>
