<?php
/**
 * Main plugin file.
 *
 * @package    dorzki\WooCommerce\Visual_Variations
 * @subpackage Plugin
 * @author     Dor Zuberi <webmaster@dorzki.co.il>
 * @link       https://www.dorzki.co.il
 * @version    1.0.0
 */

namespace dorzki\WooCommerce\Visual_Variations;

// Block if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class Plugin
 *
 * @package dorzki\WooCommerce\Visual_Variations
 */
class Plugin {

	/**
	 * Plugin instance.
	 *
	 * @var null|Plugin
	 */
	private static $instance = null;


	/* ------------------------------------------ */


	/**
	 * Plugin constructor.
	 */
	public function __construct() {

		add_action( 'woocommerce_before_variations_form', [ $this, 'display_visual_variations' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_plugin_assets' ] );

	}


	/* ------------------------------------------ */


	/**
	 * Display visual variations using variation images.
	 *
	 * @return bool
	 */
	public function display_visual_variations() {

		global $product;

		$variations = $product->get_available_variations();

		if ( ! $variations ) {
			return false;
		}

		echo "<ul class='visual-variations'>";

		foreach ( $variations as $idx => $variation ) {

			echo "<li class='variation-id-{$variation['variation_id']}'>";
			echo "  <button type='button' data-var-idx='{$idx}'>";
			echo "      <img src='{$variation['image']['url']}' alt='{$variation['image']['alt']}'>";
			echo "	</button>";
			echo "</li>";

		}

		echo "</ul>";

		return true;

	}


	/**
	 * Register plugin CSS & JavaScript files.
	 */
	public function register_plugin_assets() {

		wp_enqueue_style( 'wc-visual-vars-css', plugin_dir_url( __FILE__ ) . '/assets/styles.css' );

		wp_enqueue_script( 'wc-visual-vars-js', plugin_dir_url( __FILE__ ) . '/assets/scripts.js', [ 'jquery' ], false, true );

	}


	/* ------------------------------------------ */


	/**
	 * Retrieve plugin instance.
	 *
	 * @return Plugin|null
	 */
	public static function get_instance() {

		if ( is_null( self::$instance ) ) {

			self::$instance = new self();

		}

		return self::$instance;

	}

}

// initiate plugin.
Plugin::get_instance();
