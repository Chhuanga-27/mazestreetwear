<?php
/**
 * Single Product Size Chart Modal Template
 *
 * Brutalist monochrome pop-up size chart modal for Maze Streetwear.
 * Displays ONLY the size chart corresponding to the currently viewed product.
 *
 * @package MazeStreetwear
 * @version 1.2.2
 */

defined( 'ABSPATH' ) || exit;

// Strictly resolve the single product being viewed to avoid loop bleeding from related products
$current_product = null;
if ( function_exists( 'is_product' ) && is_product() ) {
    $queried_id = get_queried_object_id();
    if ( $queried_id && function_exists( 'wc_get_product' ) ) {
        $current_product = wc_get_product( $queried_id );
    }
}
if ( ! $current_product ) {
    if ( isset( $product ) && is_a( $product, 'WC_Product' ) ) {
        $current_product = $product;
    } else {
        global $product;
        if ( $product && is_a( $product, 'WC_Product' ) ) {
            $current_product = $product;
        }
    }
}

// Retrieve the single matching size chart for this viewed product
$chart_data = function_exists( 'mazestreetwear_get_product_size_chart' ) 
    ? mazestreetwear_get_product_size_chart( $current_product )
    : ( function_exists( 'mazestreetwear_get_size_charts' ) ? ( mazestreetwear_get_size_charts()['lightning-t-shirt'] ?? null ) : null );

if ( empty( $chart_data ) || ! is_array( $chart_data ) ) {
    return;
}

$chart_id     = isset( $chart_data['id'] ) ? $chart_data['id'] : 'lightning-t-shirt';
$chart_title  = isset( $chart_data['title'] ) ? $chart_data['title'] : __( 'SIZE GUIDE', 'mazestreetwear' );
$columns      = isset( $chart_data['columns'] ) ? $chart_data['columns'] : array( 'SIZE', 'LENGTH', 'CHEST' );
$rows         = isset( $chart_data['rows'] ) ? $chart_data['rows'] : array();
$product_name = $current_product ? $current_product->get_name() : '';
?>

<style>
/* Absolute suppression of other product tabs under all circumstances */
#maze-size-chart-modal .maze-size-chart-tabs,
.maze-size-chart-tabs,
.maze-size-chart-tab {
    display: none !important;
    visibility: hidden !important;
    height: 0 !important;
    max-height: 0 !important;
    padding: 0 !important;
    margin: 0 !important;
    border: 0 !important;
    opacity: 0 !important;
    pointer-events: none !important;
}
</style>

