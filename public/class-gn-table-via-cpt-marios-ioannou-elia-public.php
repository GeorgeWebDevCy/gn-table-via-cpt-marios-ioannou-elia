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
		$args = array(
			'post_type'      => 'works',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		);

		$query = new WP_Query( $args );

		if ( ! $query->have_posts() ) {
			return '';
		}

		ob_start();
		?>
		<div class="gn-works-table-container">
			<table class="gn-works-table">
				<thead>
					<tr>
						<th class="gn-col-title">Title</th>
						<th class="gn-col-year">Year</th>
						<th class="gn-col-duration">Duration</th>
						<th class="gn-col-genre">Genre</th>
						<th class="gn-col-scored-for">Scored For</th>
						<th class="gn-col-instrumentation">Instrumentation</th>
						<th class="gn-col-premiere">Premiere</th>
					</tr>
				</thead>
				<tbody>
					<?php while ( $query->have_posts() ) : $query->the_post(); 
						$title = get_field('title') ?: get_the_title(); // Fallback to WP title if ACF specific title field is empty
						$year = get_field('year');
						$duration = get_field('duration');
						// Genre is a select field, might return array or string. JSON says multiple=1, return_format=value
						$genre = get_field('genre');
						if ( is_array( $genre ) ) {
							$genre = implode( ', ', $genre );
						}
						$scored_for = get_field('scored-for');
						$instrumentation = get_field('instrumentation_details');
						$premiere_date = get_field('date');
					?>
						<tr>
							<td class="gn-col-title" data-label="Title"><?php echo esc_html( $title ); ?></td>
							<td class="gn-col-year" data-label="Year"><?php echo esc_html( $year ); ?></td>
							<td class="gn-col-duration" data-label="Duration"><?php echo esc_html( $duration ); ?></td>
							<td class="gn-col-genre" data-label="Genre"><?php echo esc_html( $genre ); ?></td>
							<td class="gn-col-scored-for" data-label="Scored For"><?php echo esc_html( $scored_for ); ?></td>
							<td class="gn-col-instrumentation" data-label="Instrumentation"><?php echo wp_kses_post( $instrumentation ); ?></td>
							<td class="gn-col-premiere" data-label="Premiere"><?php echo esc_html( $premiere_date ); ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		<?php
		wp_reset_postdata();

		return ob_get_clean();
	}

}
