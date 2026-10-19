<?php
/**
 * Single Product Size Chart Modal Template
 *
 * Brutalist monochrome pop-up size chart modal for Maze Streetwear.
 * Features tabs for Utility Gilet, T-Shirt, Puffer Jacket, Jacket, and Double Layer Hoodie.
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
$size_charts = function_exists( 'mazestreetwear_get_size_charts' ) ? mazestreetwear_get_size_charts() : array();

if ( empty( $size_charts ) ) {
    return;
}

$default_chart_key = function_exists( 'mazestreetwear_get_current_product_size_chart_key' ) 
    ? mazestreetwear_get_current_product_size_chart_key( $product ) 
    : 't-shirt';
?>

<!-- Maze Streetwear Sizing Chart Modal -->
<div id="maze-size-chart-modal"
     class="maze-size-chart-modal fixed inset-0 z-[99999] bg-black/70 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-200 flex items-center justify-center p-3 sm:p-6"
     role="dialog"
     aria-modal="true"
     aria-labelledby="maze-size-chart-title"
     data-default-chart="<?php echo esc_attr( $default_chart_key ); ?>"
     style="display:none;"
     onclick="if (event.target === this) { window.mazeCloseSizeChart && window.mazeCloseSizeChart(event); }">

    <!-- Modal Dialog Window -->
    <div class="maze-size-chart-dialog bg-white text-black border-2 border-black w-full max-w-xl md:max-w-2xl max-h-[90vh] flex flex-col shadow-2xl relative transform scale-95 transition-transform duration-200 overflow-hidden my-auto"
         role="document"
         onclick="event.stopPropagation();">

        <!-- Modal Top Header Bar -->
        <div class="flex items-center justify-between px-5 sm:px-6 py-4 border-b-2 border-black bg-white select-none">
            <div>
                <h3 id="maze-size-chart-title" class="text-2xl sm:text-3xl font-normal font-bebas uppercase tracking-wider text-black leading-none">
                    <?php esc_html_e( 'SIZE GUIDE // CHART', 'mazestreetwear' ); ?>
                </h3>
            </div>

            <!-- Top Close 'X' Button -->
            <button type="button"
                    class="maze-size-chart-close w-9 h-9 border border-black bg-white hover:bg-black hover:text-white text-black flex items-center justify-center transition-colors cursor-pointer select-none"
                    onclick="window.mazeCloseSizeChart && window.mazeCloseSizeChart(event)"
                    aria-label="<?php esc_attr_e( 'Close Size Chart', 'mazestreetwear' ); ?>">
                <svg class="w-4 h-4 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Garment Category Switcher Tabs -->
        <div class="maze-size-chart-tabs flex items-center gap-1.5 sm:gap-2 overflow-x-auto py-2.5 px-4 sm:px-6 bg-neutral-100 border-b border-black select-none scrollbar-none"
             role="tablist"
             aria-label="<?php esc_attr_e( 'Garment size categories', 'mazestreetwear' ); ?>">
            <?php foreach ( $size_charts as $chart_id => $chart_data ) : 
                $is_active_tab = ( $chart_id === $default_chart_key );
            ?>
                <button type="button"
                        role="tab"
                        id="maze-tab-<?php echo esc_attr( $chart_id ); ?>"
                        class="maze-size-chart-tab px-3.5 py-1.5 text-xs sm:text-sm font-bebas uppercase tracking-wider border border-black cursor-pointer transition-colors whitespace-nowrap rounded-none <?php echo $is_active_tab ? 'is-active bg-black text-white' : 'bg-white text-black hover:bg-neutral-200'; ?>"
                        data-chart-target="<?php echo esc_attr( $chart_id ); ?>"
                        aria-selected="<?php echo $is_active_tab ? 'true' : 'false'; ?>"
                        aria-controls="maze-chart-panel-<?php echo esc_attr( $chart_id ); ?>"
                        onclick="window.mazeSwitchSizeChartTab && window.mazeSwitchSizeChartTab('<?php echo esc_attr( $chart_id ); ?>', event)">
                    <?php echo esc_html( $chart_data['title'] ); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Modal Body Content: Size Tables & Instructions -->
        <div class="maze-size-chart-body p-5 sm:p-6 overflow-y-auto space-y-5 bg-white">

            <?php foreach ( $size_charts as $chart_id => $chart_data ) : 
                $is_active_panel = ( $chart_id === $default_chart_key );
            ?>
                <!-- Size Chart Panel: <?php echo esc_html( $chart_data['title'] ); ?> -->
                <div id="maze-chart-panel-<?php echo esc_attr( $chart_id ); ?>"
                     class="maze-size-chart-panel <?php echo $is_active_panel ? 'block' : 'hidden'; ?>"
                     role="tabpanel"
                     aria-labelledby="maze-tab-<?php echo esc_attr( $chart_id ); ?>"
                     data-chart-panel="<?php echo esc_attr( $chart_id ); ?>">

                    <div class="flex items-center justify-between mb-2.5">
                        <h4 class="text-lg sm:text-xl font-normal font-bebas uppercase tracking-wider text-black">
                            <?php echo esc_html( $chart_data['title'] ); ?> <?php esc_html_e( 'MEASUREMENTS', 'mazestreetwear' ); ?>
                        </h4>
                        <span class="text-[11px] sm:text-xs font-outfit text-neutral-500 font-medium uppercase tracking-wide">
                            <?php esc_html_e( 'Length & Chest Flat', 'mazestreetwear' ); ?>
                        </span>
                    </div>

                    <!-- Clean Brutalist Sizing Table -->
                    <div class="overflow-x-auto border-2 border-black">
                        <table class="w-full text-left border-collapse bg-white">
                            <thead>
                                <tr class="bg-black text-white select-none">
                                    <th scope="col" class="py-3 px-3.5 sm:px-4 font-bebas font-normal text-base sm:text-lg uppercase tracking-wider border-r border-neutral-800">
                                        <?php esc_html_e( 'SIZE', 'mazestreetwear' ); ?>
                                    </th>
                                    <th scope="col" class="py-3 px-3.5 sm:px-4 font-bebas font-normal text-base sm:text-lg uppercase tracking-wider border-r border-neutral-800">
                                        <?php esc_html_e( 'LENGTH', 'mazestreetwear' ); ?>
                                    </th>
                                    <th scope="col" class="py-3 px-3.5 sm:px-4 font-bebas font-normal text-base sm:text-lg uppercase tracking-wider">
                                        <?php esc_html_e( 'CHEST', 'mazestreetwear' ); ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-200 font-outfit text-xs sm:text-sm">
                                <?php foreach ( $chart_data['rows'] as $r_idx => $row ) : 
                                    $row_bg = ( $r_idx % 2 === 1 ) ? 'bg-neutral-50/60' : 'bg-white';
                                ?>
                                    <tr class="<?php echo esc_attr( $row_bg ); ?> hover:bg-neutral-100/80 transition-colors">
                                        <td class="py-3 px-3.5 sm:px-4 font-bold font-bebas text-base sm:text-lg text-black border-r border-neutral-200 tracking-wide">
                                            <?php echo esc_html( $row['size'] ); ?>
                                        </td>
                                        <td class="py-3 px-3.5 sm:px-4 text-neutral-800 border-r border-neutral-200 whitespace-nowrap font-medium">
                                            <?php echo esc_html( $row['length'] ); ?>
                                        </td>
                                        <td class="py-3 px-3.5 sm:px-4 text-neutral-800 whitespace-nowrap font-medium">
                                            <?php echo esc_html( $row['chest'] ); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>

        </div><!-- .maze-size-chart-body -->

        <!-- Modal Bottom Actions Bar -->
        <div class="flex items-center justify-between px-5 sm:px-6 py-3.5 border-t border-black bg-neutral-50">
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
    window.mazeOpenSizeChart = function (event, btn) {
        if (event && event.preventDefault) {
            event.preventDefault();
        }
        var modal = document.getElementById('maze-size-chart-modal');
        if (!modal) return;

        var chartKey = (btn && btn.getAttribute('data-active-chart')) || modal.getAttribute('data-default-chart') || 't-shirt';
        if (window.mazeSwitchSizeChartTab) {
            window.mazeSwitchSizeChartTab(chartKey);
        }

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
        if (event && event.preventDefault) {
            event.preventDefault();
        }
        if (!chartKey) return;
        var modal = document.getElementById('maze-size-chart-modal');
        if (!modal) return;

        var tabs = modal.querySelectorAll('.maze-size-chart-tab');
        var panels = modal.querySelectorAll('.maze-size-chart-panel');

        for (var i = 0; i < tabs.length; i++) {
            var tab = tabs[i];
            var target = tab.getAttribute('data-chart-target');
            if (target === chartKey) {
                tab.classList.add('is-active', 'bg-black', 'text-white');
                tab.classList.remove('bg-white', 'text-black', 'hover:bg-neutral-200');
                tab.setAttribute('aria-selected', 'true');
            } else {
                tab.classList.remove('is-active', 'bg-black', 'text-white');
                tab.classList.add('bg-white', 'text-black', 'hover:bg-neutral-200');
                tab.setAttribute('aria-selected', 'false');
            }
        }

        for (var j = 0; j < panels.length; j++) {
            var panel = panels[j];
            var panelTarget = panel.getAttribute('data-chart-panel');
            if (panelTarget === chartKey) {
                panel.classList.remove('hidden');
                panel.classList.add('block');
            } else {
                panel.classList.add('hidden');
                panel.classList.remove('block');
            }
        }
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