<!-- Maze Streetwear Sizing Chart Modal -->
<div id="maze-size-chart-modal"
     class="maze-size-chart-modal fixed inset-0 z-[99999] bg-black/70 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-200 flex items-center justify-center p-3 sm:p-6"
     role="dialog"
     aria-modal="true"
     aria-labelledby="maze-size-chart-title"
     data-active-chart="<?php echo esc_attr( $chart_id ); ?>"
     style="display:none;"
     onclick="if (event.target === this) { window.mazeCloseSizeChart && window.mazeCloseSizeChart(event); }">

    <!-- Modal Dialog Window -->
    <div class="maze-size-chart-dialog bg-white text-black border-2 border-black w-full max-w-xl md:max-w-2xl max-h-[90vh] flex flex-col shadow-2xl relative transform scale-95 transition-transform duration-200 overflow-hidden my-auto"
         role="document"
         onclick="event.stopPropagation();">

        <!-- Modal Top Header Bar -->
        <div class="flex items-center justify-between px-5 sm:px-6 py-4 border-b-2 border-black bg-white select-none">
            <div class="pr-4">
                <h3 id="maze-size-chart-title" class="text-2xl sm:text-3xl font-normal font-bebas uppercase tracking-wider text-black leading-none">
                    <?php echo esc_html( $chart_title ); ?> <?php esc_html_e( 'SIZE CHART', 'mazestreetwear' ); ?>
                </h3>
            </div>

            <!-- Top Close 'X' Button -->
            <button type="button"
                    class="maze-size-chart-close w-9 h-9 border border-black bg-white hover:bg-black hover:text-white text-black flex items-center justify-center transition-colors cursor-pointer select-none flex-shrink-0"
                    onclick="window.mazeCloseSizeChart && window.mazeCloseSizeChart(event)"
                    aria-label="<?php esc_attr_e( 'Close Size Chart', 'mazestreetwear' ); ?>">
                <svg class="w-4 h-4 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body Content: Size Table & Measurements for Viewed Product Only -->
        <div class="maze-size-chart-body p-5 sm:p-6 overflow-y-auto space-y-5 bg-white">

            <!-- Size Chart Panel -->
            <div id="maze-chart-panel-<?php echo esc_attr( $chart_id ); ?>"
                 class="maze-size-chart-panel block"
                 role="region"
                 aria-labelledby="maze-size-chart-title">

                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <span class="inline-block w-2 h-2 bg-black"></span>
                        <h4 class="text-base sm:text-lg font-normal font-bebas uppercase tracking-wider text-black">
                            <?php echo esc_html( $chart_title ); ?> <?php esc_html_e( 'MEASUREMENTS', 'mazestreetwear' ); ?>
                        </h4>
                    </div>
                    <?php
                    $meas_cols = array();
                    if ( ! empty( $columns ) && is_array( $columns ) ) {
                        foreach ( $columns as $c_idx => $c_name ) {
                            if ( 0 !== $c_idx ) {
                                $meas_cols[] = ucwords( strtolower( $c_name ) );
                            }
                        }
                    }
                    $meas_subtitle = ! empty( $meas_cols ) ? implode( ' & ', $meas_cols ) : __( 'Measurements', 'mazestreetwear' );
                    ?>
                    <span class="text-[11px] sm:text-xs font-outfit text-neutral-500 font-medium uppercase tracking-wide">
                        <?php echo esc_html( $meas_subtitle ); ?>
                    </span>
                </div>

                <!-- Clean Brutalist Sizing Table -->
                <div class="overflow-x-auto border-2 border-black">
                    <table class="w-full text-left border-collapse bg-white">
                        <thead>
                            <tr class="bg-black text-white select-none">
                                <?php 
                                $col_count = count( $columns );
                                foreach ( $columns as $c_idx => $col_name ) : 
                                    $is_last = ( $c_idx === $col_count - 1 );
                                ?>
                                    <th scope="col" class="py-3 px-3.5 sm:px-4 font-bebas font-normal text-base sm:text-lg uppercase tracking-wider <?php echo ! $is_last ? 'border-r border-neutral-800' : ''; ?>">
                                        <?php echo esc_html( $col_name ); ?>
                                    </th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200 font-outfit text-xs sm:text-sm">
                            <?php foreach ( $rows as $r_idx => $row ) : 
                                $row_bg = ( $r_idx % 2 === 1 ) ? 'bg-neutral-50/60' : 'bg-white';
                            ?>
                                <tr class="<?php echo esc_attr( $row_bg ); ?> hover:bg-neutral-100/80 transition-colors">
                                    <?php 
                                    $total_cols = count( $columns );
                                    foreach ( $columns as $c_idx => $col_name ) :
                                        $col_key = strtolower( trim( $col_name ) );
                                        $is_last = ( $c_idx === $total_cols - 1 );
                                        $val     = isset( $row[ $col_key ] ) ? $row[ $col_key ] : '';
                                        
                                        if ( 0 === $c_idx ) : ?>
                                            <td class="py-3 px-3.5 sm:px-4 font-bold font-bebas text-base sm:text-lg text-black <?php echo ! $is_last ? 'border-r border-neutral-200' : ''; ?> tracking-wide">
                                                <?php echo esc_html( $val ); ?>
                                            </td>
                                        <?php else : ?>
                                            <td class="py-3 px-3.5 sm:px-4 text-neutral-800 <?php echo ! $is_last ? 'border-r border-neutral-200' : ''; ?> whitespace-nowrap font-medium">
                                                <?php echo esc_html( $val ); ?>
                                            </td>
                                        <?php endif;
                                    endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div><!-- .maze-size-chart-panel -->

        </div><!-- .maze-size-chart-body -->

        <!-- Modal Bottom Actions Bar -->
        <div class="flex items-center justify-between px-5 sm:px-6 py-3.5 border-t border-black bg-neutral-50 select-none">
            <span class="text-xs font-outfit font-semibold uppercase tracking-wider text-neutral-600">
                <?php esc_html_e( 'Questions? DM @MAZE.STW', 'mazestreetwear' ); ?>
            </span>
            <button type="button"
                    class="px-5 py-2 bg-black text-white hover:bg-neutral-800 font-bebas text-base uppercase tracking-wider transition-colors cursor-pointer border border-black rounded-none"
                    onclick="window.mazeCloseSizeChart && window.mazeCloseSizeChart(event)">
                <?php esc_html_e( 'CLOSE', 'mazestreetwear' ); ?>
            </button>
        </div>

    </div><!-- .maze-size-chart-dialog -->
