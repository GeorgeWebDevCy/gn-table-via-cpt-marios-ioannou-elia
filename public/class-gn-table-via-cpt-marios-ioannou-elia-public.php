<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.georgenicolaou.me
 * @since      1.0.0
 *
 * @package    Gn_Table_Via_Cpt_Marios_Ioannou_Elia
 * @subpackage Gn_Table_Via_Cpt_Marios_Ioannou_Elia/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Gn_Table_Via_Cpt_Marios_Ioannou_Elia
 * @subpackage Gn_Table_Via_Cpt_Marios_Ioannou_Elia/public
 * @author     George Nicolaou <orionas.elite@gmail.com>
 */
class Gn_Table_Via_Cpt_Marios_Ioannou_Elia_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gn_Table_Via_Cpt_Marios_Ioannou_Elia_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gn_Table_Via_Cpt_Marios_Ioannou_Elia_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/gn-table-via-cpt-marios-ioannou-elia-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gn_Table_Via_Cpt_Marios_Ioannou_Elia_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gn_Table_Via_Cpt_Marios_Ioannou_Elia_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/gn-table-via-cpt-marios-ioannou-elia-public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script( $this->plugin_name, 'gn_table_ajax', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'gn_table_works_nonce' ),
		) );

	}

	/**
	 * Register the shortcode.
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {
		add_shortcode( 'gn_table_works', array( $this, 'render_shortcode' ) );
	}

	/**
	 * Render the works table shortcode.
	 *
	 * @since    1.0.0
	 * @param    array    $atts    Attributes.
	 * @return   string            HTML output.
	 */
	public function render_shortcode( $atts ) {
		ob_start();
		?>
		<div class="gn-works-wrapper" id="gn-works-wrapper">
			<div class="gn-works-controls">
				<input type="text" id="gn-works-search" placeholder="Search works..." />
			</div>
			
			<div class="gn-works-table-container">
				<table class="gn-works-table">
					<thead>
						<tr>
							<th class="gn-col-index">#</th>
							<th class="gn-sortable" data-sort="title">Title <span class="gn-sort-icon"></span></th>
							<th class="gn-sortable" data-sort="year" data-order="desc">Year <span class="gn-sort-icon">▼</span></th>
							<th class="gn-col-duration">Duration</th>
							<th class="gn-col-genre">Genre</th>
							<th class="gn-col-scored-for">Scored For</th>
							<th class="gn-col-instrumentation">Instrumentation</th>
							<th class="gn-col-premiere">Premiere</th>
						</tr>
					</thead>
					<tbody id="gn-works-body">
						<?php 
						// Initial Load
						$this->render_table_rows( 1, '', 'year', 'DESC' ); 
						?>
					</tbody>
				</table>
			</div>
			
			<div id="gn-works-pagination" class="gn-works-pagination">
				<?php $this->render_pagination( 1, '', 'year', 'DESC' ); ?>
			</div>
			<div id="gn-works-loader" style="display:none;">Loading...</div>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * AJAX Handler for getting works
	 */
	public function ajax_get_works() {
		check_ajax_referer( 'gn_table_works_nonce', 'nonce' );

		$page = isset( $_POST['page'] ) ? intval( $_POST['page'] ) : 1;
		$search = isset( $_POST['search'] ) ? sanitize_text_field( $_POST['search'] ) : '';
		$orderby = isset( $_POST['orderby'] ) ? sanitize_text_field( $_POST['orderby'] ) : 'year';
		$order = isset( $_POST['order'] ) ? sanitize_text_field( $_POST['order'] ) : 'DESC';

		ob_start();
		$this->render_table_rows( $page, $search, $orderby, $order );
		$html = ob_get_clean();

		ob_start();
		$this->render_pagination( $page, $search, $orderby, $order );
		$pagination = ob_get_clean();

		wp_send_json_success( array(
			'html' => $html,
			'pagination' => $pagination
		) );
	}

	/**
	 * Render Pagination
	 */
	private function render_pagination( $page, $search, $orderby, $order ) {
		$args = $this->get_query_args( $page, $search, $orderby, $order );
		$query = new WP_Query( $args );
		$total_pages = $query->max_num_pages;

		if ( $total_pages <= 1 ) {
			return;
		}

		echo '<div class="gn-pagination-links">';
		for ( $i = 1; $i <= $total_pages; $i++ ) {
			$active_class = ( $i === $page ) ? 'active' : '';
			echo '<button class="gn-page-btn ' . esc_attr( $active_class ) . '" data-page="' . intval( $i ) . '">' . intval( $i ) . '</button>';
		}
		echo '</div>';
		wp_reset_postdata();
	}

	/**
	 * Get WP_Query Args
	 */
	private function get_query_args( $page, $search, $orderby, $order ) {
		$per_page = 10;
		$args = array(
			'post_type'      => 'works',
			'posts_per_page' => $per_page,
			'paged'          => $page,
			'post_status'    => 'publish',
		);

		// Search
		if ( ! empty( $search ) ) {
			$args['s'] = $search;
		}

		// Sorting
		$args['order'] = $order;
		
		if ( 'title' === $orderby ) {
			if ( ! empty( $search ) ) {
				// When searching, WordPress uses relevancy by default, but if explicit orderby title is requested:
                $args['orderby'] = 'title';
            } else {
                $args['orderby'] = 'title';
            }
		} elseif ( 'year' === $orderby ) {
			$args['meta_key'] = 'year';
			$args['orderby'] = 'meta_value'; // Use meta_value for alphanumeric sort of year (e.g. 2023, 2024)
            // If year needs to be numeric add 'meta_type' => 'NUMERIC'
		}

		return $args;
	}

	/**
	 * Helper to render rows
	 */
	private function render_table_rows( $page, $search, $orderby, $order ) {
		$args = $this->get_query_args( $page, $search, $orderby, $order );
		$query = new WP_Query( $args );

		if ( ! $query->have_posts() ) {
			echo '<tr><td colspan="8">No works found.</td></tr>';
			return;
		}

		$start_index = ( ( $page - 1 ) * 10 ) + 1;

		while ( $query->have_posts() ) : $query->the_post(); 
			$title = get_field('title') ?: get_the_title();
			$year = get_field('year');
			$duration = get_field('duration');
			$genre = get_field('genre');
			if ( is_array( $genre ) ) {
				$genre = implode( ', ', $genre );
			}
			$scored_for = get_field('scored-for');
			$instrumentation = get_field('instrumentation_details');
			$premiere_date = get_field('date');
			$permalink = get_permalink();
		?>
			<tr>
				<td class="gn-col-index" data-label="#"><?php echo intval( $start_index++ ); ?></td>
				<td class="gn-col-title" data-label="Title">
					<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
				</td>
				<td class="gn-col-year" data-label="Year"><?php echo esc_html( $year ); ?></td>
				<td class="gn-col-duration" data-label="Duration"><?php echo esc_html( $duration ); ?></td>
				<td class="gn-col-genre" data-label="Genre"><?php echo esc_html( $genre ); ?></td>
				<td class="gn-col-scored-for" data-label="Scored For"><?php echo esc_html( $scored_for ); ?></td>
				<td class="gn-col-instrumentation" data-label="Instrumentation"><?php echo wp_kses_post( $instrumentation ); ?></td>
				<td class="gn-col-premiere" data-label="Premiere"><?php echo esc_html( $premiere_date ); ?></td>
			</tr>
		<?php endwhile;
		wp_reset_postdata();
	}

}
