<?php 
namespace ElementsKit\Modules\Header_Footer\Theme_Hooks;

defined( 'ABSPATH' ) || exit;

/**
 * houzez theme compatibility.
 */
class Houzez {

	/**
	 * Instance of Elementor Frontend class.
	 *
	 * @var \Elementor\Frontend()
	 */
	private $elementor;

	private $header;
	private $footer;

	/**
	 * Run all the Actions / Filters.
	 */
	function __construct($template_ids) {
		$this->header = $template_ids[0];
		$this->footer = $template_ids[1];
		
		if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( 'Elementor\Plugin::instance' ) ) {
			$this->elementor = \Elementor\Plugin::instance();
		}

		if($this->header != null){
			add_action( 'template_redirect', array( $this, 'remove_theme_header_markup' ), 10 );
			add_action( 'houzez_header', [$this, 'add_plugin_header_markup'] );
		}

	}

	// header actions
	public function remove_theme_header_markup() {
		if ( add_action( 'houzez_header', 'houzez_template_header', 10 )) {
			// Remove the action if it exists
			remove_action( 'houzez_header', 'houzez_template_header', 10 );
		}
		remove_action( 'houzez_header_studio', array( $this, 'render_header' ), 10 );
    }
    
    public function add_plugin_header_markup(){
		do_action('elementskit/template/before_header');
		
		echo '<div class="ekit-template-content-markup ekit-template-content-header">';
			echo \ElementsKit\Utils::render_elementor_content($this->header); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</div>';
		do_action('elementskit/template/after_header');
    }

}