</div><!-- #maze-size-chart-modal -->

<script>
/**
 * Immediate Size Chart Modal Logic (self-contained guarantee)
 */
(function () {
    function purgeOtherProductTabs() {
        var modal = document.getElementById('maze-size-chart-modal');
        if (!modal) return;
        var tabs = modal.querySelectorAll('.maze-size-chart-tabs, .maze-size-chart-tab');
        for (var i = 0; i < tabs.length; i++) {
            if (tabs[i] && tabs[i].parentNode) {
                tabs[i].parentNode.removeChild(tabs[i]);
            }
        }
        var activeChart = modal.getAttribute('data-active-chart') || 'lightning-t-shirt';
        var panels = modal.querySelectorAll('.maze-size-chart-panel');
        for (var j = 0; j < panels.length; j++) {
            var pTarget = panels[j].getAttribute('data-chart-panel') || panels[j].id.replace('maze-chart-panel-', '');
            if (pTarget && pTarget !== activeChart) {
                panels[j].remove();
            } else {
                panels[j].classList.remove('hidden');
                panels[j].classList.add('block');
            }
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', purgeOtherProductTabs);
    } else {
        purgeOtherProductTabs();
    }

    window.mazeOpenSizeChart = function (event, btn) {
        if (event && event.preventDefault) {
            event.preventDefault();
        }
        var modal = document.getElementById('maze-size-chart-modal');
        if (!modal) return;

        purgeOtherProductTabs();

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        setTimeout(function () {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
            var dialog = modal.querySelector('.maze-size-chart-dialog');
            if (dialog) {
                dialog.classList.remove('scale-95');
                dialog.classList.add('scale-100');
            }
        }, 10);
    };

    window.mazeCloseSizeChart = function (event) {
        if (event && event.preventDefault) {
            event.preventDefault();
        }
        var modal = document.getElementById('maze-size-chart-modal');
        if (!modal) return;

        modal.classList.remove('opacity-100', 'pointer-events-auto');
        modal.classList.add('opacity-0', 'pointer-events-none');
        var dialog = modal.querySelector('.maze-size-chart-dialog');
        if (dialog) {
            dialog.classList.remove('scale-100');
            dialog.classList.add('scale-95');
        }

        setTimeout(function () {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }, 200);
    };

    window.mazeSwitchSizeChartTab = function (chartKey, event) {
        // Maintained for backward-compatibility with any existing event listeners
    };

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' || e.keyCode === 27) {
            var modal = document.getElementById('maze-size-chart-modal');
            if (modal && modal.style.display !== 'none') {
                window.mazeCloseSizeChart();
            }
        }
    });
})();
</script>
